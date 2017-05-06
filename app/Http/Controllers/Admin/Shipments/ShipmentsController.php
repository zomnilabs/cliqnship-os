<?php
namespace App\Http\Controllers\Admin\Shipments;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
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
                'other_waybill_provicer'    => '',
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
}