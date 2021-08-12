<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiveStreamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_streams_tb', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->string('user_id');
            $table->string('title');
            $table->string('status');
            $table->text('meeting_url');
            $table->string('date_to_start');
            $table->string('time_to_start');
            $table->softDeletes();
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
        Schema::dropIfExists('live_streams_tb');
    }
}
