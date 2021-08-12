<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseTb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_tb', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->string('category_id');
            $table->string('name');
            $table->text('description');
            $table->string('cover_image');
            $table->string('intro_video');
            $table->string('pricing');
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
        Schema::dropIfExists('course_tb');
    }
}
