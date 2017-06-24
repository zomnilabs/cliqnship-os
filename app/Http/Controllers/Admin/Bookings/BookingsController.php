<?php
namespace App\Http\Controllers\Admin\Bookings;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class BookingsController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('address')->get();

        // Display bookings
        return view('admin.bookings.index', compact('bookings'));
    }
}