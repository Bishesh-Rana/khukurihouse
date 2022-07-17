<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlashSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flash_sales', function (Blueprint $table) {
            $table->id();
            $table->dateTime('startTime');
            $table->dateTime('endTime');
            $table->double('discount', 8, 2)->default(0.0);
            $table->bigInteger('totalStock');
            $table->bigInteger('soldStock');
            $table->timestamps();

            $table->foreignId('productId')->constrained('tbl_products')->onUpdate('cascade')
            ->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flash_sales');
    }
}
