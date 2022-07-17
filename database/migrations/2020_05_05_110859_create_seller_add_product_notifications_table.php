<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellerAddProductNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_seller_add_productnotifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('seller_id');
            $table->enum('seen_status',['1', '0'])->default(0);
            $table->foreign('product_id')
            ->references('id')
            ->on('tbl_products')
            ->onDelete('cascade');

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
        Schema::dropIfExists('tbl_seller_add_productnotifications');
    }
}
