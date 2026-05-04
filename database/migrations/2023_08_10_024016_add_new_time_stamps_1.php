<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewTimeStamps1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advisees', function (Blueprint $table) {
            //
            $table->timestamp('last_funnel_status_update_timestamp')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advisees', function (Blueprint $table) {
            //
            $table->dropColumn('last_funnel_status_update_timestamp');
        });
    }
}
