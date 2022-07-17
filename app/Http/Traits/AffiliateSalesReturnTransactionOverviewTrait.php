<?php

namespace App\Http\Traits;

// use App\Setting;
use App\Models\Affiliate;
use App\Models\AffiliateReturnTransactionOverview;

trait AffiliateSalesReturnTransactionOverviewTrait
{

    public function calculateAffiliateSalesReturnTransactionOverviewRecord($finalTransactionOverview, $salesReturn)
    {
        $affiliate = Affiliate::where('affiliate_code', $salesReturn->aff_id)->first();

        AffiliateReturnTransactionOverview::create([
            'affiliate_id' => $affiliate->affiliate_code,
            'date'      => now(),
            'transaction_type' => 'affiliate_reversal_commission',
            'transaction_number' => $finalTransactionOverview->transaction_number,
            'order_number' => $finalTransactionOverview->order_number,
            'details' => $finalTransactionOverview->details,
            'comment' => '',
            'amount'  => round($finalTransactionOverview->amount * ($affiliate->commission / 100), 2),
            'statement' => date('M d, Y', strtotime(now()->firstOfMonth())) . ' - ' . date('M d, Y', strtotime(now()->lastOfMonth()))
        ]);

        return true;
    }
}
