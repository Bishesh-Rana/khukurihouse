<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ref_id')->nullable(true);
            $table->unsignedBigInteger('customer_id')->nullable(true);
            $table->string('customer_email')->nullable(true);
            $table->string('type')->nullable(true);
            $table->string('title')->nullable(true);
            $table->text('description')->nullable(true);
            $table->text('extra_data')->nullable(true);
            $table->string('slug')->nullable(true);
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
        Schema::dropIfExists('tbl_notifications');
    }
}
