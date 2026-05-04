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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('AdvisorID')->nullable();
            $table->string('AdviseeID')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->unique();
            $table->string('email_token')->nullable();
            $table->boolean('email_verified')->default(false);
            $table->string('meeting_email')->nullable();
            $table->boolean('accepted_tcpp')->nullable();
            $table->boolean('affirm_eligibility')->nullable();
            $table->string('awareness_channel')->nullable();
            $table->string('awareness_channel_other')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('timezone')->nullable();
            $table->integer('timezone_UTC_offset')->nullable();
            $table->timestamp('Account_created_datetime_EST')->nullable();
            $table->string('gender')->nullable();
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_disabled')->nullable();
            $table->boolean('is_firstgen')->nullable();
            $table->boolean('is_lgbtq')->nullable();
            $table->boolean('is_lowincome')->nullable();
            $table->boolean('is_subscribed_marketing_email')->default(false);
            $table->boolean('is_veteran')->nullable();
            $table->integer('num_Advisee_referrals_sent')->default(0);
            $table->integer('num_Advisor_referrals_sent')->default(0);
            $table->integer('num_Advisee_referrals_signed_up')->default(0);
            $table->integer('num_Advisor_referrals_signed_up')->default(0);
            $table->string('pronouns')->nullable();
            $table->json('race_ethnicity')->nullable();
            $table->string('referral_code_given')->nullable();
            $table->string('referral_code_used')->nullable();
            $table->boolean('referral_code_used_bool')->default(false);
            $table->boolean('on_pause')->default(false);
            $table->integer('paused_months_left')->default(3);
            $table->json('paused_months')->nullable();
            $table->boolean('Is_deactivated')->default(false);
            $table->string('linkedin_id')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->longText('progress')->nullable();
            $table->json('onboarding_complete')->nullable();
            $table->timestamps();
            $table->tinyInteger('ExcludedEmail')->nullable()->default(0);
            $table->timestamp('Account_created_datetime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
