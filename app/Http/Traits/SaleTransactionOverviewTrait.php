<?php

namespace App\Http\Traits;

use App\Models\Setting;
use App\Models\DeliverySetting;
use App\Models\TransactionOverview;
use Illuminate\Support\Str;

trait SaleTransactionOverviewTrait{
    protected $amount,$vat;

    public function calculateSaleTransactionOverviewRecord($ref_id,$arr_enum, $product)
    {
        $setting = Setting::first();

        foreach($arr_enum as $row)
        {
            switch($row){
                case 'payment_fee':
                    $this->amount = round(($product->p_price*$product->o_quanity) * ($setting->payment_fee  / 100),2);
                    $this->vat = round($this->amount * ($setting->vat / 100),2);
                break;

                case 'shipping_fee':
                    $deliveryCharge = DeliverySetting::where('weight_min', '<', $product->p_weight*$product->o_quanity)
                        ->where('weight_max', '>=', $product->p_weight*$product->o_quanity)
                        ->where('destination', $product->destination)
                        ->first();

                    $this->amount = round($deliveryCharge->rate,2);
                    $this->vat = round($this->amount * ($setting->vat / 100),2);
                break;

                case 'commission_fee':
                    $this->amount = round(($product->p_price*$product->o_quanity) * ($product->s_commission / 100),2);
                    $this->vat = round($this->amount * ($setting->vat / 100),2);
                break;

            }
            $finalTransactionOverview = $this->insertSaleTransactionOverviewRecord($ref_id,$row, $product,$this->amount,$this->vat);
        }
        return $finalTransactionOverview;
    }

    public function insertSaleTransactionOverviewRecord($ref_id,$row, $product,$finaleAmount,$finalVat)
    {
        $tran = TransactionOverview::create([
            'seller_id' => $product->s_id,
            'date'      => now(),
            'transaction_type' => $row,
            'transaction_number' => Str::random(12),
            'order_number' => $ref_id,
            'details' => $product->p_code,
            'comment' => '',
            'amount'  => $finaleAmount,
            'vat'     => $finalVat,
            'wht'     => '',
            'statement' => date('M d, Y', strtotime(now()->firstOfMonth())) . ' - ' . date('M d, Y', strtotime(now()->lastOfMonth()))
        ]);
        // return true;
        return $tran;
    }
}
