<?php
namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\UserAddressbook;
use App\Models\Shipment;
use Illuminate\Http\Request;

class DashboardController extends Controller {
    public function index(Request $request)
    {
        $user = $request->user()->toArray();

        $withPrimaryAddress = false;
        if ($this->havePrimaryAddress($user['id'])) {
            $withPrimaryAddress = true;
        }

        $pendingBookings = Booking::where('status', 'pending')
            ->where('user_id', $user['id'])
            ->count();

        $pendingShipments = Shipment::where('status', 'pending')
            ->where('user_id', $user['id'])
            ->count();

        $enRouteShipments = Shipment::where('status', 'enroute')
            ->where('user_id', $user['id'])
            ->count();

        $completedShipments = Shipment::where('status', 'completed')
            ->where('user_id', $user['id'])
            ->count();

        $returnedShipments = Shipment::where('status', 'returned')
            ->where('user_id', $user['id'])
            ->count();

        $codAmount = Shipment::where('collect_and_deposit', 1)
            ->where('user_id', $user['id'])
            ->join('shipment_cods', 'shipments.id', '=', 'shipment_cods.shipment_id')
            ->select(\DB::raw('SUM(shipment_cods.collect_and_deposit_amount) as amount'))
            ->first();

        $counts = [
            'pendingBookings'   => $pendingBookings,
            'pendingShipments'  => $pendingShipments,
            'enRouteShipments'  => $enRouteShipments,
            'completedShipments'    => $completedShipments,
            'returnedShipments' => $returnedShipments,
            'codAmount'         => $codAmount->amount
        ];

        $shipments = Shipment::where('user_id', $user['id'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $cods = Shipment::where('collect_and_deposit', 1)
            ->where('user_id', $user['id'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('customers.dashboard')
            ->with('withPrimaryAddress', $withPrimaryAddress)
            ->with('counts', $counts)
            ->with('shipments', $shipments)
            ->with('cods', $cods);
    }

    private function havePrimaryAddress($userId)
    {
        $addressbook = UserAddressbook::where('primary', 1)
            ->where('user_id', $userId)->count();

        return $addressbook;
    }
}