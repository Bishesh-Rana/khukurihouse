<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsNewscategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_news_category', function (Blueprint $table) {
            $table->bigIncrements('news_news_category_id');
            $table->unsignedBigInteger('news_category_id');
            $table->unsignedBigInteger('news_id');
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
        Schema::dropIfExists('news_news_category');
    }
}
