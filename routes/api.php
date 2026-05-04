<?php

use App\Http\Controllers\Api\JobPostController;
use App\Http\Controllers\Api\MentorPersonalInfoController;
use App\Http\Controllers\Api\MentorSessionsInformationController;
use App\Http\Controllers\Api\MentorSettingController;
use App\Http\Controllers\Api\SelectedSessionController;
use App\Http\Controllers\Api\V2\ApiGenericController;
use Illuminate\Http\Request;
use App\Http\Controllers\MailTestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V2\VerifyEmailController;
use App\Http\Controllers\Api\V2\ApiAuthController;
use App\Http\Controllers\Api\V2\Advisee\AdvisorDirectoryController;
use App\Http\Controllers\Api\V2\dummycontroller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Api\V2\Advisee\SubmissionController;
use App\Http\Controllers\MeetingCompletionController;
use App\Http\Controllers\ViewMeetingDataController;
use App\Http\Controllers\MeetingReminderController;
use App\Http\Controllers\BookingsReminderController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => 'auth:api'], function () {

    Route::post('/logout', [ApiAuthController::class, 'logout']);
    Route::get('verifyemail/{id}/{token}',[ApiAuthController::class, 'linkVerify']);
    // Email Verification
    Route::post('emailVerification',[ApiAuthController::class, 'emailVerification']);
    Route::get('/userDetails', [ApiAuthController::class, "userDetails"]);

    Route::resource('mySpace', MySpaceController::class);
    Route::get('/mentee-recommended-mentors', [App\Http\Controllers\Api\MySpaceController::class,'recommendedMentors']);
    Route::post('/mentor-by-spaces',[App\Http\Controllers\Api\MySpaceController::class,'mentorBySpace']);
    Route::get('/mentor-Sessions/{id}',[App\Http\Controllers\Api\MySpaceController::class,'mentorSessions']);


    //mentee select session
    Route::post('/save-session',[\App\Http\Controllers\Api\SelectedSessionController::class,'store']);
    Route::post('/save-monthly-session',[\App\Http\Controllers\Api\SelectedSessionController::class,'storeMonthlySession']);
    Route::get('/mentor-upcoming-Sessions',[\App\Http\Controllers\Api\SelectedSessionController::class,'mentorUpcomingSessions']);
    Route::get('/mentor-booked-Sessions',[\App\Http\Controllers\Api\SelectedSessionController::class,'mentorBookedSessions']);
    

    // Get Languages
    Route::get('/getLanguages', 'ApiGenericController@getLanguages');
    // Get Hiring Roles
    Route::get('/getHiringRoles', 'ApiGenericController@getHiringRoles');
    // Get Hiring Budget
    Route::get('/getHiringBudget', 'ApiGenericController@getHiringBudget');

    // Get Cities by Country ID
    Route::get('/getCountryCities/{id}', 'ApiGenericController@getCitiesByCountryId');
    // Get Spaces List
    Route::get('/getSpaces', 'ApiGenericController@getSpacesList');

    // admin api routes

    Route::post('/role/save', 'ApiUserController@userAssignRole');

    // Generic
    Route::get('/role', 'ApiGenericController@getRoles');
    Route::get('/getExperience', 'ApiGenericController@getExperience');
    Route::get('/getDays', 'ApiGenericController@getDays');

    // Profile Status Update
    Route::get('/profileStatus', 'ApiGenericController@profileStatusUpdate');

    // Mentee Setting Route
    Route::post('/profileSetting', 'MenteeSettingController@profileSetting');

    // PersonalInformation Routes

    Route::post('/personalInformation', 'MenteePersonalInfoController@store');
    Route::get('/getPersonalInformation', 'MenteePersonalInfoController@index');
    Route::get('/getUserInfo', 'MenteePersonalInfoController@userInfo');

    //skill routes

    Route::post('/skill', 'MenteeSkillsController@store');
    Route::post('/addSkill', 'MenteeSkillsController@addSkill');
    Route::get('/getSkill', 'MenteeSkillsController@index');
    Route::delete('/deleteskill/{skill}', 'MenteeSkillsController@destroy');

    //WorkExperience routes

    Route::post('/workexperience', 'MenteeWorkExpController@store');
    Route::get('/workexperience/{id}', 'MenteeWorkExpController@show');
    Route::post('/addWorkExperience', 'MenteeWorkExpController@addWorkExperience');
    Route::post('/addWorkExperience/{id}', 'MenteeWorkExpController@editWorkExp');
    Route::get('/getworkexperience', 'MenteeWorkExpController@index');
    Route::delete('/deleteworkexperience/{workExperience}', 'MenteeWorkExpController@destroy');

    // Education detail route

    Route::post('/education', 'MenteeEducationDetailController@store');
    Route::post('/addEducation', 'MenteeEducationDetailController@addEducation');
    Route::post('/addEducation/{id}', 'MenteeEducationDetailController@editEducation');
    Route::get('/geteducation', 'MenteeEducationDetailController@index');
    Route::get('/geteducation/{id}', 'MenteeEducationDetailController@show');
    Route::delete('/deleteeducation/{educationDetail}', 'MenteeEducationDetailController@destroy');

    // mentorpersonal info routes
    Route::resource('mentorPersonalInfo', 'MentorPersonalInfoController');
    Route::get('/mentorInfo', [\App\Http\Controllers\Api\MentorPersonalInfoController::class,'mentorInfo']);

    // mentorSettingRoute
    Route::post('/mentorProfileSetting',[MentorSettingController::class, 'mentorProfileSetting']);
    Route::post('/password-reset',[ApiAuthController::class,'SettingPasswordReset']);
    // mentor expertise routes
    Route::resource('mentorExpertise', MentorExpertiseController::class);
    Route::delete('mentorExpertiseDetails/{id}', 'MentorExpertiseController@expertiseDetailsDestroy');
    Route::resource('mentorAvailability', MentorAvailabilityController::class);

    //slots routes
    Route::get('/mentor-slots/{id}/{dayId}',[SelectedSessionController::class,'slots']);

    //MentorSessionInformationRoutes

    Route::get('/total-Mentees',[MentorSessionsInformationController::class,'totalMentees']);

    // JobPost
    Route::resource('jobPost', 'JobPostController');
    Route::post('/multiplePostDelete','JobPostController@multiplePostDelete');
    Route::post('/postSearch', 'JobPostController@searchFilter');
    Route::post('/postSearchMentee', 'JobPostController@searchFilterMentee');
    Route::get('/getAllJobs', 'JobPostController@getAllJobPosts');
    Route::get('/viewJob/{id}', 'JobPostController@viewJob');

    // Apply to jobs
    Route::resource('jobApplied', AppliedJobController::class);
    Route::get('/getAppliedJobs', 'AppliedJobController@getAppliedJobs');
    Route::get('/getJobApplicants/{id}', 'ApplicantController@jobApplicants');

    // applicants route
    Route::post('/applicantOrderBy/{id}',[\App\Http\Controllers\Api\ApplicantController::class,'applicantOrder']);

    // Job Post Details
    Route::resource('jobPostDetails', JobPostDetailsController::class);

    // Job Post Company Info
    Route::resource('jobPostCompanyInfo', JobPostCompanyInfoController::class);

    // Job Post Account Info
    Route::resource('jobPostAccountInfo', JobPostAccountInfoController::class);

    // GetStarted Api
    // Route::get('/getRole')
    Route::get('userAuth', [ApiAuthController::class,'authCheck']);


    //Profile Apis

        // for advisee -> 
            Route::post('advisees-update-about-me',[ApiAuthController::class,'UpdateAboutMe']);
            Route::get('advisees-get-profile-data', [ApiAuthController::class,'GetAdviseesProfileData']);
            Route::get('advisees-get-profile/{adviseeID}', [AdvisorDirectoryController::class,'getDataForAdviseeProfile']);

            Route::post('advisees-update-just-for-fun',[ApiAuthController::class,'UpdateJustForFun']);
            Route::post('advisees-update-currer-interests',[ApiAuthController::class,'UpdateCareerInterests']);

            // Basic Info-->>>
            Route::get('user-basic-info',[ApiAuthController::class,'BasicInfo']);
            Route::post('user-update-basic-info', [ApiAuthController::class,'updateBasicInfo']);
            Route::get('/download-resume/{location}', [ApiAuthController::class,'downloadResume']);
               //Update when the user clicks join community
            Route::post('/update-joined-community', [ApiAuthController::class, 'UpDateJoinedCommunity']);
            Route::post('/update-funnel-status', [ApiAuthController::class, 'UpDateFunnelStatus']);


        // end

        // For Advisor
            Route::post('advisor-update-about-me',[ApiAuthController::class,'AdvisorUpdateAboutMe']);
            Route::post('advisor-update-just-for-fun',[ApiAuthController::class,'AdvisorUpdateJustForFun']);
            Route::get('advisor-get-profile-data', [ApiAuthController::class,'GetAdvisorProfileData']);
            Route::post('advisor-update-help', [ApiAuthController::class,'AdvisorCanHelp']);

            // Basic Info-->>>
            Route::get('advisor-basic-info',[ApiAuthController::class,'AdvisorBasicInfo']);
            Route::post('advisor-update-basic-info', [ApiAuthController::class,'AdvisorUpdateBasicInfo']);
        // end


    // end

    // onboarding

        // Common Apis
        Route::get('complete-profile', [ApiAuthController::class,'completeProfile']);
        Route::post('update-complete-profile', [ApiAuthController::class,'updateCompleteProfile']);

        // Metting Preference---->>
        Route::get('get-quiz',[ApiAuthController::class, 'GetQuiz']);
        Route::post('save-response-quiz',[ApiAuthController::class, 'SaveOrientationResponse']);
        Route::post('delete-user-services',[ApiAuthController::class, 'DeleteUserService']);
        Route::get('get-meetingtype',[ApiAuthController::class, 'GetMeetingType']);
        Route::get('get-user-services',[ApiAuthController::class, 'GetUserServices']);


    // end
    Route::post('save-meeting-services', [ApiAuthController::class, 'StoreAdvisorService']);
    Route::get('/submit-form-request', [SubmissionController::class,'submit']);
    Route::post('/submit-apply-data', [SubmissionController::class, 'SubmitApplyData']);

    // Seeting :)

    Route::get('/setting-account', [ApiAuthController::class, 'SettingAccount']);
    Route::post('/update-setting-account', [ApiAuthController::class, 'UpdateSettingAccount']);

    // location-timezone :) 

    Route::get('/location-timezone', [ApiAuthController::class, 'LocationTimezone']);
    Route::post('/update-location-timezone', [ApiAuthController::class, 'UpdateLocationTimezone']);
    Route::post('/update-hiring-status', [ApiAuthController::class, 'updateHiringStatus']);
    Route::get('/get-hiring-status', [ApiAuthController::class, 'GetHiringStatus']);

    // Advisor Meeting preferences :)

    Route::get('/setting-preferences', [ApiAuthController::class, 'SettingPreferences']);
    Route::post('/update-setting-preferences', [ApiAuthController::class, 'UpdateSettingPreferences']);

    Route::get('/get-dashboard', [ApiAuthController::class, 'GetDashboard']);
    // MeetingDataView
    Route::get('/view-meeting-data', [ViewMeetingDataController::class,'ViewMeetingData']);
    Route::get('/view-completed-meeting-data', [ViewMeetingDataController::class,'GetCompletedMeetingData']);
    Route::post('/advisor-confirm-meeting', [ApiAuthController::class, 'AdvisorConfirmMeeting']);
    Route::post('/advisee-confirm-meeting', [ApiAuthController::class, 'AdviseeConfirmMeeting']);
    Route::post('/advisee-meeting-outcome', [ApiAuthController::class, 'SetAdviseeMeetingOutcome']);
    Route::post('/advisor-meeting-outcome', [ApiAuthController::class, 'SetAdvisorMeetingOutcome']);


    Route::post('/propose-alternative-time', [ApiAuthController::class, 'ProposeAlternativeTimeAdvisor']);
    Route::post('/propose-alternative-time-advisee', [ApiAuthController::class, 'ProposeAlternativeTimeAdvisee']);

    Route::post('/cancel-meeting', [ApiAuthController::class, 'CancelMeeting']);




});

// Reset all advisee and advisor capacities
Route::get('/reset-capacities', [ApiAuthController::class,'ResetCapacities']);

Route::get('email/verify/{id}/{hash}',[VerifyEmailController::class,'verify']);

// Resend link to verify email
Route::post('/email/verify/resend', [VerifyEmailController::class,'resendEmailVerification']);

Route::post('/register', [ApiAuthController::class,'register']);

Route::post('/login', [ApiAuthController::class,'login']);
Route::get('/callback', [ApiAuthController::class,'handleProviderCallback']);
// Route::get('/test', "MentorExpertiseController@index");
Route::post('emailCheck', [ApiAuthController::class,'emailCheck']);
Route::get('/hear_about_us_options', [ApiAuthController::class,'hear_about_us_options']);

// Forget Password
Route::post('forgetPassword',[ApiAuthController::class,'forgetPassword']);
Route::post('codeVerification',[ApiAuthController::class,'codeVerification']);
Route::post('resendToken',[ApiAuthController::class,'resendToken']);
Route::post('updatePassword',[ApiAuthController::class,'updatePassword']);

Route::get('/get-education-dropdowns',[ApiAuthController::class,'GetEducationDropDowns']);
Route::get('/get-work-dropdowns',[ApiAuthController::class,'GetWorkDropDowns']);
Route::get('/get-referral-codes', [ApiAuthController::class,'GetReferralCodes']);

/*  */

Route::get('/test-email-verify', [MailTestController::class, 'MailTest']);

Route::post('/dummyAdviseeCheck', [dummycontroller::class, 'dummycheck']);


Route::get('/meeting-completed-automation', [MeetingCompletionController::class, 'MeetingCompletedFlow']);
Route::get('/meeting-reminder-automation', [MeetingReminderController::class, 'MeetingReminderFlow']);

Route::get('/bookings-reminder-automation-outstanding-request', [BookingsReminderController::class, 'BookingsReminderFlowOutstandingRequest']);

Route::get('/bookings-reminder-automation-advisor-action', [BookingsReminderController::class, 'BookingsReminderFlowAdvisorAction']);

Route::get('/bookings-reminder-automation-advisee-action', [BookingsReminderController::class, 'BookingsReminderFlowAdviseeAction']);


Route::get('/bookings-reminder-automation-final-outstanding-request', [BookingsReminderController::class, 'FinalBookingsReminderFlowOutstandingRequest']);

Route::get('/bookings-reminder-automation-final-advisor-action', [BookingsReminderController::class, 'FinalBookingsReminderFlowAdvisorAction']);

Route::get('/bookings-reminder-automation-final-advisee-action', [BookingsReminderController::class, 'FinalBookingsReminderFlowAdviseeAction']);

Route::get('/bookings-reminder-expired-meetings', [BookingsReminderController::class, 'BookingsReminderExpired']);


Route::fallback(function() {
    return response([
        'success' => false,
        'message' => 'Route Not Found',
        'statusCode' => 404,
    ],404);
});