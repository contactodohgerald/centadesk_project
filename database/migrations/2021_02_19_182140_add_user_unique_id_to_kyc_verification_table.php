<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserUniqueIdToKycVerificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn(' kyc_verifications', 'user_unique_id')){
            Schema::table('kyc_verifications', function (Blueprint $table) {
                //
                $table->string('user_unique_id');
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
        Schema::table('kyc_verifications', function (Blueprint $table) {
            //
        });
    }
}
