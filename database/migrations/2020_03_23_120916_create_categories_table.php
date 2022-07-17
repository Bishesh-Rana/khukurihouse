<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category_name')->nullable();
            $table->string('category_slug')->nullable();
            $table->integer('category_id')->nullable(true);
            $table->integer('position')->nullable(true);
            $table->enum('featured', ['0', '1'])->default(0);
            $table->string('image')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('category_icon')->nullable();
            $table->text('alt')->nullable();
            $table->bigInteger('view_count')->nullable();
            $table->enum('show_on_home', ['0', '1'])->default(0);
            $table->enum('placement', ['none', 'first', 'second', 'third'])->default('none');
            $table->enum('hot_best_sellers', ['0', '1'])->default(0);
            $table->enum('hot_new_arrivals', ['0', '1'])->default(0);
            $table->enum('publish_status', ['0', '1'])->default(1);
            $table->enum('delete_status', ['0', '1'])->default(0);
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
        Schema::dropIfExists('tbl_categories');
    }
}
