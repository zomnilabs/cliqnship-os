<?php
namespace App\Http\Controllers\Admin\Shipments;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\ShipmentRemarks;
use App\Models\ShipmentTrackingNumber;
use App\Models\UserAddressbook;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShipmentsController extends Controller
{
    public function index()
    {
    	$shipments = Shipment::with('trackingNumbers')->get();

        return view('admin.shipments.index')
            ->with('shipments', $shipments);
    }

    public function preview()
    {
        return view('print.waybill');
    }

    public function importShipment(Request $request)
    {
        if (! $request->hasFile('file')) {
            return redirect()->back();
        }

        $file = $request->file('file');

        \Excel::load($file, function($reader) {
            $results = $reader->get();

            foreach ($results as $shipment) {
                $this->updateShipment($shipment);
            }
        });

        return redirect()->back();
    }

    public function exportNewShipments(Request $request)
    {
        $input = $request->only('ids');
        $ids = explode(',', $input['ids']);

        $shipments = Shipment::whereIn('id', $ids)
            ->get();

        $data = [];
        foreach ($shipments as $shipment) {
            $data[] = [
                'account_id'                => $shipment->user->account_id,
                'waybill_number'            => $shipment->trackingNumbers()->mainTrackingNumber()->tracking_number,
                'other_waybill_number'      => '',
                'other_waybill_provider'    => '',
                'from_address_line_1'       => $shipment->senderAddress->address_line_1,
                'from_barangay'             => $shipment->senderAddress->barangay,
                'from_municipality'         => $shipment->senderAddress->city,
                'from_province'             => $shipment->senderAddress->province,
                'from_zip_code'             => $shipment->senderAddress->zip_code,
                'to_address_line_1'         => $shipment->address->address_line_1,
                'to_barangay'               => $shipment->address->barangay,
                'to_municipality'           => $shipment->address->city,
                'to_province'               => $shipment->address->province,
                'to_zip_code'               => $shipment->address->zip_code,
                'to_landmarks'              => $shipment->address->landmarks,
                'to_first_name'             => $shipment->address->first_name,
                'to_last_name'              => $shipment->address->last_name,
                'item_description'          => $shipment->item_description,
                'number_of_items'           => $shipment->number_of_items,
                'service_type'              => $shipment->service_type,
                'is_international'          => $shipment->is_international,
                'collect_and_deposit'       => $shipment->collect_and_deposit,
                'insurance_declared_value'  => $shipment->insurance_declared_value,
                'insurance_amount'          => $shipment->insurance_amount,
                'collect_and_deposit_amount'    => $shipment->collect_and_deposit_amount,
                'account_name'                  => $shipment->account_name,
                'account_number'            => $shipment->account_number,
                'bank'                      => $shipment->bank,
                'charge_to'                 => $shipment->charge_to,
                'pay_thru'                  => $shipment->pay_thru,
                'package_type'              => $shipment->package_type,
                'length'                    => $shipment->length,
                'width'                     => $shipment->width,
                'height'                    => $shipment->height,
                'weight'                    => $shipment->weight,
                'status'                    => $shipment->status,
                'remarks'                   => $shipment->remarks
            ];
        }

        $filename = 'shipments_'.Carbon::today('Asia/Manila')->toDateString();

        \Excel::create($filename, function($excel) use ($data) {
            $excel->sheet('Sheet 1', function($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download('xlsx');;
    }

    private function updateShipment($shipment)
    {
        $user = User::where('account_id', $shipment['account_id'])->first();

        if (! $user) {
            return null;
        }

        $tracking = ShipmentTrackingNumber::where('tracking_number', $shipment['waybill_number'])->first();

        if (! $tracking) {
            return null;
        }

        $data = [
            'user_id'                   => $user->id,
            'item_description'          => $shipment['item_description'],
            'number_of_items'           => $shipment['number_of_items'],
            'service_type'              => $shipment['service_type'],
            'is_international'          => $shipment['is_international'],
            'collect_and_deposit'       => $shipment['collect_and_deposit'],
            'insurance_declared_value'  => $shipment['insurance_declared_value'],
            'insurance_amount'          => $shipment['insurance_amount'],
            'collect_and_deposit_amount'    => $shipment['collect_and_deposit_amount'],
            'account_name'                  => $shipment['account_name'],
            'account_number'            => $shipment['account_number'],
            'bank'                      => $shipment['bank'],
            'charge_to'                 => $shipment['charge_to'],
            'pay_thru'                  => $shipment['pay_thru'],
            'package_type'              => $shipment['package_type'],
            'length'                    => $shipment['length'],
            'width'                     => $shipment['width'],
            'height'                    => $shipment['height'],
            'weight'                    => $shipment['weight'],
            'status'                    => $shipment['status'],
        ];

        $remarks = [
            'remarks'                   => $shipment['remarks']
        ];

        $otherWaybill = [
            'shipment_id'          => $tracking->shipment_id,
            'tracking_number'      => $shipment['other_waybill_number'],
            'provider'             => $shipment['other_waybill_provider']
        ];

        $address = [
            'user_id'                => $user->id,
            'address_line_1'         => $shipment['to_address_line_1'],
            'barangay'               => $shipment['to_barangay'],
            'city'                   => $shipment['to_municipality'],
            'province'               => $shipment['to_province'],
            'zip_code'               => $shipment['to_zip_code'],
            'landmarks'              => $shipment['to_landmarks'],
            'first_name'             => $shipment['to_first_name'],
            'last_name'              => $shipment['to_last_name'] ? $shipment['to_last_name'] : '',
        ];

        $result = null;

        \DB::transaction(function() use (&$result, $data, $remarks, $otherWaybill, $address, $tracking, $user) {
            $data['to'] = $this->findOrCreateAddress($address);

            $result = Shipment::where('id', $tracking->shipment_id)->update($data);

            if ($remarks['remarks']) {
                $oldRemarks = ShipmentRemarks::where('shipment_id', $tracking->shipment_id)
                    ->where('user_id', $user->id)
                    ->where('remarks', $remarks['remarks'])->first();

                if (! $oldRemarks) {
                    ShipmentRemarks::create([
                        'shipment_id'   => $tracking->shipment_id,
                        'user_id'       => $user->id,
                        'remarks'       => $remarks['remarks']
                    ]);
                }
            }

            if (! empty($otherWaybill['tracking_number'])) {
                $otherTracking = ShipmentTrackingNumber::where('shipment_id', $otherWaybill['shipment_id'])
                    ->where('tracking_number', $otherWaybill['tracking_number'])
                    ->where('provider', $otherWaybill['provider'])
                    ->first();

                if (! $otherTracking) {
                    ShipmentTrackingNumber::create($otherWaybill);
                }
            }

        });

        return $result;
    }

    private function findOrCreateAddress($address)
    {
        $model = UserAddressbook::query();
        $filters = array_keys($address);

        foreach ($filters as $filter) {
            $model->where($filter, $address[$filter]);
        }

        $result = $model->first();

        if (! $result) {
            $address['identifier']  = $address['first_name'];
            $result = UserAddressbook::create($address);
        }

        return $result->id;
    }
}