<?php

namespace App\Http\Controllers;

use App\Models\ShipmentResolution;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function tracking(Request $request, $id)
    {
        $resolution = ShipmentResolution::with('shipment', 'messages', 'logs')
            ->where('id', $id)
            ->first();

        return view('tracking')
            ->with('resolution', $resolution);
    }
}
