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
                'number_of_items'   => $shipment['number_of_items'],
                'type_of_items'     => $shipment['type_of_items'],
                'length'            => $shipment['length'],
                'width'             => $shipment['width'],
                'height'            => $shipment['height'],
                'weight'            => $shipment['weight'],
                'remarks'           => $shipment['remarks'],
                'status'            => 'pending'
            ];

            Shipment::create($bookingData);
        });
    }
}