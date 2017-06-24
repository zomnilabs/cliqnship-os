<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shipments\CreateShipmentRequest;
use App\Models\Shipment;
use App\Models\ShipmentEvent;
use App\Models\ShipmentTrackingNumber;
use App\Models\WaybillNumber;
use Illuminate\Http\Request;

class ShipmentsController extends Controller {
    public function show($shipmentId)
    {
        $shipment = Shipment::with('returnLogs.user.profile', 'events.user.profile')
            ->where('id', $shipmentId)->first();

        return response()->json($shipment, 200);
    }

    public function store(CreateShipmentRequest $request)
    {
        $input = $request->all();

        $shipment = null;
        // Create the shipment
        \DB::transaction(function() use ($input, $request, &$shipment) {
            $input['source_id'] = "2";
            $input['status'] = "pending";

            $remarks = null;
            if ($request->has('remarks')) {
                $remarks = $request->get('remarks');
            }

            unset($input['remarks']);

            $cod = [];
            if ($input['collect_and_deposit']) {
                $cod = [
                    'collect_and_deposit_amount'    => $input['collect_and_deposit_amount'],
                    'account_name'                  => $input['account_name'],
                    'account_number'                => $input['account_number'],
                    'bank'                          => $input['bank'],
                    'status'                        => $input['status']
                ];

                unset($input['collect_and_deposit_amount']);
                unset($input['account_name']);
                unset($input['account_number']);
                unset($input['bank']);
                unset($input['status']);
            }

            $data = Shipment::create($input);

            // Create COD Record
            if ($data->collect_and_deposit) {
                $data->cod()->create($cod);
            }

            if ($request->has('remarks')) {
                $data->remarks()->create([
                    'user_id'   => $input['user_id'],
                    'remarks'   => $remarks
                ]);
            }

            // Create the shipment tracking number
            $tracking = ShipmentTrackingNumber::create([
                'tracking_number'   => $this->createTrackingNumber(),
                'shipment_id'       => $data->id
            ]);

            $shipment = Shipment::with('address')
                ->where('id', $data->id)
                ->first();

            $shipment['shipment_tracking_no'] = $tracking->tracking_number;

            // Record Event
            ShipmentEvent::create([
                'shipment_id'   => $shipment->id,
                'event_source'  => 'customer',
                'event'         => 'status_change',
                'value'         => 'pending',
                'remarks'       => 'shipment created',
                'user_id'       => $request->user()->id
            ]);
        });

        if (! $shipment) {
            return response()->json(['failed to create a shipment'], 400);
        }

        return response()->json($shipment, 201);
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

    // Check waybill number
    public function checkWaybill(Request $request, $waybillNumber)
    {
        $shipment = ShipmentTrackingNumber::where('tracking_number', $waybillNumber)
            ->where('provider', 'cliqnship')
            ->first();

        if (! $shipment) {
            return response()->json('Invalid shipment', 400);
        }

        if ($request->has('status')) {
            if ($shipment->shipment->status === 'returned') {
                return response()->json('Returned shipments must be reviewed first', 400);
            }

            if ($shipment->shipment->status !== 'arrived-at-hq'
                && $shipment->shipment->status !== 'enroute') {

                return response()->json('Shipment not in hq yet', 400);
            }

//            if ($shipment->shipment->status === '')
        }

//        if ($request->has('status') && $request->has('user_id')
//            &&  $request->get('status') === 'enroute'
//            && $request->user()->id == $request->get('user_id') ) {
//
//
//        }

        return response()->json($shipment, 200);
    }
}