<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('old_stock')->default('0')->nullable();
            $table->bigInteger('new_stock')->default('0')->nullable();
            $table->bigInteger('total_stock')->default('0')->nullable();
            $table->bigInteger('damaged_stock')->default('0')->nullable();
            $table->bigInteger('returned_stock')->default('0')->nullable();
            $table->bigInteger('returned_damage_stock')->default('0')->nullable();
            $table->bigInteger('withholding_stock')->default('0')->nullable();
            $table->bigInteger('delivered_stock')->default('0')->nullable();
            $table->bigInteger('sellable_stock')->default('0')->nullable();
            $table->bigInteger('remaining_stock')->default('0')->nullable();
            $table->integer('updated_by')->nullable(true);
            $table->foreign('product_id')->references('id')->on('tbl_products');
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
        Schema::dropIfExists('tbl_stocks');
    }
}
