<?php
namespace App\Http\Controllers\Customers\Shipments;

use App\Http\Controllers\Controller;

class ReturnShipmentsController extends Controller {
    public function index()
    {
        return view('customers.shipments.return.index');
    }
}