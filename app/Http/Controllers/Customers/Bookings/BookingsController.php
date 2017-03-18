<?php
namespace App\Http\Controllers\Customers\Bookings;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\UserAddressbook;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingsController extends Controller {
    public function index(Request $request)
    {
        $user = $request->user()->toArray();
        $bookings = Booking::with('address')
            ->where('user_id', $user['id'])
            ->get();

        return view('customers.bookings.index')
            ->with('bookings', $bookings);
    }

    public function importBookings(Request $request)
    {
        if (! $request->hasFile('file')) {
            return redirect()->back();
        }

        $user = $request->user()->toArray();
        $file = $request->file('file');
        \Excel::load($file, function($reader) use ($user) {
            $results = $reader->get();

            foreach ($results as $booking) {
                if (! (isset($booking['contact_person_first_name']) && $booking['contact_person_first_name'])) {
                    $this->importWithPrimaryAddress($booking, $user);
                    continue;
                }

                $this->importWithNewAddress($booking, $user);
            }
        });
    }

    private function importWithNewAddress($booking, $user)
    {
        \DB::transaction(function() use ($booking, $user) {
            $address = [
                'user_id'       => $user['id'],
                'first_name'    => $booking['contact_person_first_name'],
                'last_name'     => $booking['contact_person_last_name'],
                'contact_number'    => $booking['contact_person_contact_number'],
                'email'             => $booking['email'],
                'address_line_1'    => $booking['address_line_1'],
                'barangay'          => $booking['barangay'],
                'city'              => $booking['city'],
                'province'          => $booking['province'],
                'zip_code'          => $booking['zip_code'],
                'land_marks'        => $booking['land_marks'],
            ];

            $addressbook = UserAddressbook::create($address);

            $bookingData = [
                'source_id'         => 2,
                'user_id'           => $user['id'],
                'user_addressbook_id'   => $addressbook->id,
                'booking_no'        => strtoupper(uniqid()),
                'pickup_date'       => Carbon::createFromTimestamp(strtotime($booking['pickup_date']))->toDateString(),
                'number_of_items'   => $booking['number_of_items'],
                'type_of_items'     => $booking['type_of_items'],
                'length'            => $booking['length'],
                'width'             => $booking['width'],
                'height'            => $booking['height'],
                'weight'            => $booking['weight'],
                'remarks'           => $booking['remarks'],
                'status'            => 'pending'
            ];

            Booking::create($bookingData);
        });
    }

    private function importWithPrimaryAddress($booking, $user)
    {
        \DB::transaction(function() use ($booking, $user) {
            $addressbook = UserAddressbook::where('user_id', $user['id'])
                ->where('primary', 1)->first();

            $bookingData = [
                'source_id'         => 2,
                'user_id'           => $user['id'],
                'user_addressbook_id'   => $addressbook->id,
                'booking_no'        => strtoupper(uniqid()),
                'pickup_date'       => Carbon::createFromTimestamp(strtotime($booking['pickup_date']))->toDateString(),
                'number_of_items'   => $booking['number_of_items'],
                'type_of_items'     => $booking['type_of_items'],
                'length'            => $booking['length'],
                'width'             => $booking['width'],
                'height'            => $booking['height'],
                'weight'            => $booking['weight'],
                'remarks'           => $booking['remarks'],
                'status'            => 'pending'
            ];

            Booking::create($bookingData);
        });
    }

    public function destroy(Booking $bookingId)
    {
        $bookingId->delete();
    }
}