<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Models\Seller;
use App\Models\SalesReturn;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Statement;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\ImageTrait;
use App\Http\Requests\SellerRegistrationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class SellerController extends Controller
{
    use ImageTrait;
    public $calc_total_sell = 0;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function AjaxImageUpload(Request $request)
    {
        $formImage = "image";
        $files = $request->file('image');
        $this->imageUpload($request, $files, 'seller', 'sellers', $formImage);
    }

    public function index(Request $request)
    {
        if ($request->session()->has('ajaximage')) {
            $image = $request->session()->get('ajaximage');
            @unlink('uploads/' . 'sellers/' . $image);
        }
        $sellers = Seller::where('delete_status', '0')->where('parent_id', null)->Orwhere('parent_id', '0')->orderBy('id', 'desc')->paginate(10);
        return view('admin.list.seller', compact('sellers'));
    }

    public function allSellerFetch(Request $request)
    {
        $sellerName = $request->sellerName;
        $sellerPhone = $request->sellerPhone;
        $sellerEmail = $request->sellerEmail;
        $sellers = Seller::where('delete_status', '0')
            ->where('parent_id', null)
            ->orderBy('id', 'desc')
            ->when($sellerName, function ($query, $sellerName) {
                return $query->where("tbl_sellers.first_name", "LIKE", "%$sellerName%");
            })
            ->when($sellerPhone, function ($query, $sellerPhone) {
                return $query->where("tbl_sellers.company_phone", "LIKE", "%$sellerPhone%");
            })
            ->when($sellerEmail, function ($query, $sellerEmail) {
                return $query->where("tbl_sellers.email", "LIKE", "%$sellerEmail%");
            })
            ->paginate(10);
        return view('admin.list.ajaxseller.seller', compact('sellers'))->render();
    }

    public function create()
    {
        $countries = DB::table('all_values')
            ->select('all_values.*')
            ->get();
        return view('admin.form.seller', compact('countries'));
    }

    public function store(SellerRegistrationRequest $request)
    {
        $seller = new Seller();

        $seller->company_name        = request('company_name');
        $seller->company_website     = request('company_website');
        // $seller->business_type       = request('business_type');
        $seller->company_country     = request('company_country');
        $seller->company_city        = request('company_city');
        $seller->company_state       = request('company_state');
        $seller->company_address     = request('company_address');
        $seller->zip_code            = request('zip_code');
        $seller->company_phone       = request('company_phone');
        $seller->email               = request('email');
        $seller->first_name          = request('first_name');
        $seller->middle_name         = request('middle_name');
        $seller->last_name           = request('last_name');
        // $seller->company_offer       = request('company_offer');
        $seller->company_description = request('company_description');
        // $seller->username            = request('username');
        $seller->password            = Hash::make($request->password);
        $seller->publish_status      = request('publish_status');
        $seller->seller_code         = Str::slug(request('company_name')) . '-' . Str::random(6);
        $seller->activation_code     = Str::random(25);
        $seller->image               = $request->session()->get('ajaximage');

        $seller->pan_no              = request('pan_no');
        $seller->vat_no              = request('vat_no');
        $seller->bank_name           = request('bank_name');
        $seller->bank_acc_number     = request('bank_acc_number');

        $seller->commission          = request('commission');



        $seller->save();
        $request->session()->forget('ajaximage');

        return redirect('/ns-admin/sellers')->with('success', 'Seller created successfully.');
    }

    public function edit($seller_id)
    {
        $countries = DB::table('all_values')
            ->select('all_values.*')
            ->get();
        $seller = Seller::where('id', $seller_id)->firstorfail();
        return view('admin.form.seller', compact('seller', 'countries'));
    }

    public function update(SellerRegistrationRequest $request, $seller_id)
    {
        // dd(request('email'));
        $seller = Seller::where('id', $seller_id)->firstorfail();

        $simage = request()->file('image');

        if ($simage != null) {
            $image = $seller->image;
            @unlink('uploads/' . 'sellers/' . $image);

            $data1 = ([
                'image' => $request->session()->get('ajaximage'),
            ]);
            Seller::where('id', $seller_id)->update($data1);
        }

        $data = ([
            'company_name'        => request('company_name'),
            'company_website'     => request('company_website'),
            // 'business_type'       => request('business_type'),
            'company_country'     => request('company_country'),
            'company_city'        => request('company_city'),
            'company_state'       => request('company_state'),
            'company_address'     => request('company_address'),
            'zip_code'            => request('zip_code'),
            'company_phone'       => request('company_phone'),
            'email'               => request('email'),
            'first_name'          => request('first_name'),
            'middle_name'         => request('middle_name'),
            'last_name'           => request('last_name'),
            // 'company_offer'       => request('company_offer'),
            'company_description' => request('company_description'),
            // 'username'            => request('username'),
            'publish_status'      => request('publish_status'),
            'pan_no'              => request('pan_no'),
            'vat_no'              => request('vat_no'),
            'bank_name'           => request('bank_name'),
            'bank_acc_number'     => request('bank_acc_number'),
            'commission'          => request('commission'),

            'seller_code'         => Str::slug(request('company_name')) . '-' . Str::random(6),
        ]);
        Seller::where('id', $seller_id)->update($data);

        $request->session()->forget('ajaximage');

        //redirect to dashboard
        return redirect('/ns-admin/sellers')->with('success', 'Seller Information updated successfully.');
    }


    public function destroy($id)
    {
        $seller = Seller::find($id);
        if(isset($seller)){
            Seller::where('id',$id)->update(['delete_status' => '1']);
            return redirect('/ns-admin/sellers')->with('success', 'Seller Deleted successfully.');
        }
        return redirect('/ns-admin/sellers')->with('error', 'Seller Not Found.');
    }

    public function viewSellerOrderList($id)
    {
        $seller = Seller::where('id', $id)->first();

        $totalProduct = Product::where('delete_status', '0')
            ->where('owner_id', $seller->id)
            ->count();

        $totalEarning = Statement::where('delete_status', '0')
            ->where('seller_id', $seller->id)
            ->sum('order_item_charge');

        $totalPayout = Statement::where('delete_status', '0')
            ->where('seller_id', $seller->id)
            ->sum('payout');

        $totalDelivered = Order::join('tbl_products','tbl_products.id','tbl_orders.product_id')
                        ->join('tbl_sellers','tbl_products.owner_id','tbl_sellers.id')
                        ->where('tbl_sellers.id',$seller->id)
                        ->where('tbl_orders.delivered','1')
                        ->count();

        $totalCancelled = Order::join('tbl_products','tbl_products.id','tbl_orders.product_id')
                    ->join('tbl_sellers','tbl_products.owner_id','tbl_sellers.id')
                    ->where('tbl_sellers.id',$seller->id)
                    ->where('tbl_orders.cancelled','1')
                    ->count();

        $totalReturned = SalesReturn::where('seller_id',$seller->id)->count();
        // dd($totalDelivered);

        $orders = Payment::leftJoin('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
            ->join('tbl_products', 'tbl_products.id', '=', 'tbl_orders.product_id')
            ->select([
                'tbl_products.product_name as p_id',
                'tbl_payments.id as id', 'tbl_payments.*',
                DB::raw('count(tbl_orders.product_id) as total_product'),
                DB::raw('SUM(tbl_orders.quantity) as total_quantity')
            ])
            // ->groupBy('tbl_payments.ref_id')
            ->where('tbl_products.owner_id', $seller->id)
            ->where([
                'pending' => '0',
                'ready_to_ship' => '1',
                'shipped' => '1',
                'delivered' => '1',
                'cancelled' => '0',
                'failed_delivery' => '0'
            ])
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.pages.seller.orderdetail', compact('seller', 'orders', 'totalProduct','totalEarning','totalPayout','totalDelivered','totalReturned','totalCancelled'));
    }

    public function fetchSellerOrderList(Request $request)
    {
        $seller = Seller::where('id', $request->sellerId)->first();

        $orders = Payment::leftJoin('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
            ->join('tbl_products', 'tbl_products.id', '=', 'tbl_orders.product_id')
            ->select([
                'tbl_products.product_name as p_id',
                'tbl_payments.id as id', 'tbl_payments.*',
                DB::raw('count(tbl_orders.product_id) as total_product'),
                DB::raw('SUM(tbl_orders.quantity) as total_quantity')
            ])
            ->groupBy('tbl_payments.ref_id')
            ->where('tbl_products.owner_id', $seller->id)
            ->where([
                'pending' => '0',
                'ready_to_ship' => '1',
                'shipped' => '1',
                'delivered' => '1',
                'cancelled' => '0',
                'failed_delivery' => '0'
            ])
            ->orderBy('id', 'desc')
            ->paginate(10);
        // dd($seller);
        // $total_sell = $orders->total();

        return view('admin.pages.seller.list', compact('seller', 'orders'));
    }

    public function viewSellerCancelList($id)
    {
        $seller = Seller::where('id', $id)->first();

        $totalProduct = Product::where('delete_status', '0')
            ->where('owner_id', $seller->id)
            ->count();

        $totalEarning = Statement::where('delete_status', '0')
            ->where('seller_id', $seller->id)
            ->sum('order_item_charge');

        $totalPayout = Statement::where('delete_status', '0')
            ->where('seller_id', $seller->id)
            ->sum('payout');

        $totalDelivered = Order::join('tbl_products','tbl_products.id','tbl_orders.product_id')
            ->join('tbl_sellers','tbl_products.owner_id','tbl_sellers.id')
            ->where('tbl_sellers.id',$seller->id)
            ->where('tbl_orders.delivered','1')
            ->count();

        $totalCancelled = Order::join('tbl_products','tbl_products.id','tbl_orders.product_id')
            ->join('tbl_sellers','tbl_products.owner_id','tbl_sellers.id')
            ->where('tbl_sellers.id',$seller->id)
            ->where('tbl_orders.cancelled','1')
            ->count();

        $totalReturned = SalesReturn::where('seller_id',$seller->id)->count();

        $orders = Payment::leftJoin('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
            ->join('tbl_products', 'tbl_products.id', '=', 'tbl_orders.product_id')
            ->select([
                'tbl_products.product_name as p_id',
                'tbl_payments.id as id', 'tbl_payments.*',
                DB::raw('count(tbl_orders.product_id) as total_product'),
                DB::raw('SUM(tbl_orders.quantity) as total_quantity')
            ])
            // ->groupBy('tbl_payments.ref_id')
            ->where('tbl_products.owner_id', $seller->id)
            ->where([
                'pending' => '0',
                'ready_to_ship' => '0',
                'shipped' => '0',
                'delivered' => '0',
                'cancelled' => '1',
                'failed_delivery' => '0'
            ])
            ->orderBy('id', 'desc')
            ->paginate(10);
        // dd($seller);

        return view('admin.pages.seller.canceldetail', compact('seller', 'orders', 'totalProduct','totalEarning','totalPayout','totalDelivered','totalReturned','totalCancelled'));
  }

    public function fetchSellerCancelList(Request $request)
    {
        $seller = Seller::where('id', $request->sellerId)->first();

        $orders = Payment::leftJoin('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
            ->join('tbl_products', 'tbl_products.product_name', '=', 'tbl_orders.product_id')
            ->select([
                'tbl_products.id as p_id',
                'tbl_payments.id as id', 'tbl_payments.*',
                DB::raw('count(tbl_orders.product_id) as total_product'),
                DB::raw('SUM(tbl_orders.quantity) as total_quantity')
            ])
            ->groupBy('tbl_payments.ref_id')
            ->where('tbl_products.owner_id', $seller->id)
            ->where([
                'pending' => '0',
                'ready_to_ship' => '0',
                'shipped' => '0',
                'delivered' => '0',
                'cancelled' => '1',
                'failed_delivery' => '0'
            ])
            ->orderBy('id', 'desc')
            ->paginate(10);
        // dd($seller);

        return view('admin.pages.seller.list', compact('seller', 'orders'));
    }
}
