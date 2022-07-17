<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $customers = Customer::where('publish_status', '1')
                               ->where('delete_status','0')
                               ->orderBy('id', 'desc')
                               ->paginate(10);

        return view('admin.list.customer', compact('customers'));
    }

    public function customerBlock($id){

        Customer::where('id', $id)->update(["publish_status" => "0"]);
        return back()->with('success', "Customer has been blocked !!!");
    }

    public function ajaxFetchCustomerList(Request $request){

        $email = $request->email;
        $customerName = $request->customerName;

        $customers = Customer::where('publish_status', '1')
        ->where('delete_status','0')
        ->orderBy('id', 'desc')
        ->when($email, function ($query, $email) {
            return $query->where("email","LIKE","%$email%");
        })
        ->when($customerName, function ($query, $customerName) {
            return $query->where("name","LIKE","%$customerName%");
        })
        ->orderBy('id','desc')
        ->paginate(10);
        return view('admin.list.ajaxcustomer.customer', compact('customers'));

    }

     /*
    |----------------------------------------------------------
    |Important Note:
    |Future ma if customer ko delivery vai sakeko product return ko data nikalna paryo vane tbl_sales_return
    |bata ref_id nikalera tyo ref_id liyera tbl_payments bata customer_id nikalera balla customer ko data nikala
    |----------------------------------------------------------
    */

    public function viewCustomerPurchaseList($id)
    {
        $customer = Customer::where('id',$id)->first();

        $ref_ids = Payment::where('customer_id',$customer->id)->get('ref_id');
        $orders = Order::whereIn('ref_id',$ref_ids)->orderBy('tbl_orders.created_at','desc')->where('cancelled', '0')->where('delivered', '1')->paginate(10);

        return view('admin.pages.customer.purchasedetail',compact('customer','orders'));
    }

    public function fetchCustomerPurchaseList(Request $request)
    {
        $customer = Customer::where('id',$request->customerId)->first();

        $ref_ids = Payment::where('customer_id',$customer->id)->get('ref_id');
        $orders = Order::whereIn('ref_id',$ref_ids)->orderBy('tbl_orders.created_at','desc')->where('cancelled', '0')->where('delivered', '1')->paginate(10);

        return view('admin.pages.customer.list',compact('customer','orders'));
    }

    public function viewCustomerCancelList($id)
    {
        $customer = Customer::where('id',$id)->first();

        $ref_ids = Payment::where('customer_id',$customer->id)->get('ref_id');
        $orders = Order::whereIn('ref_id',$ref_ids)->orderBy('tbl_orders.created_at','desc')->where('cancelled', '1')->paginate(10);

        return view('admin.pages.customer.canceldetail',compact('customer','orders'));
    }

    public function fetchCustomerCancelList(Request $request)
    {
        $customer = Customer::where('id',$request->customerId)->first();

        $ref_ids = Payment::where('customer_id',$customer->id)->get('ref_id');
        $orders = Order::whereIn('ref_id',$ref_ids)->orderBy('tbl_orders.created_at','desc')->where('cancelled', '1')->paginate(10);

        return view('admin.pages.customer.list',compact('customer','orders'));
    }
}
