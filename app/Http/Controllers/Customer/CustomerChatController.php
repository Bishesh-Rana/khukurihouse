<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class CustomerChatController extends Controller
{
    public function chat()
    {
        $setting = Setting::first();
        if ($setting != null) {
            $meta_title = $setting->meta_title;
            $meta_description = $setting->meta_description;
            $meta_keyword = $setting->meta_keyword;
        } else {
            $meta_title = '';
            $meta_description = '';
            $meta_keyword = '';
        }

        $ref_ids = Payment::where('customer_id', Auth::guard('web')->user()->id)->get('ref_id');
        $product_ids = Order::whereIn('ref_id', $ref_ids)->get('product_id');
        $seller_ids = Product::whereIn('id', $product_ids)->groupBy('owner_id')->get('owner_id');
        $sellers = Seller::whereIn('id', $seller_ids)->get();

        $active = "chat";

        // $active_seller = 0;

        return view('front.customer.chat', compact('active', 'sellers', 'meta_title', 'meta_description', 'meta_keyword'));
    }

    public function chatWithSeller($seller_id)
    {
        $setting = Setting::first();
        if ($setting != null) {
            $meta_title = $setting->meta_title;
            $meta_description = $setting->meta_description;
            $meta_keyword = $setting->meta_keyword;
        } else {
            $meta_title = '';
            $meta_description = '';
            $meta_keyword = '';
        }

        $active = "chat";

        $ref_ids = Payment::where('customer_id', Auth::guard('web')->user()->id)->get('ref_id');
        $product_ids = Order::whereIn('ref_id', $ref_ids)->get('product_id');
        $seller_ids = Product::whereIn('id', $product_ids)->groupBy('owner_id')->get('owner_id');
        $sellers = Seller::whereIn('id', $seller_ids)->get();

        Message::where('owner_id', $seller_id)->where('send_by','seller')->update(["seen_status" => "1"]);

        $messages = Message::join('tbl_customers', 'tbl_customers.id', '=', 'tbl_messages.customer_id')
            ->where('tbl_messages.owner_id', $seller_id)
            ->where('tbl_messages.customer_id', Auth::guard('web')->user()->id)
            ->select('tbl_messages.id', 'tbl_customers.name', 'tbl_messages.message', 'tbl_messages.created_at', 'tbl_messages.send_by', 'tbl_messages.seen_status', 'tbl_customers.image')
            ->get();

        $seller = Seller::where('id', $seller_id)->firstOrFail();
        $active_seller = $seller->id;

        return view('front.customer.chat', compact('active', 'active_seller', 'sellers', 'seller', 'messages', 'meta_title', 'meta_description', 'meta_keyword'));
    }

    public function chatReply(Request $request)
    {
        $message = new Message();
        $message->owner_id = $request->seller_id;
        $message->customer_id = Auth::guard('web')->user()->id;
        $message->message = $request->message;
        $message->send_by = "customer";
        // $message->seen_status = "1";
        $message->save();
        return redirect()->route('customer.dashboard.chat')->with('success', 'Message Successfully Sent !!!');
    }
}
