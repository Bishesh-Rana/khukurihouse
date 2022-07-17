<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_sales_returns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('delivery_id');
            $table->bigInteger('seller_id');
            $table->bigInteger('product_id');
            $table->integer('quantity');
            $table->string('ref_id');
            $table->enum('complete_status',['0','1'])->default(0);
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
        Schema::dropIfExists('tbl_sales_returns');
    }
}
