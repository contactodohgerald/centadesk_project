<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToCourseTable extends Migration
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
            $table->string('shares')->default(0)->after('pricing');
            $table->string('like')->default(0)->after('pricing');
            $table->string('views')->default(0)->after('pricing');
            $table->string('ratings')->default(0)->after('pricing');
            $table->text('course_urls')->nullable(true)->after('pricing');
            $table->string('short_caption')->nullable(true)->after('pricing');
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
            $table->dropColumn(['shares', 'like', 'views', 'ratings', 'course_urls', 'short_caption']);
        });
    }
}
