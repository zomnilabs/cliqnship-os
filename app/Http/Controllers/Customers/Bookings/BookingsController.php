<?php
namespace App\Http\Controllers\Customers\Bookings;

use App\Http\Controllers\Controller;

class BookingsController extends Controller {
    public function index()
    {
        return view('customers.bookings.index');
    }
}