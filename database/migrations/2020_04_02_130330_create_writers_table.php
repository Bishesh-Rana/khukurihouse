<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWritersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_writers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('writer_title')->nullable(true);
            $table->string('writer_designation')->nullable(true);
            $table->enum('writer_type',['reporter','guest'])->nullable(true);
            $table->text('writer_body')->nullable(true);
            $table->string('featured_img')->nullable(true);
            $table->string('writer_phone')->nullable(true);
            $table->string('writer_address')->nullable(true);
            $table->string('writer_email')->nullable(true);
            $table->string('writer_facebook')->nullable(true);
            $table->string('writer_twitter')->nullable(true);
            $table->string('writer_youtube')->nullable(true);
            $table->enum('publish_status', ['0','1'])->default(1);
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
        Schema::dropIfExists('tbl_writers');
    }
}
