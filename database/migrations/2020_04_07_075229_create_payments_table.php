<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('customer_id')->nullable(true);
            $table->string('ref_id')->nullable(true);
            $table->enum('paid_status', ['0', '1'])->default(0);
            $table->enum('complete_status', ['0', '1'])->default(0);
            $table->enum('delivery_assign_status', ['0', '1'])->default(0);
            $table->enum('device_type', ['web', 'api'])->default('api');

            $table->enum('esewa', ['0', '1'])->default(0);
            $table->enum('khalti', ['0', '1'])->default(0);
            $table->enum('imepay', ['0', '1'])->default(0);
            $table->enum('paypal', ['0', '1'])->default(0);
            $table->enum('master_card', ['0', '1'])->default(0);
            $table->enum('hbl_pay', ['0', '1'])->default(0);

            $table->integer('total_price')->nullable(true);
            $table->double('old_total_price')->default(0)->nullable(true);
            $table->integer('delivery_cost')->nullable(true);
            $table->double('discount_amount')->default(0);
            $table->string('firstname')->nullable(true);
            $table->string('lastname')->nullable(true);
            $table->string('country')->nullable(true);
            $table->string('state')->nullable(true);
            $table->string('town')->nullable(true);
            $table->string('street')->nullable(true);
            $table->string('apartment')->nullable(true);
            $table->string('zipcode')->nullable(true);
            $table->string('email')->nullable(true);
            $table->string('number')->nullable(true);
            $table->text('notes')->nullable(true);
            $table->boolean('gift_wrap')->default(false);

            $table->enum('different_shipping', ['0', '1'])->default(0);
            $table->string('shipping_country')->nullable(true);
            $table->string('shipping_state')->nullable(true);
            $table->string('shipping_town')->nullable(true);
            $table->string('shipping_street')->nullable(true);
            $table->string('shipping_apartment')->nullable(true);
            $table->string('shipping_zipcode')->nullable(true);
            $table->string('shipping_city')->nullable(true);
            $table->string('shipping_phone')->nullable(true);
            $table->string('shipping_contactperson')->nullable(true);
            $table->string('vat_number')->nullable(true);
            $table->string('company')->nullable(true);

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
        Schema::dropIfExists('tbl_payments');
    }
}
