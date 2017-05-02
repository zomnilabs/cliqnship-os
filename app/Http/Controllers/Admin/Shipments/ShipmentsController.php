<?php
namespace App\Http\Controllers\Admin\Shipments;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Carbon\Carbon;

class ShipmentsController extends Controller
{
    public function index()
    {
    	$shipments = Shipment::with('trackingNumbers')->get();

        return view('admin.shipments.index')
            ->with('shipments', $shipments);
    }
    
    public function preview()
    {
        return view('print.waybill');
    }

    public function exportNewShipments()
    {
        $shipments = Shipment::where('status', 'arrived-at-hq')
            ->get();

        $filename = 'shipments_'.Carbon::today('Asia/Manila')->toDateString();

        \Excel::create($filename, function($excel) use ($shipments) {
            $excel->sheet('Sheet 1', function($sheet) use ($shipments) {
                $sheet->fromArray($shipments);
            });
        })->download('xlsx');;
    }
}