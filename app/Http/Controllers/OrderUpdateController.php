<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Stock;
use App\Models\Payment;
use App\Models\UpdateOrder;
use App\Models\UpdatePayment;
use App\Models\StockCalculate;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class OrderUpdateController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:web');
    // }

    public function orderUpdate(Request $request)
    {
        $quantities = $request->qty;
        foreach($quantities as $quantity)
        {
            if($quantity == 0){
                return back()->with('error','Quantity cannot be zero');
            }
        }
        /*
        |----------------------------------------------------------
        | Insert into tbl_update_orders & tbl_update_payments
        |----------------------------------------------------------
        */
        // dd($request->all());
        DB::transaction(function () use ($request) {

            $ref_id = $request->ref_id;

            $old_payment = Payment::where('ref_id', $ref_id)->firstOrFail();
            $old_payment_data = collect($old_payment)->except('id')->toArray();
            UpdatePayment::updateOrCreate(
                ['ref_id' => $ref_id],
                $old_payment_data
            );


            $old_orders = Order::where('ref_id', $ref_id)->get();
            $old_orders_data = new Collection();

            foreach ($old_orders as $row) {
                $old_orders_data->push(collect($row)->except('id'));
            }

            $order_update_data = UpdateOrder::where('ref_id', $ref_id)->get();
            if (!$order_update_data->isEmpty()) {
                UpdateOrder::where('ref_id', $ref_id)->delete();

                foreach ($old_orders_data as $key => $row) {
                    UpdateOrder::create($row->toArray());
                }
            } else {

                foreach ($old_orders_data as $key => $row) {
                    UpdateOrder::create($row->toArray());
                }
            }

            /*
        |----------------------------------------------------------
        | Update tbl_orders product_id and quantity as per  updated customer new orders
        |----------------------------------------------------------
        */

            foreach ($request->id as $key => $id) {

                Order::where('ref_id', $ref_id)->where('product_id', $id)->update([
                    'product_id' => $id,
                    'quantity' => $request->qty[$key],

                ]);
            }


            /*
    |----------------------------------------------------------
    | Total Price Calculation of updated orders
    |----------------------------------------------------------
    */

            $total_price = 0;

            $updated_orders_list = Order::join('tbl_products', 'tbl_products.id', '=', 'tbl_orders.product_id')
                ->where('tbl_orders.ref_id', $ref_id)
                ->select('tbl_products.product_original_price', 'tbl_orders.quantity', 'tbl_orders.product_id')
                ->get();

            foreach ($updated_orders_list as $row) {
                $total_price += $row->product_original_price * $row->quantity;
            }

            /*
    |--------------------------------------------------------------------
    | New Total Price updated into original payment table ->tbl_payments
    |--------------------------------------------------------------------
    */



            Payment::where('ref_id', $ref_id)->update([
                "total_price" => $total_price
            ]);


            $update_pay = UpdatePayment::where('ref_id', $ref_id)->first();

            $pay = Payment::where('ref_id', $ref_id)->first();

            $total_update_price = $update_pay->total_price;
            $total_pay_price = $pay->total_price;

            $old_total_price = $update_pay->old_total_price + ($total_update_price - $total_pay_price);

            Payment::where('ref_id', $ref_id)->update([
                "old_total_price" => $old_total_price
            ]);


            /*
        |------------------------------
        | Stock Calculation
        |------------------------------
        */
            $updated_orders_list1 = Order::where('ref_id', $ref_id)
                ->select('quantity', 'product_id')
                ->get();

            $updated_orders = UpdateOrder::where('ref_id', $ref_id)
                ->select('quantity', 'product_id')
                ->get();


            $item_arr = [];
            foreach ($updated_orders as $key => $row) {

                $new_qnty = $updated_orders_list1[$key]->quantity;
                $old_qnty = $row->quantity;
                $temp_final_qnty = $old_qnty - $new_qnty;
                if ($temp_final_qnty > 0) {
                    $final_qnty = $temp_final_qnty;
                } else {
                    $final_qnty = 0;
                }
                $temp = [];
                array_push($temp, $row->product_id);
                array_push($temp, $final_qnty);
                array_push($item_arr, $temp);
            }

            foreach ($item_arr as  $product) {

                $curStock = Stock::where('product_id', $product[0])->first(); // $prodct[0] = product_id
                $stockcal = new StockCalculate($curStock);
                $stockcal->returnOrderStock($product[1]);    // product[1] = product_quantity
                $curStock->withholding_stock = $stockcal->withholding_stock;
                $curStock->remaining_stock = $stockcal->remaining_stock;
                $curStock->save();
            }
        });

        return back()->with('success', 'Order Updated Successfully!!!');
    }
}
