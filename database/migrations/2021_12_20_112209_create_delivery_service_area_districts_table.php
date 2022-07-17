<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryServiceAreaDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_service_area_districts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('area_id')->nullable();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->foreign('area_id')->references('id')->on('districts')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('SET NULL')->onUpdate('CASCADE');
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
        Schema::dropIfExists('delivery_service_area_districts');
    }
}
