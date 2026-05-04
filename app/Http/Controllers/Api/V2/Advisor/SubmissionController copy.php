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
        $advisors=DB::table('advisors')->where('UserID',$request->user()->id);
        $advisors->update([            
            'funnel_status'=>'Submission Successfully',
            'signup_submitted_timestamp_EST'=>Carbon::parse(now(),'EST')->setTimeZone('EST'),
        ]);

        return $this->respondSuccess("Submission Completed Successfully!",200);
    }
}
