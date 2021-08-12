<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('unique_id')->unique();
            $table->string('user_unique_id')->nullable();
            $table->string('type_of_user')->nullable();
            $table->decimal('amount',13,4);
            $table->text('description')->nullable();
            $table->string('action_type');//expense, income, withdrawal, top_up
            $table->string('status')->default('pending');
            $table->string('reference')->nullable();
            $table->string('country')->nullable();
            $table->string('currency')->nullable();
            $table->string('customer')->nullable();
            $table->string('image_name')->nullable();
            $table->string('biller_name')->nullable();
            $table->string('is_airtime')->nullable();
            $table->string('top_up_option')->nullable();
            $table->string('add_narrations')->nullable();
            $table->string('is_bill_or_airtime')->nullable();
            $table->string('recurrence')->nullable();
            $table->string('is_deleted')->default('no');

            $table->string('flw_ref')->nullable();
            $table->string('account_token')->nullable();
            $table->string('consumer_id')->nullable();
            $table->string('consumer_mac')->nullable();
            $table->string('amount_settled')->nullable();
            $table->string('device_fingerprint')->nullable();

            $table->softDeletes();  //add this line
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
        Schema::dropIfExists('transaction_models');
    }

}
