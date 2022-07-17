<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDeliveryStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_delivery_staff', function (Blueprint $table) {
            $table->bigIncrements('order_delivery_staff_id');
            $table->string('ref_id')->nullable(true);
            $table->unsignedBigInteger('delivery_id');
            $table->unsignedBigInteger('staff_id');
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
        Schema::dropIfExists('order_delivery_staff');
    }
}
