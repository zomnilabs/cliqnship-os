<?php
namespace App\Http\Controllers\Admin\Dispatching;

use App\Http\Controllers\Controller;

class BookingsController extends Controller {
    public function index()
    {
        return view('admin.dispatching.bookings');
    }
}