<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_sellers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('parent_id')->nullable(true);
            $table->string('seller_code')->nullable(true);
            $table->string('image')->nullable(true);
            $table->string('first_name')->nullable(true);
            $table->string('middle_name')->nullable(true);
            $table->string('last_name')->nullable(true);
            $table->string('company_name')->nullable(true);
            $table->string('company_address')->nullable(true);
            $table->string('company_city')->nullable(true);
            $table->string('company_state')->nullable(true);
            $table->string('zip_code')->nullable(true);
            $table->string('company_phone')->nullable(true);
            $table->string('company_country')->nullable(true);
            $table->string('email')->nullable(true);
            $table->text('contact_detail')->nullable(true);
            $table->integer('business_type')->nullable(true);
            $table->string('company_website')->nullable(true);
            $table->text('company_offer')->nullable(true);
            $table->text('company_description')->nullable(true);
            $table->string('username')->nullable(true);
            $table->string('password')->nullable(true);
            $table->enum('active_status', ['0', '1'])->default(0);
            $table->string('activation_code')->nullable(true);
            $table->string('pan_no')->nullable(true);
            $table->string('vat_no')->nullable(true);
            $table->string('bank_name')->nullable(true);
            $table->string('bank_acc_number')->nullable(true);
            $table->datetime('last_login')->nullable(true);
            $table->enum('holiday_mode', ['0', '1'])->default(0);
            $table->double('commission')->default(0);
            $table->enum('publish_status', ['0', '1'])->default(0);
            $table->enum('delete_status', ['0', '1'])->default(0);
            $table->rememberToken();
            $table->integer('verify_otp')->nullable();
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
        Schema::dropIfExists('tbl_sellers');
    }
}
