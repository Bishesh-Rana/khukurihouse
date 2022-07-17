<?php

namespace App\Http\Traits;

use App\Models\Order;
use App\Models\Payment;

trait Seller_OrderTrait
{
    public function viewOrderProduct($ref_id)
    {
        $ordered_products = Order::join('tbl_products','tbl_products.id', '=', 'tbl_orders.product_id')
        ->select('tbl_products.*', 'tbl_orders.quantity')
        ->where('tbl_orders.ref_id', $ref_id)
        ->get();
        return $ordered_products;
    }

    public function viewUserInfo($ref_id){

        $user_info = Payment::where(
            [
                'ref_id' => $ref_id,
                ])->first();
                return $user_info;
    }
}
