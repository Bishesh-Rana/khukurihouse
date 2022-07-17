<?php

namespace App\Http\Controllers\Admin;

use App\Http\Traits\SalesReturnTransactionOverviewTrait;
use App\Http\Traits\AffiliateSalesReturnTransactionOverviewTrait;
use App\Models\SalesReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AdminSalesReturnController extends Controller
{
    use SalesReturnTransactionOverviewTrait,AffiliateSalesReturnTransactionOverviewTrait;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $salesReturns = SalesReturn::where('complete_status','0')->get();
        return view('admin.list.sales-return', compact('salesReturns'));
    }

    public function calculateSalesReturnTransactionOverview($id)
    {
        // dd($id);
        $salesReturn = SalesReturn::join('tbl_products','tbl_products.id','tbl_sales_returns.product_id')
                    ->join('tbl_sellers','tbl_sellers.id','tbl_sales_returns.seller_id')
                    ->join('tbl_orders','tbl_orders.ref_id','tbl_sales_returns.ref_id')
                    ->where('tbl_sales_returns.id',$id)
                    // ->select('tbl_sales_returns.*')
                    ->select('tbl_orders.aff_id','tbl_sales_returns.*','tbl_products.product_original_price as p_price','tbl_products.product_code as p_code','tbl_sellers.commission as s_commission')
                    ->first();
        // dd($salesReturn);
        $arr_enum = ['payment_fee_credit','reversal_commission_fee'];

        $finalTransactionOverview = $this->calculateSalesReturnTransactionOverviewRecord($id, $arr_enum, $salesReturn);
        // dd($finalTransactionOverview);
        if($finalTransactionOverview->count()>0){
            $affiliateTransactionOverview = $this->calculateAffiliateSalesReturnTransactionOverviewRecord($finalTransactionOverview, $salesReturn);
        }
        if($affiliateTransactionOverview){
            $data = [
                'complete_status' => '1',
            ];

            SalesReturn::where('id', $id)->update($data);

            return back()->with('success','Refund updated successfully!');
        }
    }
}
