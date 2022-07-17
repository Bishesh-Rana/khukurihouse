<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAffiliateTransactionOverviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_affiliate_transaction_overviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('affiliate_id')->nullable(true);
            $table->date('date')->nullable(true);
            $table->string('transaction_type')->nullable(true);
            $table->string('transaction_number')->nullable(true);
            $table->string('order_number')->nullable(true);
            $table->text('details')->nullable(true);
            $table->text('comment')->nullable(true);
            $table->double('amount')->nullable(true);
            // $table->double('vat')->nullable(true);
            // $table->text('wht')->nullable(true);
            $table->string('statement')->nullable(true);
            $table->enum('publish_status',['1', '0'])->default(0);
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
        Schema::dropIfExists('tbl_affiliate_transaction_overviews');
    }
}
