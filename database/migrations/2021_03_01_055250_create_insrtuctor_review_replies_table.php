<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsrtuctorReviewRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insrtuctor_review_replies', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->string('user_unique_id')->nullable();
            $table->string('main_instructor_unique_id')->nullable();
            $table->string('comment');
            $table->string('status')->default('pending');

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
        Schema::dropIfExists('insrtuctor_review_replies');
    }
}
