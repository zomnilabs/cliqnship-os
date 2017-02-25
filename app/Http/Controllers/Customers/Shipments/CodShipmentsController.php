<?php
namespace App\Http\Controllers\Customers\Shipments;

use App\Http\Controllers\Controller;

class CodShipmentsController extends Controller {
    public function index()
    {
        return view('customers.shipments.cod.index');
    }
}