<?php

namespace App\Http\Requests\API;

class CreateBookingRequest extends AbstractAPIRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $input = $this->all();

        if (isset($input['address']['id'])) {
            return [
                'address.id'        => 'exists:user_addressbooks,id',
                'pickup_date'       => 'required|date'
            ];
        } else {
            return [
                'address.identifier'        => 'required',
                'address.type'              => 'required|in:booking,shipment',
                'address.first_name'        => 'required',
                'address.last_name'         => 'required',
                'address.contact_number'    => 'required',
                'address.email'             => 'email',
                'address.address_line_1'    => 'required',
                'address.city'              => 'required',
                'address.province'          => 'required',
                'address.zip_code'          => 'required',
                'address.address_type'      => 'in:office,residential',
                'pickup_date'               => 'required|date'
            ];
        }
    }
}
