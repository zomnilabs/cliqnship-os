<?php
namespace App\Http\Controllers\Api\Customers;

use App\Http\Controllers\Api\AbstractAPIController;
use App\Http\Requests\API\CreateBookingRequest;
use App\Models\Booking;
use App\Models\UserAddressbook;
use App\Traits\ApiResponse;
use App\Transformers\Customers\BookingTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingsController extends AbstractAPIController {
    use ApiResponse;

    /**
     * Get all the bookings of a customer
     *
     * @param Request $request
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function all(Request $request, $userId)
    {
        // Check user
        if ($request->user()->id !== (int)$userId) {
            return $this->responseUnauthorized();
        }

        // Get filters
        $filters = $this->getFilters($request, Booking::$filterables);

        // Create query
        $model = Booking::where('user_id', $userId)->getQuery();
        $paginator = $this->filter($model, $filters);

        // Transform Result
        $result = $this->transformCollection($paginator, new BookingTransformer);

        // Return response
        return $this->responseOk($result->toArray());
    }

    /**
     * Get a specific booking of a customer
     *
     * @param Request $request
     * @param $userId
     * @param $bookingId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $userId, $bookingId)
    {
        // Check user
        if ($request->user()->id !== (int)$userId) {
            return $this->responseUnauthorized();
        }

        // Get filters
        $filters = $this->getFilters($request, Booking::$filterables);

        // Create query
        $booking = Booking::where('user_id', $userId)
            ->where('id', $bookingId)
            ->first();

        if (! $booking) {
            return $this->responseNotFound();
        }

        // Transform Result
        $result = $this->transformItem($booking, new BookingTransformer);

        // Return response
        return $this->responseOk($result->toArray());
    }

    /**
     * Create a new booking for the customer
     *
     * @param CreateBookingRequest $request
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateBookingRequest $request, $userId)
    {
        // Check user
        if ($request->user()->id !== (int) $userId) {
            return $this->responseUnauthorized();
        }

        $input = $request->all();

        $input['user_id'] = $userId;

        $result = \DB::transaction(function() use ($input, $request, $userId) {

            // check address
            if (isset($input['address']) && is_array($input['address'])) {
                if (isset($input['address']['id'])) {
                    $address = UserAddressbook::where('id', $input['address']['id'])
                        ->where('user_id', $userId)
                        ->where('type', 'booking')->first();

                    if (! $address) {
                        throw new \Exception("Invalid address");
                    }

                    $input['address'] = $address->id;
                } else {
                    $addressData = $input['address'];
                    $addressData['user_id'] = $userId;
                    $addressData['type'] = 'booking';

                    if (isset($addressData['primary']) && $addressData['primary'] && $addressData['type'] === 'booking') {
                        $addressData['primary'] = 0;
                    }

                    $address = UserAddressbook::create($addressData);

                    // Check if newly added address is a primary address
                    if ($address->primary && $address->type === 'shipment') {
                        // Update other primary
                        UserAddressbook::where('user_id', $userId)
                            ->where('primary', 1)
                            ->where('id', '!=', $address->id)
                            ->update(['primary' => 0]);
                    }

                    $input['address'] = $address->id;
                }
            }

            // Image Upload
            $image = null;
            if ($request->hasFile('image')) {
                if (getenv('APP_ENV') === 'production') {
                    $image =  $request->file('image')->store('prod/bookings', 's3');
                } else {
                    $image =  $request->file('image')->store('dev/bookings', 's3');
                }
            }

            $bookingData = [
                'user_id'           => $input['user_id'],
                'user_addressbook_id'   => $input['address'],
                'source_id'         => 3,
                'booking_no'        => uniqid(),
                'remarks'           => isset($input['remarks']) ? $input['remarks'] : '',
                'pickup_date'       => Carbon::createFromTimestamp(strtotime($input['pickup_date'])),
                'number_of_items'   => isset($input['number_of_items']) ? $input['number_of_items'] : 0,
                'type_of_items'     => isset($input['type_of_items']) ? $input['type_of_items'] : '',
                'length'            => isset($input['length']) ? $input['length'] : 0,
                'width'             => isset($input['width']) ? $input['width'] : 0,
                'height'            => isset($input['height']) ? $input['height'] : 0,
                'weight'            => isset($input['weight']) ? $input['weight'] : 0,
                'status'            => 'pending'
            ];

            if ($image) {
                $bookingData['image'] = $image;
            }

            $result = Booking::create($bookingData);

            // Transform Result
            return $this->transformItem($result, new BookingTransformer);
        });

        if ($result instanceof \Exception) {
            return $this->responseBadRequest([$result->getMessage()]);
        }

        // Return response
        return $this->responseCreated($result->toArray());
    }

    /**
     * Update an existing booking
     *
     * @param CreateBookingRequest $request
     * @param $userId
     * @param $bookingId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CreateBookingRequest $request, $userId, $bookingId)
    {
        // Check user
        if ($request->user()->id !== (int) $userId) {
            return $this->responseUnauthorized();
        }

        // Check the status of the booking
        $booking = Booking::where('user_id', $userId)
            ->where('id', $bookingId)->first();

        if (! $booking) {
            return $this->responseNotFound(['booking is non existing']);
        }

        if ($booking->status !== 'pending') {
            return $this->responseBadRequest(['unable to update the booking, because it is not in pending status anymore']);
        }

        $input = $request->all();

        $result = null;

        \DB::transaction(function() use ($input, $userId, $bookingId, &$result, $request) {

            // check address
            if (isset($input['address']) && is_array($input['address'])) {
                if (isset($input['address']['id'])) {
                    $address = UserAddressbook::find($input['address']['id']);

                    if (! $address) {
                        return $this->responseBadRequest(['invalid selected address']);
                    }

                    $input['address'] = $address->id;
                } else {
                    $addressData = $input['address'];
                    $addressData['user_id'] = $userId;

                    if (isset($addressData['primary']) && $addressData['primary'] && $addressData['type'] === 'booking') {
                        $addressData['primary'] = 0;
                    }

                    $address = UserAddressbook::create($addressData);

                    // Check if newly added address is a primary address
                    if ($address->primary && $address->type === 'shipment') {
                        // Update other primary
                        UserAddressbook::where('user_id', $userId)
                            ->where('primary', 1)
                            ->where('id', '!=', $address->id)
                            ->update(['primary' => 0]);
                    }

                    $input['address'] = $address->id;
                }
            }

            // Image Upload
            $image = null;
            if ($request->hasFile('image')) {
                if (getenv('APP_ENV') === 'production') {
                    $image =  $request->file('image')->store('prod/bookings', 's3');
                } else {
                    $image =  $request->file('image')->store('dev/bookings', 's3');
                }
            }

            $bookingData = [
                'user_addressbook_id'   => $input['address'],
                'remarks'           => isset($input['remarks']) ? $input['remarks'] : '',
                'pickup_date'       => Carbon::createFromTimestamp(strtotime($input['pickup_date'])),
                'number_of_items'   => isset($input['number_of_items']) ? $input['number_of_items'] : 0,
                'type_of_items'     => isset($input['type_of_items']) ? $input['type_of_items'] : '',
                'length'            => isset($input['length']) ? $input['length'] : 0,
                'width'             => isset($input['width']) ? $input['width'] : 0,
                'height'            => isset($input['height']) ? $input['height'] : 0,
                'weight'            => isset($input['weight']) ? $input['weight'] : 0,
            ];

            if ($image) {
                $bookingData['image'] = $image;
            }

            $booking = Booking::where('user_id', $userId)
                ->where('id', $bookingId)
                ->update($bookingData);

            $result = Booking::find($booking->id);
        });

        // Transform Result
        $result = $this->transformItem($result, new BookingTransformer);

        // Return response
        return $this->responseCreated($result->toArray());
    }

}