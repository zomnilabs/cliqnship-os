<?php
namespace App\Http\Controllers\Admin\Customers;

use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\Admin\Customers\StoreCustomerRequest;
use App\Http\Requests\Admin\Customers\UpdateCustomerRequest;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = User::with('profile','booking','addressbook')
            ->where('user_group_id', 5)
            ->get();

        return view('admin.customers.index', compact('customers'));
    }

    public function store(StoreCustomerRequest $request )
    {
        $input = $request->all();
        $user = [
            'account_id'=> strtoupper(uniqid()),
            'user_group_id'=> 5,
            'email'=>$input['email'],
            'password' => encrypt($input['password'])
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

    public function update(UpdateCustomerRequest $request,User $customerId)
    {
        $input = $request->all();
        $user = [
            'email'    =>$input['email'],
            'password' => bcrypt($input['password'])
        ];

        $profile = [
            'first_name'  => $input['first_name'],
            'last_name'   => $input['last_name'],
            'middle_name' => $input['middle_name'],
            'company_name'=> $input['company_name'],
            'gender'      => $input['gender'],
            'birthdate'   => $input['birthdate']
        ];

        $customerId->update($user);
        $customerId->profile()->update($profile);
    }

    public function destroy(User $customerId)
    {
        $customerId->delete();
    }
}