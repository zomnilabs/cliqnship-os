<?php
namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\UserAddressbook;
use Illuminate\Http\Request;

class DashboardController extends Controller {
    public function index(Request $request)
    {
        $user = $request->user()->toArray();

        $withPrimaryAddress = false;
        if ($this->havePrimaryAddress($user['id'])) {
            $withPrimaryAddress = true;
        }

        return view('customers.dashboard')
            ->with('withPrimaryAddress', $withPrimaryAddress);
    }

    private function havePrimaryAddress($userId)
    {
        $addressbook = UserAddressbook::where('primary', 1)
            ->where('user_id', $userId)->count();

        return $addressbook;
    }
}