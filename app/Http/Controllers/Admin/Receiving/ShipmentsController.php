<?php
namespace App\Http\Controllers\Admin\Receiving;

use App\Http\Controllers\Controller;
use App\Models\Shipment;

class ShipmentsController extends Controller {
    public function all()
    {
        return view('admin.receiving.shipment');
    }

    public function remit()
    {
        return view('admin.receiving.shipment.index');
    }
}