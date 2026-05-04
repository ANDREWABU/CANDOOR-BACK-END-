<?php

namespace App\Http\Controllers\Crons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ExpireMeetingController extends Controller
{
    public function expireMeeting(Request $request)
    {
        $now = Carbon::now();
        $expired =  DB::table('meetings')->where('expire_date','<=', $now->toDateString())->whereIn('meeting_status', ['Requested', 'Viewed', 'Rescheduled'])->update(['meeting_status' => 'Expired']);        
        return  "Meeting Expired!";
    }
}