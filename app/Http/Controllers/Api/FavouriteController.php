<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Models\Seller;
use App\Models\Favourite;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class FavouriteController extends Controller
{
    public function favouriteList($seller_id)
    {
        $seller_id = $seller_id;
        $customer = Auth::id();

        $favourite = Favourite::where('seller_id',$seller_id)->where('user_id',$customer)->first();
        if(isset($favourite))
        {
            $favourite->delete();

            return response()->json([
                'status' => true,
                'message' => 'Seller Remove From Favourite !!!',
                'favourite' => $favourite,
            ], 200);
        }
        else{
            $favourite = new Favourite();

            $favourite->seller_id = $seller_id;
            $favourite->user_id = $customer;

            $favourite->save();

            return response()->json([
                'status' => true,
                'message' => 'Seller Added To Favourite !!!',
                'favourite' => $favourite,
            ], 200);
        }
    }

    public function myFavouriteSeller()
    {
        $customer = Auth::id();

        $sellerList = Favourite::join('tbl_sellers','tbl_sellers.id','tbl_favourites.seller_id')
                                ->where('tbl_favourites.user_id',$customer)
                                ->where('tbl_sellers.publish_status', '1')
                                ->where('tbl_sellers.delete_status', '0')
                                ->where('tbl_sellers.holiday_mode', '0')
                                ->select('tbl_sellers.company_name','tbl_sellers.id','tbl_sellers.image')
                                ->paginate(5);

        return response()->json([
            'status' => true,
            'message' => 'My Favourite Seller List !!!',
            'image_link' => asset('uploads/sellers/'),
            'favouriteSellers' => $sellerList,
        ], 200);
    }

    public function myFavouriteSellerProduct(Request $request)
    {
        $header = $request->header('Authorization');
        $customer_id = null;
        if($header){
            $access_token = $request->header('Authorization');
            $auth_header = explode(' ', $access_token);
            $token = $auth_header[1];
            $token_parts = explode('.', $token);
            $token_header = $token_parts[1];
            $token_header_json = base64_decode($token_header);
            $token_header_array = json_decode($token_header_json, true);
            $token_id = $token_header_array['jti'];

            $user_id = DB::table('oauth_access_tokens')->where('id', $token_id)->first();
            $customer_id = $user_id->user_id;
        }
        $seller_id = $request->seller_id;

        $check = explode("_",$request->sortBy);
        $minPrice = null;
        $maxPrice = null;
        if(array_key_exists('2',$check))
        {
            $minPrice = explode("_", $request->sortBy)[2];
            $maxPrice = explode("_", $request->sortBy)[3];
        }

        if(isset($request->sortBy))
        {
            $priceOrRating = explode("_", $request->sortBy)[0];
            $ascOrDesc = explode("_", $request->sortBy)[1];

            if($priceOrRating == "price")
            {
                $products = Product::join('tbl_sellers','tbl_sellers.id','tbl_products.owner_id')
                ->join('tbl_stocks', 'tbl_stocks.product_id', '=', 'tbl_products.id')
                ->select('tbl_products.id as product_id','tbl_sellers.company_name','tbl_products.product_name','tbl_products.image','tbl_products.product_slug','tbl_products.product_original_price','tbl_products.product_compare_price','tbl_stocks.remaining_stock')
                ->where('tbl_products.owner_id',$seller_id)
                ->allStatus()->holidayStatus()
                ->when($ascOrDesc, function ($query, $ascOrDesc) {
                    return $query->orderBy('tbl_products.product_original_price',$ascOrDesc);
                })
                ->when($minPrice, function($query, $minPrice){
                    return $query->where('tbl_products.product_original_price','>=',$minPrice);
                })
                ->when($maxPrice, function($query, $maxPrice){
                    return $query->where('tbl_products.product_original_price','<=',$maxPrice);
                })
                ->groupBy('tbl_products.id')
                ->paginate(8);
            }
            else if($priceOrRating == "rate")
            {
                $products = Product::join('tbl_sellers','tbl_sellers.id','tbl_products.owner_id')
                ->join('tbl_stocks', 'tbl_stocks.product_id', '=', 'tbl_products.id')
                ->select('tbl_products.id as product_id','tbl_sellers.company_name','tbl_products.product_name','tbl_products.image','tbl_products.product_slug','tbl_products.product_original_price','tbl_products.product_compare_price','tbl_stocks.remaining_stock')
                ->where('tbl_products.owner_id',$seller_id)
                ->allStatus()->holidayStatus()
                ->when($ascOrDesc, function ($query, $ascOrDesc) {
                    return $query->orderByRaw('AVG(r.rating)',$ascOrDesc);
                })
                ->when($minPrice, function($query, $minPrice){
                    return $query->where('tbl_products.product_original_price','>=',$minPrice);
                })
                ->when($maxPrice, function($query, $maxPrice){
                    return $query->where('tbl_products.product_original_price','<=',$maxPrice);
                })
                ->groupBy('r.product_id')
                ->paginate(8);
            }
            else if($priceOrRating == "date")
            {
                $products = Product::join('tbl_sellers','tbl_sellers.id','tbl_products.owner_id')
                ->join('tbl_stocks', 'tbl_stocks.product_id', '=', 'tbl_products.id')
                ->select('tbl_products.id as product_id','tbl_sellers.company_name','tbl_products.product_name','tbl_products.image','tbl_products.product_slug','tbl_products.product_original_price','tbl_products.product_compare_price','tbl_stocks.remaining_stock')
                ->where('tbl_products.owner_id',$seller_id)
                ->allStatus()->holidayStatus()
                ->orderBy('tbl_products.created_at',$ascOrDesc)
                ->when($minPrice, function($query, $minPrice){
                    return $query->where('tbl_products.product_original_price','>=',$minPrice);
                })
                ->when($maxPrice, function($query, $maxPrice){
                    return $query->where('tbl_products.product_original_price','<=',$maxPrice);
                })
                ->groupBy('tbl_products.id')
                ->paginate(8);
            }
            else if($priceOrRating == "null")
            {
                $products = Product::join('tbl_sellers','tbl_sellers.id','tbl_products.owner_id')
                ->join('tbl_stocks', 'tbl_stocks.product_id', '=', 'tbl_products.id')
                ->select('tbl_products.id as product_id','tbl_sellers.company_name','tbl_products.product_name','tbl_products.image','tbl_products.product_slug','tbl_products.product_original_price','tbl_products.product_compare_price','tbl_stocks.remaining_stock')
                ->where('tbl_products.owner_id',$seller_id)
                ->allStatus()->holidayStatus()
                ->when($minPrice, function($query, $minPrice){
                    return $query->where('tbl_products.product_original_price','>=',$minPrice);
                })
                ->when($maxPrice, function($query, $maxPrice){
                    return $query->where('tbl_products.product_original_price','<=',$maxPrice);
                })
                ->groupBy('tbl_products.id')
                ->paginate(8);
            }
        }

        else{
            //Default Filter
            $products = Product::join('tbl_sellers','tbl_sellers.id','tbl_products.owner_id')
            ->join('tbl_stocks', 'tbl_stocks.product_id', '=', 'tbl_products.id')
            ->select('tbl_products.id as product_id','tbl_sellers.company_name','tbl_products.product_name','tbl_products.image','tbl_products.product_slug','tbl_products.product_original_price','tbl_products.product_compare_price','tbl_stocks.remaining_stock')
            ->where('tbl_products.owner_id',$seller_id)
            ->allStatus()->holidayStatus()
            ->orderBy('tbl_products.created_at','desc')
            ->groupBy('tbl_products.id')
            ->paginate(8);
        }

        foreach($products as  $flash_row)
        {
            $review =  Review::where('product_id', $flash_row->product_id)
                    ->select('product_id', DB::raw('count(tbl_reviews.product_id) as total_reviews'), DB::raw('avg(tbl_reviews.rating) as average_rating'))
                    ->groupBy('product_id')->first();
            $flash_row->setAttribute('review_data', $review);
            $flash_row->setAttribute('is_wish', false);
            if($customer_id){
                $check_user_wishlist = DB::table('tbl_wishlists')->where('product_id', $flash_row->product_id)->where('user_id', $customer_id)->first();
                if($check_user_wishlist){
                    $flash_row->setAttribute('is_wish', true);
                }
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'My Favourite  Seller\'s Product List !!!',
            'product_link' => asset('uploads/products/'),
            'products' => $products,
        ], 200);
    }

    // public function removeFromFavourite($seller_id)
    // {
    //     $seller_id = $seller_id;
    //     $customer = Auth::id();

    //      //create and save category
    //     $favourite = Favourite::where('seller_id',$seller_id)
    //                         ->where('user_id',$customer)
    //                         ->first();

    //     if(!isset($favourite))
    //     {
    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Seller Not In The List !!!',
    //         ], 200);
    //     }

    //     $favourite->delete();

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Seller Remove From Favourite !!!',
    //         'favourite' => $favourite,
    //     ], 200);
    // }
}
