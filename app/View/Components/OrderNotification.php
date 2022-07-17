<?php

namespace App\View\Components;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class OrderNotification extends Component
{
    public $order_notification;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->order_notification = $this->orderList();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.order-notification');
    }

    public function orderList()
    {
        return DB::table('tbl_orders')
            ->limit(10)
            ->orderBy('tbl_orders.id', 'desc')
            ->join('tbl_products', 'tbl_products.id', 'tbl_orders.product_id')
            ->join('tbl_payments', 'tbl_orders.ref_id', '=', 'tbl_payments.ref_id')
            ->select('tbl_products.product_name', 'tbl_orders.quantity', 'tbl_orders.created_at','tbl_order')
            ->selectRaw('tbl_payments.firstname + " " +tbl_payments.lastname as customername')
            ->where('tbl_products.owner_id', '<>', '0')
            ->get();
    }
}
