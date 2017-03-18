<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shipments\CreateShipmentRequest;
use App\Models\Shipment;

class ShipmentsController extends Controller {
    public function store(CreateShipmentRequest $request)
    {
        $input = $request->all();

        $shipment = null;
        // Create the booking
        \DB::transaction(function() use ($input, &$shipment) {
            $input['source_id'] = "2";
            $input['status'] = "pending";

            $data = Shipment::create($input);

            $shipment = Shipment::with('address')
                ->where('id', $data->id)
                ->first();
        });

        return response()->json($shipment, 201);
    }
}