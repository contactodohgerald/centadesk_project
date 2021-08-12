<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonuses', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->string('type')->nullable();
            $table->decimal('amount', 30, 4)->default(0);
            $table->string('user_id');
            $table->string('referred_id')->nullable();
            $table->string('downline_number')->nullable();
            $table->string('investment_id');
            $table->string('status')->default('pending');
            $table->decimal('amount_paid', 30, 4)->default(0);
            $table->string('percentage');
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
        Schema::dropIfExists('bonuses');
    }
}