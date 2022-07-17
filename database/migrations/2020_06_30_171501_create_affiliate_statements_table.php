<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAffiliateStatementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_affiliate_statements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('affiliate_id')->nullable(true);
            $table->integer('month')->nullable(true);
            $table->integer('year')->nullable(true);
            $table->double('opening_balance')->nullable(true)->default(0);
            $table->double('closing_balance')->nullable(true)->default(0);
            $table->double('paid_balance')->nullable(true)->default(0);

            $table->double('commission_earned')->nullable(true)->default(0);
            $table->double('commission_refund')->nullable(true)->default(0);
           
            $table->double('payout')->nullable(true)->default(0);

            $table->enum('paid_status',['0','1','2'])->nullable(true)->default(0);
            $table->enum('publish_status',['1', '0'])->default(1);
            $table->enum('delete_status',['1', '0'])->nullable(true)->default(0);
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
        Schema::dropIfExists('tbl_affiliate_statements');
    }
}
