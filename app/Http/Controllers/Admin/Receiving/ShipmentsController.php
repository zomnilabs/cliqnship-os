<?php
namespace App\Http\Controllers\Admin\Receiving;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\ShipmentAssignment;
use App\Models\ShipmentCod;
use App\Models\ShipmentEvent;
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
            $pendingAssignmentCount = ShipmentAssignment::withTrashed()
                ->where('user_id', $rider->id)
                ->where('status', 'pending')
                ->count();

            $completedShipmentToday = ShipmentAssignment::withTrashed()
                ->where('status', 'completed')
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

        $assignments = ShipmentAssignment::with('shipment')
            ->withTrashed()
            ->where('user_id', $riderId)
//            ->where('status', 'pending')
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
            ->withTrashed()
            ->where('user_id', $riderId)
            ->where('status', '!=', 'cancelled')
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

            // Don't count cod of new shipment
            if ($shipment->status !== 'arrived-at-hq') {
                if ($shipment->collect_and_deposit) {
                    $statistics['with_cod'] = $statistics['with_cod'] + 1;

                    $statistics['total_cod_amount'] = $statistics['total_cod_amount'] + $shipment->collect_and_deposit_amount;

                    if ($assignment->status === 'completed') {
                        $statistics['remitted_cod'] = $statistics['remitted_cod'] + 1;
                        $statistics['total_cod_amount_remitted'] = $statistics['total_cod_amount_remitted'] + $shipment->collect_and_deposit_amount;
                    }
                }
            }
        }

        return view('admin.receiving.shipment.index')
            ->with('statistics', $statistics)
            ->with('riderId', $riderId)
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

            $status = 'arrived-at-hq';
            $remarks = 'shipment arrived at warehouse';

            if ($request->get('status') === 'successfully-delivered'
                || $request->get('status') === 'returned') {


                $data = [
                    'status' => $request->get('status')
                ];
                if ($request->get('status') === 'successfully-delivered') {
                    $data['pod_date'] = Carbon::today('Asia/Manila')->toDateTimeString();
                }

                Shipment::where('id', $waybill->shipment_id)
                    ->update($data);

                $status = 'successfully-delivered';
                $remarks = 'shipment delivered successfully';

                // Check if returned item
                if ($request->get('status') === 'returned') {
                    // Save return log
                    ShipmentReturnLogs::create([
                        'shipment_id'   => $waybill->shipment_id,
                        'user_id'       => $riderId,
                        'reason'        => $request->has('reason') ? $request->get('reason') : ''
                    ]);

                    // Update Assignment
                    ShipmentAssignment::where('shipment_id', $waybill->shipment_id)
                        ->where('user_id', $riderId)
                        ->update(['status' => 'completed', 'action' => 'returned']);

                    $status = 'returned';
                    $remarks = 'failed to deliver shipment';
                }

                if ($request->get('status') === 'successfully-delivered') {
                    // Update Assignment
                    ShipmentAssignment::where('shipment_id', $waybill->shipment_id)
                        ->where('user_id', $riderId)
                        ->update(['status' => 'completed']);
                }
            }

            if ($request->get('status') === 'arrived-at-hq') {
                Shipment::where('id', $waybill->shipment_id)
                    ->update(['status' => $request->get('status')]);

                $shipment = ShipmentAssignment::create([
                    'shipment_id' => $waybill->shipment_id,
                    'user_id'     => $riderId,
                    'status'      => 'completed'
                ]);

                $shipment->delete();

                $status = 'arrived-at-hq';
                $remarks = 'shipment arrived at warehouse';
            }

            // Record Event
            ShipmentEvent::create([
                'shipment_id'   => $waybill->shipment_id,
                'event_source'  => 'warehouse',
                'event'         => 'status_change',
                'value'         => $status,
                'remarks'       => $remarks,
                'user_id'       => $request->user()->id
            ]);
        }

        return redirect()->back();
    }

    public function remitShipments(Request $request, $riderId)
    {
        $result = [];
        $shipments = $request->get('shipments');

        foreach ($shipments as $shipment) {
            // Check waybill
            $waybill = Shipment::where('id', $shipment['shipment_id'])
                ->first();

            // waybill not existing
            if (! $waybill) {
                continue;
            }

            $status = $shipment['status'];

            $remarks = 'Arrived at hq';

            if ($status === 'successfully-delivered') {

                $data = [
                    'status' => $status,
                    'pod_date'  => Carbon::today('Asia/Manila')->toDateTimeString()
                ];

                $waybill->update($data);

                // Update Assignment
                ShipmentAssignment::where('shipment_id', $waybill->id)
                    ->where('user_id', $riderId)
                    ->update(['status' => 'completed']);

                $remarks = 'Successfully delivered shipment';

                // Adjust cod
                if ($waybill->collect_and_deposit) {
                    ShipmentCod::where('shipment_id', $waybill->id)
                        ->update(['remitted_amount' => $shipment['remitted_amount']]);
                }
            } else if ($status === 'arrived-at-hq' || $status === 'pending') {
                $data = [
                    'status' => 'arrived-at-hq',
                ];

                $waybill->update($data);
                $remarks = 'Arrived at hq';

                // Create assignment
                $shipment = ShipmentAssignment::create([
                    'shipment_id' => $waybill->id,
                    'user_id'     => $riderId,
                    'status'      => 'completed'
                ]);

                $shipment->delete();
                $status = 'arrived-at-hq';
            } else {
                return response()->json(['invalid status'], 400);
            }

            // Record Event
            ShipmentEvent::create([
                'shipment_id'   => $waybill->id,
                'event_source'  => 'warehouse',
                'event'         => 'status_change',
                'value'         => $status,
                'remarks'       => $remarks,
                'user_id'       => $request->user()->id
            ]);

            $result[] = $waybill;
        }

        return response()->json($result, 200);
    }

    public function doNewRemit(Request $request, $riderId)
    {
        foreach ($request->get('waybills') as $waybill) {
            $data = [
                'user_id'       => 0,
                'source_id'     => 2,
                'service_type'  => 'metro_manila',
                'is_international'  => 'postal',
                'status'        => 'arrived-at-hq',
                'charge_to'     => 'sender',
                'pay_thru'      => 'cash',
                'package_type'  => 'own-packaging',
                'from'          => 0,
                'to'            => 0
            ];

            $shipment = Shipment::create($data);
            $shipment->trackingNumbers()->create([
                'tracking_number'   => $waybill,
                'provider'          => 'cliqnship'
            ]);

            if ($request->get('status') === 'arrived-at-hq') {

                $shipment = ShipmentAssignment::create([
                    'shipment_id' => $shipment->id,
                    'user_id'     => $riderId,
                    'status'      => 'completed'
                ]);

                $shipment->delete();

                $status = 'arrived-at-hq';
                $remarks = 'shipment arrived at warehouse';
            }

            // Record Event
            ShipmentEvent::create([
                'shipment_id'   => $shipment->id,
                'event_source'  => 'warehouse',
                'event'         => 'status_change',
                'value'         => 'arrived-at-hq',
                'remarks'       => 'Created a new blank shipment',
                'user_id'       => $request->user()->id
            ]);
        }

        return redirect()->back();
    }
}