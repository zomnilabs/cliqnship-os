<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/customers';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|min:2',
            'last_name'  => 'required|min:2',
            'gender'     => 'in:male,female',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:5|confirmed',
            'g-recaptcha-response' => 'required|captcha'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'email'         => $data['email'],
            'password'      => bcrypt($data['password']),
            'account_id'    => strtoupper(uniqid()),
            'user_group_id' => 5,
            'account_type'  => 'individual',
            'login_type'    => 'email'
        ]);

        $user->profile()->create([
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'gender'        => $data['gender'],
            'birthdate'     => isset($data['birthdate']) ? $data['birthdate'] : null
        ]);

        return $user;
    }
}
