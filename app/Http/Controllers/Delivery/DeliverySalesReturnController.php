<?php

namespace App\Http\Controllers\Delivery;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SalesReturn;
use App\Models\Seller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PayPal\Api\Sale;

class DeliverySalesReturnController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:delivery');
    }

    public function index()
    {
        $salesReturns = SalesReturn::where('delivery_id', Auth::guard('delivery')->user()->id)->get();
        return view('delivery.list.sales-return', compact('salesReturns'));
    }

    public function create()
    {
        $sellers = Seller::parentSeller()->get();
        $products = Product::where('publish_status', '1')->where('delete_status', '0')->get();
        return view('delivery.form.sales-return', compact('sellers', 'products'));
    }

    public function store()
    {
        $validator = Validator::make(
            request()->all(),
            [
                'seller_id' => 'required',
                'product_id' => 'required',
                'quantity' => 'required',
                'ref_id' => 'required',
            ],
            [
                'seller_id.required' => 'Please Select a Seller !',
                'product_id.required' => 'Please Select a Product !',
                'quantity.required' => 'Please enter a Quantity !',
                'ref_id.required' => 'Please enter an Order Code !',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $salesReturn = new SalesReturn();

        $salesReturn->delivery_id = Auth::guard('delivery')->user()->id;
        $salesReturn->seller_id = request('seller_id');
        $salesReturn->product_id = request('product_id');
        $salesReturn->quantity = request('quantity');
        $salesReturn->ref_id = request('ref_id');

        $salesReturn->save();

        return redirect()->route('delivery.sales.return.index');
    }

    public function edit($id)
    {
        $salesReturn = SalesReturn::where('id', $id)->firstOrFail();
        $sellers = Seller::where('publish_status', '1')->where('delete_status', '0')->get();
        $products = Product::where('publish_status', '1')->where('delete_status', '0')->get();
        return view('delivery.form.sales-return', compact('salesReturn', 'sellers', 'products'));
    }

    public function update($id)
    {
        $validator = Validator::make(
            request()->all(),
            [
                'seller_id' => 'required',
                'product_id' => 'required',
                'quantity' => 'required',
                'ref_id' => 'required',
            ],
            [
                'seller_id.required' => 'Please Select a Seller !',
                'product_id.required' => 'Please Select a Product !',
                'quantity.required' => 'Please enter a Quantity !',
                'ref_id.required' => 'Please enter an Order number !',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        SalesReturn::where('id', $id)->update([
            'delivery_id' => Auth::guard('delivery')->user()->id,
            'seller_id' => request('seller_id'),
            'product_id' => request('product_id'),
            'quantity' => request('quantity'),
            'ref_id' => request('ref_id'),
        ]);
        $salesReturn = new SalesReturn();

        return redirect()->route('delivery.sales.return.index');
    }

    public function destroy($id)
    {
        $salesReturn = SalesReturn::where('id', $id)->first();
        if (isset($salesReturn)) {
            $salesReturn->delete();
            return redirect()->route('delivery.sales.return.index')->with('success', 'Sales Return Deleted Successfully');
        }

        return redirect()->route('delivery.sales.return.index')->with('error', 'Sales Return Not Found!');
    }

    public function getProductFromSeller(Request $request)
    {
        $products = Product::where('owner_id', $request->seller)->get();
        return view('delivery.form.ajax.products', compact('products'));
    }
}
