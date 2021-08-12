<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('gallery_models')){
            Schema::create('gallery_models', function (Blueprint $table) {
                $table->id();
                $table->string('unique_id')->unique();

                $table->string('gallery_title');
                $table->string('gallery_image');
                $table->string('user_unique_id')->nullable();
                $table->string('status')->default('pending')->nullable();

                $table->softDeletes('deleted_at', 6);
                $table->timestamps();
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
        Schema::dropIfExists('gallery_models');
    }
}
