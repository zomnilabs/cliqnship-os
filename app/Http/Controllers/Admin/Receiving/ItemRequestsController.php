<?php
namespace App\Http\Controllers\Admin\Receiving;

use App\Http\Controllers\Controller;
use App\Models\ItemRequest;

class ItemRequestsController extends Controller {
    public function index()
    {
        $itemRequests = ItemRequest::where('status', 'pending')
            ->get();

        return view('admin.receiving.item-requests')
            ->with('itemRequests', $itemRequests);
    }
}