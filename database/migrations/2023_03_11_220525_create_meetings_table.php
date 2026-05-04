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
        Schema::create('meetings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('AdvisorID')->nullable();
            $table->string('AdviseeID')->nullable();
            $table->string('meeting_status')->nullable();
            $table->string('meetingtype')->nullable();
            $table->string('GoogleCalendar_EventID')->nullable();
            $table->timestamp('request_opened_EST')->nullable();
            $table->timestamp('request_sent_EST')->nullable();
            $table->timestamp('request_first_viewed_EST')->nullable();
            $table->timestamp('meeting_first_confirmed_EST')->nullable();
            $table->timestamp('alternate_times_first_proposed_EST')->nullable();
            $table->timestamp('last_status_update_EST')->nullable();
            $table->timestamp('first_calendar_invite_sent_EST')->nullable();
            $table->timestamp('last_calendar_invite_sent_EST')->nullable();
            $table->string('meeting_length_minutes')->nullable();
            $table->tinyInteger('meeting_occurred')->nullable();
            $table->timestamp('starttime')->nullable();
            $table->timestamp('endtime')->nullable();
            $table->timestamp('cancellation_time_EST')->nullable();
            $table->tinyInteger('advisee_no_show')->nullable();
            $table->tinyInteger('advisor_no_show')->nullable();
            $table->tinyInteger('advisee_cancelled')->nullable();
            $table->tinyInteger('advisor_cancelled')->nullable();
            $table->string('availability_last_provided_by')->nullable();
            $table->timestamp('created_at')->useCurrentOnUpdate()->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('confirmed_timezone')->nullable();
            $table->timestamp('alternate_times_last_proposed_EST')->nullable();
            $table->string('zoom_meeting_ID')->nullable();
            $table->string('zoom_meeting_UUID')->nullable();
            $table->text('zoom_meeting_join_url')->nullable();
            $table->text('zoom_meeting_start_url')->nullable();
            $table->tinyInteger('AdvisorFeedbackSent')->nullable()->default(0);
            $table->tinyInteger('AdviseeFeedbackSent')->nullable()->default(0);
            $table->tinyInteger('AdvisorFeedbackReceived')->nullable()->default(0);
            $table->tinyInteger('AdviseeFeedbackReceived')->nullable()->default(0);
            $table->text('comments')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meetings');
    }
};
