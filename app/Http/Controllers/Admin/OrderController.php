<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Seller;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Delivery;
use App\Models\DeliveryAssign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\Seller_OrderTrait;
use App\Events\ConfirmationForShipping;

class OrderController extends Controller
{
    use Seller_OrderTrait;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function adminOrderList(){
        $pendings = Payment::join('tbl_orders','tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
        ->join('tbl_products', 'tbl_products.id', '=', 'tbl_orders.product_id')
        ->select([
            'tbl_payments.*' ,
            DB::raw('count(tbl_orders.product_id) as total_product'),
            DB::raw('SUM(tbl_orders.quantity) as total_quantity')
            ])
            ->groupBy('tbl_payments.ref_id')
            ->where('tbl_products.owner_id', '0')
            ->where('tbl_payments.complete_status','1')
            ->where('pending','1')
            ->where([
                'ready_to_ship' => '0',
                'shipped' => '0',
                'delivered' => '0',
                'cancelled' => '0',
                'failed_delivery' => '0'
                ])
                ->orderBy('id','desc')
                ->paginate(10);
        return view('admin.list.pending_adminorder', compact('pendings'));
    }

    public function ajaxAdminOrderFetch(Request $request){
        $orderDate = $request->orderDate;
        $pendings = Payment::join('tbl_orders','tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
        ->join('tbl_products', 'tbl_products.id', '=', 'tbl_orders.product_id')
        ->select([
            'tbl_payments.id as id', 'tbl_payments.*' ,
            DB::raw('count(tbl_orders.product_id) as total_product'),
            DB::raw('SUM(tbl_orders.quantity) as total_quantity')
            ])
            // ->groupBy('tbl_payments.ref_id')
            ->where('tbl_products.owner_id', '0')
            ->where('tbl_payments.complete_status','1')
            ->where('pending','1')
            ->where([
                'ready_to_ship' => '0',
                'shipped' => '0',
                'delivered' => '0',
                'cancelled' => '0',
                'failed_delivery' => '0'
                ])
                ->when($orderDate, function ($query, $orderDate) {
                    return $query->where("tbl_payments.created_at","LIKE","%$orderDate%");
                })
                ->orderBy('id','desc')
                ->paginate(10);
                return view('admin.list.ajaxlist.pending_admin_order', compact('pendings'));
    }

    public function cancelOrder($ref_id)
    {
        $products = Order::where('ref_id', $ref_id)->get();
        if (!$products->isEmpty()) {

            foreach ($products as $row) {
                $owner_check = Product::where('id', $row->product_id)->select('owner_id')->first();
                if ($owner_check->owner_id == "0") {
                    $data = [
                        'cancelled' => '1',

                    ];

                    Order::where('id', $row->id)->update($data);
                }
            }

            return back()->with('success', 'Order Is Cancelled Successfully !!!');
        } else {
            abort(404);
        }

        return back()->with('success', 'Order Is Cancelled Successfully !!!');
    }


    //  for order -> listReadyShipping
    public function listReadyShipping(){

        $pendings = Payment::join('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
            ->join('tbl_products', 'tbl_products.id', '=', 'tbl_orders.product_id')
            ->select([
                'tbl_payments.id as id', 'tbl_payments.*',
                DB::raw('count(tbl_orders.product_id) as total_product'),
                DB::raw('SUM(tbl_orders.quantity) as total_quantity')
            ])
            // ->groupBy('tbl_payments.ref_id')
            ->where('tbl_products.owner_id', "0")
            ->where([
                'ready_to_ship' => '1',
                'shipped' => '0',
                'delivered' => '0',
                'cancelled' => '0',
            ])
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.list.readyforship', compact('pendings'));

    }

    public function ajaxListReadyShippingFetch(Request $request){
        $orderDate = $request->orderDate;
        $pendings = Payment::join('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
            ->join('tbl_products', 'tbl_products.id', '=', 'tbl_orders.product_id')
            ->select([
                'tbl_payments.id as id', 'tbl_payments.*',
                DB::raw('count(tbl_orders.product_id) as total_product'),
                DB::raw('SUM(tbl_orders.quantity) as total_quantity')
            ])
            // ->groupBy('tbl_payments.ref_id')
            ->where('tbl_products.owner_id', "0")
            ->where([
                'ready_to_ship' => '1',
                'shipped' => '0',
                'delivered' => '0',
                'cancelled' => '0',
            ])

            ->when($orderDate, function ($query, $orderDate) {
                return $query->where("tbl_payments.created_at","LIKE","%$orderDate%");
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.list.ajaxlist.adminreadyforship', compact('pendings'));

    }

    //  for order -> listShipped
    public function listShipped(){

        $pendings = Payment::leftJoin('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
        ->join('tbl_products', 'tbl_products.id', '=', 'tbl_orders.product_id')
        ->select([
            'tbl_payments.id as id', 'tbl_payments.*',
            DB::raw('count(tbl_orders.product_id) as total_product'),
            DB::raw('SUM(tbl_orders.quantity) as total_quantity')
        ])
        // ->groupBy('tbl_payments.ref_id')
        ->where('tbl_products.owner_id', "0")
        ->where([
            'pending' => '0',
            'ready_to_ship' => '1',
            'shipped' => '1',
            'delivered' => '0',
            'cancelled' => '0',
            'failed_delivery' => '0'
        ])
        ->orderBy('id', 'desc')
        ->paginate(10);
        return view('admin.list.shipped', compact('pendings'));

    }
    public function ajaxListShippedFetch(Request $request){
        $orderDate = $request->orderDate;

        $pendings = Payment::leftJoin('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
        ->join('tbl_products', 'tbl_products.id', '=', 'tbl_orders.product_id')
        ->select([
            'tbl_payments.id as id', 'tbl_payments.*',
            DB::raw('count(tbl_orders.product_id) as total_product'),
            DB::raw('SUM(tbl_orders.quantity) as total_quantity')
        ])
        // ->groupBy('tbl_payments.ref_id')
        ->where('tbl_products.owner_id', "0")
        ->where([
            'pending' => '0',
            'ready_to_ship' => '1',
            'shipped' => '1',
            'delivered' => '0',
            'cancelled' => '0',
            'failed_delivery' => '0'
        ])
        ->when($orderDate, function ($query, $orderDate) {
            return $query->where("tbl_payments.created_at","LIKE","%$orderDate%");
        })
        ->orderBy('id', 'desc')
        ->paginate(10);
        return view('admin.list.ajaxlist.adminshipped', compact('pendings'));

    }
     //  for order -> listDelivered
     public function listDelivered(){

        $pendings = Payment::leftJoin('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
        ->join('tbl_products', 'tbl_products.id', '=', 'tbl_orders.product_id')
        ->select([
            'tbl_payments.id as id', 'tbl_payments.*',
            DB::raw('count(tbl_orders.product_id) as total_product'),
            DB::raw('SUM(tbl_orders.quantity) as total_quantity')
        ])
        // ->groupBy('tbl_payments.ref_id')
        ->where('tbl_products.owner_id', "0")
        ->where([
            'pending' => '0',
            'ready_to_ship' => '1',
            'shipped' => '1',
            'delivered' => '1',
            'cancelled' => '0',
            'failed_delivery' => '0'
        ])
        ->orderBy('id', 'desc')
        ->paginate(10);
        return view('admin.list.delivered', compact('pendings'));


    }

    public function ajaxListDeliveredFetch(Request $request){
        $orderDate = $request->orderDate;
        $pendings = Payment::leftJoin('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
        ->join('tbl_products', 'tbl_products.id', '=', 'tbl_orders.product_id')
        ->select([
            'tbl_payments.id as id', 'tbl_payments.*',
            DB::raw('count(tbl_orders.product_id) as total_product'),
            DB::raw('SUM(tbl_orders.quantity) as total_quantity')
        ])
        // ->groupBy('tbl_payments.ref_id')
        ->where('tbl_products.owner_id', "0")
        ->where([
            'pending' => '0',
            'ready_to_ship' => '1',
            'shipped' => '1',
            'delivered' => '1',
            'cancelled' => '0',
            'failed_delivery' => '0'
        ])
        ->when($orderDate, function ($query, $orderDate) {
            return $query->where("tbl_payments.created_at","LIKE","%$orderDate%");
        })
        ->orderBy('id', 'desc')
        ->paginate(10);
        return view('admin.list.ajaxlist.admindelivered', compact('pendings'));


    }

      //  for order -> listCancelledOrder
      public function listCancelledOrder(){
        $pendings = Payment::leftJoin('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
        ->join('tbl_products', 'tbl_products.id', '=', 'tbl_orders.product_id')
        ->leftJoin('tbl_order_cancels', 'tbl_order_cancels.ref_id', '=', 'tbl_payments.ref_id')
            ->select([
                'tbl_payments.id as id', 'tbl_payments.*',
                DB::raw('count(tbl_orders.product_id) as total_product'),
                DB::raw('SUM(tbl_orders.quantity) as total_quantity'),
                'tbl_order_cancels.reason'
            ])
            // ->groupBy('tbl_payments.ref_id')
        ->where('tbl_products.owner_id', "0")
            ->where('pending', '1')
            ->where([
                'ready_to_ship' => '0',
                'shipped' => '0',
                'delivered' => '0',
                'cancelled' => '1',
                'failed_delivery' => '0'
            ])
            ->orderBy('tbl_orders.updated_at','desc')
            ->paginate(10);
        return view('admin.list.cancelled_order', compact('pendings'));

    }


    public function ajaxListCancelledOrderFetch(Request $request){
        $orderDate = $request->orderDate;
        $pendings = Payment::leftJoin('tbl_orders', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
        ->join('tbl_products', 'tbl_products.id', '=', 'tbl_orders.product_id')
        ->leftJoin('tbl_order_cancels', 'tbl_order_cancels.ref_id', '=', 'tbl_payments.ref_id')
            ->select([
                'tbl_payments.id as id', 'tbl_payments.*',
                DB::raw('count(tbl_orders.product_id) as total_product'),
                DB::raw('SUM(tbl_orders.quantity) as total_quantity'),
                'tbl_order_cancels.reason'
            ])
            // ->groupBy('tbl_payments.ref_id')
            ->where('tbl_products.owner_id', "0")
            ->where('pending', '1')
            ->where([
                'ready_to_ship' => '0',
                'shipped' => '0',
                'delivered' => '0',
                'cancelled' => '1',
                'failed_delivery' => '0'
            ])
            ->when($orderDate, function ($query, $orderDate) {
                return $query->where("tbl_payments.created_at","LIKE","%$orderDate%");
            })
            ->orderBy('tbl_orders.updated_at','desc')
            ->paginate(10);
        return view('admin.list.ajaxlist.admincancelled_order', compact('pendings'));

    }


    public function updateReadyShipping($ref_id){
        $products = Order::where('ref_id', $ref_id)->get();
        if(!$products->isEmpty()){
        $owner_id = '0';
            foreach($products as $row){
                $owner_check = Product::where('id', $row->product_id)->select('owner_id')->first();
                if($owner_check->owner_id == $owner_id){
                    $data = [
                        'ready_to_ship' => '1',
                        'pending' => '0'
                    ];
            Order::where('id', $row->id)->update($data);
                }
            }
        return redirect()->route('admin.order.shipped.list')->with('success', 'Ready For Shipping Is Set !!!');
        }
        else{
            abort(404);
        }
    }
    public function updateShipped($ref_id){
        $products = Order::where('ref_id', $ref_id)->get();
        if(!$products->isEmpty()){
        $owner_id = '0';
            foreach($products as $row){
                $owner_check = Product::where('id', $row->product_id)->select('owner_id')->first();
                if($owner_check->owner_id == $owner_id){
                    $data = [
                        'shipped' => '1',
                        'ready_to_ship' => '1',
                        'pending' => '0'
                    ];
            Order::where('id', $row->id)->update($data);
                }
            }
        return redirect()->route('admin.order.delivered.list')->with('success', 'Order Shipped Successfully !!!');
        }
        else{
            abort(404);
        }
    }
    public function updateDelivered($ref_id){
        $products = Order::where('ref_id', $ref_id)->get();
        if(!$products->isEmpty()){
        $owner_id = '0';
            foreach($products as $row){
                $owner_check = Product::where('id', $row->product_id)->select('owner_id')->first();
                if($owner_check->owner_id == $owner_id){
                    $data = [
                        'delivered' => '1',
                        'shipped' => '1',
                        'ready_to_ship' => '1',
                        'pending' => '0'
                    ];
            Order::where('id', $row->id)->update($data);
                }
            }
        return redirect()->route('admin.order.delivered.list')->with('success', 'Order  Successfully !!!');
        }
        else{
            abort(404);
        }
    }
    public function sellerOrderList(){

        $pending_list = Payment::join('tbl_orders','tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
            // ->join('tbl_products', 'tbl_products.id', '=', 'tbl_orders.product_id')
            // ->join('tbl_sellers', 'tbl_sellers.id', '=', 'tbl_products.owner_id')
            ->select(['tbl_orders.ref_id as orderref_id', 'tbl_payments.*',
                        DB::raw('count(tbl_orders.product_id) as total_product'),
                        DB::raw('SUM(tbl_orders.quantity) as total_quantity')
                    ])
                    // ->groupBy('tbl_payments.ref_id')
                    ->where('tbl_payments.complete_status','1')
                    // ->where('tbl_products.owner_id', '<>', '0' )
                    ->where([
                    'tbl_orders.shipped' => '0',
                    'tbl_orders.delivered' => '0',
                    'tbl_orders.cancelled' => '0',
                    'tbl_orders.failed_delivery' => '0'
                    ])
                    ->orderBy('id','desc')->paginate(10);
        // dd($pending_list);
        foreach($pending_list as $row)
        {
            // dd($row->ref_id);
            $totalWeight = 0;
            $productList = Order::join('tbl_products','tbl_products.id','tbl_orders.product_id')
                        ->where('tbl_orders.ref_id',$row->ref_id)
                        ->select('tbl_orders.product_id','tbl_orders.quantity','tbl_products.product_package_weight')
                        ->get();
            foreach($productList as $list)
            {
                $total = $list->product_package_weight * $list->quantity;
                $totalWeight += $total;
                // dd($total);
            }
            $row->setAttribute('total_weight',$totalWeight);
        }
        $sellers = Seller::all();
        $arr_sel = [];
        foreach($sellers as $sel){
            $arr_sel[$sel->id] = $sel->company_name;
        }
        // dd($arr_sel);
        foreach($pending_list as $row){
            $product_id_list_ship = Order::where('ready_to_ship', '1')->where('ref_id', $row->ref_id)->get();
            $product_id_list_pending = Order::where('pending', '1')->where('cancelled', '0')->where('ref_id', $row->ref_id)->get();
            foreach($product_id_list_ship as $ship){
                // seller  1
                $product = Product::where('id', $ship->product_id)->first();
                $arr_ship[$row->ref_id][$product->owner_id] = '1';
            }
            foreach($product_id_list_pending as $pend){
                // seller 0 2
                $product = Product::where('id', $pend->product_id)->first();
                $arr_ship[$row->ref_id][$product->owner_id] = '0';
            }
        }

       $delivery_list = Delivery::where('publish_status', '1')->where('delete_status', '0')->where('parent_id',null)->get();
      $assing_deliver =  DeliveryAssign::get();

        // dd($arr_ship['6Twtp']['0']);
        foreach($pending_list as $row){
            $check_seller = Order::where('ref_id',$row->ref_id)->where('pending','1')->where('cancelled','0')->get();
            // dd($check_seller);
            if($check_seller->isEmpty())
            {
                $row->setAttribute('check_status','1');
            }
            else{
                $row->setAttribute('check_status','0');
            }
        }

        // dd($pending_list);
        return view('admin.list.pending_sellerorder', compact('pending_list','arr_ship','arr_sel', 'delivery_list', 'assing_deliver'));
    }

    public function fetch(Request $request)
    {
        $orderDate = $request->orderDate;
        $pending_list = Payment::join('tbl_orders','tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
            // ->join('tbl_products', 'tbl_products.id', '=', 'tbl_orders.product_id')
            // ->join('tbl_sellers', 'tbl_sellers.id', '=', 'tbl_products.owner_id')
            ->select(['tbl_orders.ref_id','tbl_payments.id as id', 'tbl_payments.*',
                        DB::raw('count(tbl_orders.product_id) as total_product'),
                        DB::raw('SUM(tbl_orders.quantity) as total_quantity')
                    ])
                    // ->groupBy('tbl_payments.ref_id')
                    ->where('tbl_payments.complete_status','1')
                    // ->where('tbl_products.owner_id', '<>', '0' )
                    ->where([
                    'tbl_orders.shipped' => '0',
                    'tbl_orders.delivered' => '0',
                    'tbl_orders.cancelled' => '0',
                    'tbl_orders.failed_delivery' => '0'
                    ])
                    ->when($orderDate, function ($query, $orderDate) {
                        return $query->where("tbl_payments.created_at","LIKE","%$orderDate%");
                    })
                    ->orderBy('id','desc')
                    ->paginate(10);
        foreach($pending_list as $row)
        {
            // dd($row->ref_id);
            $totalWeight = 0;
            $productList = Order::join('tbl_products','tbl_products.id','tbl_orders.product_id')
                        ->where('tbl_orders.ref_id',$row->ref_id)
                        ->select('tbl_orders.product_id','tbl_orders.quantity','tbl_products.product_package_weight')
                        ->get();
            foreach($productList as $list)
            {
                $total = $list->product_package_weight * $list->quantity;
                $totalWeight += $total;
                // dd($total);
            }
            $row->setAttribute('total_weight',$totalWeight);
        }
        $sellers = Seller::all();
        $arr_sel = [];
        foreach($sellers as $sel){
            $arr_sel[$sel->id] = $sel->company_name;
        }
        // dd($arr_sel);
        foreach($pending_list as $row){
            $product_id_list_ship = Order::where('ready_to_ship', '1')->where('ref_id', $row->ref_id)->get();
            $product_id_list_pending = Order::where('pending', '1')->where('cancelled', '0')->where('ref_id', $row->ref_id)->get();
            foreach($product_id_list_ship as $ship){
                // seller  1
                $product = Product::where('id', $ship->product_id)->first();
                $arr_ship[$row->ref_id][$product->owner_id] = '1';
            }
            foreach($product_id_list_pending as $pend){
                // seller 0 2
                $product = Product::where('id', $pend->product_id)->first();
                $arr_ship[$row->ref_id][$product->owner_id] = '0';
            }
        }
        // dd($arr_ship);
        // $productId = Product

        $delivery_list = Delivery::where('publish_status', '1')->where('delete_status', '0')->where('parent_id',null)->get();
        // dd($arr_ship['6Twtp']['0']);
        foreach($pending_list as $row){
            $check_seller = Order::where('ref_id',$row->ref_id)->where('pending','1')->where('cancelled','0')->get();
            // dd($check_seller);
            if($check_seller->isEmpty())
            {
                $row->setAttribute('check_status','1');
            }
            else{
                $row->setAttribute('check_status','0');
            }
        }
        return view('admin.list.ajaxlist.pending_sellerorder', compact('pending_list','arr_ship','arr_sel', 'delivery_list'));
    }
    public function viewOrder($ref_id)
    {
        $user_info = $this->viewUserInfo($ref_id);
        $pending_list = $this->viewOrderProduct($ref_id);
        $payment = Payment::where('ref_id',$ref_id)->first();
        return view('admin.pages.pending_sellerorder',compact('pending_list','user_info','payment'));
    }

    public function viewReadyShipping($ref_id)
    {

        $user_info = $this->viewUserInfo($ref_id);

        abort_if(!$user_info, '404');
        $owner_id = "0";
        $ordered_products = $this->viewOrderProduct($ref_id);

        return view('admin.pages.readytoship', compact('ordered_products', 'user_info'));
    }

    public function viewShipped($ref_id)
    {
        $user_info = $this->viewUserInfo($ref_id);

        abort_if(!$user_info, '404');
$owner_id = "0";
        // $ordered_products = $this->viewOrderProduct($ref_id);
        $ordered_products = $this->viewOrderProduct($ref_id);

        return view('admin.pages.shipped', compact('ordered_products', 'user_info'));
    }

    public function sendMail($seller_id,$ref_id)
    {
        $seller = Seller::where('id',$seller_id)->first();
        event(new ConfirmationForShipping($seller->email,$ref_id));
        return back()->with('success', 'Reminder has been send !!!');
    }



}
