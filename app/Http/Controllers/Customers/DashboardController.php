<?php
namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\UserAddressbook;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

    public function getMonthlyShipments(Request $request)
    {
        $user = $request->user();
        $currentYear = Carbon::today('Asia/Manila')->year;

        $months = ['January', 'February', 'March', 'April', 
            'May', 'June', 'July', 'August', 'September', 
            'October', 'November', 'December'];

        $shipments = Shipment::whereRaw('year(created_at) = ?', $currentYear)
            ->where('user_id', $user->id)
            ->where(function($q) {
                $q->where('status', 'successfully-delivered')
                    ->orWhere('status', 'returned');
            })
            ->get();

        $result = [];
        foreach ($shipments as $shipment) {
            $monthInNumber = Carbon::createFromTimestamp(strtotime($shipment->created_at))->month;
            $month = $months[$monthInNumber - 1];

            if (! isset($result[$month])) {
                $result[$month] = [
                    'success'    => 0,
                    'returned'                  => 0
                ];
            }

            if ($shipment->status === 'successfully-delivered') {
                if (isset($result[$month]['success'])) {
                    $result[$month]['success'] = $result[$month]['success'] + 1;
                } else {
                    $result[$month]['success'] = 0;
                }
            } else if ($shipment->status === 'returned') {
                if (isset($result[$month]['returned'])) {
                    $result[$month]['returned'] = $result[$month]['returned'] + 1;
                } else {
                    $result[$month]['returned'] = 0;
                }
            }
        }

        $finalResult = [
            'success'   => [],
            'returned'  => []
        ];

        foreach ($months as $month) {
            $finalResult['success'][]  = isset($result[$month]) ? $result[$month]['success'] : 0;
            $finalResult['returned'][]  = isset($result[$month]) ? $result[$month]['returned'] : 0;
        }

        return response()->json($finalResult, 200);
    }

    public function getTopFiveAddresses(Request $request)
    {
        $user = $request->user();

        $shipments = Shipment::select(\DB::raw('`to` as address, COUNT(*) as shipment_count'))
            ->where('user_id', $user->id)
            ->groupBy('to')
            ->orderBy('shipment_count', 'DESC')
            ->limit(5)
            ->get();

        $result = [];
        foreach ($shipments as $shipment) {
            $address = UserAddressbook::where('id', $shipment->address)
                ->first();

            $result['customers'][] = $address->identifier;
            $result['counts'][] = $shipment->shipment_count;
        }

        return response()->json($result, 200);
    }

    private function havePrimaryAddress($userId)
    {
        $addressbook = UserAddressbook::where('primary', 1)
            ->where('user_id', $userId)->count();

        return $addressbook;
    }
}