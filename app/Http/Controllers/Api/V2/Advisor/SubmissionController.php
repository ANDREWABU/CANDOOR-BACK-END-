<?php

namespace App\Http\Controllers\Api\V2\Advisor;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\Helpers\ApiResponseTrait;

class SubmissionController extends Controller
{
    use ApiResponseTrait;
    
    public function submit(Request $request)
    {
        $advisor=DB::table('advisors')->where('UserID',$request->user()->id);
        $advisor->update([            
            // 'signup_career_completed_timestamp_EST'=>Carbon::parse(now(),'EST')->setTimeZone('EST'),
            // 'funnel_status'=>'Motivations Complete',
            // 'signup_submitted_timestamp_EST'=>Carbon::parse(now(),'EST')->setTimeZone('EST'),
            // 'last_funnel_status_update_timestamp_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
        ]);

        return $this->respondSuccess("Submission Completed Successfully!",200);
    }
}
