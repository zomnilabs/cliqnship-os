<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\UserAccount;

class FacebookAuthController extends Controller {
    public function redirectToProvider()
    {
        return \Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = \Socialite::driver('facebook')->user();

        // Check email
        $checkEmail = User::where('email', $user->email)->first();

        // If exists, merge account or login
        if ($checkEmail) {
            // Check User Account
            $userAccount = UserAccount::where('account_id', $user->id)->first();

            // If the user account is there, just log him in
            if (! $userAccount) {
                UserAccount::create([
                    'account_id'    => $user->id,
                    'type'          => 'facebook',
                    'last_token'    => $user->token
                ]);

            }

            \Auth::login($checkEmail);
        } else {
            // Create account
            $newUser = User::create([
                'email'         => $user->email,
                'password'      => bcrypt(str_random(20)),
                'account_id'    => strtoupper(uniqid()),
                'user_group_id' => 5,
                'account_type'  => 'individual',
                'login_type'    => 'email'
            ]);

            $newUser->profile()->create([
                'first_name'    => $user->name,
                'last_name'     => '',
                'gender'        => 'male',
            ]);

            // Create User Account
            UserAccount::create([
                'account_id'    => $user->id,
                'type'          => 'facebook',
                'last_token'    => $user->token
            ]);

            \Auth::login($newUser);
        }

        return redirect()->to('/customers');
    }
}