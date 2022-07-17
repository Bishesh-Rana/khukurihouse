<?php

namespace App\Http\Controllers\Api;

use App\Models\DeliveryAssign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;

class AssignDeliveryController extends Controller
{
    public function deliveryAssign(Request $request)
    {
        $refId = $request->refId;
        $deliveryId = $request->deliveryId;

        $deliverAssign = new DeliveryAssign();

        $deliverAssign->ref_id = $refId;
        $deliverAssign->delivery_id = $deliveryId;

        $deliverAssign->save();

        Payment::where('ref_id',$refId)->update([
            'delivery_assign_status' => '1',
        ]);

        return response()->json([
            'status' => 'success',
        ],200);
    }
}
