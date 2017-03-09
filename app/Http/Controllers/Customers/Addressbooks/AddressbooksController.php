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
        $user  = $request->user()->toArray();
        $input = $request->all();
        $input['user_id'] = $user['id'];

        UserAddressbook::create($input);

        return redirect()->back();
    }

    public function update(StoreAddressbookRequest $request, $addressbookId)
    {

        $input = $request->all();

        UserAddressbook::where('id',$addressbookId)
            ->update($input);
    }

    public function destroy($addressbookId)
    {
        UserAddressbook::destroy($addressbookId);
    }
}
