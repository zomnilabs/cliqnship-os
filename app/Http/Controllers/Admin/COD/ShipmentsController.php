<?php
namespace App\Http\Controllers\Admin\COD;

use App\Http\Controllers\Controller;
use App\Models\Shipment;

class ShipmentsController extends Controller {
    public function all()
    {
//        $shipments =

       return view('admin.cod.shipments.index');
    }
}