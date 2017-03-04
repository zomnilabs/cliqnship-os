<?php
namespace App\Http\Controllers\Customers\Addressbooks;

use App\Http\Controllers\Controller;
use App\Models\UserAddressbook;
use App\Http\Requests\Addressbooks\StoreAddressbookRequest;
use Illuminate\Http\Request;


class AddressbooksController extends Controller
{

    public function index(Request $request)
    {
        $user = $request->user()->toArray();
        $addressbooks = UserAddressbook::where('user_id', $user['id'])->get();

        return view('customers.addressbooks.index', compact('addressbooks'));
    }

    public function store(StoreAddressbookRequest $request)
    {
        $user = $request->user()->toArray();
        $input = $request->all();
        $input['user_id'] = $user['id'];

        $addressbook = UserAddressbook::create($input);

        // Change primary
        if ($addressbook->primary) {
            UserAddressbook::where('primary', 1)
                ->where('id', '!=', $addressbook->id)
                ->update(['primary', 0]);
        }

        return redirect()->back();
    }
}