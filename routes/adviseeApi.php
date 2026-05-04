<?php

use App\Http\Controllers\Api\V2\DegreeController;
use App\Http\Controllers\Api\V2\SchoolController;
use App\Http\Controllers\Api\V2\FieldOfStudyController;
use App\Http\Controllers\Api\V2\Advisee\CarrerController;
use App\Http\Controllers\Api\V2\Advisee\BackgroundController;
use App\Http\Controllers\Api\V2\ApiGenericController;
use App\Http\Controllers\Api\V2\Advisee\GetEducationController;
use App\Http\Controllers\Api\V2\Advisee\EducationExperienceController;
use App\Http\Controllers\Api\V2\Advisee\SubmissionController;
use App\Http\Controllers\Api\V2\Advisee\AdvisorDirectoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V2\Advisee\WorkExperienceController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:api','is_advisee']], function () {

     //////////////////////////////
    //// Api for Advisee   //////
   /////////////////////////////

   //////////////////////////////////////////////
    //// Step 3 Add / Listing Education Experience   //////
   /////////////////////////////////////////////

    //Degrees Listing
    Route::get('/get-degrees',[DegreeController::class,'__invoke']);

    //Schools Listing
    Route::get('/get-schools',[SchoolController::class,'__invoke']);

    //Filed of Studies Listing
    Route::get('/get-filed-of-studies',[FieldOfStudyController::class,'__invoke']);


    //Degrees , Schools , Filed of Studies and Education Data
    Route::get('/get-education-data',[GetEducationController::class,'__invoke']);


    //Add Education
    Route::post('/add-education-experience',[EducationExperienceController::class,'add']);

    Route::post('/add-highest-degree',[EducationExperienceController::class,'addHighestDegree']);

    //Show Education reccord for Edit
    Route::get('/edit-education-experience',[EducationExperienceController::class,'edit']);
    //Update Education reccord 
    Route::put('/update-education-experience',[EducationExperienceController::class,'update']);

    //Delete Education reccord 
    Route::delete('/delete-education-experience',[EducationExperienceController::class,'destroy']);


    //////////////////////////////////////////////
    //// Step 4 Add / Listing Work Experience   //////
   /////////////////////////////////////////////


    //Companies , Industry , Roles  Data
    Route::get('/get-work-experience-data',[WorkExperienceController::class,'listing']);
    Route::get('/get-work-journey-drop-data',[WorkExperienceController::class,'journeyDropData']);

    // Add Work Experience
    Route::post('/add-work-experience',[WorkExperienceController::class,'add']);

     Route::post('/add-highest-experiece-comfort-level',[WorkExperienceController::class,'addHighestExperienceComfort']);

    // Edit Work Experience
    Route::get('/edit-work-experience',[WorkExperienceController::class,'edit']);
    
    // Update Work Experience
    Route::put('/update-work-experience',[WorkExperienceController::class,'update']);
    
    // Delete Work Experience
    Route::delete('/delete-work-experience',[WorkExperienceController::class,'destroy']);

     //////////////////////////////////////////////
    //// Step 5 Add / Listing Background   //////
   /////////////////////////////////////////////

   // Get Data for Background Step
   Route::get('/get-background-data', [BackgroundController::class,'getDataForBackground']);
   // Add Advisee Background Data
   Route::post('/add-user-background', [BackgroundController::class,'addUserBackground']);
   // Get Advisee Background Data
   Route::get('/get-user-background', [BackgroundController::class,'getUserBackground']);


   //////////////////////////////////////////////
   //// Step 6 Add / Listing Carrer   //////
   /////////////////////////////////////////////
   // Get Data for Carer Goal Step
   Route::get('/get-carrer-data', [CarrerController::class,'getDataForCarrer']);
   // Add Advisee Carre Goal
   Route::post('/add-user-carrer-goal', [CarrerController::class,'addUserCarrerGoal']);

   Route::post('/update-user-career-settings', [CarrerController::class,'updateUserCareerSettings']);

   // Get Advisee Carrer Goal
   Route::get('/get-user-carrer-goal', [CarrerController::class,'getUserCarrerGoal']);
    // Get country
    Route::get('/get-countries', [ApiGenericController::class,'getCountries']);
    // Get States by Country ID
    Route::get('/get-country-states/{id}', [ApiGenericController::class,'getStatesByCountryId']);
    // Get Cities by Country ID
    Route::get('/get-country-cities/{id}', [ApiGenericController::class,'getCitiesByCountryId']);

    //////////////////////////////////////////////
    //// Step 7 Submit   //////
   /////////////////////////////////////////////

   // Get Advertisement Channels
   Route::get('/get-advertisement-channels', [ApiGenericController::class,'getAdvertisementChannel']);



    //////////////////////////////////////////////
    //// Meeting Directory  //////
   /////////////////////////////////////////////

   Route::get('/get-filter-data', [AdvisorDirectoryController::class, 'getDataForFilters']);
   //Route::get('/get-advisor-list', [AdvisorDirectoryController::class, 'getDataForAdvisorList']);
   Route::get('/get-advisor-list', [AdvisorDirectoryController::class, 'getDataForAdvisorListRefactor']);
   Route::get('/get-advisor-profile', [AdvisorDirectoryController::class, 'getDataForAdvisorProfile']);
   Route::get('/get-advisee-profile', [AdvisorDirectoryController::class, 'getDataForAdviseeProfile']);
   Route::get('/get-advisor-request-meeting-types', [AdvisorDirectoryController::class, 'getDataForAdvisorMeetingServices']);
   Route::get('/get-advisor-request-open', [AdvisorDirectoryController::class, 'getRequestOpen']);
   
   Route::post('/save-advisor-meeting-request', [AdvisorDirectoryController::class, 'SaveAdvisorMeetingRequest']);
   Route::post('/store-advisor-profile-view', [AdvisorDirectoryController::class, 'StoreAdvisorProfileView']);
   Route::post('/create-new-meeting-instance', [AdvisorDirectoryController::class, 'CreateNewMeetingInstance']);

   
});

Route::fallback(function() {
    return response([
        'success' => false,
        'message' => 'Route Not Found',
        'statusCode' => 404,
    ],404);
});