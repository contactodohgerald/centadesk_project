<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationReadModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_read_models', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();

            $table->string('notification_id')->nullable();
            $table->string('user_id')->nullable();
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
        Schema::dropIfExists('notification_read_models');
    }
}
