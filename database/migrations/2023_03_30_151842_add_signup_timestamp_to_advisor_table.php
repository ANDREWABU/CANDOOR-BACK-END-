<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSignupTimestampToAdvisorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advisors', function (Blueprint $table) {
            $table->timestamp('Signup_journey_complete_timestamp')->nullable();
            $table->timestamp('Signup_background_complete_timestamp')->nullable();
            $table->timestamp('First_activated_timestamp')->nullable();
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advisors', function (Blueprint $table) {
            $table->dropColumn('Signup_journey_complete_timestamp');
            $table->dropColumn('Signup_background_complete_timestamp');
            $table->dropColumn('First_activated_timestamp');
        });
    }
}
