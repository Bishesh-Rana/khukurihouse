<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderDeliveryStaff;
use Illuminate\Support\Facades\Auth;

class AssignStaffController extends Controller
{
    public function staffAssign(Request $request)
    {
        $refId = $request->refId;
        $staffId = $request->staffId;

        $staffAssign = new OrderDeliveryStaff();

        $staffAssign->ref_id = $refId;
        $staffAssign->delivery_id = Auth::guard('delivery')->user()->id;
        $staffAssign->staff_id = $staffId;

        $staffAssign->save();

        return response()->json([
            'status' => 'success',
        ],200);
    }
}
