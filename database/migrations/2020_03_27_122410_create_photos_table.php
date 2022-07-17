<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_photos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('imageable_id')->unsigned();
            $table->string('imageable_type');
            $table->string('image');
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
        Schema::dropIfExists('tbl_photos');
    }
}
