<?php
namespace App\Http\Controllers\Customers\Addressbooks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Addressbooks\StoreAddressbookRequest;
use App\Model\ItemRequest;
use Illuminate\Http\Request;


class ItemRequestsController extends Controller
{

    public function index(Request $request)
    {
        $user = $request->user()->toArray();
        $itemRequests = ItemRequest::where('user_id', $user['id'])->get();

        return view('customers.item-requests.index', compact('itemRequests'));
    }

    public function store(StoreAddressbookRequest $request)
    {
        $user  = $request->user()->toArray();
        $input = $request->all();
        $input['user_id'] = $user['id'];

        ItemRequest::create($input);

        return redirect()->back();
    }

    public function update(StoreAddressbookRequest $request, ItemRequest $itemRequest)
    {
        $input = $request->all();

        $itemRequest->update($input);
    }

    public function destroy(ItemRequest $itemRequest)
    {
        $itemRequest->delete();
    }
}
