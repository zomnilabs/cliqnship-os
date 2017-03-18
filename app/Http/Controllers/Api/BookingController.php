<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller {

    public function store(Request $request)
    {
        $input = $request->all();

        $booking = null;
        // Create the booking
        \DB::transaction(function() use ($input, &$booking) {
            $input['booking_no'] = strtoupper(uniqid());
            $input['source_id'] = "2";
            $input['status'] = "pending";

            $data = Booking::create($input);

            $booking = Booking::with('address')->where('id', $data->id)->first();
        });

        return response()->json($booking, 201);
    }
}