<?php
namespace App\Http\Controllers\Admin\Dispatching;

use App\Http\Controllers\Controller;
use App\Models\Shipment;

class ShipmentsController extends Controller {
    public function all()
    {
        $shipments = Shipment::with('user','address','source')
            ->get();

        return view('admin.dispatching.shipments.all')
            ->with('shipments',$shipments);
    }
    public function returned()
    {
        return view('admin.dispatching.shipments.returned');
    }
}