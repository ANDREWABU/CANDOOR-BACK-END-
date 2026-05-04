<?php

namespace App\Http\Controllers\Api\V2\Advisee;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\EducationExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\EducationExperienceResource;
use App\Http\Traits\Helpers\ApiResponseTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class EducationExperienceController extends Controller
{
    use ApiResponseTrait;

    //
    public function add(Request $request){

        if($request->is_current){
            $request->validate([
                'school' => 'required|string',
                'degree' => 'required|string',
                'fields_of_study' => 'required',
                'start_date' => 'required|date',
            ]);
        }else{
            $request->validate([
                'school' => 'required|string',
                'degree' => 'required|string',
                'fields_of_study' => 'required',
                'start_date' => 'required|date',
                'graduation_year' => 'required|date', // end date
            ]);
        }

        
        
        if(!empty($request->user()->progress)){
            $obj = json_decode($request->user()->progress);
            $progress =  json_decode(json_encode($obj),true);
            if(array_key_exists("my_journey", $progress)){

                $educationExperience = new EducationExperience();
                $educationExperience->school = $request->school;
                $educationExperience->degree = $request->degree;
                $educationExperience->fields_of_study = json_encode($request->fields_of_study);
                $educationExperience->AdviseeID = $request->user()->AdviseeID;
                $educationExperience->start_date = $request->start_date?Carbon::parse($request->start_date)->format('Y-m-d'):null;
                $educationExperience->graduation_year = $request->graduation_year?Carbon::parse($request->graduation_year)->format('Y-m-d'):null;
                $educationExperience->is_current = $request->is_current?$request->is_current:0;
                $educationExperience->Created_timestamp_EST =  Carbon::parse(now(),'EST')->setTimeZone('EST');
                $educationExperience->Modified_timestamp_EST = Carbon::parse(now(),'EST')->setTimeZone('EST');
                $educationExperience->UserID = $request->user()->id;
                $educationExperience->save();

                $recent_educationData = DB::table('education_experiences')->where('UserID', $request->user()->id)->orderBy('start_date', 'desc')->first();
                $advisee=DB::table('advisees')->where('UserID',$request->user()->id);
                $advisee->update([            
                    'education_experiences'=>json_encode($educationExperience->where('UserID',$request->user()->id)->pluck('EducationExperienceID')),
                    'fields_of_study_all'=>json_encode($educationExperience->where('UserID',$request->user()->id)->pluck('fields_of_study')),
                    'university_grad_year'=>  (str_contains($request->degree, 'Bachelor') || str_contains($request->degree, "Bachelor's")) ? date('m/y',strtotime($request->graduation_year)) : null,
                    'most_recent_degree'=>$recent_educationData->degree,
                    'most_recent_school'=>$recent_educationData->school,
                ]);
            }else{
                $prg_arr = array_merge($progress, ['progress_percent' => count($progress)*20,"my_journey" => 1]);
                $educationExperience = new EducationExperience();
                $educationExperience->school = $request->school;
                $educationExperience->degree = $request->degree;
                $educationExperience->fields_of_study = json_encode($request->fields_of_study);
                $educationExperience->AdviseeID = $request->user()->AdviseeID;
                $educationExperience->start_date = $request->start_date?Carbon::parse($request->start_date)->format('Y-m-d'):null;
                $educationExperience->graduation_year = $request->graduation_year?Carbon::parse($request->graduation_year)->format('Y-m-d'):null;
                $educationExperience->is_current = $request->is_current?$request->is_current:0;
                $educationExperience->Created_timestamp_EST =  Carbon::parse(now(),'EST')->setTimeZone('EST');
                $educationExperience->Modified_timestamp_EST = Carbon::parse(now(),'EST')->setTimeZone('EST');
                $educationExperience->UserID = $request->user()->id;
                $educationExperience->save();

                $recent_educationData = DB::table('education_experiences')->where('UserID', $request->user()->id)->orderBy('start_date', 'desc')->first();
                $advisee=DB::table('advisees')->where('UserID',$request->user()->id);
                $advisee->update([            
                    'education_experiences'=>json_encode($educationExperience->where('UserID',$request->user()->id)->pluck('EducationExperienceID')),
                    'fields_of_study_all'=>json_encode($educationExperience->where('UserID',$request->user()->id)->pluck('fields_of_study')),
                    'university_grad_year'=>  (str_contains($request->degree, 'Bachelor') || str_contains($request->degree, "Bachelor's")) ? date('m/y',strtotime($request->graduation_year)) : null,
                    'most_recent_degree'=>$recent_educationData->degree,
                    'most_recent_school'=>$recent_educationData->school,
                ]);
                DB::table('users')->where('id', $request->user()->id)->update([
                    'progress' => json_encode($prg_arr),
                ]);
            }
        }else{
            $prg_arr = ['progress_percent' => 1*20, "my_journey" => 1 ];
            $educationExperience = new EducationExperience();
            $educationExperience->school = $request->school;
            $educationExperience->degree = $request->degree;
            $educationExperience->fields_of_study = json_encode($request->fields_of_study);
            $educationExperience->AdviseeID = $request->user()->AdviseeID;
            $educationExperience->start_date = $request->start_date?Carbon::parse($request->start_date)->format('Y-m-d'):null;
            $educationExperience->graduation_year = $request->graduation_year?Carbon::parse($request->graduation_year)->format('Y-m-d'):null;
            $educationExperience->is_current = $request->is_current?$request->is_current:0;
            $educationExperience->Created_timestamp_EST =  Carbon::parse(now(),'EST')->setTimeZone('EST');
            $educationExperience->Modified_timestamp_EST = Carbon::parse(now(),'EST')->setTimeZone('EST');
            $educationExperience->UserID = $request->user()->id;
            $educationExperience->save();
    
            $recent_educationData = DB::table('education_experiences')->where('UserID', $request->user()->id)->orderBy('start_date', 'desc')->first();
            $advisee=DB::table('advisees')->where('UserID',$request->user()->id);
            $advisee->update([            
                'education_experiences'=>json_encode($educationExperience->where('UserID',$request->user()->id)->pluck('EducationExperienceID')),
                'fields_of_study_all'=>json_encode($educationExperience->where('UserID',$request->user()->id)->pluck('fields_of_study')),
                'university_grad_year'=>  (str_contains($request->degree, 'Bachelor') || str_contains($request->degree, "Bachelor's")) ? date('m/y',strtotime($request->graduation_year)) : null,
                'most_recent_degree'=>$recent_educationData->degree,
                'most_recent_school'=>$recent_educationData->school,
            ]);
            DB::table('users')->where('id', $request->user()->id)->update([
                'progress' => json_encode($prg_arr),
            ]);
        }

        return $this->respondSuccessWithData(EducationExperienceResource::collection($educationExperience->orderBy('start_date', 'desc')->where('UserID',$request->user()->id)->get()),'Education Experience',200);
    }

    public function edit(Request $request){    
        $request->validate([
            'id' => 'required|integer|exists:education_experiences,EducationExperienceID',
            
        ],
        [
            'id.exists'=>'The Given id is invalid.'
        ]);
        $education=DB::table('education_experiences')->where('EducationExperienceID',$request->id)->where('UserId',$request->user()->id);
        if($education->first())
        {
            return $this->respondWithResource(new EducationExperienceResource($education->first()),'Education Experience Details',200);
        }

        return $this->respondNotContentOwner();
    }

    public function update(Request $request){
        
        if($request->is_current){
            $request->validate([
                'id' => 'required|integer|exists:education_experiences,EducationExperienceID',
                'school' => 'required|string',
                'degree' => 'required|string',
                'fields_of_study' => 'required|array',
                'start_date' => 'required|date',
            ],
            [
                'id.exists'=>'The Given id is invalid.'
            ]);
        }else{
            $request->validate([
                'id' => 'required|integer|exists:education_experiences,EducationExperienceID',
                'school' => 'required|string',
                'degree' => 'required|string',
                'fields_of_study' => 'required|array',
                'start_date' => 'required|date',
                'graduation_year' => 'required|date',
            ],
            [
                'id.exists'=>'The Given id is invalid.'
            ]);
        }
        $education=DB::table('education_experiences')->where('EducationExperienceID',$request->id)->where('UserId',$request->user()->id);
        if($education->first())
        {
            $timestamp_est=Carbon::parse(now(),'EST')->setTimeZone('EST');
            $education->update(
                [
                    'school'=>$request->school,
                    'degree'=>$request->degree,
                    'fields_of_study'=>json_encode($request->fields_of_study),
                    'start_date'=>$request->start_date?Carbon::parse($request->start_date)->format('Y-m-d'):null,
                    'graduation_year'=>$request->graduation_year?Carbon::parse($request->graduation_year)->format('Y-m-d'):null,
                    'is_current'=>$request->is_current?$request->is_current:0,
                    'Modified_timestamp_EST'=>$timestamp_est,
                ]
            );
            $recent_educationData = DB::table('education_experiences')->where('UserID', $request->user()->id)->orderBy('start_date', 'desc')->first();
            $advisee=DB::table('advisees')->where('UserID',$request->user()->id);
            $advisee->update([            
                'most_recent_degree'=>$recent_educationData->degree,
                'most_recent_school'=>$recent_educationData->school,
            ]);
            $educations=DB::table('education_experiences')->orderBy('start_date', 'desc')->where('UserID',$request->user()->id)->get();
            return $this->respondWithResource(EducationExperienceResource::collection($educations),'Education Experience Details',200);
        }

        return $this->respondNotContentOwner();
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:education_experiences,EducationExperienceID',
        ],
        [
            'id.exists'=>'The Given id is invalid.'
        ]);

        $wrkDT = DB::table('work_experiences')->whereIn('UserID', [$request->user()->id])->get();
        $education=DB::table('education_experiences')->where('EducationExperienceID',$request->id)->where('UserId',$request->user()->id);
        if($advisee_education=$education->first())
        {
            
            $advisee=DB::table('advisees')->where('UserID',$request->user()->id);
            
            $educations=DB::table('education_experiences')->where('UserID',$request->user()->id)->get();
            $adviseeInfo=$advisee->first();
            $advisee->update([            
                'education_experiences'=>json_encode($educations->pluck('EducationExperienceID')),
                'fields_of_study_all'=>json_encode($educations->pluck('fields_of_study')),
                'most_recent_degree'=>($adviseeInfo->most_recent_degree==$advisee_education->degree) ? null : $adviseeInfo->most_recent_degree,
                'most_recent_school'=>($adviseeInfo->most_recent_school==$advisee_education->school) ? null : $adviseeInfo->most_recent_school,
            
            ]);
            $education->delete();
            $eduDT = DB::table('education_experiences')->whereIn('UserID', [$request->user()->id])->get();
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
            $educations=DB::table('education_experiences')->orderBy('start_date', 'desc')->where('UserID',$request->user()->id)->get();
            return $this->respondWithResource(EducationExperienceResource::collection($educations),'Education Experience Details',200);
        }
        return $this->respondNotContentOwner();
    }

    public function addHighestDegree(Request $request)
    {
        
        $request->validate([
            'highest_degree' => 'required|string',
        ]);
        $advisee=DB::table('advisees')->where('UserID',$request->user()->id);
        $advisee->update([            
            'highest_degree_completed'=>$request->highest_degree,
            'funnel_status'=>'Education Info Complete',
            'signup_education_completed_timestamp_EST'=>Carbon::parse(now(),'EST')->setTimeZone('EST'),
            'last_funnel_status_update_timestamp_EST'=>Carbon::parse(now(),'EST')->setTimeZone('EST'),
        ]);

        return $this->respondSuccess('Highest Degree Added Successfully !' ,201);
    }
}
