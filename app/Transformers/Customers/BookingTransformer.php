<?php
namespace App\Transformers\Customers;

use App\Models\Booking;
use App\Transformers\Transformerable;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class BookingTransformer extends TransformerAbstract implements Transformerable
{
    /**
     * Transform user object
     *
     * @param Booking $booking
     * @return array
     */
    public function transform($booking)
    {
        $booking = Booking::find($booking->id);

        return [
            'id'            => (int) $booking->id,
            'user_id'       => (int) $booking->user_id,
            'pickup_date'   => Carbon::createFromTimestamp(strtotime($booking->pickup_date))->toDateString(),
            'source'    => [
                'id'    => $booking->source->id,
                'name'  => $booking->source->name
            ],
            'address'   => [
                'id'                => $booking->address->id,
                'user_id'           => $booking->address->user_id,
                'identifier'        => $booking->address->identifier,
                'type'              => $booking->address->type,
                'first_name'        => $booking->address->first_name,
                'last_name'         => $booking->address->last_name,
                'middle_name'       => $booking->address->middle_name,
                'contact_number'    => $booking->address->contact_number,
                'email'             => $booking->address->email,
                'address_line_1'    => $booking->address->address_line_1,
                'address_line_2'    => $booking->address->address_line_2,
                'barangay'          => $booking->address->barangay,
                'city'              => $booking->address->city,
                'province'          => $booking->address->province,
                'zip_code'          => $booking->address->zip_code,
                'country'           => $booking->address->country,
                'address_type'      => $booking->address->address_type,
                'landmarks'         => $booking->address->landmarks,
                'primary'           => $booking->address->primary
            ],
            'number_of_items'   => $booking->number_of_items,
            'type_of_items'     => $booking->type_of_items,
            'length'            => $booking->length,
            'width'             => $booking->width,
            'height'            => $booking->height,
            'weight'            => $booking->weight,
            'remarks'   => $booking->remarks,
            'status'    => $booking->status,
            'links'   => [
                [
                    'rel' => 'self',
                    'uri' => url('/api/v1/customers/'.$booking->user_id.'/bookings/'.$booking->id),
                ],
                [
                    'rel' => 'owner',
                    'uri' => url('/api/v1/customers/'.$booking->user_id),
                ],
                [
                    'rel' => 'pickup-address',
                    'uri' => url('/api/v1/customers/'.$booking->user_id.'/addressbooks/'.$booking->user_addressbook_id),
                ]
            ]
        ];
    }
}