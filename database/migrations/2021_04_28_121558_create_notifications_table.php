<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('notifications')){
            Schema::create('notifications', function (Blueprint $table) {
                $table->id();
                $table->string('unique_id')->unique();

                $table->string('user_unique_id')->nullable();
                $table->string('title')->nullable();
                $table->string('link')->nullable();
                $table->string('notification_type')->nullable();
                $table->text('notification_details')->nullable();

                $table->softDeletes('deleted_at', 6);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
