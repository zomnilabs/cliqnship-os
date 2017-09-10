<?php
namespace App\Http\Controllers\Customers\Shipments;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\ShipmentEvent;
use App\Models\ShipmentTrackingNumber;
use App\Models\UserAddressbook;
use App\Models\WaybillNumber;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ShipmentsController extends Controller {
    public function index(Request $request)
    {
        $user = $request->user()->toArray();

        $shipments = Shipment::with('trackingNumbers')
            ->where('user_id', $user['id'])
            ->get();

        $addresses = UserAddressbook::where('user_id', $user['id'])->get();

        return view('customers.shipments.index')
            ->with('addresses', $addresses)
            ->with('shipments', $shipments);
    }

    public function preview($shipmentId)
    {
        $shipment = Shipment::where('id', $shipmentId)->first();

//        print_r($shipment->remarks[0]->remarks); exit;
        return view('print.waybill', compact('shipment'));
    }

    public function importShipments(Request $request)
    {
        if (! $request->hasFile('file')) {
            return redirect()->back();
        }

        $input = $request->all();
        $user = $request->user()->toArray();
        $file = $request->file('file');

        $newShipments = [];
        $errors = [];
        \Excel::load($file, function($reader) use ($user, $input, &$newShipments, &$errors) {
            $results = $reader->get();

            \DB::beginTransaction();
            try {
                foreach ($results as $row => $shipment) {
                    $valid = $this->validateArray($shipment);

                    if ($valid->fails()) {
                        $errors[] = [
                            'item'   => $row + 1,
                            'messages'  => $valid->errors()->toArray()
                        ];

                        \DB::rollBack();
                        break;
                    }

                    $newShipments[] = $this->createNewShipment($shipment, $user, $input);
                }

                \DB::commit();
            } catch (\Exception $e) {
                \Log::error($e->getMessage());
                \DB::rollBack();
            }
        });

        if (count($errors) > 0) {
            $request->session()->flash('error', $errors);
        } else {
            $request->session()->flash('success', $newShipments);
        }

        return redirect()->back();
    }

    private function createNewShipment($data, $user, $input)
    {
        $address = [
            'user_id'           => $user['id'],
            'first_name'        => $data['contact_person'],
            'last_name'         => '',
            'type'              => 'shipment',
            'address_type'      => 'residential',
            'contact_number'    => $data['contact_number'],
            'email'             => $data['email_address'],
            'address_line_1'    => $data['street'],
            'barangay'          => $data['barangay'],
            'city'              => $data['municipality'],
            'province'          => $data['province'],
            'zip_code'          => $data['zip_code']
        ];

        // Address
        $to = $this->findOrCreateAddress($address);

        $shipmentData = [
            'source_id'                     => 2,
            'user_id'                       => $user['id'],
            'from'                          => $input['from'],
            'to'                            => $to,
            'item_description'              => $data['item_description'],
            'number_of_items'               => $data['number_of_items'],
            'service_type'                  => $data['service_type'] ? $data['service_type'] : 'metro_manila',
            'is_international'              => $data['is_international'] ? $data['is_international'] : 'postal',
            'collect_and_deposit'           => $data['is_cod'] ? 1 : 0,
            'charge_to'                     => $data['charge_to'] ? $data['charge_to'] : 'sender',
            'package_type'                  => $data['package_type'] ? $data['package_type'] : 'own-packaging',
            'insurance_declared_value'      => $data['avail_insurance'] ? 1 : 0,
            'insurance_amount'              => $data['insurance_amount'],
            'length'                        => $data['length'],
            'width'                         => $data['width'],
            'height'                        => $data['height'],
            'weight'                        => $data['weight'],
            'status'                        => 'pending'
        ];

        $shipment = Shipment::create($shipmentData);
        $shipment->remarks()->create([
            'user_id'   => $user['id'],
            'remarks'   => $data['remarks']
        ]);

        if ($shipment->collect_and_deposit) {
            $cod = [
                'collect_and_deposit_amount'    => $data['cod_amount'],
                'account_name'                  => $data['account_name'],
                'account_number'                => $data['account_number'],
                'bank'                          => $data['bank'],
                'status'                        => 'pending',
                'cod_fee'                       => 0
            ];

            $shipment->cod()->create($cod);
        }

        // Create Tracking Number
        ShipmentTrackingNumber::create([
            'tracking_number'   => $this->createTrackingNumber(),
            'shipment_id'       =>$shipment->id
        ]);

        // Record Event
        ShipmentEvent::create([
            'shipment_id'   => $shipment->id,
            'event_source'  => 'customer',
            'event'         => 'status_change',
            'value'         => 'pending',
            'remarks'       => 'shipment created',
            'user_id'       => $user['id']
        ]);

        return $shipment;
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

    // Create unique tracking number
    private function createTrackingNumber()
    {
        $tracking = 5000000000;
        $current = WaybillNumber::orderBy('id', 'DESC')->first();

        if (! $current) {
            $tracking = WaybillNumber::create(['current' => $tracking]);

            return $tracking->current;
        }

        $tracking = (int) $current['current'] + 1;

        $tracking = WaybillNumber::create(['current' => $tracking]);

        return $tracking->current;
    }

    private function validateArray($shipment)
    {
        $rules = [];
        $shipment = $shipment->toArray();
        if (! $shipment['is_cod']) {
            $rules = [
                'contact_person'    => 'required|min:2',
                'contact_number'    => 'required|min:5',
                'street'            => 'required|min:2',
                'barangay'          => 'required|min:2',
                'municipality'      => 'required',
                'province'          => 'required',
                'zip_code'          => 'required',
                'remarks'           => 'required',
            ];
        } else {
            $rules = [
                'contact_person'    => 'required|min:2',
                'contact_number'    => 'required|min:5',
                'street'            => 'required|min:2',
                'barangay'          => 'required|min:2',
                'municipality'      => 'required',
                'province'          => 'required',
                'zip_code'          => 'required',
                'remarks'           => 'required',
                'cod_amount'        => 'required|numeric',
                'account_name'      => 'required',
                'account_number'    => 'required',
                'bank'              => 'required',
            ];
        }

        return \Validator::make($shipment, $rules);
    }
}