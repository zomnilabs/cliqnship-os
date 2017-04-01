<?php
namespace App\Http\Controllers\Admin\Dispatching;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\ShipmentAssignment;
use App\User;

class ShipmentsController extends Controller {
    public function all()
    {
        $shipments = Shipment::with('user','address','source')
            ->get();

        $pendingShipment = Shipment::doesntHave('rider')
            ->where('status', 'arrived-at-hq')
            ->count();

        $assignedShipment = Shipment::has('rider')
            ->where('status', 'enroute')
            ->count();

        $riders = User::with('profile')
            ->where('user_group_id', 4)
            ->get();

        return view('admin.dispatching.shipments.all')
            ->with('pendingShipment', $pendingShipment)
            ->with('assignedShipment', $assignedShipment)
            ->with('riders', $riders)
            ->with('shipments',$shipments);
    }

    public function returned()
    {
        return view('admin.dispatching.shipments.returned');
    }
}