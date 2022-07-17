<?php

namespace App\Http\Traits;

// use App\Setting;
use App\Models\Order;
use App\Models\TransactionOverview;
use App\Models\AffiliateTransactionOverview;

trait AffiliateTransactionOverviewTrait
{

    public function calculateAffiliateTransactionOverviewRecord($ref_id, $product,$finalTransactionOverview)
    {
        // $setting = Setting::first();
        $affiliateProduct = Order::join('tbl_transaction_overviews', 'tbl_transaction_overviews.order_number', 'tbl_orders.ref_id')
            ->join('tbl_affiliates', 'tbl_affiliates.affiliate_code', 'tbl_orders.aff_id')
            ->where('tbl_orders.ref_id', $ref_id)
            ->where('tbl_orders.aff_id', $product->aff_id)
            ->where('tbl_transaction_overviews.transaction_type', 'commission_fee')
            ->where('tbl_transaction_overviews.transaction_number', $finalTransactionOverview->transaction_number)
            ->select('tbl_transaction_overviews.amount', 'tbl_transaction_overviews.transaction_number', 'tbl_affiliates.commission as a_commission','tbl_affiliates.affiliate_code as aff_id')
            // ->select('tbl_orders.aff_id', 'tbl_transaction_overviews.amount', 'tbl_transaction_overviews.transaction_number', 'tbl_affiliates.commission as a_commission')
            ->first();
// dd($affiliateProduct->aff_id);
        AffiliateTransactionOverview::create([
            'affiliate_id' => $affiliateProduct->aff_id,
            'date'      => now(),
            'transaction_type' => 'affiliate_commission',
            'transaction_number' => $affiliateProduct->transaction_number,
            'order_number' => $ref_id,
            'details' => $product->p_code,
            'comment' => '',
            'amount'  => round($affiliateProduct->amount * ($affiliateProduct->a_commission / 100), 2),
            'statement' => date('M d, Y', strtotime(now()->firstOfMonth())) . ' - ' . date('M d, Y', strtotime(now()->lastOfMonth()))
        ]);

        return true;
    }
}
