<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use PDF;
use App\Models\Photo;
use App\Models\Advertisement;
use App\Models\News;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Customer;
use App\Models\Coupon;
use App\Models\Slider;
use App\Models\Seller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Contact;
use App\Models\DeliverySetting;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Models\Referral;
use App\Models\Notification;
use App\Models\Stock;
use App\Models\StockCalculate;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerCheckoutMail;
use App\Mail\SellerCheckoutMail;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Traits\ArrayOfCategoryTrait;
use App\Models\Message;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class WebsiteController extends Controller
{
    use ArrayOfCategoryTrait;

    // public function calculateRewardPointFromRefer($id)
    // {
    //     $setting = Setting::first();
    //     $customer = Customer::where('id', $id)->first();

    //     $current_reward = $customer->reward_point;
    //     $refer_reward = $setting->refer_reward;
    //     $final_reward = $current_reward + $refer_reward;

    //     $data = ([
    //         'reward_point' => $final_reward,
    //     ]);

    //     Customer::where('id', $id)->update($data);

    //     return true;
    // }

    public function calculateRewardPoint($email, $totalPurchase)
    {
        $setting = Setting::first();
        $customer = Customer::where('email', $email)->first();

        if (isset($customer)) {
            $current_reward = $customer->reward_point;
            $purchase_reward = $totalPurchase * ($setting->purchase_reward / 100);
            $final_reward = $current_reward + $purchase_reward;

            $data = ([
                'reward_point' => $final_reward,
            ]);

            Customer::where('email', $email)->update($data);
        }

        return true;
    }

    public function index(Request $request)
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


        $sliders = Slider::where('publish_status', '1')->where('delete_status', '0')->select('image')->get();

        $flash_sell_all_products = Product::leftJoin('tbl_sellers as s', 's.id', '=', 'tbl_products.owner_id')
            ->select('tbl_products.id as product_id', 'tbl_products.product_name', 'tbl_products.image', 'tbl_products.product_slug', 'tbl_products.product_original_price', 'tbl_products.product_compare_price', 's.first_name', 's.last_name', 's.company_name', 's.company_address','tbl_products.deliveryType')
            ->allStatus()->holidayStatus()
            ->orderBy('tbl_products.id', 'desc')
            ->where('tbl_products.best_rated', '1')->limit(8)
            ->get();

        foreach ($flash_sell_all_products as $flash_row) {
            $review =   Review::where('product_id', $flash_row->product_id)
                ->select('product_id', DB::raw('count(tbl_reviews.product_id) as total_reviews'), DB::raw('avg(tbl_reviews.rating) as average_rating'))
                ->groupBy('product_id')->first();
                if($review){
                    $review->average_rating = bcdiv($review->average_rating,1,0);

                }

            $flash_row->setAttribute('review_data', $review);
            $flash_row->setAttribute('is_wish', false);
            if($customer_id){
                $check_user_wishlist = DB::table('tbl_wishlists')->where('product_id', $flash_row->product_id)->where('user_id', $customer_id)->first();
                if($check_user_wishlist){
                    $flash_row->setAttribute('is_wish', true);
                }
            }

        }
        // dd($flash_sell_all_products);

        $featured_categories = Category::leftJoin('tbl_products', 'tbl_products.category_id', '=', 'tbl_categories.id')
            ->select('tbl_categories.category_name', 'tbl_categories.category_slug', 'tbl_categories.image',  DB::raw('count(tbl_products.category_id) as total_product'))
            ->groupBy('tbl_categories.id')
            ->where('tbl_categories.publish_status', '1')
            ->where('tbl_categories.delete_status', '0')
            ->whereHas('products', function (Builder $query) {
                $query->where('publish_status', '1')->where('delete_status', '0')->where('live_status', '1');
            })
            ->limit(12)
            ->get();
        $popular_categories = Category::where('publish_status', '1')
            ->select('category_name', 'category_slug', 'image as category_image')
            ->where('delete_status', '0')
            ->limit(4)
            ->get();
            foreach ($popular_categories as $pop_cat) {
                $pop_cat->setAttribute('want_count', rand(10,100));
            }

        $limit = count($featured_categories);

        if (count($featured_categories) % 2 == 1) {
            $limit = count($featured_categories) - 1; // even number of limits
        }

        $recent_products = Product::leftJoin('tbl_sellers as s', 's.id', '=', 'tbl_products.owner_id')
            ->select('tbl_products.id as product_id', 'tbl_products.product_name', 'tbl_products.image', 'tbl_products.product_slug', 'tbl_products.product_original_price', 'tbl_products.product_compare_price', 's.first_name', 's.last_name', 's.company_name', 's.company_address','tbl_products.deliveryType')
            ->allStatus()->holidayStatus()
            ->orderBy('tbl_products.id', 'desc')
            ->limit(10)
            ->get();

        foreach ($recent_products as $recent_row) {
            $review =   Review::where('product_id', $recent_row->product_id)
                ->select('product_id', DB::raw('count(tbl_reviews.product_id) as total_reviews'), DB::raw('avg(tbl_reviews.rating) as average_rating'))
                ->groupBy('product_id')->first();
                if($review){
                    $review->average_rating = bcdiv($review->average_rating,1,0);
                }

            $recent_row->setAttribute('review_data', $review);
            $recent_row->setAttribute('is_wish', false);
            if($customer_id){
                $check_user_wishlist = DB::table('tbl_wishlists')->where('product_id', $recent_row->product_id)->where('user_id', $customer_id)->first();
                if($check_user_wishlist){
                    $recent_row->setAttribute('is_wish', true);
                }
            }
        }
        $now = Carbon::now()->toDateTimeString();
        $top_flash_products = Product::leftJoin('flash_sales', 'flash_sales.productId', '=', 'tbl_products.id')
            ->select('tbl_products.id as product_id', 'tbl_products.product_name', 'tbl_products.image', 'tbl_products.product_slug','tbl_products.product_original_price as price','tbl_products.deliveryType',
            'flash_sales.startTime','flash_sales.endTime','flash_sales.totalStock as total_stock','flash_sales.soldStock as sold_stock','flash_sales.discount'
            // DB::raw("TIMESTAMPDIFF(hour,flash_sales.startTime,flash_sales.endTime)/24.0 AS hours")
            )
            ->allStatus()->holidayStatus()
            ->orderBy('tbl_products.id', 'desc')
            ->where('tbl_products.id',50)
            ->limit(4)
            ->where('flash_sales.startTime','<=',$now)
            ->where('flash_sales.endTime','>=',$now)
            ->get();
            $sale_start =null;
            $sale_end =null;
            // dd($top_flash_products);
            foreach ($top_flash_products as $flash_row) {
                $sale_start = $flash_row->startTime;
                $sale_end = $flash_row->endTime;
                $flash_row->setAttribute('discount', $flash_row->discount . '%');
                $flash_row->setAttribute('is_wish', false);
                if($customer_id){
                    $check_user_wishlist = DB::table('tbl_wishlists')->where('product_id', $flash_row->product_id)->where('user_id', $customer_id)->first();
                    if($check_user_wishlist){
                        $flash_row->setAttribute('is_wish', true);
                    }
                }
                unset($flash_row['startTime'],$flash_row['endTime'], );
            }
            $datetime1 = date_create($now);
            $datetime2 = date_create($sale_end);

            $interval = date_diff($datetime2, $datetime1);
            // dd($interval);
            $interval = $interval->format('%h:%i');

            $flash = [
                'start_time' => $sale_start,
                'end_time' => $sale_end,
                'remaining_time' => $interval,
                'products' => $top_flash_products
            ];

        return response()->json([
            'status' => true,
            'message' => 'data received successfully !!!',
            'sliders_link' => asset('uploads/sliders/'),
            'product_link' => asset('uploads/products/'),
            'categories_link' => asset('uploads/categories/'),
            'sliders' => $sliders,
            'flash_sell_all_products' => $flash_sell_all_products,
            'featured_categories' => $featured_categories->take($limit),
            'featured_products' =>  $recent_products,
            'popular_categories' =>  $popular_categories,
            'top_flash_sales' =>  $flash,
            'advertisement' => $this->getAd(),

        ], 200);
    }
    protected function getAd()
    {

        return Advertisement::select('id', 'title', 'image', 'link')
            ->where('publish_status', '1')
            ->where('delete_status', '0')
            ->where('placement', 'full-width')
            ->where('image', '<>', null)
            ->limit(1)
            ->orderBy('id', 'DESC')
            ->get()
            ->map(function ($item, $key) {
                return [
                    // 'title' => $item->title,
                    'image' =>asset('uploads/notices/'.$item->image),
                    'link' => $item->link,
                ];
            });

    }

    public function showProduct($product_slug)
    {
        $product_detail = Product::leftJoin('tbl_sellers as s', 's.id', '=', 'tbl_products.owner_id')
            ->join('tbl_stocks', 'tbl_stocks.product_id', '=', 'tbl_products.id')
            ->select('tbl_products.*', 'tbl_products.id as product_id', 's.first_name', 's.last_name', 's.company_name', 's.company_address', 'tbl_stocks.remaining_stock')
            ->where('product_slug', $product_slug)
            ->allStatus()->holidayStatus()
            ->first();

        $product_id = Product::where('product_slug', $product_slug)->first()->id;

        $productReviews = Product::where('id', $product_id)->first()->reviews;
        $one_star_count = $productReviews->where('rating', '1')->count();
        $two_star_count = $productReviews->where('rating', '2')->count();
        $three_star_count = $productReviews->where('rating', '3')->count();
        $four_star_count = $productReviews->where('rating', '4')->count();
        $five_star_count = $productReviews->where('rating', '5')->count();



        $review = Review::where('product_id', $product_id)
            ->select(DB::raw('count(tbl_reviews.product_id) as total_reviews'), DB::raw('avg(tbl_reviews.rating) as average_rating'))
            ->groupBy('product_id')->first();

        if (isset($review)) {
            $review->setAttribute('one_star_count', $one_star_count);
            $review->setAttribute('$two_star_count', $two_star_count);
            $review->setAttribute('$three_star_count', $three_star_count);
            $review->setAttribute('$four_star_count', $four_star_count);
            $review->setAttribute('$five_star_count', $five_star_count);

            $product_detail->setAttribute('review_data', $review);
        } else {
            $product_detail->setAttribute('review_data', 0);
        }




        $product_photos = Photo::where('tbl_photos.imageable_id', $product_detail->id)
            ->where('imageable_type', 'App\Product')
            ->where('tbl_photos.delete_status', '0')
            ->get();

        $product_detail->setAttribute('photos', $product_photos);

        $wishlist_check =  DB::table('tbl_wishlists')->where('product_id', $product_detail->product_id)->first();

        $wishlist_status = false;

        $product_detail->setAttribute('wishlist_status', $wishlist_status);

        return response()->json([
            'status' => true,
            'status_message' => 'data received successfully !!!',
            'product_image_link' => asset('uploads/products/'),
            'product_detail' => $product_detail,

        ], 200);
    }

    public function seeAllProduct(Request $request,$finalArray = null)
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

        if($request->category){
        $category = Category::where('id', $request->category)->firstOrFail();
        $subcategory = $category->child;
        $finalArray = $this->getArrayOfCategory($category->category_slug);
        $request->category = $finalArray;
        }
        // return $request;
        // $check = explode("_", $request->sortBy);
        // $minPrice = null;
        // $maxPrice = null;
        // if (array_key_exists('2', $check)) {
        //     $minPrice = explode("_", $request->sortBy)[2];
        //     $maxPrice = explode("_", $request->sortBy)[3];
        // }

        // if (isset($request->sortBy)) {
        //     $priceOrRating = explode("_", $request->sortBy)[0];
        //     $ascOrDesc = explode("_", $request->sortBy)[1];

        //     if ($priceOrRating == "price") {
        //         $flash_sell_all_products = Product::leftJoin('tbl_sellers as s', 's.id', '=', 'tbl_products.owner_id')
        //             ->select('tbl_products.*', 's.first_name', 's.last_name', 's.company_name')
        //             ->allStatus()->holidayStatus()
        //             ->when($ascOrDesc, function ($query, $ascOrDesc) {
        //                 return $query->orderBy('tbl_products.product_original_price', $ascOrDesc);
        //             })
        //             ->when($minPrice, function ($query, $minPrice) {
        //                 return $query->where('tbl_products.product_original_price', '>=', $minPrice);
        //             })
        //             ->when($maxPrice, function ($query, $maxPrice) {
        //                 return $query->where('tbl_products.product_original_price', '<=', $maxPrice);
        //             })
        //             ->paginate(8);
        //     } else if ($priceOrRating == "rate") {
        //         $flash_sell_all_products = Product::leftJoin('tbl_sellers as s', 's.id', '=', 'tbl_products.owner_id')
        //             ->join('tbl_reviews as r', 'r.product_id', 'tbl_products.id')
        //             ->select('tbl_products.*', 's.first_name', 's.last_name', 's.company_name')
        //             ->allStatus()->holidayStatus()
        //             ->when($ascOrDesc, function ($query, $ascOrDesc) {
        //                 return $query->orderByRaw('AVG(r.rating)', $ascOrDesc);
        //             })
        //             ->when($minPrice, function ($query, $minPrice) {
        //                 return $query->where('tbl_products.product_original_price', '>=', $minPrice);
        //             })
        //             ->when($maxPrice, function ($query, $maxPrice) {
        //                 return $query->where('tbl_products.product_original_price', '<=', $maxPrice);
        //             })
        //             ->groupBy('r.product_id')
        //             ->paginate(8);
        //     } else if ($priceOrRating == "date") {
        //         $flash_sell_all_products = Product::leftJoin('tbl_sellers as s', 's.id', '=', 'tbl_products.owner_id')
        //             ->select('tbl_products.*', 's.first_name', 's.last_name', 's.company_name')
        //             ->allStatus()->holidayStatus()
        //             ->orderBy('tbl_products.created_at', $ascOrDesc)
        //             ->when($minPrice, function ($query, $minPrice) {
        //                 return $query->where('tbl_products.product_original_price', '>=', $minPrice);
        //             })
        //             ->when($maxPrice, function ($query, $maxPrice) {
        //                 return $query->where('tbl_products.product_original_price', '<=', $maxPrice);
        //             })
        //             ->paginate(8);
        //     } else if ($priceOrRating == "null") {
        //         $flash_sell_all_products = Product::leftJoin('tbl_sellers as s', 's.id', '=', 'tbl_products.owner_id')
        //             ->select('tbl_products.*', 's.first_name', 's.last_name', 's.company_name')
        //             ->allStatus()->holidayStatus()
        //             ->when($minPrice, function ($query, $minPrice) {
        //                 return $query->where('tbl_products.product_original_price', '>=', $minPrice);
        //             })
        //             ->when($maxPrice, function ($query, $maxPrice) {
        //                 return $query->where('tbl_products.product_original_price', '<=', $maxPrice);
        //             })
        //             ->paginate(8);
        //     }
        // } else {
        //     //Default Filter
        //     $flash_sell_all_products = Product::leftJoin('tbl_sellers as s', 's.id', '=', 'tbl_products.owner_id')
        //         ->select('tbl_products.*', 's.first_name', 's.last_name', 's.company_name')
        //         ->allStatus()->holidayStatus()
        //         ->orderBy('tbl_products.created_at', 'desc')
        //         ->paginate(8);
        // }
        $flash_sell_all_products = Product::leftJoin('tbl_sellers as s', 's.id', '=', 'tbl_products.owner_id')
        ->select('tbl_products.*', 's.first_name', 's.last_name', 's.company_name')
        ->allStatus()->holidayStatus()
        // ->orderBy('tbl_products.created_at', 'desc')
        ->when($request->keyword, function ($query) use ($request) {

            return $query->where(DB::raw('lower(tbl_products.product_name)'), 'like', '%' . strtolower($request->keyword) . '%');
                // ->orWhere(DB::raw('lower(description)'), 'like', '%' . strtolower($request->keyword) . '%');
        })
        ->when($request->brand, function ($query) use ($request) {

            return $query->where(DB::raw('lower(tbl_products.product_brand)'),'like', '%' . strtolower($request->brand) . '%');
        })
        ->when($request->category, function ($query) use ($request ) {
            // return $query->where('tbl_products.category_id',$request->category);
            return $query->whereIn('tbl_products.category_id', $request->category);
        })

        ->when($request->sortBy, function ($query) use ($request) {

            return $query->orderBy('tbl_products.product_original_price',$request->sortBy);
        })
        ->when($request->rate, function ($query) use ($request) {

            return $query->where('tbl_products.rating','>=',$request->rate);
        })
        ->when($request->minPrice, function ($query) use ($request) {

            return $query->where('tbl_products.product_original_price','>=',$request->minPrice);
        })
        ->when($request->maxPrice, function ($query) use ($request) {

            return $query->where('tbl_products.product_original_price','<=',$request->maxPrice);
        })
        ->paginate(8);
        // dd($flash_sell_all_products->count());
        foreach($flash_sell_all_products as $row){
            unset($row['rating']);
            $row->setAttribute('is_wish', false);
            if($customer_id){
                $check_user_wishlist = DB::table('tbl_wishlists')->where('product_id', $row->id)->where('user_id', $customer_id)->first();
                if($check_user_wishlist){
                    $row->setAttribute('is_wish', true);
                }
            }
        }


        return response()->json([
            'status' => true,
            'message' => 'data received successfully !!!',
            'product_link' => asset('uploads/products/'),
            'products' => $flash_sell_all_products,

        ], 200);
    }
    public function filterData()
    {

        $categories =  Category::where('publish_status', '1')
        ->where('delete_status', '0')
        ->where('category_id', '0')
        ->with('children')
        ->get();

        $data = [];
        $filter_categories = $categories->map(function($category) {
            return $category->children()->get();
        });

       foreach($categories as $filter){
        //    dd($filter->children);
        if($filter->children->count() > 0){
            foreach($filter->children as $children){
        //    dd($children->child);
        if($children->child->count() > 0){
            foreach($children->child as $child){
                $data[] = [
                    'id' => $child['id'],
                    'name' => $child['category_name'],
                    'slug' => $child['category_slug'],
                ];
            }
        }
            }
        }

       }
        // dd($filter_categories->pluck('id','category_name'));
        $filter_brand = Product::where('publish_status', '1')
        ->where('delete_status', '0')
        ->orderBy('id', 'desc')
        ->groupBy('product_brand')
        ->select('product_brand as name')
        ->get();
        return response()->json([
            'status' => true,
            'message' => 'data received successfully !!!',
            'filter_categories' => $data,
            'filter_brand' => $filter_brand,
        ], 200);
    }

    public function seeAllFeaturedCategory()
    {
        $featured_categories = Category::where('publish_status', '1')
            ->where('delete_status', '0')
            ->whereHas('products', function (Builder $query) {
                $query->where('publish_status', '1')->where('delete_status', '0')->where('live_status', '1');
            })
            ->orderBy('id', 'desc')
            ->paginate(12);

        foreach ($featured_categories as $category) {
            // $totalItems = $category->products->count();
            $totalItems = Product::where('category_id', $category->id)->where('publish_status', '1')->where('delete_status', '0')->where('live_status', '1')->count();
            // return $totalItems;
            $category->setAttribute('totalItems', $totalItems);
        }

        return response()->json([
            'status' => true,
            'message' => 'data received successfully !!!',
            'categories_link' => asset('uploads/categories/'),
            'featured_categories' => $featured_categories,
        ], 200);
    }
    public function seeAllPopularCategory(Request $request)
    {
        $popular_categories = Category::where('publish_status', '1')
        ->where('delete_status', '0')
        ->whereHas('products', function (Builder $query) {
            $query->where('publish_status', '1')->where('delete_status', '0')->where('live_status', '1');
        })
        ->orderBy('id', 'desc')
        ->paginate(8);

    foreach ($popular_categories as $category) {
        // $totalItems = $category->products->count();
        $totalItems = Product::where('category_id', $category->id)->where('publish_status', '1')->where('delete_status', '0')->where('live_status', '1')->count();
        // return $totalItems;
        $category->setAttribute('totalItems', $totalItems);
    }

    return response()->json([
        'status' => true,
        'message' => 'data received successfully !!!',
        'categories_link' => asset('uploads/categories/'),
        'popular_categories' => $popular_categories,
    ], 200);
    }
    public function seeAllFeaturedProduct(Request $request)
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
        if($request->category){
            $category = Category::where('id', $request->category)->firstOrFail();
            $subcategory = $category->child;
            $finalArray = $this->getArrayOfCategory($category->category_slug);
            $request->category = $finalArray;
            }
        // $check = explode("_", $request->sortBy);
        // $minPrice = null;
        // $maxPrice = null;
        // if (array_key_exists('2', $check)) {
        //     $minPrice = explode("_", $request->sortBy)[2];
        //     $maxPrice = explode("_", $request->sortBy)[3];
        // }

        // if (isset($request->sortBy)) {
        //     $priceOrRating = explode("_", $request->sortBy)[0];
        //     $ascOrDesc = explode("_", $request->sortBy)[1];

        //     if ($priceOrRating == "price") {
        //         $recent_products = Product::leftJoin('tbl_sellers as s', 's.id', '=', 'tbl_products.owner_id')
        //             ->select('tbl_products.*', 's.first_name', 's.last_name', 's.company_name')
        //             ->allStatus()->holidayStatus()
        //             ->where('tbl_products.best_rated', '1')
        //             ->when($ascOrDesc, function ($query, $ascOrDesc) {
        //                 return $query->orderBy('tbl_products.product_original_price', $ascOrDesc);
        //             })
        //             ->when($minPrice, function ($query, $minPrice) {
        //                 return $query->where('tbl_products.product_original_price', '>=', $minPrice);
        //             })
        //             ->when($maxPrice, function ($query, $maxPrice) {
        //                 return $query->where('tbl_products.product_original_price', '<=', $maxPrice);
        //             })
        //             ->paginate(8);
        //     } else if ($priceOrRating == "rate") {
        //         $recent_products = Product::leftJoin('tbl_sellers as s', 's.id', '=', 'tbl_products.owner_id')
        //             ->join('tbl_reviews as r', 'r.product_id', 'tbl_products.id')
        //             ->select('tbl_products.*', 's.first_name', 's.last_name', 's.company_name')
        //             ->allStatus()->holidayStatus()
        //             ->where('tbl_products.best_rated', '1')
        //             ->when($ascOrDesc, function ($query, $ascOrDesc) {
        //                 return $query->orderByRaw('AVG(r.rating)', $ascOrDesc);
        //             })
        //             ->when($minPrice, function ($query, $minPrice) {
        //                 return $query->where('tbl_products.product_original_price', '>=', $minPrice);
        //             })
        //             ->when($maxPrice, function ($query, $maxPrice) {
        //                 return $query->where('tbl_products.product_original_price', '<=', $maxPrice);
        //             })
        //             ->groupBy('r.product_id')
        //             ->paginate(8);
        //     } else if ($priceOrRating == "date") {
        //         $recent_products = Product::leftJoin('tbl_sellers as s', 's.id', '=', 'tbl_products.owner_id')
        //             ->select('tbl_products.*', 's.first_name', 's.last_name', 's.company_name')
        //             ->allStatus()->holidayStatus()
        //             ->where('tbl_products.best_rated', '1')
        //             ->orderBy('tbl_products.created_at', $ascOrDesc)
        //             ->when($minPrice, function ($query, $minPrice) {
        //                 return $query->where('tbl_products.product_original_price', '>=', $minPrice);
        //             })
        //             ->when($maxPrice, function ($query, $maxPrice) {
        //                 return $query->where('tbl_products.product_original_price', '<=', $maxPrice);
        //             })
        //             ->paginate(8);
        //     } else if ($priceOrRating == "null") {
        //         $recent_products = Product::leftJoin('tbl_sellers as s', 's.id', '=', 'tbl_products.owner_id')
        //             ->select('tbl_products.*', 's.first_name', 's.last_name', 's.company_name')
        //             ->allStatus()->holidayStatus()
        //             ->where('tbl_products.best_rated', '1')
        //             ->when($minPrice, function ($query, $minPrice) {
        //                 return $query->where('tbl_products.product_original_price', '>=', $minPrice);
        //             })
        //             ->when($maxPrice, function ($query, $maxPrice) {
        //                 return $query->where('tbl_products.product_original_price', '<=', $maxPrice);
        //             })
        //             ->paginate(8);
        //     }
        // } else {
        //     //Default Filter
        //     $recent_products = Product::leftJoin('tbl_sellers as s', 's.id', '=', 'tbl_products.owner_id')
        //         ->select('tbl_products.*', 's.first_name', 's.last_name', 's.company_name')
        //         ->allStatus()->holidayStatus()
        //         ->where('tbl_products.best_rated', '1')
        //         ->orderBy('tbl_products.created_at', 'desc')
        //         ->paginate(8);
        // }
        $recent_products = Product::leftJoin('tbl_sellers as s', 's.id', '=', 'tbl_products.owner_id')
        // ->leftJoin('tbl_reviews as r', 'r.id', '=', 'tbl_products.id')
        ->select('tbl_products.*', 's.first_name', 's.last_name', 's.company_name')
                ->allStatus()->holidayStatus()
                ->where('tbl_products.best_rated', '1')
                ->orderBy('tbl_products.created_at', 'desc')
        ->when($request->keyword, function ($query) use ($request) {

            return $query->where(DB::raw('lower(tbl_products.product_name)'), 'like', '%' . strtolower($request->keyword) . '%');
                // ->orWhere(DB::raw('lower(description)'), 'like', '%' . strtolower($request->keyword) . '%');
        })
        ->when($request->brand, function ($query) use ($request) {

            return $query->where(DB::raw('lower(tbl_products.product_brand)'),'like', '%' . strtolower($request->keyword) . '%');
        })
        ->when($request->category, function ($query) use ($request) {

            return $query->whereIn('tbl_products.category_id','>=',$request->category);
        })

        ->when($request->sortBy, function ($query) use ($request) {

            return $query->orderBy('tbl_products.product_original_price',$request->sortBy);
        })
        ->when($request->rate, function ($query) use ($request) {

            return $query->where('tbl_products.rating','>=',$request->rate);
        })
        ->when($request->minPrice, function ($query) use ($request) {

            return $query->where('tbl_products.product_original_price','>=',$request->minPrice);
        })
        ->when($request->maxPrice, function ($query) use ($request) {

            return $query->where('tbl_products.product_original_price','<=',$request->maxPrice);
        })
        ->paginate(8);
        foreach($recent_products as $row){
            unset($row['rating']);
            $row->setAttribute('is_wish', false);
            if($customer_id){
                $check_user_wishlist = DB::table('tbl_wishlists')->where('product_id', $row->id)->where('user_id', $customer_id)->first();
                if($check_user_wishlist){
                    $row->setAttribute('is_wish', true);
                }
            }
        }


        return response()->json([
            'status' => true,
            'message' => 'data received successfully !!!',
            'product_link' => asset('uploads/products/'),
            'products' => $recent_products,
        ], 200);
    }

    public function getSubCat_Product($category_slug, Request $request)
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

        $category = Category::where('category_slug', $category_slug)->firstOrFail();
        $subcategory = $category->child;
        // $products = $category->products()->where('tbl_products.publish_status','1')->where('tbl_products.delete_status','0')->where('tbl_products.live_status','1')->paginate(8);
        $finalArray = $this->getArrayOfCategory($category_slug);
        // dd($finalArray);

        // Filter Options //

        // $check = explode("_", $request->sortBy);
        // $minPrice = null;
        // $maxPrice = null;
        // if (array_key_exists('2', $check)) {
        //     $minPrice = explode("_", $request->sortBy)[2];
        //     $maxPrice = explode("_", $request->sortBy)[3];
        // }

        // if (isset($request->sortBy)) {
        //     $priceOrRating = explode("_", $request->sortBy)[0];
        //     $ascOrDesc = explode("_", $request->sortBy)[1];

        //     if ($priceOrRating == "price") {
        //         $products = Product::allStatus()->holidayStatus()
        //         ->whereIn('category_id', $finalArray)
        //         ->when($ascOrDesc, function ($query, $ascOrDesc) {
        //                 return $query->orderBy('product_original_price', $ascOrDesc);
        //             })
        //             ->when($minPrice, function ($query, $minPrice) {
        //                 return $query->where('product_original_price', '>=', $minPrice);
        //             })
        //             ->when($maxPrice, function ($query, $maxPrice) {
        //                 return $query->where('product_original_price', '<=', $maxPrice);
        //             })
        //         ->paginate(8);
        //     } else if ($priceOrRating == "rate") {

        //         $products = Product::allStatus()->holidayStatus()
        //             ->whereIn('category_id', $finalArray)
        //             ->when($ascOrDesc, function ($query, $ascOrDesc) {
        //                 return $query->orderByRaw('AVG(r.rating)', $ascOrDesc);
        //             })
        //             ->when($minPrice, function ($query, $minPrice) {
        //                 return $query->where('tbl_products.product_original_price', '>=', $minPrice);
        //             })
        //             ->when($maxPrice, function ($query, $maxPrice) {
        //                 return $query->where('tbl_products.product_original_price', '<=', $maxPrice);
        //             })
        //         ->paginate(8);

        //     } else if ($priceOrRating == "date") {

        //         $products = Product::allStatus()->holidayStatus()
        //             ->whereIn('category_id', $finalArray)
        //             ->orderBy('tbl_products.created_at', $ascOrDesc)
        //             ->when($minPrice, function ($query, $minPrice) {
        //                 return $query->where('tbl_products.product_original_price', '>=', $minPrice);
        //             })
        //             ->when($maxPrice, function ($query, $maxPrice) {
        //                 return $query->where('tbl_products.product_original_price', '<=', $maxPrice);
        //             })
        //             ->paginate(8);

        //     } else if ($priceOrRating == "null") {

        //         $products = Product::allStatus()->holidayStatus()
        //             ->whereIn('category_id', $finalArray)
        //             ->when($minPrice, function ($query, $minPrice) {
        //                 return $query->where('tbl_products.product_original_price', '>=', $minPrice);
        //             })
        //             ->when($maxPrice, function ($query, $maxPrice) {
        //                 return $query->where('tbl_products.product_original_price', '<=', $maxPrice);
        //             })
        //             ->paginate(8);
        //     }
        // } else {
        //     //Default Filter
        //     $products = Product::allStatus()->holidayStatus()
        //     ->whereIn('category_id', $finalArray)
        //     ->latest()
        //     ->paginate(8);

        // $product_count = $products->total();

        // }

        // END FILTER //
        $products = Product::allStatus()->holidayStatus()
            ->whereIn('category_id', $finalArray)
            ->when($request->keyword, function ($query) use ($request) {

                return $query->where(DB::raw('lower(product_name)'), 'like', '%' . strtolower($request->keyword) . '%');
                    // ->orWhere(DB::raw('lower(description)'), 'like', '%' . strtolower($request->keyword) . '%');
            })
            ->when($request->brand, function ($query) use ($request) {

                return $query->where(DB::raw('lower(product_brand)'),'like', '%' . strtolower($request->brand) . '%');
            })
            ->when($request->category, function ($query) use ($request) {
                // dd($request->category);

                return $query->where('category_id',$request->category);
            })

            ->when($request->sortBy, function ($query) use ($request) {

                return $query->orderBy('product_original_price',$request->sortBy);
            })
            ->when($request->rate, function ($query) use ($request) {

                return $query->where('rating','>',$request->rate);
            })
            ->when($request->minPrice, function ($query) use ($request) {

                return $query->where('product_original_price','>=',$request->minPrice);
            })
            ->when($request->maxPrice, function ($query) use ($request) {

                return $query->where('product_original_price','<=',$request->maxPrice);
            })
            // ->latest()
            ->paginate(8);
            // dd($products);

        $product_count = $products->total();

        foreach ($subcategory as $key => $row) {
            $finalArray = $this->getArrayOfCategory($row->category_slug);

            $product_count = Product::where('publish_status', '1')->where('delete_status', '0')
                ->where('live_status', '1')
                ->whereIn('category_id', $finalArray)
                ->get()->count();

            $subcategory[$key]->setAttribute('totalItems', $product_count);
        }

        foreach ($products as $key => $row) {
            $seller_info = Seller::where('id', $row->owner_id)->first();
            if (isset($seller_info)) {
                $products[$key]->setAttribute('company_name', $seller_info->company_name);
            } else {

                $products[$key]->setAttribute('company_name', config('app.name'));
            }
            $row->setAttribute('is_wish', false);
            if($customer_id){
                $check_user_wishlist = DB::table('tbl_wishlists')->where('product_id', $row->id)->where('user_id', $customer_id)->first();
                if($check_user_wishlist){
                    $row->setAttribute('is_wish', true);
                }
            }
        }

        // if (count($subcategory) > 0){
        //     $products = [];
        // }

        return response()->json([
            'status' => true,
            'message' => 'data received successfully !!!',
            'product_link' => asset('uploads/products/'),
            'categories_link' => asset('uploads/categories/'),
            'subcategory' => $subcategory,
            'products'  => $products
        ], 200);

        //  $category = Category::where('category_slug', $category_slug)->firstOrFail();
        //     $subcategory = [];

        //     $products = $category->products()->where('publish_status','1')->where('delete_status','0')->where('live_status','1')->paginate(8);


        //     foreach ($products as $key => $row) {
        //         $seller_info = Seller::where('id', $row->owner_id)->first();
        //         if (isset($seller_info)) {
        //             $products[$key]->setAttribute('company_name', $seller_info->company_name);
        //         } else {
        //             $products[$key]->setAttribute('company_name', config('app.name'));
        //         }
        //     }

        //     return response()->json([
        //         'status' => true,
        //         'message' => 'data received successfully !!!',
        //         'product_link' => asset('uploads/products/'),
        //         'categories_link' => asset('uploads/categories/'),
        //         'subcategory' => $subcategory,
        //         'products'  => $products
        //     ], 200);
    }

    public function stockVerify(Request $request)
    { // this function is to verify cart product available or not to proceed to before checkout

        $items_arr = json_decode($request->items, true);

        $arr = [];

        // return $items_arr;

        $message = 'Product exists';

        $quantity_status = true;

        foreach ($items_arr as $key =>  $row) {

            $sold_out = Product::leftJoin('tbl_stocks', 'tbl_stocks.product_id', '=', 'tbl_products.id')
                ->leftJoin('tbl_sellers as s', 's.id', '=', 'tbl_products.owner_id')
                ->where('tbl_products.id', $row['id'])
                ->select('tbl_products.*',  'tbl_stocks.remaining_stock', 's.first_name', 's.last_name', 's.company_name')
                ->first();

            if (!isset($sold_out)) {
                $message = 'Product does not exist';
                $quantity_status = false;
                continue;
            }

            $cart_quantity = $row['quantity'];

            $stock_quantity = $sold_out->remaining_stock;

            if ($sold_out->publish_status == "0" || $sold_out->delete_status == "1" || $sold_out->live_status == "0") {
                $message = 'Product removed from database';
                $quantity_status = false;
            } else {
                if ($cart_quantity > $stock_quantity) {
                    $message = 'No Product remaining in stock ';
                    $quantity_status = false;
                }
            }


            if ($sold_out->publish_status == "0" || $sold_out->delete_status == "1" || $sold_out->live_status == "0") {
                $data = [
                    'product_name' => $sold_out->product_name,
                    'product_featured_image' => $sold_out->image,
                    'product_code' => $sold_out->product_code,
                    'product_slug' => $sold_out->product_slug,
                    'product_brand' => $sold_out->product_brand,
                    'product_model' => $sold_out->product_model,
                    'product_highlights' => $sold_out->product_highlights,
                    'product_description' => $sold_out->product_description,
                    'product_warranty_type' => $sold_out->product_warranty_type,
                    'product_warrenty_period' => $sold_out->product_warrenty_period,
                    'product_warrenty_policy' => $sold_out->product_warrenty_policy,
                    'product_whats_on_box' => $sold_out->product_whats_on_box,
                    'product_original_price' => $sold_out->product_original_price,
                    'product_compare_price' => $sold_out->product_compare_price,
                    'product_key_features' => $sold_out->product_key_features,
                    'remaining_stock' => '0',
                    'seller_firstname' => $sold_out->first_name,
                    'seller_lastname' => $sold_out->last_name,
                    'seller_company_name' => $sold_out->company_name,
                    'id' => $row['id'],
                    'quantity' => $row['quantity'],
                ];

                array_push($arr, $data);
            } else {
                $data = [
                    'product_name' => $sold_out->product_name,
                    'product_featured_image' => $sold_out->image,
                    'product_code' => $sold_out->product_code,
                    'product_slug' => $sold_out->product_slug,
                    'product_brand' => $sold_out->product_brand,
                    'product_model' => $sold_out->product_model,
                    'product_highlights' => $sold_out->product_highlights,
                    'product_description' => $sold_out->product_description,
                    'product_warranty_type' => $sold_out->product_warranty_type,
                    'product_warrenty_period' => $sold_out->product_warrenty_period,
                    'product_warrenty_policy' => $sold_out->product_warrenty_policy,
                    'product_whats_on_box' => $sold_out->product_whats_on_box,
                    'product_original_price' => $sold_out->product_original_price,
                    'product_compare_price' => $sold_out->product_compare_price,
                    'product_key_features' => $sold_out->product_key_features,
                    'remaining_stock' => $sold_out->remaining_stock,
                    'seller_firstname' => $sold_out->first_name,
                    'seller_lastname' => $sold_out->last_name,
                    'seller_company_name' => $sold_out->company_name,
                    'id' => $row['id'],
                    'quantity' => $row['quantity'],
                ];

                array_push($arr, $data);
            }
        }

        return response()->json([
            'status' => true,
            'message' => $message,
            'product_link' => asset('uploads/products/'),
            'stock_info'  => $arr,
            'quantity_status' => $quantity_status

        ], 200);
    }

    public function beforeCheckout(Request $request)
    {
        $items_arr = json_decode($request->items, true);

        $arr = [];

        $quantity_status = true;
        $sub_total = 0;
        $total_delivery_charges = 0;
        $total_tax = 0;
        $total_discount = 0;

        // $ip = '110.44.115.202'; //Kathmandu
        // $ip = $request->ip;
        $ip = $request->ip();
        $location = \Location::get($ip);

        $address = $location->cityName;
        $totalWeight = 0;
        $expresstotalWeight = 0;
        $freetotalWeight = 0;
        $standardtotalWeight = 0;

        foreach ($items_arr as $key =>  $row) {
            $product = Product::where('id', $row['id'])->first();
            if($product->deliveryType == 'standard'){
                $standardtotalWeight = $standardtotalWeight + $product->product_package_weight * $row['quantity'];

            }
            if($product->deliveryType == 'express'){
                $expresstotalWeight = $expresstotalWeight + $product->product_package_weight * $row['quantity'];

            }
            if($product->deliveryType == 'free'){
                $freetotalWeight = $freetotalWeight + $product->product_package_weight * $row['quantity'];

            }
        }
        $standard_delivery_charges = 0;
        $express_delivery_charges = 0;
        if($standardtotalWeight > 0){
            $standardcharge = DeliverySetting::where('weight_min', '<', $totalWeight)
            ->where('weight_max', '>=', $standardtotalWeight)
            ->where('destination', $address)
            ->first();

            if (isset($standardcharge)) {
                $standard_delivery_charges = $standardcharge->rate;
            } else {
                $standard_delivery_charges = 75;
            }
        }
        if($expresstotalWeight > 0){
            $expresscharge = DeliverySetting::where('weight_min', '<', $totalWeight)
            ->where('weight_max', '>=', $expresstotalWeight)
            ->where('destination', $address)
            ->first();

            if (isset($expresscharge)) {
                $setting = Setting::first();
                $express_delivery_charges = $expresscharge->rate + (($setting->expressCharge)/100 * $expresscharge->rate);
            } else {
                $express_delivery_charges = 100;
            }
        }
        $total_delivery_charges = $express_delivery_charges + $standard_delivery_charges;


        // $charge = DeliverySetting::where('weight_min', '<', $totalWeight)
        //     ->where('weight_max', '>=', $totalWeight)
        //     ->where('destination', $address)
        //     ->first();
        // if (isset($charge)) {
        //     $total_delivery_charges = $charge->rate;
        // } else {
        //     $total_delivery_charges = 75;
        // }

        foreach ($items_arr as $key =>  $row) {

            $sold_out = Product::join('tbl_stocks', 'tbl_stocks.product_id', '=', 'tbl_products.id')
                ->leftJoin('tbl_sellers as s', 's.id', '=', 'tbl_products.owner_id')
                ->where([
                    'tbl_products.publish_status' => '1',
                    'tbl_products.delete_status'  =>  '0',
                ])
                ->where('tbl_products.id', $row['id'])
                ->select('tbl_products.*',  'tbl_stocks.remaining_stock', 's.first_name', 's.last_name', 's.company_name')
                ->first();

            $cart_quantity = $row['quantity'];

            $stock_quantity = $sold_out->remaining_stock;
            if ($cart_quantity > $stock_quantity) {
                $quantity_status = false;
            }

            //  $delivery_charges = 0;
            //  if($sold_out->home_delivery == '1'){
            //      $delivery_charges = $sold_out->delivery_charges;
            //  }

            //  calculation of subtotal :

            $product_price = $sold_out->product_original_price;
            $product_quantity = $cart_quantity;
            $sub_total_calc = $product_price * $product_quantity;
            $sub_total += $sub_total_calc;
            //   $total_delivery_charges+= $delivery_charges;
            $total_tax += $sold_out->tax;

            $data = [
                'product_name' => $sold_out->product_name,
                'product_featured_image' => $sold_out->image,
                'product_code' => $sold_out->product_code,
                'product_slug' => $sold_out->product_slug,
                'product_brand' => $sold_out->product_brand,
                'product_model' => $sold_out->product_model,
                'product_highlights' => $sold_out->product_highlights,
                'product_description' => $sold_out->product_description,
                'product_warranty_type' => $sold_out->product_warranty_type,
                'product_warrenty_period' => $sold_out->product_warrenty_period,
                'product_warrenty_policy' => $sold_out->product_warrenty_policy,
                'product_whats_on_box' => $sold_out->product_whats_on_box,
                'product_original_price' => $sold_out->product_original_price,
                'product_compare_price' => $sold_out->product_compare_price,
                'product_key_features' => $sold_out->product_key_features,
                'deliveryType' => $sold_out->deliveryType,
                // 'delivery_charges' => $delivery_charges,
                'remaining_stock' => $sold_out->remaining_stock,
                'seller_firstname' => $sold_out->first_name,
                'seller_lastname' => $sold_out->last_name,
                'seller_company_name' => $sold_out->company_name,
                'id' => $row['id'],
                'quantity' => $row['quantity'],
            ];

            array_push($arr, $data);
        }

        //  calculation of grand total
        $grand_total = $sub_total + $total_delivery_charges + $total_tax - $total_discount;
        $setting = Setting::first();
        $purchase_reward = $grand_total * ($setting->purchase_reward / 100);

        return response()->json([
            'status' => true,
            'message' => 'data received successfully !!!',
            'product_link' => asset('uploads/products/'),
            'stock_info'  => $arr,
            'quantity_status' => $quantity_status,
            'subtotal' => $sub_total,
            'grand_total' => $grand_total,
            'total_shipping_charge' => $total_delivery_charges,
            'purchase_reward' => $purchase_reward
        ], 200);
    }

    public function differentShipping(Request $request)
    {
        // return $request;
        $items_arr = json_decode($request->items, true);


        $sub_total = 0;
        $total_delivery_charges = 0;
        $total_tax = 0;
        $total_discount = 0;

        foreach ($items_arr as $key =>  $row) {

            $sold_out = Product::join('tbl_stocks', 'tbl_stocks.product_id', '=', 'tbl_products.id')
                ->leftJoin('tbl_sellers as s', 's.id', '=', 'tbl_products.owner_id')
                ->where([
                    'tbl_products.publish_status' => '1',
                    'tbl_products.delete_status'  =>  '0',
                ])
                ->where('tbl_products.id', $row['id'])
                ->select('tbl_products.*',  'tbl_stocks.remaining_stock', 's.first_name', 's.last_name', 's.company_name')
                ->first();

            $cart_quantity = $row['quantity'];

            //  $delivery_charges = 0;
            //  if($sold_out->home_delivery == '1'){
            //      $delivery_charges = $sold_out->delivery_charges;
            //  }

            //  calculation of subtotal :

            $product_price = $sold_out->product_original_price;
            $product_quantity = $cart_quantity;
            $sub_total_calc = $product_price * $product_quantity;
            $sub_total += $sub_total_calc;
            //   $total_delivery_charges+= $delivery_charges;
            $total_tax += $sold_out->tax;
        }
        if ($request->different_shipping == "1") {
            $address = $request->shipping_state;
        } else {
            $ip = $request->ip();
            $location = \Location::get($ip);
            $address = $location->cityName;
        }


        $totalWeight = 0;
        $expresstotalWeight = 0;
        $freetotalWeight = 0;
        $standardtotalWeight = 0;

        foreach ($items_arr as $key =>  $row) {
            $product = Product::where('id', $row['id'])->first();
            if($product->deliveryType == 'standard'){
                $standardtotalWeight = $standardtotalWeight + $product->product_package_weight * $row['quantity'];

            }
            if($product->deliveryType == 'express'){
                $expresstotalWeight = $expresstotalWeight + $product->product_package_weight * $row['quantity'];

            }
            if($product->deliveryType == 'free'){
                $freetotalWeight = $freetotalWeight + $product->product_package_weight * $row['quantity'];

            }
            // $totalWeight = $totalWeight + $product->product_package_weight * $row['quantity'];
        }
        $standard_delivery_charges = 0;
        $express_delivery_charges = 0;
        if($standardtotalWeight > 0){
            $standardcharge = DeliverySetting::where('weight_min', '<', $totalWeight)
            ->where('weight_max', '>=', $standardtotalWeight)
            ->where('destination', $address)
            ->first();

            if (isset($standardcharge)) {
                $standard_delivery_charges = $standardcharge->rate;
            } else {
                $standard_delivery_charges = 75;
            }
        }
        if($expresstotalWeight > 0){
            $expresscharge = DeliverySetting::where('weight_min', '<', $totalWeight)
            ->where('weight_max', '>=', $expresstotalWeight)
            ->where('destination', $address)
            ->first();

            if (isset($expresscharge)) {
                $setting = Setting::first();
                $express_delivery_charges = $expresscharge->rate + (($setting->expressCharge)/100 * $expresscharge->rate);
            } else {
                $express_delivery_charges = 100;
            }
        }



        // if (isset($charge)) {
        //     $total_delivery_charges = $charge->rate;
        // } else {
        //     $total_delivery_charges = 75;
        // }
        $total_delivery_charges = $express_delivery_charges + $standard_delivery_charges;

           //  calculation of grand total
           $grand_total = $sub_total + $total_delivery_charges + $total_tax - $total_discount;
           $setting = Setting::first();
           $purchase_reward = $grand_total * ($setting->purchase_reward / 100);

        return response()->json([
            'status' => true,
            'message' => 'data received successfully !!!',
            'total_shipping_charge' => $total_delivery_charges,
            'purchase_reward' => $purchase_reward
        ], 200);
    }

    public function coupon(Request $request)
    {
        $coupon = $request->useCoupon;

        $discount_amt = 0;
        $status = false;
        $message = 'coupon does not exit';

        $check_coupon_exist = Coupon::where('coupon_name', $coupon)->select('discount_price')->first();

        if ($check_coupon_exist) {
            $discount_amt = $check_coupon_exist->discount_price;
            $status = true;
            $message = 'data received successfully !!!';
        }

        return response()->json([
            'status' => $status,
            'status_message' => $message,
            'discount_amount' => $discount_amt,

        ], 200);
    }

    public function couponList()
    {
        $couponList = Coupon::all();

        return response()->json([
            'status' => true,
            'status_message' => 'Sending Coupon List',
            'couponList' => $couponList,
        ], 200);
    }

    public function cashCheckout(Request $request)
    {

        $user = Customer::where('publish_status', '1')->where('delete_status', '0')->where('id', $request->userId)->first();
        if ($user->is_social_login == '1') {

            return response()->json([
                'status' => false,
                'status_message' => 'user profile incompleted !!!',
                'profile_status' => false

            ], 200);
        } else {

            if ($request->different_shipping == '1') {
                $validator = Validator::make($request->all(), [
                    'shipping_country' => 'required',
                    'shipping_state' => 'required',
                    'shipping_town' => 'required',
                    'shipping_street' => 'required',
                    'shipping_apartment' => 'required',
                    'shipping_zipcode' => 'required',
                    'contact_person' => 'required',
                    'contact_number' => 'required'
                ]);


                if ($validator->fails()) {
                    return response()->json([
                        $validator->messages(),
                        'status' => false,
                        'status_message' => 'validation error !!!'
                    ], 200);
                }
            }



            $order = new Order();

            $ref_id = Str::random(6); //random string

            // $cart_products = $request->session()->get('cart')->items;
            $items_arr = json_decode($request->items, true);
            // return $items_arr;
            $discount_amount = $request->discount;
            foreach ($items_arr as $key =>  $row) {

                $order->create([
                    'product_id' => $row['id'],
                    'quantity' => $row['quantity'],
                    'ref_id' => $ref_id,
                    'discount_amount' => $discount_amount
                ]);
            }

            $payment = new Payment();
            $totalPrice = $request->grandTotal - $request->shipping;

            $payment->customer_id = $request->userId;
            $payment->ref_id = $ref_id;
            $payment->total_price = $totalPrice;
            $payment->delivery_cost = $request->shipping;
            // $payment->complete_status = '1';
            $payment->firstname = $user->firstname;
            $payment->lastname = $user->lastname;
            $payment->country = $user->country;
            $payment->state = $user->state;
            $payment->town = $user->town;
            $payment->street = $user->street;
            $payment->apartment = $user->apartment;
            $payment->zipcode = $user->zipcode;
            $payment->email = $user->email;
            $payment->number = $user->phone;
            $payment->notes = request('notes');
            $payment->different_shipping = ($request->different_shipping == null) ? '0' : '1';
            $payment->shipping_country = request('shipping_country');
            $payment->shipping_state = request('shipping_state');
            $payment->shipping_town = request('shipping_town');
            $payment->shipping_street = request('shipping_street');
            $payment->shipping_apartment = request('shipping_apartment');
            $payment->shipping_zipcode = request('shipping_zipcode');

            $payment->shipping_phone = request('contact_number');
            $payment->shipping_contactperson = request('contact_person');

            $payment->save();

            $this->calculateRewardPoint($user->email, $payment->total_price);
            return response()->json([
                'status' => true,
                'status_message' => 'data received successfully !!!',
                'checkout_status' => 'checkout completed !',
                'ref_id' => $ref_id
            ], 200);
        }
    }

    public function completeCashCheckout(Request $request, $ref_id)
    {
        $detail = Payment::where('ref_id', $ref_id)->firstorfail();

        // if ($detail->complete_status == "1") {
        //     return response()->json([  //returns success to ajax
        //         'status' => true,
        //         'status_message' => 'Payment Already Success'
        //     ], 200);
        // }

        $data1 = ([
            'complete_status' => '1',
        ]);

        Payment::where('ref_id', $detail->ref_id)->update($data1);

        $payment = Payment::where('ref_id', $ref_id)->first();

        $notification = new Notification();

        $notification->ref_id = $ref_id;
        $notification->extra_data = $ref_id;
        $notification->customer_email = $payment->email;
        $notification->type = "pending";
        $notification->title = "Your purchase for order id $ref_id is successfully placed.";

        $notification->save();

        $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
            ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
            ->where('tbl_payments.ref_id', $payment->ref_id)
            ->select('tbl_products.product_name', 'tbl_products.product_original_price', 'tbl_orders.quantity')
            ->get();

        // Updating stock after delivery
        $items_arr = Order::where('ref_id', $ref_id)->select('product_id', 'quantity')->get();
        foreach ($items_arr as $key =>  $row) {
            $curStock = Stock::where('product_id', $row->product_id)->first();
            $stockcal = new StockCalculate($curStock);
            $stockcal->withholdingStock($row->quantity);
            $curStock->withholding_stock = $stockcal->withholding_stock;
            $curStock->remaining_stock = $stockcal->remaining_stock;
            $curStock->save();
        }

        // Sending mail to customer and sellers after checkout
        //  return $payment;
        $setting = Setting::first();
        $pdf = PDF::loadView('emails.customer.customercheckoutmailpdf', compact('orders', 'payment', 'setting'));
        // Mail::to($payment->email)->send(new CustomerCheckoutMail($payment, $orders, $pdf));
        // foreach ($items_arr as $row) {
        //     $product = Product::where('id', $row->product_id)->first();
        //     $seller = $product->seller;
        //     $seller_email = $seller->email;
        //     if (isset($seller_email)) {
        //         $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
        //             ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
        //             ->where('tbl_payments.ref_id', $payment->ref_id)
        //             ->select('tbl_products.product_name', 'tbl_products.product_original_price', 'tbl_orders.quantity')
        //             ->where('tbl_products.owner_id', $seller->id)
        //             ->get();
        //         Mail::to($seller_email)->send(new SellerCheckoutMail($payment, $orders));
        //     }
        // }

        $product_ids = Order::where('ref_id', $ref_id)->get('product_id');
        $seller_ids = Product::whereIn('id', $product_ids)->groupBy('owner_id')->get('owner_id');
        $sellers = Seller::whereIn('id', $seller_ids)->get();
        foreach($sellers as $seller){
           $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                    ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
                    ->where('tbl_payments.ref_id', $payment->ref_id)
                    ->select('tbl_products.product_name', 'tbl_products.product_original_price', 'tbl_orders.quantity')
                    ->where('tbl_products.owner_id', $seller->id)
                    ->get();

            // Mail::to($seller->email)->send(new SellerCheckoutMail($payment, $orders)); //Mail to Seller
        }

        //Sending default message
        if ($payment->customer_id != 0) {
            $product_ids = Order::where('ref_id', $payment->ref_id)->get('product_id');
            $seller_ids = Product::whereIn('id', $product_ids)->groupBy('owner_id')->get('owner_id');
            $sellers = Seller::whereIn('id', $seller_ids)->get();

            foreach ($sellers as $seller) {
                $message = new Message();
                $message->owner_id = $seller->id;
                $message->customer_id = $payment->customer_id;
                $message->message = 'Thank You for shopping with '.config('app.name').'. Feel Free to message us at any time.';
                $message->send_by = "seller";
                $message->save();
            }
        }


        return response()->json([
            'status' => true,
            'status_message' => 'Payment Success'
        ], 200);
    }

    public function search(Request $request)
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

        $productName = $request->search;

        $search_result = Product::leftJoin('tbl_sellers as s', 's.id', '=', 'tbl_products.owner_id')
            ->allStatus()->holidayStatus()
            ->select('tbl_products.id','tbl_products.product_name', 'tbl_products.product_brand', 'tbl_products.product_slug', 'tbl_products.product_code', 'tbl_products.product_model', 'tbl_products.product_original_price',
             'tbl_products.product_compare_price', 'tbl_products.product_sku', 'tbl_products.product_highlights', 'tbl_products.image','tbl_products.deliveryType',
              's.first_name', 's.last_name', 's.company_name')
            ->when($productName, function ($query, $productName) {
                return $query->where('tbl_products.product_name', "LIKE", "%$productName%");
            })->paginate(6);
            foreach ($search_result as $search_row) {
                $review =   Review::where('product_id', $search_row->product_id)
                    ->select('product_id', DB::raw('count(tbl_reviews.product_id) as total_reviews'), DB::raw('avg(tbl_reviews.rating) as average_rating'))
                    ->groupBy('product_id')->first();

                $search_row->setAttribute('review_data', $review);
                $search_row->setAttribute('is_wish', false);
                if($customer_id){
                    $check_user_wishlist = DB::table('tbl_wishlists')->where('product_id', $search_row->id)->where('user_id', $customer_id)->first();
                    if($check_user_wishlist){
                        $search_row->setAttribute('is_wish', true);
                    }
                }
            }

        return response()->json([
            'status' => true,
            'product_link' => asset('uploads/products/'),
            'status_message' => 'data received successfully !!!',
            'search_result' => $search_result
        ], 200);
    }

    public function newsList()
    {
        $news_list = News::with('newsCategory', 'writer', 'tag')->orderBy('id', 'asc')->where('delete_status', '0')->paginate(8);
        return response()->json([
            'status' => true,
            'status_message' => 'data received successfully !!!',
            'new_image_link' => asset('uploads/news/'),
            'news_list' => $news_list
        ], 200);
    }

    public function newsDetail($news_url)
    {
        $news_detail = News::with('newsCategory', 'writer', 'tag')->orderBy('id', 'asc')->where('delete_status', '0')->where('news_url', $news_url)->first();
        return response()->json([
            'status' => true,
            'status_message' => 'data received successfully !!!',
            'new_image_link' => asset('uploads/news/'),
            'news_detail' => $news_detail
        ], 200);
    }

    public function adsList()
    {
        $ads_list = Advertisement::where('publish_status', '1')->where('delete_status', '0')->select('id', 'title', 'body', 'link', 'image', 'placement', 'featured')->paginate(8);

        return response()->json([
            'status' => true,
            'status_message' => 'data received successfully !!!',
            'ads_image_link' => asset('uploads/notices/'),
            'ads_list' => $ads_list
        ], 200);
    }

    public function compare(Request $request)
    {
        $arr_id = explode(',', $request->id);

        $all_products = Product::leftJoin('tbl_stocks', 'tbl_stocks.product_id', '=', 'tbl_products.id')->whereIn('tbl_products.id', $arr_id)->select('tbl_products.id as product_id', 'product_name', 'product_original_price', 'product_compare_price', 'product_description', 'product_key_features', 'product_brand', 'image', 'tbl_stocks.remaining_stock')->get();

        return response()->json([
            'status' => true,
            'status_message' => 'data received successfully !!!',
            'image_link' => asset('uploads/products/'),
            'all_products' => $all_products
        ], 200);
    }

    public function helpAndSupport()
    {
        $setting = Setting::first();

        return response()->json([
            'status' => true,
            'status_message' => 'Sending Help and Support Info',
            'phone' => $setting->phone,
            'viber' => $setting->viber,
            'whatsapp' => $setting->whatsapp,
            'email' => $setting->email,
        ], 200);
    }

    public function feedback(Request $request)
    {
        // $data = array(
        //     'contact_name' => $request->contact_name,
        //     'contact_subject' => $request->contact_subject,
        //     'contact_email' => $request->contact_email,
        //     'contact_number' => $request->contact_number,
        //     'contact_message' => $request->contact_message,
        // );

        $contact = new Contact();

        $contact->contact_name = request('contact_name');
        $contact->contact_subject = request('contact_subject');
        $contact->contact_email = request('contact_email');
        $contact->contact_number = request('contact_number');
        $contact->contact_message = request('contact_message');

        $contact->save();

        return response()->json([
            'status' => true,
            'status_message' => 'Feedback Received',
        ], 200);
    }

    public function refer($refer)
    {
        $referCode = explode("-", $refer)[0];
        $customerId = explode("-", $refer)[1];

        Referral::create([
            'customer_id' => $customerId,
            'referral_code' => $referCode
        ]);

        return response()->json([
            'status' => true,
            'status_message' => 'Refer Code Received',
            'referCode' => $referCode,
            'customerId' => $customerId,
        ]);
    }

    public function sidebarCategory()
    {

        //   $sidebar_child_categories = Category::leftJoin('tbl_products', 'tbl_products.category_id', '=', 'tbl_categories.id')
        //     ->select('tbl_categories.category_name', 'tbl_categories.category_slug', 'tbl_categories.image')
        //     ->groupBy('tbl_categories.id')
        //     ->where('tbl_categories.publish_status', '1')
        //     ->where('tbl_categories.delete_status', '0')
        //     ->where('tbl_categories.category_id', '0')
        //     ->whereHas('products', function (Builder $query){
        //             $query->where('publish_status','1')->where('delete_status','0')->where('live_status','1');
        //         })
        //     ->limit(8)
        //     ->get();

        $sidebar_parent_categories = Category::where('tbl_categories.publish_status', '1')
            ->where('tbl_categories.delete_status', '0')
            ->where('tbl_categories.category_id', '0')
            ->select('tbl_categories.category_name', 'tbl_categories.category_slug', 'tbl_categories.image', 'tbl_categories.category_icon')
            ->get();

        return response()->json([
            'status' => true,
            'status_message' => 'Category Received',
            'categories_link' => asset('uploads/categories/'),
            'sidebar_categories' => $sidebar_parent_categories,
        ]);
    }
    public function sidebarSubCategory(Request $request){
        // dd($request->all());
        $validation = Validator::make($request->all(), [
            'category_slug' => "required|exists:tbl_categories,category_slug",

        ]);
        $category = Category::where('publish_status', '1')
        ->where('delete_status', '0')
        ->where('category_slug', $request->category_slug)
        ->select('id','category_name', 'category_slug', 'image', 'category_icon')
        ->first();

        $sidebar_sub_categories = Category::where('publish_status', '1')
            ->where('delete_status', '0')
            ->where('category_id', $category->id)
            ->select('id','category_name', 'category_slug', 'image', 'category_icon')
            // ->with(['child' => function ($qr) {
            // return $qr->selectRaw('id','category_name', 'category_slug', 'image', 'category_icon')
            //     ->where('publish_status', '1')
            //     ->where('delete_status', '0');
            // }])
            ->get();
            foreach ($sidebar_sub_categories as $flash_row) {
                $child =   Category::where('publish_status', '1')
                ->where('delete_status', '0')
                ->where('category_id', $flash_row->id)
                ->select('id','category_name', 'category_slug', 'image', 'category_icon')
                ->get();

                $flash_row->setAttribute('child', $child);
            }


        return response()->json([
            'status' => true,
            'status_message' => 'Category Received',
            'categories_link' => asset('uploads/categories/'),
            'sidebar_sub_categories' => $sidebar_sub_categories,
        ]);
    }

    public function displayCoupon()
    {
        $coupon = Coupon::select('discount_price','coupon_code','coupon_name','coupon_description')
                    ->where('publish_status','1')->where('delete_status','0')
                    ->orderBy('id','DESC')
                    ->first();

        if(!$coupon)
        {
            return response()->json([
                'status_code' => 200,
                'status' => false,
                'status_message' => 'No coupon data',
            ], 200);
        }

        return response()->json([
            'status_code' => 200,
            'status' => true,
            'data' => $coupon,
            'status_message' => 'Coupon List',
        ], 200);
    }
}
