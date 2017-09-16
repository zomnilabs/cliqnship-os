<?php
namespace App\Http\Controllers\Admin\Resolution;

use App\Http\Controllers\Controller;
use App\Models\ShipmentResolution;
use App\Models\ShipmentReturnLogs;
use Illuminate\Http\Request;

class ResolutionsController extends Controller {
    public function returned(Request $request)
    {

        if ($request->has('status')) {
            $problematicShipments = ShipmentResolution::with('shipment')
                ->where('status', $request->get('status'))
                ->get();
        } else {
            $problematicShipments = ShipmentResolution::with('shipment')->where('status', 'unresolved')
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

    public function getReturnLogs(Request $request, $resolutionId)
    {
        $logs = ShipmentReturnLogs::with('user.profile', 'user.userGroup')->where('shipment_resolution_id', $resolutionId)
            ->get();

        return response()->json($logs, 200);
    }
}