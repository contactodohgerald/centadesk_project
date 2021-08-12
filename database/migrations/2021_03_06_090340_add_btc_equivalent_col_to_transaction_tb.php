<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBtcEquivalentColToTransactionTb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_models', function (Blueprint $table) {
            //
            $table->string('amount_in_btc')->nullable(true)->after('btc_payment_address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_models', function (Blueprint $table) {
            //
            $table->dropColumn('amount_in_btc');
        });
    }
}
