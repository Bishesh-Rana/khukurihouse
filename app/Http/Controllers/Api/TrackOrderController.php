<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrackOrderController extends Controller
{
    public function trackOrder(Request $request)
    {
        $this->validate($request, ([
            'order_id' => 'required|exists:tbl_orders,ref_id',
            'order_email' => 'required|exists:tbl_payments,email'
        ]));


        $check_id = Payment::where('email', $request->order_email)
            ->where('ref_id', $request->order_id)
            ->first();
        $order = Order::where('ref_id', $request->order_id)->first();

        if (!$check_id || !$order) {
            return back()->with('error', 'Invalid Order ID');
        }

        if ($order->pending == 1) {
            return back()->with('success', 'Your order is in process.');
        }

        if ($order->ready_to_ship == 1) {
            return back()->with('success', 'Your order is ready to ship.');
        }

        if ($order->shipped == 1) {
            return back()->with('success', 'Your order has been shipped.');
        }

        if ($order->delivered == 1) {
            return back()->with('success', 'Your order has been delivered.');
        }

        if ($order->cancelled == 1) {
            return back()->with('success', 'Your order was cancelled.');
        }

        if ($order->failed_delivery == 1) {
            return back()->with('success', 'Your order is in process.');
        }

        return back()->with('error', 'Sorry, Please try again later. . . ');
    }
}
