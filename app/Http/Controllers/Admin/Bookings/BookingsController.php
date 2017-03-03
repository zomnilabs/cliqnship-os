<?php
namespace App\Http\Controllers\Admin\Bookings;

use App\Http\Controllers\Controller;

class BookingsController extends Controller
{
    public function index()
    {
        return view('admin.bookings.index');
    }
}