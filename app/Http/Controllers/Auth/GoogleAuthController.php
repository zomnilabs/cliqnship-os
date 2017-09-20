<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Models\UserAccount;

class GoogleAuthController extends Controller {
    public function redirectToProvider()
    {
        return \Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = \Socialite::driver('google')->user();

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
                    'type'          => 'google',
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
                'login_type'    => 'google'
            ]);

            $newUser->profile()->create([
                'first_name'    => $user->name,
                'last_name'     => '',
                'gender'        => 'male',
            ]);

            // Create User Account
            UserAccount::create([
                'account_id'    => $user->id,
                'type'          => 'google',
                'last_token'    => $user->token
            ]);

            \Auth::login($newUser);
        }

        return redirect()->to('/customers');
    }
}