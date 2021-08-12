<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCourseTbTable extends Migration
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
            $table->string('ratings')->nullable()->change();
            $table->string('views')->nullable()->change();
            $table->string('like')->nullable()->change();
            $table->string('shares')->nullable()->change();
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
            //
        });
    }
}
