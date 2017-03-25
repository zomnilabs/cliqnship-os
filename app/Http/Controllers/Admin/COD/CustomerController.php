<?php
namespace App\Http\Controllers\Admin\COD;

use App\Http\Controllers\Controller;

class CustomerController extends Controller {
    public function index()
    {
        return view('admin.cod.customers.index');
    }
}