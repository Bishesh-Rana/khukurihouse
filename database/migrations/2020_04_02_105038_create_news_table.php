<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('news_title')->nullable();
            $table->date('news_date')->nullable();
            $table->string('news_url')->nullable();
            $table->text('news_excerpt')->nullable();
            $table->text('news_body')->nullable();
            $table->string('external_link')->nullable();
            $table->string('parallex_img')->nullable();
            $table->string('news_code')->nullable();
            $table->enum('publish_status', ['0','1'])->default(1);
            $table->enum('delete_status', ['0','1'])->default(0);
            $table->enum('featured_news',['0','1'])->default(0);
            $table->bigInteger('view_count')->default(0);
            $table->text('meta_title')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->text('meta_description')->nullable();
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
        Schema::dropIfExists('tbl_news');
    }
}
