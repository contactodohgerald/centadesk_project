<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorReviewLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor_review_likes', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->string('user_unique_id')->nullable();
            $table->string('main_review_id')->nullable();
            $table->string('like_type')->nullable();

            $table->softDeletes('deleted_at', 6);
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
        Schema::dropIfExists('instructor_review_likes');
    }
}
