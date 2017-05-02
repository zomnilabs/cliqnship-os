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

    public function remit(Request $request, $riderId)
    {
        $today = Carbon::today('Asia/Manila')->toDateString();

        if ($request->has('date')) {
            $today = Carbon::createFromTimestamp(strtotime($request->get('date')))->toDateString();
        }

        $assignments = ShipmentAssignment::with('shipment')->where('user_id', $riderId)
            ->where('status', 'pending')
            ->whereDate('created_at', $today)
            ->get();

        $statistics = [
            'total_shipments'   => 0,
            'remitted'          => 0,
            'total_cod_amount'  => 0,
            'total_cod_amount_remitted'  => 0,
            'remitted_cod'      => 0,
            'with_cod'          => 0

        ];

        $assignmentsToday = ShipmentAssignment::with('shipment')
            ->where('user_id', $riderId)
            ->whereDate('created_at', $today)
            ->get();

        foreach ($assignmentsToday as $assignment) {
            $shipment = Shipment::where('id', $assignment->shipment_id)->first();

            if (! $shipment) {
                continue;
            }

            $statistics['total_shipments'] = $statistics['total_shipments'] + 1;

            if ($assignment->status === 'completed') {
                $statistics['remitted'] = $statistics['remitted'] + 1;
            }

            if ($shipment->collect_and_deposit) {
                $statistics['with_cod'] = $statistics['with_cod'] + 1;

                $statistics['total_cod_amount'] = $statistics['total_cod_amount'] + $shipment->collect_and_deposit_amount;

                if ($assignment->status === 'completed') {
                    $statistics['remitted_cod'] = $statistics['remitted_cod'] + 1;
                    $statistics['total_cod_amount_remitted'] = $statistics['total_cod_amount_remitted'] + $shipment->collect_and_deposit_amount;
                }
            }
        }

        return view('admin.receiving.shipment.index')
            ->with('statistics', $statistics)
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