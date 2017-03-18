<?php
namespace App\Http\Controllers\Admin\Dispatching;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingAssignment;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingsController extends Controller {
    public function index(Request $request)
    {
        $today = Carbon::today();
        $status = 'pending';

        if ($request->has('status')) {
            $status = $request->get('status');
        }

        if ($request->has('date')) {
            $today = Carbon::createFromTimestamp(strtotime($request->get('date')));
        }

        if ($request->has('user_id')) {
            $bookingsAssignments = BookingAssignment::where('user_id', $request->get('user_id'))->get();
            $ids = [];
            foreach ($bookingsAssignments as $assignment) {
                $ids[] = $assignment->booking_id;
            }

            $bookings = Booking::with('assignment')
                ->whereDate('pickup_date', '=', $today->toDateString())
                ->where('status', $status)
                ->whereIn('id', $ids)
                ->get();

        } else {
            $bookings = Booking::with('assignment')
                ->whereDate('pickup_date', '=', $today->toDateString())
                ->where('status', $status)
                ->get();
        }

        // Riders
        $riders = User::with('profile')
            ->where('user_group_id', 4)
            ->get();

        return view('admin.dispatching.bookings')
            ->with('bookings', $bookings)
            ->with('riders', $riders);
    }
}