<?php
namespace App\Http\Controllers\Admin\Items;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Http\Requests\Admin\Items\UpdateItemRequest;
use App\Http\Requests\Admin\Items\StoreItemRequest;

class ItemsController extends Controller
{
    public function index()
    {
        $items = Item::all();

        return view('admin.items.index', compact('items'));
    }

    public function store(StoreItemRequest $request )
    {
        $input = $request->all();
        $items = Item::create($input);
    }

    public function update(UpdateItemRequest $request,Item $itemId)
    {
        $input = $request->all();

        $itemId->update($input);
    }

    public function destroy(Item $itemId)
    {
        $itemId->delete();
    }
}