<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Payment;
use App\Models\UpdatePayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderUpdateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function updateOrderList()
    {

        $payments = Payment::where('paid_status', '1')->where('old_total_price', '>', '0')->get();
        // dd($payments);
        foreach ($payments as  $row) {

            $update_payments = UpdatePayment::where('ref_id', $row->ref_id)->first();
            // dd($update_payments);
            if (isset($update_payments)) {
                $net_price =   $update_payments->total_price - $row->total_price;
                if ($net_price > 0) {
                    $row->setAttribute('net_price', $net_price);
                }
            }
        }

        return view('admin.list.update_order',  compact('payments'));
    }

    public function cancelledOrderList()
    {

        $ref_ids = Order::where('cancelled', '1')->groupBy('ref_id')->get('ref_id');

        $orders = Payment::whereIn('ref_id', $ref_ids)->where('paid_status', '1')->get();

        return view('admin.list.order_cancelled_order', compact('orders'));
    }
}
