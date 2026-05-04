<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_intervals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('meetingID')->nullable();
            $table->string('ActionTakenBy')->nullable();
            $table->string('AdviseeID')->nullable();
            $table->string('AdvisorID')->nullable();
            $table->string('interval_type')->nullable();
            $table->timestamp('created_time')->nullable();
            $table->timestamp('starttime')->nullable();
            $table->timestamp('endtime')->nullable();
            $table->tinyInteger('time_was_accepted')->nullable()->default(0);
            $table->string('timezone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_intervals');
    }
};
