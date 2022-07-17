<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('site_name')->nullable(true);
            $table->string('address')->nullable(true);
            $table->string('phone')->nullable(true);
            $table->string('email')->nullable(true);
            $table->string('contact_detail')->nullable(true);
            $table->string('site_url')->nullable(true);
            $table->string('site_logo')->nullable(true);
            $table->string('site_mini_logo')->nullable(true);
            $table->string('facebook')->nullable(true);
            $table->string('twitter')->nullable(true);
            $table->string('youtube')->nullable(true);
            $table->string('linkedin')->nullable(true);
            $table->string('instagram')->nullable(true);
            $table->string('viber')->nullable(true);
            $table->string('whatsapp')->nullable(true);
            $table->longText('map_embed_link')->nullable(true);
            $table->text('map_link')->nullable(true);
            $table->text('operation')->nullable(true);
            $table->text('privacy_policy')->nullable(true);
            $table->text('terms_and_conditions')->nullable(true);
            $table->integer('refer_reward')->nullable(true);
            $table->double('dollar_rate')->nullable(true);
            $table->double('vat')->default(0);
            $table->double('payment_fee')->default(0);

            $table->double('register_reward')->default(0);
            $table->double('purchase_reward')->default(0);

            $table->text('meta_title')->nullable(true);
            $table->text('meta_keyword')->nullable(true);
            $table->text('meta_description')->nullable(true);

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
        Schema::dropIfExists('tbl_settings');
    }
}
