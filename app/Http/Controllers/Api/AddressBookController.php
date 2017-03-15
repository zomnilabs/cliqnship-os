<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserAddressbook;
use Illuminate\Http\Request;

class AddressBookController extends Controller {

    public function index(Request $request, $id)
    {
        $model = UserAddressbook::where('user_id', $id);

        if ($request->has('type')) {
            $model->where('type', $request->get('type'));
        }

        $address = $model->get();
        return response()->json($address, 200);
    }
}