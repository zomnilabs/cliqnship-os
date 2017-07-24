<?php
namespace App\Http\Controllers\Customers\Shipments;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Illuminate\Http\Request;

class CodShipmentsController extends Controller {
    public function index(Request $request)
    {
        $user = $request->user();
        $shipments = Shipment::with('cod')->has('cod')
            ->where('collect_and_deposit', 1)
            ->where('status', '<>', 'pending')
            ->where('user_id', $user->id)
            ->get();

        $amounts = [
            'pending'   => 0,
            'collected' => 0,
            'deposited' => 0
        ];

        foreach ($shipments as $shipment) {
            if ($shipment->cod->status === 'collected') {
                $amounts['collected'] += $shipment->cod->remitted_amount;
            } else {
                $amounts[$shipment->cod->status] += $shipment->cod->collect_and_deposit_amount;
            }
        }

        return view('customers.shipments.cod.index', compact('shipments', 'amounts'));
    }
}