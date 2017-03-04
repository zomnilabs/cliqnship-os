<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserAddressbook;

class AddressBookController extends Controller {

    public function index($id)
    {
        $address = UserAddressbook::where('user_id', $id)->get();

        return response()->json($address, 200);
    }
}