<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('users', 'account_activation_date_counter')){
            Schema::table('users', function (Blueprint $table) {
                //
                $table->timestamp('account_activation_date_counter')->nullable()->after('subscription_date');
                $table->timestamp('subscription_date_counter')->nullable()->after('account_activation_date_counter');
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
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
