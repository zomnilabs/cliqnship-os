<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shipments\CreateShipmentRequest;
use App\Models\Shipment;
use App\Models\ShipmentTrackingNumber;
use Illuminate\Http\Request;

class ShipmentsController extends Controller {
    public function store(CreateShipmentRequest $request)
    {
        $input = $request->all();

        $shipment = null;
        // Create the booking
        \DB::transaction(function() use ($input, $request, &$shipment) {
            $input['source_id'] = "2";
            $input['status'] = "pending";

            $data = Shipment::create($input);

            if ($request->has('remarks')) {
                $remarks = $input['remarks'];
                unset($input['remarks']);

                $data->remarks()->create([
                    'user_id'   => $input['user_id'],
                    'remarks'   => $remarks
                ]);
            }

            // Create the shipment tracking number
            ShipmentTrackingNumber::create([
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
        $check = ShipmentTrackingNumber::where('tracking_number', $trackingNumber)
            ->first();

        if ($check) {
            $this->createTrackingNumber();
        }

        return $trackingNumber;
    }

    // Check waybill number
    public function checkWaybill(Request $request, $waybillNumber)
    {
        $shipment = ShipmentTrackingNumber::where('tracking_number', $waybillNumber)
            ->where('provider', 'cliqnship')
            ->first();

        if (! $shipment) {
            return response()->json('Invalid shipment', 400);
        }

        if ($request->has('status') && $shipment->status !== $request->get('status')) {
            return response()->json('Shipment not ' . $request->get('status') . ' yet', 400);
        }

        return response()->json($shipment, 200);
    }
}