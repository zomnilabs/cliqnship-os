<?php
namespace App\Http\Controllers\Customers\Addressbooks;

use App\Http\Controllers\Controller;

class AddressbooksController extends Controller {
    public function index()
    {
        return view('customers.addressbooks.index');
    }
}