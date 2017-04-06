<?php
namespace App\Http\Controllers\Api\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingsController extends Controller {
    public function all(Request $request)
    {
        $user = $request->user();
    }

    public function findById($bookingId)
    {

    }

    public function createBooking()
    {

    }

    public function updateBooking($bookingId)
    {

    }

    public function updateStatus($bookingId)
    {

    }
}