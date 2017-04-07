<?php
namespace App\Http\Controllers\Customers\Shipments;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentsController extends Controller {
    public function index(Request $request)
    {
        $user = $request->user()->toArray();

        $shipments = Shipment::with('trackingNumbers')
            ->where('user_id', $user['id'])
            ->get();

        return view('customers.shipments.index')
            ->with('shipments', $shipments);
    }

    public function preview()
    {
        return view('print.waybill');
    }
}