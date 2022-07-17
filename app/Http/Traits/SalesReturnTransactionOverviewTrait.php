<?php

namespace App\Http\Traits;

use App\Models\Setting;
use App\Models\ReturnTransactionOverview;
use Illuminate\Support\Str;

trait SalesReturnTransactionOverviewTrait{
    protected $amount,$vat;

    public function calculateSalesReturnTransactionOverviewRecord($id,$arr_enum, $salesReturn)
    {
        // dd($salesReturn);
        $setting = Setting::first();

        foreach($arr_enum as $row)
        {
            switch($row){
                case 'payment_fee_credit':
                    $this->amount = round(($salesReturn->p_price*$salesReturn->quantity) * ($setting->payment_fee  / 100),2);
                    $this->vat = round($this->amount * ($setting->vat / 100),2);
                break;

                case 'reversal_commission_fee':
                    $this->amount = round(($salesReturn->p_price*$salesReturn->quantity) * ($salesReturn->s_commission / 100),2);
                    $this->vat = round($this->amount * ($setting->vat / 100),2);
                break;
            }
            $finalTransactionOverview = $this->insertSalesReturnTransactionOverviewRecord($id,$row, $salesReturn,$this->amount,$this->vat);
        }
        return $finalTransactionOverview;
    }

    public function insertSalesReturnTransactionOverviewRecord($id,$row, $salesReturn,$finaleAmount,$finalVat)
    {
        $returnTran = ReturnTransactionOverview::create([
            'seller_id' => $salesReturn->seller_id,
            'date'      => now(),
            'transaction_type' => $row,
            'transaction_number' => Str::random(12),
            'order_number' => $salesReturn->ref_id,
            'details' => $salesReturn->p_code,
            'comment' => '',
            'amount'  => $finaleAmount,
            'vat'     => $finalVat,
            'wht'     => '',
            'statement' => date('M d, Y', strtotime(now()->firstOfMonth())) . ' - ' . date('M d, Y', strtotime(now()->lastOfMonth()))
        ]);
        return $returnTran;
    }
}
