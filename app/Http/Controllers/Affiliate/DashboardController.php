<?php

namespace App\Http\Controllers\Affiliate;


use App\Models\Affiliate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:affiliate');
    }

    public function index()
    {
        $totalProducts = Product::allStatus()->holidayStatus()->count();
        $totalSoldProducts = Product::leftJoin('tbl_sellers', 'tbl_sellers.id', '=', 'tbl_products.owner_id')
            ->join('tbl_orders', 'tbl_orders.product_id', 'tbl_products.id')
            ->where('tbl_products.delete_status', '0')
            ->where('tbl_products.publish_status', '1')
            ->where('tbl_orders.aff_id', Auth::guard('affiliate')->user()->affiliate_code)
            ->where('tbl_orders.delivered', '1')
            ->select('tbl_products.*', 'tbl_sellers.seller_code')
            ->orderBy('tbl_products.id', 'desc')
            ->count();
        $totalCancelledProducts = Product::leftJoin('tbl_sellers', 'tbl_sellers.id', '=', 'tbl_products.owner_id')
            ->join('tbl_orders', 'tbl_orders.product_id', 'tbl_products.id')
            ->where('tbl_products.delete_status', '0')
            ->where('tbl_products.publish_status', '1')
            ->where('tbl_orders.aff_id', Auth::guard('affiliate')->user()->affiliate_code)
            ->where('tbl_orders.cancelled', '1')
            ->select('tbl_products.*', 'tbl_sellers.seller_code')
            ->orderBy('tbl_products.id', 'desc')
            ->count();

        return view('affiliate.pages.dashboard', compact('totalProducts', 'totalSoldProducts', 'totalCancelledProducts'));
    }
}
