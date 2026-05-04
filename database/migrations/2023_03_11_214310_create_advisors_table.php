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
        Schema::create('advisors', function (Blueprint $table) {
            $table->bigIncrements('AdvisorID');
            $table->string('UserID')->nullable();
            $table->string('hours_generally_free')->nullable();
            $table->string('actively_hiring_confirmation', 100)->nullable();
            $table->string('hear_about_us', 100)->nullable();
            $table->string('referral_code', 100)->nullable();
            $table->text('about_me')->nullable();
            $table->tinyInteger('consent_to_be_featured')->default(1);
            $table->timestamp('Account_created_timestamp_EST')->nullable();
            $table->json('education_experiences')->nullable();
            $table->timestamp('first_activated_timestamp_EST')->nullable();
            $table->timestamp('signup_submitted_timestamp_EST')->nullable();
            $table->timestamp('first_onboarding_timestamp_EST')->nullable();
            $table->string('first_requested_meeting_id')->nullable();
            $table->string('first_completed_meeting_id')->nullable();
            $table->timestamp('first_completed_meeting_timestamp_EST')->nullable();
            $table->timestamp('first_request_received_timestamp_EST')->nullable();
            $table->string('funnel_status')->default('Account Created');
            $table->string('headline')->nullable();
            $table->json('industries_all')->nullable();
            $table->text('just_for_fun')->nullable();
            $table->boolean('is_founder')->default(false);
            $table->timestamp('last_about_me_update_timestamp_EST')->nullable();
            $table->timestamp('last_just_for_fun_update_timestamp_EST')->nullable();
            $table->timestamp('last_education_experience_update_timestamp_EST')->nullable();
            $table->timestamp('last_work_experience_update_timestamp_EST')->nullable();
            $table->timestamp('last_location_update_timestamp_EST')->nullable();
            $table->timestamp('last_profile_photo_update_timestamp_EST')->nullable();
            $table->timestamp('last_profile_video_update_timestamp_EST')->nullable();
            $table->timestamp('last_tags_update_timestamp_EST')->nullable();
            $table->string('last_requested_meeting_id')->nullable();
            $table->string('last_completed_meeting_id')->nullable();
            $table->timestamp('last_requested_meeting_timestamp_EST')->nullable();
            $table->timestamp('last_completed_meeting_timestamp_EST')->nullable();
            $table->timestamp('last_headline_update_timestamp_EST')->nullable();
            $table->timestamp('last_profile_update_timestamp_EST')->nullable();
            $table->timestamp('last_settings_update_timestamp_EST')->nullable();
            $table->timestamp('last_funnel_status_update_timestamp_EST')->nullable();
            $table->integer('lifetime_advisee_cancelled')->default(0);
            $table->integer('lifetime_advisee_no_shows')->default(0);
            $table->integer('lifetime_cancellations')->default(0);
            $table->integer('lifetime_completed_meetings')->default(0);
            $table->integer('lifetime_no_shows')->default(0);
            $table->integer('lifetime_advisee_profile_views')->default(0);
            $table->integer('lifetime_feedback_forms_given')->default(0);
            $table->integer('lifetime_feedback_forms_received')->default(0);
            $table->integer('lifetime_requests_received')->default(0);
            $table->integer('monthly_capacity')->default(0);
            $table->integer('monthly_capacity_remaining')->default(0);
            $table->string('most_recent_company')->nullable();
            $table->string('most_recent_degree')->nullable();
            $table->string('most_recent_role')->nullable();
            $table->string('most_recent_title')->nullable();
            $table->string('most_recent_school')->nullable();
            $table->string('officehours_email')->nullable();
            $table->integer('onboarding_confidence_level')->nullable();
            $table->string('onboarding_feedback')->nullable();
            $table->timestamp('onboarding_profile_completed_timestamp_EST')->nullable();
            $table->boolean('onboarding_profile_is_complete')->default(false);
            $table->boolean('onboarding_signed_agreement')->default(false);
            $table->timestamp('onboarding_signed_agreement_timestamp_EST')->nullable();
            $table->boolean('onboarding_watched_orientation_video')->default(false);
            $table->timestamp('onboarding_watched_orientation_video_timestamp_EST')->nullable();
            $table->json('roles_all')->nullable();
            $table->json('companies_all')->nullable();
            $table->json('fields_of_study_all')->nullable();
            $table->json('services_offered')->nullable();
            $table->timestamp('email_verified_timestamp_EST')->nullable();
            $table->timestamp('signup_education_completed_timestamp_EST')->nullable();
            $table->timestamp('signup_career_completed_timestamp_EST')->nullable();
            $table->timestamp('signup_demographic_completed_timestamp_EST')->nullable();
            $table->timestamp('signup_ways_to_help_completed_timestamp_EST')->nullable();
            $table->string('university_grad_year', 50)->nullable();
            $table->string('highest_degree_completed')->nullable();
            $table->longText('prior_experience')->nullable();
            $table->longText('joining_reason')->nullable();
            $table->json('work_experiences')->nullable();
            $table->string('why_joined')->nullable();
            $table->string('years_work_experience', 20)->nullable();
            $table->boolean('actively_hiring')->default(false);
            $table->boolean('prescreening_program_opt_in')->nullable();
            $table->boolean('profile_video_bool')->default(false);
            $table->json('tags_list')->nullable();
            $table->boolean('joined_community')->default(false);
            $table->timestamp('joined_community_timestamp_EST')->nullable();
            $table->timestamps();
            $table->string('cover_profile')->nullable();
            $table->string('profile_goal')->nullable();
            $table->string('profile_video')->nullable();
            $table->text('help')->nullable();
            $table->string('offer_meeting_each_month')->nullable();
            $table->string('availability_time')->nullable();
            $table->integer('signed_up_with_linkedin')->nullable();
            $table->tinyInteger('set_meeting_preferences')->nullable()->default(0);
            $table->timestamp('set_meeting_preferences_timestamp_EST')->nullable();
            $table->timestamp('account_created_timestamp')->nullable();
            $table->timestamp('last_funnel_status_update_timestamp')->nullable();
            $table->timestamp('Signup_journey_complete_timestamp')->nullable();
            $table->timestamp('Signup_background_complete_timestamp')->nullable();
            $table->timestamp('First_activated_timestamp')->nullable();
        });
    }

    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advisors');
    }
};
