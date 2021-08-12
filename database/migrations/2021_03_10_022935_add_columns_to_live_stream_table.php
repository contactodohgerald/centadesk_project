<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToLiveStreamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('live_streams_tb', function (Blueprint $table) {
            //
            $table->text('description')->after('meeting_url');
            $table->string('passcode')->nullable()->after('description');
            $table->string('privacy')->nullable()->after('passcode');
            $table->string('software')->nullable()->after('privacy');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('live_streams_tb', function (Blueprint $table) {
            //
            $table->dropColumn(['description', 'passcode', 'privacy', 'software']);
        });
    }
}
