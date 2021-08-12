<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankCodesModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_codes_models', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->string('bank_codes');
            $table->string('bank_name');
            $table->string('country');
            $table->string('type_of_gateway')->nullable();
            $table->string('is_deleted')->default('no');

            $table->softDeletes('deleted_at', 6);
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
        Schema::dropIfExists('bank_codes_models');
    }
}
