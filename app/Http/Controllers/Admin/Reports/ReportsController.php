<?php
namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\ShipmentAssignment;
use App\Models\ShipmentEvent;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function shipmentAge()
    {
        $shipments = Shipment::where(function($q) {
            $q->where('status', 'arrived-at-hq')
                ->orWhere('status', 'returned');
        })->get();

        $results = [];
        foreach ($shipments as $shipment) {
            $arrivalDate = $this->getFirstArrivalDate($shipment->id);

            if (! $arrivalDate) {
                continue;
            }

            $age = Carbon::createFromTimestamp(strtotime($arrivalDate))->diffForHumans();

            $results[] = [
                'waybill_number'    => $shipment->trackingNumbers()->mainTrackingNumber()->tracking_number,
                'arrival_date'      => $arrivalDate,
                'age'               => $age
            ];
        }

        $shipments = $results;

        return view('admin.reports.items.shipment-age', compact('shipments'));
    }

    public function dispatching(Request $request)
    {
        $user = $request->get('user_id');
        $date = Carbon::today('Asia/Manila')->toDateString();

        if ($request->has('date')) {
            $date = Carbon::createFromTimestamp(strtotime($request->get('date')))->toDateString();
        }

        $riders = User::where('user_group_id', 4)
            ->get();

        $result = [];
        if (! $request->has('user_id') || $request->get('user_id') === 0) {
            foreach ($riders->toArray() as $key => $value) {
                $riders[$key]['assignments'] = ShipmentAssignment::withTrashed()
                    ->where('user_id', $value['id'])
                    ->whereDate('created_at', $date)
                    ->get();
            }

            $result = $riders;
        } else {
            $rider = User::where('user_group_id', 4)
                ->where('id', $user)
                ->first();

            $rider['assignments'] = ShipmentAssignment::withTrashed()
                ->where('user_id', $rider->id)
                ->whereDate('created_at', $date)
                ->get();

            $result[] = $rider;
        }

        return view('admin.reports.items.dispatch', compact('assignment', 'riders', 'result'));
    }

    private function getFirstArrivalDate($shipmentId)
    {
        $event = ShipmentEvent::where('shipment_id', $shipmentId)
            ->where('event', 'status_change')
            ->where('value', 'arrived-at-hq')
            ->first();

        return $event ? $event->created_at : null;
    }
}