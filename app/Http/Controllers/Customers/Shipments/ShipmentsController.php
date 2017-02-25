<?php
namespace App\Http\Controllers\Customers\Shipments;

use App\Http\Controllers\Controller;

class ShipmentsController extends Controller {
    public function index()
    {
        return view('customers.shipments.index');
    }
}