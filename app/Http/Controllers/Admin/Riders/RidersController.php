<?php
namespace App\Http\Controllers\Admin\Riders;

use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\Admin\Riders\UpdateRiderRequest;
use App\Http\Requests\Admin\Riders\StoreRiderRequest;

class RidersController extends Controller
{
    public function index()
    {
        $riders = User::with('profile')
            ->where('user_group_id', 4)
            ->get();

        return view('admin.riders.index', compact('riders'));
    }

    public function store(StoreRiderRequest $request )
    {
        $input = $request->all();
        $user = [
            'account_id'=> $input['account_id'],
            'user_group_id'=> 4,
            'email'=>$input['email'],
            'password' => encrypt($input['password'])
        ];

        $profile = [
            'first_name'=> $input['first_name'],
            'last_name'=> $input['last_name'],
            'middle_name'=>$input['middle_name'],
            'company_name' => $input['company_name'],
            'gender'=> $input['gender'],
            'birthdate' => $input['birthdate']
        ];
        $users = User::create($user);
        $users->profile()->create($profile);

    }

    public function update(UpdateRiderRequest $request,User $riderId)
    {
        $input = $request->all();
        $user = [
            'account_id'=> $input['account_id'],
            'email'=>$input['email'],
            'password' => encrypt($input['password'])
        ];

        $profile = [
            'first_name'  => $input['first_name'],
            'last_name'   => $input['last_name'],
            'middle_name' => $input['middle_name'],
            'company_name'=> $input['company_name'],
            'gender'      => $input['gender'],
            'birthdate'   => $input['birthdate']
        ];

        $riderId->update($user);
        $riderId->profile()->update($profile);
    }

    public function destroy(User $riderId)
    {
        $riderId->delete($riderId);
    }
}