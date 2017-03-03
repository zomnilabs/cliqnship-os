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
            'type' => 'required',
            'firstname' => 'required|string|min:2|max:56',
            'middlename' => 'required|string|min:1|max:56',
            'lastname' => 'required|string|min:2|max:56',
            'contact_number' => 'required',
            'email' => 'required|email|max:56',
            'address_line_1' => 'required|min:5',
            'address_line_2' => 'required|min:5',
            'barangay' => 'required',
            'city' => 'required',
            'province' => 'required',
            'zip_code' => 'required',
            'country' => 'required',
            'address_type' => 'required',
            'landmarks' => 'required'
        ];
    }
}
