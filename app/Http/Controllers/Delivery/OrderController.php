<?php

namespace App\Http\Controllers\Delivery;

use Carbon\Carbon;
use App\Models\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerDeliveryMail;
use App\Mail\SellerDeliveryMail;
use App\Models\Delivery;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Seller;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\Seller_OrderTrait;
use App\Models\Stock;
use App\Models\StockCalculate;
use App\Models\TransactionOverview;
use App\Http\Traits\SaleTransactionOverviewTrait;
use App\Http\Traits\AffiliateTransactionOverviewTrait;

class OrderController extends Controller
{
    //THIS IS SAME AS SELLER , MODIFY IT AS PER THE DELIVERY REQUIREMENT
    use Seller_OrderTrait,SaleTransactionOverviewTrait,AffiliateTransactionOverviewTrait;

    public function __construct()
    {
        $this->middleware('auth:delivery');
    }

    public function viewOrder($ref_id)
    {
        $customer_info = Payment::where('ref_id', $ref_id)->first();

        $seller_info = Order::join('tbl_products', 'tbl_orders.product_id', 'tbl_products.id')
            ->join('tbl_sellers', 'tbl_sellers.id', 'tbl_products.owner_id')
            ->where('tbl_orders.ref_id', $ref_id)
            ->select('tbl_products.owner_id', 'tbl_sellers.company_name', 'tbl_sellers.company_address', 'tbl_sellers.company_phone', 'tbl_sellers.email')
            ->groupBy('tbl_products.owner_id')
            ->get();

        // dd($seller_info);

        return view('delivery.pages.details', compact('customer_info', 'seller_info'));
    }

    public function pendingList()
    {
        if (isset(Auth::guard('delivery')->user()->parent_id)) //Staff
        {
            $pendings = Payment::leftJoin('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                ->join('tbl_deliveries_assign', 'tbl_payments.ref_id', 'tbl_deliveries_assign.ref_id')
                ->leftJoin('order_delivery_staff', 'tbl_payments.ref_id', 'order_delivery_staff.ref_id')
                ->select([
                    'tbl_deliveries_assign.created_at as delivery_assigned_date',
                    'order_delivery_staff.staff_id',
                    'tbl_payments.id as id', 'tbl_payments.*',
                    DB::raw('count(tbl_orders.product_id) as total_product'),
                    DB::raw('SUM(tbl_orders.quantity) as total_quantity')
                ])
                ->groupBy('tbl_payments.ref_id')
                ->where('delivery_assign_status', '1')
                ->where('order_delivery_staff.staff_id', Auth::guard('delivery')->user()->id)
                ->where([
                    'pending' => '0',
                    'ready_to_ship' => '1',
                    'shipped' => '0',
                    'delivered' => '0',
                    'cancelled' => '0',
                    // 'failed_delivery' => '0'
                ])->get();

            $staffs = Delivery::where('parent_id', Auth::guard('delivery')->user()->id)->get();
        } else {
            $pendings = Payment::leftJoin('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                ->join('tbl_deliveries_assign', 'tbl_payments.ref_id', 'tbl_deliveries_assign.ref_id')
                ->leftJoin('order_delivery_staff', 'tbl_payments.ref_id', 'order_delivery_staff.ref_id')
                ->select([
                    'tbl_deliveries_assign.created_at as delivery_assigned_date',
                    'order_delivery_staff.staff_id',
                    'tbl_payments.id as id', 'tbl_payments.*',
                    DB::raw('count(tbl_orders.product_id) as total_product'),
                    DB::raw('SUM(tbl_orders.quantity) as total_quantity')
                ])
                ->groupBy('tbl_payments.ref_id')
                ->where('delivery_assign_status', '1')
                ->where('tbl_deliveries_assign.delivery_id', Auth::guard('delivery')->user()->id)
                ->where([
                    'pending' => '0',
                    'ready_to_ship' => '1',
                    'shipped' => '0',
                    'delivered' => '0',
                    'cancelled' => '0',
                    // 'failed_delivery' => '0'
                ])->get();

            // dd($pendings);

            $staffs = Delivery::where('parent_id', Auth::guard('delivery')->user()->id)->get();
        }

        return view('delivery.list.pending', compact('pendings', 'staffs'));
    }

    public function Shipped($ref_id)
    {
        $data = [
            'shipped' => '1',
            'failed_delivery' => '0'
        ];

        Order::where('ref_id', $ref_id)->update($data);
        return back()->with('success', 'Order Shipped !!!');
    }

    public function listShipped()
    {

        if (isset(Auth::guard('delivery')->user()->parent_id)) //Staff
        {
            $pendings = Payment::leftJoin('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                ->join('tbl_deliveries_assign', 'tbl_payments.ref_id', 'tbl_deliveries_assign.ref_id')
                ->leftJoin('order_delivery_staff', 'tbl_payments.ref_id', 'order_delivery_staff.ref_id')
                ->select([
                    'tbl_deliveries_assign.created_at as delivery_assigned_date',
                    'order_delivery_staff.staff_id',
                    'tbl_payments.id as id', 'tbl_payments.*',
                    DB::raw('count(tbl_orders.product_id) as total_product'),
                    DB::raw('SUM(tbl_orders.quantity) as total_quantity')
                ])
                ->groupBy('tbl_payments.ref_id')
                ->where('delivery_assign_status', '1')
                ->where('order_delivery_staff.staff_id', Auth::guard('delivery')->user()->id)
                ->where([
                    'pending' => '0',
                    'ready_to_ship' => '1',
                    'shipped' => '1',
                    'delivered' => '0',
                    'cancelled' => '0',
                    'failed_delivery' => '0'
                ])->get();

            $staffs = Delivery::where('parent_id', Auth::guard('delivery')->user()->id)->get();
        } else {
            $pendings = Payment::leftJoin('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                ->join('tbl_deliveries_assign', 'tbl_payments.ref_id', 'tbl_deliveries_assign.ref_id')
                ->leftJoin('order_delivery_staff', 'tbl_payments.ref_id', 'order_delivery_staff.ref_id')
                ->select([
                    'tbl_deliveries_assign.created_at as delivery_assigned_date',
                    'order_delivery_staff.staff_id',
                    'tbl_payments.id as id', 'tbl_payments.*',
                    DB::raw('count(tbl_orders.product_id) as total_product'),
                    DB::raw('SUM(tbl_orders.quantity) as total_quantity')
                ])
                ->groupBy('tbl_payments.ref_id')
                ->where('delivery_assign_status', '1')
                ->where('tbl_deliveries_assign.delivery_id', Auth::guard('delivery')->user()->id)
                ->where([
                    'pending' => '0',
                    'ready_to_ship' => '1',
                    'shipped' => '1',
                    'delivered' => '0',
                    'cancelled' => '0',
                    'failed_delivery' => '0'
                ])->get();

            // dd($pendings);

            $staffs = Delivery::where('parent_id', Auth::guard('delivery')->user()->id)->get();
        }

        return view('delivery.list.shipped', compact('pendings', 'staffs'));
    }

    public function updateDelivered($ref_id)
    {
        //yo join bata garam hai bholi
        $product_ids = Order::where('ref_id', $ref_id)->get();
        // dd($product_ids);
        // $seller_ids = Product::whereIn('id', $product_ids)->groupBy('owner_id')->get('owner_id');
        // $sellers = Seller::whereIn('id', $seller_ids)->get();
        // dd($sellers);
        Payment::where('ref_id', $ref_id)->update([
            "paid_status" => "1"
        ]);
        foreach ($product_ids as $key => $row) {
            $product = Order::join('tbl_products', 'tbl_products.id', 'tbl_orders.product_id')
                ->join('tbl_sellers', 'tbl_sellers.id', 'tbl_products.owner_id')
                ->join('tbl_payments','tbl_payments.ref_id','tbl_orders.ref_id')
                ->where('tbl_orders.ref_id', $ref_id)
                ->where('tbl_orders.product_id', $row->product_id)
                ->select('tbl_payments.state as destination','tbl_products.id as p_id', 'tbl_products.product_code as p_code', 'tbl_products.product_original_price as p_price','tbl_products.product_package_weight as p_weight', 'tbl_orders.quantity as o_quanity','tbl_orders.aff_id as aff_id', 'tbl_sellers.id as s_id', 'tbl_sellers.commission as s_commission')
                ->first();

            // dd($product);

            $arr_enum = ['payment_fee', 'shipping_fee', 'commission_fee'];

            $finalTransactionOverview = $this->calculateSaleTransactionOverviewRecord($ref_id, $arr_enum, $product);
            // dd($finalTransactionOverview);
            if($finalTransactionOverview->count()>0){
                $affiliateTransactionOverview = $this->calculateAffiliateTransactionOverviewRecord($ref_id, $product,$finalTransactionOverview);
            }
        }
        if($affiliateTransactionOverview){
            // dd('wait');
            $data = [
                'delivered' => '1',
            ];

            Order::where('ref_id', $ref_id)->update($data);

            $payment = Payment::where('ref_id', $ref_id)->first();

            /////
            $orders = Order::where('ref_id', $ref_id)->get();
            foreach ($orders as $order) {
                $curStock = Stock::where('product_id', $order->product_id)->first();
                $stockcal = new StockCalculate($curStock);
                // dd($order->product_id,$order->quantity);
                $stockcal->deliverStock($order->quantity);
                $curStock->delivered_stock = $stockcal->delivered_stock;
                $curStock->sellable_stock = $stockcal->sellable_stock;
                $curStock->withholding_stock = $stockcal->withholding_stock;
                $curStock->save();
            }
            ///
            $notification = new Notification();

            $notification->ref_id = $ref_id;
            $notification->extra_data = $ref_id;
            $notification->customer_email = $payment->email;
            $notification->type = "delivered";
            $notification->title = "Your purchase for order id $ref_id is successfully delivered.";

            $notification->save();

            $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
                ->where('tbl_payments.ref_id', $payment->ref_id)
                ->select('tbl_products.product_name', 'tbl_products.product_original_price', 'tbl_orders.quantity')
                ->get();

            $items_arr = Order::where('ref_id', $ref_id)->select('product_id', 'quantity')->get();

            Mail::to($payment->email)->send(new CustomerDeliveryMail($payment, $orders));
            foreach ($items_arr as $row) {
                $product = Product::where('id', $row->product_id)->first();
                $seller = $product->seller;
                $seller_email = $seller->email;
                if (isset($seller_email)) {
                    $orders = Order::join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                        ->join('tbl_products', 'tbl_orders.product_id', '=', 'tbl_products.id')
                        ->where('tbl_payments.ref_id', $payment->ref_id)
                        ->select('tbl_products.product_name', 'tbl_products.product_original_price', 'tbl_orders.quantity')
                        ->where('tbl_products.owner_id', $seller->id)
                        ->get();
                    Mail::to($seller_email)->send(new SellerDeliveryMail($payment, $orders));
                }
            }

            return back()->with('success', 'Order Delivered !!!');
        }
        else{
            return back()->with('fail', 'Order Delivered Failed!!!');
        }

    }

    public function listDelivered()
    {

        if (isset(Auth::guard('delivery')->user()->parent_id)) //Staff
        {
            $pendings = Payment::leftJoin('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                ->join('tbl_deliveries_assign', 'tbl_payments.ref_id', 'tbl_deliveries_assign.ref_id')
                ->leftJoin('order_delivery_staff', 'tbl_payments.ref_id', 'order_delivery_staff.ref_id')
                ->select([
                    'tbl_deliveries_assign.created_at as delivery_assigned_date',
                    'order_delivery_staff.staff_id',
                    'tbl_payments.id as id', 'tbl_payments.*',
                    DB::raw('count(tbl_orders.product_id) as total_product'),
                    DB::raw('SUM(tbl_orders.quantity) as total_quantity')
                ])
                ->groupBy('tbl_payments.ref_id')
                ->where('delivery_assign_status', '1')
                ->where('order_delivery_staff.staff_id', Auth::guard('delivery')->user()->id)
                ->where([
                    'pending' => '0',
                    'ready_to_ship' => '1',
                    'shipped' => '1',
                    'delivered' => '1',
                    'cancelled' => '0',
                    'failed_delivery' => '0'
                ])->get();

            $staffs = Delivery::where('parent_id', Auth::guard('delivery')->user()->id)->get();
        } else {
            $pendings = Payment::leftJoin('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                ->join('tbl_deliveries_assign', 'tbl_payments.ref_id', 'tbl_deliveries_assign.ref_id')
                ->leftJoin('order_delivery_staff', 'tbl_payments.ref_id', 'order_delivery_staff.ref_id')
                ->select([
                    'tbl_deliveries_assign.created_at as delivery_assigned_date',
                    'order_delivery_staff.staff_id',
                    'tbl_payments.id as id', 'tbl_payments.*',
                    DB::raw('count(tbl_orders.product_id) as total_product'),
                    DB::raw('SUM(tbl_orders.quantity) as total_quantity')
                ])
                ->groupBy('tbl_payments.ref_id')
                ->where('delivery_assign_status', '1')
                ->where('tbl_deliveries_assign.delivery_id', Auth::guard('delivery')->user()->id)
                ->where([
                    'pending' => '0',
                    'ready_to_ship' => '1',
                    'shipped' => '1',
                    'delivered' => '1',
                    'cancelled' => '0',
                    'failed_delivery' => '0'
                ])->get();

            // dd($pendings);

            $staffs = Delivery::where('parent_id', Auth::guard('delivery')->user()->id)->get();
        }

        return view('delivery.list.delivered', compact('pendings', 'staffs'));
    }

    public function updateFailDelivery($ref_id)
    {
        $data = [
            'failed_delivery' => '1',
            'shipped' => '0',
        ];

        Order::where('ref_id', $ref_id)->update($data);
        return back()->with('success', 'Order Delivered !!!');
    }

    public function listFailDelivery()
    {

        if (isset(Auth::guard('delivery')->user()->parent_id)) //Staff
        {
            $pendings = Payment::leftJoin('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                ->join('tbl_deliveries_assign', 'tbl_payments.ref_id', 'tbl_deliveries_assign.ref_id')
                ->leftJoin('order_delivery_staff', 'tbl_payments.ref_id', 'order_delivery_staff.ref_id')
                ->select([
                    'tbl_deliveries_assign.created_at as delivery_assigned_date',
                    'order_delivery_staff.staff_id',
                    'tbl_payments.id as id', 'tbl_payments.*',
                    DB::raw('count(tbl_orders.product_id) as total_product'),
                    DB::raw('SUM(tbl_orders.quantity) as total_quantity')
                ])
                ->groupBy('tbl_payments.ref_id')
                ->where('delivery_assign_status', '1')
                ->where('order_delivery_staff.staff_id', Auth::guard('delivery')->user()->id)
                ->where([
                    'pending' => '0',
                    'ready_to_ship' => '1',
                    'shipped' => '0',
                    'delivered' => '0',
                    'cancelled' => '0',
                    'failed_delivery' => '1'
                ])->get();

            $staffs = Delivery::where('parent_id', Auth::guard('delivery')->user()->id)->get();
        } else {
            $pendings = Payment::leftJoin('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
                ->join('tbl_deliveries_assign', 'tbl_payments.ref_id', 'tbl_deliveries_assign.ref_id')
                ->leftJoin('order_delivery_staff', 'tbl_payments.ref_id', 'order_delivery_staff.ref_id')
                ->select([
                    'tbl_deliveries_assign.created_at as delivery_assigned_date',
                    'order_delivery_staff.staff_id',
                    'tbl_payments.id as id', 'tbl_payments.*',
                    DB::raw('count(tbl_orders.product_id) as total_product'),
                    DB::raw('SUM(tbl_orders.quantity) as total_quantity')
                ])
                ->groupBy('tbl_payments.ref_id')
                ->where('delivery_assign_status', '1')
                ->where('tbl_deliveries_assign.delivery_id', Auth::guard('delivery')->user()->id)
                ->where([
                    'pending' => '0',
                    'ready_to_ship' => '1',
                    'shipped' => '0',
                    'delivered' => '0',
                    'cancelled' => '0',
                    'failed_delivery' => '1'
                ])->get();

            // dd($pendings);

            $staffs = Delivery::where('parent_id', Auth::guard('delivery')->user()->id)->get();
        }

        return view('delivery.list.delivered', compact('pendings', 'staffs'));
    }
}
