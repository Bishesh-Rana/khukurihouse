<?php

namespace App\Http\Traits;

use App\Models\AffiliateStatement;

trait AffiliateFinancialStatementTrait
{
    public function insertFinancialStatement($statement)
    {

        AffiliateStatement::create([
            'affiliate_id' => $statement->affiliate_id,
            'month' => $statement->month,
            'year' => $statement->year,
            'opening_balance' => $statement->opening_balance,

            'commission_earned' => $statement->commission_earned,
            'commission_refund' => $statement->commission_refund,

            'payout' => $statement->payout,

            'closing_balance' => $statement->closing_balance
        ]);
        return true;
    }
}
