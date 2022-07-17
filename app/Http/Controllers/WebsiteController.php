<?php

namespace App\Http\Controllers;

use App\Models\DeliverySetting;
use App\Models\Advertisement;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Content;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminSubscribeMail;
use App\Mail\AdminContactMail;
use App\Mail\UserContactMail;
use App\Mail\UserSubscribeMail;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\ArrayOfCategoryTrait;
use App\Http\Traits\MetaTrait;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Validator;

class WebsiteController extends Controller
{
    use ArrayOfCategoryTrait;
    use MetaTrait;
    public function commingsoon()
    {
        return view('coming-soon.index');
    }

    public function index()
    {
        $sliders = Slider::where('publish_status', '1')->where('delete_status', '0')->get();
        // dd($sliders);
        $setting = Setting::first();



        $newProducts = Product::where('showOnHome','1')->allStatus()->latest()->limit(40)->get();
            //   dd($newProducts);

        $onSaleProducts = Product::where('showOnHome','1')->allStatus()->latest()->where('on_sale', '1')->limit(9)->get();

        $bestRatedProducts = Product::where('showOnHome','1')->allStatus()->latest()->where('best_rated', '1')->limit(8)->get();

        $featuredCategories = Category::status()->where('category_id', '0')->where('show_on_home', '1')->orderBy('id', 'desc')->limit(5)->get();


        $midLeftAd = Advertisement::where('publish_status', '1')->where('delete_status', '0')->where('placement', 'mid-left')->first();
        $midRightAd = Advertisement::where('publish_status', '1')->where('delete_status', '0')->where('placement', 'mid-right')->first();
        $dealAds = Advertisement::where('publish_status', '1')->where('delete_status', '0')->where('placement', 'deal-ad')->take(3)->get();
        $meta = $this->getMeta();

        return view('front.index', compact('setting', 'midLeftAd', 'midRightAd', 'dealAds', 'sliders',  'newProducts', 'onSaleProducts', 'bestRatedProducts', 'featuredCategories','meta'));
    }

    public function content($content_url)
    {
        $content = Content::where('content_url', $content_url)->where('delete_status','0')->first();
        if ($content == null) {
            return redirect('/404');
        }

        if ($content != null) {
            $meta_title = $content->meta_title;
            $meta_description = $content->meta_description;
            $meta_keyword = $content->meta_keyword;
        } else {
            $meta_title = '';
            $meta_description = '';
            $meta_keyword = '';
        }

        $about = Content::where('publish_status', '1')->where('delete_status', '0')->where('content_type', 'about')->first();
        $services = Content::where('publish_status', '1')->where('delete_status', '0')->where('content_type', 'service')->get();
        $serviceSelected = Content::where('publish_status', '1')->where('delete_status', '0')->where('content_type', 'service-selected')->get();

        $template = 'front.' . $content->content_type;

        return view($template, compact('content', 'about', 'services', 'serviceSelected', 'meta_title', 'meta_description', 'meta_keyword'));
    }

    public function showCategory(Request $request, $category_slug)
    {


        $category = Category::status()->where('category_slug', $category_slug)->firstOrFail();
        $category->increment('view_count');
        // $categoryProducts = Product::allStatus()
        //     ->where('category_id', $category->id)
        //     ->latest()
        //     ->paginate(15);
        $categoryProducts = app(Pipeline::class)
            ->send(
                Product::query()
                    ->select('tbl_products.*')
                    ->where('category_id', $category->id)
                    ->allStatus()
            )
            ->through([
                \App\QueryFilters\Price::class,
                \App\QueryFilters\Wishlist::class,
            ])
            ->thenReturn()
            ->paginate(16);
        $metaData = [
                        'meta_title' => $category->meta_title ?? $category->category_name,
                        'meta_description' => $category->meta_description ?? $category->category_name,
                        'image' => "uploads/categories/".$category->image,
                        'keywords' => $category->meta_keyword ?? $category->category_name,
                    ];
        $meta = $this->getMeta($metaData);

        return view('front.category', compact('category', 'categoryProducts',));
    }

    public function showSeller($seller_code)
    {
        $seller = Seller::where('publish_status', '1')->where('delete_status', '0')->where('holiday_mode', '0')->where('seller_code', $seller_code)->firstOrFail();

        $sellerProducts = Product::allStatus()->where('owner_id', $seller->id)->latest()->paginate(20);

        $categories = Category::where('publish_status', '1')->where('delete_status', '0')->where('category_id', '0')->get();

        $latestProducts = Product::allStatus()->where('owner_id', $seller->id)->orderBy('id', 'desc')->limit(4)->get();

        $recentProducts = Product::allStatus()->where('owner_id', $seller->id)->orderBy('view_count', 'desc')->get();

        $setting = Setting::first();
        if ($setting != null) {
            $meta_title = $setting->meta_title;
            $meta_description = $setting->meta_description;
            $meta_keyword = $setting->meta_keyword;
            $meta_img = $setting->site_logo;
        } else {
            $meta_title = '';
            $meta_description = '';
            $meta_keyword = '';
            $meta_img = '';
        }

        return view('front.seller', compact('meta_title', 'meta_description', 'meta_keyword', 'meta_img', 'seller', 'sellerProducts', 'categories', 'latestProducts', 'recentProducts'));
    }

    public function showProduct($product_slug)
    {
        $product = Product::with('photos')->allStatus()->where('product_slug', $product_slug)->first();
        if ($product == null) {
            return redirect('/404');
        }
        // $related = Product::allStatus()->where('category_id', '=', $product->category->id)->where('id', '!=', $product->id)->get();

        $product->view_count++;
        $product->save();

        // $reviewSelected = null;
        // if (Auth::guard('web')->check()) {
        //     $reviewSelected = Review::where('customer_id', Auth::guard('web')->user()->id)->where('product_id', $product->id)->first();
        // }
            $metaData = [
                'meta_title' => $product->meta_title ?? $product->product_name,
                'meta_description' => $product->meta_description ?? $product->product_description,
                'image' => "uploads/products/".$product->image,
                'keywords' => $product->meta_keyword ?? $product->product_name,
            ];
        $meta = $this->getMeta($metaData);

        return view('front.details', compact('product' ,"meta"));
    }

    public function subscribe()
    {
        $exisiting_subs = Subscriber::where('subscriber_email', request('subscriber_email'))->count();
        if ($exisiting_subs == 0) {
            $this->validate(request(), [
                'subscriber_email' => 'required|email|unique:tbl_subscribers,subscriber_email',
            ]);

            $data = array(
                'subscriber_email' => request('subscriber_email')
            );

            $receiverAddress = env('MAIL_TO_ADDRESS');
            $customerAddress = request('subscriber_email');

            /////////////////Send mail////////////////////////

            Mail::to($receiverAddress)->send(new AdminSubscribeMail($data));

            Mail::to($customerAddress)->send(new UserSubscribeMail());

            $subscriber = new Subscriber();

            $subscriber->subscriber_email = request('subscriber_email');

            $subscriber->save();

            return back()->with('subscribe-success', 'Thank you for subscribing!');
        } else {
            return back()->with('error-message', 'You have already subscribed!');
        }
    }

    public function contact(Request $request)
    {
        $this->validate(request(), [
            'contact_name' => 'required',
            'contact_subject' => 'required',
            'contact_email' => 'required|email',
            'contact_number' => 'required',
            'contact_message' => 'required',
        ]);

        $secret = env('RECAPTCHA_SECRET_KEY');
        $captcha = $request->input('g-recaptcha-response');

        $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']), true);
        // dd($response);
        if ($response['success'] == false) {
            return back()->with('error', 'You are spammer !');
        } else {

            $data = array(
                'contact_name' => $request->contact_name,
                'contact_subject' => $request->contact_subject,
                'contact_email' => $request->contact_email,
                'contact_number' => $request->contact_number,
                'contact_message' => $request->contact_message,
            );
            $receiverAddress = env('MAIL_TO_ADDRESS');
            $customerAddress = $request->contact_email;

            /////////////////Send mail////////////////////////

            Mail::to($receiverAddress)->send(new AdminContactMail($data));
            Mail::to($customerAddress)->send(new UserContactMail($data));

            $contact = new Contact();

            $contact->contact_name = request('contact_name');
            $contact->contact_subject = request('contact_subject');
            $contact->contact_email = request('contact_email');
            $contact->contact_number = request('contact_number');
            $contact->contact_message = request('contact_message');

            $contact->save();

            return back()->with('success', 'Your message has been sent. Thank you.');
        }
    }

    public function search(Request $request)
    {
        // dd($request);
        $keyword = $request->search;
        // $searchId = $request->product_cat;
        // dd($searchId);
        // if ($request->product_cat != "0") {
        //     $category = Category::where('id', $searchId)->first();
        //     $category_name = $category->category_name;
        //     $category_id = $this->getArrayOfCategory($category->category_slug);
        // } else {
        $category_id = null;
        $category_name = "All Categories";
        // }

        $results = Product::allStatus()
            ->where('product_name', 'LIKE', "%$keyword%")
            ->when($category_id, function ($query, $category_id) {
                return $query->whereIn('tbl_products.category_id', $category_id);
            })
            ->paginate(15);

        foreach ($results as $result) {
            if (count($result->reviews) > 0)
                $result->setAttribute('avgRating', round($result->reviews->sum('rating') / count($result->reviews), 2));
        }

        return view('front.search', compact('keyword', 'category_name', 'results'));
    }

    public function showTrackOrder()
    {
        $setting = Setting::first();
        if ($setting != null) {
            $meta_title = $setting->meta_title;
            $meta_description = $setting->meta_description;
            $meta_keyword = $setting->meta_keyword;
        } else {
            $meta_title = '';
            $meta_description = '';
            $meta_keyword = '';
        }
        return view('front.track-order', compact('meta_title', 'meta_description', 'meta_keyword'));
    }

    public function trackOrder(Request $request)
    {
        $this->validate($request, ([
            'order_id' => 'required|exists:tbl_orders,ref_id',
            'order_email' => 'required|exists:tbl_payments,email'
        ]));

        $check_id = Payment::where('email', $request->order_email)->where('ref_id', $request->order_id)->first();
        $order = Order::where('ref_id', $request->order_id)->first();

        if (!$check_id || !$order) {
            return back()->with('error', 'Invalid Order ID');
        }

        if ($order->pending == 1) {
            return back()->with('success', 'Your order is in process.');
        }

        if ($order->ready_to_ship == 1) {
            return back()->with('success', 'Your order is ready to ship.');
        }

        if ($order->shipped == 1) {
            return back()->with('success', 'Your order has been shipped.');
        }

        if ($order->delivered == 1) {
            return back()->with('success', 'Your order has been delivered.');
        }

        if ($order->cancelled == 1) {
            return back()->with('success', 'Your order was cancelled.');
        }

        if ($order->failed_delivery == 1) {
            return back()->with('success', 'Your order is in process.');
        }

        return back()->with('error', 'Sorry, Please try again later. . . ');
    }

    public function submitReview(Request $request)
    {
        if (Auth::guard('web')->check()) {

            $customer_id = Auth::guard('web')->user()->id;
            $product_id = $request->product_id;

            $all_reviews = Review::all();

            foreach ($all_reviews as $review) {
                if ($review->customer_id == $customer_id && $review->product_id == $product_id) {
                    //Update review
                    $data = ([
                        'rating' => $request->rating,
                        'review' => $request->review
                    ]);
                    Review::where('customer_id', $customer_id)->where('product_id', $product_id)->update($data);
                    return back()->with('success', 'Review updated successfully.');
                }
            }

            $this->validate($request, [
                'rating' => 'required',
                'review' => 'required'
            ]);

            $review = new Review();

            $review->customer_id = Auth::guard('web')->user()->id;
            $review->product_id = $request->product_id;
            $review->rating = $request->rating;
            $review->review = $request->review;
            $review->save();

            return back()->with('success', 'Thank you for your review.');
        }
        return redirect('/signin')->with('status', 'Please login to continue.');;
    }

    public function getLocationFromIp()
    {
        $ip = '103.124.98.25';
        // $ip = \Request::ip();
        $data = \Location::get($ip);
        dd($data->cityName);
        // return $data;
    }

    public function deliverycost(Request $request)
    {
        $address = $request->address;
        $productCal = $request->product;
        $deliveryCost = 0;

        $product = Product::where('product_slug', $productCal)->first();

        $charge = DeliverySetting::where('weight_min', '<', $product->product_package_weight)
            ->where('weight_max', '>=', $product->product_package_weight)
            ->where('destination', $address)
            ->first();
        if (isset($charge)) {
            $deliveryCost = $charge->rate;
        } else {
            $deliveryCost = 75;
        }
        return response()->json([
            'charge' => $deliveryCost
        ]);
    }

    public function showPrivacy()
    {
        $setting = Setting::first();
        if ($setting != null) {
            $meta_title = $setting->meta_title;
            $meta_description = $setting->meta_description;
            $meta_keyword = $setting->meta_keyword;
        } else {
            $meta_title = '';
            $meta_description = '';
            $meta_keyword = '';
        }
        return view('front.privacy-policy', compact('meta_title', 'meta_description', 'meta_keyword'));
    }

    public function showTerms()
    {
        $setting = Setting::first();
        if ($setting != null) {
            $meta_title = $setting->meta_title;
            $meta_description = $setting->meta_description;
            $meta_keyword = $setting->meta_keyword;
        } else {
            $meta_title = '';
            $meta_description = '';
            $meta_keyword = '';
        }
        return view('front.terms-and-conditions', compact('meta_title', 'meta_description', 'meta_keyword'));
    }

    public function show404()
    {
        $setting = Setting::first();
        if ($setting != null) {
            $meta_title = $setting->meta_title;
            $meta_description = $setting->meta_description;
            $meta_keyword = $setting->meta_keyword;
        } else {
            $meta_title = '';
            $meta_description = '';
            $meta_keyword = '';
        }
        return view('front.404', compact('meta_title', 'meta_description', 'meta_keyword'));
    }

    public function termsandcondition()
    {
        return view('front.policies.termsandconditions');
    }
    public function privacy()
    {
        return view('front.policies.policy');
    }
    public function termsofuse()
    {
        return view('front.policies.termsofuse');
    }
}
