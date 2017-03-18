<?php
namespace App\Http\Controllers\Customers\ItemRequests;

use App\Http\Controllers\Controller;
use App\Models\ItemRequest;
use App\Models\UserAddressbook;
use Illuminate\Http\Request;

class ItemRequestsController extends Controller
{

    public function index(Request $request)
    {
        $user = $request->user()->toArray();
        $itemRequests = ItemRequest::where('user_id', $user['id'])->get();
        $address = UserAddressbook::where('user_id', $user['id'])->get();

        return view('customers.item-requests.index', compact('itemRequests', 'address'));
    }

    public function store(Request $request)
    {
        $user  = $request->user()->toArray();
        $input = $request->all();
        $input['user_id'] = $user['id'];
        $input['status'] = 'pending';

        ItemRequest::create($input);

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $itemRequest = ItemRequest::where('id', $id)->first();

        $itemRequest->update($input);
    }

    public function destroy($id)
    {
        $itemRequest = ItemRequest::where('id', $id)->first();
        $itemRequest->delete();
    }
}
