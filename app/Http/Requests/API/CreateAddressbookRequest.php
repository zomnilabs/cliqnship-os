<?php

namespace App\Http\Requests\API;

class CreateAddressbookRequest extends AbstractAPIRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'identifier'        => 'required',
            'type'              => 'required|in:booking,shipment',
            'first_name'        => 'required',
            'last_name'         => 'required',
            'contact_number'    => 'required',
            'email'             => 'email',
            'address_line_1'    => 'required',
            'city'              => 'required',
            'province'          => 'required',
            'zip_code'          => 'required',
            'address_type'      => 'in:office,residential'
        ];
    }
}
