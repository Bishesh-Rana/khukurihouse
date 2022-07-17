<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpdateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_update_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id')->nullable(true);
            $table->integer('quantity')->nullable(true);
            $table->string('ref_id')->nullable(true);
            $table->double('discount_amount')->default(0);
            $table->string('coupon_name')->nullable(true);
            $table->enum('pending', ['0', '1'])->default(1);
            $table->enum('ready_to_ship', ['0', '1'])->default(0);
            $table->enum('shipped', ['0', '1'])->default(0);
            $table->enum('delivered', ['0', '1'])->default(0);
            $table->enum('cancelled', ['0', '1'])->default(0);
            $table->enum('failed_delivery', ['0', '1'])->default(0);
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
        Schema::dropIfExists('tbl_update_orders');
    }
}
