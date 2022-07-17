<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImeSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_imesettings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('MerchantCode')->nullable();
            $table->float('TranAmount')->nullable();
            $table->string('RefId')->nullable();
            $table->string('TokenId')->nullable();
            $table->string('TransactionId')->nullable();
            $table->string('Msisdn')->nullable();
            $table->string('ResponseCode')->nullable();
            $table->string('RequestDate')->nullable();
            $table->string('ResponseDate')->nullable();
            $table->string('StatusDetail')->nullable();
            $table->string('SpecialStatus')->nullable();
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
        Schema::dropIfExists('tbl_imesettings');
    }
}
