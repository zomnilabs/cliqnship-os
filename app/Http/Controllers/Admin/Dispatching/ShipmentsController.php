<?php
namespace App\Http\Controllers\Admin\Dispatching;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\ShipmentAssignment;
use App\Models\ShipmentEvent;
use App\Models\ShipmentReturnLogs;
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
                ->where('to', '<>', 0)
                ->get();
        } else {
            $shipments = Shipment::with('user','address','source', 'trackingNumbers')
                ->doesntHave('rider')
                ->where('status', 'arrived-at-hq')
                ->where('to', '<>', 0)
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

        return view('admin.dispatching.shipments.all')
            ->with('pendingShipment', $pendingShipment)
            ->with('assignedShipment', $assignedShipment)
            ->with('riders', $riders)
            ->with('status', $request->has('status') ? ucwords($request->get('status')) : 'Unassigned')
            ->with('shipments',$shipments);
    }

    public function returned()
    {
        $shipments = Shipment::with('user', 'events', 'address','source', 'trackingNumbers', 'returnLogs')
            ->where('status', 'returned')
            ->get();

        return view('admin.dispatching.shipments.returned')
            ->with('shipments', $shipments);
    }

    /**
     * Redispatch returned shipments
     *
     * @param $shipmentId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redispatch(Request $request, $shipmentId)
    {
        $input = $request->all();

        // Record Event
        ShipmentReturnLogs::create([
            'shipment_id'               => $shipmentId,
            'reason'                    => 'return logs',
            'resolution_team_remarks'   => $input['resolution_remarks'],
            'status'                    => $input['status'],
            'user_id'                   => $request->user()->id
        ]);

        return redirect()->back();
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

            $shipment = Shipment::where('id', $waybill->shipment_id)
                ->where(function($q) {
                    return $q->where('status', 'arrived-at-hq')
                        ->orWhere('status', 'enroute');
                })->first();

            // shipment invalid status
            if (! $shipment) {
                continue;
            }

            \DB::transaction(function() use ($request, $waybill) {
                // Get current assigned
                $currentAssigned = ShipmentAssignment::where('shipment_id', $waybill->shipment_id)
                    ->first();

                // Check if there is an assigned rider already
                if ($currentAssigned) {
                    // Cancel the first assignment
                    ShipmentAssignment::where('id', $currentAssigned->id)
                        ->update(['status' => 'cancelled']);

                    ShipmentAssignment::where('id', $currentAssigned->id)->delete();
                }

                // Create Assignment
                ShipmentAssignment::create([
                    'user_id'   => $request->get('rider_id'),
                    'shipment_id'   => $waybill->shipment_id,
                    'action'    => 'delivered'
                ]);

                // Update shipment
                Shipment::where('id', $waybill->shipment_id)
                    ->update(['status' => 'enroute']);

                // Record Event
                ShipmentEvent::create([
                    'shipment_id'   => $waybill->shipment_id,
                    'event_source'  => 'warehouse',
                    'event'         => 'status_change',
                    'value'         => 'enroute',
                    'remarks'       => 'dispatched shipment',
                    'user_id'       => $request->user()->id
                ]);
            });
        }

        return redirect()->to('/admin/dispatching/shipments/'.$request->get('rider_id').'/preview');
    }

    public function printDispatch($riderId)
    {
        $assignments = ShipmentAssignment::with('shipment')->where('user_id', $riderId)
            ->where('status', 'pending')
            ->get();

        $withCod = ShipmentAssignment::where('user_id', $riderId)
            ->where('status', 'pending')
            ->whereHas('shipment', function($q) {
                $q->where('collect_and_deposit', 1);
            })
            ->count();

        $rider = User::where('id', $riderId)->first();

        $regular = $assignments->count() - $withCod;

        return view('print.delivery', compact('assignments', 'withCod', 'regular', 'rider'));

    }
}