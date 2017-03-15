<?php

namespace App\Http\Requests\Addressbooks;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressbookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'identifier' => 'required',
            'type' => 'required|in:booking,shipment',
            'first_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2',
            'middle_name' => 'required|string|min:2',
            'contact_number' => 'required',
            'email' => 'required|email',
            'address_line_1' => 'required|min:2',
            'barangay' => 'required|min:2',
            'city' => 'required',
            'country' => 'required',
            'province' => 'required',
            'zip_code' => 'required',
            'address_type' => 'required|in:residential,office',
        ];
    }
}
