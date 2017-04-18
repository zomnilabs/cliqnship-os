<?php
namespace App\Transformers\Customers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * Transform user object
     *
     * @param User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id'            => $user->id,
            'email'         => $user->email,
            'user_group'    => $user->userGroup->name,
            'profile'   => [
                'first_name'    => $user->profile->first_name,
                'last_name'     => $user->profile->last_name,
                'middle_name'   => $user->profile->middle_name,
                'gender'        => $user->profile->gender
            ],
            'links'   => [
                [
                    'rel' => 'self',
                    'uri' => '/api/v1/customers/'.$user->id,
                ],
                [
                    'rel' => 'addressbooks',
                    'uri' => '/api/v1/customers/'.$user->id.'/addressbooks',
                ],
                [
                    'rel' => 'bookings',
                    'uri' => '/api/v1/customers/'.$user->id.'/bookings',
                ],
                [
                    'rel' => 'shipments',
                    'uri' => '/api/v1/customers/'.$user->id.'/shipments',
                ]
            ]
        ];
    }
}