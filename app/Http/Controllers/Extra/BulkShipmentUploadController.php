<?php
namespace App\Http\Controllers\Extra;

use App\Http\Controllers\Controller;
use App\TemporaryShipments;
use App\TemporaryWaybillNumbers;
use Illuminate\Http\Request;

class BulkShipmentUploadController extends Controller {
    public function index()
    {
        return view('bulk');
    }

    public function generate(Request $request)
    {
        if (! $request->hasFile('file')) {
            $request->session()->flash('error', 'No file was uploaded');

            return redirect()->back();
        }

        $file = $request->file('file');

        $shipments = [];
        \Excel::load($file, function($reader)  use (&$shipments) {
            $results = $reader->get();

            foreach ($results as $shipment) {
                $shipments[] = $this->createNewShipment($shipment);
            }
        });

        return view('print.waybill-bulk')
            ->with('shipments', $shipments);
    }

    private function createNewShipment($shipment)
    {
        $shipment = [
            'shipper_name'                  => $shipment['shipper_name'] ? $shipment['shipper_name'] : '',
            'shipper_contact_number'        => $shipment['shipper_contact_number'] ? $shipment['shipper_contact_number'] : '',
            'shipper_address'               => $shipment['shipper_address'] ? $shipment['shipper_address'] : '',
            'to'                            => $shipment['delivery_address'] ? $shipment['delivery_address'] : '',
            'address_type'                  => $shipment['address_type'] ? $shipment['address_type'] : '',
            'contact_person'                => $shipment['contact_person'] ? $shipment['contact_person'] : '',
            'contact_number'                => $shipment['contact_number'] ? $shipment['contact_number'] : '',
            'item_description'              => $shipment['item_description'] ? $shipment['item_description'] : '',
            'service_type'                  => $shipment['service_type'] ? $shipment['service_type'] : 'metro_manila',
            'collect_and_deposit'           => $shipment['is_cod'] ? $shipment['is_cod'] : 0,
            'collect_and_deposit_amount'    => $shipment['cod_amount'] ? $shipment['cod_amount'] : '',
            'account_name'                  => $shipment['account_name'] ? $shipment['account_name'] : '',
            'account_number'                => $shipment['account_number'] ? $shipment['account_number'] : '',
            'remarks'                       => $shipment['remarks'] ? $shipment['remarks'] : '',
            'bank'                          => $shipment['bank'] ? $shipment['bank'] : '',
            'charge_to'                     => $shipment['charge_to'] ? $shipment['charge_to'] : 'sender',
            'package_type'                  => $shipment['package_type'] ? $shipment['package_type'] : 'small',
            'insurance_declared_value'      => $shipment['avail_insurance'],
            'insurance_amount'              => $shipment['insurance_amount'],
            'length'                        => $shipment['length'],
            'width'                         => $shipment['width'],
            'height'                        => $shipment['height'],
            'weight'                        => $shipment['weight'],
            'tracking_number'               => $this->createTrackingNumber()
        ];

        TemporaryShipments::create($shipment);

        return $shipment;
    }

    // Create unique tracking number
    private function createTrackingNumber()
    {
        $tracking = 8800000000;
        $current = TemporaryWaybillNumbers::orderBy('id', 'DESC')->first();

        if (! $current) {
            return $tracking;
        }

        $tracking = (int) $current['current'] + 1;

        $tracking = TemporaryWaybillNumbers::create(['current' => $tracking]);

        return $tracking->current;
    }
}