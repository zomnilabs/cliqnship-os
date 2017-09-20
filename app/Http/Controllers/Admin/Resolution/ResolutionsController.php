<?php
namespace App\Http\Controllers\Admin\Resolution;

use App\Http\Controllers\Controller;
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

        // Create message
        $message = ShipmentResolutionMessage::create([
            'shipment_resolution_id'    => $resolutionId,
            'user_id'                   => $userId,
            'message'                   => $input['message']
        ]);

        return redirect()->back();
    }
}