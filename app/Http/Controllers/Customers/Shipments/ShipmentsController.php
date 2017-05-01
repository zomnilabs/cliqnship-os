<?php
namespace App\Http\Controllers\Customers\Shipments;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\UserAddressbook;
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

    public function preview()
    {
        return view('print.waybill');
    }

    public function importShipments(Request $request)
    {
        if (! $request->hasFile('file')) {
            return redirect()->back();
        }

        $input = $request->all();
        $user = $request->user()->toArray();
        $file = $request->file('file');

        \Excel::load($file, function($reader) use ($user, $input) {
            $results = $reader->get();

            foreach ($results as $shipment) {
                $this->createNewShipment($shipment, $user, $input);
            }
        });
    }

    private function createNewShipment($shipment, $user, $input)
    {
        \DB::transaction(function() use ($shipment, $user, $input) {
            $bookingData = [
                'source_id'         => 2,
                'user_id'           => $user['id'],
                'from'              => $input['from'],
                'to'                => $input['to'],
                'item_description'  => $input['item_description'],
                'number_of_items'   => $shipment['number_of_items'],
                'type_of_items'     => $shipment['type_of_items'],
                'service_type'      => $shipment['service_type'],
                'is_international'              => $shipment['is_international'],
                'collect_and_deposit'           => $shipment['is_cod'],
                'collect_and_deposit_amount'    => $shipment['cod_amount'],
                'account_name'                  => $shipment['account_name'],
                'account_number'                => $shipment['account_number'],
                'bank'                          => $shipment['bank'],
                'charge_to'                     => $shipment['charge_to'],
                'package_type'                  => $shipment['package_type'],
                'insurance_declared_value'      => $shipment['avail_insurance'],
                'insurance_amount'              => $shipment['insurance_amount'],
                'length'            => $shipment['length'],
                'width'             => $shipment['width'],
                'height'            => $shipment['height'],
                'weight'            => $shipment['weight'],
                'status'            => 'pending'
            ];

            $shipment = Shipment::create($bookingData);
            $shipment->remarks()->create([
                'user_id'   => $user['id'],
                'remarks'   => $shipment['remarks']
            ]);

        });
    }
}