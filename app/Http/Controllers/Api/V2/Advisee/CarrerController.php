<?php

namespace App\Http\Controllers\Api\V2\Advisee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AddUserCarrerGoalRequest;
use Illuminate\Http\Request;
use App\Http\Resources\WorkRoleResource;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\IndustryResource;
use App\Http\Traits\Helpers\ApiResponseTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserCarrerGoalResource;
use App\Models\Advisee;
use App\Models\CarrerGoal;
use Carbon\Carbon;

class CarrerController extends Controller
{
     use ApiResponseTrait;

    public function getDataForCarrer(Request $request)
    {
        $advisee=DB::table('advisees')->where('UserID',$request->user()->id);
        if(!$advisee->first())
        {
            $this->respondUnAuthorized();
        }
        $work_roles = DB::table('work_roles')->orderBy('name', 'ASC')->get();
        $industries = DB::table('industries')->orderBy('name', 'ASC')->get();
        $companies = DB::table('companies')->orderBy('name', 'ASC')->get();
        $employment_opportunities = array("0" => "Yes; I’m actively looking for full-time roles","1" => "Yes; I’m actively looking for part-time / internship roles", "2" => "Maybe; I’m casually browsing","3" => "No; I’m not interested in employment opportunities at this time");
        $meeting_types = DB::table('meeting_types')->orderBy('name', 'ASC')->get();

        $data=[
            'work_roles' =>new WorkRoleResource($work_roles),
            'industries' =>new IndustryResource($industries),
            'companies' =>new CompanyResource($companies),
            'meeting_types' => $meeting_types ? $meeting_types :'',
            'user_carrer' =>new UserCarrerGoalResource($advisee->first()),
            'employment_opportunities' => $employment_opportunities,
        ];
        
        return $this->respondSuccessWithData($data,'companies , industries ,work_roles Listing',200);
    }

    public function addUserCarrerGoal(Request $request)
    {

        $advisee=DB::table('advisees')->where('UserID',$request->user()->id);
        $adviseeInfo=$advisee->first();
        $advisee->update([
            'dream_roles'=>json_encode($request->dream_roles),
            'dream_industries'=>json_encode($request->dream_industries),
            'services_requested'=>json_encode($request->excited_topics),
            'last_funnel_status_update_timestamp'=>Carbon::now(),
            'Signup_journey_complete_timestamp'=>Carbon::now(),
            'funnel_status'=>'Journey Complete',
        ]);

        $advisee=DB::table('advisees')->where('UserID',$request->user()->id)->first();
        return $this->respondWithResource(new UserCarrerGoalResource($advisee),'Advisee Carrer Goals',200);
    }

    public function updateUserCareerSettings(AddUserCarrerGoalRequest $request)
    {
        
        if(!empty($request->user()->progress)){

            $obj = json_decode($request->user()->progress);
            $progress =  json_decode(json_encode($obj),true);

            if(array_key_exists("current_career_goals", $progress)){

                $advisee=DB::table('advisees')->where('UserID',$request->user()->id);
                $adviseeInfo=$advisee->first();
                $advisee->update([
                    'initial_career_goals'=>(empty($adviseeInfo->initial_career_goals)) ? $request->next_carrer_goals : $adviseeInfo->initial_career_goals,
                    'current_career_goals'=>(!empty($adviseeInfo->initial_career_goals)) ? $request->next_carrer_goals : $request->next_carrer_goals,
                    'job_search_status'=>$request->employment_opportunities ?? '',
                    'prescreening_program_opt_in'=>$request->is_prescrean_program,
                    'why_joined'=>$request->why_joined ?? '',
                    'dream_roles'=>json_encode($request->dream_roles),
                    'dream_industries'=>json_encode($request->dream_industries),
                    'services_requested'=>json_encode($request->excited_topics),
                    'dream_companies'=>json_encode($request->dream_companies),
                    'dream_locations' => $request->job_locations?$request->job_locations:null,
                    'dream_companies_other' => $request->dream_companies_other?$request->dream_companies_other:'',

                ]);

            }else{
                $prg_arr = array_merge($progress, ['progress_percent' => count($progress)*20,"current_career_goals" => 1]);
                
                $advisee=DB::table('advisees')->where('UserID',$request->user()->id);
                $adviseeInfo=$advisee->first();
                $advisee->update([
                    'initial_career_goals'=>(empty($adviseeInfo->initial_career_goals)) ? $request->next_carrer_goals : $adviseeInfo->initial_career_goals,
                    'current_career_goals'=>(!empty($adviseeInfo->initial_career_goals)) ? $request->next_carrer_goals : $request->next_carrer_goals,
                    'job_search_status'=>$request->employment_opportunities ?? '',
                    'prescreening_program_opt_in'=>$request->is_prescrean_program,
                    'why_joined'=>$request->why_joined ?? '',
                    'dream_roles'=>json_encode($request->dream_roles),
                    'dream_industries'=>json_encode($request->dream_industries),
                    'services_requested'=>json_encode($request->excited_topics),
                    'dream_companies'=>json_encode($request->dream_companies),
                    'dream_locations' => $request->job_locations?$request->job_locations:null,
                    'dream_companies_other' => $request->dream_companies_other?$request->dream_companies_other:'',

                ]);
                DB::table('users')->where('id', $request->user()->id)->update([
                    'progress' => json_encode($prg_arr),
                ]);
            }
        }else{
            $prg_arr = ['progress_percent' => 1*20, "current_career_goals" => 1 ];
          
            $advisee=DB::table('advisees')->where('UserID',$request->user()->id);
            $adviseeInfo=$advisee->first();
            $advisee->update([
                'initial_career_goals'=>(empty($adviseeInfo->initial_career_goals)) ? $request->next_carrer_goals : $adviseeInfo->initial_career_goals,
                'current_career_goals'=>(empty($adviseeInfo->initial_career_goals)) ? $request->next_carrer_goals : $request->next_carrer_goals,
                'job_search_status'=>$request->employment_opportunities ?? '',
                'prescreening_program_opt_in'=>$request->is_prescrean_program,
                'why_joined'=>$request->why_joined ?? '',
                'dream_roles'=>json_encode($request->dream_roles),
                'dream_industries'=>json_encode($request->dream_industries),
                'services_requested'=>json_encode($request->excited_topics),
                'dream_companies'=>json_encode($request->dream_companies),
                'dream_locations' => $request->job_locations?$request->job_locations:null,
                'dream_companies_other' => $request->dream_companies_other?$request->dream_companies_other:'',
            ]);
            
            DB::table('users')->where('id', $request->user()->id)->update([
                'progress' => json_encode($prg_arr),
            ]);
        }

        $advisee=DB::table('advisees')->where('UserID',$request->user()->id)->first();
        return $this->respondWithResource(new UserCarrerGoalResource($advisee),'Advisee Carrer Goals',200);
    }

    public function getUserCarrerGoal(Request $request)
    {
        $advisee=DB::table('advisees')->where('UserID',$request->user()->id)->first();
        if($advisee)
        {
            return $this->respondSuccessWithData(new UserCarrerGoalResource($advisee),'User Carrer Goals',200);
        }
        $this->respondUnAuthorized();
       

    }
}
