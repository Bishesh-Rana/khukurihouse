<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\Order;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Message;
use Illuminate\Pagination\Paginator;


class ChatController extends Controller
{
    public function getSellerList()
    {
        $ref_ids = Payment::where('customer_id', Auth::id())->get('ref_id');
        $product_ids = Order::whereIn('ref_id', $ref_ids)->get('product_id');
        $seller_ids = Product::whereIn('id', $product_ids)->groupBy('owner_id')->get('owner_id');
        $sellers = Seller::whereIn('id', $seller_ids)->select('id','company_name','image')->get();

        return response()->json([
            'status' => true,
            'status_message' => 'Seller Received Successfully!' ,
            'image_link' => asset('uploads/sellers/'),
            'sellers' => $sellers,
            ], 200);
    }

    public function chatWithSeller(Request $request)
    {
        // return $request->seller_id;
        Message::where('owner_id', $request->seller_id)->where('send_by','seller')->update(["seen_status" => "1"]);

        $currentPage = $request->page; // You can set this to any page you want to paginate to

        // Make sure that you call the static method currentPageResolver()
        // before querying users
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $messages = Message::join('tbl_customers', 'tbl_customers.id', '=', 'tbl_messages.customer_id')
            ->where('tbl_messages.owner_id', $request->seller_id)
            ->where('tbl_messages.customer_id', Auth::id())
            ->select('tbl_messages.id', 'tbl_customers.name', 'tbl_messages.message', 'tbl_messages.created_at', 'tbl_messages.send_by', 'tbl_messages.seen_status', 'tbl_customers.image')
            ->paginate(10);

        return response()->json([
            'status' => true,
            'status_message' => 'Messages Received Successfully!' ,
            'image_link' => asset('uploads/customers/'),
            'messages' => $messages,
            ], 200);
    }

    public function chatReply(Request $request)
    {
        $message = new Message();
        $message->owner_id = $request->seller_id;
        $message->customer_id = Auth::id();
        $message->message = $request->message;
        $message->send_by = "customer";
        // $message->seen_status = "1";
        $message->save();
        return response()->json([
            'status' => true,
            'status_message' => 'Message Sent Successfully!',
            ], 200);
    }
}
