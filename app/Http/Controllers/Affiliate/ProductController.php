<?php

namespace App\Http\Controllers\Affiliate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:affiliate');
    }

    public function index()
    {
        $products = Product::leftJoin('tbl_sellers', 'tbl_sellers.id', '=', 'tbl_products.owner_id')
            ->where('tbl_products.delete_status', '0')
            ->where('tbl_products.publish_status', '1')
            ->select('tbl_products.*', 'tbl_sellers.seller_code')
            ->orderBy('tbl_products.id', 'desc')
            ->paginate(10);

        return view('affiliate.list.products', compact('products'));
    }

    public function allProductFetch(Request $request)
    {
        $productName = $request->productName;
        $productOwnerCode = $request->productOwnerCode;
        $productCategory = $request->productCategory;

        $products = Product::leftJoin('tbl_sellers', 'tbl_sellers.id', '=', 'tbl_products.owner_id')
            ->where('tbl_products.delete_status', '0')
            ->where('tbl_products.publish_status', '1')
            ->when($productName, function ($query, $productName) {
                return $query->where('tbl_products.product_name', "LIKE", "%$productName%");
            })
            ->when($productOwnerCode, function ($query, $productOwnerCode) {
                return $query->where('tbl_sellers.seller_code', "LIKE", "%$productOwnerCode%");
            })
            ->when($productCategory, function ($query, $productCategory) {
                $category_list = Category::where('tbl_categories.category_name', "LIKE", "%$productCategory%")->get();
                $arr = [];
                foreach ($category_list as $data) {
                    array_push($arr, $data->id);
                }
                return $query->whereIn('tbl_products.category_id', $arr);
            })
            ->select('tbl_products.*', 'tbl_sellers.seller_code')
            ->orderBy('tbl_products.id', 'desc')
            ->paginate(10);
        return view('affiliate.list.ajaxproduct.product', compact('products'))->render();
    }

    public function getSoldProducts()
    {
        $products = Product::leftJoin('tbl_sellers', 'tbl_sellers.id', '=', 'tbl_products.owner_id')
            ->join('tbl_orders', 'tbl_orders.product_id', 'tbl_products.id')
            ->where('tbl_products.delete_status', '0')
            ->where('tbl_products.publish_status', '1')
            ->where('tbl_orders.aff_id', Auth::guard('affiliate')->user()->affiliate_code)
            ->where('tbl_orders.delivered', '1')
            ->select('tbl_products.*', 'tbl_sellers.seller_code')
            ->orderBy('tbl_products.id', 'desc')
            ->paginate(10);

        return view('affiliate.list.sold-products', compact('products'));
    }

    public function allSoldProductFetch(Request $request)
    {
        $productName = $request->productName;
        $productOwnerCode = $request->productOwnerCode;
        $productCategory = $request->productCategory;

        $products = Product::leftJoin('tbl_sellers', 'tbl_sellers.id', '=', 'tbl_products.owner_id')
            ->join('tbl_orders', 'tbl_orders.product_id', 'tbl_products.id')
            ->where('tbl_products.delete_status', '0')
            ->where('tbl_products.publish_status', '1')
            ->where('tbl_orders.aff_id', Auth::guard('affiliate')->user()->affiliate_code)
            ->where('tbl_orders.delivered', '1')
            ->when($productName, function ($query, $productName) {
                return $query->where('tbl_products.product_name', "LIKE", "%$productName%");
            })
            ->when($productOwnerCode, function ($query, $productOwnerCode) {
                return $query->where('tbl_sellers.seller_code', "LIKE", "%$productOwnerCode%");
            })
            ->when($productCategory, function ($query, $productCategory) {
                $category_list = Category::where('tbl_categories.category_name', "LIKE", "%$productCategory%")->get();
                $arr = [];
                foreach ($category_list as $data) {
                    array_push($arr, $data->id);
                }
                return $query->whereIn('tbl_products.category_id', $arr);
            })
            ->select('tbl_products.*', 'tbl_sellers.seller_code')
            ->orderBy('tbl_products.id', 'desc')
            ->paginate(10);
        return view('affiliate.list.ajaxsoldproduct.sold-product', compact('products'))->render();
    }

    public function getCancelledProducts()
    {
        $products = Product::leftJoin('tbl_sellers', 'tbl_sellers.id', '=', 'tbl_products.owner_id')
            ->join('tbl_orders', 'tbl_orders.product_id', 'tbl_products.id')
            ->where('tbl_products.delete_status', '0')
            ->where('tbl_products.publish_status', '1')
            ->where('tbl_orders.aff_id', Auth::guard('affiliate')->user()->affiliate_code)
            ->where('tbl_orders.cancelled', '1')
            ->select('tbl_products.*', 'tbl_sellers.seller_code')
            ->orderBy('tbl_products.id', 'desc')
            ->paginate(10);

        return view('affiliate.list.cancelled-products', compact('products'));
    }

    public function allCancelledProductFetch(Request $request)
    {
        $productName = $request->productName;
        $productOwnerCode = $request->productOwnerCode;
        $productCategory = $request->productCategory;

        $products = Product::leftJoin('tbl_sellers', 'tbl_sellers.id', '=', 'tbl_products.owner_id')
            ->join('tbl_orders', 'tbl_orders.product_id', 'tbl_products.id')
            ->where('tbl_products.delete_status', '0')
            ->where('tbl_products.publish_status', '1')
            ->where('tbl_orders.aff_id', Auth::guard('affiliate')->user()->affiliate_code)
            ->where('tbl_orders.cancelled', '1')
            ->when($productName, function ($query, $productName) {
                return $query->where('tbl_products.product_name', "LIKE", "%$productName%");
            })
            ->when($productOwnerCode, function ($query, $productOwnerCode) {
                return $query->where('tbl_sellers.seller_code', "LIKE", "%$productOwnerCode%");
            })
            ->when($productCategory, function ($query, $productCategory) {
                $category_list = Category::where('tbl_categories.category_name', "LIKE", "%$productCategory%")->get();
                $arr = [];
                foreach ($category_list as $data) {
                    array_push($arr, $data->id);
                }
                return $query->whereIn('tbl_products.category_id', $arr);
            })
            ->select('tbl_products.*', 'tbl_sellers.seller_code')
            ->orderBy('tbl_products.id', 'desc')
            ->paginate(10);
        return view('affiliate.list.ajaxcancelledproduct.cancelled-product', compact('products'))->render();
    }
}
