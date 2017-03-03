<?php
namespace App\Http\Controllers\Customers\Addressbooks;

use App\Http\Controllers\Controller;
use App\Models\UserAddressbook;
use App\Http\Requests\Addressbooks\StoreAddressbookRequest;


class AddressbooksController extends Controller
{

    public function index()
    {
        $addressbooks = UserAddressbook::all();

        return view('customers.addressbooks.index', compact('addressbooks'));
    }

    public function store(StoreAddressbookRequest $request)
    {
//        $user = $request->user()->toArray();
//        dd($user);
//        $input = $request->all();
//        $input['user_id'] = $user['id'];
//
//        $addressbook = UserAddressbook::create($input);
//
//        return redirect()->back();

        echo 'bwisit';
    }
}