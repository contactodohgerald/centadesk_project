<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBackgroundImageToCourseCategoryTb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('course_category_tb', '')){
            Schema::table('course_category_tb', function (Blueprint $table) {
                //
                $table->string('category_icon')->default('flaticon-pencil')->nullable();
                $table->string('category_image')->default('category_image.jpg')->nullable();
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
        Schema::table('course_category_tb', function (Blueprint $table) {
            //
        });
    }
}
