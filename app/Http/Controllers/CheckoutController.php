<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\Stock;
use App\Models\Customer;
use App\Models\Seller;
use App\Models\Message;
use App\Models\CouponUsage;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Setting;
use App\Models\DeliveryServiceArea;
use App\Models\DeliveryServiceAreaDistrict;
use Carbon\Carbon;
use App\Models\ImeSetting;
use PayPal\Api\Amount;
use App\Models\StockCalculate;
use PayPal\Api\Details;
use App\Models\DeliverySetting;
use PayPal\Api\Transaction;
use Illuminate\Http\Request;
use App\Mail\SellerCheckoutMail;
use PayPal\Api\PaymentExecution;
use App\Mail\CustomerCheckoutMail;
use Illuminate\Support\Facades\DB;
use PayPal\Api\Payment as Payments;
use App\Http\Traits\MessageOtpTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
class CheckoutController extends Controller
{
    use MessageOtpTrait;

    public function file_get_contents_curl($url)
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    public function calculateRewardPoint($email, $totalPurchase)
    {
        $setting = Setting::first();
        $customer = Customer::where('email', $email)->first();

        if(isset($customer))
        {
            $current_reward = $customer->reward_point;
            $purchase_reward = $totalPurchase * ($setting->purchase_reward / 100);
            $final_reward = $current_reward + $purchase_reward;

            $data = ([
                'reward_point' => $final_reward,
            ]);

            Customer::where('email', $email)->update($data);
        }
        return true;
    }

    // public function getExchangeRate()
    // {

    //     // dd("asdf");
    // 	$YY=date('Y');
    // 	$MM=date('M');
    // 	$DD=date('D');
    // 	$url='https://www.nrb.org.np/exportForexJSON.php?YY=$YY&MM=$MM&DD=$DD&YY1=YY&MM1=MM&DD1=DD';
    // 	$json = $this->file_get_contents_curl( $url );
    //     $array = json_decode($json);
    //     return $array;
    // 	return $array->Conversion()->Currency();
    // }

    // public function getExchangeRate()
    // {
    //     $test = '<iframe src="https://www.ashesh.com.np/forex/widget2.php?api=3301y0h537" frameborder="0" marginwidth="0" marginheight="0" style="border:none; overflow:hidden; width:100%; height:625px; border-radius:5px;" scrolling="no" allowtransparency="true">
    //         </iframe>';

    //     return $test;
    // }

    // public function getExchangeRate(){
    //     [{"date":"2020-05-08T00:00:24","date_gmt":"2020-05-07T18:15:24","modified":"2020-05-07T17:39:49","modified_gmt":"2020-05-07T11:54:49","acf":[],"rates":{"inr":{"buy":"160.00","sell":"160.15"},"usd":{"buy":"120.92","sell":"121.52"},"eur":{"buy":"130.50","sell":"131.15"},"gbp":{"buy":"149.45","sell":"150.19"},"chf":{"buy":"123.85","sell":"124.47"},"aud":{"buy":"78.17","sell":"78.55"},"cad":{"buy":"85.91","sell":"86.33"},"sgd":{"buy":"85.26","sell":"85.69"},"jpy":{"buy":"11.35","sell":"11.40"},"cny":{"buy":"17.06","sell":"17.15"},"sar":{"buy":"32.19","sell":"32.35"},"qar":{"buy":"33.21","sell":"33.37"},"thb":{"buy":"3.73","sell":"3.75"},"aed":{"buy":"32.92","sell":"33.08"},"myr":{"buy":"27.96","sell":"28.10"},"krw":{"buy":"9.88","sell":"9.93"},"sek":{"buy":"12.29","sell":"12.35"},"dkk":{"buy":"17.49","sell":"17.58"},"hkd":{"buy":"15.60","sell":"15.68"},"kwd":{"buy":"391.06","sell":"393.00"},"bhd":{"buy":"320.14","sell":"321.73"}}},{"date":"2020-05-07T00:00:50","date_gmt":"2020-05-06T18:15:50","modified":"2020-05-06T14:39:45","modified_gmt":"2020-05-06T08:54:45","acf":[],"rates":{"inr":{"buy":"160.00","sell":"160.15"},"usd":{"buy":"120.92","sell":"121.52"},"eur":{"buy":"130.53","sell":"131.18"},"gbp":{"buy":"149.55","sell":"150.29"},"chf":{"buy":"123.97","sell":"124.58"},"aud":{"buy":"77.65","sell":"78.04"},"cad":{"buy":"86.02","sell":"86.45"},"sgd":{"buy":"85.21","sell":"85.63"},"jpy":{"buy":"11.36","sell":"11.42"},"cny":{"buy":"17.04","sell":"17.13"},"sar":{"buy":"32.20","sell":"32.36"},"qar":{"buy":"33.21","sell":"33.37"},"thb":{"buy":"3.73","sell":"3.75"},"aed":{"buy":"32.92","sell":"33.08"},"myr":{"buy":"27.98","sell":"28.12"},"krw":{"buy":"9.88","sell":"9.93"},"sek":{"buy":"12.26","sell":"12.32"},"dkk":{"buy":"17.49","sell":"17.58"},"hkd":{"buy":"15.60","sell":"15.68"},"kwd":{"buy":"391.12","sell":"393.06"},"bhd":{"buy":"320.14","sell":"321.73"}}}]
    // }

    public function esewaCheckoutApi(Request $request)
    {
        $cart_products = $request->session()->get('cart')->items;

        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'country' => 'required',
            'street' => 'required',
            'zipcode' => 'required|regex:/\b\d{5}\b/',
            'email' => 'required|email',
            'number' => 'required|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
            'shipping_country' => 'required',
            'shipping_street' => 'required',
            'shipping_zipcode' => 'required|regex:/\b\d{5}\b/',
            'shipping_phone' => 'required|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
            //'notes' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json(['error'=>$validator->messages()], 401);
            // return response()->json([
            //     'status' => 'error',
            //     'msg' => 'error',
            //     'errors' => $validator->messages()
            // ], 422);
        }


        $order = new Order();

        $ref_id = "GK-".Str::random(9); //random string

        foreach ($cart_products as $row) {
            $order->create([
                'product_id' => $row['item']->id,
                'quantity' => $row['qty'],
                'aff_id' => $row['affId'],
                'ref_id' => $ref_id
            ]);
        }

        $payment = new Payment();

        $payment->customer_id = (Auth::guard('web')->check()) ? Auth::guard('web')->user()->id : '0';
        $payment->ref_id = $ref_id;
        $payment->device_type = 'web';
        // $payment->total_price = $request->session()->get('cart')->totalPrice;
                $payment->total_price = request('cartTotalPrice');
        $payment->delivery_cost = request('delivery_cost');
        $payment->discount_amount = request('discount_amount');
        $payment->firstname = request('firstname');
        $payment->lastname = request('lastname');
        $payment->country = request('country');
        $payment->state = request('state');
        $payment->town = request('town');
        $payment->street = request('street');
        $payment->apartment = request('apartment');
        $payment->zipcode = request('zipcode');
        $payment->email = request('email');
        $payment->number = request('number');

        $payment->notes = request('notes');
        $payment->different_shipping = ($request->different_shipping == null) ? '0' : '1';
        $payment->shipping_country = request('shipping_country');
        $payment->shipping_state = request('shipping_state');
        $payment->shipping_town = request('shipping_town');
        $payment->shipping_street = request('shipping_street');
        $payment->shipping_apartment = request('shipping_apartment');
        $payment->shipping_zipcode = request('shipping_zipcode');
        $payment->shipping_phone = request('shipping_phone');
        $payment->shipping_contactperson = request('shipping_contactperson');

        $payment->save();
        return response()->json([
            'id' => $payment->id,
            'total_price' => $payment->total_price,
            'timestamp' => $payment->created_at,
            'ref_id' => $payment->ref_id
        ]);
    }
    protected function getHblHash($invoiceNo, $amount){

        $signatureString = env('HBL_MERCHANT_ID') . $invoiceNo . $amount . env('HBL_CURRENCY_CODE') . env('HBL_NON_SECURE');
        $secretKey = env('HBL_SECRET_KEY');
        $signData = hash_hmac('SHA256', $signatureString,$secretKey, false);
        $signData = strtoupper($signData);
        return urlencode($signData);
    }
    public function hblCheckoutApi(Request $request)
    {

        // return response()->json($request->all());

        $cart_products = $request->session()->get('cart')->items;

        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'country' => 'required',
            'street' => 'required',
            'zipcode' => 'required|regex:/\b\d{5}\b/',
            'email' => 'required|email',
            'number' => 'required|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
            'shipping_country' => 'required',
            'shipping_street' => 'required',
            'shipping_zipcode' => 'required|regex:/\b\d{5}\b/',
            'shipping_phone' => 'required|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
            //'notes' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json(['error'=>$validator->messages()], 401);
        }


        $order = new Order();

        $ref_id = "GK-".Str::random(9); //random string

        foreach ($cart_products as $row) {
            $order->create([
                'product_id' => $row['item']->id,
                'quantity' => $row['qty'],
                'aff_id' => $row['affId'],
                'ref_id' => $ref_id
            ]);
        }

        $payment = new Payment();

        $payment->customer_id = (Auth::guard('web')->check()) ? Auth::guard('web')->user()->id : '0';
        $payment->ref_id = $ref_id;
        $payment->device_type = 'web';
        // $payment->total_price = $request->session()->get('cart')->totalPrice;
                $payment->total_price = request('cartTotalPrice');
        $payment->delivery_cost = request('delivery_cost');
        $payment->discount_amount = request('discount_amount');
        $payment->firstname = request('firstname');
        $payment->lastname = request('lastname');
        $payment->country = request('country');
        $payment->state = request('state');
        $payment->town = request('town');
        $payment->street = request('street');
        $payment->apartment = request('apartment');
        $payment->zipcode = request('zipcode');
        $payment->email = request('email');
        $payment->number = request('number');

        $payment->notes = request('notes');
        $payment->different_shipping = ($request->different_shipping == null) ? '0' : '1';
        $payment->shipping_country = request('shipping_country');
        $payment->shipping_state = request('shipping_state');
        $payment->shipping_town = request('shipping_town');
        $payment->shipping_street = request('shipping_street');
        $payment->shipping_apartment = request('shipping_apartment');
        $payment->shipping_zipcode = request('shipping_zipcode');
        $payment->shipping_phone = request('shipping_phone');
        $payment->shipping_contactperson = request('shipping_contactperson');

        $payment->save();

        $amount = (int)$request->cartTotalPrice.'00';
        $prefix = 12 - strlen($amount);
        for($i=1; $i<=$prefix;$i++){
            $amount = '0'.$amount;
        }
        // dd($amount);
        // dd(substr("0000{$amount}", -6));
        // dd(str_pad($amount, 2, '0', STR_PAD_LEFT));
        return response()->json([
            'id' => $payment->id,
            'total_price' => $payment->total_price,
            'timestamp' => $payment->created_at,
            'ref_id' => $payment->ref_id,
            'amount' => $amount,
            'product_desc' => 'Product description',
            'hash' => $this->getHblHash($payment->ref_id,$amount),
        ]);
    }
    public function hblSuccess(Request $request)
    {
        if($request->respCode == 00){
            $merchantID = $request->paymentGatewayID;
            $invoiceNo = $request->invoiceNo;
            $dateTime = $request->dateTime;
            $Amount = $request->Amount;
        }

        $payment = Payment::where("ref_id", $request->invoiceNo)->firstorfail();


            if (isset($payment)) {
                $data1 = ([
                    'paid_status' => '1',
                    'complete_status' => '1',
                    'hbl_pay' => '1'
                ]);

                Payment::where('ref_id', $request->invoiceNo)->update($data1);
                // Session::forget('cart');
            }

            $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
                ->where('tbl_payments.ref_id', $payment->ref_id)
                ->select('tbl_products.product_name', 'tbl_products.product_slug', 'tbl_products.product_original_price', 'tbl_orders.quantity')
                ->get();

            //Updating stock after delivery
            $cart_products = $request->session()->get('cart')->items;

            foreach ($cart_products as $product) {
                $curStock = Stock::where('product_id', $product['item']->id)->first();
                $stockcal = new StockCalculate($curStock);
                $stockcal->withholdingStock($product['qty']);
                $curStock->withholding_stock = $stockcal->withholding_stock;
                $curStock->remaining_stock = $stockcal->remaining_stock;
                $curStock->save();
            }

            $setting = Setting::first();
            $pdf = PDF::loadView('emails.customer.customercheckoutmailpdf', compact('orders', 'payment', 'setting'));
            Mail::to($payment->email)->send(new CustomerCheckoutMail($payment, $orders, $pdf));
            $message = "This is to confirm that your order with Order ID: ".$payment->ref_id." has been placed. Payment via Himalayan Bank Ltd";
            $this->sendSMS($payment->number, $payment->firstname, $message);

            // Sending mail to customer and sellers after checkout

            if(isset($setting->email)){
                Mail::to($setting->email)->send(new SellerCheckoutMail($payment, $orders)); //Mail to Seller

            }


            Session::forget('cart');

            //Sending default message
            if ($payment->customer_id != 0) {

                    $message = new Message();
                    $message->owner_id = 1;
                    $message->customer_id = $payment->customer_id;
                    $message->message = 'Thank You for shopping with '.config('app.name').' . Feel Free to message us at any time.';
                    $message->send_by = "seller";
                    $message->save();

            return redirect()->route('product.checkout.show', $payment->ref_id);
        } else {
            return redirect('/')->with('error', 'Payment Unsuccessful');
        }
    }

    public function success(Request $request)
    {
        $oid = $_GET['oid'];
        $ref = $_GET['refId'];
        $verifyurl = "https://uat.esewa.com.np/epay/transrec";

        $payment = Payment::where("ref_id", $oid)->firstorfail();

        $data = [
            'amt' => $payment->total_price,
            'rid' => $ref,
            'pid' => $oid,
            'scd' => 'EPAYTEST'
        ];

        $curl = curl_init($verifyurl);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        // dd($response);
        curl_close($curl);

        if (strpos($response, "Success") !== false) {
            if (isset($payment)) {
                $data1 = ([
                    'paid_status' => '1',
                    'complete_status' => '1',
                    'esewa' => '1'
                ]);

                Payment::where('ref_id', $oid)->update($data1);
                // Session::forget('cart');
            }

            $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
                ->where('tbl_payments.ref_id', $payment->ref_id)
                ->select('tbl_products.product_name', 'tbl_products.product_slug', 'tbl_products.product_original_price', 'tbl_orders.quantity')
                ->get();

            //Updating stock after delivery
            $cart_products = $request->session()->get('cart')->items;

            foreach ($cart_products as $product) {
                $curStock = Stock::where('product_id', $product['item']->id)->first();
                $stockcal = new StockCalculate($curStock);
                $stockcal->withholdingStock($product['qty']);
                $curStock->withholding_stock = $stockcal->withholding_stock;
                $curStock->remaining_stock = $stockcal->remaining_stock;
                $curStock->save();
            }

            $setting = Setting::first();
            $pdf = PDF::loadView('emails.customer.customercheckoutmailpdf', compact('orders', 'payment', 'setting'));
            Mail::to($request->email)->send(new CustomerCheckoutMail($payment, $orders, $pdf));
            $message = "This is to confirm that your order with Order ID: ".$payment->ref_id." has been placed. Payment via e-Sewa.";
            $this->sendSMS($payment->number, $payment->firstname, $message);

            // Sending mail to customer and sellers after checkout

            // $product_ids = array_keys($cart_products);
            // $seller_ids = Product::whereIn('id', $product_ids)->groupBy('owner_id')->get('owner_id');
            // $sellers = Seller::whereIn('id', $seller_ids)->get();
            // foreach($sellers as $seller){
            // $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
            //             ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
            //             ->where('tbl_payments.ref_id', $payment->ref_id)
            //             ->select('tbl_products.product_name', 'tbl_products.product_original_price', 'tbl_orders.quantity')
            //             ->where('tbl_products.owner_id', $seller->id)
            //             ->get();

            //     Mail::to($seller->email)->send(new SellerCheckoutMail($payment, $orders)); //Mail to Seller
            // }
            if(isset($setting->email)){
                Mail::to($setting->email)->send(new SellerCheckoutMail($payment, $orders)); //Mail to Seller

            }


            Session::forget('cart');

            //Sending default message
            if ($payment->customer_id != 0) {

                    $message = new Message();
                    $message->owner_id = 1;
                    $message->customer_id = $payment->customer_id;
                    $message->message = 'Thank You for shopping with '.config('app.name').' . Feel Free to message us at any time.';
                    $message->send_by = "seller";
                    $message->save();
            }

            return redirect()->route('product.checkout.show', $payment->ref_id);
        } else {
            return redirect('/')->with('error', 'Payment Unsuccessful');
        }
    }

    public function failure()
    {
        return redirect()->route('product.checkout')->with('error', 'Payment unsuccessful.');
    }

    public function cashPaymentApi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'country' => 'required',
            'street' => 'required',
            'zipcode' => 'required|regex:/\b\d{5}\b/',
            'email' => 'required|email',
            'number' => 'required|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
            'shipping_country' => 'required',
            'shipping_street' => 'required',
            'shipping_zipcode' => 'required|regex:/\b\d{5}\b/',
            'shipping_phone' => 'required|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
            //'notes' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        return response()->json(['success' => 'success']);
    }

    public function submitCheckout(Request $request)
    {
        $order = new Order();
        $ref_id = "GK-".Str::random(9); //random string
        $cart_products = $request->session()->get('cart')->items;

        foreach ($cart_products as $row) {
            $order->create([
                'product_id' => $row['item']->id,
                'quantity' => $row['qty'],
                'aff_id' => $row['affId'],
                'ref_id' => $ref_id
            ]);
        }

        $payment = new Payment();

        $payment->customer_id = (Auth::guard('web')->check()) ? Auth::guard('web')->user()->id : '0';
        $payment->ref_id = $ref_id;
        $payment->device_type = 'web';
        // $payment->total_price = $request->session()->get('cart')->totalPrice;
                $payment->total_price = request('cartTotalPrice');
        $payment->delivery_cost = request('delivery_cost');
        $payment->complete_status = '1';
        $payment->firstname = request('firstname');
        $payment->lastname = request('lastname');
        $payment->country = request('country');
        $payment->state = request('state');
        $payment->town = request('town');
        $payment->street = request('street');
        $payment->apartment = request('apartment');
        $payment->zipcode = request('zipcode');
        $payment->email = request('email');
        $payment->number = request('number');
        $payment->notes = request('notes');
        $payment->different_shipping = ($request->different_shipping == null) ? '0' : '1';
        $payment->shipping_country = request('shipping_country');
        $payment->shipping_state = request('shipping_state');
        $payment->shipping_town = request('shipping_town');
        $payment->shipping_street = request('shipping_street');
        $payment->shipping_apartment = request('shipping_apartment');
        $payment->shipping_zipcode = request('shipping_zipcode');
        $payment->shipping_phone = request('shipping_phone');
        $payment->shipping_contactperson = request('shipping_contactperson');

        $payment->save();


        $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
        ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
        ->where('tbl_payments.ref_id', $payment->ref_id)
        ->select('tbl_products.product_name', 'tbl_products.product_slug', 'tbl_products.product_original_price', 'tbl_orders.quantity')
        ->get();

        $setting = Setting::first();

        $pdf = PDF::loadView('emails.customer.customercheckoutmailpdf', compact('orders', 'payment', 'setting'));

        Mail::to($request->email)->send(new CustomerCheckoutMail($payment, $orders, $pdf)); //Mail to Customer
        // $message = "This is to confirm that your order with Order ID: ".$payment->ref_id." has been placed. Payment via Cash.";
        // $this->sendSMS($payment->number, $payment->firstname, $message);

        //Updating stock after delivery
        foreach ($cart_products as $product) {
            $curStock = Stock::where('product_id', $product['item']->id)->first();
            $stockcal = new StockCalculate($curStock);
            $stockcal->withholdingStock($product['qty']);
            $curStock->withholding_stock = $stockcal->withholding_stock;
            $curStock->remaining_stock = $stockcal->remaining_stock;
            $curStock->save();
        }

        // Sending mail to customer and sellers after checkout

        $product_ids = array_keys($cart_products);
        $seller_ids = Product::whereIn('id', $product_ids)->groupBy('owner_id')->get('owner_id');
        $sellers = Seller::whereIn('id', $seller_ids)->get();
        foreach($sellers as $seller){
           $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                    ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
                    ->where('tbl_payments.ref_id', $payment->ref_id)
                    ->select('tbl_products.product_name', 'tbl_products.product_original_price', 'tbl_orders.quantity')
                    ->where('tbl_products.owner_id', $seller->id)
                    ->get();

            Mail::to($seller->email)->send(new SellerCheckoutMail($payment, $orders)); //Mail to Seller
        }

        // foreach ($cart_products as $product) {
        //     $product = Product::where('id', $product['item']->id)->first();
        //     $seller = $product->seller;
        //     $seller_email = $seller->email;
        //     if (isset($seller_email)) {
        //         $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
        //             ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
        //             ->where('tbl_payments.ref_id', $payment->ref_id)
        //             ->select('tbl_products.product_name', 'tbl_products.product_original_price', 'tbl_orders.quantity')
        //             ->where('tbl_products.owner_id', $seller->id)
        //             ->get();

        //         Mail::to($seller_email)->send(new SellerCheckoutMail($payment, $orders)); //Mail to Seller
        //     }
        // }

        //Sending default message
        if ($payment->customer_id != 0) {
            $product_ids = Order::where('ref_id', $payment->ref_id)->get('product_id');
            $seller_ids = Product::whereIn('id', $product_ids)->groupBy('owner_id')->get('owner_id');
            $sellers = Seller::whereIn('id', $seller_ids)->get();

            foreach ($sellers as $seller) {
                $message = new Message();
                $message->owner_id = $seller->id;
                $message->customer_id = $payment->customer_id;
                $message->message = 'Thank You for shopping with '.config('app.name').'. Feel Free to message us at any time.';
                $message->send_by = "seller";
                $message->save();
            }
        }

        $this->calculateRewardPoint($request->email, $payment->total_price);

        // Clearing cart session after checkout
        Session::forget('cart');

        return redirect()->route('product.checkout.show', $payment->ref_id);

    }

    public function downloadPdf($ref_id)
    {
        $setting = Setting::first();
        $payment = Payment::where('ref_id', $ref_id)->first();

        $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
            ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
            ->where('tbl_payments.ref_id', $payment->ref_id)
            ->select('tbl_products.product_name', 'tbl_products.product_original_price', 'tbl_orders.quantity')
            ->get();

        $pdf = PDF::loadView('emails.customer.customercheckoutmailpdf', compact('orders', 'payment', 'setting'));
        return $pdf->download('Invoice Booking.pdf');
    }

    public function showSuccess($ref_id)
    {
        $payment = Payment::where('ref_id', $ref_id)->first();
        if (!$payment) {
            return redirect()->route('website.404');
        }

        $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
            ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
            ->where('tbl_payments.ref_id', $payment->ref_id)
            ->select('tbl_products.product_name', 'tbl_products.product_slug', 'tbl_products.product_original_price', 'tbl_orders.quantity')
            ->get();

        return view('front.payments.success', compact('payment', 'orders', 'ref_id'));
    }

    public function khaltiCheckoutApi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'country' => 'required',
            'street' => 'required',
            'zipcode' => 'required|regex:/\b\d{5}\b/',
            'email' => 'required|email',
            'number' => 'required|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
            'shipping_country' => 'required',
            'shipping_street' => 'required',
            'shipping_zipcode' => 'required|regex:/\b\d{5}\b/',
            'shipping_phone' => 'required|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
            //'notes' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 401);
        }

        $order = new Order();

        $ref_id = "GK-".Str::random(9); //random string
        $cart_products = $request->session()->get('cart')->items;
        foreach ($cart_products as $row) {
            $order->create([
                'product_id' => $row['item']->id,
                'quantity' => $row['qty'],
                'aff_id' => $row['affId'],
                'ref_id' => $ref_id
            ]);
        }

        $payment = new Payment();

        $payment->customer_id = (Auth::guard('web')->check()) ? Auth::guard('web')->user()->id : '0';
        $payment->ref_id = $ref_id;
        $payment->device_type = 'web';
        // $payment->total_price = $request->session()->get('cart')->totalPrice;
                $payment->total_price = request('cartTotalPrice');
        $payment->delivery_cost = request('deliveryCost');
        $payment->discount_amount = request('discount_amount');
        $payment->firstname = request('firstname');
        $payment->lastname = request('lastname');
        $payment->country = request('country');
        $payment->state = request('state');
        $payment->town = request('town');
        $payment->street = request('street');
        $payment->apartment = request('apartment');
        $payment->zipcode = request('zipcode');
        $payment->email = request('email');
        $payment->number = request('number');

        $payment->notes = request('notes');
        $payment->different_shipping = ($request->different_shipping == null) ? '0' : '1';
        $payment->shipping_country = request('shipping_country');
        $payment->shipping_state = request('shipping_state');
        $payment->shipping_town = request('shipping_town');
        $payment->shipping_street = request('shipping_street');
        $payment->shipping_apartment = request('shipping_apartment');
        $payment->shipping_zipcode = request('shipping_zipcode');
        $payment->shipping_phone = request('shipping_phone');
        $payment->shipping_contactperson = request('shipping_contactperson');

        $payment->save();
        $deliveryCost = request("deliveryCost");

        $this->calculateRewardPoint($request->email, $payment->total_price);

        return response()->json([
            'id' => $payment->id,
            'total_price' => $payment->total_price,
            'timestamp' => $payment->created_at,
            'ref_id' => $payment->ref_id
        ]);
    }

    public function verification(Request $request)
    {
        // dd('here');
        $oid = $request->input('oid');
        $payment = Payment::where('ref_id', $oid)->firstorfail();
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
            }
            //perform your database operation here,,,

            $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
                ->where('tbl_payments.ref_id', $payment->ref_id)
                ->select('tbl_products.product_name', 'tbl_products.product_slug', 'tbl_products.product_original_price', 'tbl_orders.quantity')
                ->get();

            $setting = Setting::first();
            $pdf = PDF::loadView('emails.customer.customercheckoutmailpdf', compact('orders', 'payment', 'setting'));
            Mail::to($payment->email)->send(new CustomerCheckoutMail($payment, $orders, $pdf));
            $message = "This is to confirm that your order with Order ID: ".$payment->ref_id." has been placed. Payment via Khalti.";
            $this->sendSMS($payment->number, $payment->firstname, $message);

            //Updating stock after delivery
            $cart_products = $request->session()->get('cart')->items;
            foreach ($cart_products as $product) {
                $curStock = Stock::where('product_id', $product['item']->id)->first();
                $stockcal = new StockCalculate($curStock);
                $stockcal->withholdingStock($product['qty']);
                $curStock->withholding_stock = $stockcal->withholding_stock;
                $curStock->remaining_stock = $stockcal->remaining_stock;
                $curStock->save();
            }

            // Sending mail to customer and sellers after checkout

            $product_ids = array_keys($cart_products);
            $seller_ids = Product::whereIn('id', $product_ids)->groupBy('owner_id')->get('owner_id');
            $sellers = Seller::whereIn('id', $seller_ids)->get();
            foreach($sellers as $seller){
            $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                        ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
                        ->where('tbl_payments.ref_id', $payment->ref_id)
                        ->select('tbl_products.product_name', 'tbl_products.product_original_price', 'tbl_orders.quantity')
                        ->where('tbl_products.owner_id', $seller->id)
                        ->get();

                Mail::to($seller->email)->send(new SellerCheckoutMail($payment, $orders)); //Mail to Seller
            }

            Session::forget('cart');

            return response()->json([  //returns success to ajax
                'success' => 'Your Account is succesfully credited.',
                'ref_id' => $payment->ref_id
            ], 200);
        } else {

            return response()->json([ //returns failure to ajax
                'error' => 'Something went Wrong.',
            ], 404);
        }
    }

    public function khaltiSuccess($ref_id)
    {
        $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
            ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
            ->where('tbl_payments.ref_id', $ref_id)
            ->select('tbl_products.product_name', 'tbl_products.product_slug', 'tbl_products.product_original_price', 'tbl_orders.quantity')
            ->get();

        $payment = Payment::where('ref_id', $ref_id)->firstorfail();

        //Sending default message
        if ($payment->customer_id != 0) {
            $product_ids = Order::where('ref_id', $payment->ref_id)->get('product_id');
            $seller_ids = Product::whereIn('id', $product_ids)->groupBy('owner_id')->get('owner_id');
            $sellers = Seller::whereIn('id', $seller_ids)->get();

            foreach ($sellers as $seller) {
                $message = new Message();
                $message->owner_id = $seller->id;
                $message->customer_id = $payment->customer_id;
                $message->message = 'Thank You for shopping with '.config('app.name').'. Feel Free to message us at any time.';
                $message->send_by = "seller";
                $message->save();
            }
        }

        return view('front.payments.success', compact('payment', 'orders'));
    }

    public function PaypalCheckoutApi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'country' => 'required',
            'street' => 'required',
            'zipcode' => 'required|regex:/\b\d{5}\b/',
            'email' => 'required|email',
            'number' => 'required|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
            'shipping_country' => 'required',
            'shipping_street' => 'required',
            'shipping_zipcode' => 'required|regex:/\b\d{5}\b/',
            'shipping_phone' => 'required|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
            //'notes' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 401);
        }

        $order = new Order();

        $ref_id = "GK-".Str::random(9); //random string
        $cart_products = $request->session()->get('cart')->items;
        foreach ($cart_products as $row) {
            $order->create([
                'product_id' => $row['item']->id,
                'quantity' => $row['qty'],
                'aff_id' => $row['affId'],
                'ref_id' => $ref_id
            ]);
        }

        $payment = new Payment();

        $payment->customer_id = (Auth::guard('web')->check()) ? Auth::guard('web')->user()->id : '0';
        $payment->ref_id = $ref_id;
        $payment->device_type = 'web';
        // $payment->total_price = $request->session()->get('cart')->totalPrice;
                $payment->total_price = request('cartTotalPrice');
        $payment->delivery_cost = request('deliveryCost');
        $payment->discount_amount = request('discount_amount');
        $payment->firstname = request('firstname');
        $payment->lastname = request('lastname');
        $payment->country = request('country');
        $payment->state = request('state');
        $payment->town = request('town');
        $payment->street = request('street');
        $payment->apartment = request('apartment');
        $payment->zipcode = request('zipcode');
        $payment->email = request('email');
        $payment->number = request('number');

        $payment->notes = request('notes');
        $payment->different_shipping = ($request->different_shipping == null) ? '0' : '1';
        $payment->shipping_country = request('shipping_country');
        $payment->shipping_state = request('shipping_state');
        $payment->shipping_town = request('shipping_town');
        $payment->shipping_street = request('shipping_street');
        $payment->shipping_apartment = request('shipping_apartment');
        $payment->shipping_zipcode = request('shipping_zipcode');
        $payment->shipping_phone = request('shipping_phone');
        $payment->shipping_contactperson = request('shipping_contactperson');

        $payment->save();
        $setting = Setting::first();
        $dollar_rate = round(($payment->total_price) / $setting->dollar_rate, 2);

        $this->calculateRewardPoint($request->email, $payment->total_price);

        return response()->json([
            'id' => $payment->id,
            'total_price' => $dollar_rate,
            'timestamp' => $payment->created_at,
            'ref_id' => $payment->ref_id
        ]);
    }

    public function execute(Request $request, $id)
    {
        // return $id;
        $setting = Setting::first();
        $oid = $id;
        $paymentData = Payment::where('ref_id', $oid)->firstorfail();
        $total_price = round(($paymentData->total_price + $paymentData->delivery_cost) / $setting->dollar_rate, 2);
        // return $total_price;

        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AbIlhU1gBKJmGQuWys5PoVyNwwBSIkYI90lqgLmDwRKGgeMfQ1Gsy6Z6GYSxq2O0dVB-q1Sgn_5KHq5S', // ClientID
                'EOQ_qn4SZlokVcq5kt2AWonsLcpL8bgrRWP3yFgz88gqG5dUoJyYqjiXmOT300d12wjHNHRC8xgo6iUM' // ClientSecret
            )
        );

        $paymentId = request('paymentId');
        $payment = Payments::get($paymentId, $apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId(request('PayerID'));

        $transaction = new Transaction();
        $amount = new Amount();
        $details = new Details();

        // $details->setShipping(2.2)
        //     ->setTax(1.3)
        //     ->setSubtotal(16.50);
        $details->setSubtotal($total_price);

        $amount->setCurrency('USD');
        $amount->setTotal($total_price);
        $amount->setDetails($details);
        $transaction->setAmount($amount);

        $execution->addTransaction($transaction);
        $result = $payment->execute($execution, $apiContext);

        // return $result;
        if (isset($result))  //check whether there is idx and also the amount in response with your database(I havenot done that)
        {
            // dd($res['idx']);
            if (isset($paymentData)) {
                $data1 = ([
                    'paid_status' => '1',
                    'complete_status' => '1',
                    'paypal' => '1'
                ]);

                Payment::where('ref_id', $oid)->update($data1);
                // Session::forget('cart');
            }

            $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
                ->where('tbl_payments.ref_id', $paymentData->ref_id)
                ->select('tbl_products.product_name', 'tbl_products.product_slug', 'tbl_products.product_original_price', 'tbl_orders.quantity')
                ->get();

            //Updating stock after delivery
            $cart_products = $request->session()->get('cart')->items;

            foreach ($cart_products as $product) {
                $curStock = Stock::where('product_id', $product['item']->id)->first();
                $stockcal = new StockCalculate($curStock);
                $stockcal->withholdingStock($product['qty']);
                $curStock->withholding_stock = $stockcal->withholding_stock;
                $curStock->remaining_stock = $stockcal->remaining_stock;
                $curStock->save();
            }
            // dd($paymentData);
            // Sending mail to customer and sellers after checkout

            $pdf = PDF::loadView('emails.customer.customercheckoutmailpdf', compact('orders', 'payment', 'setting'));
            Mail::to($paymentData->email)->send(new CustomerCheckoutMail($paymentData, $orders, $pdf));
            $message = "This is to confirm that your order with Order ID: ".$payment->ref_id." has been placed. Payment via Paypal.";
            $this->sendSMS($payment->number, $payment->firstname, $message);

            // Sending mail to customer and sellers after checkout

            $product_ids = array_keys($cart_products);
            $seller_ids = Product::whereIn('id', $product_ids)->groupBy('owner_id')->get('owner_id');
            $sellers = Seller::whereIn('id', $seller_ids)->get();
            foreach($sellers as $seller){
                $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                            ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
                            ->where('tbl_payments.ref_id', $paymentData->ref_id)
                            ->select('tbl_products.product_name', 'tbl_products.product_original_price', 'tbl_orders.quantity')
                            ->where('tbl_products.owner_id', $seller->id)
                            ->get();

                Mail::to($seller->email)->send(new SellerCheckoutMail($payment, $orders)); //Mail to Seller
            }

            Session::forget('cart');

            //Sending default message
            if ($payment->customer_id != 0) {
                $product_ids = Order::where('ref_id', $paymentData->ref_id)->get('product_id');
                $seller_ids = Product::whereIn('id', $product_ids)->groupBy('owner_id')->get('owner_id');
                $sellers = Seller::whereIn('id', $seller_ids)->get();

                foreach ($sellers as $seller) {
                    $message = new Message();
                    $message->owner_id = $seller->id;
                    $message->customer_id = $paymentData->customer_id;
                    $message->message = 'Thank You for shopping with '.config('app.name').'. Feel Free to message us at any time.';
                    $message->send_by = "seller";
                    $message->save();
                }
            }

            $payment = Payment::where('ref_id', $oid)->firstorfail();
            return redirect()->route('product.checkout.show', $payment->ref_id);

            //perform your database operation here,,,
            // return response()->json([  //returns success to ajax
            //     'success' => 'Your Account is succesfully credited.',
            //     'ref_id' => $paymentData->ref_id
            // ], 200);
        } else {

            return response()->json([ //returns failure to ajax
                'error' => 'Something went Wrong.',
            ], 404);
        }
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

    public function imePaymentApi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'country' => 'required',
            'state' => 'required',
            'town' => 'required',
            'street' => 'required',
            'zipcode' => 'required|regex:/\b\d{5}\b/',
            'email' => 'required|email',
            'number' => 'required|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
            //'notes' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        if ($request->different_shipping != null) {

            $validator1 = Validator::make($request->all(), [
                'shipping_country' => 'required',
                'shipping_state' => 'required',
                'shipping_town' => 'required',
                'shipping_street' => 'required',
                'shipping_zipcode' => 'required|regex:/\b\d{5}\b/',
                'shipping_phone' => 'required|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
                'shipping_contactperson' => 'required',
            ]);

            if ($validator1->fails()) {
                return response()->json($validator1->messages(), 200);
            }
        }

        $order = new Order();

        $cart_products = $request->session()->get('cart')->items;
        foreach ($cart_products as $row) {
            $order->create([
                'product_id' => $row['item']->id,
                'quantity' => $row['qty'],
                'ref_id' => $request->refId
            ]);
        }

        $payment = new Payment();

        $payment->customer_id = (Auth::guard('web')->check()) ? Auth::guard('web')->user()->id : '0';
        $payment->ref_id = $request->refId;
        $payment->device_type = 'web';
        // $payment->total_price = $request->session()->get('cart')->totalPrice;
                $payment->total_price = request('cartTotalPrice');
        $payment->delivery_cost = request('deliveryCost');
        $payment->discount_amount = request('discount_amount');
        $payment->firstname = request('firstname');
        $payment->lastname = request('lastname');
        $payment->country = request('country');
        $payment->state = request('state');
        $payment->town = request('town');
        $payment->street = request('street');
        $payment->apartment = request('apartment');
        $payment->zipcode = request('zipcode');
        $payment->email = request('email');
        $payment->number = request('number');

        $payment->notes = request('notes');
        $payment->different_shipping = ($request->different_shipping == null) ? '0' : '1';
        $payment->shipping_country = request('shipping_country');
        $payment->shipping_state = request('shipping_state');
        $payment->shipping_town = request('shipping_town');
        $payment->shipping_street = request('shipping_street');
        $payment->shipping_apartment = request('shipping_apartment');
        $payment->shipping_zipcode = request('shipping_zipcode');
        $payment->shipping_phone = request('shipping_phone');
        $payment->shipping_contactperson = request('shipping_contactperson');

        $payment->save();

        $ime = ImeSetting::where('RefId', $payment->ref_id)->first();

        $this->calculateRewardPoint($request->email, $payment->total_price);

        return response()->json($ime);
    }

    public function imeSuccess(Request $request)
    {
        $transactionid = $request->TransactionId;
        $msisdn = $request->Msisdn;
        $tranamount = $request->TranAmount;
        $refid = $request->RefId;
        $responsecode = $request->ResponseCode;

        $data = ([
            'ResponseCode' => $responsecode,
            'TransactionId' => $msisdn,
            'Msisdn' => $tranamount,
        ]);

        ImeSetting::where('RefId', $refid)->update($data);

        if ($responsecode != 0) {
            return redirect('/')->with('error', 'Payment Unsuccessful');
        }

        if ($responsecode == 0) {
            $data1 = ([
                'paid_status' => '1',
                'complete_status' => '1',
                'imepay' => '1'
            ]);
            $payment = Payment::where('ref_id', $refid)->update($data1);

            // Session::forget('cart');

            $payment = Payment::where('ref_id', $refid)->first();

            $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
                ->where('tbl_payments.ref_id', $payment->ref_id)
                ->select('tbl_products.product_name', 'tbl_products.product_slug', 'tbl_products.product_original_price', 'tbl_orders.quantity')
                ->get();

            //Updating stock after delivery
            $cart_products = $request->session()->get('cart')->items;

            foreach ($cart_products as $product) {
                $curStock = Stock::where('product_id', $product['item']->id)->first();
                $stockcal = new StockCalculate($curStock);
                $stockcal->withholdingStock($product['qty']);
                $curStock->withholding_stock = $stockcal->withholding_stock;
                $curStock->remaining_stock = $stockcal->remaining_stock;
                $curStock->save();
            }

            // Sending mail to customer and sellers after checkout
            $setting = Setting::first();
            $pdf = PDF::loadView('emails.customer.customercheckoutmailpdf', compact('orders', 'payment', 'setting'));
            Mail::to($payment->email)->send(new CustomerCheckoutMail($payment, $orders, $pdf));
            $message = "This is to confirm that your order with Order ID: ".$payment->ref_id." has been placed. Payment via IME Pay.";
            $this->sendSMS($payment->number, $payment->firstname, $message);

            // Sending mail to customer and sellers after checkout

            $product_ids = array_keys($cart_products);
            $seller_ids = Product::whereIn('id', $product_ids)->groupBy('owner_id')->get('owner_id');
            $sellers = Seller::whereIn('id', $seller_ids)->get();
            foreach($sellers as $seller){
            $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                        ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
                        ->where('tbl_payments.ref_id', $payment->ref_id)
                        ->select('tbl_products.product_name', 'tbl_products.product_original_price', 'tbl_orders.quantity')
                        ->where('tbl_products.owner_id', $seller->id)
                        ->get();

                Mail::to($seller->email)->send(new SellerCheckoutMail($payment, $orders)); //Mail to Seller
            }

            Session::forget('cart');

            $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
                ->where('tbl_payments.ref_id', $payment->ref_id)
                ->select('tbl_products.product_name', 'tbl_products.product_original_price', 'tbl_orders.quantity')
                ->get();



            //Sending default message
            if ($payment->customer_id != 0) {
                $product_ids = Order::where('ref_id', $payment->ref_id)->get('product_id');
                $seller_ids = Product::whereIn('id', $product_ids)->groupBy('owner_id')->get('owner_id');
                $sellers = Seller::whereIn('id', $seller_ids)->get();

                foreach ($sellers as $seller) {
                    $message = new Message();
                    $message->owner_id = $seller->id;
                    $message->customer_id = $payment->customer_id;
                    $message->message = 'Thank You for shopping with '.config('app.name').'. Feel Free to message us at any time.';
                    $message->send_by = "seller";
                    $message->save();
                }
            }
        }

        return redirect()->route('product.checkout.show', $payment->ref_id);
    }

    public function verifyStock()
    {
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $cart_products = $cart->items;
        $status = true;
        $cart_product = new Collection();

        foreach ($cart_products as $product) {
            $cart_product = $product['item'];
            $stock_qty = $cart_product->fresh()->stock->remaining_stock; //refreshing model
            if ($product['qty'] > $stock_qty) {
                $status = false;
                break;
            }
        }

        return response()->json(['status' => $status, 'cart_product' => $cart_product]);
    }

    public function verifyProduct()
    {
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $cart_products = $cart->items;
        $status = true;
        $cart_product = new Collection();

        //Checking if product exists
        foreach ($cart_products as $product) {
            $cart_product = $product['item'];
            if ($product['item']->fresh()->publish_status == 0 || $product['item']->fresh()->delete_status == 1) {
                $status = false;
                break;
            }
        }

        return response()->json(['status' => $status, 'cart_product' => $cart_product]);
    }

    public function getDeliveryCharge(Request $request)
    {

        $deliveryCost = 0;
        $totalWeight = 0;

        $charge = DeliveryServiceAreaDistrict::join('delivery_service_areas','delivery_service_areas.id','=','delivery_service_area_districts.area_id')
        ->where('delivery_service_area_districts.district_id',$request->dist_id)
        ->first();

        if (isset($charge)) {
            $deliveryCost = $charge->rate;
        } else {
            $deliveryCost = 0;
        }

        return response()->json(['deliveryCost' => $deliveryCost, 'totalPrice' => (float)$request->totalPrice + $deliveryCost]);
    }

    public function getCoupon(Request $request)
    {
        $coupon = DB::table('tbl_coupon')
            ->where('coupon_code', $request->code)
            ->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->first();
        if (isset($coupon)) {
            $usage = CouponUsage::where(['customer_id' => auth()->id(),'coupon_code' => $coupon->coupon_code])->first() ? true :false;
            if($usage == true){
                return response()->json(['status' => 'used']);
            }
            CouponUsage::create([
                'customer_id' => auth()->id(),
                'coupon_code' => $coupon->coupon_code,
                'use_status' => true,
            ]);
            $discount = $coupon->discount_price;
            return response()->json(['status' => 'success', 'discount' => $discount]);
        } else {
            return response()->json(['status' => 'fail']);
        }
    }
}
