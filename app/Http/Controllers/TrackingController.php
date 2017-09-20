<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\ShipmentEvent;
use App\Models\ShipmentTrackingNumber;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function tracking(Request $request)
    {
        if (! $request->has('waybill')) {
            return view('tracking')
                ->with('shipment', null)
                ->with('events', null);
        }

        $trackingNumber = $request->get('waybill');

        $tracking = ShipmentTrackingNumber::where('tracking_number', $trackingNumber)
            ->where('provider', 'cliqnship')
            ->first();

        if (! $tracking) {
            return view('tracking')
                ->with('shipment', null)
                ->with('events', null);
        }

        $shipment = Shipment::where('id', $tracking->shipment_id)->first();
        $events = $this->getEvents($tracking);

        return view('tracking')
            ->with('shipment', $shipment)
            ->with('events', $events);
    }

    private function getEvents($tracking)
    {
        if (! $tracking) {
            return null;
        }

        $events = ShipmentEvent::where('shipment_id', $tracking->shipment_id)
            ->where('event_source', '<>', 'customer')
            ->where('event', 'status_change')
            ->orderBy('created_at', 'DESC')
            ->get();

        $result = [];
        foreach ($events as $event) {
            $result[] = [
                'tracking_number'   => $tracking->tracking_number,
                'shipment_id'       => $event->shipment_id,
                'event'             => $event['event'],
                'value'             => str_replace('-', ' ', $event['value']),
                'remarks'           => $event['remarks'],
                'date'              => $event['created_at']->toFormattedDateString()
            ];
        }

        return $result;
    }
}