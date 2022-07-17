<?php

namespace App\Http\Traits;

use App\Models\Statement;

trait FinancialStatementTrait
{
    public function insertFinancialStatement($statement)
    {

        Statement::create([
            'seller_id' => $statement->seller_id,
            'month' => $statement->month,
            'year' => $statement->year,
            'opening_balance' => $statement->opening_balance,

            'order_item_charge' => $statement->order_item_charge,
            'order_eshopping_fee' => $statement->order_eshopping_fee,
            'order_payment_fee' => $statement->order_payment_fee,
            'order_commission_fee' => $statement->order_commission_fee,
            'order_shipping_fee' => $statement->order_shipping_fee,
            'order_penalties' => $statement->order_penalties,
            'order_vat' => $statement->order_vat,
            'order_subtotal' => $statement->order_subtotal,

            'refund_item_charge' => $statement->refund_item_charge,
            'refund_eshopping_fee' => $statement->refund_eshopping_fee,
            'refund_payment_fee_credit' => $statement->refund_payment_fee_credit,
            'refund_reversal_commission_fee' => $statement->refund_reversal_commission_fee,
            'refund_penalties' => $statement->refund_penalties,
            'refund_vat' => $statement->refund_vat,
            'refund_subtotal' => $statement->refund_subtotal,

            'payout' => $statement->payout,

            'closing_balance' => $statement->closing_balance
        ]);
        return true;
    }
}
