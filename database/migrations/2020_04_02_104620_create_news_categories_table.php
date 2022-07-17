<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_news_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category_title')->nullable(true);
            $table->string('category_url')->nullable(true);
            $table->text('category_body')->nullable(true);
            $table->text('category_icon')->nullable(true);
            $table->string('external_link')->nullable(true);
            $table->string('featured_img')->nullable(true);
            $table->string('parallex_img')->nullable(true);
            $table->enum('publish_status', ['0','1'])->default(1);
            $table->enum('delete_status', ['0','1'])->default(0);
            $table->enum('show_on_menu', ['H','F','B','N'])->default('N');
            $table->enum('featured_category',['0','1'])->default(0);
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
        Schema::dropIfExists('tbl_news_categories');
    }
}
