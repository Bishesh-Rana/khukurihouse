<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('provider_id')->nullable();
            $table->integer('referer_id')->nullable();
            $table->string('title');

            $table->string('name');
            // $table->string('username');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('email');

            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('town')->nullable();
            $table->string('street')->nullable();
            $table->string('apartment')->nullable();
            $table->string('zipcode')->nullable();
            $table->enum('is_social_login', ['0','1'])->default('0');
            $table->enum('payment_option',['cash','esewa','khalti','imepay','paypal'])->nullable();

            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('image')->nullable();
            $table->double('reward_point')->default(0);
            $table->enum('publish_status', ['0','1'])->default(1);
            $table->enum('delete_status', ['0','1'])->default(0);
            $table->rememberToken();
            $table->string('verify_token')->nullable();
            $table->integer('verify_otp')->nullable();
            $table->integer('forgot_password_otp')->nullable();
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
        Schema::dropIfExists('tbl_customers');
    }
}
