<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorsSubScribesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructors_sub_scribes', function (Blueprint $table) {
            $table->id();

            $table->string('unique_id')->unique();
            $table->string('user_unique_id')->nullable();
            $table->decimal('balance', 13,2)->default(0);
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
        Schema::dropIfExists('instructors_sub_scribes');
    }
}
