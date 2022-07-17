<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_advertisements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable(true);
            $table->text('body')->nullable(true);
            $table->string('link')->nullable(true);
            $table->string('image')->nullable(true);
            $table->enum('placement', ['plain-text', 'mid-left', 'mid-right', 'full-width', 'deal-ad', 'google-play'])->nullable(true);
            $table->enum('publish_status', ['0', '1'])->default(1);
            $table->enum('delete_status', ['0', '1'])->default(0);
            $table->enum('featured', ['0', '1'])->default(0);
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
        Schema::dropIfExists('tbl_advertisements');
    }
}
