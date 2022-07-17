<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $productData = Product::allStatus()
            ->select('product_name', 'product_slug')
            ->where('product_name', 'like', "%$request->search%")
            ->limit(5)
            ->get();
        return response()->json($productData, 200);
    }
}
