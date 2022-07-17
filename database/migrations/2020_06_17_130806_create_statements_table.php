<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_statements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('seller_id')->nullable(true);
            $table->integer('month')->nullable(true);
            $table->integer('year')->nullable(true);
            $table->double('opening_balance')->nullable(true)->default(0);
            $table->double('closing_balance')->nullable(true)->default(0);
            $table->double('paid_balance')->nullable(true)->default(0);

            $table->double('order_item_charge')->nullable(true)->default(0);
            $table->double('order_eshopping_fee')->nullable(true)->default(0);
            $table->double('order_payment_fee')->nullable(true)->default(0);
            $table->double('order_commission_fee')->nullable(true)->default(0);
            $table->double('order_shipping_fee')->nullable(true)->default(0);
            $table->double('order_penalties')->nullable(true)->default(0);
            $table->double('order_vat')->nullable(true)->default(0);
            $table->double('order_subtotal')->nullable(true)->default(0);

            $table->double('refund_item_charge')->nullable(true)->default(0);
            $table->double('refund_eshopping_fee')->nullable(true)->default(0);
            $table->double('refund_payment_fee_credit')->nullable(true)->default(0);
            $table->double('refund_reversal_commission_fee')->nullable(true)->default(0);
            $table->double('refund_penalties')->nullable(true)->default(0);
            $table->double('refund_vat')->nullable(true)->default(0);
            $table->double('refund_subtotal')->nullable(true)->default(0);

            $table->double('payout')->nullable(true)->default(0);

            $table->enum('paid_status',['0','1','2'])->nullable(true)->default(0);
            $table->enum('publish_status',['1', '0'])->default(1);
            $table->enum('delete_status',['1', '0'])->nullable(true)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_statements');
    }
}
