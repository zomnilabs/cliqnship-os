<?php
namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\ShipmentEvent;
use Carbon\Carbon;

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

    private function getFirstArrivalDate($shipmentId)
    {
        $event = ShipmentEvent::where('shipment_id', $shipmentId)
            ->where('event', 'status_change')
            ->where('value', 'arrived-at-hq')
            ->first();

        return $event ? $event->created_at : null;
    }
}