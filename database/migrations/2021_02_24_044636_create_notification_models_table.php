<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_models', function (Blueprint $table) {
            $table->id();

            $table->string('unique_id')->unique();
            $table->string('title_')->nullable();
            $table->string('link');
            $table->string('notification_type');
            $table->string('notification_details')->nullable();
            $table->string('notification_details_key')->nullable();
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
        Schema::dropIfExists('notification_models');
    }
}
