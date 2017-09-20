<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shipments\CreateShipmentRequest;
use App\Models\Shipment;
use App\Models\ShipmentEvent;
use App\Models\ShipmentTrackingNumber;
use App\Models\WaybillNumber;
use Illuminate\Http\Request;

class ResolutionsController extends Controller {
    // Check waybill number
    public function checkWaybill(Request $request, $waybillNumber)
    {
        $shipment = ShipmentTrackingNumber::with('shipment.cod')->where('tracking_number', $waybillNumber)
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

        }

        return response()->json($shipment, 200);
    }
}