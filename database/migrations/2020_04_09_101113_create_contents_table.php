<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('content_title')->nullable(true);
            $table->string('content_url')->nullable(true);
            $table->enum('content_type', ['none', 'about', 'news', 'service', 'service-icon','service-selected', 'contact', 'team', 'brand', 'category', 'product', 'faq', 'page', 'gallery', 'video', 'testimonial'])->nullable(true);
            $table->string('content_icon')->nullable(true);
            $table->text('content_body')->nullable(true);
            $table->string('external_link')->nullable(true);
            $table->integer('parent_id')->default(0);
            $table->integer('position')->default(1);
            $table->string('featured_img')->nullable(true);
            $table->enum('publish_status', ['0', '1'])->default(1);
            $table->enum('delete_status', ['0', '1'])->default(0);
            $table->enum('show_on_menu', ['H', 'F', 'B', 'N'])->default('N');

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
        Schema::dropIfExists('tbl_contents');
    }
}
