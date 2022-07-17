<?php

namespace App\Http\Controllers\Customer;

use App\Models\Coupon;
use App\Models\Customer;
// use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\CustomerCancelOrderMail;
use App\Models\Message;
use App\Models\Order;
use App\Models\OrderCancel;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Setting;
use App\Models\Stock;
use App\Models\StockCalculate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PharIo\Manifest\Author;

class CustomerDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index()
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
        $active = "profile";

        $data = Auth::guard('web')->user();
        return view('front.customer.dashboard', compact('data', 'active', 'meta_title', 'meta_description', 'meta_keyword'));
    }

    public function profile()
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

        $data = Auth::guard('web')->user();
        $active = "profile";
        return view('front.customer.profile', compact('data', 'active', 'meta_title', 'meta_description', 'meta_keyword'));
    }

    public function editProfile($id)
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

        $active = "editprofile";


        $customer_id = Auth::guard('web')->user()->id;
        if ($customer_id == $id) {
            $customer = Customer::where('id', $id)->first();
            return view('front.customer.editprofile', compact('customer', 'active', 'meta_title', 'meta_description', 'meta_keyword'));
        } else {
            abort('403');
        }
    }

    public function updateProfile($id)
    {
        $customer = Customer::where('id', $id)->first();

        $this->validate(request(), [
            'name' => 'required',
            // 'username' => 'required|unique:tbl_customers,username,' . $customer->id,
            // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required|email|unique:tbl_customers,email,' . $customer->id,
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required_with:password_confirmation|same:password_confirmation',
        ]);

        $data = ([
            'name' => request('name'),
            // 'username' => request('username'),
            'email' => request('email'),
            'phone' => request('phone'),
            'address' => request('address')
        ]);

        /////////// For password change//////////////////
        $password = request('password');
        if ($password != null) {
            $data2 = ([
                'password' => Hash::make(request('password'))
            ]);
            $customer->update($data2);
        }

        $file = request()->file('image');

        if ($file != null) {

            //deleting previous image
            $image = $customer->image;
            @unlink('uploads/customers/' . $image);

            $image_name = "customer-" . time() . "." . $file->clientExtension();

            // open an image file
            $img = Image::make($file);

            $img->save('uploads/customers/' . $image_name);

            $data1 = (['image' => $image_name]);
            $customer->update($data1);
        }

        $customer->update($data);

        //redirect to dashboard
        return redirect('/dashboard/profile')->with('success', 'Profile updated successfully.');
    }

    public function editPayment($id)
    {
        $countries = DB::table('all_values')->select('all_values.*')->get();
        $ip = '103.124.98.25'; //change this
        // $ip = \Request::ip();
        $location = \Location::get($ip);

        $districts = DB::table('tbl_districts')->select('tbl_districts.*')->get();


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

        $active = "payment";

        $customer_id = Auth::guard('web')->user()->id;
        if ($customer_id == $id) {
            $customer = Customer::where('id', $id)->first();
            return view('front.customer.editpayment', compact('countries', 'location', 'districts', 'customer', 'active', 'meta_title', 'meta_description', 'meta_keyword'));
        } else {
            abort('403');
        }
    }

    public function updatePayment($id)
    {
        $customer = Customer::where('id', $id)->first();

        $this->validate(request(), [
            'country' => 'required',
            'state' => 'required',
            'street' => 'required',
            'town' => 'required',
            'zipcode' => 'required|regex:/\b\d{5}\b/',
            'payment_option' => 'required',
        ]);

        $data = ([
            'country' => request('country'),
            'state' => request('state'),
            'street' => request('street'),
            'town' => request('town'),
            'apartment' => request('apartment'),
            'zipcode' => request('zipcode'),
            'payment_option' => request('payment_option'),
        ]);

        $customer->update($data);

        //redirect to dashboard
        return redirect('/dashboard/profile')->with('success', 'Profile updated successfully.');
    }

    public function orders()
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

        $active = "orders";

        $customer_id = Auth::guard('web')->user()->id;

        $ref_ids = Payment::where('customer_id', $customer_id)->where('complete_status','1')->get('ref_id');
        // dd($ref_ids);
        $orders = Order::whereIn('ref_id', $ref_ids)
                ->orderBy('tbl_orders.created_at', 'desc')
                ->where('cancelled', '0')
                ->where('delivered','0')
                ->select('ref_id','created_at', DB::raw('count(*) as total'))
                ->groupBy('ref_id')
                ->paginate(5);
        // dd($orders);

        // $orders = Order::where('cancelled', '0')->whereIn('ref_id',$ref_ids)->groupBy('ref_id')->paginate(5);

        return view('front.customer.orders', compact('orders', 'active', 'meta_title', 'meta_description', 'meta_keyword'));
    }

    public function showOrder($ref_id)
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

        $active = "orders";

        $customer_id = Auth::guard('web')->user()->id;

        $ordered_products = Order::join('tbl_payments', 'tbl_orders.ref_id', 'tbl_payments.ref_id')
            ->join('tbl_products', 'tbl_orders.product_id', 'tbl_products.id')
            ->where('tbl_payments.customer_id', $customer_id)
            ->where('tbl_orders.cancelled', '0')
            ->where('tbl_orders.ref_id', $ref_id)
            ->orderBy('tbl_orders.created_at', 'desc')
            ->select('tbl_products.*', 'tbl_payments.*', 'tbl_orders.quantity', 'tbl_orders.created_at', 'tbl_products.id')
            ->get();
            // dd($ordered_products);
        return view('front.customer.order-detail', compact('ref_id', 'ordered_products', 'active', 'meta_title', 'meta_description', 'meta_keyword'));
    }

    public function completeOrders()
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

        $active = "complete";

        $customer_id = Auth::guard('web')->user()->id;

        $ref_ids = Payment::where('customer_id', $customer_id)->where('complete_status','1')->get('ref_id');
        // dd($ref_ids);
        $orders = Order::whereIn('ref_id', $ref_ids)
                ->orderBy('tbl_orders.created_at', 'desc')
                // ->where('cancelled', '0')
                ->where('delivered','1')
                ->select('ref_id', DB::raw('count(*) as total'))
                ->groupBy('ref_id')
                ->paginate(5);
        // dd($orders);

        // $orders = Order::where('cancelled', '0')->whereIn('ref_id',$ref_ids)->groupBy('ref_id')->paginate(5);

        return view('front.customer.delivered', compact('orders', 'active', 'meta_title', 'meta_description', 'meta_keyword'));
    }

    public function showCompleteOrder($ref_id)
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

        $active = "complete";

        $customer_id = Auth::guard('web')->user()->id;

        $ordered_products = Order::join('tbl_payments', 'tbl_orders.ref_id', 'tbl_payments.ref_id')
            ->join('tbl_products', 'tbl_orders.product_id', 'tbl_products.id')
            ->where('tbl_payments.customer_id', $customer_id)
            ->where('tbl_orders.cancelled', '0')
            ->where('tbl_orders.ref_id', $ref_id)
            ->orderBy('tbl_orders.created_at', 'desc')
            ->select('tbl_products.*', 'tbl_payments.*', 'tbl_orders.quantity', 'tbl_orders.created_at', 'tbl_products.id')
            ->get();

        return view('front.customer.complete-order-detail', compact('ref_id', 'ordered_products', 'active', 'meta_title', 'meta_description', 'meta_keyword'));
    }

    public function cancellation()
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

        $active = "cancellations";

        $customer_id = Auth::guard('web')->user()->id;

        $ref_ids = Payment::where('customer_id', $customer_id)->get('ref_id');
        // dd($ref_ids);
        $orders = Order::whereIn('ref_id', $ref_ids)->orderBy('tbl_orders.updated_at', 'desc')->where('cancelled', '1')->groupBy('ref_id')->select('ref_id', DB::raw('count(*) as total'))->paginate(5);
        // dd($orders);

        // $orders = Order::where('cancelled', '0')->whereIn('ref_id',$ref_ids)->groupBy('ref_id')->paginate(5);

        return view('front.customer.cancellation', compact('orders', 'active', 'meta_title', 'meta_description', 'meta_keyword'));
    }

    public function showCancel($ref_id)
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

        $active = "cancellations";

        $customer_id = Auth::guard('web')->user()->id;
        $cancelled_products = Order::join('tbl_payments', 'tbl_orders.ref_id', 'tbl_payments.ref_id')
            ->join('tbl_products', 'tbl_orders.product_id', 'tbl_products.id')
            ->where('tbl_payments.customer_id', $customer_id)
            ->where('tbl_orders.cancelled', '1')
            ->where('tbl_orders.ref_id', $ref_id)
            ->select('tbl_products.*', 'tbl_payments.*', 'tbl_orders.created_at', 'tbl_products.id')
            ->get();

        return view('front.customer.cancel-detail', compact('ref_id', 'cancelled_products', 'active', 'meta_title', 'meta_description', 'meta_keyword'));
    }

    public function wishlist()
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

        $active = "wishlist";

        if (Auth::guard('web')->check()) {
            $wishlist_products = Auth::guard('web')->user()->wishlist;

            return view('front.customer.wishlist', compact('wishlist_products', 'active', 'meta_title', 'meta_description', 'meta_keyword'));
        }
        return redirect('/signin')->with('status', 'Please Login to continue');
    }

    public function favouriteStores()
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

        $active = "favouriteStores";

        return view('front.customer.favouritestores', compact('active', 'meta_title', 'meta_description', 'meta_keyword'));
    }

    public function vouchers()
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

        $active = "vouchers";

        $coupons = Coupon::where('publish_status', '1')->where('delete_status', '0')
            ->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->get();

        return view('front.customer.vouchers', compact('coupons', 'active', 'meta_title', 'meta_description', 'meta_keyword'));
    }

    public function returns()
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

        $active = "returns";

        return view('front.customer.return', compact('active', 'meta_title', 'meta_description', 'meta_keyword'));
    }

    public function feedback()
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

        $active = "feedback";

        return view('front.customer.feedback', compact('active', 'meta_title', 'meta_description', 'meta_keyword'));
    }

    public function support()
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

        $active = "support";

        return view('front.customer.support', compact('active', 'setting', 'meta_title', 'meta_description', 'meta_keyword'));
    }

    public function cancelOrder($ref_id, Request $request)
    {
        $this->validate(request(),[
            'reason' => 'required'
        ]);

        $item_arr = Order::where('ref_id', $ref_id)->get();
        foreach ($item_arr as  $product) {
            $curStock = Stock::where('product_id', $product->product_id)->first();
            $stockcal = new StockCalculate($curStock);
            $stockcal->returnOrderStock($product->quantity);
            $curStock->withholding_stock = $stockcal->withholding_stock;
            $curStock->remaining_stock = $stockcal->remaining_stock;
            $curStock->save();
        }

        Order::where('ref_id', $ref_id)->update(["cancelled" => "1"]);

        $order = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
        ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
        ->where('tbl_payments.ref_id', $ref_id)
        ->select('tbl_products.product_name', 'tbl_orders.updated_at', 'tbl_payments.ref_id', 'tbl_products.product_original_price', 'tbl_orders.quantity')
        ->first();

        Mail::to(Auth::user()->email)->send(new CustomerCancelOrderMail($order)); //Mail to Customer

        OrderCancel::create([
            'ref_id' => $ref_id,
            'reason' => $request->reason
        ]);

        return back()->with('success', 'Order cancelled successfully');
    }

    public function onlinePayment($id)
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
        $active = "online-payment";

        $customer_id = Auth::guard('web')->user()->id;
        if ($customer_id == $id) {
            $customer = Customer::where('id', $id)->first();
            return view('front.customer.online-payment', compact('active', 'setting', 'meta_title', 'meta_description', 'meta_keyword', 'customer'));
        } else {
            abort('403');
        }
    }
}
