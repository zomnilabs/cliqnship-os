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

            $bookings = Booking::with('assignment','source')
                ->where('status', $status)
                ->whereIn('id', $ids)
                ->orderBy('pickup_date', 'DESC')
                ->get();

        } else {
            $bookings = Booking::with('assignment','source')
                ->where('status', $status)
                ->orderBy('pickup_date', 'DESC')
                ->get();
        }

        $pendingBooking = Booking::where('status', 'pending')
            ->whereDate('pickup_date', '<=', $today->toDateString())
            ->count();

        $completedBooking = Booking::where('status', 'completed')
            ->whereDate('pickup_date', '=', $today->toDateString())
            ->count();

        $assignedBooking = Booking::whereHas('assignment', function($q) {
            $q->where('status', 'pending');
        })
//            ->whereDate('pickup_date', '=', $today->toDateString())
            ->where('status', 'accepted')
            ->count();

        $rejectedBooking = Booking::whereDate('pickup_date', '=', $today->toDateString())
            ->where('status', 'rejected')
            ->count();

        // Riders
        $riders = User::with('profile')
            ->where('user_group_id', 4)
            ->get();

        return view('admin.dispatching.bookings')
            ->with('bookings', $bookings)
            ->with('pendingBooking', $pendingBooking)
            ->with('completedBooking', $completedBooking)
            ->with('assignedBooking', $assignedBooking)
            ->with('rejectedBooking', $rejectedBooking)
            ->with('riders', $riders);
    }

    public function attachToRider()
    {

    }
}