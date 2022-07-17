<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductStaffSellerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_staff_seller', function (Blueprint $table) {
            $table->bigIncrements('product_staff_seller_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('seller_id');
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
        Schema::dropIfExists('product_staff_seller');
    }
}
