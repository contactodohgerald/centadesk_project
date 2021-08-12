<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfirmationCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confirmation_codes', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->string('user_unique_id');
            $table->string('token');
            $table->string('type');
            $table->string('status')->default('pending');
            $table->softDeletes('deleted_at',6)->nullable();
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
        Schema::dropIfExists('confirmation_codes');
    }
}
