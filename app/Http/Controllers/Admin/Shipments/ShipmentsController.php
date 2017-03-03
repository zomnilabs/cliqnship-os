<?php
namespace App\Http\Controllers\Admin\Shipments;

use App\Http\Controllers\Controller;

class ShipmentsController extends Controller
{
    public function index()
    {
        return view('admin.shipments.index');
    }
}