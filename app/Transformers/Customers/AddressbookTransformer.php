<?php
namespace App\Transformers\Customers;

use App\Models\UserAddressbook;
use App\User;
use League\Fractal\TransformerAbstract;

class AddressbookTransformer extends TransformerAbstract
{
    /**
     * Transform user object
     *
     * @param UserAddressbook $addressbook
     * @return array
     */
    public function transform(UserAddressbook $addressbook)
    {
        return [
            'id'        => (int) $addressbook->id,
            'user_id'   => (int) $addressbook->user_id,
            'identifier'    => $addressbook->identifier,
            'type'          => $addressbook->type,
            'first_name'    => $addressbook->first_name,
            'last_name'     => $addressbook->last_name,
            'middle_name'   => $addressbook->middle_name,
            'contact_number'    => $addressbook->contact_number,
            'email'             => $addressbook->email,
            'address_line_1'    => $addressbook->address_line_1,
            'address_line_2'    => $addressbook->address_line_2,
            'barangay'          => $addressbook->barangay,
            'city'              => $addressbook->city,
            'province'          => $addressbook->province,
            'zip_code'          => $addressbook->zip_code,
            'country'           => $addressbook->country,
            'address_type'      => $addressbook->address_type,
            'landmarks'         => $addressbook->landmarks,
            'primary'           => (boolean) $addressbook->primary,
            'links'   => [
                [
                    'rel' => 'owner',
                    'uri' => '/api/v1/customers/'.$addressbook->user_id,
                ]
            ]
        ];
    }
}