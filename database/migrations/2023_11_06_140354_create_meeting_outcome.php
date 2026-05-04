<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingOutcome extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('meeting_outcome', function (Blueprint $table) {
//            $table->id();
            $table->increments('id');
//           $table->timestamps();
            $table->unsignedInteger('MeetingID')->nullable()->unique();
//            $table->foreign('MeetingID')->references('id')->on('meetings');
            $table->string('meetingoutcome',255)->nullable();
            $table->string('advisor_continue',255)->nullable();
            $table->string('advisee_continue',255)->nullable();
            $table->timestamp('advisee_thankyou_sent')->nullable();
            $table->unsignedInteger('advisee_meetingfinalized')->nullable();
            $table->unsignedInteger('advisor_meetingfinalized')->nullable();
            $table->string('advisor_feedback',255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meeting_outcome');
    }
}
