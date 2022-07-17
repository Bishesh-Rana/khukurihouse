<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Notification;
use App\Models\Favourite;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Order;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Intervention\Image\Facades\Image;

class DashboardController extends Controller
{

    public function dashboard()
    {
        $customer = Auth::id();

        $user = Customer::where('publish_status', '1')
            ->where('delete_status', '0')
            ->where('id', $customer)
            ->select('name', 'phone', 'address', 'email', 'country', 'state', 'town', 'street', 'apartment', 'zipcode')
            ->first();

        $dashboard_info = Customer::select('tbl_customers.*')
            ->where('tbl_customers.id', $customer)
            ->first();

        $allRef = Payment::where('customer_id', $customer)->select('ref_id')->get();
        if (count($allRef) > 0) {
            $totalCount = Order::whereIn('ref_id', $allRef)->where('delivered', '1')->groupBy('ref_id')->get()->count();
            $dashboard_info->setAttribute('total_purchase', $totalCount);
        } else {
            $dashboard_info->setAttribute('total_purchase', 0);
        }


        $total_wishlist =  DB::table('tbl_wishlists')->where('user_id', $customer)->count();

        $dashboard_info->setAttribute('total_wishlist', $total_wishlist);

        $total_seller_following = Favourite::where('user_id', $customer)->count();

        $contact_detail = ([
            'phone' => Setting::first()->phone,
            'viber' => Setting::first()->viber,
            'whatsapp' => Setting::first()->whatsapp,
            'email' => Setting::first()->email,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Sending Purchase history data !!!',
            'customer_image' => asset('uploads/customers/'),
            'customer_percent' => $user->profile_percent,
            'dashboard_info' => $dashboard_info,
            'total_followed' => $total_seller_following,
            'contact_detail' => $contact_detail,
        ], 200);
    }

    public function editProfile()
    {
        $customer = Auth::id();
        $account = Customer::where('id', $customer)->firstorfail();

        return response()->json([
            'status' => true,
            'message' => 'Sending Account data !!!',
            'account' => $account,
        ], 200);
    }

    public function updateProfile(Request $request)
    {
        $customer = Auth::id();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            // 'username' => 'required',
            'phone' => 'required',
            // 'email' => 'required',
            'address' => 'required',
            'password' => 'required_with:password_confirmation|same:password_confirmation',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, $validator->messages()], 200);
        }

        $data = ([
            'name' => request('name'),
            // 'username' => request('username'),
            'phone' => request('phone'),
            'address' => request('address'),
            // 'email' => request('email'),
            'country' => request('country'),
            'state' => request('state'),
            'town' => request('town'),
            'street' => request('street'),
            'apartment' => request('apartment'),
            'zipcode' => request('zipcode'),
            'is_social_login' => '0',
        ]);

        /////////// For password change//////////////////
        // $pass = request('password');
        // if($pass != null){
        //     $data2 = ([
        //         'password' => Hash::make(request('password'))
        //     ]);
        //     Customer::where('id', $customer)->update($data2);
        // }

        Customer::where('id', $customer)->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Profile updated Successfully !!!',
            'account' => $customer,
        ], 200);
    }

    public function updatePassword(Request $request)
    {
        $customer = Auth::id();

        if (Hash::check($request->old_password, Auth::user()->password)) {
            $validator = Validator::make($request->all(), [
                'password' => 'required_with:password_confirmation|same:password_confirmation',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->messages(), 200);
            }

            $pass = request('password');
            if ($pass != null) {
                $data2 = ([
                    'password' => Hash::make(request('password'))
                ]);
                Customer::where('id', $customer)->update($data2);
            }

            return response()->json([
                'status' => true,
                'message' => 'Password changed Successfully !!!',
                'account' => $customer,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'status_message' => 'You Entered Wrong Old Password !!!'
            ], 200);
        }
    }

    public function purchaseHistory()
    {
        $ref_ids = Payment::where('customer_id', Auth::id())->where('complete_status', '1')->select('ref_id')->get();

        $purchaseOrders = Order::join('tbl_payments', 'tbl_orders.ref_id', 'tbl_payments.ref_id')
            ->whereIn('tbl_orders.ref_id', $ref_ids)
            ->where('tbl_orders.delivered', '1')
            ->orderBy('tbl_orders.id', 'desc')
            ->groupBy('tbl_orders.ref_id')
            ->select('tbl_payments.ref_id', 'tbl_payments.created_at', DB::raw('tbl_payments.total_price + tbl_payments.delivery_cost as total_price'), 'tbl_payments.paid_status', 'tbl_payments.esewa', 'tbl_payments.khalti', 'tbl_payments.imepay', 'tbl_payments.paypal')
            ->get();
        // return $purchaseOrders;
        foreach ($purchaseOrders as $key => $row) {
            $order = Order::where('ref_id', $row->ref_id)->count();
            $purchaseOrders[$key]->setAttribute('itemList', $order);
        }

        return response()->json([
            'status' => true,
            'message' => 'Sending Purchase history data !!!',
            'product_image_link' => asset('uploads/products/'),
            'purchaseHistory' => $purchaseOrders,
        ], 200);
    }

    public function toPay()
    {
        $ref_ids = Payment::where('customer_id', Auth::id())->where('complete_status', '1')->select('ref_id')->get();

        $purchaseOrders = Order::join('tbl_payments', 'tbl_orders.ref_id', 'tbl_payments.ref_id')
            ->whereIn('tbl_orders.ref_id', $ref_ids)
            ->where('tbl_payments.paid_status', '0')
            ->orderBy('tbl_orders.id', 'desc')
            ->groupBy('tbl_orders.ref_id')
            ->select('tbl_payments.ref_id', 'tbl_payments.created_at', DB::raw('tbl_payments.total_price + tbl_payments.delivery_cost as total_price'), 'tbl_payments.paid_status', 'tbl_payments.esewa', 'tbl_payments.khalti', 'tbl_payments.imepay', 'tbl_payments.paypal')
            ->get();
        // return $purchaseOrders;
        foreach ($purchaseOrders as $key => $row) {
            $order = Order::where('ref_id', $row->ref_id)->count();
            $purchaseOrders[$key]->setAttribute('itemList', $order);
        }

        return response()->json([
            'status' => true,
            'message' => 'Sending Purchase history data !!!',
            'product_image_link' => asset('uploads/products/'),
            'purchaseHistory' => $purchaseOrders,
        ], 200);
    }

    // public function purchaseHistory()
    // {
    //     $customer = Auth::id();
    //     $payments= Payment::where('customer_id',$customer)->first();
    //     $purchaseHistory = Payment::where('customer_id',$customer)
    //             ->join('tbl_orders','tbl_orders.ref_id','tbl_payments.ref_id')
    //             ->where('tbl_orders.pending','1')
    //             ->select('tbl_payments.ref_id','tbl_payments.created_at','tbl_payments.total_price',
    //                             'tbl_payments.paid_status','tbl_payments.esewa','tbl_payments.khalti','tbl_payments.imepay')
    //             ->get();

    //     //   $purchaseHistory1 = Payment::join('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
    //     //         ->where('tbl_payments.customer_id',$customer)
    //     //         ->select('tbl_payments.ref_id','tbl_payments.created_at','tbl_payments.total_price', DB::raw('count(tbl_orders.ref_id) as items'))
    //     //         ->groupBy('tbl_payments.ref_id')
    //     //         ->get();
    //     //         return $purchaseHistory1;

    //     foreach($purchaseHistory as $key => $payment)
    //     {
    //         $order = Order::where('ref_id',$payment->ref_id)->count();
    //         $purchaseHistory[$key]->setAttribute('itemList',$order);
    //     }

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Sending Purchase history data !!!',
    //         'product_image_link' => asset('uploads/products/'),
    //         'purchaseHistory' => $purchaseHistory,
    //     ], 200);
    // }

    public function show($ref_id)
    {
        $data = ([
            'seen_status' => '1'
        ]);
        Notification::where('ref_id', $ref_id)->update($data);

        $purchaseDetail = Order::join('tbl_products', 'tbl_products.id', 'tbl_orders.product_id')
            ->join('tbl_payments', 'tbl_payments.ref_id', 'tbl_orders.ref_id')
            ->leftJoin('tbl_sellers', 'tbl_sellers.id', '=', 'tbl_products.owner_id')
            ->select(
                'tbl_products.id',
                'tbl_products.product_name',
                'tbl_products.image',
                'tbl_sellers.company_name',
                'tbl_products.product_original_price',
                'tbl_products.product_compare_price',
                'tbl_orders.quantity'
            )
            ->where('tbl_payments.ref_id', $ref_id)->get();
            // dd($purchaseDetail);

        $subTotal = Payment::where('ref_id', $ref_id)->first()->total_price;
        $shipping = Payment::where('ref_id', $ref_id)->first()->delivery_cost;
        $discount = Payment::where('ref_id', $ref_id)->first()->discount_amount;
        $grandTotal = $subTotal + $shipping - $discount;
        $orderDetail = ORder::where('ref_id',$ref_id)->firstorfail();
        if($orderDetail->cancelled == '1'){
            $trackOrder = [
                [
                    'status' => $orderDetail->pending == 1 ? true : false,
                    'title' => 'Package Processing Started',
                    'desc' => 'Your package processing has beeen started',
                    'dateTime' => $orderDetail->created_at->format('d M y'),
                ],
                [
                    'status' => $orderDetail->cancelled == 1 ? true : false,
                    'title' => 'Cancelled',
                    'desc' => 'Your Package has been cancelled',
                    'dateTime' => @$orderDetail->updated_at->format('d M y'),
                ],

            ];
        }
        else{
            $trackOrder = [
                [
                    'status' => $orderDetail->pending == 1 ? true : false,
                    'title' => 'Package Processing Started',
                    'desc' => 'Your package processing has been started',
                    'dateTime' => $orderDetail->created_at->format('d M y'),
                ],
                [
                    'status' => $orderDetail->ready_to_ship == 1 ? true : false,
                    'title' => 'Package being Prepared',
                    'desc' => 'Your Package is being prepared by the seller',
                    'dateTime' => $orderDetail->ready_to_ship == 1 ? $orderDetail->updated_at->format('d M y') : $orderDetail->updated_at->adddays(3)->format('d M y'),
                ],
                [
                    'status' => $orderDetail->shipped == 1 ? true : false,
                    'title' => 'Shipped',
                    'desc' => 'Your Package has been shipped',
                    'dateTime' => $orderDetail->ready_to_ship == 1 ? $orderDetail->updated_at->format('d M y') : $orderDetail->updated_at->adddays(3)->format('d M y'),
                ],
                [
                    'status' => $orderDetail->delivered == 1 ? true : false,
                    'title' => 'Delivered',
                    'desc' => 'Your package has been prepared',
                    'dateTime' => $orderDetail->ready_to_ship == 1 ? $orderDetail->updated_at->format('d M y') : $orderDetail->updated_at->adddays(3)->format('d M y'),
                ],
            ];
        }


        return response()->json([
            'status' => true,
            'message' => 'Sending Purchase history data !!!',
            'subtotal' => $subTotal,
            'shipping' => $shipping,
            'discount' => $discount,
            'grandTotal' => $grandTotal,
            'product_image_link' => asset('uploads/products/'),
            'purchaseHistory' => $purchaseDetail,
            'trackOrder' => $trackOrder,
        ], 200);
    }

    public function orderPendingList()
    {
        $ref_ids = Payment::where('customer_id', Auth::id())->get('ref_id');
        $pendingOrders = Order::join('tbl_payments', 'tbl_orders.ref_id', 'tbl_payments.ref_id')
            ->whereIn('tbl_orders.ref_id', $ref_ids)
            ->where('tbl_orders.pending', '1')
            ->where('tbl_orders.cancelled', '0')
            ->orderBy('tbl_orders.id', 'desc')
            ->groupBy('tbl_orders.ref_id')
            ->select('tbl_payments.ref_id', 'tbl_payments.created_at', DB::raw('tbl_payments.total_price + tbl_payments.delivery_cost as total_price'), 'tbl_payments.paid_status', 'tbl_payments.esewa', 'tbl_payments.khalti', 'tbl_payments.imepay', 'tbl_payments.paypal')
            ->get();

        foreach ($pendingOrders as $key => $row) {
            $order = Order::where('ref_id', $row->ref_id)->count();
            $pendingOrders[$key]->setAttribute('itemList', $order);
        }

        return response()->json([
            'status' => true,
            'message' => 'Sending Order Cancel List !!!',
            'purchaseHistory' => $pendingOrders,
        ], 200);
    }

    public function orderCancelList()
    {
        $ref_ids = Payment::where('customer_id', Auth::id())->get('ref_id');
        $cancelledOrders = Order::join('tbl_payments', 'tbl_orders.ref_id', 'tbl_payments.ref_id')
            ->whereIn('tbl_orders.ref_id', $ref_ids)
            ->where('tbl_orders.cancelled', '1')
            ->orderBy('tbl_orders.id', 'desc')
            ->groupBy('tbl_orders.ref_id')
            ->select('tbl_payments.ref_id', 'tbl_payments.created_at', DB::raw('tbl_payments.total_price + tbl_payments.delivery_cost as total_price'), 'tbl_payments.paid_status', 'tbl_payments.esewa', 'tbl_payments.khalti', 'tbl_payments.imepay', 'tbl_payments.paypal')
            ->get();

        foreach ($cancelledOrders as $key => $row) {
            $order = Order::where('ref_id', $row->ref_id)->count();
            $cancelledOrders[$key]->setAttribute('itemList', $order);
        }

        return response()->json([
            'status' => true,
            'message' => 'Sending Order Cancel List !!!',
            'purchaseHistory' => $cancelledOrders,
        ], 200);
    }

    public function orderReturnList()
    {
        $ref_ids = Payment::where('customer_id', Auth::id())->get('ref_id');
        $cancelledOrders = Order::join('tbl_payments', 'tbl_orders.ref_id', 'tbl_payments.ref_id')
            ->whereIn('tbl_orders.ref_id', $ref_ids)
            ->where('tbl_orders.failed_delivery', '1')
            ->orderBy('tbl_orders.id', 'desc')
            ->groupBy('tbl_orders.ref_id')
            ->select('tbl_payments.ref_id', 'tbl_payments.created_at', DB::raw('tbl_payments.total_price + tbl_payments.delivery_cost as total_price'), 'tbl_payments.paid_status', 'tbl_payments.esewa', 'tbl_payments.khalti', 'tbl_payments.imepay', 'tbl_payments.paypal')
            ->get();

        foreach ($cancelledOrders as $key => $row) {
            $order = Order::where('ref_id', $row->ref_id)->count();
            $cancelledOrders[$key]->setAttribute('itemList', $order);
        }

        return response()->json([
            'status' => true,
            'message' => 'Sending Order Return List !!!',
            'purchaseHistory' => $cancelledOrders,
        ], 200);
    }


    public function paymentOption(Request $request)
    {
        $selectedPaymentOption = $request->payment_option;
        // return $selectedPaymentOption;

        $data = ([
            'payment_option' => $selectedPaymentOption
        ]);
        Customer::where('id', Auth::id())->update($data);

        return response()->json([
            'status' => true,
            'status_message' => "Selected Payment: $request->payment_option Option received successfully",
        ], 200);
    }

    public function uploadImage(Request $request)
    {
        $customer = Customer::where('id', Auth::id())->firstOrFail();

        if ($request->image) {
            $image = $request->image;
            $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));
            $imgString = imagecreatefromstring($data);

            if ($imgString != null) {

                //deleting previous image
                $image = $customer->image;
                if ($image)
                    @unlink('uploads/customers/' . $image);

                $image_name = "customer-" . time() . ".png";

                // open an image file
                $img = Image::make($imgString);

                $img->save('uploads/customers/' . $image_name);

                $data1 = (['image' => $image_name]);
                $customer->update($data1);
            }
        }

        return response()->json([
            'status' => true,
            'status_message' => 'Image updated successfully !!!',
            'image_link' => asset('uploads/customers/' . $image_name),
        ], 200);
    }

    public function referersList(){

        $referers = Customer::where('referer_id', Auth::id())->select('name','address', 'email', 'image')->get();
         return response()->json([
            'status' => true ,
            'status_message' => 'Image updated successfully !!!' ,
            'image_link' => asset('uploads/customers'),
           'referers' => $referers
        ], 200);

    }

    public function customerPaymentHistory()
    {
        $khalti_total_paid = 0;
        $esewa_total_paid = 0;
        $ime_total_paid = 0;
        $paypal_total_paid = 0;
        $cash_total_paid = 0;
        $payments = Payment::where('paid_status', '1')->where('customer_id', Auth::id())->get();
        foreach($payments as $row){
            if($row->khalti == 1){
                $khalti_total_paid+=$row->total_price;
            }
            elseif($row->esewa == 1){
                 $esewa_total_paid+=$row->total_price;
            }
            elseif($row->imepay == 1){
                $ime_total_paid+=$row->total_price;
            }
            elseif($row->paypal == 1){
                 $paypal_total_paid+=$row->total_price;
            }
            else{
                $cash_total_paid+=$row->total_price;
            }
        }
        $data = [
            "cash" => $cash_total_paid,
            "khalti" => $khalti_total_paid,
            "ime" => $ime_total_paid,
            "esewa" => $esewa_total_paid,
            "paypal" => $paypal_total_paid
            ];
          return response()->json([
            'status' => true ,
            'status_message' => 'Image updated successfully !!!' ,
           'data' => $data
        ], 200);

    }
}
