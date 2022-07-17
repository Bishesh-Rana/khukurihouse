<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_sliders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->text('body')->nullable();
            $table->string('image')->nullable();
            $table->string('link')->nullable();
            $table->text('meta_desc')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->text('meta_title')->nullable();
            $table->string('alt_img')->nullable();
            $table->enum('publish_status', ['0','1'])->default(1);
            $table->enum('delete_status', ['0','1'])->default(0);
            $table->enum('hide_status', ['0','1'])->default(0);
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
        Schema::dropIfExists('tbl_sliders');
    }
}
