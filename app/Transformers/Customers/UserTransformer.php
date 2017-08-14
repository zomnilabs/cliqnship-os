<?php
namespace App\Transformers\Customers;

use App\Transformers\Transformerable;
use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract implements Transformerable
{
    /**
     * Transform user object
     *
     * @param User $user
     * @return array
     */
    public function transform($user)
    {
        return [
            'id'            => (int) $user->id,
            'account_id'    => $user->account_id,
            'email'         => $user->email,
            'user_group'    => $user->userGroup->name,
            'image'         => $user->profile->image ? "https://files.cliqnship.com/{$user->profile->image}" : null,
            'primary_address'   => $user->addressbook()->getPrimaryAddress(),
            'profile'   => [
                'first_name'    => $user->profile->first_name,
                'last_name'     => $user->profile->last_name,
                'middle_name'   => $user->profile->middle_name,
                'gender'        => $user->profile->gender
            ],
            'links'   => [
                [
                    'rel' => 'self',
                    'uri' => url('/api/v1/customers/'.$user->id),
                ],
                [
                    'rel' => 'addressbooks',
                    'uri' => url('/api/v1/customers/'.$user->id.'/addressbooks'),
                ],
                [
                    'rel' => 'bookings',
                    'uri' => url('/api/v1/customers/'.$user->id.'/bookings'),
                ],
                [
                    'rel' => 'shipments',
                    'uri' => url('/api/v1/customers/'.$user->id.'/shipments'),
                ]
            ]
        ];
    }
}