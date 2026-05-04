<?php

use App\Http\Controllers\Api\V2\DegreeController;
use App\Http\Controllers\Api\V2\SchoolController;
use App\Http\Controllers\Api\V2\FieldOfStudyController;
use App\Http\Controllers\Api\V2\Advisor\MotivationController;
use App\Http\Controllers\Api\V2\Advisor\BackgroundController;
use App\Http\Controllers\Api\V2\ApiGenericController;
use App\Http\Controllers\Api\V2\Advisor\GetEducationController;
use App\Http\Controllers\Api\V2\Advisor\EducationExperienceController;
use App\Http\Controllers\Api\V2\Advisor\SubmissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V2\Advisor\WorkExperienceController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['auth:api','is_advisor']], function () {

    //////////////////////////////
   //// Api for Advisor   //////
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

//    Route::post('/add-highest-degree',[EducationExperienceController::class,'addHighestDegree']);
   Route::post('/add-journey-headline',[EducationExperienceController::class,'addJourneyHeadline']);

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

   // add highest work experience
   Route::post('/add-highest-experiece',[WorkExperienceController::class,'addHighestExperience']);

   // Add Work Experience
   Route::post('/add-work-experience',[WorkExperienceController::class,'add']);

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
  // Add Advisor Background Data
  Route::post('/add-user-background', [BackgroundController::class,'addUserBackground']);
  // Get Advisor Background Data
  Route::get('/get-user-background', [BackgroundController::class,'getUserBackground']);


  //////////////////////////////////////////////
  //// Step 6 Add / Listing Motivation   //////
  /////////////////////////////////////////////
  // Get Data for  Motivation
  Route::get('/get-motivation-data', [MotivationController::class,'index']);
  // Add Advisor motivation Data
  Route::post('/add-motivation-data', [MotivationController::class,'addUserMotivationData']);
 
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


});

Route::fallback(function() {
   return response([
       'success' => false,
       'message' => 'Route Not Found',
       'statusCode' => 404,
   ],404);
});