<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('unique_id')->unique();
            $table->string('user_type');
            $table->string('last_name');
            $table->string('status')->default('active');
            $table->string('is_blocked')->default('no');
            $table->string('agent_level_id')->nullable();

            $table->string('user_referral_id');
            $table->string('referred_id');

            $table->softDeletes();  //add this line
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
