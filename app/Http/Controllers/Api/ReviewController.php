<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Models\Payment;
use App\Models\Order;
use App\Models\Product;

class ReviewController extends Controller
{
  public function reviewList()
  {
    $customer_id = Auth::id();
    $review_list = Review::join('tbl_products', 'tbl_products.id', '=', 'tbl_reviews.product_id')
      ->join('tbl_customers', 'tbl_customers.id', '=', 'tbl_reviews.customer_id')
      ->where('tbl_reviews.customer_id', $customer_id)
      ->select('tbl_products.product_name', 'tbl_reviews.rating', 'tbl_reviews.review', 'tbl_reviews.reply', 'tbl_customers.image', 'tbl_customers.name')
      ->get();

    return response()->json([
      'status' => true,
      'status_message' => 'Data successfully received !!!',
      'customer_image_link' => asset('uploads/customers/'),
      'review_list' => $review_list,
    ], 200);
  }

  public function addReview(Request $request)
  {
    $customer_id = Auth::id();
    // dd($customer_id);
    $product_id = $request->product_id;
    DB::table('tbl_reviews')
      ->updateOrInsert(
        ['customer_id' => $customer_id, 'product_id' => $product_id],
        ['rating' => $request->rating, 'review' => $request->review]
      );

      $avg = DB::table('tbl_reviews')->where('product_id',$product_id)
      ->select(
        DB::raw('AVG(rating) as rating'),
        )
    ->first();
    DB::table('tbl_products')->where('id',$product_id)
      ->update(
        ['rating' => $avg->rating]
      );

    return response()->json([
      'status' => true,
      'status_message' => 'review successfully added !!!',
    ], 200);
  }

  public function productReview($product_id)
  {
    $single_product_all_reviews =  Review::join('tbl_products', 'tbl_products.id', '=', 'tbl_reviews.product_id')
      ->join('tbl_customers', 'tbl_customers.id', '=', 'tbl_reviews.customer_id')
      ->where('tbl_reviews.product_id', $product_id)
      ->select('tbl_reviews.product_id', 'tbl_products.product_name', 'tbl_reviews.rating', 'tbl_reviews.review', 'tbl_reviews.reply', 'tbl_customers.image', 'tbl_customers.name')
      ->get();

    return response()->json([
      'status' => true,
      'status_message' => 'review successfully added !!!',
      'customer_image_link' => asset('uploads/customers/'),
      'data' => $single_product_all_reviews
    ], 200);
  }

  public function getUnreviewPurchaseProduct(Request $request)
  {

    // $customer_id = 2;
    $customer_id = Auth::id();
    // return $customer_id;
    // return $request->user();
    $ref_ids = Payment::where('customer_id', $customer_id)->where('complete_status', '1')->select('ref_id')->get();

    $reviewedProduct = Review::where('customer_id',$customer_id)->get()->pluck('product_id');
    // return $reviewedProduct;

    $notReviewedProducts = Order::join('tbl_payments', 'tbl_orders.ref_id', 'tbl_payments.ref_id')
        ->whereIn('tbl_orders.ref_id', $ref_ids)
        ->where('tbl_orders.delivered', '1')
        ->whereNotIn('tbl_orders.product_id', $reviewedProduct)
        ->orderBy('tbl_orders.id', 'desc')
        ->groupBy('tbl_orders.ref_id')
        ->select('tbl_orders.product_id','tbl_orders.quantity')
        ->get();
        // ->pluck('product_id');
        // return $notReviewedProducts;

        $p_id = $notReviewedProducts->pluck('product_id');
        $quantity = $notReviewedProducts->pluck('quantity');

        $products = Product::leftJoin('tbl_sellers as s', 's.id', '=', 'tbl_products.owner_id')
        ->select('tbl_products.id','tbl_products.product_name','tbl_products.product_slug','tbl_products.image','tbl_products.product_original_price','s.company_name')
        ->whereIn('tbl_products.id',$p_id)->get();

        foreach($products as $key => $product){
            $product->setAttribute('quantity',$quantity[$key]);
        }
        // return $products;

        if(!count($products) > 0)
        {
            return response()->json([
                'status_code' => 200,
                'status' => false,
                'status_message' => 'No Product List',
            ], 200);
        }

        return response()->json([
            'status_code' => 200,
            'status' => true,
            'data' => $products,
            'product_link' => asset('uploads/products/'),
            'status_message' => 'Product List',
        ], 200);


  }
}
