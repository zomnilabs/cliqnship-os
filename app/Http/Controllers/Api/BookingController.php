<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingAssignment;
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

    public function updateRider(Request $request, $bookingId)
    {
        $booking = Booking::find($bookingId);

        if (! $booking) {
            return response()->json(['no booking found'], 404);
        }

        $input = $request->all();

        $assignment = BookingAssignment::create([
            'user_id'       => $input['rider_id'],
            'booking_id'    => $bookingId,
            'status'        => 'pending'
        ]);

        if (! $assignment) {
            return response()->json(['failed to assign'], 400);
        }

        $booking->status = 'accepted';
        $booking->save();

        return response()->json($booking, 201);
    }
}