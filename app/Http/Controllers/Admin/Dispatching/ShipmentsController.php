<?php
namespace App\Http\Controllers\Admin\Dispatching;

use App\Http\Controllers\Controller;

class ShipmentsController extends Controller {
    public function index()
    {
        return view('admin.dispatching.shipments');
    }
}