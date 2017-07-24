<?php
namespace App\Http\Controllers\Admin\COD;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\ShipmentCod;
use App\Models\ShipmentTrackingNumber;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShipmentsController extends Controller {
    public function all()
    {
        $shipments = Shipment::with('cod')->has('cod')
            ->where('collect_and_deposit', 1)
            ->where('status', '<>', 'pending')
            ->get();

        $amounts = [
            'pending'   => 0,
            'collected' => 0,
            'deposited' => 0
        ];

        foreach ($shipments as $shipment) {
            if ($shipment->cod->status === 'collected') {
                $amounts['collected'] += $shipment->cod->remitted_amount;
            } else {
                $amounts[$shipment->cod->status] += $shipment->cod->collect_and_deposit_amount;
            }

        }

       return view('admin.cod.shipments.index', compact('shipments', 'amounts'));
    }

    public function export(Request $request)
    {
        $model = Shipment::with('cod')->has('cod')
            ->where('collect_and_deposit', 1)
            ->where('status', '<>', 'pending');

        if ($request->has('status') && $request->get('status')) {
            $model->whereHas('cod', function($cod) use ($request){
                $cod->where('status', $request->get('status'));
            });
        }

        $shipments = $model->get();
        $result = [];
        foreach ($shipments as $shipment) {
            $result[] = [
                'waybill'       => $shipment->trackingNumbers()->mainTrackingNumber()->tracking_number,
                'deposit_date'  => $shipment->cod->deposit_date,
                'status'        => $shipment->cod->status
            ];
        }

        $filename = 'shipments_cod_'.Carbon::today('Asia/Manila')->toDateString();

        \Excel::create($filename, function($excel) use ($result) {
            $excel->sheet('Sheet 1', function($sheet) use ($result) {
                $sheet->fromArray($result);
            });
        })->download('xlsx');
    }

    public function import(Request $request)
    {
        if (! $request->hasFile('file')) {
            return redirect()->back();
        }

        $file = $request->file('file');
        $response = [];
        \Excel::load($file, function($reader) use (&$response) {
            $results = $reader->get();

            foreach ($results as $shipment) {
                $response[] = $this->updateCOD($shipment);
            }
        });

        return redirect()->back();
    }

    private function updateCOD($shipment)
    {
        $waybill = ShipmentTrackingNumber::where('tracking_number', $shipment['waybill'])->first();

        if (! $waybill) {
            return;
        }

        $status = '';
        $date = null;

        switch ($shipment['status']) {
            case 'collected':
                $status = 'collected';
                break;
            case 'deposited':
                if (! $shipment['deposit_date']) {
                    return;
                }

                $date = Carbon::createFromTimestamp(strtotime($shipment['deposit_date']))->toDateString();
                $status = 'deposited';
                break;
            default:
                $status = 'pending';
                $date = null;
        }

        $cod = ShipmentCod::where('shipment_id', $waybill->shipment_id)
            ->update([
                'deposit_date'  => $date,
                'status'        => $status
            ]);

        return $cod;
    }
}