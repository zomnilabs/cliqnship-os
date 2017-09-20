<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserAccount;
use App\Traits\ApiResponse;
use App\Traits\PassportToken;
use App\User;
use Illuminate\Http\Request;

class SocialAuthentication extends Controller {
    use ApiResponse, PassportToken;

    public function auth(Request $request)
    {
        $input = $request->all();
        \Validator::make($input, [
            'access_token'  => 'required',
            'provider'      => 'required|in:facebook,google',
            'grant_type'    => 'required',
            'client_id'     => 'required',
            'client_secret' => 'required'
        ]);

        if ($input['grant_type'] !== 'social') {
            return $this->responseUnauthorized();
        }

        // Check client credential
        $client = \DB::table('oauth_clients')
            ->where('id', $input['client_id'])
            ->where('secret', $input['secret'])
            ->first();

        if (! $client) {
            return $this->responseUnauthorized();
        }

        // Continue with social authentication
        $user = \Socialite::driver($input['provider'])
            ->stateless()
            ->userFromToken($input['access_token']);

        if (! $user) {
            return $this->responseUnauthorized();
        }

        // Check the database
        $cliqUser = User::where('email', $user->email)
            ->where('login_type', $input['provider'])
            ->first();

        // Check if already exists
        if (! $cliqUser) {
            // create a new user
            $cliqUser = User::create([
                'email'         => $user->email,
                'password'      => bcrypt(str_random(20)),
                'account_id'    => strtoupper(uniqid()),
                'user_group_id' => 5,
                'account_type'  => 'individual',
                'login_type'    => $input['provider']
            ]);

            $cliqUser->profile()->create([
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
        }

        $token = $this->createPassportTokenByUser($cliqUser, $input['client_id']);

        return $this->sendBearerTokenResponse($token['access_token'], $token['refresh_token']);
    }
}