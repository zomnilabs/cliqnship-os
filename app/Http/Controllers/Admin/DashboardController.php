<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ItemRequest;
use App\Models\Booking;
use App\Models\Shipment;

class DashboardController extends Controller {
    public function index()
    {
        $pendingBookings = Booking::where('status', 'pending')
            ->count();

        $pendingShipments = Shipment::where('status', 'pending')
            ->count();

        $enRouteShipments = Shipment::where('status', 'enroute')
            ->count();

        $completedShipments = Shipment::where('status', 'completed')
            ->count();

        $returnedShipments = Shipment::where('status', 'returned')
            ->count();

        $pendingItemRequests = ItemRequest::where('status', 'pending')
            ->count();

        $counts = [
            'pendingBookings'   => $pendingBookings,
            'pendingShipments'  => $pendingShipments,
            'enRouteShipments'  => $enRouteShipments,
            'completedShipments'    => $completedShipments,
            'returnedShipments' => $returnedShipments,
            'pendingItemRequests'   => $pendingItemRequests
        ];

        return view('admin.dashboard')
            ->witH('counts', $counts);
    }
}