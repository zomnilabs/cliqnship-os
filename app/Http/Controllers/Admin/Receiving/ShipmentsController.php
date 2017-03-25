<?php
namespace App\Http\Controllers\Admin\Receiving;

use App\Http\Controllers\Controller;

class ShipmentsController extends Controller {
    public function all()
    {
        return view('admin.dispatching.shipments.all');
    }
    public function returned()
    {
        return view('admin.dispatching.shipments.returned');
    }
}