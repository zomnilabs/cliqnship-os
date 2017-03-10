<?php

namespace App\Http\Requests\Admin\Riders;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'email'      => 'required|email|max:56|unique:users,email,' .$this->getSegmentFromEnd().',id',
            'password'   => 'required',
            'first_name' =>'required',
            'middle_name'=>'required',
            'last_name'  => 'required',
            'birthdate'  => 'required'
        ];
    }

    private function getSegmentFromEnd($position_from_end = 1) {
        $segments =$this->segments();
        return $segments[sizeof($segments) - $position_from_end];
    }
}
