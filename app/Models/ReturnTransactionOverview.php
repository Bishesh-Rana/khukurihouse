<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ReturnTransactionOverview extends Model
{
    protected $table = "tbl_return_transaction_overviews";

    protected $guarded = [];

    public function getProductPriceAttribute()
    {
        return Product::where('product_code',$this->details)->first()->product_original_price;
    }

    public function getProductIdAttribute()
    {
        return Product::where('product_code',$this->details)->first()->id;
    }

    public function refundTransactionOverviews($seller,$month)
    {
        $year = date('Y');
        $reqest_month = $month;
        $date = Carbon::create($year, $reqest_month);
        // dd($date);

        $from = date('Y-m-d', strtotime($date->firstOfMonth()));
        $to = date('Y-m-d', strtotime($date->lastOfMonth()));

        return $this->where('seller_id', $seller->id)->whereBetween('date', array($from, $to))->get();
    }

    public function refundTransactionOverviewProducts($seller,$month)
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
