<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function countNotification(Request $request,$customer_id)
    {
        $customer = $customer_id;
        if($customer > 0)
        {
            $customerDetail = Customer::where('id',$customer)->first();

            $totalNotification = Notification::where('customer_email',$customerDetail->email)->where('seen_status','0')->get()->count();
            // $deliveryNotification = Notification::where('customer_email',$customerDetail->email)->where('seen_status','0')->count();
        }else{
            $totalNotification = 0;
        }
        return response()->json([
            'status' => true,
            'status_message' => 'Total new notification!',
            'total_notification' => $totalNotification,
        ], 200);
    }

    public function getAllNotificationByCustomerId($customer_id)
    {
        $customer = $customer_id;
        if($customer > 0)
        {
            $customerDetail = Customer::where('id',$customer)->first();

            $allNotification = Notification::where('customer_email',$customerDetail->email)
                            ->select('id','extra_data','type','title','created_at','seen_status')
                            ->orderBy('id','desc')
                            ->get();
        }else{
            $items = [];
            $allNotification = json_encode($items);
        }
        return response()->json([
            'status' => true,
            'status_message' => 'Total new notification!',
            'all_notification' => $allNotification,
        ], 200);
    }

    public function getNotificationDetailById($id)
    {
        $detail = Notification::where('id',$id)->first();
        if(isset($detail))
        {
            return response()->json([
                'status' => true,
                'status_message' => 'Notification Detail!',
                'detail' => $detail,
            ], 200);
        }else
        {
            return response()->json([
                'status' => true,
                'status_message' => 'No any detail available!',
                'detail' => $detail,
            ], 200);
        }

    }
}
