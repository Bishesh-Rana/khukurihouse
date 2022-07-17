<?php

namespace App\Http\Controllers\Admin;

use App\Models\AffiliateStatement;
use App\Models\Affiliate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class AffiliateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $affiliates = Affiliate::where('id', '!=', '0')->where('delete_status', '0')->orderBy('id', 'desc')->paginate(10);
        return view('admin.list.affiliate', compact('affiliates'));
    }

    public function fetch(Request $request)
    {
        $affiliateName = $request->affiliateName;
        $affiliatePhone = $request->affiliatePhone;
        $affiliateEmail = $request->affiliateEmail;
        $affiliates = Affiliate::where('id', '!=', '0')
            ->where('delete_status', '0')
            ->orderBy('id', 'desc')
            ->when($affiliateName, function ($query, $affiliateName) {
                return $query->where("first_name", "LIKE", "%$affiliateName%")->orWhere("last_name", "LIKE", "%$affiliateName%");
            })
            ->when($affiliatePhone, function ($query, $affiliatePhone) {
                return $query->where("phone", "LIKE", "%$affiliatePhone%");
            })
            ->when($affiliateEmail, function ($query, $affiliateEmail) {
                return $query->where("email", "LIKE", "%$affiliateEmail%");
            })
            ->paginate(10);
        return view('admin.list.ajaxaffiliate.affiliate', compact('affiliates'))->render();
    }

    public function updateCommission(Request $request)
    {
        Affiliate::where('id', $request->affiliateId)->update(['commission' => $request->commission]);
        $affiliates = Affiliate::where('id', '!=', '0')->where('delete_status', '0')->orderBy('id', 'desc')->paginate(10);
        return view('admin.list.ajaxaffiliate.affiliate', compact('affiliates'));
    }

    public function edit($affiliateId)
    {
        $affiliate = Affiliate::where('id', $affiliateId)->firstorfail();
        return view('admin.form.affiliate', compact('affiliate'));
    }

    public function update($affiliateId)
    {
        $data = ([
            'publish_status'=> request('publish_status'),
            'commission'    => request('commission'),
        ]);

        Affiliate::where('id', $affiliateId)->update($data);

        return redirect('/ns-admin/affiliates')->with('success', 'Affiliate Updated successfully.');
    }

    public function viewAffiliateOrderList($id)
    {
        $affiliate = Affiliate::where('id', $id)->firstOrFail();

        $totalProduct = Order::where('aff_id', $affiliate->affiliate_code)->count();

        $totalEarning = AffiliateStatement::where('delete_status', '0')
            ->where('affiliate_id', $affiliate->affiliate_code)
            ->sum('commission_earned');
        // dd($totalEarning);

        $totalPayout = AffiliateStatement::where('delete_status', '0')
            ->where('affiliate_id', $affiliate->affiliate_code)
            ->sum('payout');

        $totalDelivered = Order::join('tbl_products', 'tbl_products.id', 'tbl_orders.product_id')
            ->join('tbl_sellers', 'tbl_products.owner_id', 'tbl_sellers.id')
            ->where('tbl_orders.aff_id', $affiliate->affiliate_code)
            ->where('tbl_orders.delivered', '1')
            ->count();


        $totalCancelled = Order::join('tbl_products', 'tbl_products.id', 'tbl_orders.product_id')
            ->join('tbl_sellers', 'tbl_products.owner_id', 'tbl_sellers.id')
            ->where('tbl_orders.aff_id', $affiliate->affiliate_code)
            ->where('tbl_orders.cancelled', '1')
            ->count();

        $totalReturned = 0;

        $products = Product::leftJoin('tbl_sellers', 'tbl_sellers.id', '=', 'tbl_products.owner_id')
            ->join('tbl_orders', 'tbl_orders.product_id', 'tbl_products.id')
            ->where('tbl_products.delete_status', '0')
            ->where('tbl_products.publish_status', '1')
            ->where('tbl_orders.aff_id', $affiliate->affiliate_code)
            ->where('tbl_orders.delivered', '1')
            ->select('tbl_products.*', 'tbl_sellers.seller_code')
            ->orderBy('tbl_products.id', 'desc')
            ->paginate(10);

        return view('admin.pages.affiliate.orderdetail', compact('affiliate', 'products', 'totalProduct', 'totalEarning', 'totalPayout', 'totalDelivered', 'totalCancelled', 'totalReturned'));
    }

    public function fetchAffiliateOrderList(Request $request)
    {
        $affiliate = Affiliate::where('id', $request->affiliateId)->first();

        $products = Product::leftJoin('tbl_sellers', 'tbl_sellers.id', '=', 'tbl_products.owner_id')
            ->join('tbl_orders', 'tbl_orders.product_id', 'tbl_products.id')
            ->where('tbl_products.delete_status', '0')
            ->where('tbl_products.publish_status', '1')
            ->where('tbl_orders.aff_id', $affiliate->affiliate_code)
            ->where('tbl_orders.delivered', '1')
            ->select('tbl_products.*', 'tbl_sellers.seller_code')
            ->orderBy('tbl_products.id', 'desc')
            ->paginate(10);

        return view('admin.pages.affiliate.list', compact('affiliate', 'products'));
    }

    public function viewAffiliateCancelList($id)
    {
        $affiliate = Affiliate::where('id', $id)->firstOrFail();

        $totalProduct = Order::where('aff_id', $affiliate->affiliate_code)->count();

        $totalEarning = AffiliateStatement::where('delete_status', '0')
            ->where('affiliate_id', $affiliate->affiliate_code)
            ->sum('commission_earned');
        // dd($totalEarning);

        $totalPayout = AffiliateStatement::where('delete_status', '0')
            ->where('affiliate_id', $affiliate->affiliate_code)
            ->sum('payout');

        $totalDelivered = Order::join('tbl_products', 'tbl_products.id', 'tbl_orders.product_id')
            ->join('tbl_sellers', 'tbl_products.owner_id', 'tbl_sellers.id')
            ->where('tbl_orders.aff_id', $affiliate->affiliate_code)
            ->where('tbl_orders.delivered', '1')
            ->count();

        $totalCancelled = Order::join('tbl_products', 'tbl_products.id', 'tbl_orders.product_id')
            ->join('tbl_sellers', 'tbl_products.owner_id', 'tbl_sellers.id')
            ->where('tbl_orders.aff_id', $affiliate->affiliate_code)
            ->where('tbl_orders.cancelled', '1')
            ->count();

        $totalReturned = 0;

        $products = Product::leftJoin('tbl_sellers', 'tbl_sellers.id', '=', 'tbl_products.owner_id')
            ->join('tbl_orders', 'tbl_orders.product_id', 'tbl_products.id')
            ->where('tbl_products.delete_status', '0')
            ->where('tbl_products.publish_status', '1')
            ->where('tbl_orders.aff_id', $affiliate->affiliate_code)
            ->where('tbl_orders.cancelled', '1')
            ->select('tbl_products.*', 'tbl_sellers.seller_code')
            ->orderBy('tbl_products.id', 'desc')
            ->paginate(10);

        return view('admin.pages.affiliate.orderdetail', compact('affiliate', 'products', 'totalProduct', 'totalEarning', 'totalPayout', 'totalDelivered', 'totalCancelled', 'totalReturned'));
    }

    public function fetchAffiliateCancelList(Request $request)
    {
        $affiliate = Affiliate::where('id', $request->affiliateId)->first();

        $products = Product::leftJoin('tbl_sellers', 'tbl_sellers.id', '=', 'tbl_products.owner_id')
            ->join('tbl_orders', 'tbl_orders.product_id', 'tbl_products.id')
            ->where('tbl_products.delete_status', '0')
            ->where('tbl_products.publish_status', '1')
            ->where('tbl_orders.aff_id', $affiliate->affiliate_code)
            ->where('tbl_orders.cancelled', '1')
            ->select('tbl_products.*', 'tbl_sellers.seller_code')
            ->orderBy('tbl_products.id', 'desc')
            ->paginate(10);

        return view('admin.pages.affiliate.list', compact('affiliate', 'products'));
    }
}
