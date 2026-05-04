<?php

namespace App\Http\Controllers\Api\V2\Advisor;

use App\Http\Controllers\Controller;
use App\Http\Resources\DegreeResource;
use App\Http\Resources\EducationExperienceResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\Helpers\ApiResponseTrait;
use App\Http\Resources\FiledOfStudyResource;
use App\Http\Resources\SchoolResource;
use App\Models\EducationExperience;
use Carbon\Carbon;

class GetEducationController extends Controller
{
    use ApiResponseTrait;

    public function __invoke(Request $request)
    {
        $user = $request->user();
      
        // DB::table('advisors')->where('UserID', $user->id)->update([
        //     // 'officehours_email' => $user->email,
        //     'last_funnel_status_update_timestamp_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST')
        // ]);
        $filed_of_studies=DB::table('field_of_studies')->orderBy('name', 'ASC')->get();
        $get_heigest_degree_completed=DB::table('highest_degree_completeds')->orderBy('name', 'ASC')->get();
        $schools=DB::table('schools')->orderBy('name', 'ASC')->get();
        $degrees=DB::table('degrees')->orderBy('name', 'ASC')->get();
        $highest_degree=DB::table('advisors')->where('UserID',$request->user()->id)->value('highest_degree_completed');
        $education_experiences=DB::table('education_experiences')->orderBy('start_date', 'desc')->where('UserID',$user->id)->get();
        $data=[
            'field_of_studies' =>new FiledOfStudyResource($filed_of_studies),
            'schools' => $schools,
            'degrees' =>new DegreeResource($degrees),
            'education_experiences' => EducationExperienceResource::collection($education_experiences),
            'highest_degree' => $highest_degree,
            'get_heigest_degree_completed' => $get_heigest_degree_completed,
        ];
        return $this->respondSuccessWithData($data,'Degree , Schools ,Field of Studies and education Listing',200);
    }
}
