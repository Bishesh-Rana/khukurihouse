<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stock;
use App\Models\StockCalculate;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $stocks = Product::join('tbl_stocks','tbl_stocks.product_id','=','tbl_products.id')
            ->where('tbl_products.publish_status', '1')
            ->where('tbl_products.delete_status', '0')
            ->where('owner_id','0')
            ->orderBy('tbl_products.id','desc')
            ->select('tbl_products.*','tbl_stocks.total_stock','tbl_stocks.withholding_stock','tbl_stocks.sellable_stock','tbl_stocks.remaining_stock')
            ->paginate(10);
        // dd($stocks);

        $stocksModal = Product::join('tbl_stocks','tbl_products.id','=','tbl_stocks.product_id')
            ->where('tbl_products.publish_status', '1')
            ->where('tbl_products.delete_status', '0')
            ->where('owner_id','0')
            ->orderBy('tbl_products.id','desc')
            ->select('tbl_products.product_name','tbl_stocks.*')
            ->paginate(10);
        // dd($stocksModal);
        return view('admin.list.stock', compact('stocks','stocksModal'));
    }

    public function fetch(Request $request)
    {
        $productName = $request->productName;

        $stocks = Product::join('tbl_stocks','tbl_stocks.product_id','=','tbl_products.id')
            ->where('tbl_products.publish_status', '1')
            ->where('tbl_products.delete_status', '0')
            ->where('tbl_products.owner_id','0')
            ->when($productName, function ($query, $productName) {
                return $query->where("product_name","LIKE","%$productName%");
            })
            ->select('tbl_products.*','tbl_stocks.total_stock','tbl_stocks.withholding_stock','tbl_stocks.sellable_stock','tbl_stocks.remaining_stock')
            ->paginate(10);
        // dd($stocks);

        $stocksModal = Product::join('tbl_stocks','tbl_products.id','=','tbl_stocks.product_id')
            ->where('tbl_products.publish_status', '1')
            ->where('tbl_products.delete_status', '0')
            ->where('tbl_products.owner_id','0')
            ->when($productName, function ($query, $productName) {
                return $query->where("product_name","LIKE","%$productName%");
            })
            ->select('tbl_products.product_name','tbl_stocks.*')
            ->paginate(10);
        // dd($stocksModal);
        return view('admin.list.ajaxlist.stock', compact('stocks','stocksModal'));
    }

    public function view($id)
    {
        $stock = Product::join('tbl_stocks','tbl_products.id','=','tbl_stocks.product_id')
            ->where('tbl_stocks.product_id',$id)
            ->select('*')
            ->first();
        return view('admin.pages.stock', compact('stock'));
    }

    public function edit($id)
    {
        $stock = Product::where('id', $id)
            ->where('owner_id','0')
            ->firstorfail();
        return view('admin.form.stock', compact('stock'));
    }

    public function update($id)
    {
        $this->validate(request(),[
            'new_stock' => 'required'
        ]);
        //curStock means current stock
        $curStock = Stock::where('product_id', $id)->first();
        $stockcal = new StockCalculate($curStock);

        if(request('new_stock'))
        {
            $stockcal->newStock(request('new_stock'));
            $curStock->old_stock = $stockcal->old_stock;
            $curStock->new_stock = $stockcal->new_stock;
            $curStock->total_stock = $stockcal->total_stock;
            $curStock->sellable_stock = $stockcal->sellable_stock;
            $curStock->remaining_stock = $stockcal->remaining_stock;
            $curStock->save();
        }

        if(request('damaged_stock'))
        {
            $stockcal->damageStock(request('damaged_stock'));
            $curStock->damaged_stock = $stockcal->damaged_stock;
            $curStock->sellable_stock = $stockcal->sellable_stock;
            $curStock->remaining_stock = $stockcal->remaining_stock;
            $curStock->save();
        }

        if(request('withholding_stock'))
        {
            $stockcal->withholdingStock(request('withholding_stock'));
            $curStock->withholding_stock = $stockcal->withholding_stock;
            $curStock->remaining_stock = $stockcal->remaining_stock;
            $curStock->save();
        }

        if(request('delivered_stock'))
        {
            $stockcal->deliverStock(request('delivered_stock'));
            $curStock->delivered_stock = $stockcal->delivered_stock;
            $curStock->sellable_stock = $stockcal->sellable_stock;
            $curStock->withholding_stock = $stockcal->withholding_stock;
            $curStock->save();
        }

        if(request('returned_stock'))
        {
            $stockcal->returnStock(request('returned_stock'));
            $curStock->returned_stock = $stockcal->returned_stock;
            $curStock->sellable_stock = $stockcal->sellable_stock;
            $curStock->remaining_stock = $stockcal->remaining_stock;
            $curStock->delivered_stock = $stockcal->delivered_stock;
            $curStock->save();
        }

        if(request('returned_damage_stock'))
        {
            $stockcal->returnDamageStock(request('returned_damage_stock'));
            $curStock->returned_damage_stock = $stockcal->returned_damage_stock;
            $curStock->delivered_stock = $stockcal->delivered_stock;
            $curStock->save();
        }

        return redirect('/ns-admin/stocks')->with('success','Stocks Added Successfully');
    }

    public function increaseByOne($id)
    {
        $product = Product::where('id', $id)->first();
        $product->qty = $product->qty + 1;
        $product->save();

        return back();
    }

    public function decreaseByOne($id)
    {
        $product = Product::where('id', $id)->first();
        if ($product->qty != 0) {
            $product->qty = $product->qty - 1;
            $product->save();
            return back();
        } else
            return back()->with('error', 'Stock cannot be less than zero');
    }
}
