<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class AffiliateTransactionOverview extends Model
{
    protected $table = "tbl_affiliate_transaction_overviews";
    protected $guarded = [];

    public function affiliateTransactionOverviews($affiliate,$month)
    {
        $year = date('Y');
        $reqest_month = $month;
        $date = Carbon::create($year, $reqest_month);
        // dd($date);

        $from = date('Y-m-d', strtotime($date->firstOfMonth()));
        $to = date('Y-m-d', strtotime($date->lastOfMonth()));

        return $this->where('affiliate_id', $affiliate->affiliate_code)->whereBetween('date', array($from, $to))->get();
    }
}
