<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Models\User;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use App\Models\PasswordReset;
use Carbon\Carbon;
use App\Mail\OtpViaMail;
use App\Mail\EmailVerify as SendVerificationMail;
use App\Mail\ConfirmMeeting as SendConfirmMeeting;
use App\Mail\ConfirmMeetingAdvisor as SendConfirmAdvisorMeeting;
use App\Mail\RescheduleMeeting as SendRescheduleMeeting;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;
use App\Models\EmailVerify;
use App\Http\Resources\FiledOfStudyResource;
use App\Http\Resources\DegreeResource;
use App\Http\Resources\IndustryResource;
use Helpers;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\Helpers\ApiResponseTrait;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use DateTime;
use DateTimeZone;
use GuzzleHttp\Client;


class ApiAuthController extends Controller
{

    use ApiResponseTrait;

    public function userDetails(Request $request)
    {
        return $this->createNewToken($request->bearerToken());
    }


    public function login(Request $request)
    {

        if($request->has('linkedin_code'))
        {
           return $this->handleProviderLoginCallback($request);
        }
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            //  'user_role_id'=>'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (!$token = auth('api')->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        // $email = $this->sendCode($request->email);
        // $details = [
        //     'title' => 'Reset Password',
        //     'body'  => 'Please',
        //     'token'  => $email->token
        // ];
        // $user = User::where('id',Auth('api')->id())->with('roles')->with('experience')->with('spaces')->get();
        // \Mail::to($request->email)->send(new OtpViaMail($details,$user));
// TESTING MESSAGE SENDING
//        \Mail::to($request->email)->send(new SendVerificationMail($request)); // IN-TOOL METHOD
//        Log::debug('APIAuthController Line 77 - send email to '.$request->email);

        return $this->createNewToken($token);
    }

    public function handleProviderLoginCallback(Request $request)
    {
        try
        {
            $request->validate([
                'linkedin_code' => 'required',
            ]);

            // Get Access Token

            $redirectUrl=env('FRONTEND_URL').'/login';
            
            $response = Http::asForm()->post('https://www.linkedin.com/oauth/v2/accessToken', [
                'grant_type' => 'authorization_code',
                'code' => $request->linkedin_code,
                'client_id' => env('LINKEDIN_CLIENT_ID'),
                'client_secret' => env('LINKEDIN_CLIENT_SECRET'),
                'redirect_uri' => $redirectUrl,
            ]);
           
            if(!$response->successful())
            {
                return $this->respondUnAuthorized();
            }
           
            $token=json_decode($response->body());
            $token=$token->access_token;
           
            // Get user Details
            $user=Socialite::driver('linkedin')->userFromToken($token);
           

            $user = User::where('email', $user->email)->first();
            if($user)
            {
                $token = auth('api')->login($user, true);
                return $this->createNewToken($token);
            }

            return $this->respondUnAuthorized();

        } catch (\Exception$e) {
            
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function GetReferralCodes(Request $request){

        $valid_referral_codes = DB::table('referral_codes')->get();

        return response()->json([
            'statusCode' => 200,
            'Success' => 'Successfully register',
            'message' => 'Request has been processed',
            'referral_codes' => $valid_referral_codes,
        ]);

    }


    //Register a new advisor or new advisee
    public function register(Request $request)
    {
       
        if($request->has('linkedin_code'))
        {

            return $this->handleProviderCallback($request);
        }
        
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|between:2,100',
            'lastname' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
            'type' => ['required',Rule::in(['Advisor','Advisee'])],
        ]);
        
        $userType = $request->type;
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first(),
            ], 400);
        }
        $userDetail = $validator->validated();
        unset($userDetail['type']);
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'email_verified' => 1, //Temporary until we figure out another way
            'Account_created_datetime' => Carbon::now(),
            'affirm_eligibility' => 1,
        ]);

        // event(new Registered($user));
        
        if($request->login_type == 2){

            $vToken = Str::random(50);
            $id = encrypt($user->id);

            User::where('id', $user->id)->update([
                'email_verified' => 1
            ]);
        }else{
            $this->sendEmailVerification($user);
        }
       
       $user->syncRoles($userType);
       
        if($userType=='Advisee'){
            $advisee= DB::table('advisees')->insertGetId([
                'UserID'=>$user->id,
                'Account_created_timestamp' => Carbon::now(),
                'last_funnel_status_update_timestamp' => Carbon::now(),
                'officehours_email' => $user->email,
                'funnel_status'=>'Account Created',
                'monthly_requests'=> 2,
                'monthly_requests_remaining'=> 2,
                'signed_up_with_linkedin' => $request->login_type == 2?1:0,
                'referral_code' => $request->referralCode,
                'hear_about_us' => $request->here_about_us,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            User::where('id', $user->id)->update([
                'accepted_tcpp' => 1,
                'meeting_email' => $request->email,
                'pronouns' => '',
                'Account_created_datetime' => Carbon::now()
            ]);
            $user->update(['AdviseeID'=>$advisee]);
        }
        else
        {
            $advisor= DB::table('advisors')->insertGetId([
                'UserID'=>$user->id,
                'account_created_timestamp' => Carbon::now(),
                'last_funnel_status_update_timestamp' => Carbon::now(),
                'funnel_status'=>'Account Created',
                'monthly_capacity'=>2,
                'monthly_capacity_remaining'=>2,
                'availability_time'=>'',
                'signed_up_with_linkedin' => $request->login_type == 2?1:0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            User::where('id', $user->id)->update([
                'accepted_tcpp' => 1,
                'meeting_email' => $request->email,
                'pronouns' => '',
                'Account_created_datetime' => Carbon::now(),
                'referral_code_used' => $request->referralCode,
                'referral_code_used_bool' => 1,
            ]);
            $user->update(['AdvisorID'=>$advisor]);
            //Add all the meeting types to the advisors profile
            $MeetingTypes = DB::table('meeting_types')->get();
            foreach($MeetingTypes as $meetingType){
                $servicesArr = array(
                    'meeting_type' => $meetingType->name,
                    'time' => 30,
                    'AdvisorID' => $advisor,
                    'UserID' => $user->id,
                    'is_active' => 1
                );
                DB::table('user_services')->insert($servicesArr);
            } 

        }

        $login_result = $this->login($request);

        return response()->json([
            'statusCode' => 200,
            'Success' => 'Successfully register',
            'message' => 'Request has been processed',
            'data' => User::where('email',$request->email)->first(),
            'login_response' => $login_result
        ]);
    }


    public function sendEmailVerification($user)
    {
        
        $vToken = Str::random(50);
        $id = encrypt($user->id);

        User::where('id', $user->id)->update([
            'email_token' => $vToken
        ]);
        $url = \URL::to('api/email/verify/'.$id.'/'.$vToken);
        
        $details = [
            'firstname'  => $user->firstname,
            'email' => $user->email,
            'url'  => $url,
        ];
       
        //\Mail::to($user->email)->send(new SendVerificationMail($details));
        
        return true;

    }

    public function handleProviderCallback(Request $request)
    {
        try
        {
            $request->validate([
                'linkedin_code' => 'required',
                'type' => ['required',Rule::in(['Advisor','Advisee'])],
                'login_type' => 'required',
            ]);

            $redirectUrl=env('FRONTEND_URL').(($request->type=='Advisee') ? '/': '/'.strtolower($request->type).'/').env('LINKEDIN_REDIRECT_URL');
            

            // Get Access Token
            
                $url = "https://www.linkedin.com/oauth/v2/accessToken?grant_type=authorization_code&code=" . $request->linkedin_code . "&redirect_uri=".$redirectUrl ."&client_id=".env('LINKEDIN_CLIENT_ID')."&client_secret=".env('LINKEDIN_CLIENT_SECRET')."";
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_HTTPHEADER => array(
                    'Content-Length:0',
                    'Content-Type: application/json',
                ),
                ));
                
                $response = curl_exec($curl);
                $err      = curl_error($curl);
                curl_close($curl);

                if (!$err) {
                    $response = json_decode($response);
                } else {
                    throw new exception(__METHOD_ . '() ' . $err . ', on line : ' . _LINE__);
                }

        
            if(!$response->access_token)
            {
                return $this->respondUnAuthorized();
            }
          
            $token=$response->access_token;

            // Get user Details
            $user=Socialite::driver('linkedin')->userFromToken($token);
            $userType = $request->type;
            $myuser = $this->findorCreateUser($user,$userType);
            $user = User::where('email', $user->email)->first();
            $token = auth('api')->login($user, true);

            $user->syncRoles($userType);

      
            
            return $this->createNewToken($token);

        } catch (\Exception$e) {
            
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }
    // public function handleProviderCallback(Request $request)
    // {
    //     try
    //     {
            
    //         $response = Socialite::driver('linkedin')->userFromToken($request->authToken);
            
    //         $token = $user->token;
    //         $myuser = $this->findorCreateUser($user);
    //         $user = User::where('email', $user->email)->first();
    //         $token = auth('api')->login($user, true);
    //         return $this->createNewToken($token);

    //     } catch (\Exception$e) {
    //         return response()->json([
    //             'message' => $e->getMessage(),
    //         ]);
    //     }
    // }

    public function findorCreateUser($user,$userType)
    {
        $existingUser = User::where('email', $user->email)->first();
        if ($existingUser) {
            auth('api')->login($existingUser, true);
        } else {
            $newUser = User::create([
                'firstname' => $user->first_name,
                'lastname' => $user->last_name,
                'email' => $user->email,
                'email_verified' => 1,
                'linkedin_id' => $user->id,
                'password' => bcrypt('my-linkedin'),
            ]);

            if($userType=='Advisee'){
                info("Advisee");
                $advisee= DB::table('advisees')->insertGetId(
                    [
                        'UserID'=>$newUser->id,
                        'account_created_timestamp_EST'=>Carbon::parse(now(),'EST')->setTimeZone('EST'),
                        'funnel_status'=>'Account Created',
                ]);
                $newUser->update(['AdviseeID'=>$advisee]);
            }
            else
            {
                info("Advisors");
                $advisor= DB::table('advisors')->insertGetId(
                    [
                        'UserID'=>$newUser->id,
                        'account_created_timestamp_EST'=>Carbon::parse(now(),'EST')->setTimeZone('EST'),
                        'funnel_status'=>'Account Created',
                ]);
                $newUser->update(['AdvisorID'=>$advisor]);
            }
            auth('api')->login($newUser, true);
        }

        return $existingUser;

    }

    protected function createNewToken($token)
    {

        $user = User::where('id',Auth('api')->user()->id)->first();
        $user->user_roles= $user->roles->pluck('name')->toArray();
        unset($user->roles);
        if($user->user_roles[0] == 'Advisor'){
            $onboarding = $user->onboarding_complete?json_decode($user->onboarding_complete):'';
            $funnel_status = DB::table('advisors')->where('UserID', $user->id)->select('funnel_status')->first();
            if($onboarding){
                if($funnel_status != 'Activated'){
                    // if($funnel_status->funnel_status == 'Onboarding' && count($onboarding) == 3){
                    //     DB::table('advisors')->where('UserID', $user->id)->update(['funnel_status' => 'Activated']);
                    // }
                }
            }
            $funnel_status = DB::table('advisors')->where('UserID', $user->id)->select('funnel_status')->first();
        }else{
            $onboarding = $user->onboarding_complete?json_decode($user->onboarding_complete):'';
            $funnel_status = DB::table('advisees')->where('UserID', $user->id)->select('funnel_status')->first();
            if($onboarding){
                if($funnel_status != 'Activated'){
                    // if($funnel_status->funnel_status == 'Onboarding' && count($onboarding) == 2){
                    //     DB::table('advisees')->where('UserID', $user->id)->update(['funnel_status' => 'Activated']);
                    // }
                }
            }
            $funnel_status = DB::table('advisees')->where('UserID', $user->id)->select('funnel_status')->first();
        }
        // dd(\DB::getQueryLog());
        // dd($user);
        return response()->json([
            'status' => 200,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => $user,
            'funnel_status' => $funnel_status->funnel_status,
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'statusCode' => 200,
            'Success' => 'Successfully Logout',
            'message' => 'logout',

        ]);
    }

    public function forgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required'
        ]);
        $checkUser = User::where('email', $request->email)->get();
        if($checkUser->isNotEmpty()){
            $token = rand(100000, 999999);
            while(PasswordReset::where('token',$token)->get()->isNotEmpty()){
                $token = rand(100000, 999999);
            }
            // $resetUpdate = AppUser::where('email',$request->email)->update(['password_reset'=>$code]);
            $vToken = Str::random(150);
            PasswordReset::where('email',$request->email)->delete();
            $insert = PasswordReset::insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => now(),
                'user_verification_token' => $vToken
            ]);
            if($insert){
                $details = [
                    'title' => 'Reset Password',
                    'body'  => 'Please',
                    'token'  => $token
                ];

                //
                $client = new Client();

                $email_reset_make_response = $client->request('POST', 'https://hook.us1.make.com/i56tbhjtwibaovfa2viqgcu5b795n1hk', [	
	            'form_params' => [
                    'email' => $request->email,
	                'token'  => $token
	            ]]);
                //\Mail::to($request->email)->send(new OtpViaMail($details));

                return response()->json([
                    'status' => 'success',
                    'message' => 'Email sent please check your mail',
                    'accessToken' => $vToken
                ]);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Email you entered does not belong to any account',
                ],401);
            }
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'No user found with this email account',
            ],404);
        }

    }

    public function emailVerification(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'token' => 'required',
        ]);
        $data = PasswordReset::where(['email' => $request->email, 'token' => $request->token])->get();
        if($data->isNotEmpty()){
            $user = User::where('email',$request->email)->update([
                'email_verified_at' => now()
            ]);
            return $this->createNewToken($request->bearerToken());
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Token is not verified please try again',
            ],404);
        }
    }

    public function codeVerification(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'code' => 'required'
        ]);
        $data = PasswordReset::where(['email' => $request->email, 'token' => $request->code])->get();
        if($data->isNotEmpty()){
            return response()->json([
                'status' => 'success',
                'message' => 'Token is verified',
                'data' => [],
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'The code does not match, please enter the code sent to you',
            ],404);
        }

    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed',
            'email' => 'required',
            'access_token' => 'required'
        ]);
        $verifyUser = PasswordReset::where(['email' => $request->email, 'user_verification_token' => $request->access_token ])->get();
        if($verifyUser->isNotEmpty()){
            $data = User::where('email',$request->email)->update(['password' => Hash::make($request->password)]);
            if($data){
                PasswordReset::where('email', $request->email)->delete();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Your password successfully updated',
                ]);
            }else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Something went wrong please try again',
                ],401);
            }
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'We are unable to verify your identity',
            ],401);
        }

    }
    public function resendToken(Request $request)
    {
        $request->validate([
            'email' => 'required'
        ]);
        $data = $this->sendCode($request->email);
        if($data){
            $details = [
                'title' => 'Reset Password',
                'body'  => 'Please',
                'token'  => $data->token
            ];
            \Mail::to($request->email)->send(new OtpViaMail($details));
            return response()->json([
                'status' => 'success',
                'message' => 'Email sent please check your mail',
                'accessToken' => $data->user_verification_token
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong, Please try again.',
            ],401);
        }

    }
    public function resendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required'
        ]);
        $user = User::where('email',$request->email)->first();
        if($user){
            $user->id = $user->id;
            $this->sendEmailVerification($user);
            return response()->json([
                'status' => 'success',
                'message' => 'Email sent please check your mail',
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong, Please try again.',
            ],401);
        }

    }
    public function sendCode($email)
    {
        $token = rand(100000, 999999);
        while(PasswordReset::where('token',$token)->get()->isNotEmpty()){
            $token = rand(100000, 999999);
        }
        // $resetUpdate = AppUser::where('email',$request->email)->update(['password_reset'=>$code]);
        $vToken = Str::random(150);
        PasswordReset::where('email',$email)->delete();
        $insert = PasswordReset::insert([
            'email' => $email,
            'token' => $token,
            'created_at' => now(),
            'user_verification_token' => $vToken
        ]);
        return PasswordReset::where('email',$email)->first();
    }

    public function linkVerify($id,$token,Request $request)
    {
        $user_id = decrypt($id);
        $user = User::where(['id' => $user_id, 'remember_token' => $token])->get();
        if($user->isNotEmpty()){
            User::where('id',$user_id)->update(['email_verified_at' => now()]);
            return $this->createNewToken($request->bearerToken());
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid User Link. Please try again!'
            ],401);
        }

    }

    public function authCheck()
    {
        try {
            $user = auth()->userOrFail();
            return response()->json([
                'status' => 'success',
                'user' => $user,
            ]);
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            // do something
            // return $e->getMessage();
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong!',
            ]);
        }

    }

    
    public function emailCheck(Request $request)
    {
        $request->validate([
            'email' => 'email|unique:users,email,except,id'
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Email is unique',
        ]);
    }


    public function hear_about_us_options(Request $request)
    {

        $here_about_us = array(
            "0" => "LinkedIn",
            "1" => "Other Social Media",
            "2" => "Friend",
            "3" => "Colleague",
            "4" => "Search Engine",
            "5" => "School Career Office",
            "6" => "Blog or Article",
            "7" => "Partner Organization",
            "8" => "Employer",
            "9" => "Other",
            "10" => "Know a Founder Personally",
            "11" => "Referred by current user"
        );

        return response()->json([
            'status' => 'success',
            'here_about_us' => $here_about_us,
        ]);
    }



    public function SettingPasswordReset(Request $request)
    {
        $request->validate([
            'email'=>'required|email|exists:users',
            'password'=>'required',
            'new_password'=>'required|string|min:6',
            'password_confirmation'=>'required'
        ]);

        $user = User::where('email', $request->email)->pluck('password');
        if (password_verify($request->password,$user[0]))
        {
            $userUpdatePassword = User::where('email', $request->email)->first();
            $userUpdatePassword->update(['password' => Hash::make($request->new_password)]);

        }else {
            return response()->json(['failed','Error'], 400);
        }

        return Helpers::sendResponseBack('updated','password', 'Password successfully updated', 'Something Went wrong please try again');

    }


    public function GetMeetingType(Request $redirectUrl)
    {
        $MeetingType = DB::table('meeting_types')->get();
        if($MeetingType){
            return response()->json([
                'message' => 'Data Get Successfully',
                'data' => $MeetingType,
            ]);
        }else{
            return response()->json([
                'message' => 'error',
            ]);
        }
    }

    public function GetAdviseesProfileData(Request $request)
    {
        $adviseesData = DB::table('advisees')->where('UserID' ,$request->user()->id)->select('AdviseeID','headline','about_me','initial_career_goals','current_career_goals','just_for_fun','tags_list','cover_profile','profile_goal','resume','monthly_requests_remaining')->first();
        $userData = DB::table('users')->where('id' ,$request->user()->id)->select('id','firstname','lastname','pronouns')->first();
        $backgroundData = DB::table('user_backgrounds')->where('UserID' ,$request->user()->id)->select('id','time_zone','country','state','city')->first();
        $educationExpData = DB::table('education_experiences')->whereIn('UserID' ,[$request->user()->id])->select('EducationExperienceID','school','graduation_year','degree','fields_of_study','is_current','start_date')->orderBy('start_date', 'DESC')->get();
        $workExpData = DB::table('work_experiences')->whereIn('UserID' ,[$request->user()->id])->select('WorkExperienceID','company','title','industry','role','start_date', 'end_date', 'is_current','employment_type','employment_type_other')->orderBy('start_date', 'DESC')->get();
        // Get Time Duration -->> 
        
        foreach($workExpData as $key => $value){
            if($value->is_current == 0){
                if($value->start_date != '' && $value->end_date){
                    $to   =   Carbon::parse($value->start_date);
                    $from =   Carbon::parse($value->end_date);
    
                    $years = $to->diffInYears($from);
                    $months = $to->diffInMonths($from);
    
                    $duration_string = $to->diff($from)->format('%y year %m months');
    
                    if(!str_contains($duration_string, '0 months') && !str_contains($duration_string, '0 year ')){
                        $duration_date = $to->diff($from)->format('%y years %m months');
                    }else if(str_contains($duration_string, '0 months')){
                        $duration_date = $to->diff($from)->format('%y years');
                    }else if(str_contains($duration_string, '0 year')){
                        $duration_date = $to->diff($from)->format('%m months');
                    }else{
                        $duration_date = '';
                    } 
                }else{
                    $duration_date = '';
                }
            }else{
                if($value->start_date != ''){
                    $to   =   Carbon::parse($value->start_date);
                    $from = Carbon::now();
    
                    $years = $to->diffInYears($from);
                    $months = $to->diffInMonths($from);
                    $duration_string = $to->diff($from)->format('%y year %m months');

                    if(!str_contains($duration_string, '0 months') && !str_contains($duration_string, '0 year ')){
                        $duration_date = $to->diff($from)->format('%y years %m months');
                    }else if(str_contains($duration_string, '0 months')){
                        $duration_date = $to->diff($from)->format('%y years');
                    }else if(str_contains($duration_string, '0 year')){
                        $duration_date = $to->diff($from)->format('%m months');
                    }else{
                        $duration_date = '';
                    } 
    
           
                    // if(!str_contains($duration_string, '0 year ') && !str_contains($duration_string, '0 months')){
                    //     $duration_date = $to->diff($from)->format('%y year %m months');  
                    // }

                    // if(!str_contains($duration_string, '0 year')){   
                    //     $duration_date = $to->diff($from)->format('%y year');
                    // }
                    
              
               
                    
                    // if(!str_contains($duration_string, '0 months')){
                    //     $duration_date = $to->diff($from)->format('%m months');
                    // }
                }else{
                    $duration_date = '';
                }

            }


            if($duration_date == '0 years'){
                $duration_date = '0 Months';
            }
            $workExpData[$key]->duration_time = $duration_date;           
        }

    
        foreach($educationExpData as $key => $value){


            if($value->is_current == 0){
                if($value->start_date != '' && $value->graduation_year != ''){

                    // TO date --->> 
                    $TodateMonthArray = Carbon::parse($value->start_date);
                    $tomonth = $TodateMonthArray->format('m');
                    $toyear = $TodateMonthArray->format('Y');
                    $to = Carbon::createFromDate($toyear, $tomonth, 1);

                    // FROM date --->> 
                    $FromdateMonthArray =  Carbon::parse($value->graduation_year);
                    $frommonth = $FromdateMonthArray->format('m');
                    $fromyear = $FromdateMonthArray->format('Y');

                    $from = Carbon::createFromDate($fromyear, $frommonth, 1);


                    // dd($to);
                    $years = $to->diffInYears($from);
                    $months = $to->diffInMonths($from);
                    
                    $duration_string = $to->diff($from)->format('%y year %m months');
                    
                    if(!str_contains($duration_string, '0 months') && !str_contains($duration_string, '0 year ')){
                        $duration_date = $to->diff($from)->format('%y years %m months');
                    }else if(str_contains($duration_string, '0 months')){
                        $duration_date = $to->diff($from)->format('%y years');
                    }else if(str_contains($duration_string, '0 year')){
                        $duration_date = $to->diff($from)->format('%m months');
                    }else{
                        $duration_date = '';
                    } 
                }else{
                    $duration_date = '';
                }
            }else{
                
                if($value->start_date != ''){
                    $to   =   Carbon::parse(strtotime($value->start_date));
                    $from = Carbon::now();
    
                    $years = $to->diffInYears($from);
                    $months = $to->diffInMonths($from);
                    $duration_string = $to->diff($from)->format('%y year %m months');
                    
                    if(!str_contains($duration_string, '0 months') && !str_contains($duration_string, '0 year ')){
                        $duration_date = $to->diff($from)->format('%y years %m months');
                    }else if(str_contains($duration_string, '0 months')){
                        $duration_date = $to->diff($from)->format('%y years');
                    }else if(str_contains($duration_string, '0 year')){
                        $duration_date = $to->diff($from)->format('%m months');
                    }else{
                        $duration_date = '';
                    } 
                    
                    // if(str_contains($duration_string, '0 year 0 months')){
                    //     $duration_date = '';
                    // }
                    // if(!str_contains($duration_string, '0 year ') && !str_contains($duration_string, '0 months')){
                    //     $duration_date = $to->diff($from)->format('%y year %m months');  
                    // }
                    // if(!str_contains($duration_string, '0 year')){   
                    //     $duration_date = $to->diff($from)->format('%y year');
                    // }
                    
                    // if(!str_contains($duration_string, '0 months')){
                    //     $duration_date = $to->diff($from)->format('%m months');
                    // }
                }else{
                    $duration_date = '';
                }
            }
            if($duration_date == '0 years'){
                $duration_date = '0 Months';
            }
            $educationExpData[$key]->education_duration_time = $duration_date;
        }   

        $url = url('/');
        $data=[
            'workExperience' =>$workExpData,
            'advisees' =>$adviseesData,
            'background' =>$backgroundData,
            'educationExperience' =>$educationExpData,
            'userData' =>$userData,
            'baseUrl' => $url,
            'profile' => $url.'/'.$adviseesData->profile_goal,
            'cover_profile' => $url.'/'.$adviseesData->cover_profile,
            'resume' => $url.'/'.$adviseesData->resume,
            'progress' => $request->user()->progress,
        ];
        return response()->json([
            'statusCode' => 200,
            'Success' => 'Successfully Data Fatched',
            'message' => 'Request has been processed',
            'Data' => $data,
        ]);

    }

    public function BasicInfo(Request $request)
    {
        $basicInfo = DB::table('advisees')
            ->leftJoin('users', 'users.id', '=', 'advisees.UserID')
            ->where('UserID' ,$request->user()->id)
            ->select('firstname','lastname','headline','resume','profile_goal','cover_profile','pronouns','tags_list','funnel_status')
        ->first();

        $url = url('/');
        return response()->json([
            "status"=> 200,
            "successMsg" => 'Basic data successfully Fatched',
            'basicInfo' => $basicInfo,
            'baseUrl' => $url,
            'profile' => $basicInfo->profile_goal?$url.'/'.$basicInfo->profile_goal:null,
            'cover_profile' => $basicInfo->cover_profile?$url.'/'.$basicInfo->cover_profile:null,
            'resume' => $basicInfo->resume?$url.'/'.$basicInfo->resume:null,
            'progress' => $request->user()->progress,
        ]);
    }

   
    public function updateBasicInfo(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|between:2,200',
            'lastname' => 'required|string|between:2,200',
            'headline' => 'required|string|between:2,200',
            'tags_list' => 'required|string|between:2,200',
            // 'profile_goal' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
     
        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'message' => 'The server understood the request, but is refusing to fulfill it',
            ]);
        }
    

        $advisee =  DB::table('advisees')->where('UserID', $request->user()->id)->first();
    
        //  For Profile Image----

        $destinationPath = public_path();
        $profilePath ='';
        $coverPath = '';
        $resumePath = '';

        if($request->file('profile_goal')){
            if($advisee->profile_goal){
                File::delete($destinationPath.'/'.$advisee->profile_goal);
            } 
            $imageName = $request->user()->id.'_'.time().'_'.$request->profile_goal->getClientOriginalName(); 
            $request->profile_goal->move(public_path('uploads/users'), $imageName);
            $profilePath = 'uploads/users/'.$imageName;

            DB::table('advisees')->where('UserID', $request->user()->id)->update(['profile_goal' => $profilePath ]);
        }
        
                
        //  For Cover image ------
        if($request->file('cover_profile')){
            if($advisee->cover_profile){
                File::delete($destinationPath.'/'.$advisee->cover_profile);
            }
            $coverName = $request->user()->id.'_'.time().'_'.$request->cover_profile->getClientOriginalName();  
            $request->cover_profile->move(public_path('uploads/users'), $coverName);
            $coverPath = 'uploads/users/'.$coverName;
        }

        //  For Resume ------
        if($request->file('resume')){
            if($advisee->resume){
                File::delete($destinationPath.'/'.$advisee->resume);
            }
            $resumeName = $request->user()->id.'_'.time().'_'.$request->resume->getClientOriginalName();
            $request->resume->move(public_path('uploads/users'), $resumeName);
            $resumePath = 'uploads/users/'.$resumeName;
            // DB::table('advisees')->where('UserID', $request->user()->id)->update(['profile_goal' => $profilePath ]);
        }

        $basicInfoUserArr = array(
            'firstname'=>$request->firstname,
            "lastname" => $request->lastname,
            "pronouns" => $request->pronouns
        );
        $tags_list = $request->tags_list;

        $basicInfoAdviseeArr = array(
            "headline" => $request->headline,
            "tags_list" => $tags_list,
            "cover_profile" => $coverPath?$coverPath:$request->cover_profile,
            "resume_submitted" => $request->resume?1:0, 
            "resume" => $resumePath?$resumePath:$request->resume,
            "last_resume_update_timestamp_EST" => Carbon::parse(now(),'EST')->setTimeZone('EST'),
        );
        if(!empty($request->user()->progress)){
            $obj = json_decode($request->user()->progress);
            $progress =  json_decode(json_encode($obj),true);
            if(array_key_exists("complete_profile", $progress)){
                User::where('id', $request->user()->id)->update($basicInfoUserArr);
                DB::table('advisees')->where('UserID', $request->user()->id)->update($basicInfoAdviseeArr);
            }else{
                $prg_arr = array_merge($progress, ['progress_percent' => count($progress)*20, "complete_profile" => 1 ]);
                DB::table('users')->where('id', $request->user()->id)->update([
                    'progress' => json_encode($prg_arr),
                ]);
                User::where('id', $request->user()->id)->update($basicInfoUserArr);
                DB::table('advisees')->where('UserID', $request->user()->id)->update($basicInfoAdviseeArr);
            }
        }else{
            $prg_arr = ['progress_percent' => 1*20, "complete_profile" => 1 ];
            DB::table('users')->where('id', $request->user()->id)->update([
                'progress' => json_encode($prg_arr),
            ]);
            User::where('id', $request->user()->id)->update($basicInfoUserArr);
            DB::table('advisees')->where('UserID', $request->user()->id)->update($basicInfoAdviseeArr);

        }
        // User::where('id', $request->user()->id)->update($basicInfoUserArr);
        // DB::table('advisees')->where('UserID', $request->user()->id)->update($basicInfoAdviseeArr);
        $basicInfo = DB::table('advisees')
            ->leftJoin('users', 'users.id', '=', 'advisees.UserID')
            ->where('UserID' ,$request->user()->id)
            ->select('firstname','lastname','headline','resume','profile_goal','cover_profile','pronouns','tags_list')
        ->first();
        $progress = DB::table('users')->where('id', $request->user()->id)->select('progress')->first();

        return response()->json([
            'statusCode' => 200,
            'Success' => 'Successfully Updated',
            'message' => 'Request has been processed',
            'data' => $basicInfo,
            'progress' => $progress?$progress->progress:''

        ]);
    }


    public function downloadResume($file_location, Request $request){

        $resumeFile = 'uploads/users/'.$file_location;
        $headers = array(
            'Content-Type: application/pdf',
          );

    return response()->download($resumeFile, 'Resume.pdf', $headers);
    }
		// resets all capacities for advisors and advisees
    public function ResetCapacities(Request $request)
    {
//       Log::debug('APIAuthController 1116');
       
//In advisees table, set monthly_requests_remaining equal to monthly_requests
// select all advisees from advisees table where monthly_requests_remaining is less than monthly_requests
	     $adviseestoreset = DB::table('advisees')
	     ->whereColumn('monthly_requests_remaining', '!=', 'monthly_requests')
	     ->select('AdviseeID','monthly_requests_remaining','monthly_requests')
	     ->get();
	     $adviseecount=0;
				if(isset($adviseestoreset)) {
					foreach($adviseestoreset as $adviseetoreset) {
            DB::table('advisees')
            ->where('AdviseeID', $adviseetoreset->AdviseeID)
            ->update(['monthly_requests_remaining' => $adviseetoreset->monthly_requests]);
            $adviseecount++;
          }
				}
//In advisors table, set monthly_capacity_remaining equal to monthly_capacity    	
// select all advisors from advisors table where monthly_capacity_remaining  is less than monthly_capacity
// for each, update advisees table setting monthly_capacity_remaining = monthly_capacity
	     $advisorstoreset = DB::table('advisors')
	     ->whereColumn('monthly_capacity_remaining', '!=', 'monthly_capacity')
	     ->select('AdvisorID','monthly_capacity_remaining','monthly_capacity')
	     ->get();
			 $advisorcount = 0;
	     if(isset($advisorstoreset)) {
	     	foreach($advisorstoreset as $advisortoreset) {
            DB::table('advisors')
            ->where('AdvisorID', $advisortoreset->AdvisorID)
            ->update(['monthly_capacity_remaining' => $advisortoreset->monthly_capacity]);
            $advisorcount++;
	     	}
	     }
/*
    return response()->json([
        'statusCode' => 200,
        'Success' => 'Success',
        'message' => $adviseecount.' advisees reset. '$advisorcount.' advisors reset. '

    ]);
*/
    }
    public function UpdateAboutMe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'about_me' => 'required|string|between:2,500',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'message' => 'The server understood the request, but is refusing to fulfill it',
            ]);
        }
        if(!empty($request->user()->progress)){
            $obj = json_decode($request->user()->progress);
            $progress =  json_decode(json_encode($obj),true);
            if(array_key_exists("about_me", $progress)){
                DB::table('advisees')->where('UserID', $request->user()->id)->update(['about_me' => $request->about_me]);
            }else{
                $prg_arr = array_merge($progress, ['progress_percent' => count($progress)*20, "about_me" => 1]);
                DB::table('advisees')->where('UserID', $request->user()->id)->update(['about_me' => $request->about_me]);
                DB::table('users')->where('id', $request->user()->id)->update([
                    'progress' => json_encode($prg_arr),
                ]);
            }
        }else{
            $prg_arr = ['progress_percent' => 1*20, "about_me" => 1 ];
            DB::table('advisees')->where('UserID', $request->user()->id)->update(['about_me' => $request->about_me]);
            DB::table('users')->where('id', $request->user()->id)->update([
                'progress' => json_encode($prg_arr),
            ]);
        }
        $progress = DB::table('users')->where('id', $request->user()->id)->select('progress')->first();
        return response()->json([
            'statusCode' => 200,
            'Success' => 'Successfully Updated',
            'message' => 'Request has been processed',
            'progress' => $progress?$progress->progress:'',
        ]);


    }

    public function UpdateJustForFun(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'just_for_fun' => 'required|string|between:2,100',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'message' => 'The server understood the request, but is refusing to fulfill it',
            ]);
        }
        
        
        if(!empty($request->user()->progress)){
            // dd('1st');
            $obj = json_decode($request->user()->progress);
            $progress =  json_decode(json_encode($obj),true);
            if(array_key_exists("just_for_fun", $progress)){
                DB::table('advisees')->where('UserID', $request->user()->id)->update(['just_for_fun' => $request->just_for_fun]);
            }else{
                $prg_arr = array_merge($progress, ['progress_percent' => 100, "just_for_fun" => 1]);
                DB::table('advisees')->where('UserID', $request->user()->id)->update(['just_for_fun' => $request->just_for_fun]);
                DB::table('users')->where('id', $request->user()->id)->update([
                    'progress' => json_encode($prg_arr),
                ]);
            }
        }else{
            $prg_arr = ['progress_percent' => 1*20, "just_for_fun" => 1 ];
            DB::table('advisees')->where('UserID', $request->user()->id)->update(['just_for_fun' => $request->just_for_fun]);
            DB::table('users')->where('id', $request->user()->id)->update([
                'progress' => json_encode($prg_arr),
            ]);
        }
        $progress = DB::table('users')->where('id', $request->user()->id)->select('progress')->first();

        return response()->json([
            'statusCode' => 200,
            'Success' => 'Successfully Updated',
            'message' => 'Request has been processed',
            'progress' => $progress?$progress->progress:'',
        ]);
    }

    public function UpdateCareerInterests(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_career_goals' => 'required|string|between:2,300',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'message' => 'The server understood the request, but is refusing to fulfill it',
            ]);
        }


        if(!empty($request->user()->progress)){
            $obj = json_decode($request->user()->progress);
            $progress =  json_decode(json_encode($obj),true);
            if(array_key_exists("current_career_goals", $progress)){
                DB::table('advisees')->where('UserID', $request->user()->id)->update(['current_career_goals' => $request->current_career_goals]);
            }else{
                $prg_arr = array_merge($progress, ['progress_percent' => count($progress)*20, "current_career_goals" => 1]);
                DB::table('advisees')->where('UserID', $request->user()->id)->update(['initial_career_goals' => $request->current_career_goals]);
                DB::table('users')->where('id', $request->user()->id)->update([
                    'progress' => json_encode($prg_arr),
                ]);
            }
        }else{
            $prg_arr = ['progress_percent' => 1*20, "current_career_goals" => 1 ];
            DB::table('advisees')->where('UserID', $request->user()->id)->update(['initial_career_goals' => $request->current_career_goals]);
            DB::table('users')->where('id', $request->user()->id)->update([
                'progress' => json_encode($prg_arr),
            ]);
        }
        $progress = DB::table('users')->where('id', $request->user()->id)->select('progress')->first();

        return response()->json([
            'statusCode' => 200,
            'Success' => 'Successfully Updated',
            'message' => 'Request has been processed',
            'progress' => $progress?$progress->progress:'',
        ]);
    }

    public function GetAdvisorProfileData(Request $request)
    {
        $advisorData      = DB::table('advisors')->where('UserID' ,$request->user()->id)->select('AdvisorID','headline','about_me','just_for_fun','tags_list','cover_profile','profile_goal','profile_video','help')->first();
        $userData         = DB::table('users')->where('id' ,$request->user()->id)->select('id','firstname','lastname','pronouns')->first();
        $backgroundData   = DB::table('user_backgrounds')->where('UserID' ,$request->user()->id)->select('id','time_zone','country','state','city')->first();
        $educationExpData = DB::table('education_experiences')->whereIn('UserID' ,[$request->user()->id])->select('EducationExperienceID','school','graduation_year','ask_me_about','degree','fields_of_study','is_current','start_date')->orderBy('start_date', 'DESC')->get();
        $workExpData      = DB::table('work_experiences')->whereIn('UserID' ,[$request->user()->id])->select('WorkExperienceID','company','title','industry','role','start_date', 'end_date','ask_me_about','is_current','employment_type')->orderBy('start_date', 'DESC')->get();
        // Get Time Duration -->> 
        
        foreach($workExpData as $key => $value){
            if($value->is_current == 0){
                if($value->start_date != '' && $value->end_date){
                    $to   =   Carbon::parse($value->start_date);
                    $from =   Carbon::parse($value->end_date);
    
                    $years = $to->diffInYears($from);
                    $months = $to->diffInMonths($from);
    
                    $duration_string = $to->diff($from)->format('%y year %m months');
    
                    if(!str_contains($duration_string, '0 months') && !str_contains($duration_string, '0 year ')){
                        $duration_date = $to->diff($from)->format('%y years %m months');
                    }else if(str_contains($duration_string, '0 months')){
                        $duration_date = $to->diff($from)->format('%y years');
                    }else if(str_contains($duration_string, '0 year')){
                        $duration_date = $to->diff($from)->format('%m months');
                    }else{
                        $duration_date = '';
                    } 
                }else{
                    $duration_date = '';
                }
            }else{
                if($value->start_date != ''){
                    $to   =   Carbon::parse($value->start_date);
                    $from = Carbon::now();
    
                    $years = $to->diffInYears($from);
                    $months = $to->diffInMonths($from);
                    $duration_string = $to->diff($from)->format('%y year %m months');

                    if(!str_contains($duration_string, '0 months') && !str_contains($duration_string, '0 year ')){
                        $duration_date = $to->diff($from)->format('%y years %m months');
                    }else if(str_contains($duration_string, '0 months')){
                        $duration_date = $to->diff($from)->format('%y years');
                    }else if(str_contains($duration_string, '0 year')){
                        $duration_date = $to->diff($from)->format('%m months');
                    }else{
                        $duration_date = '';
                    } 
    
                    // if(str_contains($duration_string, '0 year 0 months')){
                    //     $duration_date = '0 Months';
                    // }
                    // if(!str_contains($duration_string, '0 year ') && !str_contains($duration_string, '0 months')){
                    //     $duration_date = $to->diff($from)->format('%y year %m months');  
                    // }

                    // if(!str_contains($duration_string, '0 year')){   
                    //     $duration_date = $to->diff($from)->format('%y year');
                    // }
                    
              
               
                    
                    // if(!str_contains($duration_string, '0 months')){
                    //     $duration_date = $to->diff($from)->format('%m months');
                    // }
                }else{
                    $duration_date = '';
                }

            }
            if($duration_date == '0 years'){
                $duration_date = '0 Months';
            }
            $workExpData[$key]->duration_time = $duration_date;           
        }
        // For education Duration
        foreach($educationExpData as $key => $value){


            if($value->is_current == 0){
                if($value->start_date != '' && $value->graduation_year != ''){

                    // TO date --->> 
                    $TodateMonthArray = Carbon::parse($value->start_date);
                    $tomonth = $TodateMonthArray->format('m');
                    $toyear = $TodateMonthArray->format('Y');
                    $to = Carbon::createFromDate($toyear, $tomonth, 1);

                    // FROM date --->> 
                    $FromdateMonthArray =  Carbon::parse($value->graduation_year);
                    $frommonth = $FromdateMonthArray->format('m');
                    $fromyear = $FromdateMonthArray->format('Y');

                    $from = Carbon::createFromDate($fromyear, $frommonth, 1);


                    // dd($to);
                    $years = $to->diffInYears($from);
                    $months = $to->diffInMonths($from);
                    
                    $duration_string = $to->diff($from)->format('%y year %m months');
                    
                    if(!str_contains($duration_string, '0 months') && !str_contains($duration_string, '0 year ')){
                        $duration_date = $to->diff($from)->format('%y years %m months');
                    }else if(str_contains($duration_string, '0 months')){
                        $duration_date = $to->diff($from)->format('%y years');
                    }else if(str_contains($duration_string, '0 year')){
                        $duration_date = $to->diff($from)->format('%m months');
                    }else{
                        $duration_date = '';
                    } 
                }else{
                    $duration_date = '';
                }
            }else{
                
                if($value->start_date != ''){
                    $to   =   Carbon::parse(strtotime($value->start_date));
                    $from = Carbon::now();
    
                    $years = $to->diffInYears($from);
                    $months = $to->diffInMonths($from);
                    $duration_string = $to->diff($from)->format('%y year %m months');
                    
                    if(!str_contains($duration_string, '0 months') && !str_contains($duration_string, '0 year ')){
                        $duration_date = $to->diff($from)->format('%y years %m months');
                    }else if(str_contains($duration_string, '0 months')){
                        $duration_date = $to->diff($from)->format('%y years');
                    }else if(str_contains($duration_string, '0 year')){
                        $duration_date = $to->diff($from)->format('%m months');
                    }else{
                        $duration_date = '';
                    } 
                    
                    // if(str_contains($duration_string, '0 year 0 months')){
                    //     $duration_date = '';
                    // }
                    // if(!str_contains($duration_string, '0 year ') && !str_contains($duration_string, '0 months')){
                    //     $duration_date = $to->diff($from)->format('%y year %m months');  
                    // }
                    // if(!str_contains($duration_string, '0 year')){   
                    //     $duration_date = $to->diff($from)->format('%y year');
                    // }
                    
                    // if(!str_contains($duration_string, '0 months')){
                    //     $duration_date = $to->diff($from)->format('%m months');
                    // }
                }else{
                    $duration_date = '';
                }
            }
            if($duration_date == '0 years'){
                $duration_date = '0 Months';
            }
            $educationExpData[$key]->education_duration_time = $duration_date;
        }   
        $progress_bar = DB::table('users')->where('id' ,$request->user()->id)->select('progress')->first();

        
       
        $data=[
            'workExperience' =>$workExpData,
            'advisor' =>$advisorData,
            'background' =>$backgroundData,
            'educationExperience' =>$educationExpData,
            'userData' =>$userData,
            'progress' => $progress_bar->progress,
        ];
        return response()->json([
            'statusCode' => 200,
            'Success' => 'Successfully Data Fatched',
            'message' => 'Request has been processed',
            'Data' => $data,
        ]);

    }

    public function AdvisorUpdateAboutMe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'about_me' => 'required',
        ]);

        $advisor = DB::table('advisors')->where('UserID', $request->user()->id)->first();

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'message' => 'The server understood the request, but is refusing to fulfill it',
            ]);
        }

        //  For Advisor Video ------
        $destinationPath = public_path();
        $videoPath = '';
        if($request->file('profile_video')){
            if($advisor->profile_video){
                File::delete($destinationPath.'/'.$advisor->profile_video);
            } 
            $advisorVideo = $request->user()->id.'_'.time().'_'.$request->profile_video->getClientOriginalName(); 
            $request->profile_video->move(public_path('uploads/users'), $advisorVideo);
            $videoPath = 'uploads/users/'.$advisorVideo;
            
        }

        if(!empty($request->user()->progress)){
            $obj = json_decode($request->user()->progress);
            $progress =  json_decode(json_encode($obj),true);
            if(array_key_exists("about_me", $progress)){
                DB::table('advisors')->where('UserID', $request->user()->id)->update([
                    'about_me' => $request->about_me,
                    'profile_video_bool'=> $videoPath?1:0,
                    'profile_video' => $videoPath?$videoPath:$request->profile_video,
        
                ]);
            }else{
                $prg_arr = array_merge($progress, ['progress_percent' => count($progress)*20, "about_me" => 1]);
                DB::table('advisors')->where('UserID', $request->user()->id)->update([
                    'about_me' => $request->about_me,
                    'profile_video_bool'=> $videoPath?1:0,
                    'profile_video' => $videoPath?$videoPath:$request->profile_video,
        
                ]);
                DB::table('users')->where('id', $request->user()->id)->update([
                    'progress' => json_encode($prg_arr),
                ]);
            }
        }else{
            $prg_arr = ['progress_percent' => 1*20, "about_me" => 1 ];
            DB::table('advisors')->where('UserID', $request->user()->id)->update([
                'about_me' => $request->about_me,
                'profile_video_bool'=> $videoPath?1:0,
                'profile_video' => $videoPath?$videoPath:$request->profile_video,
    
            ]);
            DB::table('users')->where('id', $request->user()->id)->update([
                'progress' => json_encode($prg_arr),
            ]);
        }
        

        
        
        return response()->json([
            'statusCode' => 200,
            'Success' => 'Successfully Updated',
            'message' => 'Request has been processed',
        ]);
    }

    public function AdvisorUpdateJustForFun(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'just_for_fun' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'message' => 'The server understood the request, but is refusing to fulfill it',
            ]);
        }


        if(!empty($request->user()->progress)){
            $obj = json_decode($request->user()->progress);
            $progress =  json_decode(json_encode($obj),true);
            if(array_key_exists("just_for_fun", $progress)){
                DB::table('advisors')->where('UserID', $request->user()->id)->update([
                    'just_for_fun' => $request->just_for_fun
                ]);
            }else{
                $prg_arr = array_merge($progress, ['progress_percent' => count($progress)*20, "just_for_fun" => 1]);
                DB::table('advisors')->where('UserID', $request->user()->id)->update([
                    'just_for_fun' => $request->just_for_fun
                ]);
                DB::table('users')->where('id', $request->user()->id)->update([
                    'progress' => json_encode($prg_arr),
                ]);
            }
        }else{
            $prg_arr = ['progress_percent' => 1*20, "just_for_fun" => 1 ];
            DB::table('advisors')->where('UserID', $request->user()->id)->update([
                'just_for_fun' => $request->just_for_fun
            ]);
            DB::table('users')->where('id', $request->user()->id)->update([
                'progress' => json_encode($prg_arr),
            ]);
        }
        
        return response()->json([
            'statusCode' => 200,
            'Success' => 'Successfully Updated',
            'message' => 'Request has been processed',
        ]);


    }

    public function AdvisorCanHelp(Request $request)
    {

        if(!empty($request->user()->progress)){
            $obj = json_decode($request->user()->progress);
            $progress =  json_decode(json_encode($obj),true);
            if(array_key_exists("help", $progress)){
                DB::table('advisors')->where('UserID', $request->user()->id)->update(['help' => $request->help]);
            }else{
                $prg_arr = array_merge($progress, ['progress_percent' => count($progress)*20, "help" => 1]);
                DB::table('advisors')->where('UserID', $request->user()->id)->update(['help' => $request->help]);
                DB::table('users')->where('id', $request->user()->id)->update([
                    'progress' => json_encode($prg_arr),
                ]);
            }
        }else{
            $prg_arr = ['progress_percent' => 1*20, "help" => 1 ];
            DB::table('advisors')->where('UserID', $request->user()->id)->update(['help' => $request->help]);
            DB::table('users')->where('id', $request->user()->id)->update([
                'progress' => json_encode($prg_arr),
            ]);
        }
        return response()->json([
            'statusCode' => 200,
            'Success' => 'Successfully Updated',
            'message' => 'Request has been processed',
        ]);
    }

    public function AdvisorBasicInfo(Request $request)
    {
        $basicInfo = DB::table('advisors')
        ->leftJoin('users', 'users.id', '=', 'advisors.UserID')
        ->where('UserID' ,$request->user()->id)
        ->select('firstname','lastname','headline','profile_goal','cover_profile','pronouns','tags_list')
        ->first();
        $url = url('/');
        return response()->json([
            "status"=> 200,
            "successMsg" => 'Basic data successfully Fatched',
            'basicInfo' => $basicInfo,
            'baseUrl' => $url,
            'profile' => $basicInfo->profile_goal?$url.'/'.$basicInfo->profile_goal:'',
            'cover_profile' => $basicInfo->cover_profile?$url.'/'.$basicInfo->cover_profile:'',
        ]);
    }

    public function AdvisorUpdateBasicInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|between:2,200',
            'lastname' => 'required|string|between:2,200',
            'headline' => 'required|string|between:2,200',
            'tags_list' => 'required',
            // 'profile_goal' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'message' => 'The server understood the request, but is refusing to fulfill it',
            ]);
        }

        $advisee =  DB::table('advisors')->where('UserID', $request->user()->id)->first();
    

        //  For Profile Image----
        $profilePath = '';
        $coverPath = '';
        $destinationPath = public_path();
        
        
        if($request->file('profile_goal')){
            if($advisee->profile_goal){
                File::delete($destinationPath.'/'.$advisee->profile_goal);
            } 
            $imageName = $request->user()->id.'_'.time().'_'.$request->profile_goal->getClientOriginalName(); 
            $request->profile_goal->move(public_path('uploads/users'), $imageName);
            $profilePath = 'uploads/users/'.$imageName;
        }
        

        
        // dd($imageName);
        
        //  For Cover image ------
        if($request->file('cover_profile')){
            if($advisee->cover_profile){
                File::delete($destinationPath.'/'.$advisee->cover_profile);
            }
            $coverName = $request->user()->id.'_'.time().'_'.$request->cover_profile->getClientOriginalName();  
            $request->cover_profile->move(public_path('uploads/users'), $coverName);
            $coverPath = 'uploads/users/'.$coverName;
        }

       

        $basicInfoUserArr = array(
            'firstname'=>$request->firstname,
            "lastname" => $request->lastname,
            "pronouns" => $request->pronouns
        );
        $tags_list = $request->tags_list;

        $basicInfoAdviseeArr = array(
            "headline" => $request->headline,
            "tags_list" => $tags_list,
            "profile_goal" => $profilePath?$profilePath:$request->profile_goal,
            "cover_profile" => $coverPath?$coverPath:$request->cover_profile,
        );
        // dd($basicInfoAdviseeArr);

        if(!empty($request->user()->progress)){
            $obj = json_decode($request->user()->progress);
            $progress =  json_decode(json_encode($obj),true);
            if(array_key_exists("complete_profile", $progress)){
                User::where('id', $request->user()->id)->update($basicInfoUserArr);
                DB::table('advisors')->where('UserID', $request->user()->id)->update($basicInfoAdviseeArr);
            }else{
                $prg_arr = array_merge($progress, ['progress_percent' => count($progress)*20, "complete_profile" => 1]);
                User::where('id', $request->user()->id)->update($basicInfoUserArr);
                DB::table('advisors')->where('UserID', $request->user()->id)->update($basicInfoAdviseeArr);
                DB::table('users')->where('id', $request->user()->id)->update([
                    'progress' => json_encode($prg_arr),
                ]);
            }
        }else{
            $prg_arr = ['progress_percent' => 1*20, "complete_profile" => 1 ];
            User::where('id', $request->user()->id)->update($basicInfoUserArr);
            DB::table('advisors')->where('UserID', $request->user()->id)->update($basicInfoAdviseeArr);
            DB::table('users')->where('id', $request->user()->id)->update([
                'progress' => json_encode($prg_arr),
            ]);
        }

       

        return response()->json([
            'statusCode' => 200,
            'Success' => 'Successfully Updated',
            'message' => 'Request has been processed',
        ]);
    }

    public function completeProfile(Request $request)
    {
        if($request->user()->hasRole('Advisee')){

            $completeProfileData = DB::table('advisees')
            ->where('UserID' ,$request->user()->id)
            ->select('headline','profile_goal','about_me','current_career_goals','tags_list')
            ->first();
            $url = url('/');

            return response()->json([
                "status"=> 200,
                "successMsg" => 'Basic data successfully Fatched',
                'completeProfileData' => $completeProfileData,
                'base_url' => $url,
              
               
            
            ]);
        }else if($request->user()->hasRole('Advisor')){
            $completeProfileData = DB::table('advisors')
            ->where('UserID' ,$request->user()->id)
            ->select('headline','profile_goal','about_me','help','tags_list')
            ->first();
            
            $url = url('/');
           
            
            return response()->json([
                "status"=> 200,
                "successMsg" => 'Basic data successfully Fatched',
                'completeProfileData' => $completeProfileData,
                'user' => $request->user(),
                'base_url' => $url,

            ]);
        }else{
            return response()->json([
                "status"=> 401,
                "messsage" => 'unauthorized or expire login token',
            ]);
        }
    }

    public function updateCompleteProfile(Request $request)
    {

        if($request->user()->hasRole('Advisee')){
          
            $validator = Validator::make($request->all(), [
                'headline' => 'required|string|between:2,100',
                'tags_list' => 'required',
                'about_me' => 'required|string',
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 400,
                    'message' => 'The server understood the request, but is refusing to fulfill it',
                ]);
            }

            $advisee =  DB::table('advisees')->where('UserID', $request->user()->id)->first();

            if($request->file('profile_goal')){
                $destinationPath = public_path();
                $imagePath = '';
                if($request->file('profile_goal')){
                    if($advisee->profile_goal){
                        File::delete($destinationPath.'/'.$advisee->profile_goal);
                    } 
                    $imageName = $request->user()->id.'_'.time().'_'.$request->profile_goal->getClientOriginalName(); 
                    // $imageName = $request->user()->id.'_'.time().'_'.$request->profile_goal; 
                    $request->profile_goal->move(public_path('uploads/users'), $imageName);
                    
                    $imagePath = 'uploads/users/'.$imageName;
                    
                }
                DB::table('advisees')->where('UserID' ,$request->user()->id)
                ->update(['profile_goal' => $imagePath ]);
            }
            DB::table('advisees')->where('UserID' ,$request->user()->id)
            ->update([
                'headline' => $request->headline,
                'tags_list' => $request->tags_list,
                'about_me' => $request->about_me,
                'funnel_status' => 'Activated',
                'last_funnel_status_update_timestamp'=>Carbon::now(),
                'First_activated_timestamp'=>Carbon::now()
            ]);
// Shouldn't First_activated_timestamp only update if it's the first time they've had this funnel_status 'Activated'? - JMS 9.22.2023
/// SEND ACTIVATION MAIL HERE
						$maildata = array();
						$maildata['to'] =  $request->user()->email;
						$maildata['firstname'] = $request->user()->firstname;
						$maildata['subject'] = "Welcome to Candoor!";
		        $result = $this->sendmakewebhook('advisee_welcome',$maildata);
//		        $json_pretty = json_encode($maildata, JSON_PRETTY_PRINT);
//		        Log::debug('APIAuthController Line 1784 :: '.$json_pretty);
            
            
            DB::table('advisees')->where('UserID', $request->user()->id)->update(['onboarding_profile_is_complete' => 1, 'onboarding_profile_completed_timestamp_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST')]);

            if($request->user()->onboarding_complete){

                $obj = json_decode($request->user()->onboarding_complete);
                $onboarding_complete =  json_decode(json_encode($obj),true);
                if(!in_array("complete_profile", $onboarding_complete)){
                    $completeArr = array_merge($onboarding_complete, ["complete_profile"]);
                    DB::table('users')->where('id', $request->user()->id)->update(['onboarding_complete' => json_encode($completeArr)]);
                    
                }
            }else{
                $completeArr = ["complete_profile"];
                DB::table('users')->where('id', $request->user()->id)->update(['onboarding_complete' => json_encode($completeArr)]);
            }

            $completeProfileData = DB::table('advisees')
            ->where('UserID' ,$request->user()->id)
            ->select('headline','profile_goal','about_me','current_career_goals','tags_list')
            ->first();

            $url = url('/');
            
            return response()->json([
                "status"=> 200,
                "successMsg" => 'Basic data successfully Fatched',
                'completeProfileData' => $completeProfileData,
                'base_url' => $url,
            ]);
        }else if($request->user()->hasRole('Advisor')){

            $validator = Validator::make($request->all(), [
                'tags_list' => 'required',
                'about_me' => 'required|string',
            ]);
            if($validator->fails()){
                return response()->json([
                    'status' => 400,
                    'message' => 'Invalid input',
                ]);
            }
            
            $advisor =  DB::table('advisors')->where('UserID', $request->user()->id)->first();
            if($request->file('profile_goal')){
                $destinationPath = public_path();
                $imagePath = '';
                if($request->file('profile_goal')){
                    if($advisor->profile_goal){
                        File::delete($destinationPath.'/'.$advisor->profile_goal);
                    } 
                    $imageName = $request->user()->id.'_'.time().'_'.$request->profile_goal->getClientOriginalName(); 
                    $request->profile_goal->move(public_path('uploads/users'), $imageName);
                    $imagePath = 'uploads/users/'.$imageName;
                }
                DB::table('advisors')
                ->where('UserID' ,$request->user()->id)
                ->update([ 'profile_goal' => $imagePath ]);
            }
            DB::table('advisors')
            ->where('UserID' ,$request->user()->id)
            ->update([
                'tags_list' => $request->tags_list,
                'about_me' => $request->about_me,
                'consent_to_be_featured' => $request->consent_to_be_featured,
                'hear_about_us' => $request->how_did_you_hear_about_us,
                'funnel_status' => 'Activated',
                'last_funnel_status_update_timestamp'=>Carbon::now(),
                'First_activated_timestamp'=>Carbon::now(),
            ]);
// Shouldn't First_activated_timestamp only update if it's the first time they've had funnel_status 'Activated'? - JMS 9.22.2023
/// SEND ADVISOR ACTIVATION MAIL HERE ... EVENTUALLY

            DB::table('advisors')->where('UserID', $request->user()->id)->update(['onboarding_profile_is_complete' => 1, 'onboarding_profile_completed_timestamp_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST')]);

            if($request->user()->onboarding_complete){

                $obj = json_decode($request->user()->onboarding_complete);
                $onboarding_complete =  json_decode(json_encode($obj),true);
                if(!in_array("complete_profile", $onboarding_complete)){
                    $completeArr = array_merge($onboarding_complete, ["complete_profile"]);
                    DB::table('users')->where('id', $request->user()->id)->update(['onboarding_complete' => json_encode($completeArr)]);
                }
            }else{
                $completeArr = ["complete_profile"];
                DB::table('users')->where('id', $request->user()->id)->update(['onboarding_complete' => json_encode($completeArr)]);
            }
            // $obj = json_decode($request->user()->progress);
            // $progress =  json_decode(json_encode($obj),true);
            // $prg_arr = array_merge($progress, ['progress_percent' => 80, "about_me" => 1, "help" => 1, "complete_profile" => 1]);
            // DB::table('users')->where('id', $request->user()->id)->update([
                // 'progress' => json_encode($prg_arr),
            // ]);

            $completeProfileData = DB::table('advisors')
            ->where('UserID' ,$request->user()->id)
            ->select('headline','profile_goal','about_me','help','tags_list')
            ->first();
            $url = url('/');

            //Send Advisor Welcome Email
            $client = new Client();
            $AdvisorData = DB::table('users')->where('id', $request->user()->id)->first();    
            $advisor_make_response = $client->request('POST', 'https://hook.us1.make.com/r1ftyoz2q661eknwm6mqimm486pjjcoq', [
                'form_params' => [
                    'advisor_meeting_email' => $AdvisorData->meeting_email,
                    'subject' => 'Welcome To Candoor!',
                    'advisor_first_name' => $AdvisorData->firstname,
                    'advisor_last_name' =>  $AdvisorData->lastname,
                ]
            ]);


            return response()->json([
                "status"=> 200,
                "successMsg" => 'Basic data successfully Fatched',
                'completeProfileData' => $completeProfileData,
                'base_url' => $url,
            ]);

     

        }else{
            return response()->json([
                "status"=> 401,
                "messsage" => 'unauthorized or expire login token',
            ]);
        }
    }

    public function StoreAdvisorService(Request $request)
    {
        $services =  DB::table('user_services')->where('AdvisorID', $request->user()->AdvisorID)->first();
        $meetingType = $request->meeting_type?json_decode($request->meeting_type):'';
        $meetingTime = $request->time?json_decode($request->time):'';

        if($meetingType){
            if($services){
                DB::table('user_services')->whereIn('AdvisorID', [$request->user()->AdvisorID])->delete();
                if($meetingType){
                    foreach($meetingType as $key => $value){
                        $servicesArr = array(
                            'meeting_type' => $value,
                            'time' => $meetingTime[$key],
                            'AdvisorID' => $request->user()->AdvisorID,
                            'UserID' => $request->user()->id,
                        );
                        $data = DB::table('user_services')->insert($servicesArr);
                    }
                }
            }else{
                if($meetingType){
                    foreach($meetingType as $key => $value){
                        $servicesArr = array(
                            'meeting_type' => $value,
                            'time' => $meetingTime[$key],
                            'AdvisorID' => $request->user()->AdvisorID,
                            'UserID' => $request->user()->id,
                        );
                        DB::table('user_services')->insert($servicesArr);
                    }
                    
                }
            }
            if($request->user()->onboarding_complete){

                $obj = json_decode($request->user()->onboarding_complete);
                $onboarding_complete =  json_decode(json_encode($obj),true);
                if(!in_array("meeting_preference", $onboarding_complete)){
                    $completeArr = array_merge($onboarding_complete, ["meeting_preference"]);
                    DB::table('users')->where('id', $request->user()->id)->update(['onboarding_complete' => json_encode($completeArr)]);
                }
            }else{
                $completeArr = ["meeting_preference"];
                DB::table('users')->where('id', $request->user()->id)->update(['onboarding_complete' => json_encode($completeArr)]);
            }
        }
        if($request->monthly_capacity){
            // DB::table('advisors')->where('UserID', $request->user()->id)->update(['offer_meeting_each_month' => $request->offer_meeting_each_month]);
            DB::table('advisors')->where('UserID', $request->user()->id)->update(['monthly_capacity' => $request->monthly_capacity, 'monthly_capacity_remaining' => $request->monthly_capacity]);

            if($request->user()->onboarding_complete){

                $obj = json_decode($request->user()->onboarding_complete);
                $onboarding_complete =  json_decode(json_encode($obj),true);
                if(!in_array("meeting_preference", $onboarding_complete)){
                    $completeArr = array_merge($onboarding_complete, ["meeting_preference"]);
                    DB::table('users')->where('id', $request->user()->id)->update(['onboarding_complete' => json_encode($completeArr)]);
                }
            }else{
                $completeArr = ["meeting_preference"];
                DB::table('users')->where('id', $request->user()->id)->update(['onboarding_complete' => json_encode($completeArr)]);
            }
        }

        if($request->availability_time){
            DB::table('advisors')->where('UserID', $request->user()->id)->update(['availability_time' => $request->availability_time]);
            if($request->user()->onboarding_complete){
                $obj = json_decode($request->user()->onboarding_complete);
                $onboarding_complete =  json_decode(json_encode($obj),true);
                if(!in_array("meeting_preference", $onboarding_complete)){
                    $completeArr = array_merge($onboarding_complete, ["meeting_preference"]);
                    DB::table('users')->where('id', $request->user()->id)->update(['onboarding_complete' => json_encode($completeArr)]);
                }
            }else{
                $completeArr = ["meeting_preference"];
                DB::table('users')->where('id', $request->user()->id)->update(['onboarding_complete' => json_encode($completeArr)]);
            }
        }

        DB::table('advisors')->where('UserID', $request->user()->id)->update([
            'set_meeting_preferences' => 1,
            'set_meeting_preferences_timestamp_EST'=> Carbon::parse(now(),'EST')->setTimeZone('EST'),
        ]);
        
        return response()->json([
            'statusCode' => 200,
            'Success' => 'Successfully Updated Or Created',
            'message' => 'Request has been processed',
        ]);
    }
    // public function StoreAdvisorService(Request $request)
    // {
  
    //     // $services =  DB::table('user_services')->where('AdvisorID', $request->user()->AdvisorID)->first();
    //     $meetingType = $request->meeting_type?json_decode($request->meeting_type):'';
    //     $meetingTime = $request->time?json_decode($request->time):'';
    //     $service_id = $request->service_id?json_decode($request->service_id):'';
    //     $action_type = $request->action_type?json_decode($request->action_type):'';
  

    //     if($meetingType){
          
    //         foreach($meetingType as $key => $value){
    //             $servicesArr = array(
    //                 'meeting_type' => $value,
    //                 'time' => $meetingTime[$key],
    //                 'AdvisorID' => $request->user()->AdvisorID,
    //                 'UserID' => $request->user()->id,
    //             );
    //             if(isset($service_id[$key])){
    //                 if($action_type[$key] == 'update'){
    //                     DB::table('user_services')->where('is_active', 1)->where('id', $service_id[$key])->update($servicesArr);
    //                 }else if($action_type[$key] == 'delete'){
    //                     DB::table('user_services')->where('id', $service_id[$key])->update(['is_active' => 0]);
    //                 }else{
    //                     return response()->json([
    //                         'status' => 400,
    //                         'message' => 'Action Type invalid!',
    //                     ]);
    //                 }
    //             }else{
    //                 if($action_type[$key] == 'add'){
    //                     DB::table('user_services')->insert($servicesArr);
    //                 }else{
    //                     return response()->json([
    //                         'status' => 400,
    //                         'message' => 'Action Type invalid!',
    //                     ]);
    //                 }
    //             }
    //         }
                    
          
    //         if($request->user()->onboarding_complete){

    //             $obj = json_decode($request->user()->onboarding_complete);
    //             $onboarding_complete =  json_decode(json_encode($obj),true);
    //             if(!in_array("meeting_preference", $onboarding_complete)){
    //                 $completeArr = array_merge($onboarding_complete, ["meeting_preference"]);
    //                 DB::table('users')->where('id', $request->user()->id)->update(['onboarding_complete' => json_encode($completeArr)]);
    //             }
    //         }else{
    //             $completeArr = ["meeting_preference"];
    //             DB::table('users')->where('id', $request->user()->id)->update(['onboarding_complete' => json_encode($completeArr)]);
    //         }
    //     }
    //     if($request->offer_meeting_each_month){
    //         DB::table('advisors')->where('UserID', $request->user()->id)->update(['offer_meeting_each_month' => $request->offer_meeting_each_month]);
    //         if($request->user()->onboarding_complete){

    //             $obj = json_decode($request->user()->onboarding_complete);
    //             $onboarding_complete =  json_decode(json_encode($obj),true);
    //             if(!in_array("meeting_preference", $onboarding_complete)){
    //                 $completeArr = array_merge($onboarding_complete, ["meeting_preference"]);
    //                 DB::table('users')->where('id', $request->user()->id)->update(['onboarding_complete' => json_encode($completeArr)]);
    //             }
    //         }else{
    //             $completeArr = ["meeting_preference"];
    //             DB::table('users')->where('id', $request->user()->id)->update(['onboarding_complete' => json_encode($completeArr)]);
    //         }
    //     }

    //     if($request->availability_time){
    //         DB::table('advisors')->where('UserID', $request->user()->id)->update(['availability_time' => $request->availability_time]);
    //         if($request->user()->onboarding_complete){
    //             $obj = json_decode($request->user()->onboarding_complete);
    //             $onboarding_complete =  json_decode(json_encode($obj),true);
    //             if(!in_array("meeting_preference", $onboarding_complete)){
    //                 $completeArr = array_merge($onboarding_complete, ["meeting_preference"]);
    //                 DB::table('users')->where('id', $request->user()->id)->update(['onboarding_complete' => json_encode($completeArr)]);
    //             }
    //         }else{
    //             $completeArr = ["meeting_preference"];
    //             DB::table('users')->where('id', $request->user()->id)->update(['onboarding_complete' => json_encode($completeArr)]);
    //         }
    //     }
        
    //     return response()->json([
    //         'statusCode' => 200,
    //         'Success' => 'Successfully Updated Or Created',
    //         'message' => 'Request has been processed',
    //     ]);

    // }


    public function GetEducationDropDowns(Request $request){
        $filed_of_studies=DB::table('field_of_studies')->orderBy('name', 'ASC')->get();
        $schools=DB::table('schools')->orderBy('name', 'ASC')->get();
        $degrees=DB::table('degrees')->orderBy('name', 'ASC')->get();
        $data=[
            'field_of_studies' =>new FiledOfStudyResource($filed_of_studies),
            'schools' => $schools,
            'degrees' =>new DegreeResource($degrees),
        ];
        return $this->respondSuccessWithData($data,'Degree , Schools ,Field of Studies and education Listing',200);
    }

    public function GetWorkDropDowns(Request $request){

        $companies=DB::table('companies')->orderBy('name', 'ASC')->get();
        $industries=DB::table('industries')->orderBy('name', 'ASC')->get();
        $work_roles=DB::table('work_roles')->orderBy('name', 'ASC')->get();
        $Employment_Type = array(
            "0" => "Full-time",
            "1" => "Part-time",
            "2" => "Internship",
            "3" => "Apprenticeship",
            "4" => "Other (Specify)"
        );
        $data=[
            'companies' =>$companies,
            'industries' =>new IndustryResource($industries),
            'work_roles' =>$work_roles,
            'Employment_Type' => $Employment_Type,
        ];

        return $this->respondSuccessWithData($data,' Companies , Inquiries , work_roles Listing',200);
    }


    public function GetQuiz(Request $request)
    {
        if($request->user()->hasRole('Advisee')){
            $Quiz = DB::table('quiz')->where('type', 'advisee')->get();
            if($Quiz){
                return response()->json([
                    'status' => 200,
                    'message' => 'Data Get Successfully',
                    'data' => $Quiz,
                ]);
            }else{
                return response()->json([
                    'status' => 200,
                    'message' => 'No data found',
                    'data' => $Quiz,
                ]);
            }
        }else if($request->user()->hasRole('Advisor')){
            $Quiz = DB::table('quiz')->where('type', 'Advisor')->get();
            if($Quiz){
                return response()->json([
                    'status' => 200,
                    'message' => 'Data Get Successfully',
                    'data' => $Quiz,
                ]);
            }else{
                return response()->json([
                    'status' => 200,
                    'message' => 'No data found',
                    'data' => $Quiz,
                ]);
            }
        }else{
            return response()->json([
                'status' => 500,
                'message' => 'Unauthorised or token expired!',
            ]);
        }
    }
    public function GetUserServices(Request $request)
    {
        if($request->user()->hasRole('Advisor')){
            $userServices = DB::table('user_services')->where('is_active', 1)->whereIn('UserID', [$request->user()->id])->get();
            // $userServices = DB::table('user_services')->whereIn('UserID', [$request->user()->id])->where('is_active', 1)->get();

            // $advisor = DB::table('advisors')->where('UserID', $request->user()->id)->select('offer_meeting_each_month','availability_time')->first();
            $advisor = DB::table('advisors')->where('UserID', $request->user()->id)->select('monthly_capacity','availability_time')->first();

            return response()->json([
                'statusCode' => 200,
                'Success' => 'Successfully Data Fatched',
                'message' => 'Request has been processed',
                'Data' => $userServices,
                'monthly_capacity' =>$advisor->monthly_capacity,
                'availability' =>$advisor->availability_time,
            ]);
           
        }else{
            return response()->json([
                'status' => 500,
                'message' => 'Unauthorised user or Token Expired!',
            ]);
        }
    }


    public function DeleteUserService(Request $request)
    {
        if($request->user()->hasRole('Advisor')){
            $services_data = DB::table('user_services')->where('is_active', 1)->where('id', $request->id)->whereIn('UserID', [$request->user()->id])->get();
            // $services_data =  DB::table('user_services')->where('id', $request->id)->whereIn('UserID', [$request->user()->id])->get();
            if($services_data){
                $userServices = DB::table('user_services')->where('id', $request->id)->where('UserID', $request->user()->id)->update(['is_active' => 0]);
                // $userServices = DB::table('user_services')->where('id', $request->id)->where('UserID', $request->user()->id)->delete();

                // $userServices = DB::table('user_services')->where('id', $request->id)->where('UserID', $request->user()->id)->update(['is_active' => 0]);
                return response()->json([
                    'statusCode' => 200,
                    'Success' => 'Successfully Services Deleted',
                    'message' => 'Request has been processed',
                ]);
            }else{
                return response()->json([
                    'statusCode' => 500,
                    'Success' => 'Services Not Deleted',
                    'message' => 'Request not  processed, Please Check login Or Services ID',
                ]);
            }
        }else{
            return response()->json([
                'status' => 500,
                'message' => 'Unauthorised user or Token Expired!',
            ]);
        }
    }

    // common api  ->>>>>>>>>>>>>>>>
 


    public function SettingAccount(Request $request)
    {

        if($request->user()->hasRole('Advisee')){
            $user = DB::table('users')->where('id', $request->user()->id)->select('email', 'password', 'meeting_email')->first();
            $data=[
                'userData' => $user,
            ];
            if($user){
                return response()->json([
                    'statusCode' => 200,
                    'Success' => 'Successfully Data Fatched',
                    'message' => 'Request has been processed',
                    'Data' => $data?$data:'',
                ]);
            }else{
                return response()->json([
                    'statusCode' => 500,
                    'Success' => 'Data not  Fatched Successfully',
                    'message' => 'Request has been not processed',
                    'Data' => $data?$data:'',
                ]);
            }
        }elseif($request->user()->hasRole('Advisor')){

            $user = DB::table('users')->where('id', $request->user()->id)->select('email', 'password', 'meeting_email')->first();
            $data=[
                'userData' => $user,
            ];
            if($user){
                return response()->json([
                    'statusCode' => 200,
                    'Success' => 'Successfully Data fetched',
                    'message' => 'Request has been processed',
                    'Data' => $data?$data:'',
                ]);
            }else{
                return response()->json([
                    'statusCode' => 500,
                    'Success' => 'Data not fetched Successfully',
                    'message' => 'Request has been not processed',
                    'Data' => $data?$data:'',
                ]);
            }

        }else{
            return response()->json([
                "message"=>'Token Expired',
                "status"=>  500
            ]);
        }
    }

    public function UpdateSettingAccount(Request $request)
    {
        if($request->user()->hasRole('Advisee')){

            $email = $request->email?$request->email:'';
            $password = $request->password?$request->password:'';
            $old_password = $request->old_password?$request->old_password:'';
            $meeting_email = $request->meeting_email?$request->meeting_email:'';

            if($password && $old_password){
                if (Hash::check($old_password, $request->user()->password)) {
                    $new_password = Hash::make($password);
                    DB::table('users')->where('id', $request->user()->id)->update(['password'=> $new_password]);
                }else{
                    return response()->json([
                        "message"=>'Old password not matched!',
                        "status"=>  500
                    ]);
                }
            }

            if($meeting_email){
                DB::table('users')->where('id', $request->user()->id)->update(['meeting_email'=> $meeting_email]);
            }

            return response()->json([
                'statusCode' => 200,
                'Success' => 'Successfully Data Fatched',
                'message' => 'Request has been processed',
                'Data' => $request->user(),
            ]);
            
        }elseif($request->user()->hasRole('Advisor')){
            $email = $request->email?$request->email:'';
            $password = $request->password?$request->password:'';
            $old_password = $request->old_password?$request->old_password:'';
            $meeting_email = $request->meeting_email?$request->meeting_email:'';
            
            if($password && $old_password){
                if (Hash::check($old_password, $request->user()->password)) {
                    $new_password = Hash::make($password);
                    DB::table('users')->where('id', $request->user()->id)->update(['password'=> $new_password]);
                }else{
                    return response()->json([
                        "message"=>'Old password not matched!',
                        "status"=>  500
                    ]);
                }
            }
            
            if($meeting_email){
                DB::table('users')->where('id', $request->user()->id)->update(['meeting_email'=> $meeting_email]);
            }

            return response()->json([
                'statusCode' => 200,
                'Success' => 'Successfully Data Fatched',
                'message' => 'Request has been processed',
                'Data' => $request->user(),
            ]);

        }else{
            return response()->json('Token Expired', 500);
        }
       
    }

    public function LocationTimezone(Request $request)
    {
        if($request->user()->hasRole('Advisee')){
            $backgroundDT = DB::table('user_backgrounds')->where('UserID', $request->user()->id)->select('country', 'city', 'state','time_zone')->first();
            $countries = DB::table('countries')->orderBy('name', 'ASC')->get();
            $timezones = DB::table('time_zones')->orderBy('name', 'ASC')->get();
            $states=DB::table('states')->orderBy('name', 'ASC')->get();
           
            $data=[
                'BackgroundData' => $backgroundDT,
                'countries' =>$countries,
                'timezones' =>$timezones, 
                'states' =>$states,
            ];
            if($backgroundDT){
                return response()->json([
                    'statusCode' => 200,
                    'Success' => 'Successfully Data Fatched',
                    'message' => 'Request has been processed',
                    'Data' => $data?$data:'',
                ]);
            }else{
                return response()->json([
                    'statusCode' => 500,
                    'Success' => 'Data not  Fatched Successfully',
                    'message' => 'Request has been not processed',
                ]);
            }
        }elseif($request->user()->hasRole('Advisor')){
            $backgroundDT = DB::table('user_backgrounds')->where('UserID', $request->user()->id)->select('country', 'city', 'state','time_zone')->first();
            
            $countries = DB::table('countries')->orderBy('name', 'ASC')->get();
            $timezones = DB::table('time_zones')->orderBy('name', 'ASC')->get();
            $states=DB::table('states')->orderBy('name', 'ASC')->get();
           
            $data=[
                'BackgroundData' => $backgroundDT,
                'countries' =>$countries,
                'timezones' =>$timezones, 
                'states' =>$states,
            ];
            if($backgroundDT){
                return response()->json([
                    'statusCode' => 200,
                    'Success' => 'Successfully Data Fatched',
                    'message' => 'Request has been processed',
                    'Data' => $data?$data:'',
                ]);
            }else{
                return response()->json([
                    'statusCode' => 500,
                    'Success' => 'Data not  Fatched Successfully',
                    'message' => 'Request has been not processed',
                ]);
            }
        }else{
            return response()->json([
                "message"=>'Token Expired',
                "status"=>  500
            ]);
        }
    }

    public function UpdateLocationTimezone(Request $request)
    {
        if($request->user()->hasRole('Advisee')){
            $country = $request->country?$request->country:'';
            $city = $request->city?$request->city:'';
            $state = $request->state?$request->state:'';
            $timezone = $request->timezone?$request->timezone:'';

            if($country){
                DB::table('user_backgrounds')->where('UserID', $request->user()->id)->update(['country'=> $country]);
            }

            if($city){
                DB::table('user_backgrounds')->where('UserID', $request->user()->id)->update(['city'=> $city]);
            }

            if($state){
                DB::table('user_backgrounds')->where('UserID', $request->user()->id)->update(['state'=> $state]);
            }

            if($timezone){
                DB::table('user_backgrounds')->where('UserID', $request->user()->id)->update(['time_zone'=> $timezone]);
            }
            $backgroundDT = DB::table('user_backgrounds')->where('UserID', $request->user()->id)->select('country', 'city', 'state','time_zone')->first();
            return response()->json([
                'statusCode' => 200,
                'Success' => 'Successfully Data Fatched',
                'message' => 'Request has been processed',
                'Data' => $backgroundDT,
            ]);
            
        }elseif($request->user()->hasRole('Advisor')){
            $country = $request->country?$request->country:'';
            $city = $request->city?$request->city:'';
            $state = $request->state?$request->state:'';
            $timezone = $request->timezone?$request->timezone:'';

            if($country){
                DB::table('user_backgrounds')->where('UserID', $request->user()->id)->update(['country'=> $country]);
            }

            if($city){
                DB::table('user_backgrounds')->where('UserID', $request->user()->id)->update(['city'=> $city]);
            }

            if($state){
                DB::table('user_backgrounds')->where('UserID', $request->user()->id)->update(['state'=> $state]);
            }

            if($timezone){
                DB::table('user_backgrounds')->where('UserID', $request->user()->id)->update(['time_zone'=> $timezone]);
            }
            $backgroundDT = DB::table('user_backgrounds')->where('UserID', $request->user()->id)->select('country', 'city', 'state','time_zone')->first();
            return response()->json([
                'statusCode' => 200,
                'Success' => 'Successfully Data Fatched',
                'message' => 'Request has been processed',
                'Data' => $backgroundDT,
            ]);

        }else{
            return response()->json('Token Expired', 500);
        }
    }

// Advisor Meeting Preferences 

    public function SettingPreferences(Request $request)
    {
        if($request->user()->hasRole('Advisor')){

            $meetingTyp = DB::table('meeting_types')->orderBy('name', 'ASC')->get();
            // $services = DB::table('user_services')->where('is_active', 1)->whereIn('UserID',[$request->user()->id])->get();
            // $services = DB::table('user_services')->where('UserID',[$request->user()->id])->get();
            $services = DB::table('user_services')->whereIn('UserID',[$request->user()->id])->get();

            // $preScreening = DB::table('advisors')->where('UserID', $request->user()->id)->select('prescreening_program_opt_in','offer_meeting_each_month','availability_time')->first();
            $preScreening = DB::table('advisors')->where('UserID', $request->user()->id)->select('prescreening_program_opt_in','monthly_capacity','availability_time')->first();
            $data=[
                'MeetingTypes' => $meetingTyp,
                'Userservices' =>$services,
                'prescreening' =>$preScreening, 
            ];
            
            return response()->json([
                'statusCode' => 200,
                'Success' => 'Successfully Data Fatched',
                'message' => 'Request has been processed',
                'Data' => $data?$data:'',
            ]);
        }else{
            return response()->json([
                'statusCode' => 500,
                'message' => 'Unauthorised',
            ]);
        }
        
    }

    function UpdateSettingPreferences(Request $request)
    {
        if($request->user()->hasRole('Advisor')){

            $services =  DB::table('user_services')->whereIn('AdvisorID', [$request->user()->AdvisorID])->whereIn('UserID', [$request->user()->id])->get();
    
            if($services){
                if(isset($request->meeting_type)){
                    DB::table('user_services')->whereIn('AdvisorID', [$request->user()->AdvisorID])->delete();
                    foreach($request->meeting_type as $key => $value){
                        $servicesArr = array(
                            'meeting_type' => $value,
                            'time' => $request->time[$key],
                            'AdvisorID' => $request->user()->AdvisorID,
                            'UserID' => $request->user()->id,
                        );
                        $data = DB::table('user_services')->insert($servicesArr);
                    }
                }
            }else{
                if(isset($request->meeting_type)){
                    foreach($request->meeting_type as $key => $value){
                        $servicesArr = array(
                            'meeting_type' => $value,
                            'time' => $request->time[$key],
                            'AdvisorID' => $request->user()->AdvisorID,
                            'UserID' => $request->user()->id,
                        );
                        DB::table('user_services')->insert($servicesArr);
                    }
                }
            }

            // $meetingType = $request->meeting_type?json_decode($request->meeting_type):'';
            // // $meetingType = $request->meeting_type?json_decode($request->meeting_type):'';
            // $meetingTime = $request->time?json_decode($request->time):'';
            // $service_id = $request->service_id?json_decode($request->service_id):'';
            // $action_type = $request->action_type?json_decode($request->action_type):'';
            // if($meetingType){
            //     foreach($meetingType as $key => $value){
            //         $servicesArr = array(
            //             'meeting_type' => $value,
            //             'time' => $meetingTime[$key],
            //             'AdvisorID' => $request->user()->AdvisorID,
            //             'UserID' => $request->user()->id,
            //         );

            //         DB::table('user_services')->where('is_active', 1)->where('id', $service_id[$key])->update($servicesArr);

            //         if(isset($service_id[$key])){
            //             if($action_type[$key] == 'update'){
            //                 DB::table('user_services')->where('is_active', 1)->where('id', $service_id[$key])->update($servicesArr);
            //             }else if($action_type[$key] == 'delete'){
            //                 DB::table('user_services')->where('id', $service_id[$key])->update(['is_active' => 0]);
            //             }else{
            //                 return response()->json([
            //                     'status' => 400,
            //                     'message' => 'Action Type invalid!',
            //                 ]);
            //             }
            //         }else{
            //             if($action_type[$key] == 'add'){
            //                 DB::table('user_services')->insert($servicesArr);
            //             }else{
            //                 return response()->json([
            //                     'status' => 400,
            //                     'message' => 'Action Type invalid!',
            //                 ]);
            //             }
            //         }
            //     }
            // }



            // if($request->offer_meeting_each_month){
            //     DB::table('advisors')->where('UserID', $request->user()->id)->update(['offer_meeting_each_month' => $request->offer_meeting_each_month]);
            // }

            if($request->monthly_capacity || $request->monthly_capacity == 0){

                $start = Carbon::now()->startOfMonth();
                $end = Carbon::now()->endOfMonth();
                $advisorInfo = DB::table('advisors')->where('UserID', $request->user()->id)->first();

                $recieved_requests_this_month_count = DB::table('meetings')->where('AdvisorID', $advisorInfo->AdvisorID)->whereBetween('request_sent_EST', [$start, $end])->get()->count();
                $advisor_monthly_capacity_remaining = DB::table('advisors')->where('UserID' ,$request->user()->id)->select('monthly_capacity_remaining')->first();

                DB::table('advisors')->where('UserID', $request->user()->id)->update(['monthly_capacity' => $request->monthly_capacity]);

                $new_monthly_capacity_remaining = max($request->monthly_capacity - $recieved_requests_this_month_count, 0);

                DB::table('advisors')->where('UserID', $request->user()->id)->update(['monthly_capacity_remaining' => $new_monthly_capacity_remaining]);


                // if($advisor_monthly_capacity_remaining->monthly_capacity_remaining > $request->monthly_capacity){
                //     DB::table('advisors')->where('UserID', $request->user()->id)->update(['monthly_capacity_remaining' => $request->monthly_capacity]);
                // }
            }

            if($request->availability_time){
                DB::table('advisors')->where('UserID', $request->user()->id)->update(['availability_time' => $request->availability_time]);
            }
            if($request->prescreening_program_opt_in){
                DB::table('advisors')->where('UserID', $request->user()->id)->update(['prescreening_program_opt_in' => $request->prescreening_program_opt_in]);
            }
            $services =  DB::table('user_services')->where('is_active', 1)->whereIn('UserID', [$request->user()->id])->get();
            // $prescreening_program_opt_in = DB::table('advisors')->where('UserID', $request->user()->id)->select('prescreening_program_opt_in','offer_meeting_each_month','availability_time')->first();
            $prescreening_program_opt_in = DB::table('advisors')->where('UserID', $request->user()->id)->select('prescreening_program_opt_in','monthly_capacity','availability_time')->first();

            return response()->json([
                'statusCode' => 200,
                'Success' => 'Successfully Data Fatched',
                'message' => 'Request has been processed',
                'Data' => $services?$services:'',
                'prescreening_program_opt_in' => $prescreening_program_opt_in,
                'completed_meetings_this_month' => $recieved_requests_this_month_count,
            ]);
        }else{
            return response()->json([
                'statusCode' => 500,
                'message' => 'Unauthorised',
            ]);
        }
    }

    // update hiring status

    public function updateHiringStatus(Request $request){
        if($request->user()->hasRole('Advisor')){
            DB::table('advisors')->where('UserID', $request->user()->id)->update(['actively_hiring' => $request->actively_hiring]);
            $actively_hiring = DB::table('advisors')->where('UserID', $request->user()->id)->select('actively_hiring')->first();

            return response()->json([
                'statusCode' => 200,
                'Success' => 'Successfully Data Fatched',
                'message' => 'Request has been processed',
                'HiringStatus' =>$actively_hiring->actively_hiring,
            ]);
        }else{
            return response()->json([
                'statusCode' => 500,
                'message' => 'Unauthorised',
            ]);
        }
    }
    public function GetHiringStatus(Request $request){
        if($request->user()->hasRole('Advisor')){
            $actively_hiring = DB::table('advisors')->where('UserID', $request->user()->id)->select('actively_hiring')->first();
            return response()->json([
                'statusCode' => 200,
                'Success' => 'Successfully Data Fatched',
                'message' => 'Request has been processed',
                'HiringStatus' =>$actively_hiring->actively_hiring,
            ]);
        }else{
            return response()->json([
                'statusCode' => 500,
                'message' => 'Unauthorised',
            ]);
        }
    }

    public function SaveOrientationResponse(Request $request)
    {
     
        if($request->user()->hasRole('Advisor')){
            
            $orientationResponse = DB::table('orientation_response')->where('UserID', $request->user()->id)->first();
            if(!$orientationResponse){
                DB::table('orientation_response')->insert([
                    'UserID' => $request->user()->id,
                    'response' => $request->response,
                    'scale' => $request->scale,
                    'created_at' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                    'updated_at' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                ]);
                DB::table('advisors')
                ->where('UserID' ,$request->user()->id)
                ->update([
                    'onboarding_signed_agreement'=> 1,
                    'onboarding_signed_agreement_timestamp_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                ]);
            }else{
                DB::table('orientation_response')->where('UserID', $request->user()->id)->update([
                    'UserID' => $request->user()->id,
                    'response' => $request->response,
                    'scale' => $request->scale,
                    'created_at' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                    'updated_at' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                ]); 
            }
            if($request->user()->onboarding_complete){
                $obj = json_decode($request->user()->onboarding_complete);
                $onboarding_complete =  json_decode(json_encode($obj),true);
                if(!in_array("orientation_quiz", $onboarding_complete)){
                    $completeArr = array_merge($onboarding_complete, ["orientation_quiz"]);
                    DB::table('users')->where('id', $request->user()->id)->update(['onboarding_complete' => json_encode($completeArr)]);
                    
                }
            }else{
                $completeArr = ["orientation_quiz"];
                DB::table('users')->where('id', $request->user()->id)->update(['onboarding_complete' => json_encode($completeArr)]);
            }
            // DB::table('advisors')->where('UserID', $request->user()->id)->update(['onboarding_signed_agreement' => json_decode($request->scale)->Expectations]);
            
            $orientationResponse = DB::table('orientation_response')->where('UserID', $request->user()->id)->first();
            if($orientationResponse){
                return response()->json([
                    'statusCode' => 200,
                    'Success' => 'Successfully Data Fatched',
                    'message' => 'Request has been processed',
                    'Data' => $orientationResponse,
                ]);
            }else{
                return response()->json([
                    'statusCode' => 500,
                    'Success' => 'Data not Fatched',
                    'message' => 'Request has not been processed',
                ]);
            }  

        }else if($request->user()->hasRole('Advisee')){

            $orientationResponse = DB::table('orientation_response')->where('UserID', $request->user()->id)->first();
            if(!$orientationResponse){
                DB::table('orientation_response')->insert([
                    'UserID' => $request->user()->id,
                    'response' => $request->response,
                    'scale' => $request->scale,
                    'created_at' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                    'updated_at' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                ]);
                DB::table('advisees')
                ->where('UserID' ,$request->user()->id)
                ->update([
                    'onboarding_signed_agreement'=> 1,
                    'onboarding_signed_agreement_timestamp_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                ]);
            }else{
                DB::table('orientation_response')->where('UserID', $request->user()->id)->update([
                    'UserID' => $request->user()->id,
                    'response' => $request->response,
                    'scale' => $request->scale,
                    'created_at' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                    'updated_at' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                ]);
            }
            if($request->user()->onboarding_complete){
                $obj = json_decode($request->user()->onboarding_complete);
                $onboarding_complete =  json_decode(json_encode($obj),true);
                if(!in_array("orientation_quiz", $onboarding_complete)){
                    $completeArr = array_merge($onboarding_complete, ["orientation_quiz"]);
                    DB::table('users')->where('id', $request->user()->id)->update(['onboarding_complete' => json_encode($completeArr)]);
                    
                }
            }else{
                $completeArr = ["orientation_quiz"];
                DB::table('users')->where('id', $request->user()->id)->update(['onboarding_complete' => json_encode($completeArr)]);
            }
            DB::table('advisees')->where('UserID', $request->user()->id)->update(['onboarding_signed_agreement' => json_decode($request->scale)->Expectations]);

            $orientationResponse = DB::table('orientation_response')->where('UserID', $request->user()->id)->first();
            if($orientationResponse){
                return response()->json([
                    'statusCode' => 200,
                    'Success' => 'Successfully Data Fatched',
                    'message' => 'Request has been processed',
                    'Data' => $orientationResponse,
                ]);
            }else{
                return response()->json([
                    'statusCode' => 500,
                    'Success' => 'Data not Fatched',
                    'message' => 'Request has not been processed',
                ]);
            }  
        }else{
            return response()->json([
                'status' => 500,
                'message' => 'Unauthorised or Token Expired!',
            ]);
        }

       
    }

    public function GetDashboard(Request $request){

        if($request->user()->hasRole('Advisor')){
////////////////////// ADVISOR
            // $advisorData      = DB::table('advisors')->where('UserID' ,$request->user()->id)->select('AdvisorID','headline','about_me','just_for_fun','tags_list','cover_profile','profile_goal','profile_video','help','offer_meeting_each_month','availability_time','funnel_status')->first();
            $advisorData = DB::table('advisors')->where('UserID' ,$request->user()->id)->select('AdvisorID','headline','about_me','just_for_fun','tags_list','cover_profile','profile_goal','profile_video','help','monthly_capacity','monthly_capacity_remaining','availability_time','funnel_status')->first();
            $userData = DB::table('users')->where('id' ,$request->user()->id)->select('id','firstname','lastname','pronouns','AdvisorID','AdviseeID')->first();
            $backgroundData = DB::table('user_backgrounds')->where('UserID' ,$request->user()->id)->select('id','time_zone','country','state','city')->first();
            $month = Carbon::now()->format('m');
            $monthArr = [];
            $confirmMeetingCount = [];
            $offer_meeting_each_month = '';
            $meeting_data = DB::table('meetings')
	            ->selectRaw('*')
	            ->selectRaw('meetings.id as MeetingId')
            	->leftjoin('meeting_outcome', 'meeting_outcome.MeetingID', '=', 'meetings.id' )
            	->whereIn('AdvisorID', [$advisorData->AdvisorID])
            	->whereNotIn('meeting_status',['Request Opened'])
            	->orderBy('meetings.id', 'DESC')->get();
//		        $completed_meetings = DB::table('meetings')->leftjoin('meeting_outcome', 'meeting_outcome.MeetingID', '=', 'meetings.id' )->whereIn('AdvisorID', [$advisorData->AdvisorID])->where('meeting_status',['Completed'])->orderBy('id', 'DESC')->get();
            $completed_meetings = DB::table('meetings')
            	->leftjoin('meeting_outcome', 'meeting_outcome.MeetingID', '=', 'meetings.id' )
            	->whereIn('AdvisorID', [$advisorData->AdvisorID])
            	->where('meeting_status',['Completed'])->orderBy('meetings.id', 'DESC')
            	->get();
            $meetingoutcome = '';
            $advisor_continue = '';
            $advisee_continue = '';
            $userSrv = '';
            $require_action = '';
            $display_status = '';
            if($meeting_data){
                foreach($meeting_data as $key => $value){

                    $parsed_confirmed_meeting_date = '';
                    $parsed_confirmed_meeting_starttime = '';
                    $parsed_confirmed_meeting_endtime = '';
                    $confirmed_meeting_ispast = '';
                    $parsed_meeting_date = '';

//                    $confirmed_meeting_starttime_unix = '';
                    $confirmed_meeting_endtime_unix = '';
                    $confirmed_meeting_secondspast = '';
                    if($value->starttime){
                        $advisorUserID = DB::table('advisors')->where('AdvisorID', $value->AdvisorID)->select('UserID')->first();
                        $advisorTimeZone = DB::table('user_backgrounds')->where('UserID', $advisorUserID->UserID)->select('time_zone')->first();
                        $advisorTimeZoneKey = DB::table('time_zones')->where('name', $advisorTimeZone->time_zone)->select('key')->first();

                        $time_interval_start = Carbon::createFromFormat('Y-m-d H:i:s', $value->starttime, $advisorTimeZoneKey->key);
                        $time_interval_end = Carbon::createFromFormat('Y-m-d H:i:s', $value->endtime, $advisorTimeZoneKey->key);

                        $parsed_confirmed_meeting_date = $time_interval_start->format('l, M jS');
                        $parsed_confirmed_meeting_starttime = ltrim($time_interval_start->format('h:iA'),0);
                        $parsed_confirmed_meeting_endtime = ltrim($time_interval_end->format('h:iA'),0);

//		                    $confirmed_meeting_starttime_unix = strtotime($confirmed_eting_starttime_unix);
                    }
                    if($value->endtime){ // Advisor
                    		$parsed_meeting_date = $time_interval_end->format('l, M jS');
                    	
		                    $confirmed_meeting_endtime_unix = strtotime($value->endtime);
		                    $confirmed_meeting_secondspast = strtotime(now()) - $confirmed_meeting_endtime_unix;
		                    if($confirmed_meeting_secondspast < 0) {$confirmed_meeting_ispast = "TRUE";}
	                    	if(strtotime($value->endtime) < strtotime(now())) { // meeting is in the past
		                  		$value->meeting_status = 'Completed';
		                  	}
                    	
                    }


                    
                    if($value->meeting_status == 'Request Sent'){
                        $require_action = 'Action Required (Confirm Time)';
                        $display_status = 'Scheduling';
                    }
                    if($value->meeting_status == 'Request Viewed'){
                        $require_action = 'Action Required (Confirm Time)';
                        $display_status = 'Scheduling';
                    }

                    if($value->meeting_status == 'Alternate Times Proposed'){
                        if($value->availability_last_provided_by == 'Advisee'){
                            $require_action = 'Action Required (Confirm Time)';
                        }else{
                            $require_action = 'Waiting For Advisee Action';
                        }
                        $display_status = 'Scheduling';
                    }
                    if($value->meeting_status == 'Confirmed'){
                        // $require_action = 'Make sure to attend the meeting';
                        $display_status = 'Confirmed';
                        $require_action = '';
                    }
                    // if($value->meeting_status == 'Rescheduled'){
                    //     $alternativeTimeProposeId = json_decode($value->availability_time)[2]->id;
                    //     $usrData = User::where('id', $alternativeTimeProposeId)->first();
                    //     if($usrData->AdvisorID){
                    //         $require_action = 'Waiting for Advisee Action';
                    //     }else{
                    //         $require_action = 'Confirm Time';
                    //     }
                    //     $display_status = 'Rescheduled';
                    // }


                    if($value->meeting_status == 'Advisee Cancelled'){
                        $require_action = '';
                        $display_status = 'Cancelled';
                    }

                    if($value->meeting_status == 'Advisor Cancelled'){
                        $require_action = '';
                        $display_status = 'Cancelled';
                    }

                    if($value->meeting_status == 'Rescheduling'){
                        if($value->availability_last_provided_by == 'Advisee'){
                            $require_action = 'Action Required (Confirm Time)';
                        }else{
                            $require_action = 'Waiting For Advisee Action';
                        }
                        $display_status = 'Rescheduling';
                    }
                    if($value->meeting_status == 'Completed' || $value->meeting_status == 'Confirmed'){
                    	if(strtotime($value->endtime) < strtotime(now())) { // meeting is in the past
                    		if($confirmed_meeting_endtime_unix > strtotime('October 15 2023')) { // meeting is after launch of postmeeting flow
	                    		if($value->advisor_meetingfinalized != 1 ) { // meeting hasn't been finalized by advisor
		                        $display_status = 'Past Meeting';
	                          $require_action = '';
	                        } else {
		                        $display_status = 'Completed';
		                        $require_action = '';
		                      }
	                      }
                    	}
                    }

                    if($value->meeting_status == 'Expired'){
                        $require_action = 'No Action Required';
                        $display_status = 'Expired';
                    }
                    
                    $adviseeNames = DB::table('users')->where('AdviseeID', $value->AdviseeID)->select('firstname', 'lastname')->first();
                    $adviseeMeetingData = DB::table('advisees')->where('AdviseeID', $value->AdviseeID)->select('profile_goal', 'UserID')->first();
                    
                    // $userSrv = DB::table('user_services')->where('id', (int)$value->services_id)->first();
                 
                
                    // $offer_meeting_each_month = $advisorData->offer_meeting_each_month;
                    $offer_meeting_each_month = $advisorData->monthly_capacity;
                    

                    // $meeting_data[$key]->user_services_meeting_type = $userSrv?$userSrv->meeting_type:'';
                    $meeting_data[$key]->advisee_firstname = $adviseeNames->firstname;
                    $meeting_data[$key]->advisee_lastname = $adviseeNames->lastname;
                    $meeting_data[$key]->profile_goal = $adviseeMeetingData->profile_goal?$adviseeMeetingData->profile_goal:'';
                    $meeting_data[$key]->action_required = $require_action;
                    $meeting_data[$key]->display_status = $display_status;
                    $meeting_data[$key]->parsed_confirmed_meeting_date = $parsed_confirmed_meeting_date;
                    $meeting_data[$key]->parsed_confirmed_meeting_starttime = $parsed_confirmed_meeting_starttime;
                    $meeting_data[$key]->parsed_confirmed_meeting_endtime = $parsed_confirmed_meeting_endtime;

//                    $meeting_data[$key]->confirmed_meeting_starttime_unix = $confirmed_meeting_starttime_unix;
                    $meeting_data[$key]->confirmed_meeting_endtime_unix = $confirmed_meeting_endtime_unix;
                    $meeting_data[$key]->confirmed_meeting_secondspast = $confirmed_meeting_secondspast;
                    $meeting_data[$key]->confirmed_meeting_ispast = $confirmed_meeting_ispast;
                    $meeting_data[$key]->parsed_meeting_date = $parsed_meeting_date;
                    $meeting_data[$key]->meetingoccurred = $confirmed_meeting_endtime_unix;

                }  
            }
            
            return response()->json([
                'statusCode' => 200,
                'Success' => 'Successfully Data Fatched',
                'message' => 'Request has been processed',
                'Data' => $request->user()->onboarding_complete,
                'progress' => $request->user()->progress,
                'meetingData' => $meeting_data?$meeting_data:'',
                'advisorData' => $advisorData,
                'backgroundData' => $backgroundData,
                'userData' => $userData,
                'Completed_meeting' => count($completed_meetings),
            ]);
////////////////////// ADVISEE
        }else if($request->user()->hasRole('Advisee')){
            $userData = DB::table('users')->where('id' ,$request->user()->id)->select('id','firstname','lastname','pronouns', 'AdviseeID', 'AdvisorID')->first();
            $adviseesData = DB::table('advisees')->where('AdviseeID' ,$userData->AdviseeID)->select('AdviseeID','headline','about_me','current_career_goals','just_for_fun','tags_list','cover_profile','profile_goal','funnel_status', 'monthly_requests_remaining')->first();
            $backgroundData = DB::table('user_backgrounds')->where('UserID' ,$request->user()->id)->select('id','time_zone','country','state','city')->first();
            // $confirmedMeeting = DB::table('meetings')->whereIn('meeting_status',['Confirmed'])->whereIn('AdviseeID', [$userData->AdviseeID])->get();
            $requested_meeting = DB::table('meetings')
	            ->whereIn('meeting_status',['Request Sent'])
	            ->whereIn('AdviseeID', [$userData->AdviseeID])
	            ->get();
            
            // $meeting_data = DB::table('meetings')->whereIn('AdviseeID', [$userData->AdviseeID])->orderBy('updated_at', 'DESC')->get();
            $meeting_data = DB::table('meetings')
		            ->selectRaw('*')
		            ->selectRaw('meetings.id as MeetingId')
		            ->selectRaw('meetings.meeting_status as meeting_status')
		            ->leftjoin('meeting_outcome', 'meeting_outcome.MeetingID', '=', 'meetings.id' )
								->whereIn('AdviseeID', [$userData->AdviseeID])
								->whereNotIn('meetings.meeting_status',['Request Opened'])
								->orderBy('meetings.id', 'DESC')
								->get(); 
            $completed_meetings = DB::table('meetings')->whereIn('AdviseeID', [$userData->AdviseeID])->where('meeting_status',['Completed'])->orderBy('id', 'DESC')->get();

            $userSrv = '';
            $display_status = '';

            if($meeting_data){
                // return response()->json($meeting_data);
                foreach($meeting_data as $key => $value){
                    $parsed_confirmed_meeting_date = '';
                    $parsed_confirmed_meeting_starttime = '';
                    $parsed_confirmed_meeting_endtime = '';
                    $parsed_meeting_date = '';

//                    $confirmed_meeting_starttime_unix = '';
                    $confirmed_meeting_endtime_unix = '';
                    $confirmed_meeting_ispast = '';
                    $confirmed_meeting_secondspast = '';
                    $require_action = '';

                    if($value->starttime){
                        $adviseeUserID = DB::table('advisees')->where('AdviseeID', $value->AdviseeID)->select('UserID')->first();

                        $adviseeTimeZone = DB::table('user_backgrounds')->where('UserID', $adviseeUserID->UserID)->select('time_zone')->first();
                        $adviseeTimeZoneKey = DB::table('time_zones')->where('name', $adviseeTimeZone->time_zone)->select('key')->first();

                        $time_interval_start = Carbon::createFromFormat('Y-m-d H:i:s', $value->starttime, $adviseeTimeZoneKey->key);
                        $time_interval_end = Carbon::createFromFormat('Y-m-d H:i:s', $value->endtime, $adviseeTimeZoneKey->key);

                        $parsed_confirmed_meeting_date = $time_interval_start->format('l, M jS');
                        $parsed_confirmed_meeting_starttime = ltrim($time_interval_start->format('h:iA'),0);
                        $parsed_confirmed_meeting_endtime = ltrim($time_interval_end->format('h:iA'),0);

//		                    $confirmed_meeting_starttime_unix = strtotime($confirmed_meeting_starttime_unix);
                    }
                    if($value->endtime){ // Advisee
                    		$parsed_meeting_date = $time_interval_end->format('l, M jS');
		                    $confirmed_meeting_endtime_unix = strtotime($parsed_confirmed_meeting_endtime);
		                    // returns 0 if in future; # of seconds if past
		                    $confirmed_meeting_secondspast = strtotime(now()) - $confirmed_meeting_endtime_unix;
		                    if($confirmed_meeting_secondspast > 0) {
		                    	$confirmed_meeting_ispast = "TRUE";
		                    }
                    	
                    }

                    if($value->meeting_status == 'Request Sent'){
                        $require_action = 'Waiting for Advisor Action';
                        $display_status = 'Scheduling';
                    }
                    if($value->meeting_status == 'Request Viewed'){
                        $require_action = 'Waiting for Advisor Action';
                        $display_status = 'Scheduling';
                    }

                    if($value->meeting_status == 'Alternate Times Proposed'){
       
                        if($value->availability_last_provided_by == 'Advisor'){
                            $require_action = 'Action Required (Confirm Time)';
                        }else{
                            $require_action = 'Waiting For Advisor Action';

                        }
                        $display_status = 'Scheduling';
                    }

                    if($value->meeting_status == 'Confirmed'){
                        // $require_action = 'Make sure to attend the meeting';
                        $display_status = 'Confirmed';
                        $require_action = '';
                    }
                    if($value->meeting_status == 'Advisee Cancelled'){
                        $require_action = '';
                        $display_status = 'Cancelled';
                    }

                    if($value->meeting_status == 'Rescheduling'){
                        if($value->availability_last_provided_by == 'Advisor'){
                            $require_action = 'Action Required (Confirm Time)';
                        }else{
                            $require_action = 'Waiting For Advisor Action';
                        }
                        $display_status = 'Rescheduling';
                    }

                    if($value->meeting_status == 'Advisor Cancelled'){
                        $require_action = '';
                        $display_status = 'Cancelled';
                    }
                    
                    if($value->meeting_status == 'Completed' || $value->meeting_status == 'Confirmed'){
                    	if(strtotime($value->endtime) < strtotime(now())) { // meeting is in the past
                    		if($confirmed_meeting_endtime_unix > strtotime('October 15 2023')) { // meeting is after launch of postmeeting flow
	                    		if($value->advisee_meetingfinalized != 1 ) { // meeting hasn't been finalized by advisee
		                        $display_status = 'Past Meeting';
	                          $require_action = '';
	                        } else {
		                        $display_status = 'Completed';
		                        $require_action = '';
		                      }
	                      }
                    	}
                    }
                    if($value->meeting_status == 'Expired'){
                        $require_action = 'No Action Required';
                        $display_status = 'Expired';
                    }

                    if($value->AdvisorID){
	                    $advisorNames = DB::table('users')->where('AdvisorID', $value->AdvisorID)->select('firstname', 'lastname')->first();
	                    $advisorMeetingData = DB::table('advisors')->where('AdvisorID', $value->AdvisorID)->select('profile_goal', 'UserID')->first();
	                  }



                
                    // $userSrv = DB::table('user_services')->where('id', (int)$value->services_id)->first();
                
                    // $offer_meeting_each_month = $advisorData->offer_meeting_each_month;

                    // $meeting_data[$key]->user_services_meeting_type = $userSrv?$userSrv->meeting_type:'';
                    $meeting_data[$key]->advisor_firstname = $advisorNames->firstname;
                    $meeting_data[$key]->advisor_lastname = $advisorNames->lastname;
                    $meeting_data[$key]->profile_goal = $advisorMeetingData->profile_goal?$advisorMeetingData->profile_goal:'';
                    $meeting_data[$key]->action_required = $require_action;
                    $meeting_data[$key]->display_status = $display_status;
                    $meeting_data[$key]->parsed_confirmed_meeting_date = $parsed_confirmed_meeting_date;
                    $meeting_data[$key]->parsed_confirmed_meeting_starttime = $parsed_confirmed_meeting_starttime;
                    $meeting_data[$key]->parsed_confirmed_meeting_endtime = $parsed_confirmed_meeting_endtime;
                    
//                    $meeting_data[$key]->confirmed_meeting_starttime_unix = $confirmed_meeting_starttime_unix;
                    $meeting_data[$key]->confirmed_meeting_endtime_unix = $confirmed_meeting_endtime_unix;
                    $meeting_data[$key]->parsed_meeting_date = $parsed_meeting_date;
                    $meeting_data[$key]->now = strtotime(now());
                    $meeting_data[$key]->confirmed_meeting_secondspast = $confirmed_meeting_secondspast;
                    $meeting_data[$key]->confirmed_meeting_ispast = $confirmed_meeting_ispast;
                }  
            }
            return response()->json([
                'statusCode' => 200,
                'Success' => 'Successfully Data Fatched',
                'message' => 'Request has been processed',
                'Data' => $request->user()->onboarding_complete,
                'progress' => $request->user()->progress,
                'adviseeData' => $adviseesData,
                'userData' => $userData,
                'backgroundData' => $backgroundData,
                'meetingData' => $meeting_data?$meeting_data:'',
                'Completed_meeting' => count($completed_meetings),
            ]);
        }else{
            return response()->json([
                'status' => 500,
                'message' => 'Unauthorised or Token Expired!',
            ]);
        }
    }
    public function SetAdvisorMeetingOutcome(Request $request){
	        $client = new Client();
	        $meetingData = DB::table('meetings')->where('id', $request->meetingId)->first();
	        $AdvisorData = DB::table('users')->where('AdvisorID', $meetingData->AdvisorID)->first();
	        $AdviseeData = DB::table('users')->leftJoin('advisees', 'users.AdviseeID', '=', 'advisees.AdviseeID')->where('users.AdviseeID', $meetingData->AdviseeID)->first();

					if($request->meetingoutcome == "advisornoshow") { // ADVISORNOSHOW
						$request->advisor_meetingfinalized = 1;

// send advisornoshow email to advisee via make  (msg 6 https://docs.google.com/document/d/1Z_C4YefVWi5opSXx3UwsqavZGNYh7LRhgmwn57dLdew)
		        $messageresult = $client->request('POST', 'https://hook.us1.make.com/fahmvcaxvxfhzrtxbtbr2melwwf9gdy5', [	
	            'form_params' => [
	                'advisor_first_name' => $AdvisorData->firstname,
	                'advisor_last_name' =>  $AdvisorData->lastname,
	                'advisor_email' => $AdvisorData->email,
	                'advisee_first_name' => $AdviseeData->firstname,
	                'advisee_last_name' => $AdviseeData->lastname,
	                'advisee_email' => $AdviseeData->email
	            ]
        		]);
// credit coffeechat to advisee
//*** UPDATE MEETINGS TABLE WITH NOSHOW STATUS
					$result = DB::table('meetings')->upsert([
							'id' => $meetingData->id,
							'meeting_status' => "Advisor No-Show"
					],'MeetingId');
		        $newchats = $AdviseeData->monthly_requests_remaining + 1;
						DB::table('advisees')->where('AdviseeID', $meetingData->AdviseeID)->update([
	            'monthly_requests_remaining' => $newchats
						],'AdviseeID');

					} else if($request->meetingoutcome == "adviseenoshow") { // ADVISEENOSHOW

// send adviseenoshow email to advisee via make (msg 7 https://docs.google.com/document/d/1Z_C4YefVWi5opSXx3UwsqavZGNYh7LRhgmwn57dLdew)
						$request->advisor_meetingfinalized = 1;
						$messageresult = $client->request('POST', 'https://hook.us1.make.com/q21ess6ptto7tg128prm8t21cmv03u6b', [	
	            'form_params' => [
	                'advisor_first_name' => $AdvisorData->firstname,
	                'advisor_last_name' =>  $AdvisorData->lastname,
	                'advisor_email' => $AdvisorData->email,
	                'advisee_first_name' => $AdviseeData->firstname,
	                'advisee_last_name' => $AdviseeData->lastname,
	                'advisee_email' => $AdviseeData->email
	            ]
        		]);        
//*** UPDATE MEETINGS TABLE WITH NOSHOW STATUS
						$result = DB::table('meetings')->upsert([
								'id' => $meetingData->id,
								'meeting_status' => "Advisee No-Show"
						],'MeetingId');
					} else if($request->meetingoutcome == "meetingoccurred") { // MEETINGOCCURRED
// set Completed status if not already set
						$result = DB::table('meetings')->upsert([
								'id' => $meetingData->id,
								'meeting_status' => "Completed"
						],'MeetingId');
						
					}
					$result = DB::table('meeting_outcome')->upsert([
							'MeetingID' => $request->meetingId,
							'meetingoutcome' => $request->meetingoutcome,
							'advisor_continue' => $request->advisor_continue,
							'advisor_feedback' => $request->feedbackmessage,
	            'advisor_meetingfinalized' => $request->advisor_meetingfinalized
					],'MeetingID');
					
	        if($result) {
	        	return response()->json([
	            'statusCode' => 200,
		        ]); 
		      } else {
	        	return response()->json([
	            'statusCode' => 500,
		        ]); 
		      }
					
    }


    public function SetAdviseeMeetingOutcome(Request $request){
    			$meetingfinalized = 0;
    			if($request->advisee_continue) {$meetingfinalized = 1;}
					$result = DB::table('meeting_outcome')->upsert([
							'MeetingID' => $request->meetingId,
							'meetingoutcome' => $request->meetingoutcome,
	            'advisee_continue' => $request->advisee_continue,
	            'advisee_meetingfinalized' => $meetingfinalized
					],'MeetingID');

		        $client = new Client();
		        $meetingData = DB::table('meetings')->where('id', $request->meetingId)->first();
		        $AdvisorData = DB::table('users')->where('AdvisorID', $meetingData->AdvisorID)->first();
		        $AdviseeData = DB::table('users')->leftJoin('advisees', 'users.AdviseeID', '=', 'advisees.AdviseeID')->where('users.AdviseeID', $meetingData->AdviseeID)->first();
					
					if($request->meetingoutcome == "advisornoshow") { // advisornoshow
						DB::table('meetings')->where('id', $request->meetingId)->update([
	            'id' => $request->meetingId,
	            'meeting_status' => "Advisor No-Show"
						],'id');

//		        Log::debug('advisornoshow');
// send advisornoshow email to advisor via make

		        $advisee_thankyou_response = $client->request('POST', 'https://hook.us1.make.com/69kf2c3frutb5iq22objkfbqe5k6by4x', [	
	            'form_params' => [
	                'advisor_first_name' => $AdvisorData->firstname,
	                'advisor_last_name' =>  $AdvisorData->lastname,
	                'advisor_email' => $AdvisorData->email,
	                'advisee_first_name' => $AdviseeData->firstname,
	                'advisee_last_name' => $AdviseeData->lastname,
	                'advisee_email' => $AdviseeData->email
	            ]
        		]);
// credit coffeechat to advisee
		        $newchats = $AdviseeData->monthly_requests_remaining + 1;
						DB::table('advisees')->where('AdviseeID', $meetingData->AdviseeID)->update([
	            'monthly_requests_remaining' => $newchats
						],'AdviseeID');
//		        Log::debug('Advisee '.$meetingData->AdviseeID.' had '.$AdviseeData->monthly_requests_remaining.' ... changed that to '.$newchats);

// send advisornoshow email to advisee via make ?

// log meeting as finalized by advisee
						DB::table('meeting_outcome')->where('MeetingID', $request->meetingId)->update([
	            'MeetingID' => $request->meetingId,
	            'advisee_meetingfinalized' => 1
						],'MeetingID');


					} else if($request->meetingoutcome == "adviseenoshow") { // ADVISEENOSHOW
// change meeting_status to Advisee No-Show
						DB::table('meetings')->where('id', $request->meetingId)->update([
	            'meeting_status' => "Advisee No-Show"
						],'MeetingID');
// log meetingoutcome as finalized by advisee
						DB::table('meeting_outcome')->where('MeetingID', $request->meetingId)->update([
	            'MeetingID' => $request->meetingId,
	            'advisee_meetingfinalized' => 1
						],'MeetingID');
// send adviseenoshow email to advisor via make
// ** Technically this should only be sent if the updates above were successful... - JMS 1.19.2024
						$advisee_thankyou_response = $client->request('POST', 'https://hook.us1.make.com/riwuv8tlk7k2wdms8irvmj1uy5yomyw8', [	
	            'form_params' => [
	                'advisor_first_name' => $AdvisorData->firstname,
	                'advisor_last_name' =>  $AdvisorData->lastname,
	                'advisor_email' => $AdvisorData->email,
	                'advisee_first_name' => $AdviseeData->firstname,
	                'advisee_last_name' => $AdviseeData->lastname,
	                'advisee_email' => $AdviseeData->email
	            ]
        		]);        

					} else if($request->meetingoutcome == "meetingoccurred") { // MEETINGOCCURRED
// set Completed status if not already set
						$result = DB::table('meetings')->upsert([
								'id' => $meetingData->id,
								'meeting_status' => "Completed"
						],'MeetingID');

					}
					$messagesent = "";
					$thankyoumessagedate = "";
				
					if($request->thankyoumessage && $request->meetingoutcome == "meetingoccurred") {
// relay thank you message to advisor
		        $advisee_thankyou_response = $client->request('POST', 'https://hook.us1.make.com/eqn4u27q7cwfze52fvidulahgonpj6vl', [	
	            'form_params' => [
	                'advisor_first_name' => $AdvisorData->firstname,
	                'advisor_last_name' =>  $AdvisorData->lastname,
	                'advisor_email' => $AdvisorData->email,
	                'advisee_first_name' => $AdviseeData->firstname,
	                'advisee_last_name' => $AdviseeData->lastname,
	                'message' =>  $request->thankyoumessage
	            ]
        		]);
        		if($advisee_thankyou_response) {
// this is where we'd log a copy of the message
// log date message sent and meeting as finalized by advisee
       			
					  	$thankyoumessagedate = Carbon::now()->toDateTimeString();
							DB::table('meeting_outcome')->where('MeetingID', $request->meetingId)->update([
		            'MeetingID' => $request->meetingId,
		            'advisee_thankyou_sent' => $thankyoumessagedate,
		            'advisee_meetingfinalized' => 1
							],'MeetingID');
					  }

					} else if($request->nothankyou == "1") {
//		        Log::debug('nothankyousent');
// log meeting as finalized by advisee
							DB::table('meeting_outcome')->where('MeetingID', $request->meetingId)->update([
		            'MeetingID' => $request->meetingId,
		            'advisee_meetingfinalized' => 1
							],'MeetingID');
					}
	        if($result) {
	        	return response()->json([
	            'statusCode' => 200,
		        ]); 
		      } else {
	        	return response()->json([
	            'statusCode' => 500,
		        ]); 
		      }
    }

    public function AdviseeConfirmMeeting(Request $request){

        $meeting_id = $request->meeting_id;

        $timezoneKey = DB::table('time_zones')->where('name', $request->interval_timezone)->first();

        $date_int_1_from   = Carbon::parse($request->date.' '.$request->from); // Carbon Parse
        $date_int_1_to   = Carbon::parse($request->date.' '.$request->to); // Carbon Parse

        $interval_1_dateWithTimezone_from = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_1_from, $timezoneKey->key);
        $interval_1_dateWithTimezone_from->setTimezone('UTC');

        $interval_1_dateWithTimezone_to = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_1_to, $timezoneKey->key);
        $interval_1_dateWithTimezone_to->setTimezone('UTC');

        $meeting_data = DB::table('meetings')->where('id', $meeting_id)->first();

        DB::table('meetings')->where('id', $meeting_id)->update([
            'meeting_status'=>'Confirmed',
            'meeting_first_confirmed_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
            'last_status_update_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
            'starttime' => $interval_1_dateWithTimezone_from,
            'endtime' => $interval_1_dateWithTimezone_to,
            'confirmed_timezone' => $request->interval_timezone
        ]);

        $message_instance= DB::table('messages')->insertGetId([
            'AdvisorID' => $meeting_data->AdvisorID,
            'AdviseeID' => $meeting_data->AdviseeID,
            'initiating_party' => 'Advisee',
            'message' => $request->note,
            'meetingID' => $meeting_id,
            'message_timestamp_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
            'message_type' => 'Confirmation'
        ]);

        $client = new Client();

        $AdvisorData = DB::table('users')->where('AdvisorID', $meeting_data->AdvisorID)->first();
        $AdviseeData = DB::table('users')->where('AdviseeID', $meeting_data->AdviseeID)->first();
        $MeetingData = DB::table('meetings')->where('id', $meeting_id)->first();

        $advisee_meeting_email = $AdviseeData->meeting_email?$AdviseeData->meeting_email:$AdviseeData->email;

        //Message To Advisee
        $advisee_make_response = $client->request('POST', 'https://hook.us1.make.com/fpsavlhi47yeua09d5fyn1qzs8xuiare', [
            'form_params' => [
                'advisee_meeting_email' => $advisee_meeting_email,
                'subject' => '[Candoor] Confirmed: '.$MeetingData->meetingtype .' with '.$AdvisorData->firstname .' '.$AdvisorData->lastname ,
                'advisor_first_name' => $AdvisorData->firstname,
                'advisor_last_name' =>  $AdvisorData->lastname,
                'advisee_first_name' => $AdviseeData->firstname,
                'advisee_last_name' => $AdviseeData->lastname,
                'meeting_type' => $MeetingData->meetingtype,
                'meeting_length' => $MeetingData->meeting_length_minutes,
                'message' =>  $request->note,
                'meeting_date' =>  $interval_1_dateWithTimezone_from->format('l, M jS'),
                'starttime' =>  $request->from,
                'endtime' =>  $request->to,
                'confirmed_timezone' => $request->interval_timezone,
            ]
        ]);

        $advisor_meeting_email = $AdvisorData->meeting_email?$AdvisorData->meeting_email:$AdvisorData->email;
        $MeetingMessage = DB::table('messages')->where('meetingID', $meeting_id)->where('message_type', 'Initial Advisee Message')->first();


        //Message To Advisor
        $advisor_make_response = $client->request('POST', 'https://hook.us1.make.com/6veoi807tdj8p7ff0t6okah4owjdci6j', [
            'form_params' => [
                'advisor_meeting_email' => $advisor_meeting_email,
                'subject' => '[Candoor] Confirmed: '.$MeetingData->meetingtype .' with '.$AdviseeData->firstname .' '.$AdviseeData->lastname,
                'advisor_first_name' => $AdvisorData->firstname,
                'advisor_last_name' =>  $AdvisorData->lastname,
                'advisee_first_name' => $AdviseeData->firstname,
                'advisee_last_name' => $AdviseeData->lastname,
                'meeting_type' => $MeetingData->meetingtype,
                'meeting_length' => $MeetingData->meeting_length_minutes,
                'original_message' =>  $MeetingMessage->message,
                'meeting_date' =>  $interval_1_dateWithTimezone_from->format('l, M jS'),
                'starttime' =>  $request->from,
                'endtime' =>  $request->to,
                'confirmed_timezone' => $request->interval_timezone,
            ]
        ]);

        $send_meeting_invitation = $client->request('POST', 'https://hook.us1.make.com/46h3dxud8x9xht4od6spiu77rvd9fv66', [
            'form_params' => [
                'advisor_meeting_email' => $advisor_meeting_email,
                'advisee_meeting_email' => $advisee_meeting_email,
                'subject' => '[Candoor] '.$MeetingData->meetingtype .' with '.$AdvisorData->firstname .' '.$AdvisorData->lastname ,
                'advisor_first_name' => $AdvisorData->firstname,
                'advisor_last_name' =>  $AdvisorData->lastname,
                'advisee_first_name' => $AdviseeData->firstname,
                'advisee_last_name' => $AdviseeData->lastname,
                'meeting_type' => $MeetingData->meetingtype,
                'meeting_length' => $MeetingData->meeting_length_minutes,
                'original_message' =>  $MeetingMessage->message,
                'meeting_date' =>  $interval_1_dateWithTimezone_from->format('Y-m-d'),
                'starttime' =>  $interval_1_dateWithTimezone_from->format('Y-m-d').' '.$request->from,
                'endtime' =>  $interval_1_dateWithTimezone_from->format('Y-m-d').' '.$request->to,
                'confirmed_timezone' => $timezoneKey->key,
                'advisee_profile' =>  env('FRONTEND_URL').'/advisee/'.$AdviseeData->AdviseeID,
                'advisor_profile' =>  env('FRONTEND_URL').'/advisor/'.$AdvisorData->AdvisorID,
                'advisor_cancel_reschedule' =>  env('FRONTEND_URL').'/advisor/confirm-meeting/request-confirmed/'.$MeetingData->id,
                'advisee_cancel_reschedule' =>  env('FRONTEND_URL').'/advisee/confirm-meeting/request-confirmed/'.$MeetingData->id,
            ]
        ]);


        return response()->json([
            'advisee_make_response' => $advisee_make_response->getStatusCode(),
            'advisor_make_response' => $advisor_make_response->getStatusCode(),
            'send_meeting_invitation_response' => $send_meeting_invitation->getBody(),
            'statusCode' => 200,
            'Success' => 'Successfully Data Fetched',
            'message' => 'Request has been processed',
        ]); 
    }

    public function AdvisorConfirmMeeting(Request $request){
        $meeting_id = $request->meeting_id;

        $timezoneKey = DB::table('time_zones')->where('name', $request->interval_timezone)->first();

        $date_int_1_from   = Carbon::parse($request->date.' '.$request->from); // Carbon Parse
        $date_int_1_to   = Carbon::parse($request->date.' '.$request->to); // Carbon Parse

        $interval_1_dateWithTimezone_from = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_1_from, $timezoneKey->key);
        $interval_1_dateWithTimezone_from->setTimezone('UTC');

        $interval_1_dateWithTimezone_to = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_1_to, $timezoneKey->key);
        $interval_1_dateWithTimezone_to->setTimezone('UTC');

        $meeting_data = DB::table('meetings')->where('id', $meeting_id)->first();

        

        DB::table('meetings')->where('id', $meeting_id)->update([
            'meeting_status'=>'Confirmed',
            'meeting_first_confirmed_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
            'last_status_update_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
            'starttime' => $interval_1_dateWithTimezone_from,
            'endtime' => $interval_1_dateWithTimezone_to,
            'confirmed_timezone' => $request->interval_timezone
        ]);

        $message_instance= DB::table('messages')->insertGetId([
            'AdvisorID' => $meeting_data->AdvisorID,
            'AdviseeID' => $meeting_data->AdviseeID,
            'initiating_party' => 'Advisor',
            'message' => $request->note,
            'meetingID' => $meeting_id,
            'message_timestamp_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
            'message_type' => 'Confirmation'
        ]);


        $client = new Client();

        $AdvisorData = DB::table('users')->where('AdvisorID', $meeting_data->AdvisorID)->first();
        $AdviseeData = DB::table('users')->where('AdviseeID', $meeting_data->AdviseeID)->first();
        $MeetingData = DB::table('meetings')->where('id', $meeting_id)->first();

        $advisee_meeting_email = $AdviseeData->meeting_email?$AdviseeData->meeting_email:$AdviseeData->email;

        //Message To Advisee
        $advisee_make_response = $client->request('POST', 'https://hook.us1.make.com/fpsavlhi47yeua09d5fyn1qzs8xuiare', [
            'form_params' => [
                'advisee_meeting_email' => $advisee_meeting_email,
                'subject' => '[Candoor] Confirmed: '.$MeetingData->meetingtype .' with '.$AdvisorData->firstname .' '.$AdvisorData->lastname ,
                'advisor_first_name' => $AdvisorData->firstname,
                'advisor_last_name' =>  $AdvisorData->lastname,
                'advisee_first_name' => $AdviseeData->firstname,
                'advisee_last_name' => $AdviseeData->lastname,
                'meeting_type' => $MeetingData->meetingtype,
                'meeting_length' => $MeetingData->meeting_length_minutes,
                'message' =>  $request->note,
                'meeting_date' =>  $interval_1_dateWithTimezone_from->format('l, M jS'),
                'starttime' =>  $request->from,
                'endtime' =>  $request->to,
                'confirmed_timezone' => $request->interval_timezone,
            ]
        ]);

        $advisor_meeting_email = $AdvisorData->meeting_email?$AdvisorData->meeting_email:$AdvisorData->email;
        $MeetingMessage = DB::table('messages')->where('meetingID', $meeting_id)->where('message_type', 'Initial Advisee Message')->first();

        //Message To Advisor
        $advisor_make_response = $client->request('POST', 'https://hook.us1.make.com/6veoi807tdj8p7ff0t6okah4owjdci6j', [
            'form_params' => [
                'advisor_meeting_email' => $advisor_meeting_email,
                'subject' => '[Candoor] Confirmed: '.$MeetingData->meetingtype .' with '.$AdviseeData->firstname .' '.$AdviseeData->lastname,
                'advisor_first_name' => $AdvisorData->firstname,
                'advisor_last_name' =>  $AdvisorData->lastname,
                'advisee_first_name' => $AdviseeData->firstname,
                'advisee_last_name' => $AdviseeData->lastname,
                'meeting_type' => $MeetingData->meetingtype,
                'meeting_length' => $MeetingData->meeting_length_minutes,
                'original_message' =>  $MeetingMessage->message,
                'meeting_date' =>  $interval_1_dateWithTimezone_from->format('l, M jS'),
                'starttime' =>  $request->from,
                'endtime' =>  $request->to,
                'confirmed_timezone' => $request->interval_timezone,
            ]
        ]);

        //Send Meeting Invitation
        $send_meeting_invitation = $client->request('POST', 'https://hook.us1.make.com/46h3dxud8x9xht4od6spiu77rvd9fv66', [
            'form_params' => [
                'advisor_meeting_email' => $advisor_meeting_email,
                'advisee_meeting_email' => $advisee_meeting_email,
                'subject' => '[Candoor] '.$MeetingData->meetingtype .' with '.$AdvisorData->firstname .' '.$AdvisorData->lastname ,
                'advisor_first_name' => $AdvisorData->firstname,
                'advisor_last_name' =>  $AdvisorData->lastname,
                'advisee_first_name' => $AdviseeData->firstname,
                'advisee_last_name' => $AdviseeData->lastname,
                'meeting_type' => $MeetingData->meetingtype,
                'meeting_length' => $MeetingData->meeting_length_minutes,
                'original_message' =>  $MeetingMessage->message,
                'meeting_date' =>  $interval_1_dateWithTimezone_from->format('Y-m-d'),
                'starttime' =>  $interval_1_dateWithTimezone_from->format('Y-m-d').' '.$request->from,
                'endtime' =>  $interval_1_dateWithTimezone_from->format('Y-m-d').' '.$request->to,
                'confirmed_timezone' => $timezoneKey->key,
                'advisee_profile' =>  env('FRONTEND_URL').'/advisee/'.$AdviseeData->AdviseeID,
                'advisor_profile' =>  env('FRONTEND_URL').'/advisor/'.$AdvisorData->AdvisorID,
                'advisor_cancel_reschedule' =>  env('FRONTEND_URL').'/advisor/confirm-meeting/request-confirmed/'.$MeetingData->id,
                'advisee_cancel_reschedule' =>  env('FRONTEND_URL').'/advisee/confirm-meeting/request-confirmed/'.$MeetingData->id,
            ]
        ]);

        $send_meeting_invitation_response_json = json_decode((string) $send_meeting_invitation->getBody());

        $send_meeting_invitation_response = (string) $send_meeting_invitation->getBody();
        DB::table('meetings')->where('id', $MeetingData->id)->update([
            'last_status_update_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
            'GoogleCalendar_EventID' => $send_meeting_invitation_response_json->google_event_ID,
            'zoom_meeting_ID' => $send_meeting_invitation_response_json->zoom_meeting_ID,
            'zoom_meeting_UUID' => $send_meeting_invitation_response_json->zoom_meeting_UUID,
            'zoom_meeting_join_url' => $send_meeting_invitation_response_json->zoom_meeting_JoinURL,
            'zoom_meeting_start_url' => $send_meeting_invitation_response_json->zoom_meeting_StartURL,
        ]);


        return response()->json([
            'advisee_make_response' => $advisee_make_response->getStatusCode(),
            'advisor_make_response' => $advisor_make_response->getStatusCode(),
            // 'send_meeting_invitation_response' => json_decode((string) $send_meeting_invitation->getBody()),
            'send_meeting_invitation_response' => $send_meeting_invitation_response_json,
            'statusCode' => 200,
            'Success' => 'Successfully Data Fatched',
            'message' => 'Request has been processed',
        ]); 

    }


    public function CancelMeeting(Request $request){
        $meeting_id = $request->meeting_id;
        $meeting_data = DB::table('meetings')->where('id', $meeting_id)->first();

        $client = new Client();

        $AdvisorData = DB::table('users')->where('AdvisorID', $meeting_data->AdvisorID)->first();
        $AdviseeData = DB::table('users')->where('AdviseeID', $meeting_data->AdviseeID)->first();
        $MeetingData = DB::table('meetings')->where('id', $meeting_id)->first();

if($MeetingData->starttime) {
            $meeting_start = Carbon::createFromFormat('Y-m-d H:i:s', $MeetingData->starttime);
            $meeting_end = Carbon::createFromFormat('Y-m-d H:i:s', $MeetingData->endtime);
            $meeting_date = $meeting_start->format('l, M jS');
} else {
						$meeting_start = "";
						$meeting_end = "";
						$meeting_date = "";
}
        if($request->user()->hasRole('Advisor')){
				//// ADVISOR
            $meeting_email = $AdviseeData->meeting_email?$AdviseeData->meeting_email:$AdviseeData->email;

            $res = $client->request('POST', 'https://hook.us1.make.com/9swplx82x4kqrtrd3513jd2uz3s6ke2v', [
                'form_params' => [
                    'cancelee_meeting_email' => $meeting_email,
                    'subject' => '[Candoor] Cancelled: ' .$MeetingData->meetingtype.' with  '.$AdvisorData->firstname .' '. $AdvisorData->lastname,
                    'cancelee_first_name' => $AdviseeData->firstname,
                    'cancelee_last_name' => $AdviseeData->lastname,
                    'canceler_first_name' => $AdvisorData->firstname,
                    'canceler_last_name' =>  $AdvisorData->lastname,
                    'meeting_type' => $MeetingData->meetingtype,
                    'meeting_length' => $MeetingData->meeting_length_minutes,
                    'message' =>  $request->note,
// THESE ARE PROBLEMATIC IF THERE IS NO MEETING YET
// BUT THE MAKE EMAIL REQUIRES THESE TO HAVE VALUES - JMS 1/12/24
                    'meeting_date' =>  $meeting_date,
//                    'starttime' =>  $MeetingData->format('h:iA'),
//                    'endtime' =>  $MeetingData->format('h:iA'),
                    'confirmed_timezone' => $MeetingData->confirmed_timezone,
                    'cancelee' => 'Advisee'
                ]
            ]);
            $logdata = print_r($res);
		        if($logdata != 1) {Log::debug('APIAuthController Line 3721 - MAKE webhook error: '.$logdata);}


            DB::table('meetings')->where('id', $meeting_id)->update([
                'meeting_status' => 'Advisor Cancelled',
                'last_status_update_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'cancellation_time_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'advisor_cancelled' => 1,
            ]);

            $message_instance= DB::table('messages')->insertGetId([
                'AdvisorID' => $meeting_data->AdvisorID,
                'AdviseeID' => $meeting_data->AdviseeID,
                'initiating_party' => 'Advisor',
                'message' => $request->note,
                'meetingID' => $meeting_id,
                'message_timestamp_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'message_type' => 'Cancel'
            ]);

        }else{
        	///// ADVISEE
            $meeting_email = $AdvisorData->meeting_email?$AdvisorData->meeting_email:$AdvisorData->email;

            $res = $client->request('POST', 'https://hook.us1.make.com/9swplx82x4kqrtrd3513jd2uz3s6ke2v', [
                'form_params' => [
                    'cancelee_meeting_email' => $meeting_email,
                    'subject' => '[Candoor] Cancelled: ' .$MeetingData->meetingtype.' with  '.$AdviseeData->firstname .' '. $AdviseeData->lastname,
                    'cancelee_first_name' => $AdvisorData->firstname,
                    'cancelee_last_name' => $AdvisorData->lastname,
                    'canceler_last_name' => $AdviseeData->firstname,
                    'rescheduler_last_name' =>  $AdviseeData->lastname,
                    'meeting_type' => $MeetingData->meetingtype,
                    'meeting_length' => $MeetingData->meeting_length_minutes,
                    'message' =>  $request->note,
// THESE ARE PROBLEMATIC IF THERE IS NO MEETING YET
// BUT THE MAKE EMAIL REQUIRES THESE TO HAVE VALUES - JMS 1/12/24
                    'meeting_date' =>  $meeting_date,
                    'starttime' =>  $meeting_start->format('h:iA'),
                    'endtime' =>  $meeting_end->format('h:iA'),
                    'confirmed_timezone' => $MeetingData->confirmed_timezone,
                    'cancelee' => 'Advisor'
                ]
            ]);

            DB::table('meetings')->where('id', $meeting_id)->update([
                'meeting_status' => 'Advisee Cancelled',
                'last_status_update_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'cancellation_time_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'advisee_cancelled' => 1,
            ]);

            $message_instance= DB::table('messages')->insertGetId([
                'AdvisorID' => $meeting_data->AdvisorID,
                'AdviseeID' => $meeting_data->AdviseeID,
                'initiating_party' => 'Advisor',
                'message' => $request->note,
                'meetingID' => $meeting_id,
                'message_timestamp_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'message_type' => 'Cancel'
            ]);
        }

//
/* I THINK THIS EMAIL SEND IS UNNECESSARY GIVEN THE ABOVE. PLUS I CAN'T FIND THE HOOK IN MAKE - JMS 1/17
        $cancel_meeting_request = $client->request('POST', 'https://hook.us1.make.com/7d766sjpq43quat7s7syk6aymfft5cwt', [
            'form_params' => [
                'zoom_meeting_ID' => $MeetingData->zoom_meeting_ID,
                'google_event_ID' => $MeetingData->GoogleCalendar_EventID
            ]
        ]);
*/
        return response()->json([
            'statusCode' => 200,
            'Success' => 'Successfully Data Fatched',
        ]);


    }

    public function ProposeAlternativeTimeAdvisor(Request $request){
        
        $meeting_id = $request->meeting_id;
        $meeting_data = DB::table('meetings')->where('id', $meeting_id)->first();

        $proposedTimezoneKey = DB::table('time_zones')->where('name', $request->proposed_timezone)->first();

        $date_int_1_from   = Carbon::parse($request->interval_1_date.' '.$request->interval_1_from); // Carbon Parse
        $date_int_1_to   = Carbon::parse($request->interval_1_date.' '.$request->interval_1_to); // Carbon Parse

        $interval_1_dateWithTimezone_from = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_1_from, $proposedTimezoneKey->key);
        $interval_1_dateWithTimezone_from->setTimezone('UTC');

        $interval_1_dateWithTimezone_to = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_1_to, $proposedTimezoneKey->key);
        $interval_1_dateWithTimezone_to->setTimezone('UTC');

        if($request->rescheduling){

            $interval_instance1= DB::table('time_intervals')->insertGetId([
                'AdvisorID' => $meeting_data->AdvisorID,
                'AdviseeID' => $meeting_data->AdviseeID,
                'meetingID' => $meeting_id,
                'ActionTakenBy' => 'Advisor',
                'interval_type' => 'Reschedule - Advisor',
                'created_time' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'time_was_accepted' => 0,
                'starttime' => $interval_1_dateWithTimezone_from,
                'endtime' => $interval_1_dateWithTimezone_to,
                'timezone' => $request->proposed_timezone
            ]);

            $date_int_2_from   = Carbon::parse($request->interval_2_date.' '.$request->interval_2_from); // Carbon Parse
            $date_int_2_to   = Carbon::parse($request->interval_2_date.' '.$request->interval_2_to); // Carbon Parse

            $interval_2_dateWithTimezone_from = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_2_from, $proposedTimezoneKey->key);
            $interval_2_dateWithTimezone_from->setTimezone('UTC');

            $interval_2_dateWithTimezone_to = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_2_to, $proposedTimezoneKey->key);
            $interval_2_dateWithTimezone_to->setTimezone('UTC');

            $interval_instance2= DB::table('time_intervals')->insertGetId([
                'AdvisorID' => $meeting_data->AdvisorID,
                'AdviseeID' => $meeting_data->AdviseeID,
                'meetingID' => $meeting_id,
                'ActionTakenBy' => 'Advisor',
                'interval_type' => 'Reschedule - Advisor',
                'created_time' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'time_was_accepted' => 0,
                'starttime' => $interval_2_dateWithTimezone_from,
                'endtime' => $interval_2_dateWithTimezone_to,
                'timezone' => $request->proposed_timezone
            ]);

            $date_int_3_from   = Carbon::parse($request->interval_3_date.' '.$request->interval_3_from); // Carbon Parse
            $date_int_3_to   = Carbon::parse($request->interval_3_date.' '.$request->interval_3_to); // Carbon Parse

            $interval_3_dateWithTimezone_from = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_3_from, $proposedTimezoneKey->key);
            $interval_3_dateWithTimezone_from->setTimezone('UTC');

            $interval_3_dateWithTimezone_to = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_3_to, $proposedTimezoneKey->key);
            $interval_3_dateWithTimezone_to->setTimezone('UTC');

            $interval_instance3= DB::table('time_intervals')->insertGetId([
                'AdvisorID' => $meeting_data->AdvisorID,
                'AdviseeID' => $meeting_data->AdviseeID,
                'meetingID' => $meeting_id,
                'ActionTakenBy' => 'Advisor',
                'interval_type' => 'Reschedule - Advisor',
                'created_time' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'time_was_accepted' => 0,
                'starttime' => $interval_3_dateWithTimezone_from,
                'endtime' => $interval_3_dateWithTimezone_to,
                'timezone' => $request->proposed_timezone
            ]);

            $message_instance= DB::table('messages')->insertGetId([
                'AdvisorID' => $meeting_data->AdvisorID,
                'AdviseeID' => $meeting_data->AdviseeID,
                'initiating_party' => 'Advisor',
                'message' => $request->note,
                'meetingID' => $meeting_id,
                'message_timestamp_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'message_type' => 'Reschedule',
            ]);


            $client = new Client();

            $AdvisorData = DB::table('users')->where('AdvisorID', $meeting_data->AdvisorID)->first();
            $AdviseeData = DB::table('users')->where('AdviseeID', $meeting_data->AdviseeID)->first();
            $MeetingData = DB::table('meetings')->where('id', $meeting_id)->first();
    
            $meeting_email = $AdviseeData->meeting_email?$AdviseeData->meeting_email:$AdviseeData->email;

            $meeting_start = Carbon::createFromFormat('Y-m-d H:i:s', $MeetingData->starttime);
            $meeting_end = Carbon::createFromFormat('Y-m-d H:i:s', $MeetingData->endtime);
            $meeting_date = $meeting_start->format('l, M jS');

            $original_meeting_status = $MeetingData->meeting_status;
    
            $res = $client->request('POST', 'https://hook.us1.make.com/cq8a9erbtpytt7uj4n91o48hysy3rk19', [
                'form_params' => [
                    'reschedulee_meeting_email' => $meeting_email,
                    'subject' => '[Candoor] Reschedule Request: ' .$MeetingData->meetingtype.' with  '.$AdvisorData->firstname .' '. $AdvisorData->lastname,
                    'reschedulee_first_name' => $AdviseeData->firstname,
                    'reschedulee_last_name' => $AdviseeData->lastname,
                    'rescheduler_first_name' => $AdvisorData->firstname,
                    'rescheduler_last_name' =>  $AdvisorData->lastname,
                    'meeting_type' => $MeetingData->meetingtype,
                    'meeting_length' => $MeetingData->meeting_length_minutes,
                    'message' =>  $request->note,
// THESE ARE PROBLEMATIC IF THERE IS NO MEETING YET
// BUT THE MAKE EMAIL REQUIRES THESE TO HAVE VALUES - JMS 1/12/24
                    'meeting_date' =>  $meeting_date,
                    'starttime' =>  $meeting_start->format('h:iA'),
                    'endtime' =>  $meeting_end->format('h:iA'),
                    'confirmed_timezone' => $MeetingData->confirmed_timezone,
                    'rescheduler' => 'Advisor',
                    'meeting_link' => env('FRONTEND_URL').'/advisee/confirm-meeting/request-unconfirmed/'.$MeetingData->id,
                ]
            ]);

            DB::table('meetings')->where('id', $request->meeting_id)->update([
                'meeting_status' => 'Rescheduling',
                'last_status_update_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'availability_last_provided_by' => 'Advisor',
                'last_status_update_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'starttime' => null,
                'endtime' => null,
                'confirmed_timezone' => null
            ]);


            if($original_meeting_status == 'Confirmed'){
                $cancel_meeting_request = $client->request('POST', 'https://hook.us1.make.com/7d766sjpq43quat7s7syk6aymfft5cwt', [
                    'form_params' => [
                        'zoom_meeting_ID' => $MeetingData->zoom_meeting_ID,
                        'google_event_ID' => $MeetingData->GoogleCalendar_EventID
                    ]
                ]);

                DB::table('meetings')->where('id', $request->meeting_id)->update([
                    'GoogleCalendar_EventID' => null,
                    'zoom_meeting_ID' => null,
                    'zoom_meeting_UUID' => null,
                    'zoom_meeting_join_url' => null,
                    'zoom_meeting_start_url' => null,
                ]);
            }

        }else{

            $interval_instance1= DB::table('time_intervals')->insertGetId([
                'AdvisorID' => $meeting_data->AdvisorID,
                'AdviseeID' => $meeting_data->AdviseeID,
                'meetingID' => $meeting_id,
                'ActionTakenBy' => 'Advisor',
                'interval_type' => 'Alternate times - Advisor',
                'created_time' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'time_was_accepted' => 0,
                'starttime' => $interval_1_dateWithTimezone_from,
                'endtime' => $interval_1_dateWithTimezone_to,
                'timezone' => $request->proposed_timezone
                // 'starttime_EST' => Carbon::parse($request->interval_1_date.' '.$request->interval_1_from),
                // 'endtime_EST' => Carbon::parse($request->interval_1_date.' '.$request->interval_1_to),
            ]);

            $date_int_2_from   = Carbon::parse($request->interval_2_date.' '.$request->interval_2_from); // Carbon Parse
            $date_int_2_to   = Carbon::parse($request->interval_2_date.' '.$request->interval_2_to); // Carbon Parse

            $interval_2_dateWithTimezone_from = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_2_from, $proposedTimezoneKey->key);
            $interval_2_dateWithTimezone_from->setTimezone('UTC');

            $interval_2_dateWithTimezone_to = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_2_to, $proposedTimezoneKey->key);
            $interval_2_dateWithTimezone_to->setTimezone('UTC');

            $interval_instance2= DB::table('time_intervals')->insertGetId([
                'AdvisorID' => $meeting_data->AdvisorID,
                'AdviseeID' => $meeting_data->AdviseeID,
                'meetingID' => $meeting_id,
                'ActionTakenBy' => 'Advisor',
                'interval_type' => 'Alternate times - Advisor',
                'created_time' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'time_was_accepted' => 0,
                'starttime' => $interval_2_dateWithTimezone_from,
                'endtime' => $interval_2_dateWithTimezone_to,
                'timezone' => $request->proposed_timezone
            ]);

            $date_int_3_from   = Carbon::parse($request->interval_3_date.' '.$request->interval_3_from); // Carbon Parse
            $date_int_3_to   = Carbon::parse($request->interval_3_date.' '.$request->interval_3_to); // Carbon Parse

            $interval_3_dateWithTimezone_from = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_3_from, $proposedTimezoneKey->key);
            $interval_3_dateWithTimezone_from->setTimezone('UTC');

            $interval_3_dateWithTimezone_to = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_3_to, $proposedTimezoneKey->key);
            $interval_3_dateWithTimezone_to->setTimezone('UTC');

            $interval_instance3= DB::table('time_intervals')->insertGetId([
                'AdvisorID' => $meeting_data->AdvisorID,
                'AdviseeID' => $meeting_data->AdviseeID,
                'meetingID' => $meeting_id,
                'ActionTakenBy' => 'Advisor',
                'interval_type' => 'Alternate times - Advisor',
                'created_time' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'time_was_accepted' => 0,
                'starttime' => $interval_3_dateWithTimezone_from,
                'endtime' => $interval_3_dateWithTimezone_to,
                'timezone' => $request->proposed_timezone
            ]);

            $message_instance= DB::table('messages')->insertGetId([
                'AdvisorID' => $meeting_data->AdvisorID,
                'AdviseeID' => $meeting_data->AdviseeID,
                'initiating_party' => 'Advisor',
                'message' => $request->note,
                'meetingID' => $meeting_id,
                'message_timestamp_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'message_type' => 'Propose alt times'
            ]);

            DB::table('meetings')->where('id', $request->meeting_id)->update([
                'meeting_status' => 'Alternate Times Proposed',
                'last_status_update_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'availability_last_provided_by' => 'Advisor',
                'last_status_update_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'alternate_times_last_proposed_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
            ]);

            if(!$meeting_data->alternate_times_first_proposed_EST){
                DB::table('meetings')->where('id', $request->meeting_id)->update([
                    'alternate_times_first_proposed_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST')
                ]);
            }


            $client = new Client();

            $AdvisorData = DB::table('users')->where('AdvisorID', $meeting_data->AdvisorID)->first();
            $AdviseeData = DB::table('users')->where('AdviseeID', $meeting_data->AdviseeID)->first();
            $MeetingData = DB::table('meetings')->where('id', $meeting_id)->first();

            $meeting_email = $AdviseeData->meeting_email?$AdviseeData->meeting_email:$AdviseeData->email;


            $res = $client->request('POST', 'https://hook.us1.make.com/prxuhn29c6alttsnyeitd5r5motsq1e2', [
                'form_params' => [
                    'receipient' => $meeting_email,
                    'subject' => '[Candoor] Alternate Times Proposed: '.$AdvisorData->firstname .' '. $AdvisorData->lastname .' - ' .$MeetingData->meetingtype,
                    'proposer_first_name' => $AdvisorData->firstname,
                    'proposer_last_name' =>  $AdvisorData->lastname,
                    'proposee_first_name' => $AdviseeData->firstname,
                    'proposee_last_name' => $AdviseeData->lastname,
                    'meeting_type' => $MeetingData->meetingtype,
                    'meeting_length' => $MeetingData->meeting_length_minutes,
                    'message' =>  $request->note,
                    'proposer' => 'Advisor',
                    'meeting_link' =>  env('FRONTEND_URL').'/advisee/confirm-meeting/request-unconfirmed/'.$MeetingData->id,
                ]
            ]);
        }


    
        return response()->json([
            'make_status_code' => $res->getStatusCode(),
            'statusCode' => 200,
            'Success' => 'Successfully Data Fatched',
        ]);

    }

    public function ProposeAlternativeTimeAdvisee(Request $request){

        $meeting_id = $request->meeting_id;
        $meeting_data = DB::table('meetings')->where('id', $meeting_id)->first();

        $proposedTimezoneKey = DB::table('time_zones')->where('name', $request->proposed_timezone)->first();

        $date_int_1_from   = Carbon::parse($request->interval_1_date.' '.$request->interval_1_from); // Carbon Parse
        $date_int_1_to   = Carbon::parse($request->interval_1_date.' '.$request->interval_1_to); // Carbon Parse

        $interval_1_dateWithTimezone_from = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_1_from, $proposedTimezoneKey->key);
        $interval_1_dateWithTimezone_from->setTimezone('UTC');

        $interval_1_dateWithTimezone_to = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_1_to, $proposedTimezoneKey->key);
        $interval_1_dateWithTimezone_to->setTimezone('UTC');

        if($request->rescheduling){

            $interval_instance1= DB::table('time_intervals')->insertGetId([
                'AdvisorID' => $meeting_data->AdvisorID,
                'AdviseeID' => $meeting_data->AdviseeID,
                'meetingID' => $meeting_id,
                'ActionTakenBy' => 'Advisee',
                'interval_type' => 'Reschedule - Advisee',
                'created_time' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'time_was_accepted' => 0,
                'starttime' => $interval_1_dateWithTimezone_from,
                'endtime' => $interval_1_dateWithTimezone_to,
                'timezone' => $request->proposed_timezone
                // 'starttime_EST' => Carbon::parse($request->interval_1_date.' '.$request->interval_1_from),
                // 'endtime_EST' => Carbon::parse($request->interval_1_date.' '.$request->interval_1_to),
            ]);
    
            $date_int_2_from   = Carbon::parse($request->interval_2_date.' '.$request->interval_2_from); // Carbon Parse
            $date_int_2_to   = Carbon::parse($request->interval_2_date.' '.$request->interval_2_to); // Carbon Parse
    
            $interval_2_dateWithTimezone_from = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_2_from, $proposedTimezoneKey->key);
            $interval_2_dateWithTimezone_from->setTimezone('UTC');

            $interval_2_dateWithTimezone_to = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_2_to, $proposedTimezoneKey->key);
            $interval_2_dateWithTimezone_to->setTimezone('UTC');

            $interval_instance2= DB::table('time_intervals')->insertGetId([
                'AdvisorID' => $meeting_data->AdvisorID,
                'AdviseeID' => $meeting_data->AdviseeID,
                'meetingID' => $meeting_id,
                'ActionTakenBy' => 'Advisee',
                'interval_type' => 'Reschedule - Advisee',
                'created_time' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'time_was_accepted' => 0,
                'starttime' => $interval_2_dateWithTimezone_from,
                'endtime' => $interval_2_dateWithTimezone_to,
                'timezone' => $request->proposed_timezone
            ]);

            $date_int_3_from   = Carbon::parse($request->interval_3_date.' '.$request->interval_3_from); // Carbon Parse
            $date_int_3_to   = Carbon::parse($request->interval_3_date.' '.$request->interval_3_to); // Carbon Parse

            $interval_3_dateWithTimezone_from = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_3_from, $proposedTimezoneKey->key);
            $interval_3_dateWithTimezone_from->setTimezone('UTC');

            $interval_3_dateWithTimezone_to = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_3_to, $proposedTimezoneKey->key);
            $interval_3_dateWithTimezone_to->setTimezone('UTC');

            $interval_instance3= DB::table('time_intervals')->insertGetId([
                'AdvisorID' => $meeting_data->AdvisorID,
                'AdviseeID' => $meeting_data->AdviseeID,
                'meetingID' => $meeting_id,
                'ActionTakenBy' => 'Advisee',
                'interval_type' => 'Reschedule - Advisee',
                'created_time' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'time_was_accepted' => 0,
                'starttime' => $interval_3_dateWithTimezone_from,
                'endtime' => $interval_3_dateWithTimezone_to,
                'timezone' => $request->proposed_timezone
            ]);
    
            $message_instance= DB::table('messages')->insertGetId([
                'AdvisorID' => $meeting_data->AdvisorID,
                'AdviseeID' => $meeting_data->AdviseeID,
                'initiating_party' => 'Advisee',
                'message' => $request->note,
                'meetingID' => $meeting_id,
                'message_timestamp_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'message_type' => 'Reschedule',
            ]);
    
            $client = new Client();

            $AdvisorData = DB::table('users')->where('AdvisorID', $meeting_data->AdvisorID)->first();
            $AdviseeData = DB::table('users')->where('AdviseeID', $meeting_data->AdviseeID)->first();
            $MeetingData = DB::table('meetings')->where('id', $meeting_id)->first();
    
            $meeting_email = $AdvisorData->meeting_email?$AdvisorData->meeting_email:$AdvisorData->email;
if($MeetingData->starttime) {
            $meeting_start = Carbon::createFromFormat('Y-m-d H:i:s', $MeetingData->starttime);
            $meeting_end = Carbon::createFromFormat('Y-m-d H:i:s', $MeetingData->endtime);
            $meeting_date = $meeting_start->format('l, M jS');
} else {
						$meeting_start = "";
						$meeting_end = "";
						$meeting_date = "";
}
            $original_meeting_status = $meeting_data->meeting_status;
    
            $res = $client->request('POST', 'https://hook.us1.make.com/cq8a9erbtpytt7uj4n91o48hysy3rk19', [
                'form_params' => [
                    'reschedulee_meeting_email' => $meeting_email,
                    'subject' => '[Candoor] Reschedule Request: ' .$MeetingData->meetingtype.' with  '.$AdviseeData->firstname .' '. $AdviseeData->lastname,
                    'reschedulee_first_name' => $AdvisorData->firstname,
                    'reschedulee_last_name' => $AdvisorData->lastname,
                    'rescheduler_first_name' => $AdviseeData->firstname,
                    'rescheduler_last_name' =>  $AdviseeData->lastname,
                    'meeting_type' => $MeetingData->meetingtype,
                    'meeting_length' => $MeetingData->meeting_length_minutes,
                    'message' =>  $request->note,
// THESE ARE PROBLEMATIC IF THERE IS NO MEETING YET
// BUT THE MAKE EMAIL REQUIRES THESE TO HAVE VALUES - JMS 1/12/24
                    'meeting_date' =>  $meeting_date,
//                    'starttime' =>  $MeetingData->format('h:iA'),
                    'starttime' =>  '',
//                    'endtime' =>  $MeetingData->format('h:iA'),
                    'endtime' =>  '',
                    'confirmed_timezone' => $MeetingData->confirmed_timezone,
                    'rescheduler' => 'Advisee',
                    'meeting_link' => env('FRONTEND_URL').'/advisor/confirm-meeting/request-unconfirmed/'.$MeetingData->id,
                ]
            ]);

            DB::table('meetings')->where('id', $request->meeting_id)->update([
                'meeting_status' => 'Rescheduling',
                'last_status_update_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'availability_last_provided_by' => 'Advisee',
                'last_status_update_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'starttime' => null,
                'endtime' => null,
                'confirmed_timezone' => null
            ]);

            if($original_meeting_status == 'Confirmed'){
//
/* I THINK THIS EMAIL SEND IS UNNECESSARY GIVEN THE ABOVE. PLUS I CAN'T FIND THE HOOK IN MAKE - JMS 1/17
                $cancel_meeting_request = $client->request('POST', 'https://hook.us1.make.com/7d766sjpq43quat7s7syk6aymfft5cwt', [
                    'form_params' => [
                        'zoom_meeting_ID' => $MeetingData->zoom_meeting_ID,
                        'google_event_ID' => $MeetingData->GoogleCalendar_EventID
                    ]
                ]);
*/
                DB::table('meetings')->where('id', $request->meeting_id)->update([
                    'GoogleCalendar_EventID' => null,
                    'zoom_meeting_ID' => null,
                    'zoom_meeting_UUID' => null,
                    'zoom_meeting_join_url' => null,
                    'zoom_meeting_start_url' => null,
                ]);
            }



        }else{
            $interval_instance1= DB::table('time_intervals')->insertGetId([
                'AdvisorID' => $meeting_data->AdvisorID,
                'AdviseeID' => $meeting_data->AdviseeID,
                'meetingID' => $meeting_id,
                'ActionTakenBy' => 'Advisee',
                'interval_type' => 'Alternate times - Advisee',
                'created_time' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'time_was_accepted' => 0,
                'starttime' => $interval_1_dateWithTimezone_from,
                'endtime' => $interval_1_dateWithTimezone_to,
                'timezone' => $request->proposed_timezone
                // 'starttime_EST' => Carbon::parse($request->interval_1_date.' '.$request->interval_1_from),
                // 'endtime_EST' => Carbon::parse($request->interval_1_date.' '.$request->interval_1_to),
            ]);
    
            $date_int_2_from   = Carbon::parse($request->interval_2_date.' '.$request->interval_2_from); // Carbon Parse
            $date_int_2_to   = Carbon::parse($request->interval_2_date.' '.$request->interval_2_to); // Carbon Parse
    
            $interval_2_dateWithTimezone_from = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_2_from, $proposedTimezoneKey->key);
            $interval_2_dateWithTimezone_from->setTimezone('UTC');

            $interval_2_dateWithTimezone_to = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_2_to, $proposedTimezoneKey->key);
            $interval_2_dateWithTimezone_to->setTimezone('UTC');

            $interval_instance2= DB::table('time_intervals')->insertGetId([
                'AdvisorID' => $meeting_data->AdvisorID,
                'AdviseeID' => $meeting_data->AdviseeID,
                'meetingID' => $meeting_id,
                'ActionTakenBy' => 'Advisee',
                'interval_type' => 'Alternate times - Advisee',
                'created_time' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'time_was_accepted' => 0,
                'starttime' => $interval_2_dateWithTimezone_from,
                'endtime' => $interval_2_dateWithTimezone_to,
                'timezone' => $request->proposed_timezone
            ]);

            $date_int_3_from   = Carbon::parse($request->interval_3_date.' '.$request->interval_3_from); // Carbon Parse
            $date_int_3_to   = Carbon::parse($request->interval_3_date.' '.$request->interval_3_to); // Carbon Parse

            $interval_3_dateWithTimezone_from = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_3_from, $proposedTimezoneKey->key);
            $interval_3_dateWithTimezone_from->setTimezone('UTC');

            $interval_3_dateWithTimezone_to = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_3_to, $proposedTimezoneKey->key);
            $interval_3_dateWithTimezone_to->setTimezone('UTC');

            $interval_instance3= DB::table('time_intervals')->insertGetId([
                'AdvisorID' => $meeting_data->AdvisorID,
                'AdviseeID' => $meeting_data->AdviseeID,
                'meetingID' => $meeting_id,
                'ActionTakenBy' => 'Advisee',
                'interval_type' => 'Alternate times - Advisee',
                'created_time' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'time_was_accepted' => 0,
                'starttime' => $interval_3_dateWithTimezone_from,
                'endtime' => $interval_3_dateWithTimezone_to,
                'timezone' => $request->proposed_timezone
            ]);
    
            $message_instance= DB::table('messages')->insertGetId([
                'AdvisorID' => $meeting_data->AdvisorID,
                'AdviseeID' => $meeting_data->AdviseeID,
                'initiating_party' => 'Advisee',
                'message' => $request->note,
                'meetingID' => $meeting_id,
                'message_timestamp_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'message_type' => 'Propose alt times'
            ]);
    
            DB::table('meetings')->where('id', $request->meeting_id)->update([
                'meeting_status' => 'Alternate Times Proposed',
                'last_status_update_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'availability_last_provided_by' => 'Advisee',
                'last_status_update_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'alternate_times_last_proposed_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
            ]);

            if(!$meeting_data->alternate_times_first_proposed_EST){
                DB::table('meetings')->where('id', $request->meeting_id)->update([
                    'alternate_times_first_proposed_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST')
                ]);
            }
            $client = new Client();

            $AdvisorData = DB::table('users')->where('AdvisorID', $meeting_data->AdvisorID)->first();
            $AdviseeData = DB::table('users')->where('AdviseeID', $meeting_data->AdviseeID)->first();
            $MeetingData = DB::table('meetings')->where('id', $meeting_id)->first();
    
            $meeting_email = $AdvisorData->meeting_email?$AdvisorData->meeting_email:$AdvisorData->email;
    
    
            $res = $client->request('POST', 'https://hook.us1.make.com/prxuhn29c6alttsnyeitd5r5motsq1e2', [
                'form_params' => [
                    'receipient' => $meeting_email,
                    'subject' => '[Candoor] Alternate Times Proposed: '.$AdviseeData->firstname .' '. $AdviseeData->lastname .' - ' .$MeetingData->meetingtype,
                    'proposer_first_name' => $AdviseeData->firstname,
                    'proposer_last_name' =>  $AdviseeData->lastname,
                    'proposee_first_name' => $AdvisorData->firstname,
                    'proposee_last_name' => $AdvisorData->lastname,
                    'meeting_type' => $MeetingData->meetingtype,
                    'meeting_length' => $MeetingData->meeting_length_minutes,
                    'proposer' => 'Advisee',
                    'meeting_link' =>  env('FRONTEND_URL').'/advisor/confirm-meeting/request-unconfirmed/'.$MeetingData->id,
                ]
            ]);
        }

    


        return response()->json([
            'statusCode' => 200,
            'Success' => 'Successfully Data Fatched',
        ]);

    }




    public function UpDateJoinedCommunity(Request $request){

        if($request->user()->hasRole('Advisor')){
            $advisor=DB::table('advisors')->where('UserID',$request->user()->id);
            $advisor->update([            
                'joined_community_timestamp_EST'=>Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'joined_community'=>1,
            ]);

            if($request->user()->onboarding_complete){
                $obj = json_decode($request->user()->onboarding_complete);
                $onboarding_complete =  json_decode(json_encode($obj),true);
                if(!in_array("community", $onboarding_complete)){
                    $completeArr = array_merge($onboarding_complete, ["community"]);
                    DB::table('users')->where('id', $request->user()->id)->update(['onboarding_complete' => json_encode($completeArr)]);
                }
            }else{
                $completeArr = ["community"];
                DB::table('users')->where('id', $request->user()->id)->update(['onboarding_complete' => json_encode($completeArr)]);
            }
            return $this->respondSuccess("Submission Completed Successfully!",200);
        }else{
            $advisee=DB::table('advisees')->where('UserID',$request->user()->id);
            $advisee->update([            
                'joined_community_timestamp_EST'=>Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'joined_community'=>1,
            ]);
            if($request->user()->onboarding_complete){
                $obj = json_decode($request->user()->onboarding_complete);
                $onboarding_complete =  json_decode(json_encode($obj),true);
                if(!in_array("community", $onboarding_complete)){
                    $completeArr = array_merge($onboarding_complete, ["community"]);
                    DB::table('users')->where('id', $request->user()->id)->update(['onboarding_complete' => json_encode($completeArr)]);
                }
            }else{
                $completeArr = ["community"];
                DB::table('users')->where('id', $request->user()->id)->update(['onboarding_complete' => json_encode($completeArr)]);
            }
            return $this->respondSuccess("Submission Completed Successfully!",200);

        }
    }



    public function UpDateFunnelStatus(Request $request){

        if($request->user()->hasRole('Advisor')){
            $advisor=DB::table('advisors')->where('UserID',$request->user()->id);
            $advisor->update([            
                'funnel_status'=>$request->funnel_status,
                'last_funnel_status_update_timestamp_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
            ]);

            if($request->funnel_status == 'Activated'){
// Shouldn't this only update if it's the first time they've had this funnel_status? - JMS 9.22.2023
                $advisor->update([            
                    'first_activated_timestamp_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                ]);
            }
/// SEND ACTIVATION MAIL HERE ... EVENTUALLY
		        Log::debug('APIAuthController Line 4052 - send email');

        }else{
            $advisee=DB::table('advisees')->where('UserID',$request->user()->id);
            $advisee->update([            
                'funnel_status'=>$request->funnel_status,
                'last_funnel_status_update_timestamp_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
            ]);

            if($request->funnel_status == 'Onboarding'){
// Shouldn't this only update if it's the first time they've had this funnel_status? - JMS 9.22.2023
                $advisee->update([            
                    'first_onboarding_timestamp_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                ]);
            }

            if($request->funnel_status == 'Activated'){
                $advisee->update([            
                    'first_activated_timestamp_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                ]);
/// SEND ACTIVATION MAIL HERE
		        Log::debug('APIAuthController Line 4078 '.$request);
						$maildata = array();
						$maildata['to'] =  $request->user()->email;
						$maildata['firstname'] = $advisee->user()->firstname;
						$maildata['subject'] = "Welcome!";
		        $result = $this->sendmakewebhook('advisee_welcome',$maildata);

//		        Log::debug('APIAuthController Line 4083 :: '.implode('|',$maildata));
            }

        }

        return $this->respondSuccess("Submission Completed Successfully!",200);


    }


    function get_timezone_offset($remote_tz, $origin_tz = null) {
        if($origin_tz === null) {
            if(!is_string($origin_tz = date_default_timezone_get())) {
                return false; // A UTC timestamp was returned -- bail out!
            }
        }
        $origin_dtz = new DateTimeZone($origin_tz);
        $remote_dtz = new DateTimeZone($remote_tz);
        $origin_dt = new DateTime("now", $origin_dtz);
        $remote_dt = new DateTime("now", $remote_dtz);
        $offset = $origin_dtz->getOffset($origin_dt) - $remote_dtz->getOffset($remote_dt);
        return $offset;
    }
    
    public function sendmakewebhook($message,$recipientdata = null) {
				$curl = curl_init();
				/// should get recipient profile if not passed in
				$recipientdata['name'] = 'make';
				$recipientdata['job'] = 'automate';
				$makehookid = "";
//				$querystring = "?to=".$recipientdata['to']."&advisee_first_name=".$recipientdata['firstname']."&subject=".$recipientdata['subject'];

				// add yourunique32characterslongstring here for each webhook triggerer
				if($message == "advisee_welcome") {$makehookid = "xqtuh6jk6jztl1r2mly37i71fha9p52t";}

				curl_setopt_array($curl, array(
					CURLOPT_URL => "https://hook.us1.make.com/".$makehookid, 
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => "",
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 30000,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "POST",
					CURLOPT_POSTFIELDS => json_encode($recipientdata), // THIS SHOULD WORK BUT DOESN'T 
					CURLOPT_HTTPHEADER => array(
					    // Set here requred headers
					    "accept: */*",
					    "accept-language: en-US,en;q=0.8",
					    "content-type: application/json",
//							"Content-Type: application/x-www-form-urlencoded",
					),
				));
        Log::debug('APIAuthController Line 4145 :: '."https://hook.us1.make.com/".$makehookid);

				$response = curl_exec($curl);
				$err = curl_error($curl);
				
				curl_close($curl);
// LOG RESPONSE. If not 200, return error
				if ($err) {
//		        Log::debug('APIAuthController Line 4143 - Make error: '.$err);
    				return 0;
				} else {
//				  print_r(json_decode($response));
//		        Log::debug('APIAuthController Line 4147 - Make response:: '.$response);
						return 1;
				}

				
		}

}
