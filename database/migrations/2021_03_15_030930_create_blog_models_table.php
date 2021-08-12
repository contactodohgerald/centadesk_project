<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_models', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->string('blog_title');
            $table->string('blog_image');
            $table->text('blog_message');
            $table->string('user_unique_id')->nullable();
            $table->string('status')->default('pending');
            $table->string('views')->default(0);
            $table->string('tag_unique_id')->nullable();

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
        Schema::dropIfExists('blog_models');
    }
}
