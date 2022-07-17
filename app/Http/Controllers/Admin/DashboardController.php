<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Affiliate;
use App\Models\Tag;
use App\Models\News;
use App\Models\Seller;
use App\Models\Slider;
use App\Models\Writer;
use App\Models\Product;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Customer;
use App\Models\Delivery;
use App\Models\NewsCategory;
use App\Models\Payment;
use App\Models\Photo;
use App\Models\Stock;
use App\Models\Subscriber;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        // $total_sellers = Seller::where(['publish_status' => '1', 'delete_status' => '0'])->count();
        // $total_holiday_sellers = Seller::where(['publish_status' => '1', 'delete_status' => '0', 'holiday_mode' => '1'])->count();

        $total_deliveries = Delivery::where('delete_status', '0')->count();
        $total_active_deliveries = Delivery::where(['publish_status' => '1', 'delete_status' => '0'])->count();

        $total_affiliates = Affiliate::where('delete_status', '0')->count();
        $total_active_affiliates = Affiliate::where(['publish_status' => '1', 'delete_status' => '0'])->count();

        $total_customers = Customer::where('delete_status', '0')->count();
        $total_verified_customers = Customer::where('delete_status', '0')->where('email_verified_at', '!=', null)->count();

        $total_categories = Category::where(['publish_status' => '1', 'delete_status' => '0'])->count();
        $total_parent_categories = Category::where(['publish_status' => '1', 'delete_status' => '0', 'category_id' => '0'])->count();

        $total_products = Product::where(['publish_status' => '1', 'delete_status' => '0'])->count();
        $total_in_house_products = Product::where(['publish_status' => '1', 'delete_status' => '0', 'owner_id' => '0'])->count();

        $total_remaining_stocks = Stock::whereIn('product_id', Product::where('owner_id', '0')->get('id'))->sum('remaining_stock'); // in house stocks
        $total_delivered_stocks = Stock::whereIn('product_id', Product::where('owner_id', '0')->get('id'))->sum('delivered_stock');

        $total_photos = Photo::whereIn('imageable_id', Product::where('owner_id', '0')->get('id'))->where('delete_status', '0')->count();

        $admin_pending_orders = Payment::join('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
            ->join('tbl_products', 'tbl_products.id', '=', 'tbl_orders.product_id')
            ->groupBy('tbl_payments.ref_id')
            ->select('ref_id', DB::raw('count(*) as total'))
            ->where('tbl_products.owner_id', '0')
            ->where('tbl_payments.complete_status', '1')
            ->where('pending', '1')
            ->where([
                'ready_to_ship' => '0',
                'shipped' => '0',
                'delivered' => '0',
                'cancelled' => '0',
                'failed_delivery' => '0'
            ])->count();

        $admin_shipped_orders = Payment::join('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
            ->join('tbl_products', 'tbl_products.id', '=', 'tbl_orders.product_id')
            ->groupBy('tbl_payments.ref_id')
            ->select('ref_id', DB::raw('count(*) as total'))
            ->where('tbl_products.owner_id', '0')
            ->where('tbl_payments.complete_status', '1')
            ->where([
                'pending' => '0',
                'ready_to_ship' => '1',
                'shipped' => '1',
                'delivered' => '0',
                'cancelled' => '0',
                'failed_delivery' => '0'
            ])->count();

        $admin_delivered_orders = Payment::leftJoin('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
            ->join('tbl_products', 'tbl_products.id', '=', 'tbl_orders.product_id')
            ->groupBy('tbl_payments.ref_id')
            ->select('ref_id', DB::raw('count(*) as total'))
            ->where('tbl_products.owner_id', "0")
            ->where([
                'pending' => '0',
                'ready_to_ship' => '1',
                'shipped' => '1',
                'delivered' => '1',
                'cancelled' => '0',
                'failed_delivery' => '0'
            ])->count();

        $admin_paid_orders = Payment::leftJoin('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
            ->join('tbl_products', 'tbl_products.id', '=', 'tbl_orders.product_id')
            ->groupBy('tbl_payments.ref_id')
            ->select('ref_id', DB::raw('count(*) as total'))
            ->where('tbl_products.owner_id', "0")
            ->where([
                'pending' => '0',
                'ready_to_ship' => '1',
                'shipped' => '1',
                'delivered' => '1',
                'cancelled' => '0',
                'failed_delivery' => '0',
                'paid_status' => '1'
            ])->count();

        $admin_cancelled_orders = Payment::leftJoin('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
            ->join('tbl_products', 'tbl_products.id', '=', 'tbl_orders.product_id')
            ->leftJoin('tbl_order_cancels', 'tbl_order_cancels.ref_id', '=', 'tbl_payments.ref_id')
            ->groupBy('tbl_payments.ref_id')
            ->select('ref_id', DB::raw('count(*) as total'))
            ->where('tbl_products.owner_id', "0")
            ->where('pending', '1')
            ->where([
                'ready_to_ship' => '0',
                'shipped' => '0',
                'delivered' => '0',
                'cancelled' => '1',
                'failed_delivery' => '0'
            ])->count();

        // $total_seller_orders  = Payment::join('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
        //     ->groupBy('tbl_payments.ref_id')
        //     ->select('ref_id', DB::raw('count(*) as total'))
        //     ->where('tbl_payments.complete_status', '1')
        //     ->where([
        //         'tbl_orders.shipped' => '0',
        //         'tbl_orders.delivered' => '0',
        //         'tbl_orders.cancelled' => '0',
        //         'tbl_orders.failed_delivery' => '0'
        //     ])->count();


        $total_sliders = Slider::where(['publish_status' => '1', 'delete_status' => '0',])->count();

        $total_newscategory = NewsCategory::where(['publish_status' => '1', 'delete_status'  => '0',])->count();

        $total_news = News::where(['publish_status' => '1', 'delete_status' => '0',])->count();

        $total_writer = Writer::where(['publish_status' => '1', 'delete_status' => '0',])->count();

        $total_tags = Tag::where(['publish_status' => '1', 'delete_status' => '0',])->count();

        $total_admins = Admin::where('delete_status', '0')->count();
        $total_active_admins = Admin::where('publish_status', '1')->where('delete_status', '0')->count();

        $total_contacts = Contact::count();
        $total_subscribers = Subscriber::count();


        return view('admin.pages.dashboard', compact(
            // 'total_sellers',
            // 'total_holiday_sellers',
            'total_deliveries',
            'total_active_deliveries',
            'total_affiliates',
            'total_active_affiliates',
            'total_customers',
            'total_verified_customers',
            'total_categories',
            'total_parent_categories',
            'total_products',
            'total_in_house_products',
            'total_remaining_stocks',
            'total_delivered_stocks',
            'total_photos',
            'total_admins',
            'total_active_admins',
            'admin_pending_orders',
            'admin_shipped_orders',
            'admin_delivered_orders',
            'admin_paid_orders',
            // 'total_seller_orders',
            'admin_cancelled_orders',
            'total_newscategory',
            'total_news',
            'total_writer',
            'total_tags',
            'total_contacts',
            'total_subscribers'
        ));
    }
}
