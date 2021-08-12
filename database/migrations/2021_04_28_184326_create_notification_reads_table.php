<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationReadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('notification_reads')){
            Schema::create('notification_reads', function (Blueprint $table) {
                $table->id();
                $table->string('unique_id')->unique();

                $table->string('user_unique_id')->nullable();
                $table->string('Notification_unique_id')->nullable();
    
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
        Schema::dropIfExists('notification_reads');
    }
}
