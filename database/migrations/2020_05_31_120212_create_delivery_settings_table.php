<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliverySettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_delivery_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('source')->nullable();
            $table->string('destination')->nullable();
            $table->double('weight_min')->nullable();
            $table->double('weight_max')->nullable();
            $table->double('rate')->nullable();
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
        Schema::dropIfExists('tbl_delivery_settings');
    }
}
