<?php

namespace App\Http\Requests\API;

class CreateShipmentRequest extends AbstractAPIRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $input = $this->all();

        $rules = [
            'service_type'      => 'required|in:metro_manila,provincial,international,others',
            'is_international'  => 'in:express,ems,postal',
            'charge_to'         => 'in:sender,consignee',
            'pay_thru'          => 'in:cash,account,others',
            'package_type'      => 'in:small,medium,large'
        ];

        // check from address
        $fromRule = [];
        if (isset($input['from']['id'])) {
            $fromRule = [
                'from.id'        => 'exists:user_addressbooks,id',
            ];
        } else {
            $fromRule = [
                'from.identifier'        => 'required',
                'from.first_name'        => 'required',
                'from.last_name'         => 'required',
                'from.contact_number'    => 'required',
                'from.email'             => 'email',
                'from.address_line_1'    => 'required',
                'from.city'              => 'required',
                'from.province'          => 'required',
                'from.zip_code'          => 'required',
                'from.address_type'      => 'in:office,residential',
            ];
        }

        $toRule = [];
        if (isset($input['to']['id'])) {
            $toRule = [
                'to.id'        => 'exists:user_addressbooks,id',
            ];
        } else {
            $toRule = [
                'to.identifier'        => 'required',
                'to.first_name'        => 'required',
                'to.last_name'         => 'required',
                'to.contact_number'    => 'required',
                'to.email'             => 'email',
                'to.address_line_1'    => 'required',
                'to.city'              => 'required',
                'to.province'          => 'required',
                'to.zip_code'          => 'required',
                'to.address_type'      => 'in:office,residential',
            ];
        }

        $rules = array_merge($rules, $fromRule, $toRule);

        return $rules;
    }
}
