<?php
namespace App\Http\Controllers\Admin\Resolution;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\ShipmentEvent;
use App\Models\ShipmentResolution;
use App\Models\ShipmentResolutionMessage;
use App\Models\ShipmentReturnLogs;
use Illuminate\Http\Request;

class ResolutionsController extends Controller {
    public function index(Request $request)
    {

        if ($request->has('status')) {
            $problematicShipments = ShipmentResolution::with('shipment')
                ->where('status', $request->get('status'))
                ->get();
        } else {
            $problematicShipments = ShipmentResolution::with('shipment')
                ->where('status', 'unresolved')
                ->get();
        }

        $resolved = ShipmentResolution::where('status', 'resolved')->count();
        $unresolved = ShipmentResolution::where('status', 'unresolved')->count();
        $resolving = ShipmentResolution::where('status', 'resolving')->count();

        return view('admin.resolution.index')
            ->with('resolved', $resolved)
            ->with('unresolved', $unresolved)
            ->with('resolving', $resolving)
            ->with('shipments', $problematicShipments);
    }

    public function show(Request $request, $resolutionId)
    {
        $resolution = ShipmentResolution::with('shipment', 'messages')
            ->where('id', $resolutionId)
            ->first();

        return view('admin.resolution.show')
            ->with('resolution', $resolution);
    }

    public function getReturnLogs(Request $request, $resolutionId)
    {
        $logs = ShipmentReturnLogs::with('user.profile', 'user.userGroup')
            ->where('shipment_resolution_id', $resolutionId)
            ->get();

        return response()->json($logs, 200);
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

    public function redispatch(Request $request, $resolutionId)
    {
        $resolution = ShipmentResolution::find($resolutionId);
        $shipment = Shipment::find($resolution->shipment_id);

        $updated = $shipment->update(['status' => 'arrived-at-hq']);

        // Record event
        ShipmentEvent::create([
            'shipment_id'   => $shipment->id,
            'event_source'  => 'warehouse',
            'event'         => 'status_change',
            'value'         => 'arrived-at-hq',
            'remarks'       => 're-dispatched shipment',
            'user_id'       => $request->user()->id
        ]);

        if ($updated) {
            $request->session()->flash('success', 'Successfully redispatched this shipment');
        } else {
            $request->session()->flash('error', 'Failed to redispatch shipment');
        }

        return redirect()->back();
    }
}