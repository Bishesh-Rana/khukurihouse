<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryAssignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_deliveries_assign', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ref_id')->nullable();
            $table->string('delivery_id')->nullable();
            $table->enum('seen_status',['1', '0'])->default(0);
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
        Schema::dropIfExists('tbl_deliveries_assign');
    }
}
