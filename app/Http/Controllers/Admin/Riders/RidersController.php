<?php
namespace App\Http\Controllers\Admin\Riders;

use App\Http\Controllers\Controller;

class RidersController extends Controller
{
    public function index()
    {
        return view('admin.riders.index');
    }
}