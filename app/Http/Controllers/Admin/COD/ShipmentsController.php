<?php
namespace App\Http\Controllers\Admin\COD;

use App\Http\Controllers\Controller;
use App\Models\Shipment;

class ShipmentsController extends Controller {
    public function all()
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

       return view('admin.cod.shipments.index', compact('shipments', 'amounts'));
    }
}