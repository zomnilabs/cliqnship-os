<?php
namespace App\Http\Controllers\Admin\Receiving;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\ShipmentAssignment;
use App\User;
use Carbon\Carbon;

class ShipmentsController extends Controller {
    public function all()
    {
        $riders = User::with('profile', 'shipmentAssignments')
            ->where('user_group_id', 4)
            ->get();

        $today = Carbon::today('Asia/Manila')->toDateString();
        $result = [];
        foreach ($riders as $rider) {
            $pendingAssignmentCount = ShipmentAssignment::where('user_id', $rider->id)
                ->where('status', 'pending')
                ->count();

            $completedShipmentToday = ShipmentAssignment::where('status', 'completed')
                ->whereDate('created_at', '=', $today)
                ->count();

            $rider['pending'] = $pendingAssignmentCount;
            $rider['completed_today'] = $completedShipmentToday;

            $result[] = $rider;
        }

        return view('admin.receiving.shipment')
            ->with('riders', $result);
    }

    public function remit()
    {
        return view('admin.receiving.shipment.index');
    }
}