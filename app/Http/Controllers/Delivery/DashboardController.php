<?php

namespace App\Http\Controllers\Delivery;

use App\Models\Payment;
use App\Models\Product;
use App\Models\Delivery;
use App\Models\DeliveryAssign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:delivery');
    }

    public function index()
    {

        if (isset(Auth::guard('delivery')->user()->parent_id)) //Staff
        {
            $ready_to_ship_count = Payment::leftJoin('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                ->join('tbl_deliveries_assign', 'tbl_payments.ref_id', 'tbl_deliveries_assign.ref_id')
                ->leftJoin('order_delivery_staff', 'tbl_payments.ref_id', 'order_delivery_staff.ref_id')
                ->groupBy('tbl_payments.ref_id')
                ->where('delivery_assign_status', '1')
                ->where('order_delivery_staff.staff_id', Auth::guard('delivery')->user()->id)
                ->where([
                    'pending' => '0',
                    'ready_to_ship' => '1',
                    'shipped' => '0',
                    'delivered' => '0',
                    'cancelled' => '0',
                    // 'failed_delivery' => '0'
                ])->get()->count();

                $shipped_count = Payment::leftJoin('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                ->join('tbl_deliveries_assign', 'tbl_payments.ref_id', 'tbl_deliveries_assign.ref_id')
                ->leftJoin('order_delivery_staff', 'tbl_payments.ref_id', 'order_delivery_staff.ref_id')
                ->groupBy('tbl_payments.ref_id')
                ->where('delivery_assign_status', '1')
                ->where('order_delivery_staff.staff_id', Auth::guard('delivery')->user()->id)
                ->where([
                    'pending' => '0',
                    'ready_to_ship' => '1',
                    'shipped' => '1',
                    'delivered' => '0',
                    'cancelled' => '0',
                    'failed_delivery' => '0'
                ])->get()->count();

                $delivered_count = Payment::leftJoin('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                ->join('tbl_deliveries_assign', 'tbl_payments.ref_id', 'tbl_deliveries_assign.ref_id')
                ->leftJoin('order_delivery_staff', 'tbl_payments.ref_id', 'order_delivery_staff.ref_id')

                ->groupBy('tbl_payments.ref_id')
                ->where('delivery_assign_status', '1')
                ->where('order_delivery_staff.staff_id', Auth::guard('delivery')->user()->id)
                ->where([
                    'pending' => '0',
                    'ready_to_ship' => '1',
                    'shipped' => '1',
                    'delivered' => '1',
                    'cancelled' => '0',
                    'failed_delivery' => '0'
                ])->get()->count();

                $failed_delivered_count = Payment::leftJoin('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                ->join('tbl_deliveries_assign', 'tbl_payments.ref_id', 'tbl_deliveries_assign.ref_id')
                ->leftJoin('order_delivery_staff', 'tbl_payments.ref_id', 'order_delivery_staff.ref_id')
                ->groupBy('tbl_payments.ref_id')
                ->where('delivery_assign_status', '1')
                ->where('order_delivery_staff.staff_id', Auth::guard('delivery')->user()->id)
                ->where([
                    'pending' => '0',
                    'ready_to_ship' => '1',
                    'shipped' => '0',
                    'delivered' => '0',
                    'cancelled' => '0',
                    'failed_delivery' => '1'
                ])->get()->count();

        } else {
            $ready_to_ship_count = Payment::leftJoin('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                ->join('tbl_deliveries_assign', 'tbl_payments.ref_id', 'tbl_deliveries_assign.ref_id')
                ->leftJoin('order_delivery_staff', 'tbl_payments.ref_id', 'order_delivery_staff.ref_id')
                ->groupBy('tbl_payments.ref_id')
                ->where('delivery_assign_status', '1')
                ->where('tbl_deliveries_assign.delivery_id', Auth::guard('delivery')->user()->id)
                ->where([
                    'pending' => '0',
                    'ready_to_ship' => '1',
                    'shipped' => '0',
                    'delivered' => '0',
                    'cancelled' => '0',
                    // 'failed_delivery' => '0'
                ])->get()->count();



            $shipped_count = Payment::leftJoin('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
            ->join('tbl_deliveries_assign', 'tbl_payments.ref_id', 'tbl_deliveries_assign.ref_id')
            ->leftJoin('order_delivery_staff', 'tbl_payments.ref_id', 'order_delivery_staff.ref_id')
            ->groupBy('tbl_payments.ref_id')
            ->where('delivery_assign_status', '1')
            ->where('tbl_deliveries_assign.delivery_id', Auth::guard('delivery')->user()->id)
            ->where([
                'pending' => '0',
                'ready_to_ship' => '1',
                'shipped' => '1',
                'delivered' => '0',
                'cancelled' => '0',
                'failed_delivery' => '0'
            ])->get()->count();

            $delivered_count = Payment::leftJoin('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
            ->join('tbl_deliveries_assign', 'tbl_payments.ref_id', 'tbl_deliveries_assign.ref_id')
            ->leftJoin('order_delivery_staff', 'tbl_payments.ref_id', 'order_delivery_staff.ref_id')
            ->groupBy('tbl_payments.ref_id')
            ->where('delivery_assign_status', '1')
            ->where('tbl_deliveries_assign.delivery_id', Auth::guard('delivery')->user()->id)
            ->where([
                'pending' => '0',
                'ready_to_ship' => '1',
                'shipped' => '1',
                'delivered' => '1',
                'cancelled' => '0',
                'failed_delivery' => '0'
            ])->get()->count();

            $failed_delivered_count = Payment::leftJoin('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                ->join('tbl_deliveries_assign', 'tbl_payments.ref_id', 'tbl_deliveries_assign.ref_id')
                ->leftJoin('order_delivery_staff', 'tbl_payments.ref_id', 'order_delivery_staff.ref_id')
                ->groupBy('tbl_payments.ref_id')
                ->where('delivery_assign_status', '1')
                ->where('tbl_deliveries_assign.delivery_id', Auth::guard('delivery')->user()->id)
                ->where([
                    'pending' => '0',
                    'ready_to_ship' => '1',
                    'shipped' => '0',
                    'delivered' => '0',
                    'cancelled' => '0',
                    'failed_delivery' => '1'
                ])->get()->count();


        }
        $staff_count = Delivery::whereNotNull('parent_id')->where('publish_status', '1')->where('delete_status', '0')->count();
        return view('delivery.pages.dashboard', compact('ready_to_ship_count','shipped_count', 'delivered_count', 'failed_delivered_count','staff_count'));
    }

    public function deliveryAssignNotifyUpdate($ref_id){

        DeliveryAssign::where('ref_id', $ref_id)
                        ->where('delivery_id', Auth::guard('delivery')->user()->id)
                        ->update([
                            "seen_status" => "1"
                        ]);
        return redirect()->route('delivery.order.pending');

    }
}


