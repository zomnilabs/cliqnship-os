<?php
namespace App\Http\Controllers\Admin\Receiving;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\ShipmentAssignment;
use App\Models\ShipmentReturnLogs;
use App\Models\ShipmentTrackingNumber;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
                ->where('user_id', $rider->id)
                ->count();

            $rider['pending'] = $pendingAssignmentCount;
            $rider['completed_today'] = $completedShipmentToday;

            $result[] = $rider;
        }

        return view('admin.receiving.shipment')
            ->with('riders', $result);
    }

    public function remit($riderId)
    {
        $assignments = ShipmentAssignment::with('shipment')->where('user_id', $riderId)
            ->where('status', 'pending')
            ->get();

        return view('admin.receiving.shipment.index')
            ->with('assignments', $assignments);
    }

    public function doRemit(Request $request, $riderId)
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

            if ($request->get('status') === 'successfully-delivered'
                || $request->get('status') === 'returned') {

                // Update Assignment
                ShipmentAssignment::where('shipment_id', $waybill->shipment_id)
                    ->where('user_id', $riderId)
                    ->update(['status' => 'completed']);

                Shipment::where('id', $waybill->shipment_id)
                    ->update(['status' => $request->get('status')]);

                // Check if returned item
                if ($request->get('status') === 'returned') {
                    // Save return log
                    ShipmentReturnLogs::create([
                        'shipment_id'   => $waybill->shipment_id,
                        'user_id'       => $riderId,
                        'reason'        => $request->has('reason') ? $request->get('reason') : ''
                    ]);
                }
            }


        }

        return redirect()->back();
    }
}