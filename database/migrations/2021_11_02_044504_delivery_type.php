<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DeliveryType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->string('deliveryType', 15)->default('standard');
            DB::statement('
            create fulltext index products_fulltext_index on tbl_products(product_name,product_brand,product_model)
            ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_products', function (Blueprint $table) {
            $table->dropColumn('deliveryType');
            $table->dropIndex('products_fulltext_index');
        });
    }
}
