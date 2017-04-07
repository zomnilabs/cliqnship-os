<?php
namespace App\Http\Controllers\Admin\Shipments;

use App\Http\Controllers\Controller;
use App\Models\Shipment;

class ShipmentsController extends Controller
{
    public function index()
    {
    	$shipments = Shipment::with('trackingNumbers')->get();

        return view('admin.shipments.index')
            ->with('shipments', $shipments);
    }
    
    public function preview()
    {
        return view('print.waybill');
    }
}