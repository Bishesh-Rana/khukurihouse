<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_coupon', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('coupon_name')->nullable();
            $table->text('coupon_description')->nullable();
            $table->string('coupon_code')->nullable();
            $table->double('discount_price')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('publish_status', ['0','1'])->default(1);
            $table->enum('delete_status', ['0','1'])->default(0);
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
        Schema::dropIfExists('tbl_coupon');
    }
}
