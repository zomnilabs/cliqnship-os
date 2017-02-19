<?php
namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;

class DashboardController extends Controller {
    public function index()
    {
        return view('customers.dashboard');
    }
}