<?php
namespace App\Http\Controllers\Admin\Dispatching;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\ShipmentAssignment;
use App\Models\ShipmentTrackingNumber;
use App\User;
use Illuminate\Http\Request;

class ShipmentsController extends Controller {
    public function all(Request $request)
    {

        if ($request->get('status') === 'assigned') {
            $shipments = Shipment::with('user','address','source', 'trackingNumbers')
                ->has('rider')
                ->where('status', 'enroute')
                ->get();
        } else {
            $shipments = Shipment::with('user','address','source', 'trackingNumbers')
                ->doesntHave('rider')
                ->where('status', 'arrived-at-hq')
                ->get();
        }

        $pendingShipment = Shipment::doesntHave('rider')
            ->where('status', 'arrived-at-hq')
            ->count();

        $assignedShipment = Shipment::has('rider')
            ->where('status', 'enroute')
            ->count();

        $riders = User::with('profile')
            ->where('user_group_id', 4)
            ->get();

//        print_r($shipments);exit;

        return view('admin.dispatching.shipments.all')
            ->with('pendingShipment', $pendingShipment)
            ->with('assignedShipment', $assignedShipment)
            ->with('riders', $riders)
            ->with('shipments',$shipments);
    }

    public function returned()
    {
        $shipments = Shipment::with('user','address','source', 'trackingNumbers')
            ->where('status', 'returned')
            ->get();

        return view('admin.dispatching.shipments.returned')
            ->with('shipments', $shipments);
    }

    public function dispatchShipments(Request $request)
    {
        foreach ($request->get('waybills') as $waybill) {
            // Check waybill
            $waybill = ShipmentTrackingNumber::where('tracking_number', $waybill)
                ->where('provider', 'cliqnship')
                ->first();

            // waybill not existing
            if (! $waybill) {
                continue;
            }

            // Create Assignment
            ShipmentAssignment::create([
                'user_id'   => $request->get('rider_id'),
                'shipment_id'   => $waybill->shipment_id
            ]);

            // Update shipment
            Shipment::where('id', $waybill->shipment_id)
                ->update(['status' => 'enroute']);
        }

        return redirect()->back();
    }
}