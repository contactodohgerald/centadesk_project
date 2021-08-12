<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsBestsellerColumnToCourseTb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_tb', function (Blueprint $table) {
            //
            $table->string('is_bestseller')->default('no')->after('shares');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_tb', function (Blueprint $table) {
            $table->dropColumn('is_bestseller');
        });
    }
}
