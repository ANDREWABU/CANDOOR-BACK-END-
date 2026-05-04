<?php

namespace App\Http\Controllers\Api\V2\Advisee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Api\AddBackgroundStepRequest;
use App\Http\Traits\Helpers\ApiResponseTrait;
use App\Models\UserBackground;
use App\Mail\RequestMeeting as SendRequestMeeting;
use App\Mail\SendMeetingToHello as SendRequestMeetingTohello;
use App\Http\Resources\UserBackgroundResource;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Spatie\WebhookServer\WebhookCall;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;


class AdvisorDirectoryController extends Controller
{
    use ApiResponseTrait;

    public function getDataForFilters(Request $request)
    {
        $industries = DB::table('industries')->get();
        $companies = DB::table('companies')->get();
        $meeting_types = DB::table('meeting_types')->get();
        $work_roles = DB::table('work_roles')->get();
        $schools = DB::table('schools')->get();
        $data=[
            'Industries' =>$industries,
            'Companies' =>$companies, 
            'MeetingTypes' =>$meeting_types,
            'WorkRoles' =>$work_roles,
            'Schools' =>$schools,
        ];
        
        return $this->respondSuccessWithData($data,'Industries , Companies , MeetingTypes, WorkRoles Listing',200);
    }

    public function getDataForAdvisorList(Request $request)
    {
        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('limit') ? $request->get('limit') : 200;

        // Store directory interacted with
        $adviseeData = DB::table('users')->where('id', $request->user()->id)->select('AdviseeID')->first();
        $directory_view_instance= DB::table('directory_view')->insertGetId([
            'time_viewed' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
            'AdviseeID' => $adviseeData->AdviseeID
        ]);


        if($request->industry && $request->company && $request->role && $request->services){
            $advisorUsers = DB::table('users')
                ->leftJoin('work_experiences', 'work_experiences.UserID', '=', 'users.id')
                ->leftJoin('education_experiences', 'education_experiences.UserID', '=', 'users.id')
                ->leftJoin('advisors', 'advisors.UserID', '=', 'users.id')
                ->leftjoin('user_services', 'user_services.UserID', '=', 'users.id')
                ->whereIn('meeting_type', json_decode($request->services))
                ->where('users.AdvisorID','!=', null)
                ->where('users.AdviseeID', null)
                ->where('users.email_verified', 1)
                ->where('advisors.funnel_status', 'Activated')
                ->where('advisors.monthly_capacity_remaining', '>' , 0)

                ->whereIn('work_experiences.industry', json_decode($request->industry))
                ->whereIn('work_experiences.company', json_decode($request->company))
                ->whereIn('work_experiences.role', json_decode($request->role))
                 
                ->select(
                    'users.id',
                    'users.AdvisorID',
                    'users.firstname',
                    'users.lastname',
                    'users.pronouns',
                    'users.email',
                    'advisors.about_me',
                    'advisors.help',
                    'advisors.headline',
                    'advisors.tags_list',
                    'advisors.profile_goal',
                    'advisors.availability_time',
                    'advisors.monthly_capacity_remaining'
                )->distinct('users.id')
                ->limit($limit)
                ->offset(($page - 1) * $limit)
            ->get();
            // foreach($advisorUsers as $key => $value){
            //     $userServices = DB::table('user_services')->whereIn('meeting_type',json_decode($request->services))->where('UserID', $value->id)->select('meeting_type')->get();
            //     $advisorUsers[$key]->user_services =$userServices;
            // }
            $data = [
                "data" => $advisorUsers,
                "count" => count($advisorUsers),
            ];

            return $this->respondSuccessWithData($data,'Advisor User List',200);
        }else if($request->industry && $request->company && $request->role){

            $advisorUsers = DB::table('users')

                ->leftJoin('work_experiences', 'work_experiences.UserID', '=', 'users.id')
                ->leftJoin('education_experiences', 'education_experiences.UserID', '=', 'users.id')
                ->leftJoin('advisors', 'advisors.UserID', '=', 'users.id')
                ->where('advisors.funnel_status', 'Activated')
                ->where('advisors.monthly_capacity_remaining', '>' , 0)

                ->where('users.AdvisorID','!=', null)
                ->where('users.AdviseeID', null)
                ->where('users.email_verified', 1)
                
                 ->select(
                    'users.id',
                    'users.AdvisorID',
                    'users.firstname',
                    'users.lastname',
                    'users.pronouns',
                    'users.email',
                    'advisors.about_me',
                    'advisors.headline',
                    'advisors.help',
                    'advisors.tags_list',
                    'advisors.profile_goal',
                    'advisors.availability_time',
                    'advisors.monthly_capacity_remaining'
                )->distinct('users.id')

                ->whereIn('work_experiences.industry', json_decode($request->industry))
                ->whereIn('work_experiences.company', json_decode($request->company))
                ->whereIn('work_experiences.role', json_decode($request->role))
                ->limit($limit)
                ->offset(($page - 1) * $limit)
            ->get();
            foreach($advisorUsers as $key => $value){
                $userServices = DB::table('user_services')->where('UserID', $value->id)->select('meeting_type')->get();
                $advisorUsers[$key]->user_services =$userServices;
            }
            $data = [
                "data" => $advisorUsers,
                "count" => count($advisorUsers),
            ];

            return $this->respondSuccessWithData($data,'Advisor User List',200);

        }else if($request->industry && $request->services && $request->role){
            $advisorUsers = DB::table('users')

                ->leftJoin('work_experiences', 'work_experiences.UserID', '=', 'users.id')
                ->leftJoin('education_experiences', 'education_experiences.UserID', '=', 'users.id')
                ->leftJoin('advisors', 'advisors.UserID', '=', 'users.id')
                ->leftjoin('user_services', 'user_services.UserID', '=', 'users.id')
                ->whereIn('meeting_type', json_decode($request->services))
                ->where('users.AdvisorID','!=', null)
                ->where('users.AdviseeID', null)
                ->where('users.email_verified', 1)
                ->where('advisors.funnel_status', 'Activated')
                ->where('advisors.monthly_capacity_remaining', '>' , 0)

                 ->select(
                    'users.id',
                    'users.AdvisorID',
                    'users.firstname',
                    'users.lastname',
                    'users.pronouns',
                    'users.email',
                    'advisors.about_me',
                    'advisors.headline',
                    'advisors.help',
                    'advisors.tags_list',
                    'advisors.profile_goal',
                    'advisors.availability_time',
                    'advisors.monthly_capacity_remaining'
                )->distinct('users.id')

                ->whereIn('work_experiences.industry', json_decode($request->industry))
                ->whereIn('work_experiences.role', json_decode($request->role))
                ->limit($limit)
                ->offset(($page - 1) * $limit)
            ->get();
            
            $data = [
                "data" => $advisorUsers,
                "count" => count($advisorUsers),
            ];

            return $this->respondSuccessWithData($data,'Advisor User List',200);

        }else if($request->industry && $request->services && $request->company){

            $advisorUsers = DB::table('users')

                ->leftJoin('work_experiences', 'work_experiences.UserID', '=', 'users.id')
                ->leftJoin('education_experiences', 'education_experiences.UserID', '=', 'users.id')
                ->leftJoin('advisors', 'advisors.UserID', '=', 'users.id')
                ->leftjoin('user_services', 'user_services.UserID', '=', 'users.id')
                ->whereIn('meeting_type', json_decode($request->services))
                ->where('users.AdvisorID','!=', null)
                ->where('users.AdviseeID', null)
                ->where('users.email_verified', 1)
                ->where('advisors.funnel_status', 'Activated')        
                ->where('advisors.monthly_capacity_remaining', '>' , 0)

                 ->select(
                    'users.id',
                    'users.AdvisorID',
                    'users.firstname',
                    'users.lastname',
                    'users.pronouns',
                    'users.email',
                    'advisors.about_me',
                    'advisors.headline',
                    'advisors.help',
                    'advisors.tags_list',
                    'advisors.profile_goal',
                    'advisors.availability_time',
                    'advisors.monthly_capacity_remaining'
                )->distinct('users.id')

                ->whereIn('work_experiences.industry', json_decode($request->industry))
                ->whereIn('work_experiences.company', json_decode($request->company))
                ->limit($limit)
                ->offset(($page - 1) * $limit)
            ->get();
           
            $data = [
                "data" => $advisorUsers,
                "count" => count($advisorUsers),
            ];

            return $this->respondSuccessWithData($data,'Advisor User List',200);

        }else if($request->role && $request->services && $request->company){

            $advisorUsers = DB::table('users')

                ->leftJoin('work_experiences', 'work_experiences.UserID', '=', 'users.id')
                ->leftJoin('education_experiences', 'education_experiences.UserID', '=', 'users.id')
                ->leftJoin('advisors', 'advisors.UserID', '=', 'users.id')
                ->leftjoin('user_services', 'user_services.UserID', '=', 'users.id')
                ->whereIn('meeting_type', json_decode($request->services))
                ->where('users.AdvisorID','!=', null)
                ->where('users.AdviseeID', null)
                ->where('users.email_verified', 1)
                ->where('advisors.funnel_status', 'Activated')
                ->where('advisors.monthly_capacity_remaining', '>' , 0)

                 ->select(
                    'users.id',
                    'users.AdvisorID',
                    'users.firstname',
                    'users.lastname',
                    'users.pronouns',
                    'users.email',
                    'advisors.about_me',
                    'advisors.headline',
                    'advisors.help',
                    'advisors.tags_list',
                    'advisors.profile_goal',
                    'advisors.availability_time',
                    'advisors.monthly_capacity_remaining'
                )->distinct('users.id')

                ->whereIn('work_experiences.company', json_decode($request->company))
                ->whereIn('work_experiences.role', json_decode($request->role))
                ->limit($limit)
                ->offset(($page - 1) * $limit)
            ->get();
          
            $data = [
                "data" => $advisorUsers,
                "count" => count($advisorUsers),
            ];

            return $this->respondSuccessWithData($data,'Advisor User List',200);

        }else if($request->industry && $request->company){

            $advisorUsers = DB::table('users')

                ->leftJoin('work_experiences', 'work_experiences.UserID', '=', 'users.id')
                ->leftJoin('education_experiences', 'education_experiences.UserID', '=', 'users.id')
                ->leftJoin('advisors', 'advisors.UserID', '=', 'users.id')
                ->where('advisors.funnel_status', 'Activated')
                ->where('advisors.monthly_capacity_remaining', '>' , 0)

                ->where('users.AdvisorID','!=', null)
                ->where('users.AdviseeID', null)
                ->where('users.email_verified', 1)
                 ->select(
                    'users.id',
                    'users.AdvisorID',
                    'users.firstname',
                    'users.lastname',
                    'users.pronouns',
                    'users.email',
                    'advisors.about_me',
                    'advisors.headline',
                    'advisors.help',
                    'advisors.tags_list',
                    'advisors.profile_goal',
                    'advisors.availability_time',
                    'advisors.monthly_capacity_remaining'
                )->distinct('users.id')

                ->whereIn('work_experiences.industry', json_decode($request->industry))
                ->whereIn('work_experiences.company', json_decode($request->company))
                ->limit($limit)
                ->offset(($page - 1) * $limit)
            ->get();
            foreach($advisorUsers as $key => $value){
                $userServices = DB::table('user_services')->where('UserID', $value->id)->select('meeting_type')->get();
                $advisorUsers[$key]->user_services =$userServices;
            }
            $data = [
                "data" => $advisorUsers,
                "count" => count($advisorUsers),
            ];

            return $this->respondSuccessWithData($data,'Advisor User List',200);
        }else if($request->industry && $request->role){

            $advisorUsers = DB::table('users')

                ->leftJoin('work_experiences', 'work_experiences.UserID', '=', 'users.id')
                ->leftJoin('education_experiences', 'education_experiences.UserID', '=', 'users.id')
                ->leftJoin('advisors', 'advisors.UserID', '=', 'users.id')

                ->where('users.AdvisorID','!=', null)
                ->where('users.AdviseeID', null)
                ->where('users.email_verified', 1)
                ->where('advisors.funnel_status', 'Activated')
                ->where('advisors.monthly_capacity_remaining', '>' , 0)

                 ->select(
                    'users.id',
                    'users.AdvisorID',
                    'users.firstname',
                    'users.lastname',
                    'users.pronouns',
                    'users.email',
                    'advisors.about_me',
                    'advisors.headline',
                    'advisors.help',
                    'advisors.tags_list',
                    'advisors.profile_goal',
                    'advisors.availability_time',
                    'advisors.monthly_capacity_remaining'
                )->distinct('users.id')

                ->whereIn('work_experiences.industry', json_decode($request->industry))
                ->whereIn('work_experiences.role', json_decode($request->role))
                ->limit($limit)
                ->offset(($page - 1) * $limit)
            ->get();
            foreach($advisorUsers as $key => $value){
                $userServices = DB::table('user_services')->where('UserID', $value->id)->select('meeting_type')->get();
                $advisorUsers[$key]->user_services =$userServices;
            }
            $data = [
                "data" => $advisorUsers,
                "count" => count($advisorUsers),
            ];

            return $this->respondSuccessWithData($data,'Advisor User List',200);

        }else if($request->industry && $request->services){

            $advisorUsers = DB::table('users')

                ->leftJoin('work_experiences', 'work_experiences.UserID', '=', 'users.id')
                ->leftJoin('education_experiences', 'education_experiences.UserID', '=', 'users.id')
                ->leftJoin('advisors', 'advisors.UserID', '=', 'users.id')
                ->leftjoin('user_services', 'user_services.UserID', '=', 'users.id')
                ->whereIn('meeting_type', json_decode($request->services))
                ->where('users.AdvisorID','!=', null)
                ->where('users.AdviseeID', null)
                ->where('users.email_verified', 1)
                ->where('advisors.funnel_status', 'Activated')
                ->where('advisors.monthly_capacity_remaining', '>' , 0)

                 ->select(
                    'users.id',
                    'users.AdvisorID',
                    'users.firstname',
                    'users.lastname',
                    'users.pronouns',
                    'users.email',
                    'advisors.about_me',
                    'advisors.headline',
                    'advisors.help',
                    'advisors.tags_list',
                    'advisors.profile_goal',
                    'advisors.availability_time',
                    'advisors.monthly_capacity_remaining'
                )->distinct('users.id')

                ->whereIn('work_experiences.industry', json_decode($request->industry))
                ->limit($limit)
                ->offset(($page - 1) * $limit)
            ->get();
           
            $data = [
                "data" => $advisorUsers,
                "count" => count($advisorUsers),
            ];

            return $this->respondSuccessWithData($data,'Advisor User List',200);

        }else if($request->company && $request->role){

            $advisorUsers = DB::table('users')

                ->leftJoin('work_experiences', 'work_experiences.UserID', '=', 'users.id')
                ->leftJoin('education_experiences', 'education_experiences.UserID', '=', 'users.id')
                ->leftJoin('advisors', 'advisors.UserID', '=', 'users.id')

                ->where('users.AdvisorID','!=', null)
                ->where('users.AdviseeID', null)
                ->where('users.email_verified', 1)
                ->where('advisors.funnel_status', 'Activated')
                ->where('advisors.monthly_capacity_remaining', '>' , 0)

                 ->select(
                    'users.id',
                    'users.AdvisorID',
                    'users.firstname',
                    'users.lastname',
                    'users.pronouns',
                    'users.email',
                    'advisors.about_me',
                    'advisors.headline',
                    'advisors.help',
                    'advisors.tags_list',
                    'advisors.profile_goal',
                    'advisors.availability_time',
                    'advisors.monthly_capacity_remaining'
                )->distinct('users.id')

                ->whereIn('work_experiences.company', json_decode($request->company))
                ->whereIn('work_experiences.role', json_decode($request->role))
                ->limit($limit)
                ->offset(($page - 1) * $limit)
            ->get();
            foreach($advisorUsers as $key => $value){
                $userServices = DB::table('user_services')->where('UserID', $value->id)->select('meeting_type')->get();
                $advisorUsers[$key]->user_services =$userServices;
            }
            $data = [
                "data" => $advisorUsers,
                "count" => count($advisorUsers),
            ];

            return $this->respondSuccessWithData($data,'Advisor User List',200);

        }else if($request->company && $request->services){

            $advisorUsers = DB::table('users')

                ->leftJoin('work_experiences', 'work_experiences.UserID', '=', 'users.id')
                ->leftJoin('education_experiences', 'education_experiences.UserID', '=', 'users.id')
                ->leftJoin('advisors', 'advisors.UserID', '=', 'users.id')
                ->leftjoin('user_services', 'user_services.UserID', '=', 'users.id')
                ->whereIn('meeting_type', json_decode($request->services))
                ->where('users.AdvisorID','!=', null)
                ->where('users.AdviseeID', null)
                ->where('users.email_verified', 1)
                ->where('advisors.funnel_status', 'Activated')
                ->where('advisors.monthly_capacity_remaining', '>' , 0)

                 ->select(
                    'users.id',
                    'users.AdvisorID',
                    'users.firstname',
                    'users.lastname',
                    'users.pronouns',
                    'users.email',
                    'advisors.about_me',
                    'advisors.headline',
                    'advisors.help',
                    'advisors.tags_list',
                    'advisors.profile_goal',
                    'advisors.availability_time',
                    'advisors.monthly_capacity_remaining'
                )->distinct('users.id')

                ->whereIn('work_experiences.company', json_decode($request->company))
                ->limit($limit)
                ->offset(($page - 1) * $limit)
            ->get();
           
            $data = [
                "data" => $advisorUsers,
                "count" => count($advisorUsers),
            ];

            return $this->respondSuccessWithData($data,'Advisor User List',200);

        }else if( $request->role && $request->services){

            $advisorUsers = DB::table('users')

                ->leftJoin('work_experiences', 'work_experiences.UserID', '=', 'users.id')
                ->leftJoin('education_experiences', 'education_experiences.UserID', '=', 'users.id')
                ->leftJoin('advisors', 'advisors.UserID', '=', 'users.id')
                ->leftjoin('user_services', 'user_services.UserID', '=', 'users.id')
                ->whereIn('meeting_type', json_decode($request->services))
                ->where('users.AdvisorID','!=', null)
                ->where('users.AdviseeID', null)
                ->where('users.email_verified', 1)
                ->where('advisors.funnel_status', 'Activated')
                ->where('advisors.monthly_capacity_remaining', '>' , 0)

                 ->select(
                    'users.id',
                    'users.AdvisorID',
                    'users.firstname',
                    'users.lastname',
                    'users.pronouns',
                    'users.email',
                    'advisors.about_me',
                    'advisors.headline',
                    'advisors.help',
                    'advisors.tags_list',
                    'advisors.profile_goal',
                    'advisors.availability_time',
                    'advisors.monthly_capacity_remaining'
                )->distinct('users.id')

                ->whereIn('work_experiences.role', json_decode($request->role))
                ->limit($limit)
                ->offset(($page - 1) * $limit)
            ->get();

            $data = [
                "data" => $advisorUsers,
                "count" => count($advisorUsers),
            ];

            return $this->respondSuccessWithData($data,'Advisor User List',200);

        }else if($request->industry){

            $advisorUsers = DB::table('users')

                ->leftJoin('work_experiences', 'work_experiences.UserID', '=', 'users.id')
                ->leftJoin('education_experiences', 'education_experiences.UserID', '=', 'users.id')
                ->leftJoin('advisors', 'advisors.UserID', '=', 'users.id')

                ->where('users.AdvisorID','!=', null)
                ->where('users.AdviseeID', null)
                ->where('users.email_verified', 1)
                ->where('advisors.funnel_status', 'Activated')
                ->where('advisors.monthly_capacity_remaining', '>' , 0)

                 ->select(
                    'users.id',
                    'users.AdvisorID',
                    'users.firstname',
                    'users.lastname',
                    'users.pronouns',
                    'users.email',
                    'advisors.about_me',
                    'advisors.headline',
                    'advisors.help',
                    'advisors.tags_list',
                    'advisors.profile_goal',
                    'advisors.availability_time',
                    'advisors.monthly_capacity_remaining'
                    
                )->distinct('users.id')

                ->whereIn('work_experiences.industry', json_decode($request->industry))
                ->limit($limit)
                ->offset(($page - 1) * $limit)
            ->get();
            foreach($advisorUsers as $key => $value){
                $userServices = DB::table('user_services')->where('UserID', $value->id)->select('meeting_type')->get();
                $advisorUsers[$key]->user_services =$userServices;
            }
            $data = [
                "data" => $advisorUsers,
                "count" => count($advisorUsers),
            ];

            return $this->respondSuccessWithData($data,'Advisor User List',200);

        }else if($request->company){

            $advisorUsers = DB::table('users')

                ->leftJoin('work_experiences', 'work_experiences.UserID', '=', 'users.id')
                ->leftJoin('education_experiences', 'education_experiences.UserID', '=', 'users.id')
                ->leftJoin('advisors', 'advisors.UserID', '=', 'users.id')

                ->where('users.AdvisorID','!=', null)
                ->where('users.AdviseeID', null)
                ->where('users.email_verified', 1)
                ->where('advisors.funnel_status', 'Activated')
                ->where('advisors.monthly_capacity_remaining', '>' , 0)

                 ->select(
                    'users.id',
                    'users.AdvisorID',
                    'users.firstname',
                    'users.lastname',
                    'users.pronouns',
                    'users.email',
                    'advisors.about_me',
                    'advisors.headline',
                    'advisors.help',
                    'advisors.tags_list',
                    'advisors.profile_goal',
                    'advisors.availability_time',
                    'advisors.monthly_capacity_remaining'
                )->distinct('users.id')

                ->whereIn('work_experiences.company', json_decode($request->company))
                ->limit($limit)
                ->offset(($page - 1) * $limit)
            ->get();
            foreach($advisorUsers as $key => $value){
                $userServices = DB::table('user_services')->where('UserID', $value->id)->select('meeting_type')->get();
                $advisorUsers[$key]->user_services =$userServices;
            }
            $data = [
                "data" => $advisorUsers,
                "count" => count($advisorUsers),
            ];

            return $this->respondSuccessWithData($data,'Advisor User List',200);

        }else if($request->role){

            $advisorUsers = DB::table('users')

                ->leftJoin('work_experiences', 'work_experiences.UserID', '=', 'users.id')
                ->leftJoin('education_experiences', 'education_experiences.UserID', '=', 'users.id')
                ->leftJoin('advisors', 'advisors.UserID', '=', 'users.id')
                ->where('advisors.funnel_status', 'Activated')
                ->where('advisors.monthly_capacity_remaining', '>' , 0)

                ->where('users.AdvisorID','!=', null)
                ->where('users.AdviseeID', null)
                ->where('users.email_verified', 1)
                
                 ->select(
                    'users.id',
                    'users.AdvisorID',
                    'users.firstname',
                    'users.lastname',
                    'users.pronouns',
                    'users.email',
                    'advisors.about_me',
                    'advisors.headline',
                    'advisors.help',
                    'advisors.tags_list',
                    'advisors.profile_goal',
                    'advisors.availability_time',
                    'advisors.monthly_capacity_remaining'
                )->distinct('users.id')

                ->whereIn('work_experiences.role', json_decode($request->role))
                ->limit($limit)
                ->offset(($page - 1) * $limit)
                
            ->get();
            foreach($advisorUsers as $key => $value){
                $userServices = DB::table('user_services')->where('UserID', $value->id)->select('meeting_type')->get();
                $advisorUsers[$key]->user_services =$userServices;
            }
            $data = [
                "data" => $advisorUsers,
                "count" => count($advisorUsers),
            ];

            return $this->respondSuccessWithData($data,'Advisor User List',200);

        }else if($request->services){

            $advisorUsers = DB::table('users')
                ->leftJoin('work_experiences', 'work_experiences.UserID', '=', 'users.id')
                ->leftJoin('education_experiences', 'education_experiences.UserID', '=', 'users.id')
                ->leftJoin('advisors', 'advisors.UserID', '=', 'users.id')
                ->leftjoin('user_services', 'user_services.UserID', '=', 'users.id')
                ->where('advisors.funnel_status', 'Activated')
                ->where('advisors.monthly_capacity_remaining', '>' , 0)
                ->whereIn('meeting_type', json_decode($request->services))
                ->where('users.AdvisorID','!=', null)
                ->where('users.AdviseeID', null)
                ->where('users.email_verified', 1)
                ->select(
                    'users.id',
                    'users.AdvisorID',
                    'users.firstname',
                    'users.lastname',
                    'users.pronouns',
                    'users.email',
                    'advisors.about_me',
                    'advisors.headline',
                    'advisors.help',
                    'advisors.tags_list',
                    'advisors.profile_goal',
                    'advisors.availability_time',
                    'advisors.monthly_capacity_remaining'
                )->distinct('users.id')
                ->limit($limit)
                ->offset(($page - 1) * $limit)             
            ->get();
            $data = [
                "data" => $advisorUsers,
                "count" => count($advisorUsers),
            ];

            return $this->respondSuccessWithData($data,'Advisor User List',200);

        }else{
            $advisorUsers = DB::table('users')

                ->leftJoin('work_experiences', 'work_experiences.UserID', '=', 'users.id')
                ->leftJoin('education_experiences', 'education_experiences.UserID', '=', 'users.id')
                ->leftJoin('advisors', 'advisors.UserID', '=', 'users.id')

                ->where('users.AdvisorID','!=', null)
                ->where('users.AdviseeID', null)
                ->where('users.email_verified', 1)
                ->where('advisors.funnel_status', 'Activated')
                ->where('advisors.monthly_capacity_remaining', '>' , 0)

                 ->select(
                    'users.id',
                    'users.AdvisorID',
                    'users.firstname',
                    'users.lastname',
                    'users.pronouns',
                    'users.email',
                    'advisors.about_me',
                    'advisors.headline',
                    'advisors.tags_list',
                    'advisors.help',
                    'advisors.profile_goal',
                    'advisors.funnel_status',
                    'advisors.availability_time',
                    'advisors.directory_priority',
                    'advisors.monthly_capacity_remaining'
                )->distinct('users.id')

                ->limit($limit)
                ->offset(($page - 1) * $limit)
            ->get();

            foreach($advisorUsers as $key => $value){
                $userServices = DB::table('user_services')->where('UserID', $value->id)->select('meeting_type')->get();
                $advisorUsers[$key]->user_services =$userServices;
            }

            $prioritized_advisors = [];
            $not_prioritized_advisors = [];

            foreach($advisorUsers as $key => $value){
                if($value->directory_priority == 1){
                    $prioritized_advisors[] = $value;
                }else{
                    $not_prioritized_advisors[] = $value;
                }

                $userServices = DB::table('user_services')->where('UserID', $value->id)->select('meeting_type')->get();
                $advisorUsers[$key]->user_services =$userServices;
            }

            shuffle($prioritized_advisors);
            shuffle($not_prioritized_advisors);

            $all_advisors = array_merge($prioritized_advisors, $not_prioritized_advisors);


            // $data = [
            //     "data" => $advisorUsers,
            //     "count" => count($advisorUsers),
            // ];
            $data = [
                "data" => $all_advisors,
                "count" => count($all_advisors),
            ];

            return $this->respondSuccessWithData($data,'Advisor User List',200);
        }    
    }

    public function getDataForAdvisorListRefactor(Request $request)
{
    $page = $request->input('page', 1);
    $limit = $request->input('limit', 200);

    // Log the directory view
    $adviseeData = DB::table('users')->where('id', $request->user()->id)->select('AdviseeID')->first();
    $directory_view_instance = DB::table('directory_view')->insertGetId([
        'time_viewed' => Carbon::now('EST'),
        'AdviseeID' => $adviseeData->AdviseeID
    ]);

    $query = DB::table('users')
        ->leftJoin('work_experiences', 'work_experiences.UserID', '=', 'users.id')
        ->leftJoin('education_experiences', 'education_experiences.UserID', '=', 'users.id')
        ->leftJoin('advisors', 'advisors.UserID', '=', 'users.id')
        ->leftJoin('user_services', 'user_services.UserID', '=', 'users.id')
        ->whereNotNull('users.AdvisorID')
        ->whereNull('users.AdviseeID')
        ->where('users.email_verified', 1)
        ->where('advisors.funnel_status', 'Activated')
        ->where('advisors.monthly_capacity_remaining', '>', 0)
        ->select(
            'users.id',
            'users.AdvisorID',
            'users.firstname',
            'users.lastname',
            'users.pronouns',
            'users.email',
            'advisors.about_me',
            'advisors.headline',
            'advisors.help',
            'advisors.tags_list',
            'advisors.profile_goal',
            'advisors.availability_time',
            'advisors.monthly_capacity_remaining',
            'advisors.directory_priority'
        )
        ->distinct('users.id');

    // === Dynamic Filters ===

    $query->when($request->industry, function ($q) use ($request) {
        $q->whereIn('work_experiences.industry', json_decode($request->industry));
    });

    $query->when($request->company, function ($q) use ($request) {
        $q->whereIn('work_experiences.company', json_decode($request->company));
    });

    $query->when($request->role, function ($q) use ($request) {
        $q->whereIn('work_experiences.role', json_decode($request->role));
    });

    $query->when($request->services, function ($q) use ($request) {
        $q->whereIn('meeting_type', json_decode($request->services));
    });

    $query->when($request->school, function ($q) use ($request) {
        $q->whereIn('education_experiences.school', json_decode($request->school));
    });

    // === Execute query ===

    $advisorUsers = $query
        ->limit($limit)
        ->offset(($page - 1) * $limit)
        ->get();

    // === Add user_services if needed ===

    if ($request->services) {
        // If services were requested, we assume filtering was already applied
        // so no need to append here
    } else {
        foreach ($advisorUsers as $key => $advisor) {
            $services = DB::table('user_services')
                ->where('UserID', $advisor->id)
                ->select('meeting_type')
                ->get();
            $advisorUsers[$key]->user_services = $services;
        }
    }

    // === Optional: Shuffle prioritized advisors ===

    $prioritized = [];
    $nonPrioritized = [];

    foreach ($advisorUsers as $advisor) {
        if ($advisor->directory_priority == 1) {
            $prioritized[] = $advisor;
        } else {
            $nonPrioritized[] = $advisor;
        }
    }

    shuffle($prioritized);
    shuffle($nonPrioritized);

    $all_advisors = array_merge($prioritized, $nonPrioritized);

    return $this->respondSuccessWithData([
        'data' => $all_advisors,
        'count' => count($all_advisors),
    ], 'Advisor User List', 200);
}



    public function getDataForAdviseeProfile(Request $request)
    {



        $adviseeID = $request->adviseeID;

        $adviseesData = DB::table('advisees')->where('AdviseeID' ,$adviseeID)->select('AdviseeID','UserID','headline','about_me','initial_career_goals','current_career_goals','just_for_fun','tags_list','cover_profile','profile_goal','resume')->first();

        $userData = DB::table('users')->where('AdviseeID' ,$adviseeID)->select('id','firstname','lastname','pronouns')->first();

        $backgroundData = DB::table('user_backgrounds')->where('UserID' ,$userData->id)->select('id','time_zone','country','state','city')->first();

        $educationExpData = DB::table('education_experiences')->whereIn('UserID' ,[$userData->id])->select('EducationExperienceID','school','graduation_year','degree','fields_of_study','is_current','start_date')->orderBy('start_date', 'DESC')->get();

        $workExpData = DB::table('work_experiences')->whereIn('UserID' ,[$userData->id])->select('WorkExperienceID','company','title','industry','role','start_date', 'end_date', 'is_current','employment_type','employment_type_other')->orderBy('start_date', 'DESC')->get();
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
            // if(str_contains($duration_string, '0 years')){
            //     $duration_date = '0 Months';
            // }

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

    public function getDataForAdvisorProfile(Request $request)
    {
        $advisorID = $request->id; 
        $advisorData = DB::table('advisors')->where('AdvisorID' ,$advisorID)->select('AdvisorID','headline','about_me','just_for_fun','tags_list','cover_profile','profile_goal','profile_video','help', 'monthly_capacity_remaining', 'availability_time')->first();
        $userData = DB::table('users')->where('AdvisorID' ,$advisorID)->select('id','firstname','lastname','pronouns')->first();
        $backgroundData = DB::table('user_backgrounds')->where('UserID' ,$userData->id)->select('id','time_zone','country','state','city')->first();
        $educationExpData = DB::table('education_experiences')->whereIn('UserID' ,[$userData->id])->select('EducationExperienceID','school','graduation_year','ask_me_about','degree','fields_of_study','is_current','start_date')->orderBy('start_date', 'DESC')->get();
        $workExpData = DB::table('work_experiences')->whereIn('UserID' ,[$userData->id])->select('WorkExperienceID','company','title','industry','role','start_date', 'end_date','ask_me_about','is_current','employment_type','employment_type_other')->orderBy('start_date', 'DESC')->get();
        $user_services  = DB::table('user_services')->whereIn('UserID' ,[$userData->id])->get();

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
            // if(str_contains($duration_string, '0 years')){
            //     $duration_date = '0 Months';
            // }

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
        
        $progressdt = DB::table('users')->where('id', $userData->id)->first();
        
       
        $data=[
            'workExperience' =>$workExpData,
            'advisor' =>$advisorData,
            'background' =>$backgroundData,
            'educationExperience' =>$educationExpData,
            'userData' =>$userData,
            'user_services' => $user_services,
            'progress' => $progressdt->progress,
        ];
        return response()->json([
            'statusCode' => 200,
            'Success' => 'Successfully Data Fatched',
            'message' => 'Request has been processed',
            'Data' => $data,
        ]);

    }

    public function getDataForAdvisorMeetingServices(Request $request)
    {   
        $ID         =   DB::table('users')->where('AdvisorID' ,$request->id)->first();
        // $userid           =   $request->id;
        $userid           =   $ID->id;
        $services         =   DB::table('user_services')->whereIn('UserID', [$userid])->where('is_active', 1)->get();
        $advisorData      =   DB::table('advisors')->where('UserID' ,$userid)->select('AdvisorID','headline','about_me','just_for_fun','tags_list','cover_profile','profile_goal','profile_video','help', 'funnel_status', 'monthly_capacity_remaining', 'availability_time')->first();
        $userData         =   DB::table('users')->where('id' ,$userid)->select('id','firstname','lastname','pronouns')->first();
        $backgroundData   =   DB::table('user_backgrounds')->where('UserID' ,$userid)->select('id','time_zone','country','state','city')->first();
        $timezone         =   DB::table('user_backgrounds')->where('UserID' ,$request->user()->id)->select('time_zone')->first();
        $adviseeData      =   DB::table('advisees')->where('UserID' ,$request->user()->id)->first();

        $educationExpData = DB::table('education_experiences')->where('UserID' ,$userid)->select('EducationExperienceID','school','graduation_year','ask_me_about','degree','fields_of_study','is_current','start_date')->first();
        $workExpData      = DB::table('work_experiences')->where('UserID' ,$userid)->select('WorkExperienceID','company','title','industry','role','start_date', 'end_date','ask_me_about','is_current','employment_type','employment_type_other')->first();
        $format_company_school = '';

        if($workExpData && $educationExpData){
            $format_company_school = $workExpData->title." at ".$workExpData->company;
        }elseif($workExpData){
            $format_company_school = $workExpData->title." at ".$workExpData->company;
        }elseif($educationExpData){
            $format_company_school = "Student at ".$educationExpData->school."studying ".$educationExpData->fields_of_study;
        }else{
            $format_company_school = '';
        }
        
        $data=[
            'advisor' =>$advisorData,
            'background' =>$backgroundData,
            'userData' =>$userData,
            'services' => $services,
            'school_or_company' =>  $format_company_school,
            'advisee_first_name' =>  $request->user()->firstname,
            'advisee_headline' => $adviseeData->headline,
            'advisees_monthly_requests_remaining' => $adviseeData->monthly_requests_remaining,
            'advisee_last_name' =>  $request->user()->lastname,
            'advisee_timezone' => $timezone,
        ];
        return response()->json([
            'statusCode' => 200,
            'Success' => 'Successfully Data Fatched',
            'message' => 'Request has been processed',
            'Data' => $data,
        ]);
    }

    public function getRequestOpen(Request $request)
    {
        $userid  = $request->id; 
        $userdata = DB::table('users')->where('id', $userid)->first();
        if($userdata){
            $meetingid=   DB::table('meetings')->insertGetId([
                'AdvisorID' => $userdata->AdvisorID,
                'AdviseeID' => $request->user()->AdviseeID,
                'UserID' => $userdata->id,
                'meeting_status' => 'Request Opened',
                'request_opened_timestamp' => Carbon::now()->setTimezone('UTC'),
                'last_status_update_timestamp' => Carbon::now()->setTimezone('UTC'),
            ]);
            $meetingData = DB::table('meetings')->where('id', $meetingid)->first(); 
            return response()->json([
                'statusCode' => 200,
                'Success' => 'Successfully Data Fatched',
                'message' => 'Request has been processed',
                'meetingData' => $meetingData,
            ]);
        }else{
            return response()->json([
                'statusCode' => 500,
                'Success' => 'Data Fatched Failed',
                'message' => 'check your UserID',
                'meetingData' => $meetingData,
            ]);
        }
    }

    public function StoreAdvisorProfileView(Request $request){

        $advisorData = DB::table('users')->where('AdvisorID', $request->AdvisorID)->select('AdvisorID')->first();
        $adviseeData = DB::table('users')->where('id', $request->user()->id)->select('AdviseeID')->first();
        
        $profile_view_instance= DB::table('profile_view')->insertGetId([
            'time_viewed' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
            'AdvisorID' => $advisorData->AdvisorID,
            'AdviseeID' => $adviseeData->AdviseeID,
        ]);

        return response()->json([
            'statusCode' => 200,
            'profile_view_instance_ID' => $profile_view_instance,
        ]);

    }


    public function CreateNewMeetingInstance(Request $request){

        $advisorData = DB::table('users')->where('AdvisorID', $request->AdvisorID)->select('AdvisorID')->first();
        $adviseeData = DB::table('users')->where('id', $request->user()->id)->select('AdviseeID')->first();

        $meeting_instance= DB::table('meetings')->insertGetId([
            'AdvisorID' => $advisorData->AdvisorID,
            'AdviseeID' => $adviseeData->AdviseeID,
            'meeting_status' => $request->meeting_status,
            'request_opened_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
            'last_status_update_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST')
        ]);

        return response()->json([
            'statusCode' => 200,
            'meeting_instance' => $meeting_instance,
        ]);

    }


    public function SaveAdvisorMeetingRequest(Request $request){

        $AdviseeUserID = $request->user()->id;
        
        $advisorInfo = DB::table('users')->where('AdvisorID', $request->id)->first();
        $AdvisorUserID = $advisorInfo->id;
        $services_id = $request->user_services_id;

        //Service Data
        $servicesData = DB::table('user_services')->where('id', $services_id)->first();
        $service_name = $servicesData->meeting_type;
        $service_time = $servicesData->time;
        $meeting_type_and_duration = $service_name.' '.$service_time.' Minutes';


        //Advisor Data
        $AdvisorData = DB::table('users')->where('id', $AdvisorUserID)->first();

        $Advisorname = $AdvisorData->firstname.' '.$AdvisorData->lastname;
        $AdvisorEmail = $AdvisorData->meeting_email?$AdvisorData->meeting_email:$AdvisorData->email;

        $AdvisorTimeZoneData = DB::table('user_backgrounds')->where('UserID', $AdvisorUserID)->select('time_zone')->first();
        $AdvisorTimeZone = $AdvisorTimeZoneData->time_zone;

        $AdvisorAvailbilityData = DB::table('advisors')->where('UserID', $AdvisorUserID)->select('availability_time')->first();
        $AdvisorAvailability = $AdvisorAvailbilityData->availability_time;

        //Advisee Data
        $AdviseeData = DB::table('users')->where('id', $AdviseeUserID)->first();
        $Adviseename = $AdviseeData->firstname.' '.$AdviseeData->lastname;
        $AdviseeEmail = $AdviseeData->meeting_email?$AdviseeData->meeting_email:$AdviseeData->email;
        $AdviseeTimeZoneData = DB::table('user_backgrounds')->where('UserID', $AdviseeUserID)->select('time_zone')->first();
        $AdviseeTimeZone = $AdviseeTimeZoneData->time_zone;


        //Timing
        $timezoneKey = DB::table('time_zones')->where('name', $AdviseeTimeZoneData->time_zone)->first();
        $time_interval_arr_timezone = [];
        $time_interval_arr_notimezone = [];
        $date_int_1_from   = Carbon::parse($request->interval_1_date.' '.$request->interval_1_from); // Carbon Parse
        $date_int_1_to   = Carbon::parse($request->interval_1_date.' '.$request->interval_1_to); // Carbon Parse

        $interval_1_dateWithTimezone_from = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_1_from, $timezoneKey->key);
        $interval_1_dateWithTimezone_from->setTimezone('UTC');

        $interval_1_dateWithTimezone_to = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_1_to, $timezoneKey->key);
        $interval_1_dateWithTimezone_to->setTimezone('UTC');

        array_push($time_interval_arr_timezone, ['interval_1' => ['date' => $interval_1_dateWithTimezone_from->format('y-m-d'),'from' => $interval_1_dateWithTimezone_from->format('H:i:s'), 'to' => $interval_1_dateWithTimezone_to->format('H:i:s')] ]);
        array_push($time_interval_arr_notimezone, ['interval_1' => ['date' => $date_int_1_from->format('y-m-d'),'from' => $date_int_1_from->format('H:i:s'), 'to' => $date_int_1_to->format('H:i:s')] ]);

        // interval 2
        $date_int_2_from   = Carbon::parse($request->interval_2_date.' '.$request->interval_2_from); // Carbon Parse
        $date_int_2_to   = Carbon::parse($request->interval_2_date.' '.$request->interval_2_to); // Carbon Parse

        $interval_2_dateWithTimezone_from = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_2_from, $timezoneKey->key);
        $interval_2_dateWithTimezone_from->setTimezone('UTC');

        $interval_2_dateWithTimezone_to = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_2_to, $timezoneKey->key);
        $interval_2_dateWithTimezone_to->setTimezone('UTC');
        array_push($time_interval_arr_timezone, ['interval_2' => ['date' => $interval_2_dateWithTimezone_from->format('y-m-d'),'from' => $interval_2_dateWithTimezone_from->format('H:i:s'), 'to' => $interval_2_dateWithTimezone_to->format('H:i:s')] ]);
        array_push($time_interval_arr_notimezone, ['interval_2' => ['date' => $date_int_2_from->format('y-m-d'),'from' => $date_int_2_from->format('H:i:s'), 'to' => $date_int_2_to->format('H:i:s')] ]);

        // interval 3
        $date_int_3_from   = Carbon::parse($request->interval_3_date.' '.$request->interval_3_from, $timezoneKey->key); // Carbon Parse
        $date_int_3_to   = Carbon::parse($request->interval_3_date.' '.$request->interval_3_to, $timezoneKey->key); // Carbon Parse

        $interval_3_dateWithTimezone_from = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_3_from, $timezoneKey->key);
        $interval_3_dateWithTimezone_from->setTimezone('UTC');

        $interval_3_dateWithTimezone_to = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_3_to, $timezoneKey->key);
        $interval_3_dateWithTimezone_to->setTimezone('UTC');

        array_push($time_interval_arr_timezone, ['interval_3' => ['date' => $interval_3_dateWithTimezone_from->format('y-m-d'),'from' => $interval_3_dateWithTimezone_from->format('H:i:s'), 'to' => $interval_3_dateWithTimezone_to->format('H:i:s')] ]);
        array_push($time_interval_arr_notimezone, ['interval_3' => ['date' => $date_int_3_from->format('y-m-d'),'from' => $date_int_3_from->format('H:i:s'), 'to' => $date_int_3_to->format('H:i:s')] ]);


        //Get Advisor monthly capacity remaining and decrement it by one,
        $advisor_monthly_capacity_remaining_data = DB::table('advisors')->where('UserID', $AdvisorUserID)->select('monthly_capacity_remaining')->first();
        $new_advisor_monthly_capacity_remaining = $advisor_monthly_capacity_remaining_data->monthly_capacity_remaining - 1;
        DB::table('advisors')->where('UserID', $AdvisorUserID)->update(['monthly_capacity_remaining' => $new_advisor_monthly_capacity_remaining]);

        //Get Advisee monthly request and decrement by one
        //If advisor is Founder, then do not decrement

        $advisee_monthly_requests_data = DB::table('advisees')->where('UserID', $AdviseeUserID)->select('monthly_requests_remaining','lifetime_requests_sent')->first();
        $founding_advisors_user_IDs = array(25, 27, 28, 37);

        if(!in_array($AdvisorData->AdvisorID, $founding_advisors_user_IDs)){
            $new_advisee_monthly_requests_remaining = $advisee_monthly_requests_data->monthly_requests_remaining - 1;
        }else{
            $new_advisee_monthly_requests_remaining = $advisee_monthly_requests_data->monthly_requests_remaining ;
        }

        $new_advisee_lifetime_requests_sent = $advisee_monthly_requests_data->lifetime_requests_sent + 1;
        DB::table('advisees')->where('UserID', $AdviseeUserID)->update(['monthly_requests_remaining' => $new_advisee_monthly_requests_remaining, 'lifetime_requests_sent' => $new_advisee_lifetime_requests_sent]);


        self::updatedMeetingTableRequestSent($request);
        self::createdMessageInstance($request);
        self::createdIntervalsInitialRequest($request);


        $client = new Client();

        $res = $client->request('POST', 'https://hook.us1.make.com/ricg425h23abbibcf4ui544druzvh78b', [
            'form_params' => [
                'advisor_meeting_email' => $AdvisorEmail,
                'subject' => '[Candoor] New Meeting Request: '.$Adviseename .' - '.$service_name,
                'advisor_first_name' => $AdvisorData->firstname,
                'advisor_last_name' =>  $AdvisorData->lastname,
                'advisee_first_name' => $AdviseeData->firstname,
                'advisee_last_name' => $AdviseeData->lastname,
                'advisee_profile_url' => env('FRONTEND_URL').'/advisee/'.$AdviseeData->AdviseeID,
                'candoor_meeting_url' => env('FRONTEND_URL'). '/advisor/confirm-meeting/request-unconfirmed/' .$request->createdMeetingInstance,
                'meeting_type' => $service_name,
                'meeting_length' => $service_time,
                'message' =>  $request->message,
            ]
        ]);

        #$details = [
        #    'meeting_type_and_duration'=> $meeting_type_and_duration,
        #    'Advisorname'=> $Advisorname,
        #    'Adviseename' => $Adviseename,
        #    'AdvisorUserID' => $AdvisorUserID,
        #    'AdviseeUserID' => $AdviseeUserID,
        #    'AdvisorID' => $AdvisorData->AdvisorID,
        #    'AdviseeID' => $AdviseeData->AdviseeID,
        #    'AdvisorEmail' => $AdvisorEmail,
        #    'AdviseeEmail' => $AdviseeEmail,
        #    'AdvisorTimeZone' => $AdvisorTimeZone,
        #    'AdviseeTimeZone' => $AdviseeTimeZone,
        #    'AdvisorAvailability' => $AdvisorAvailability,
        #    'AdvisorProfileView' => env('FRONTEND_URL').'/advisee/advisor-directory/'.$AdvisorData->AdvisorID,
        #    'AdviseeProfileView' => env('FRONTEND_URL').'/advisor/advisee-profile/'.$AdviseeData->AdviseeID,
        #    'RequestMessage' => $request->message,
        #    'SuggestedTimeraw' => json_encode($time_interval_arr_notimezone),
        #];
        #\Mail::to('uma@candoor.io')->send(new SendRequestMeetingTohello($details));

        return response()->json([
            'make_status_code' => $res->getStatusCode(),
            'statusCode' => 200,
            'Success' => 'Successfully Data Fatched',
            'message' => 'Request has been processed',
            'meeting_type_and_duration'=> $meeting_type_and_duration,
            'Advisorname'=> $Advisorname,
            'Adviseename' => $Adviseename,
            'AdvisorUserID' => $AdvisorUserID,
            'AdviseeUserID' => $AdviseeUserID,
            'AdvisorEmail' => $AdvisorEmail,
            'AdviseeEmail' => $AdviseeEmail,
            'AdvisorTimeZone' => $AdvisorTimeZone,
            'AdviseeTimeZone' => $AdviseeTimeZone,
            'MonthlyRequestsRemaining' => $new_advisee_monthly_requests_remaining,
            'Advisor Availability' => $AdvisorAvailability,
            'Advisor Profile View' => env('FRONTEND_URL').'/advisee/advisor-directory/'.$AdvisorUserID,
            'Request Message' => $request->message,
            'Suggested Time raw' => $time_interval_arr_notimezone,
        ]);
    }

    public function updatedMeetingTableRequestSent(Request $request){
        DB::table('meetings')->where('id', $request->createdMeetingInstance)->update([
            'meeting_status' => $request->meeting_status,
            'meetingtype' => $request->meeting_type,
            'request_sent_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
            'last_status_update_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
            'availability_last_provided_by' => 'Advisee',
            'meeting_length_minutes' => $request->meeting_length
        ]);
    }

    public function createdMessageInstance(Request $request){

        $AdvisorID = $request->id;
        $AdviseeUserID = $request->user()->id;

        $advisorData = DB::table('users')->where('AdvisorID', $AdvisorID)->select('AdvisorID')->first();
        $adviseeData = DB::table('users')->where('id', $AdviseeUserID)->select('AdviseeID')->first();

        $message_instance= DB::table('messages')->insertGetId([
            'AdvisorID' => $request->id,
            'AdviseeID' => $adviseeData->AdviseeID,
            'initiating_party' => 'Advisee',
            'message' => $request->message,
            'meetingID' => $request->createdMeetingInstance,
            'message_timestamp_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
            'message_type' => 'Initial Advisee Message'
        ]);
    }

    public function createdIntervalsInitialRequest(Request $request){

        $AdvisorID = $request->id;
        $AdviseeUserID = $request->user()->id;



        $advisorData = DB::table('users')->where('AdvisorID', $AdvisorID)->select('AdvisorID', 'id')->first();
        $adviseeData = DB::table('users')->where('id', $AdviseeUserID)->select('AdviseeID')->first();

        $timezoneKey = DB::table('time_zones')->where('name', $request->advisee_time_zone)->first();

        $date_int_1_from   = Carbon::parse($request->interval_1_date.' '.$request->interval_1_from); // Carbon Parse
        $date_int_1_to   = Carbon::parse($request->interval_1_date.' '.$request->interval_1_to); // Carbon Parse

        $interval_1_dateWithTimezone_from = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_1_from, $timezoneKey->key);
        $interval_1_dateWithTimezone_from->setTimezone('UTC');

        $interval_1_dateWithTimezone_to = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_1_to, $timezoneKey->key);
        $interval_1_dateWithTimezone_to->setTimezone('UTC');

        $interval_instance1= DB::table('time_intervals')->insertGetId([
            'AdvisorID' => $advisorData->AdvisorID,
            'AdviseeID' => $adviseeData->AdviseeID,
            'meetingID' => $request->createdMeetingInstance,
            'ActionTakenBy' => 'Advisee',
            'interval_type' => 'Meeting Request',
            'created_time' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
            'time_was_accepted' => 0,
            'starttime' => $interval_1_dateWithTimezone_from,
            'endtime' => $interval_1_dateWithTimezone_to,
            'timezone' => $request->advisee_time_zone
            // 'starttime_EST' => Carbon::parse($request->interval_1_date.' '.$request->interval_1_from),
            // 'endtime_EST' => Carbon::parse($request->interval_1_date.' '.$request->interval_1_to),
        ]);

        $date_int_2_from   = Carbon::parse($request->interval_2_date.' '.$request->interval_2_from); // Carbon Parse
        $date_int_2_to   = Carbon::parse($request->interval_2_date.' '.$request->interval_2_to); // Carbon Parse

        $interval_2_dateWithTimezone_from = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_2_from, $timezoneKey->key);
        $interval_2_dateWithTimezone_from->setTimezone('UTC');

        $interval_2_dateWithTimezone_to = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_2_to, $timezoneKey->key);
        $interval_2_dateWithTimezone_to->setTimezone('UTC');

        $interval_instance2= DB::table('time_intervals')->insertGetId([
            'AdvisorID' => $advisorData->AdvisorID,
            'AdviseeID' => $adviseeData->AdviseeID,
            'meetingID' => $request->createdMeetingInstance,
            'ActionTakenBy' => 'Advisee',
            'interval_type' => 'Meeting Request',
            'created_time' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
            'time_was_accepted' => 0,
            'starttime' => $interval_2_dateWithTimezone_from,
            'endtime' => $interval_2_dateWithTimezone_to,
            'timezone' => $request->advisee_time_zone
        ]);

        $date_int_3_from   = Carbon::parse($request->interval_3_date.' '.$request->interval_3_from); // Carbon Parse
        $date_int_3_to   = Carbon::parse($request->interval_3_date.' '.$request->interval_3_to); // Carbon Parse

        $interval_3_dateWithTimezone_from = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_3_from, $timezoneKey->key);
        $interval_3_dateWithTimezone_from->setTimezone('UTC');

        $interval_3_dateWithTimezone_to = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_3_to, $timezoneKey->key);
        $interval_3_dateWithTimezone_to->setTimezone('UTC');



        $interval_instance3= DB::table('time_intervals')->insertGetId([
            'AdvisorID' => $advisorData->AdvisorID,
            'AdviseeID' => $adviseeData->AdviseeID,
            'meetingID' => $request->createdMeetingInstance,
            'ActionTakenBy' => 'Advisee',
            'interval_type' => 'Meeting Request',
            'created_time' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
            'time_was_accepted' => 0,
            'starttime' => $interval_3_dateWithTimezone_from,
            'endtime' => $interval_3_dateWithTimezone_to,
            'timezone' => $request->advisee_time_zone
            // 'starttime_EST' => Carbon::parse($request->interval_3_date.' '.$request->interval_3_from),
            // 'endtime_EST' => Carbon::parse($request->interval_3_date.' '.$request->interval_3_to),
        ]);
    }





    // public function SaveAdvisorMeetingRequest(Request $request)
    // {
    //     $services_id = $request->user_services_id;
    //     $meeting_ID = $request->meeting_id;
    //     $UserID = $request->id;
    //     // $mt_request = DB::table('meetings')->where('UserID', $request->user()->id)->where('meeting_status', 'Requested')->get();
    //     $mt_request = DB::table('meetings')->where('AdviseeID',$request->user()->AdviseeID)->whereIn('meeting_status',['Requested', 'Viewed', 'Rescheduled', 'Confirmed', 'Completed'])->get();        
    //     $mt_completed = DB::table('meetings')->where('AdviseeID', $request->user()->AdviseeID)->where('meeting_status', 'Confirmed')->get();
    //     $current_month = Carbon::now()->format('m');
    //     $current_month_req = [];
    //     $current_month_com = [];
    //     if($mt_request){
    //         foreach($mt_request as $Rkey => $value){
    //             if(Carbon::parse($value->created_at)->format('m') == $current_month);{
    //                 array_push($current_month_req, Carbon::parse($value->created_at)->format('m'));
    //             } 
    //         }
    //     }
    //     if($mt_completed){
    //         foreach($mt_completed as $Ckey => $val){
    //             if(Carbon::parse(json_decode($val->confirm_time)->date)->format('m') == $current_month){
    //                 array_push($current_month_com, Carbon::parse(json_decode($val->confirm_time)->date)->format('m'));
    //             }
    //         }
    //     }
       
    //     if(count($current_month_req) < 2 && count($current_month_com) < 2){

    //         $advisorInfo = DB::table('users')->where('id', $UserID)->first();
            
    //         $adviseeID = DB::table('users')->where('id', $request->user()->id)->first();
    //         $adviseeInfo = DB::table('advisees')->where('UserID', $request->user()->id)->first();
    //         $adviseeTimezone = DB::table('user_backgrounds')->where('UserID', $request->user()->id)->select('time_zone')->first();
    //         $timezoneKey = DB::table('time_zones')->where('name', $adviseeTimezone->time_zone)->select('key')->first();
    //         $servicesData = DB::table('user_services')->where('id', $services_id)->first();
    
    //         $int_1_from = Carbon::parse($request->interval_1_from)->addMinutes((int)$servicesData->time)->format('g:i a');
    //         $int_1_to = Carbon::parse($request->interval_1_to)->format('g:i a');
    
    //         $int_2_from = Carbon::parse($request->interval_2_from)->addMinutes((int)$servicesData->time)->format('g:i a');
    //         $int_2_to = Carbon::parse($request->interval_2_to)->format('g:i a');
    
    //         $int_3_from = Carbon::parse($request->interval_3_from)->addMinutes((int)$servicesData->time)->format('g:i a');
    //         $int_3_to = Carbon::parse($request->interval_3_to)->format('g:i a');
    //         $time_interval_arr = [];
    
    //         // Validation from date 48 hours 
    //         $int_1_48_date = Carbon::parse($request->interval_1_date.' '.$request->interval_1_from) >= Carbon::now()->addHours(48);
    //         $int_2_48_date = Carbon::parse($request->interval_2_date.' '.$request->interval_2_from) >= Carbon::now()->addHours(48);
    //         $int_3_48_date = Carbon::parse($request->interval_3_date.' '.$request->interval_3_from) >= Carbon::now()->addHours(48);
    //         if($int_1_48_date && $int_2_48_date && $int_3_48_date){
    //             // interval 1
    //             if( $int_1_from != $int_1_to || $int_2_from != $int_2_to || $int_3_from != $int_3_to ){
    //                 return response()->json([
    //                     'statusCode' => 500,
    //                     'Success' => 'Validation failed',
    //                     'message' => 'To date not match to advisor services time',
    //                 ]);
    //             }else{
    //                 // interbvval 1
    //                 $date_int_1_from   = Carbon::parse($request->interval_1_date.' '.$request->interval_1_from); // Carbon Parse
    //                 $date_int_1_to   = Carbon::parse($request->interval_1_date.' '.$request->interval_1_to); // Carbon Parse
        
    //                 $interval_1_dateWithTimezone_from = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_1_from, $timezoneKey->key);
    //                 $interval_1_dateWithTimezone_from->setTimezone('UTC');
                    
        
    //                 $interval_1_dateWithTimezone_to = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_1_to, $timezoneKey->key);
    //                 $interval_1_dateWithTimezone_to->setTimezone('UTC');
                    
    //                 array_push($time_interval_arr, ['interval_1' => ['date' => $interval_1_dateWithTimezone_from->format('y-m-d'),'from' => $interval_1_dateWithTimezone_from->format('H:i:s'), 'to' => $interval_1_dateWithTimezone_to->format('H:i:s')] ]);
    //                 // interval 2  
    //                 $date_int_2_from   = Carbon::parse($request->interval_2_date.' '.$request->interval_2_from); // Carbon Parse
    //                 $date_int_2_to   = Carbon::parse($request->interval_2_date.' '.$request->interval_2_to); // Carbon Parse
        
    //                 $interval_2_dateWithTimezone_from = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_2_from, $timezoneKey->key);
    //                 $interval_2_dateWithTimezone_from->setTimezone('UTC');
        
    //                 $interval_2_dateWithTimezone_to = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_2_to, $timezoneKey->key);
    //                 $interval_2_dateWithTimezone_to->setTimezone('UTC'); 
    //                 array_push($time_interval_arr, ['interval_2' => ['date' => $interval_2_dateWithTimezone_from->format('y-m-d'),'from' => $interval_2_dateWithTimezone_from->format('H:i:s'), 'to' => $interval_2_dateWithTimezone_to->format('H:i:s')] ]);
                    
    //                 // interval 3 
    //                 $date_int_3_from   = Carbon::parse($request->interval_3_date.' '.$request->interval_3_from, $timezoneKey->key); // Carbon Parse
    //                 $date_int_3_to   = Carbon::parse($request->interval_3_date.' '.$request->interval_3_to, $timezoneKey->key); // Carbon Parse
        
    //                 $interval_3_dateWithTimezone_from = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_3_from, $timezoneKey->key);
    //                 $interval_3_dateWithTimezone_from->setTimezone('UTC');
        
    //                 $interval_3_dateWithTimezone_to = Carbon::createFromFormat('Y-m-d H:i:s', $date_int_3_to, $timezoneKey->key);
    //                 $interval_3_dateWithTimezone_to->setTimezone('UTC');
                    
    //                 array_push($time_interval_arr, ['interval_3' => ['date' => $interval_3_dateWithTimezone_from->format('y-m-d'),'from' => $interval_3_dateWithTimezone_from->format('H:i:s'), 'to' => $interval_3_dateWithTimezone_to->format('H:i:s')], 'id' => $request->user()->id, ]);
                    
    //                 if($meeting_ID) {
    //                     DB::table('meetings')->where('id', $meeting_ID)->update([
    //                         'AdvisorID' => $advisorInfo->AdvisorID,
    //                         'AdviseeID' => $adviseeID->AdviseeID,
    //                         'UserID' => $UserID,
    //                         'message' => $request->message,
    //                         'services_id' => $services_id,
    //                         'meeting_length_minutes' => $servicesData->time,
    //                         'meeting_status'  => 'Request Sent',
    //                         'availability_time' => $time_interval_arr?json_encode($time_interval_arr):'',
    //                         'request_sent_timestamp' => Carbon::now()->setTimezone('UTC'),
    //                         'last_status_update_timestamp' => Carbon::now()->setTimezone('UTC'),
    //                         'expire_date' => Carbon::now()->addDay(10),
    //                         'created_at' => Carbon::now(),
    //                         'updated_at' => Carbon::now(),
    //                     ]);
                       
    //                     $request_meeting = $meeting_ID;
    //                 }else{
    //                     $request_meeting = DB::table('meetings')->insertGetId([
    //                         'AdvisorID' => $advisorInfo->AdvisorID,
    //                         'AdviseeID' => $adviseeID->AdviseeID,
    //                         'UserID' => $UserID,
    //                         'message' => $request->message,
    //                         'meeting_status'  => 'Request Sent',
    //                         'services_id' => $services_id,
    //                         'meeting_length_minutes' => $servicesData->time,
    //                         'availability_time' => $time_interval_arr?json_encode($time_interval_arr):'',
    //                         'expire_date' => Carbon::now()->addDay(10),
    //                         'request_sent_timestamp' => Carbon::now()->setTimezone('UTC'),
    //                         'last_status_update_timestamp' => Carbon::now()->setTimezone('UTC'),
    //                         'created_at' => Carbon::now(),
    //                         'updated_at' => Carbon::now(),
    //                     ]);
    //                 }

                    
    
    //                 // $first_request  = DB::table('meetings')->where('meeting_status', 'Requested')->whereIn('UserID',[$request->user()->id])->orderBy('updated_at', 'asc')->limit(1)->first();
    //                 // if($first_request){
    //                 //     DB::table('advisees')->where('UserID', $request->user()->id)->update([
    //                 //         'first_requested_meeting_id' => $first_request->id, 
    //                 //         'first_request_sent_timestamp_EST' => $first_request->created_at,
    //                 //     ]);
    //                 // }
    //                 $meeting_request  = DB::table('meetings')->where('id', $request_meeting)->first();
    //                 $advisee_requests_count = DB::table('meetings')->whereIn('AdviseeID', [$request->user()->AdviseeID])->get();
    //                 if($meeting_request){
    //                     $details = [
    //                         'advisor_name'  => $advisorInfo->firstname,
    //                         'advisee_name' => $request->user()->firstname,
    //                         'meeting_type' => $servicesData->meeting_type.' - '.$servicesData->time.' min',
    //                         'advisee_profile' => $adviseeInfo->profile_goal?$adviseeInfo->profile_goal:'assets/images/user.jpg',
    //                         'message' => $meeting_request->message,
    //                         'advisee_fullname' =>  $request->user()->firstname.' '.$request->user()->lastname,
    //                         'redirect_url' => env('FRONTEND_URL').'/login',
    //                     ];
    //                     \Mail::to($advisorInfo->email)->send(new SendRequestMeeting($details));
    //                     return response()->json([
    //                         'statusCode' => 200,
    //                         'Success' => 'Successfully Data Fatched',
    //                         'message' => 'Request has been processed',
    //                         'Data' => $meeting_request,
    //                         'remaining_request' => 2 - count($advisee_requests_count), 
    //                     ]);
    //                 }else{
    //                     return response()->json([
    //                         'statusCode' => 500,
    //                         'Success' => 'failed to Data Fatched',
    //                         'message' => 'Request failed',
    //                     ]);
    //                 }
    //             }
    //         }else{
    //             return response()->json([
    //                 'statusCode' => 500,
    //                 'Success' => 'Validation failed',
    //                 'message' => 'Date must be 48 hours greater than today',
    //             ]);
    //         }
    //     }else{
    //         return response()->json([
    //             'statusCode' => 500,
    //             'Success' => 'Validation failed',
    //             'message' => 'you have complete this month request meetings',
    //         ]); 
    //     }
        
    // }
}
