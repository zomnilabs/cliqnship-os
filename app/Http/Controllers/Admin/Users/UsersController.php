<?php
namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\Admin\Users\StoreUserRequest;
use App\Http\Requests\Admin\Users\UpdateUserRequest;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::with('userGroup','profile','booking')
            ->get();

        return view('admin.users.index', compact('users'));
    }

    public function store(StoreUserRequest $request )
    {
        $input = $request->all();
        $user = [
            'account_id'   => strtoupper(uniqid()),
            'user_group_id'=> $input['user_group_id'],
            'email'        =>$input['email'],
            'password'     => encrypt($input['password'])
        ];

        $profile = [
            'first_name'  => $input['first_name'],
            'last_name'   => $input['last_name'],
            'middle_name' =>$input['middle_name'],
            'company_name'=> $input['company_name'],
            'gender'      => $input['gender'],
            'birthdate'   => $input['birthdate']
        ];
        $users = User::create($user);
        $users->profile()->create($profile);

    }

    public function update(UpdateUserRequest $request,User $userId)
    {
        $input = $request->all();
        $user = [
            'user_group_id'=> $input['user_group_id'],
            'email'        =>$input['email'],
            'password'     => encrypt($input['password'])
        ];

        $profile = [
            'first_name'  => $input['first_name'],
            'last_name'   => $input['last_name'],
            'middle_name' => $input['middle_name'],
            'company_name'=> $input['company_name'],
            'gender'      => $input['gender'],
            'birthdate'   => $input['birthdate']
        ];

        $userId->update($user);
        $userId->profile()->update($profile);
    }

    public function destroy(User $userId)
    {
        $userId->delete();
    }
}