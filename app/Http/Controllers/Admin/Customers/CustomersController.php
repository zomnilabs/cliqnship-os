<?php
namespace App\Http\Controllers\Admin\Customers;

use App\Http\Controllers\Controller;

class CustomersController extends Controller
{
    public function index()
    {
        return view('admin.customers.index');
    }
}