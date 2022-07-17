<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductSearchController extends Controller
{
    public function __construct(Product $product)
    {

        $this->product = $product;
    }

    public function search(Request $request)
    {
        $products = $this->product
            ->query()
            ->where(function ($query) use ($request) {
                $query
                    ->where('product_name', 'like', '%' . $request->productName . '%')
                    ->orWhere('product_brand', 'like', '%' . $request->productName . '%')
                    ->orWhere('product_model', 'like', '%' . $request->productName . '%');
            })
            ->select('id', 'product_name')
            ->limit(10)
            ->get();




        $view = view('admin.form.product.searchProduct', compact('products'));
        return $view;
    }

    public function productDetail(Request $request)
    {
        $product = $this->product->with('stock')->find($request->productId);
        return view('admin.form.product.productDetail', compact('product'));
    }
}
