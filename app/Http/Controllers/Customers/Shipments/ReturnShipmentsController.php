<?php
namespace App\Http\Controllers\Customers\Shipments;

use App\Http\Controllers\Controller;
use App\Models\ShipmentResolution;
use App\Models\ShipmentResolutionMessage;
use Illuminate\Http\Request;

class ReturnShipmentsController extends Controller {

    public function index(Request $request)
    {
        $user = $request->user()->toArray();

        if ($request->has('status')) {
            $problematicShipments = ShipmentResolution::with('shipment')
                ->whereHas('shipment', function($q) use ($user) {
                    $q->where('user_id', $user['id']);
                })
                ->where('status', $request->get('status'))
                ->get();
        } else {
            $problematicShipments = ShipmentResolution::with('shipment')
                ->whereHas('shipment', function($q) use ($user) {
                    $q->where('user_id', $user['id']);
                })
                ->where('status', 'unresolved')
                ->get();
        }

        return view('customers.shipments.return.index')
            ->with('shipments', $problematicShipments);
    }

    public function show(Request $request, $resolutionId)
    {
        $resolution = ShipmentResolution::with('shipment', 'messages', 'logs')
            ->where('id', $resolutionId)
            ->first();

        return view('customers.shipments.return.show')
            ->with('resolution', $resolution);
    }

    public function newMessage(Request $request, $resolutionId)
    {
        $input = $request->all();
        $userId = $request->user()->id;

        \Validator::make($input, [
            'message'   => 'required|min:3'
        ]);

        // Update resolution status
        ShipmentResolution::where('id', $resolutionId)
            ->update(['status' => 'resolving']);

        // Create message
        $message = ShipmentResolutionMessage::create([
            'shipment_resolution_id'    => $resolutionId,
            'user_id'                   => $userId,
            'message'                   => $input['message']
        ]);

        if ($message) {
            $request->session()->flash('success', 'Successfully posted a new message');
        } else {
            $request->session()->flash('error', 'Failed to post a new message');
        }

        return redirect()->back();
    }
}