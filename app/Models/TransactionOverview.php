<?php

namespace App\Models;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TransactionOverview extends Model
{
    protected $table = "tbl_transaction_overviews";

    protected $guarded = [];

    public function seller()
    {
        return $this->belongsTo('App\seller','seller_id');
    }

    public function getProductPriceAttribute()
    {
        return Product::where('product_code',$this->details)->first()->product_original_price;
    }

    public function getProductIdAttribute()
    {
        return Product::where('product_code',$this->details)->first()->id;
    }

    public function orderTransactionOverviews($seller,$month)
    {
        $year = date('Y');
        $reqest_month = $month;
        $date = Carbon::create($year, $reqest_month);
        // dd($date);

        $from = date('Y-m-d', strtotime($date->firstOfMonth()));
        $to = date('Y-m-d', strtotime($date->lastOfMonth()));

        return $this->where('seller_id', $seller->id)->whereBetween('date', array($from, $to))->get();
    }

    // public function product_group()
    // {
    //     return $this->groupBy('order_number', 'details')->get();
    // }

    // public function transactionOverviewProducts($seller,$month)
    // {
    //     return $this->orderTransactionOverviews($seller,$month)->product_group();
    // }

    public function orderTransactionOverviewProducts($seller,$month)
    {
        $year = date('Y');
        $reqest_month = $month;
        $date = Carbon::create($year, $reqest_month);
        // dd($date);

        $from = date('Y-m-d', strtotime($date->firstOfMonth()));
        $to = date('Y-m-d', strtotime($date->lastOfMonth()));

        return $this->where('seller_id', $seller->id)->whereBetween('date', array($from, $to))->groupBy('order_number', 'details')->get();
    }
}
