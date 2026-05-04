<?php

namespace App\Http\Controllers\Api\V2\Advisee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AddWorkExperienceRequest;
use App\Http\Requests\Api\CheckWorkExperienceIDRequest;
use App\Http\Requests\Api\UpdateWorkExperienceRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\IndustryResource;
use App\Http\Resources\WorkExperienceResource;
use App\Http\Resources\WorkRoleResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\Helpers\ApiResponseTrait;
use App\Models\WorkExperience;
use Carbon\Carbon;

class WorkExperienceController extends Controller
{
    use ApiResponseTrait;

    public function listing(Request $request)
    {
        $user = $request->user();
        $companies=DB::table('companies')->orderBy('name', 'ASC')->get();
        $industries=DB::table('industries')->orderBy('name', 'ASC')->get();
        $work_roles=DB::table('work_roles')->orderBy('name', 'ASC')->get();
        
        $WorkExperienceDropdown = array(
            "0" => "0",
            "1" => "1 - 3",
            "2" => "4 - 6", 
            "3" => "7 - 9",
            "4" => "10 - 15",
            "5" => "16 - 20",
            "6" => "21+"
        );
        $Employment_Type = array(
            "0" => "Full-time",
            "1" => "Part-time", 
            "2" => "Internship",
            "3" => "Apprenticeship",
            "4" => "Other (Specify)"
        );
        
        $advisee=DB::table('advisees')->where('UserID',$request->user()->id);
        $adviseeInfo=$advisee->first();
        $work_experiences=DB::table('work_experiences')->orderBy('start_date', 'desc')->where('UserID',$user->id)->get();
        $data=[
            'companies' =>new CompanyResource($companies),
            'industries' =>new IndustryResource($industries),
            'work_roles' =>new WorkRoleResource($work_roles),
            'work_exp_dropdown' => $WorkExperienceDropdown,
            'Employment_Type' => $Employment_Type,
            'work_experiences' =>WorkExperienceResource::collection($work_experiences),
            'years_work_experience' =>$adviseeInfo->years_work_experience,
            'comfort_networking_at_signup' =>$adviseeInfo->comfort_networking_at_signup,
            'dream_roles' =>$adviseeInfo->dream_roles,
            'dream_industries' =>$adviseeInfo->dream_industries,
            'services_requested' =>$adviseeInfo->services_requested,
        ];
       
        return $this->respondSuccessWithData($data,' Companies , Inquiries , work_roles Listing',200);
    }


    public function journeyDropData(Request $request)
    {
        $user = $request->user();
        $industries=DB::table('industries')->orderBy('name', 'ASC')->get();
        $work_roles=DB::table('work_roles')->orderBy('name', 'ASC')->get();
        $signup_joining_reasons=DB::table('signup_joining_reasons')->orderBy('name', 'ASC')->get();
        
        $data=[
            'industries' =>new IndustryResource($industries),
            'work_roles' =>new WorkRoleResource($work_roles),
            'signup_joining_reasons' =>$signup_joining_reasons
        ];
       
        return $this->respondSuccessWithData($data,' Companies , Inquiries , work_roles Listing',200);
    }

    public function add(Request $request)
    {
        $timestamp_est=Carbon::parse(now(),'EST')->setTimeZone('EST');
        
        if(!empty($request->user()->progress)){
            $obj = json_decode($request->user()->progress);
            $progress =  json_decode(json_encode($obj),true);
            if(array_key_exists("my_journey", $progress)){
                $workExperience =new WorkExperience();
                $workExperience->create([
                    'company'=>$request->company,
                    'Created_timestamp_EST'=>$timestamp_est,
                    'employment_type'=>$request->employment_type,
                    'start_date'=>$request->start_date?Carbon::parse($request->start_date)->format('Y-m-d H:i:s'):null,
                    'end_date'=>$request->end_date?Carbon::parse($request->end_date)->format('Y-m-d H:i:s'):null,
                    'industry'=>$request->industry,
                    'is_current'=>$request->is_current ? 1 : 0,
                    'Modified_timestamp_EST'=>$timestamp_est,
                    'role'=>$request->role,
                    'title'=>$request->title,
                    'UserID'=>$request->user()->id,
                    // 'ask_me_about'=>$request->ask_me_about,
                    'employment_type_other' => $request->employment_type_other,
                    'AdviseeID' => $request->user()->AdviseeID,
                ]);
                $recent_workData = DB::table('work_experiences')->where('UserID', $request->user()->id)->orderBy('start_date', 'desc')->first();
                $workExperience=$workExperience->where('UserID',$request->user()->id);
                $advisee=DB::table('advisees')->where('UserID',$request->user()->id);
                $advisee->update([            
                    'work_experiences'=>json_encode($workExperience->pluck('WorkExperienceID')),
                    'roles_all'=>json_encode($workExperience->pluck('role')),
                    'industries_all'=>json_encode($workExperience->pluck('industry')),
                    'companies_all'=>json_encode($workExperience->pluck('company')),
                    'most_recent_company'=>$recent_workData->company,
                    'most_recent_industry'=>$recent_workData->industry,
                    'most_recent_role'=>$recent_workData->role,
                    'most_recent_title'=>$recent_workData->title,
                    'is_founder'=>(str_contains($request->title,'founder')) ? true : false,
                ]);
            }else{
                $prg_arr = array_merge($progress, ['progress_percent' => count($progress)*20, "my_journey" => 1]);
                $workExperience =new WorkExperience();
                $workExperience->create([
                    'company'=>$request->company,
                    'Created_timestamp_EST'=>$timestamp_est,
                    'employment_type'=>$request->employment_type,
                    'start_date'=>$request->start_date?Carbon::parse($request->start_date)->format('Y-m-d H:i:s'):null,
                    'end_date'=>$request->end_date?Carbon::parse($request->end_date)->format('Y-m-d H:i:s'):null,
                    'industry'=>$request->industry,
                    'is_current'=>$request->is_current ? 1 : 0,
                    'Modified_timestamp_EST'=>$timestamp_est,
                    'role'=>$request->role,
                    'title'=>$request->title,
                    'UserID'=>$request->user()->id,
                    // 'ask_me_about'=>$request->ask_me_about,
                    'employment_type_other' => $request->employment_type_other,
                    'AdviseeID' => $request->user()->AdviseeID,
                ]);
                $recent_workData = DB::table('work_experiences')->where('UserID', $request->user()->id)->orderBy('start_date', 'desc')->first();
                $workExperience=$workExperience->where('UserID',$request->user()->id);
                $advisee=DB::table('advisees')->where('UserID',$request->user()->id);
                $advisee->update([            
                    'work_experiences'=>json_encode($workExperience->pluck('WorkExperienceID')),
                    'roles_all'=>json_encode($workExperience->pluck('role')),
                    'industries_all'=>json_encode($workExperience->pluck('industry')),
                    'companies_all'=>json_encode($workExperience->pluck('company')),
                    'most_recent_company'=>$recent_workData->company,
                    'most_recent_industry'=>$recent_workData->industry,
                    'most_recent_role'=>$recent_workData->role,
                    'most_recent_title'=>$recent_workData->title,
                    'is_founder'=>(str_contains($request->title,'founder')) ? true : false,
                ]);
                DB::table('users')->where('id', $request->user()->id)->update([
                    'progress' => json_encode($prg_arr),
                ]);
            }
        }else{
            $prg_arr = ['progress_percent' => 1*20, "my_journey" => 1 ];
            $workExperience =new WorkExperience();
            $workExperience->create([
                'company'=>$request->company,
                'Created_timestamp_EST'=>$timestamp_est,
                'employment_type'=>$request->employment_type,
                'start_date'=>$request->start_date?Carbon::parse($request->start_date)->format('Y-m-d H:i:s'):null,
                'end_date'=>$request->end_date?Carbon::parse($request->end_date)->format('Y-m-d H:i:s'):null,
                'industry'=>$request->industry,
                'is_current'=>$request->is_current ? 1 : 0,
                'Modified_timestamp_EST'=>$timestamp_est,
                'role'=>$request->role,
                'title'=>$request->title,
                'UserID'=>$request->user()->id,
                // 'ask_me_about'=>$request->ask_me_about,
                'employment_type_other' => $request->employment_type_other,
                'AdviseeID' => $request->user()->AdviseeID,
            ]);
            $recent_workData = DB::table('work_experiences')->where('UserID', $request->user()->id)->orderBy('start_date', 'desc')->first();
            $workExperience=$workExperience->where('UserID',$request->user()->id);
            $advisee=DB::table('advisees')->where('UserID',$request->user()->id);
            $advisee->update([            
                'work_experiences'=>json_encode($workExperience->pluck('WorkExperienceID')),
                'roles_all'=>json_encode($workExperience->pluck('role')),
                'industries_all'=>json_encode($workExperience->pluck('industry')),
                'companies_all'=>json_encode($workExperience->pluck('company')),
                'most_recent_company'=>$recent_workData->company,
                'most_recent_industry'=>$recent_workData->industry,
                'most_recent_role'=>$recent_workData->role,
                'most_recent_title'=>$recent_workData->title,
                'is_founder'=>(str_contains($request->title,'founder')) ? true : false,
            ]);
            DB::table('users')->where('id', $request->user()->id)->update([
                'progress' => json_encode($prg_arr),
            ]);
        }

        return $this->respondSuccessWithData(WorkExperienceResource::collection($workExperience->orderBy('start_date', 'desc')->get()),'Work Experience',200);
    }

    public function edit(CheckWorkExperienceIDRequest $request){    
       
        $work=DB::table('work_experiences')->where('WorkExperienceID',$request->id)->where('UserId',$request->user()->id);
        if($work->first())
        {
            return $this->respondWithResource(new WorkExperienceResource($work->first()),'Work Experience Detail',200);
        }

        return $this->respondNotContentOwner();
    }

    public function update(UpdateWorkExperienceRequest $request)
    {

        $work=DB::table('work_experiences')->where('WorkExperienceID',$request->id)->where('UserId',$request->user()->id);
        if(!$work->first())
        {
            return $this->respondNotContentOwner();
        }
        $timestamp_est=Carbon::parse(now(),'EST')->setTimeZone('EST');
        
        $workExperience =new WorkExperience();
        $workExperience->find($request->id)->update([
            'company'=>$request->company,
            'employment_type'=>$request->employment_type,
            'start_date'=>$request->start_date?Carbon::parse($request->start_date)->format('Y-m-d H:i:s'):null,
            'end_date'=>$request->end_date?Carbon::parse($request->end_date)->format('Y-m-d H:i:s'):null,
            'industry'=>$request->industry,
            'is_current'=>$request->is_current ? 1 : 0,
            'Modified_timestamp_EST'=>$timestamp_est,
            'role'=>$request->role,
            'title'=>$request->title,
            'employment_type_other' => $request->employment_type_other,
        ]);
        $recent_workData = DB::table('work_experiences')->where('UserID', $request->user()->id)->orderBy('start_date', 'desc')->first();
        $workExperience=$workExperience->where('UserID',$request->user()->id);
        $advisee=DB::table('advisees')->where('UserID',$request->user()->id);
        $advisee->update([            
            'roles_all'=>json_encode($workExperience->pluck('role')),
            'industries_all'=>json_encode($workExperience->pluck('industry')),
            'companies_all'=>json_encode($workExperience->pluck('company')),
            'most_recent_company'=>$recent_workData->company,
            'most_recent_industry'=>$recent_workData->industry,
            'most_recent_role'=>$recent_workData->role,
            'most_recent_title'=>$recent_workData->title,
            'is_founder'=>(str_contains($request->title,'founder')) ? true : false,
        ]);

        return $this->respondSuccessWithData(WorkExperienceResource::collection($workExperience->orderBy('start_date', 'desc')->get()),'Work Experiences',200);
    }

    public function destroy(CheckWorkExperienceIDRequest $request)
    {
        $eduDT = DB::table('education_experiences')->whereIn('UserID', [$request->user()->id])->get();
        
        $work=DB::table('work_experiences')->where('WorkExperienceID',$request->id)->where('UserId',$request->user()->id);
        if($work_experiecnce=$work->first())
        {
            
            $work_experiences=DB::table('work_experiences')->where('UserID',$request->user()->id)->get();
            $advisee=DB::table('advisees')->where('UserID',$request->user()->id);
            $adviseeInfo=$advisee->first();
            $advisee->update([            
                'work_experiences'=>json_encode($work_experiences->pluck('WorkExperienceID')),
                'roles_all'=>json_encode($work_experiences->pluck('role')),
                'industries_all'=>json_encode($work_experiences->pluck('industry')),
                'companies_all'=>json_encode($work_experiences->pluck('company')),
                'most_recent_company'=>($adviseeInfo->most_recent_company==$work_experiecnce->company) ? null : $adviseeInfo->most_recent_company,
                'most_recent_industry'=>($adviseeInfo->most_recent_industry==$work_experiecnce->industry) ? null : $adviseeInfo->most_recent_industry,
                'most_recent_role'=>($adviseeInfo->most_recent_role==$work_experiecnce->role) ? null : $adviseeInfo->most_recent_role,
                'most_recent_title'=>($adviseeInfo->most_recent_title==$work_experiecnce->title) ? null : $adviseeInfo->most_recent_title,
                'is_founder'=>(str_contains($work_experiecnce->title,'founder')) ? false : true,
            ]);
            $work->delete();
            $wrkDT = DB::table('work_experiences')->whereIn('UserID', [$request->user()->id])->get();
            $obj = json_decode($request->user()->progress);
            $progress =  json_decode(json_encode($obj),true);
            // dd(count($eduDT));
            if(count($eduDT) == 0 && count($wrkDT) == 0){
                if(array_key_exists("my_journey", $progress)){
                    unset($progress["my_journey"]);
                    $prg_arr = array_merge($progress, ['progress_percent' => (count($progress)-1)*20]);
                    DB::table('users')->where('id', $request->user()->id)->update([
                        'progress' => json_encode($prg_arr),
                    ]);
                }
            }
            $work_experiences=DB::table('work_experiences')->orderBy('start_date', 'desc')->where('UserID',$request->user()->id)->get();
            return $this->respondWithResource(WorkExperienceResource::collection($work_experiences),'Work Experience Details',200);
        }
        return $this->respondNotContentOwner();
    }

    public function addHighestExperienceComfort(Request $request)
    {
        
        $request->validate([
            'years_work_experience' => 'required|string',
            'comfort_networking_at_signup' => 'required|numeric|min:1|max:5',
        ]);
        
        $advisee=DB::table('advisees')->where('UserID',$request->user()->id);
        $advisee->update([
            'signup_career_completed_timestamp_EST'=>Carbon::parse(now(),'EST')->setTimeZone('EST'),         
            'years_work_experience'=>$request->years_work_experience,
            'comfort_networking_at_signup'=>$request->comfort_networking_at_signup,
            'funnel_status'=>'Career Info Complete',
            'last_funnel_status_update_timestamp_EST'=>Carbon::parse(now(),'EST')->setTimeZone('EST'),
        ]);

        return $this->respondSuccess('Highest Year Experience and Comfort Level Added Successfully !' ,201);
    }
    
}
