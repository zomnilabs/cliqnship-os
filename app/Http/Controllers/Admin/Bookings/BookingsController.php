<?php
namespace App\Http\Controllers\Admin\Bookings;

use App\Http\Controllers\Controller;

class BookingsController extends Controller
{
    public function index()
    {
        // Display bookings
        return view('admin.bookings.index');
    }
}