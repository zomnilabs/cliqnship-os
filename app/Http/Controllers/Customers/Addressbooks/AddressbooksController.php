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

    public function store($request)
    {
        $input = $request->all();

        $addressbooks= UserAddressbook::create($input);

    }
}