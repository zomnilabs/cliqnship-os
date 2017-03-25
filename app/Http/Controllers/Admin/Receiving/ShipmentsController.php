<?php
namespace App\Http\Controllers\Admin\Receiving;

use App\Http\Controllers\Controller;
use App\Models\Shipment;

class ShipmentsController extends Controller {
    public function all()
    {
        $shipments = Shipment::with('user','address','source')
            ->get();

        return view('admin.receiving.shipment')
            ->with('shipments',$shipments);
    }
}