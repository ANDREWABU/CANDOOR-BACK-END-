<?php

namespace App\Http\Controllers\Api\V2\Advisor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Advisor\MotivationRequest;
use App\Http\Resources\Advisor\MotivationResource;
use App\Http\Traits\Helpers\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MotivationController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request)
    {
        $advisor=DB::table('advisors')->where('UserID',$request->user()->id);
        if(!$advisor->first())
        {
            $this->respondUnAuthorized();
        }
        $data=[
            'motivation' =>new MotivationResource($advisor->first()),
        ];
        // $advisor->update([
        //     'funnel_status'=>'Demographic Info Complete',
        //     'last_funnel_status_update_timestamp_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),

        // ]);
        return $this->respondSuccessWithData($data,'Advisor Motivation Data',200);
    }

    public function addUserMotivationData(MotivationRequest $request)
    {
        
        if(!$request->user()->hasRole('Advisor'))
        {
            $this->respondUnAuthorized();
        }
        DB::table('advisors')->where('UserID',$request->user()->id)->update([
            
            'prescreening_program_opt_in'=>$request->is_prescrean_program,
            'joining_reason'=>$request->why_joined ? $request->why_joined :'',
            'prior_experience'=>$request->prior_experience,
            'signup_ways_to_help_completed_timestamp_EST'=>Carbon::parse(now(),'EST')->setTimeZone('EST'),
            'funnel_status'=>'Motivations Complete'
        ]);
        $advisorInfo=DB::table('advisors')->where('UserID',$request->user()->id)->first();
        return $this->respondWithResource(new MotivationResource($advisorInfo),'Advisor Motivation Data',200);
    }
}
