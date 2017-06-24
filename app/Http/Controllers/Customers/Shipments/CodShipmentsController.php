<?php
namespace App\Http\Controllers\Customers\Shipments;

use App\Http\Controllers\Controller;
use App\Models\Shipment;

class CodShipmentsController extends Controller {
    public function index()
    {
        $shipments = Shipment::with('cod')->has('cod')
            ->where('collect_and_deposit', 1)
            ->where('status', '<>', 'pending')
            ->get();

        $amounts = [
            'pending'   => 0,
            'collected' => 0,
            'deposited' => 0
        ];

        foreach ($shipments as $shipment) {
            $amounts[$shipment->cod->status] += $shipment->cod->collect_and_deposit_amount;
        }

        return view('customers.shipments.cod.index', compact('shipments', 'amounts'));
    }
}