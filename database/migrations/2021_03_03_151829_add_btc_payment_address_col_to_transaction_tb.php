<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBtcPaymentAddressColToTransactionTb extends Migration
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
            $table->string('btc_payment_address')->nullable(true)->after('device_fingerprint');
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
            $table->dropColumn('btc_payment_address');
        });
    }
}
