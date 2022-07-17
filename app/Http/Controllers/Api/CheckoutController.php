<?php

namespace App\Http\Controllers\Api;

use PDF;
use Session;
use App\Models\Order;
use App\Models\Product;
use App\Models\Payment;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\MessageOtpTrait;
use Illuminate\Support\Facades\Validator;
use App\Models\Stock;
use App\Models\StockCalculate;
use App\Models\ImeSetting;
use App\Models\Notification;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerCheckoutMail;
use App\Mail\SellerCheckoutMail;
use App\Models\Message;
use App\Models\Seller;
use GuzzleHttp\Client;
use Str;
use Illuminate\Support\Facades\DB;



class CheckoutController extends Controller
{
    use MessageOtpTrait;
    public function calculateRewardPoint($email, $totalPurchase)
    {
        $setting = Setting::first();
        $customer = Customer::where('email', $email)->first();

        $current_reward = $customer->reward_point;
        $purchase_reward = $totalPurchase * ($setting->purchase_reward / 100);
        $final_reward = $current_reward + $purchase_reward;

        $data = ([
            'reward_point' => $final_reward,
        ]);

        Customer::where('email', $email)->update($data);

        return true;
    }

    public function khaltiCheckoutApi(Request $request)
    {
        // return $request;
        $user = Customer::where('publish_status', '1')->where('delete_status', '0')->where('id', $request->userId)->first();
        if ($user->is_social_login == '1') {

            return response()->json([
                'status' => false,
                'status_message' => 'user profile incompleted !!!',
                'profile_status' => false

            ], 200);
        } else {

            if ($request->different_shipping == '1') {
                $validator = Validator::make($request->all(), [
                    'shipping_country' => 'required',
                    'shipping_state' => 'required',
                    'shipping_town' => 'required',
                    'shipping_street' => 'required',
                    'shipping_apartment' => 'required',
                    'shipping_zipcode' => 'required',
                    'contact_person' => 'required',
                    'contact_number' => 'required'
                ]);


                if ($validator->fails()) {
                    return response()->json([
                        $validator->messages(),
                        'status' => false,
                        'status_message' => 'validation error !!!'
                    ], 200);
                }
            }

            $order = new Order();

            $ref_id = Str::random(8); //random string

            $items_arr = json_decode($request->items, true);
            $discount_amount = $request->discount;
            foreach ($items_arr as $key =>  $row) {

                $order->create([
                    'product_id' => $row['id'],
                    'quantity' => $row['quantity'],
                    'ref_id' => $ref_id,
                    'discount_amount' => $discount_amount
                ]);
            }

            $payment = new Payment();
            $totalPrice = $request->grandTotal - $request->shipping;

            $payment->customer_id = $request->userId;
            $payment->ref_id = $ref_id;
            $payment->total_price = $totalPrice;
            $payment->delivery_cost = $request->shipping;
            // $payment->complete_status = '1';
            $payment->firstname = $user->firstname;
            $payment->lastname = $user->lastname;
            $payment->country = $user->country;
            $payment->state = $user->state;
            $payment->town = $user->town;
            $payment->street = $user->street;
            $payment->apartment = $user->apartment;
            $payment->zipcode = $user->zipcode;
            $payment->email = $user->email;
            $payment->number = $user->phone;
            $payment->notes = request('notes');
            $payment->different_shipping = ($request->different_shipping == null) ? '0' : '1';
            $payment->shipping_country = request('shipping_country');
            $payment->shipping_state = request('shipping_state');
            $payment->shipping_town = request('shipping_town');
            $payment->shipping_street = request('shipping_street');
            $payment->shipping_apartment = request('shipping_apartment');
            $payment->shipping_zipcode = request('shipping_zipcode');
            $payment->shipping_phone = request('contact_number');
            $payment->shipping_contactperson = request('contact_person');
            $payment->save();

            $this->calculateRewardPoint($user->email, $payment->total_price);

            return response()->json([
                'status' => true,
                'id' => $payment->id,
                'total_price' => $request->grandTotal,
                'timestamp' => $payment->created_at,
                'ref_id' => $payment->ref_id
            ], 200);
        }
    }
    public function esewaCheckoutApi(Request $request)
    {
        // return $request;
        $user = Customer::where('publish_status', '1')->where('delete_status', '0')->where('id', $request->userId)->first();
        if ($user->is_social_login == '1') {

            return response()->json([
                'status' => false,
                'status_message' => 'user profile incompleted !!!',
                'profile_status' => false

            ], 200);
        } else {

            if ($request->different_shipping == '1') {
                $validator = Validator::make($request->all(), [
                    'shipping_country' => 'required',
                    'shipping_state' => 'required',
                    'shipping_town' => 'required',
                    'shipping_street' => 'required',
                    'shipping_apartment' => 'required',
                    'shipping_zipcode' => 'required',
                    'contact_person' => 'required',
                    'contact_number' => 'required'
                ]);


                if ($validator->fails()) {
                    return response()->json([
                        $validator->messages(),
                        'status' => false,
                        'status_message' => 'validation error !!!'
                    ], 200);
                }
            }

            $order = new Order();

            $ref_id =Str::random(8); //random string

            $items_arr = json_decode($request->items, true);
            $discount_amount = $request->discount;
            foreach ($items_arr as $key =>  $row) {

                $order->create([
                    'product_id' => $row['id'],
                    'quantity' => $row['quantity'],
                    'ref_id' => $ref_id,
                    'discount_amount' => $discount_amount
                ]);
            }

            $payment = new Payment();
            $totalPrice = $request->grandTotal - $request->shipping;

            $payment->customer_id = $request->userId;
            $payment->ref_id = $ref_id;
            $payment->total_price = $totalPrice;
            $payment->delivery_cost = $request->shipping;
            // $payment->complete_status = '1';
            $payment->firstname = $user->firstname;
            $payment->lastname = $user->lastname;
            $payment->country = $user->country;
            $payment->state = $user->state;
            $payment->town = $user->town;
            $payment->street = $user->street;
            $payment->apartment = $user->apartment;
            $payment->zipcode = $user->zipcode;
            $payment->email = $user->email;
            $payment->number = $user->phone;
            $payment->notes = request('notes');
            $payment->different_shipping = ($request->different_shipping == null) ? '0' : '1';
            $payment->shipping_country = request('shipping_country');
            $payment->shipping_state = request('shipping_state');
            $payment->shipping_town = request('shipping_town');
            $payment->shipping_street = request('shipping_street');
            $payment->shipping_apartment = request('shipping_apartment');
            $payment->shipping_zipcode = request('shipping_zipcode');
            $payment->shipping_phone = request('contact_number');
            $payment->shipping_contactperson = request('contact_person');
            $payment->save();

            $this->calculateRewardPoint($user->email, $payment->total_price);

            return response()->json([
                'status' => true,
                'id' => $payment->id,
                'total_price' => $request->grandTotal,
                'timestamp' => $payment->created_at,
                'ref_id' => $payment->ref_id
            ], 200);
        }
    }

    public function khaltiVerification(Request $request)
    {
        $oid = $request->input('oid');
        $payment = Payment::where('ref_id', $oid)->firstorfail();

        if ($payment->complete_status == "1") {
            return response()->json([  //returns success to ajax
                'status' => true,
                'status_message' => 'Your order has been placed!'
            ], 200);
        }
        // dd($payment);
        //hit the khalit server
        $args = http_build_query(array(
            'token' => $request->input('trans_token'),
            'amount'  => $request->input('amount')
        ));

        $url = "https://khalti.com/api/v2/payment/verify/";

        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $headers = ['Authorization: Key test_secret_key_f59e8b7d18b4499ca40f68195a846e9b'];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Response
        $response = curl_exec($ch);
        // dd($response);
        //see the response from khalti server
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $res = json_decode($response, true); //decode the response
        // dd($res);

        if (isset($res['idx']))  //check whether there is idx and also the amount in response with your database(I havenot done that)
        {
            // dd($res['idx']);
            if (isset($payment)) {
                $data1 = ([
                    'paid_status' => '1',
                    'complete_status' => '1',
                    'khalti' => '1'
                ]);

                Payment::where('ref_id', $oid)->update($data1);
                    //  push Notification
                // ===================

                $curl = curl_init();
             curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{
                                      "to":"/topics/'.$payment->customer_id.'",
                                         "data":{
                                             "title":"Payment Result",
                                             "type" :"khalti",
                                             "slug" : "",
                                             "message":"Payment Successfully Completed.",
                                         },
                                         "android":{
                                             "notification":{
                                                 "sound":"default"
                                             }
                                         }
                                     }',
            CURLOPT_HTTPHEADER => array(
                "Authorization: key=AAAAmfXJoYU:APA91bFJNiXLlmldpWTd1-pmy5bENGm8L9arH9Mw4JRNwngdhrbWE7UaRtEM9Fq3IQihBAzaU-bNEggwIWMaZPq5TKJF-Wqla88MB30eZLsEFpznavIlxxEQbvV0Z6sTQhYx_RWTjvpu",
                "Content-Type: application/json",
                "Postman-Token: ef8f2298-8743-4576-9a66-5065f361124f",
                "cache-control: no-cache"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

                //perform your database operation here,,,
                $notification = new Notification();

                $notification->ref_id = $oid;
                $notification->extra_data = $oid;
                $notification->customer_email = $payment->email;
                $notification->type = "pending";
                $notification->title = "Your purchase for order id $oid is successfully placed.";

                $notification->save();


                // Updating stock after delivery
                $items_arr = Order::where('ref_id', $oid)->select('product_id', 'quantity')->get();

                foreach ($items_arr as $key =>  $row) {
                    $curStock = Stock::where('product_id', $row->product_id)->first();
                    $stockcal = new StockCalculate($curStock);
                    $stockcal->withholdingStock($row->quantity);
                    $curStock->withholding_stock = $stockcal->withholding_stock;
                    $curStock->remaining_stock = $stockcal->remaining_stock;
                    $curStock->save();
                }

                $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                    ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
                    ->where('tbl_payments.ref_id', $payment->ref_id)
                    ->select('tbl_products.product_name', 'tbl_products.product_original_price', 'tbl_orders.quantity')
                    ->get();

                // Sending mail to customer and sellers after checkout
                $setting = Setting::first();
                $pdf = PDF::loadView('emails.customer.customercheckoutmailpdf', compact('orders', 'payment', 'setting'));
                Mail::to($payment->email)->send(new CustomerCheckoutMail($payment, $orders, $pdf));
                $message = "This is to confirm that your order with Order ID: ".$payment->ref_id." has been placed. Payment via Khalti.";
                $this->sendSMS($payment->number, $payment->firstname, $message);
                // foreach ($items_arr as $row) {
                //     $product = Product::where('id', $row->product_id)->first();
                //     $seller = $product->seller;
                //     $seller_email = $seller->email;
                //     if (isset($seller_email)) {
                //         $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                //             ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
                //             ->where('tbl_payments.ref_id', $payment->ref_id)
                //             ->select('tbl_products.product_name', 'tbl_products.product_original_price', 'tbl_orders.quantity')
                //             ->where('tbl_products.owner_id', $seller->id)
                //             ->get();
                //         Mail::to($seller_email)->send(new SellerCheckoutMail($payment, $orders));
                //     }
                // }

                $product_ids = Order::where('ref_id', $oid)->get('product_id');
                $seller_ids = Product::whereIn('id', $product_ids)->groupBy('owner_id')->get('owner_id');
                $sellers = Seller::whereIn('id', $seller_ids)->get();
                foreach ($sellers as $seller) {
                    $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                        ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
                        ->where('tbl_payments.ref_id', $payment->ref_id)
                        ->select('tbl_products.product_name', 'tbl_products.product_original_price', 'tbl_orders.quantity')
                        ->where('tbl_products.owner_id', $seller->id)
                        ->get();

                    Mail::to($seller->email)->send(new SellerCheckoutMail($payment, $orders)); //Mail to Seller
                }

                //Sending default message
                if ($payment->customer_id != 0) {
                    $product_ids = Order::where('ref_id', $payment->ref_id)->get('product_id');
                    $seller_ids = Product::whereIn('id', $product_ids)->groupBy('owner_id')->get('owner_id');
                    $sellers = Seller::whereIn('id', $seller_ids)->get();

                    foreach ($sellers as $seller) {
                        $message = new Message();
                        $message->owner_id = $seller->id;
                        $message->customer_id = $payment->customer_id;
                        $message->message = 'Thank You for shopping with ' . config('app.name') . '. Feel Free to message us at any time.';
                        $message->send_by = "seller";
                        $message->save();
                    }
                }
            }
            //perform your database operation here,,,
            return response()->json([  //returns success to ajax
                'status' => true,
                'status_message' => 'Your order has been placed.'
            ], 200);
        } else {

            return response()->json([ //returns failure to ajax
            'status' => false,
                'status_message' => 'Something went Wrong.',
            ], 502);
        }
    }

    // //  IME PAY CHECKOUT
    public function esewaVerification(Request $request)
    {
        $oid = $request->input('oid');
        $payment = Payment::where('ref_id', $oid)->firstorfail();

        if ($payment->complete_status == "1") {
            return response()->json([  //returns success to ajax
                'status' => true,
                'status_message' => 'Your order has been placed!'
            ], 200);
        }
        // dd($payment);

            $client = new Client();
            $url = "https://uat.esewa.com.np/mobile/transaction?txnRefId=".$request->txID;
            // $response = $client->request('GET',$url);
            $response = $client->get($url, [
                'headers' => [
                    'merchantId' => 'JB0BBQ4aD0UqIThFJwAKBgAXEUkEGQUBBAwdOgABHD4DChwUAB0R',
                    'merchantSecret'     => 'BhwIWQQADhIYSxILExMcAgFXFhcOBwAKBgAXEQ==',
                    'Content-Type'      => 'application/json'
                ]
            ]);
            $status = json_decode($response->getBody()->getContents());
            // dd($status[0]->transactionDetails->status);
            // dd($status[0]->totalAmount);

            if ($status[0]->transactionDetails->status == 'COMPLETE'){
                // dd($res['idx']);
                if (isset($payment)) {
                    $data1 = ([
                        'paid_status' => '1',
                        'complete_status' => '1',
                        'esewa' => '1'
                    ]);

                    Payment::where('ref_id', $oid)->update($data1);
                        //  push Notification
                    // ===================

                    $curl = curl_init();
                 curl_setopt_array($curl, array(
                CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => '{
                                          "to":"/topics/'.$payment->customer_id.'",
                                             "data":{
                                                 "title":"Payment Result",
                                                 "type" :"khalti",
                                                 "slug" : "",
                                                 "message":"Payment Successfully Completed.",
                                             },
                                             "android":{
                                                 "notification":{
                                                     "sound":"default"
                                                 }
                                             }
                                         }',
                CURLOPT_HTTPHEADER => array(
                    "Authorization: key=AAAAmfXJoYU:APA91bFJNiXLlmldpWTd1-pmy5bENGm8L9arH9Mw4JRNwngdhrbWE7UaRtEM9Fq3IQihBAzaU-bNEggwIWMaZPq5TKJF-Wqla88MB30eZLsEFpznavIlxxEQbvV0Z6sTQhYx_RWTjvpu",
                    "Content-Type: application/json",
                    "Postman-Token: ef8f2298-8743-4576-9a66-5065f361124f",
                    "cache-control: no-cache"
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

                    //perform your database operation here,,,
                    $notification = new Notification();

                    $notification->ref_id = $oid;
                    $notification->extra_data = $oid;
                    $notification->customer_email = $payment->email;
                    $notification->type = "pending";
                    $notification->title = "Your purchase for order id $oid is successfully placed.";

                    $notification->save();


                    // Updating stock after delivery
                    $items_arr = Order::where('ref_id', $oid)->select('product_id', 'quantity')->get();

                    foreach ($items_arr as $key =>  $row) {
                        $curStock = Stock::where('product_id', $row->product_id)->first();
                        $stockcal = new StockCalculate($curStock);
                        $stockcal->withholdingStock($row->quantity);
                        $curStock->withholding_stock = $stockcal->withholding_stock;
                        $curStock->remaining_stock = $stockcal->remaining_stock;
                        $curStock->save();
                    }

                    $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                        ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
                        ->where('tbl_payments.ref_id', $payment->ref_id)
                        ->select('tbl_products.product_name', 'tbl_products.product_original_price', 'tbl_orders.quantity')
                        ->get();

                    // Sending mail to customer and sellers after checkout
                    $setting = Setting::first();
                    $pdf = PDF::loadView('emails.customer.customercheckoutmailpdf', compact('orders', 'payment', 'setting'));
                    Mail::to($payment->email)->send(new CustomerCheckoutMail($payment, $orders, $pdf));
                    $message = "This is to confirm that your order with Order ID: ".$payment->ref_id." has been placed. Payment via Khalti.";
                    $this->sendSMS($payment->number, $payment->firstname, $message);
                    // foreach ($items_arr as $row) {
                    //     $product = Product::where('id', $row->product_id)->first();
                    //     $seller = $product->seller;
                    //     $seller_email = $seller->email;
                    //     if (isset($seller_email)) {
                    //         $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                    //             ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
                    //             ->where('tbl_payments.ref_id', $payment->ref_id)
                    //             ->select('tbl_products.product_name', 'tbl_products.product_original_price', 'tbl_orders.quantity')
                    //             ->where('tbl_products.owner_id', $seller->id)
                    //             ->get();
                    //         Mail::to($seller_email)->send(new SellerCheckoutMail($payment, $orders));
                    //     }
                    // }

                    $product_ids = Order::where('ref_id', $oid)->get('product_id');
                    $seller_ids = Product::whereIn('id', $product_ids)->groupBy('owner_id')->get('owner_id');
                    $sellers = Seller::whereIn('id', $seller_ids)->get();
                    foreach ($sellers as $seller) {
                        $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                            ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
                            ->where('tbl_payments.ref_id', $payment->ref_id)
                            ->select('tbl_products.product_name', 'tbl_products.product_original_price', 'tbl_orders.quantity')
                            ->where('tbl_products.owner_id', $seller->id)
                            ->get();

                        Mail::to($seller->email)->send(new SellerCheckoutMail($payment, $orders)); //Mail to Seller
                    }

                    //Sending default message
                    if ($payment->customer_id != 0) {
                        $product_ids = Order::where('ref_id', $payment->ref_id)->get('product_id');
                        $seller_ids = Product::whereIn('id', $product_ids)->groupBy('owner_id')->get('owner_id');
                        $sellers = Seller::whereIn('id', $seller_ids)->get();

                        foreach ($sellers as $seller) {
                            $message = new Message();
                            $message->owner_id = $seller->id;
                            $message->customer_id = $payment->customer_id;
                            $message->message = 'Thank You for shopping with ' . config('app.name') . '. Feel Free to message us at any time.';
                            $message->send_by = "seller";
                            $message->save();
                        }
                    }
                }
                //perform your database operation here,,,
                return response()->json([  //returns success to ajax
                    'status' => true,
                    'status_message' => 'Your order has been placed.'
                ], 200);
            }
         else {
            return response()->json([ //returns failure to ajax
                'status' => false,
                    'status_message' => 'Something went Wrong.',
                ], 502);
        }

    }

    public function imepayCheckoutApi(Request $request)
    {
        $user = Customer::where('publish_status', '1')->where('delete_status', '0')->where('id', $request->userId)->first();
        if ($user->is_social_login == '1') {

            return response()->json([
                'status' => false,
                'status_message' => 'user profile incompleted !!!',
                'profile_status' => false

            ], 200);
        } else {

            if ($request->different_shipping == '1') {
                $validator = Validator::make($request->all(), [
                    'shipping_country' => 'required',
                    'shipping_state' => 'required',
                    'shipping_town' => 'required',
                    'shipping_street' => 'required',
                    'shipping_apartment' => 'required',
                    'shipping_zipcode' => 'required',
                    'contact_person' => 'required',
                    'contact_number' => 'required'
                ]);


                if ($validator->fails()) {
                    return response()->json([
                        $validator->messages(),
                        'status' => false,
                        'status_message' => 'validation error !!!'
                    ], 200);
                }
            }

            $order = new Order();

            $ref_id = Str::random(8); //random string

            $items_arr = json_decode($request->items, true);
            $discount_amount = $request->discount;
            foreach ($items_arr as $key =>  $row) {

                $order->create([
                    'product_id' => $row['id'],
                    'quantity' => $row['quantity'],
                    'ref_id' => $ref_id,
                    'discount_amount' => $discount_amount
                ]);
            }

            $payment = new Payment();
            $totalPrice = $request->grandTotal - $request->shipping;

            $payment->customer_id = $request->userId;
            $payment->ref_id = $ref_id;
            $payment->total_price = $totalPrice;
            $payment->delivery_cost = $request->shipping;
            // $payment->complete_status = '1';
            $payment->firstname = $user->firstname;
            $payment->lastname = $user->lastname;
            $payment->country = $user->country;
            $payment->state = $user->state;
            $payment->town = $user->town;
            $payment->street = $user->street;
            $payment->apartment = $user->apartment;
            $payment->zipcode = $user->zipcode;
            $payment->email = $user->email;
            $payment->number = $user->phone;
            $payment->notes = request('notes');
            $payment->different_shipping = ($request->different_shipping == null) ? '0' : '1';
            $payment->shipping_country = request('shipping_country');
            $payment->shipping_state = request('shipping_state');
            $payment->shipping_town = request('shipping_town');
            $payment->shipping_street = request('shipping_street');
            $payment->shipping_apartment = request('shipping_apartment');
            $payment->shipping_zipcode = request('shipping_zipcode');
            $payment->shipping_phone = request('contact_number');
            $payment->shipping_contactperson = request('contact_person');

            $payment->save();
            // return $payment;

            $this->calculateRewardPoint($user->email, $payment->total_price);
            return response()->json([
                'status' => true,
                'id' => $payment->id,
                'total_price' => $request->grandTotal,
                'timestamp' => $payment->created_at,
                'ref_id' => $payment->ref_id
            ], 200);
        }
    }

    public function imepayRecordingApi(Request $request)
    {
        $ime_setting  = new ImeSetting();
        $ime_setting->MerchantCode = $request->MerchantCode;
        $ime_setting->RefId = $request->ReferenceId;
        $ime_setting->TokenId = $request->TokenId;
        $ime_setting->TranAmount = $request->Amount;
        $ime_setting->save();

        return response()->json([
            'status' => true,
            'ResponseCode' => "0",
            'ReferenceId' => $ime_setting->RefId,
            'ResponseDescription' => "Request Payment Recorded"
        ], 200);
    }

    //   public function imepayVerify(Request $request,$refId)
    //     {
    //         $check_url = 'https://stg.imepay.com.np:7979/api/Web/Recheck';

    //         $detail = ImeSetting::where('RefId',$refId)->first();
    //         return $detail->TokenId;

    //         $data = [
    //             'MerchantCode' => $detail->MerchantCode,
    //             'RefId' => $detail->RefId,
    //             'TokenId' => $detail->TokenId
    //             ];

    //         $curl = curl_init();

    //         curl_setopt_array($curl, array(
    //             CURLOPT_URL => "https://stg.imepay.com.np:7979/api/Web/Recheck",
    //             CURLOPT_RETURNTRANSFER => true,
    //             CURLOPT_ENCODING => "",
    //             CURLOPT_MAXREDIRS => 10,
    //             CURLOPT_TIMEOUT => 30000,
    //             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //             CURLOPT_CUSTOMREQUEST => "POST",
    //             CURLOPT_POSTFIELDS => $data,
    //             CURLOPT_HTTPHEADER => array(
    //             	// Set here requred headers
    //                 "Authorization:Basic ZXNob3BwaW5nOmltZUAxMjM0NQ==",
    //                 "Module:RVNIT1BQSU5H"
    //             ),
    //         ));

    //         $response = curl_exec($curl);

    //         curl_close($curl);

    //         return $response;
    //     }

    // public function imepayVerify(Request $request,$refId)
    // {
    //     $url = 'https://stg.imepay.com.np:7979/api/Web/Recheck';

    //     $detail = ImeSetting::where('RefId',$refId)->first();

    //     $data = [
    //         'MerchantCode' => $detail->MerchantCode,
    //         'RefId' => $detail->RefId,
    //         'TokenId' => $detail->TokenId
    //         ];

    //     # Make the call using API.
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     curl_setopt($ch, CURLOPT_POST, 1);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    //     $headers = ['Authorization:Basic ZXNob3BwaW5nOmltZUAxMjM0NQ==','Module:RVNIT1BQSU5H'];
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    //     // Response
    //     $response = curl_exec($ch);
    //     return $response;
    //     //see the response from khalti server
    //     $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    //     curl_close($ch);
    //     $res = json_decode($response, true);//decode the response

    //     return  $res;
    // }

    public function imepayVerify(Request $request, $refId)
    {
        $detail = ImeSetting::where('RefId', $refId)->first();

        if ($detail->complete_status == "1") {
            return response()->json([  //returns success to ajax
                'status' => true,
                'status_message' => 'Payment Success'
            ], 200);
        }

        $data1 = ([
            'paid_status' => '1',
            'complete_status' => '1',
            'imepay' => '1'
        ]);

        Payment::where('ref_id', $detail->RefId)->update($data1);

        $payment = Payment::where('ref_id', $refId)->first();

        //  push Notification
                // ===================

                $curl = curl_init();
             curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{
                                      "to":"/topics/'.$payment->customer_id.'",
                                         "data":{
                                             "title":"Payment Result",
                                             "type" :"imepay",
                                             "slug" : "",
                                             "message":"Payment Successfully Completed.",
                                         },
                                         "android":{
                                             "notification":{
                                                 "sound":"default"
                                             }
                                         }
                                     }',
            CURLOPT_HTTPHEADER => array(
                "Authorization: key=AAAAmfXJoYU:APA91bFJNiXLlmldpWTd1-pmy5bENGm8L9arH9Mw4JRNwngdhrbWE7UaRtEM9Fq3IQihBAzaU-bNEggwIWMaZPq5TKJF-Wqla88MB30eZLsEFpznavIlxxEQbvV0Z6sTQhYx_RWTjvpu",
                "Content-Type: application/json",
                "Postman-Token: ef8f2298-8743-4576-9a66-5065f361124f",
                "cache-control: no-cache"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $notification = new Notification();

        $notification->ref_id = $refId;
        $notification->extra_data = $refId;
        $notification->customer_email = $payment->email;
        $notification->type = "pending";
        $notification->title = "Your purchase for order id $refId is successfully placed.";

        $notification->save();

        $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
            ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
            ->where('tbl_payments.ref_id', $payment->ref_id)
            ->select('tbl_products.product_name', 'tbl_products.product_original_price', 'tbl_orders.quantity')
            ->get();

        // Updating stock after delivery
        $items_arr = Order::where('ref_id', $refId)->select('product_id', 'quantity')->get();
        foreach ($items_arr as $key =>  $row) {
            $curStock = Stock::where('product_id', $row->product_id)->first();
            $stockcal = new StockCalculate($curStock);
            $stockcal->withholdingStock($row->quantity);
            $curStock->withholding_stock = $stockcal->withholding_stock;
            $curStock->remaining_stock = $stockcal->remaining_stock;
            $curStock->save();
        }

        // Sending mail to customer and sellers after checkout
        //  return $payment;
        $setting = Setting::first();
        $pdf = PDF::loadView('emails.customer.customercheckoutmailpdf', compact('orders', 'payment', 'setting'));
        Mail::to($payment->email)->send(new CustomerCheckoutMail($payment, $orders, $pdf));
        $message = "This is to confirm that your order with Order ID: ".$payment->ref_id." has been placed. Payment via IME Pay.";
        $this->sendSMS($payment->number, $payment->firstname, $message);
        // foreach ($items_arr as $row) {
        //     $product = Product::where('id', $row->product_id)->first();
        //     $seller = $product->seller;
        //     $seller_email = $seller->email;
        //     if (isset($seller_email)) {
        //         $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
        //             ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
        //             ->where('tbl_payments.ref_id', $payment->ref_id)
        //             ->select('tbl_products.product_name', 'tbl_products.product_original_price', 'tbl_orders.quantity')
        //             ->where('tbl_products.owner_id', $seller->id)
        //             ->get();
        //         Mail::to($seller_email)->send(new SellerCheckoutMail($payment, $orders));
        //     }
        // }
        $product_ids = Order::where('ref_id', $refId)->get('product_id');
        $seller_ids = Product::whereIn('id', $product_ids)->groupBy('owner_id')->get('owner_id');
        $sellers = Seller::whereIn('id', $seller_ids)->get();
        foreach ($sellers as $seller) {
            $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
                ->where('tbl_payments.ref_id', $payment->ref_id)
                ->select('tbl_products.product_name', 'tbl_products.product_original_price', 'tbl_orders.quantity')
                ->where('tbl_products.owner_id', $seller->id)
                ->get();

            Mail::to($seller->email)->send(new SellerCheckoutMail($payment, $orders)); //Mail to Seller
        }

        //Sending default message
        if ($payment->customer_id != 0) {
            $product_ids = Order::where('ref_id', $payment->ref_id)->get('product_id');
            $seller_ids = Product::whereIn('id', $product_ids)->groupBy('owner_id')->get('owner_id');
            $sellers = Seller::whereIn('id', $seller_ids)->get();

            foreach ($sellers as $seller) {
                $message = new Message();
                $message->owner_id = $seller->id;
                $message->customer_id = $payment->customer_id;
                $message->message = 'Thank You for shopping with ' . config('app.name') . '. Feel Free to message us at any time.';
                $message->send_by = "seller";
                $message->save();
            }
        }


        return response()->json([
            'status' => true,
            'status_message' => 'Payment Success'
        ], 200);
    }

    //  PAL PAY CHECKOUT

    public function paypalCheckoutApi(Request $request)
    {
        $user = Customer::where('publish_status', '1')->where('delete_status', '0')->where('id', $request->userId)->first();
        if ($user->is_social_login == '1') {

            return response()->json([
                'status' => false,
                'status_message' => 'user profile incompleted !!!',
                'profile_status' => false

            ], 200);
        } else {

            if ($request->different_shipping == '1') {
                $validator = Validator::make($request->all(), [
                    'shipping_country' => 'required',
                    'shipping_state' => 'required',
                    'shipping_town' => 'required',
                    'shipping_street' => 'required',
                    'shipping_apartment' => 'required',
                    'shipping_zipcode' => 'required',
                    'contact_person' => 'required',
                    'contact_number' => 'required'
                ]);


                if ($validator->fails()) {
                    return response()->json([
                        $validator->messages(),
                        'status' => false,
                        'status_message' => 'validation error !!!'
                    ], 200);
                }
            }

            $order = new Order();

            $ref_id = Str::random(8); //random string


            $items_arr = json_decode($request->items, true);
            $discount_amount = $request->discount;
            foreach ($items_arr as $key =>  $row) {

                $order->create([
                    'product_id' => $row['id'],
                    'quantity' => $row['quantity'],
                    'ref_id' => $ref_id,
                    'discount_amount' => $discount_amount
                ]);
            }


            $payment = new Payment();
            $totalPrice = $request->grandTotal - $request->shipping;
            $payment->customer_id = $request->userId;
            $payment->ref_id = $ref_id;
            $payment->total_price = $totalPrice;
            $payment->delivery_cost = $request->shipping;
            // $payment->complete_status = '1';
            $payment->firstname = $user->firstname;
            $payment->lastname = $user->lastname;
            $payment->country = $user->country;
            $payment->state = $user->state;
            $payment->town = $user->town;
            $payment->street = $user->street;
            $payment->apartment = $user->apartment;
            $payment->zipcode = $user->zipcode;
            $payment->email = $user->email;
            $payment->number = $user->phone;
            $payment->notes = request('notes');
            $payment->different_shipping = ($request->different_shipping == null) ? '0' : '1';
            $payment->shipping_country = request('shipping_country');
            $payment->shipping_state = request('shipping_state');
            $payment->shipping_town = request('shipping_town');
            $payment->shipping_street = request('shipping_street');
            $payment->shipping_apartment = request('shipping_apartment');
            $payment->shipping_zipcode = request('shipping_zipcode');

            $payment->shipping_phone = request('contact_number');
            $payment->shipping_contactperson = request('contact_person');

            $payment->save();

            $this->calculateRewardPoint($user->email, $payment->total_price);

            $setting = Setting::first();
            $dollar_rate = round($request->grandTotal / $setting->dollar_rate, 2);
            return response()->json([
                'status' => true,
                'id' => $payment->id,
                'total_price' => $payment->total_price,
                'usd_amount' => $dollar_rate,
                'timestamp' => $payment->created_at,
                'ref_id' => $payment->ref_id
            ], 200);
        }
    }


    public function paypalVerify(Request $request, $refId)
    {
        $detail = Payment::where('ref_id', $refId)->firstorfail();

        if ($detail->complete_status == "1") {
            return response()->json([  //returns success to ajax
                'status' => true,
                'status_message' => 'Payment Already Success'
            ], 200);
        }

        $data1 = ([
            'paid_status' => '1',
            'complete_status' => '1',
            'paypal' => '1'
        ]);

        Payment::where('ref_id', $detail->ref_id)->update($data1);

          //  push Notification
                // ===================

                $curl = curl_init();
             curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{
                                      "to":"/topics/'.$detail->customer_id.'",
                                         "data":{
                                             "title":"Payment Result",
                                             "type" :"khalti",
                                             "slug" : "",
                                             "message":"Payment Successfully Completed.",
                                         },
                                         "android":{
                                             "notification":{
                                                 "sound":"default"
                                             }
                                         }
                                     }',
            CURLOPT_HTTPHEADER => array(
                "Authorization: key=AAAAmfXJoYU:APA91bFJNiXLlmldpWTd1-pmy5bENGm8L9arH9Mw4JRNwngdhrbWE7UaRtEM9Fq3IQihBAzaU-bNEggwIWMaZPq5TKJF-Wqla88MB30eZLsEFpznavIlxxEQbvV0Z6sTQhYx_RWTjvpu",
                "Content-Type: application/json",
                "Postman-Token: ef8f2298-8743-4576-9a66-5065f361124f",
                "cache-control: no-cache"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $payment = Payment::where('ref_id', $refId)->first();

        $notification = new Notification();

        $notification->ref_id = $refId;
        $notification->extra_data = $refId;
        $notification->customer_email = $payment->email;
        $notification->type = "pending";
        $notification->title = "Your purchase for order id $refId is successfully placed.";

        $notification->save();


        $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
            ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
            ->where('tbl_payments.ref_id', $payment->ref_id)
            ->select('tbl_products.product_name', 'tbl_products.product_original_price', 'tbl_orders.quantity')
            ->get();

        // Updating stock after delivery
        $items_arr = Order::where('ref_id', $refId)->select('product_id', 'quantity')->get();
        foreach ($items_arr as $key =>  $row) {
            $curStock = Stock::where('product_id', $row->product_id)->first();
            $stockcal = new StockCalculate($curStock);
            $stockcal->withholdingStock($row->quantity);
            $curStock->withholding_stock = $stockcal->withholding_stock;
            $curStock->remaining_stock = $stockcal->remaining_stock;
            $curStock->save();
        }

        // Sending mail to customer and sellers after checkout
        //  return $payment;
        $setting = Setting::first();
        $pdf = PDF::loadView('emails.customer.customercheckoutmailpdf', compact('orders', 'payment', 'setting'));
        Mail::to($payment->email)->send(new CustomerCheckoutMail($payment, $orders, $pdf));
        $message = "This is to confirm that your order with Order ID: ".$payment->ref_id." has been placed. Payment via Paypal.";
        $this->sendSMS($payment->number, $payment->firstname, $message);

        // foreach ($items_arr as $row) {
        //     $product = Product::where('id', $row->product_id)->first();
        //     $seller = $product->seller;
        //     $seller_email = $seller->email;
        //     if (isset($seller_email)) {
        //         $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
        //             ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
        //             ->where('tbl_payments.ref_id', $payment->ref_id)
        //             ->select('tbl_products.product_name', 'tbl_products.product_original_price', 'tbl_orders.quantity')
        //             ->where('tbl_products.owner_id', $seller->id)
        //             ->get();
        //         Mail::to($seller_email)->send(new SellerCheckoutMail($payment, $orders));
        //     }
        // }

        $product_ids = Order::where('ref_id', $refId)->get('product_id');
        $seller_ids = Product::whereIn('id', $product_ids)->groupBy('owner_id')->get('owner_id');
        $sellers = Seller::whereIn('id', $seller_ids)->get();
        foreach ($sellers as $seller) {
            $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
                ->where('tbl_payments.ref_id', $payment->ref_id)
                ->select('tbl_products.product_name', 'tbl_products.product_original_price', 'tbl_orders.quantity')
                ->where('tbl_products.owner_id', $seller->id)
                ->get();

            Mail::to($seller->email)->send(new SellerCheckoutMail($payment, $orders)); //Mail to Seller
        }

        //Sending default message
        if ($payment->customer_id != 0) {
            $product_ids = Order::where('ref_id', $payment->ref_id)->get('product_id');
            $seller_ids = Product::whereIn('id', $product_ids)->groupBy('owner_id')->get('owner_id');
            $sellers = Seller::whereIn('id', $seller_ids)->get();

            foreach ($sellers as $seller) {
                $message = new Message();
                $message->owner_id = $seller->id;
                $message->customer_id = $payment->customer_id;
                $message->message = 'Thank You for shopping with ' . config('app.name') . '. Feel Free to message us at any time.';
                $message->send_by = "seller";
                $message->save();
            }
        }

        return response()->json([
            'status' => true,
            'status_message' => 'Payment Success'
        ], 200);
    }
    public function getToken(Request $request)
    {
        $ime =  new ImeSetting();
        $ime->MerchantCode = 'ESHOPPING';
        $ime->TokenId = $request->tokenId;
        $ime->TranAmount = $request->amount;
        $ime->RefId =  $request->refId;
        $ime->save();

        return response($ime->RefId, 200)
            ->header('Content-Type', 'text/plain');
    }
}
