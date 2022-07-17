<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Photo;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Review;
use App\Models\Wishlist;
use App\Models\Favourite;

class WishListController extends Controller
{
    public function wishList($product_id)
    {
        $customer_id = Auth::id();

        $check_user_wishlist = DB::table('tbl_wishlists')->where('product_id', $product_id)->where('user_id', $customer_id)->first();
        if(!$check_user_wishlist){

              DB::table('tbl_wishlists')->insert([
                'product_id' => $product_id,
                'user_id' => $customer_id,
                "created_at"=> Carbon::now(),
                "updated_at"=> now()
            ]);
            $status_message = "Added To Wish List";
        }

        else{

            DB::table('tbl_wishlists')->where('product_id', $product_id)->where('user_id', $customer_id)->delete();
             $status_message = "Removed From Wish List";
        }

         return response()->json([
            'status' => true,
            'status_message' => $status_message,
             ], 200);

    }

    public function productListWishList(Request $request){

        $customer_id = Auth::id();

        //For Filter
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
                $check_user_wishlist = Wishlist::join('tbl_products', 'tbl_products.id', '=', 'tbl_wishlists.product_id')
                ->leftJoin('tbl_sellers as s','s.id', '=', 'tbl_products.owner_id')
                ->select('tbl_products.id as product_id','tbl_products.product_name', 'tbl_products.image', 'tbl_products.product_slug', 'tbl_products.product_original_price', 'tbl_products.product_compare_price', 's.company_name', 's.company_address')
                ->where('tbl_wishlists.user_id', $customer_id)
                ->where('tbl_products.publish_status', '1')
                ->where('tbl_products.delete_status', '0')
                ->where('tbl_products.live_status', '1')
                ->when($ascOrDesc, function ($query, $ascOrDesc) {
                    return $query->orderBy('tbl_products.product_original_price',$ascOrDesc);
                })
                ->when($minPrice, function($query, $minPrice){
                    return $query->where('tbl_products.product_original_price','>=',$minPrice);
                })
                ->when($maxPrice, function($query, $maxPrice){
                    return $query->where('tbl_products.product_original_price','<=',$maxPrice);
                })
                ->paginate(6);
            }
            else if($priceOrRating == "rate")
            {
                $check_user_wishlist = Wishlist::join('tbl_products', 'tbl_products.id', '=', 'tbl_wishlists.product_id')
                ->leftJoin('tbl_sellers as s','s.id', '=', 'tbl_products.owner_id')
                ->select('tbl_products.id as product_id','tbl_products.product_name', 'tbl_products.image', 'tbl_products.product_slug', 'tbl_products.product_original_price', 'tbl_products.product_compare_price', 's.company_name', 's.company_address')
                ->where('tbl_wishlists.user_id', $customer_id)
                ->where('tbl_products.publish_status', '1')
                ->where('tbl_products.delete_status', '0')
                ->where('tbl_products.live_status', '1')
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
                ->paginate(6);
            }
            else if($priceOrRating == "date")
            {
                $check_user_wishlist = Wishlist::join('tbl_products', 'tbl_products.id', '=', 'tbl_wishlists.product_id')
                ->leftJoin('tbl_sellers as s','s.id', '=', 'tbl_products.owner_id')
                ->select('tbl_products.id as product_id','tbl_products.product_name', 'tbl_products.image', 'tbl_products.product_slug', 'tbl_products.product_original_price', 'tbl_products.product_compare_price', 's.company_name', 's.company_address')
                ->where('tbl_wishlists.user_id', $customer_id)
                ->where('tbl_products.publish_status', '1')
                ->where('tbl_products.delete_status', '0')
                ->where('tbl_products.live_status', '1')
                ->orderBy('tbl_products.created_at',$ascOrDesc)
                ->when($minPrice, function($query, $minPrice){
                    return $query->where('tbl_products.product_original_price','>=',$minPrice);
                })
                ->when($maxPrice, function($query, $maxPrice){
                    return $query->where('tbl_products.product_original_price','<=',$maxPrice);
                })
                ->paginate(6);
            }
            else if($priceOrRating == "null")
            {
                $check_user_wishlist = Wishlist::join('tbl_products', 'tbl_products.id', '=', 'tbl_wishlists.product_id')
                ->leftJoin('tbl_sellers as s','s.id', '=', 'tbl_products.owner_id')
                ->select('tbl_products.id as product_id','tbl_products.product_name', 'tbl_products.image', 'tbl_products.product_slug', 'tbl_products.product_original_price', 'tbl_products.product_compare_price', 's.company_name', 's.company_address')
                ->where('tbl_wishlists.user_id', $customer_id)
                ->where('tbl_products.publish_status', '1')
                ->where('tbl_products.delete_status', '0')
                ->where('tbl_products.live_status', '1')
                ->when($minPrice, function($query, $minPrice){
                    return $query->where('tbl_products.product_original_price','>=',$minPrice);
                })
                ->when($maxPrice, function($query, $maxPrice){
                    return $query->where('tbl_products.product_original_price','<=',$maxPrice);
                })
                ->paginate(6);
            }
        }

        else{
            //Default Filter
            // return $customer_id;
            $check_user_wishlist = Wishlist::join('tbl_products', 'tbl_products.id', '=', 'tbl_wishlists.product_id')
            ->leftJoin('tbl_sellers as s','s.id', '=', 'tbl_products.owner_id')
            ->select('tbl_products.id as product_id','tbl_products.product_name', 'tbl_products.image', 'tbl_products.product_slug', 'tbl_products.product_original_price', 'tbl_products.product_compare_price',  'tbl_products.deliveryType','s.company_name', 's.company_address')
            ->where('tbl_wishlists.user_id', $customer_id)
            ->where('tbl_products.publish_status', '1')
            ->where('tbl_products.delete_status', '0')
            ->where('tbl_products.live_status', '1')
            ->orderBy('tbl_products.created_at','desc')
            ->paginate(6);
        }
        // dd($check_user_wishlist);

        foreach($check_user_wishlist as  $flash_row)
        {
            $review = Review::where('product_id', $flash_row->product_id)
                        ->select('product_id', DB::raw('count(tbl_reviews.product_id) as total_reviews'), DB::raw('avg(tbl_reviews.rating) as average_rating'))
                        ->groupBy('product_id')->first();
             $flash_row->setAttribute('review_data', $review);
             $flash_row->setAttribute('is_wish', false);
            if($customer_id){
                $user_wishlist = DB::table('tbl_wishlists')->where('product_id', $flash_row->product_id)->where('user_id', $customer_id)->first();
                if($user_wishlist){
                    $flash_row->setAttribute('is_wish', true);
                }
            }
        }


        return response()->json([
            'status' => true,
            'status_message' => 'data received successfully',
            'product_link' => asset('uploads/products/'),
            'products' => $check_user_wishlist
        ], 200);
    }

      public function loginUsershowProduct($product_slug){

        $customer_id = Auth::id();

        $product_detail = Product::leftJoin('tbl_sellers as s','s.id', '=', 'tbl_products.owner_id')
                                ->join('tbl_stocks', 'tbl_stocks.product_id', '=', 'tbl_products.id')
                                ->select('tbl_products.*','tbl_products.id as product_id', 's.first_name', 's.last_name', 's.company_name', 's.company_address', 'tbl_stocks.remaining_stock')
                                ->where('product_slug', $product_slug)
                                ->first();

        $product_id = Product::where('product_slug',$product_slug)->first()->id;

        $productReviews = Product::where('id',$product_id)->first()->reviews;
        $one_star_count = $productReviews->where('rating','1')->count();
        $two_star_count = $productReviews->where('rating','2')->count();
        $three_star_count = $productReviews->where('rating','3')->count();
        $four_star_count = $productReviews->where('rating','4')->count();
        $five_star_count = $productReviews->where('rating','5')->count();

        $review =   Review::where('product_id', $product_id)
                ->select(DB::raw('count(tbl_reviews.product_id) as total_reviews'), DB::raw('avg(tbl_reviews.rating) as average_rating'))
                ->groupBy('product_id')->first();

        if(isset($review))
        {
            $review->setAttribute('one_star_count',$one_star_count);
            $review->setAttribute('$two_star_count',$two_star_count);
            $review->setAttribute('$three_star_count',$three_star_count);
            $review->setAttribute('$four_star_count',$four_star_count);
            $review->setAttribute('$five_star_count',$five_star_count);

            $product_detail->setAttribute('review_data', $review);
        }
        else{
            $product_detail->setAttribute('review_data', 0);
        }

        $product_photos = Photo::where('tbl_photos.imageable_id', $product_detail->id)
                                    ->where('imageable_type', 'App\Product')
                                ->where('tbl_photos.delete_status', '0')
                                ->get();
        $product_detail->setAttribute('photos',$product_photos);

       $seller_id = $product_detail->owner_id;
       $fav_status = false;
                $fav = Favourite::where('seller_id', '$seller_id')->first();
                if($fav){
                       $fav_status = true;
                }

         $product_detail->setAttribute('fav_status',$fav_status);

          $wishlist_check =  DB::table('tbl_wishlists')->where('product_id', $product_detail->product_id)->where('user_id', $customer_id)->first();

            $wishlist_status = true;
            if(!$wishlist_check){
                 $wishlist_status = false;
            }

         $product_detail->setAttribute('wishlist_status', $wishlist_status );


        return response()->json([
            'status' => true,
            'status_message' => 'data received successfully !!!',
            'product_image_link' => asset('uploads/products/'),
            'product_detail' => $product_detail,

             ], 200);

    }
}
