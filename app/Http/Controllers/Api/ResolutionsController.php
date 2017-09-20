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
        $tracking = ShipmentTrackingNumber::with('shipment')->where('tracking_number', $waybillNumber)
            ->where('provider', 'cliqnship')
            ->first();

        if (! $tracking) {
            return response()->json('Invalid shipment', 400);
        }

        if ($tracking->shipment->status !== 'returned') {
            return response()->json('Only Returned Shipment are eligible for RTS', 400);
        }

        return response()->json($tracking, 200);
    }
}