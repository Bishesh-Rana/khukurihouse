<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            // What You Are Selling Section
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('content_id')->nullable();
             $table->unsignedBigInteger('owner_id')->nullable();

            $table->string('product_name')->nullable();
            $table->string('product_code')->unique()->nullable();
            $table->string('product_slug')->unique()->nullable();
            $table->string('product_brand')->nullable();
            $table->string('product_model')->nullable();
//for gurkha khukuri
            $table->string('blade')->nullable();
            $table->string('handle')->nullable();
            $table->string('blade_weight')->nullable();
            $table->string('total_weight')->nullable();
            $table->string('material')->nullable();

            //  Basic Product Info Section
            $table->text('product_highlights')->nullable();
            $table->text('product_description')->nullable();
            $table->enum('product_warranty_type',
            [
                'international_manufacturer_warranty',
                'non_local_warranty',
                'local_seller_warranty',
                'no_warranty',
                'international_seller_warranty',
                'international_warranty',
                'local_warranty',
                'original_product',
                'brand_warranty'
            ]
            )->nullable();


            $table->string('product_warrenty_period')->nullable();
            $table->string('product_warrenty_policy')->nullable();
            $table->string('product_whats_on_box')->nullable();
            $table->double('product_package_weight')->nullable();
            $table->integer('weight_measure')->nullable();
            $table->string('product_package_dimension')->nullable();
            $table->string('product_video_url')->nullable();
            $table->enum('home_delivery',['0','1'])->default(0);
            $table->unsignedDecimal('delivery_charges')->nullable();
            $table->double('tax')->nullable();
            $table->double('product_original_price')->nullable();
            $table->double('product_compare_price')->nullable();

            // Key Product Information Section
            $table->text('product_key_features')->nullable();

            // SkU Section
            $table->text('product_sku')->nullable();
            $table->string('image')->nullable();
            $table->string('alt')->nullable();
            //Flags
            $table->enum('on_sale', ['0','1'])->default(0);
            $table->enum('best_rated', ['0','1'])->default(0);
            $table->bigInteger('view_count')->nullable();
            $table->enum('on_deal',['0','1'])->default(0);
            $table->date('deal_end_date')->nullable();

            $table->enum('publish_status', ['0','1'])->default(1);
            $table->enum('delete_status', ['0','1'])->default(0);
            $table->enum('live_status', ['0','1'])->default(0);
            $table->enum('quality_status', ['0','1'])->default(0);
            $table->text('quality_reject_reason')->nullable();
            $table->text('quality_control_comment')->nullable();
            $table->enum('policy_status', ['0','1'])->default(0);
            $table->text('policy_reject_reason')->nullable();
            $table->text('policy_control_comment')->nullable();
            $table->text('penalty_type')->nullable();
            $table->integer('created_by')->nullable(true);
            $table->integer('updated_by')->nullable(true);
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
        Schema::dropIfExists('tbl_products');
    }
}
