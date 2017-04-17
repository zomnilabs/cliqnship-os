<?php

namespace App\Http\Requests\API;

class CustomerRegistrationRequests extends AbstractAPIRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'         => 'required|email',
            'password'      => 'required|min:3',
            'first_name'    => 'required',
            'last_name'     => 'required',
            'image.id'      => 'exists:images,id'
        ];
    }
}
