<?php
namespace App\Http\Controllers\Admin\Dispatching;

use App\Http\Controllers\Controller;
use App\Models\ItemRequest;

class ItemRequestsController extends Controller {
    public function index()
    {
        $itemRequests = ItemRequest::with('address','source')
            ->where('status', 'pending')
            ->get();

        return view('admin.dispatching.item-requests')
            ->with('itemRequests', $itemRequests);
    }
}