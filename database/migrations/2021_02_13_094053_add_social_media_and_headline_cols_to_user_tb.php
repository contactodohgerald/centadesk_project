<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSocialMediaAndHeadlineColsToUserTb extends Migration
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
            $table->string('professonal_heading')->after('last_name')->nullable();
            $table->text('description')->after('professonal_heading')->nullable();
            $table->string('facebook')->after('wallet_address')->nullable();
            $table->string('twitter')->after('facebook')->nullable();
            $table->string('linkedin')->after('twitter')->nullable();
            $table->string('youtube')->after('linkedin')->nullable();
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
            $table->dropColumn(['professonal_heading', 'description', 'facebook', 'twitter', 'linkedin', 'youtube']);
        });
    }
}
