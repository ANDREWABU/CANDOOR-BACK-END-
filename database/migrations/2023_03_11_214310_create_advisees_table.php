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
        Schema::create('advisees', function (Blueprint $table) {
            $table->bigIncrements('AdviseeID');
            $table->string('UserID')->nullable();
            $table->text('about_me')->nullable();
            $table->string('referral_code', 100)->nullable();
            $table->string('hear_about_us', 100)->nullable();
            $table->json('apply_notes')->nullable();
            $table->timestamp('account_created_timestamp_EST')->nullable();
            $table->json('education_experiences')->nullable();
            $table->timestamp('first_activated_timestamp_EST')->nullable();
            $table->timestamp('first_onboarding_timestamp_EST')->nullable();
            $table->string('first_requested_meeting_id')->nullable();
            $table->string('first_completed_meeting_id')->nullable();
            $table->timestamp('first_completed_meeting_timestamp_EST')->nullable();
            $table->timestamp('first_request_sent_timestamp_EST')->nullable();
            $table->timestamp('first_profile_viewed_timestamp_EST')->nullable();
            $table->string('funnel_status')->default('Account Created');
            $table->string('application_status')->nullable();
            $table->string('headline')->nullable();
            $table->string('profile_goal')->nullable();
            $table->boolean('resume_submitted')->default(false);
            $table->json('industries_all')->nullable();
            $table->text('just_for_fun')->nullable();
            $table->boolean('is_founder')->default(false);
            $table->timestamp('last_about_me_update_timestamp_EST')->nullable();
            $table->timestamp('last_just_for_fun_update_timestamp_EST')->nullable();
            $table->timestamp('last_education_experience_update_timestamp_EST')->nullable();
            $table->timestamp('last_work_experience_update_timestamp_EST')->nullable();
            $table->timestamp('last_location_update_timestamp_EST')->nullable();
            $table->timestamp('last_profile_photo_update_timestamp_EST')->nullable();
            $table->timestamp('last_tags_update_timestamp_EST')->nullable();
            $table->timestamp('last_profile_goal_update_timestamp_EST')->nullable();
            $table->timestamp('last_resume_update_timestamp_EST')->nullable();
            $table->string('last_requested_meeting_id')->nullable();
            $table->string('last_completed_meeting_id')->nullable();
            $table->timestamp('last_requested_meeting_timestamp_EST')->nullable();
            $table->timestamp('last_completed_meeting_timestamp_EST')->nullable();
            $table->timestamp('last_profile_view_timestamp_EST')->nullable();
            $table->timestamp('last_headline_update_timestamp_EST')->nullable();
            $table->timestamp('last_profile_update_timestamp_EST')->nullable();
            $table->timestamp('last_settings_update_timestamp_EST')->nullable();
            $table->timestamp('last_funnel_status_update_timestamp_EST')->nullable();
            $table->integer('lifetime_advisor_cancelled')->default(0);
            $table->integer('lifetime_advisor_no_shows')->default(0);
            $table->integer('lifetime_cancellations')->default(0);
            $table->integer('lifetime_completed_meetings')->default(0);
            $table->integer('lifetime_no_shows')->default(0);
            $table->integer('lifetime_feedback_forms_given')->default(0);
            $table->integer('lifetime_feedback_forms_received')->default(0);
            $table->integer('lifetime_requests_sent')->default(0);
            $table->integer('lifetime_profiles_viewed')->default(0);
            $table->integer('monthly_requests')->default(0);
            $table->integer('monthly_requests_remaining')->default(0);
            $table->string('most_recent_company')->nullable();
            $table->string('most_recent_degree')->nullable();
            $table->string('most_recent_industry')->nullable();
            $table->string('most_recent_role')->nullable();
            $table->string('most_recent_school')->nullable();
            $table->string('most_recent_title')->nullable();
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
            $table->json('services_requested')->nullable();
            $table->timestamp('email_verified_timestamp_EST')->nullable();
            $table->timestamp('signup_education_completed_timestamp_EST')->nullable();
            $table->timestamp('signup_career_completed_timestamp_EST')->nullable();
            $table->timestamp('signup_demographic_completed_timestamp_EST')->nullable();
            $table->timestamp('signup_goals_completed_timestamp_EST')->nullable();
            $table->timestamp('signup_submitted_timestamp_EST')->nullable();
            $table->timestamp('application_accepted_timestamp_EST')->nullable();
            $table->timestamp('application_waitlisted_timestamp_EST')->nullable();
            $table->timestamp('application_rejected_timestamp_EST')->nullable();
            $table->string('university_grad_year', 50)->nullable();
            $table->string('highest_degree_completed')->nullable();
            $table->json('work_experiences')->nullable();
            $table->string('years_work_experience', 10)->nullable();
            $table->integer('comfort_networking_at_signup')->nullable();
            $table->string('job_search_status')->nullable();
            $table->boolean('prescreening_program_opt_in')->nullable();
            $table->text('additional_background_info')->nullable();
            $table->text('initial_career_goals')->nullable();
            $table->text('current_career_goals')->nullable();
            $table->text('why_joined')->nullable();
            $table->json('dream_roles')->nullable();
            $table->json('dream_industries')->nullable();
            $table->json('dream_companies')->nullable();
            $table->boolean('linkedin_profile_added')->default(false);
            $table->string('linkedin_profile_url')->nullable();
            $table->boolean('accepted_signup_commitents')->default(false);
            $table->json('tags_list')->nullable();
            $table->boolean('joined_community')->default(false);
            $table->timestamp('joined_community_timestamp_EST')->nullable();
            $table->timestamps();
            $table->string('cover_profile')->nullable();
            $table->string('resume')->nullable();
            $table->char('dream_locations', 200)->nullable();
            $table->integer('signed_up_with_linkedin')->nullable();
            $table->string('dream_companies_other')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advisees');
    }
};
