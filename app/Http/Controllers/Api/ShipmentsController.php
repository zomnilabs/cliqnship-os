<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shipments\CreateShipmentRequest;
use App\Models\Shipment;
use App\Models\ShipmentTrackingNumbers;

class ShipmentsController extends Controller {
    public function store(CreateShipmentRequest $request)
    {
        $input = $request->all();

        $shipment = null;
        // Create the booking
        \DB::transaction(function() use ($input, &$shipment) {
            $input['source_id'] = "2";
            $input['status'] = "pending";
            $input['user_addressbook_id'] = $input['user_addressbook']['id'];
            unset($input['user_addressbook']);

            $data = Shipment::create($input);

            // Create the shipment tracking number
            ShipmentTrackingNumbers::create([
                'tracking_number'   => $this->createTrackingNumber(),
                'shipment_id'       => $data->id
            ]);

            $shipment = Shipment::with('address')
                ->where('id', $data->id)
                ->first();
        });

        return response()->json($shipment, 201);
    }

    // Create unique tracking number
    private function createTrackingNumber()
    {
        $trackingNumber = uniqid();
        $check = ShipmentTrackingNumbers::where('tracking_number', $trackingNumber)
            ->first();

        if ($check) {
            $this->createTrackingNumber();
        }

        return $trackingNumber;
    }
}