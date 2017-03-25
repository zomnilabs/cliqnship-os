<?php
namespace App\Http\Controllers\Admin\Receiving;

use App\Http\Controllers\Controller;

class DispatchingController extends Controller {
    public function index()
    {
        return view('admin.dispatching.index');
    }
}