<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePushNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_push_notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable(true);
            $table->string('image')->nullable(true);
            $table->text('description')->nullable(true);
            $table->enum('type',['product','news','coupons'])->nullable(true);
            $table->string('slug')->nullable(true);
            $table->string('external_url')->nullable(true);
            $table->enum('delete_status', ['0','1'])->default(0);
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
        Schema::dropIfExists('tbl_push_notifications');
    }
}
