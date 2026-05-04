<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\Helpers\ApiResponseTrait;

class ViewMeetingDataController extends Controller
{
    use ApiResponseTrait;

    public function GetCompletedMeetingData(Request $request){   
        $meeting_id = $request->meeting_id;

        //Meeting Data and Advisee Data
        $meeting_data = DB::table('meetings')->leftjoin('meeting_outcome', 'meeting_outcome.MeetingID', '=', 'meetings.id' )->where('meetings.id', $meeting_id)->first();
        $advisorData = DB::table('users')->leftjoin('advisors', 'advisors.UserID', '=', 'users.id')->where('advisors.AdvisorID', $meeting_data->AdvisorID)->select('users.firstname', 'users.lastname', 'users.email', 'advisors.UserID', 'advisors.profile_goal','advisors.monthly_capacity','advisors.availability_time', 'advisors.AdvisorID')->first();
        $adviseeData = DB::table('users')->leftjoin('advisees', 'advisees.UserID', '=', 'users.id')->where('advisees.AdviseeID', $meeting_data->AdviseeID)->select('users.firstname', 'users.lastname', 'users.email', 'advisees.UserID','advisees.profile_goal', 'advisees.AdviseeID')->first();
        $meeting_message = DB::table('messages')->where('meetingID', $meeting_id)->where('message_type', 'Initial Advisee Message')->first();

        //Getting Time intervals
        // $time_intervals = DB::table('time_intervals')->where('meetingID', $meeting_id)->orderBy('created_time','desc')->take(3)->get();

        $advisorTimeZone = DB::table('user_backgrounds')->where('UserID', $advisorData->UserID)->select('time_zone')->first();
        $advisorTimeZoneKey = DB::table('time_zones')->where('name', $advisorTimeZone->time_zone)->select('key')->first();
        $adviseeTimeZone = DB::table('user_backgrounds')->where('UserID', $adviseeData->UserID)->select('time_zone')->first();
        $adviseeTimeZoneKey = DB::table('time_zones')->where('name', $adviseeTimeZone->time_zone)->select('key')->first();

        $meetingStart = '';
        $reschedule_warning = 0;
        if($meeting_data->starttime){
            $confirmedTimezoneKey = DB::table('time_zones')->where('name', $meeting_data->confirmed_timezone)->select('key')->first();
            $meetingStartUTC = Carbon::createFromFormat('Y-m-d H:i:s', $meeting_data->starttime, 'UTC');
            $meetingEndUTC   = Carbon::createFromFormat('Y-m-d H:i:s', $meeting_data->endtime, 'UTC');

            $meetingStart = (clone $meetingStartUTC)->setTimezone($confirmedTimezoneKey->key);
            $meetingEnd   = (clone $meetingEndUTC)->setTimezone($confirmedTimezoneKey->key);
            $meetingStartAdvisor = (clone $meetingStartUTC)->setTimezone($advisorTimeZoneKey->key);
            $meetingEndAdvisor   = (clone $meetingEndUTC)->setTimezone($advisorTimeZoneKey->key);
            $meetingStartAdvisee = (clone $meetingStartUTC)->setTimezone($adviseeTimeZoneKey->key);
            $meetingEndAdvisee   = (clone $meetingEndUTC)->setTimezone($adviseeTimeZoneKey->key);

            $meeting_data->formated_date  = $meetingStart->format('l, M jS');
            $meeting_data->formated_start = ltrim($meetingStart->format('h:i A'), 0);
            $meeting_data->formated_end   = ltrim($meetingEnd->format('h:i A'), 0);

            $meeting_data->advisor_formated_date  = $meetingStartAdvisor->format('l, M jS');
            $meeting_data->advisor_formated_start = ltrim($meetingStartAdvisor->format('h:i A'), 0);
            $meeting_data->advisor_formated_end   = ltrim($meetingEndAdvisor->format('h:i A'), 0);

            $meeting_data->advisee_formated_date  = $meetingStartAdvisee->format('l, M jS');
            $meeting_data->advisee_formated_start = ltrim($meetingStartAdvisee->format('h:i A'), 0);
            $meeting_data->advisee_formated_end   = ltrim($meetingEndAdvisee->format('h:i A'), 0);
        }

        return response()->json([
            'statusCode' => 200,
            'Success' => 'Successfully Data Fatched',
            'message' => 'Request has been processed',
            'meeting_data' => $meeting_data,
            'advisorData' => $advisorData,
            'adviseeData' => $adviseeData,
            'meeting_message' => $meeting_message,
            'advisor_time_zone' => $advisorTimeZone,
            'advisee_time_zone' => $adviseeTimeZone,
        ]);
    }

    public function ViewMeetingData(Request $request){
        $meeting_id = $request->meeting_id;

        //Update request status to viewed
        if($request->user()->hasRole('Advisor')){
            $meeting_status = DB::table('meetings')->where('id', $meeting_id)->select('meeting_status')->first();
            if($meeting_status->meeting_status == 'Request Sent'){
                DB::table('meetings')->where('id', $meeting_id)->update([
                'request_first_viewed_EST'=> Carbon::parse(now(),'EST')->setTimeZone('EST'),
                'meeting_status'=>'Request Viewed',
                'last_status_update_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
            
            ]);
            }
        }

        //Meeting Data and Advisee Data
        $meeting_data = DB::table('meetings')->leftjoin('meeting_outcome', 'meeting_outcome.MeetingID', '=', 'meetings.id' )->where('meetings.id', $meeting_id)->first();
//        $meeting_data = DB::table('meetings')->where('id', $meeting_id)->first();
        $advisorData = DB::table('users')->leftjoin('advisors', 'advisors.UserID', '=', 'users.id')->where('advisors.AdvisorID', $meeting_data->AdvisorID)->select('users.firstname', 'users.lastname', 'advisors.UserID', 'advisors.profile_goal','advisors.monthly_capacity','advisors.availability_time', 'advisors.AdvisorID')->first();
        $adviseeData = DB::table('users')->leftjoin('advisees', 'advisees.UserID', '=', 'users.id')->where('advisees.AdviseeID', $meeting_data->AdviseeID)->select('users.firstname', 'users.lastname', 'advisees.UserID','advisees.profile_goal', 'advisees.AdviseeID')->first();
        $meeting_message = DB::table('messages')->where('meetingID', $meeting_id)->where('message_type', 'Initial Advisee Message')->first();

        //Getting Time intervals
        // $time_intervals = DB::table('time_intervals')->where('meetingID', $meeting_id)->orderBy('created_time','desc')->take(3)->get();
        $time_intervals = DB::table('time_intervals')->where('meetingID', $meeting_id)->latest('created_time')->take(3)->get();


        $advisorTimeZone = DB::table('user_backgrounds')->where('UserID', $advisorData->UserID)->select('time_zone')->first();
        $advisorTimeZoneKey = DB::table('time_zones')->where('name', $advisorTimeZone->time_zone)->select('key')->first();

        $adviseeTimeZone = DB::table('user_backgrounds')->where('UserID', $adviseeData->UserID)->select('time_zone')->first();
        $adviseeTimeZoneKey = DB::table('time_zones')->where('name', $adviseeTimeZone->time_zone)->select('key')->first();

        $intervals_time_zone = $time_intervals[0]->timezone;
        $intervalsTimezoneKey = DB::table('time_zones')->where('name', $intervals_time_zone)->select('key')->first();

        $time_interval_1_start = Carbon::createFromFormat('Y-m-d H:i:s', $time_intervals[0]->starttime, 'UTC')->setTimezone($intervalsTimezoneKey->key);
        $time_interval_1_end   = Carbon::createFromFormat('Y-m-d H:i:s', $time_intervals[0]->endtime, 'UTC')->setTimezone($intervalsTimezoneKey->key);

        $time_interval_2_start = Carbon::createFromFormat('Y-m-d H:i:s', $time_intervals[1]->starttime, 'UTC')->setTimezone($intervalsTimezoneKey->key);
        $time_interval_2_end   = Carbon::createFromFormat('Y-m-d H:i:s', $time_intervals[1]->endtime, 'UTC')->setTimezone($intervalsTimezoneKey->key);

        $time_interval_3_start = Carbon::createFromFormat('Y-m-d H:i:s', $time_intervals[2]->starttime, 'UTC')->setTimezone($intervalsTimezoneKey->key);
        $time_interval_3_end   = Carbon::createFromFormat('Y-m-d H:i:s', $time_intervals[2]->endtime, 'UTC')->setTimezone($intervalsTimezoneKey->key);



        $formated_time_intervals= [];
        array_push($formated_time_intervals, 
            ['interval_1' => 
                [
                    'date' => $time_interval_1_start->format('l, M jS'),
                    'start_time' => ltrim($time_interval_1_start->format('h:i A'),0), 
                    'end_time' => ltrim($time_interval_1_end->format('h:i A'), 0),
                ] 
            ]);

            array_push($formated_time_intervals, 
            ['interval_2' => 
                [
                    'date' => $time_interval_2_start->format('l, M jS'),
                    'start_time' => ltrim($time_interval_2_start->format('h:i A'),0),
                    'end_time' => ltrim($time_interval_2_end->format('h:i A'), 0),
                ] 
            ]);

            array_push($formated_time_intervals,
            ['interval_3' =>
                [
                    'date' => $time_interval_3_start->format('l, M jS'),
                    'start_time' => ltrim($time_interval_3_start->format('h:i A'),0),
                    'end_time' => ltrim($time_interval_3_end->format('h:i A'),0),
                ]
            ]);

            // Intervals converted to the advisor's own timezone
            $adv1s = Carbon::createFromFormat('Y-m-d H:i:s', $time_intervals[0]->starttime, 'UTC')->setTimezone($advisorTimeZoneKey->key);
            $adv1e = Carbon::createFromFormat('Y-m-d H:i:s', $time_intervals[0]->endtime,   'UTC')->setTimezone($advisorTimeZoneKey->key);
            $adv2s = Carbon::createFromFormat('Y-m-d H:i:s', $time_intervals[1]->starttime, 'UTC')->setTimezone($advisorTimeZoneKey->key);
            $adv2e = Carbon::createFromFormat('Y-m-d H:i:s', $time_intervals[1]->endtime,   'UTC')->setTimezone($advisorTimeZoneKey->key);
            $adv3s = Carbon::createFromFormat('Y-m-d H:i:s', $time_intervals[2]->starttime, 'UTC')->setTimezone($advisorTimeZoneKey->key);
            $adv3e = Carbon::createFromFormat('Y-m-d H:i:s', $time_intervals[2]->endtime,   'UTC')->setTimezone($advisorTimeZoneKey->key);

            $advisor_formatted_time_intervals = [
                ['interval_1' => ['date' => $adv1s->format('l, M jS'), 'start_time' => ltrim($adv1s->format('h:i A'), 0), 'end_time' => ltrim($adv1e->format('h:i A'), 0)]],
                ['interval_2' => ['date' => $adv2s->format('l, M jS'), 'start_time' => ltrim($adv2s->format('h:i A'), 0), 'end_time' => ltrim($adv2e->format('h:i A'), 0)]],
                ['interval_3' => ['date' => $adv3s->format('l, M jS'), 'start_time' => ltrim($adv3s->format('h:i A'), 0), 'end_time' => ltrim($adv3e->format('h:i A'), 0)]],
            ];

            // Intervals converted to the advisee's own timezone
            $adse1s = Carbon::createFromFormat('Y-m-d H:i:s', $time_intervals[0]->starttime, 'UTC')->setTimezone($adviseeTimeZoneKey->key);
            $adse1e = Carbon::createFromFormat('Y-m-d H:i:s', $time_intervals[0]->endtime,   'UTC')->setTimezone($adviseeTimeZoneKey->key);
            $adse2s = Carbon::createFromFormat('Y-m-d H:i:s', $time_intervals[1]->starttime, 'UTC')->setTimezone($adviseeTimeZoneKey->key);
            $adse2e = Carbon::createFromFormat('Y-m-d H:i:s', $time_intervals[1]->endtime,   'UTC')->setTimezone($adviseeTimeZoneKey->key);
            $adse3s = Carbon::createFromFormat('Y-m-d H:i:s', $time_intervals[2]->starttime, 'UTC')->setTimezone($adviseeTimeZoneKey->key);
            $adse3e = Carbon::createFromFormat('Y-m-d H:i:s', $time_intervals[2]->endtime,   'UTC')->setTimezone($adviseeTimeZoneKey->key);

            $advisee_formatted_time_intervals = [
                ['interval_1' => ['date' => $adse1s->format('l, M jS'), 'start_time' => ltrim($adse1s->format('h:i A'), 0), 'end_time' => ltrim($adse1e->format('h:i A'), 0)]],
                ['interval_2' => ['date' => $adse2s->format('l, M jS'), 'start_time' => ltrim($adse2s->format('h:i A'), 0), 'end_time' => ltrim($adse2e->format('h:i A'), 0)]],
                ['interval_3' => ['date' => $adse3s->format('l, M jS'), 'start_time' => ltrim($adse3s->format('h:i A'), 0), 'end_time' => ltrim($adse3e->format('h:i A'), 0)]],
            ];
            
            $meetingStart = '';
            $reschedule_warning = 0;
            if($meeting_data->starttime){
                $confirmedTimezoneKey = DB::table('time_zones')->where('name', $meeting_data->confirmed_timezone)->select('key')->first();
                $meetingStartUTC = Carbon::createFromFormat('Y-m-d H:i:s', $meeting_data->starttime, 'UTC');
                $meetingEndUTC   = Carbon::createFromFormat('Y-m-d H:i:s', $meeting_data->endtime, 'UTC');

                $meetingStart = (clone $meetingStartUTC)->setTimezone($confirmedTimezoneKey->key);
                $meetingEnd   = (clone $meetingEndUTC)->setTimezone($confirmedTimezoneKey->key);
                $meetingStartAdvisor = (clone $meetingStartUTC)->setTimezone($advisorTimeZoneKey->key);
                $meetingEndAdvisor   = (clone $meetingEndUTC)->setTimezone($advisorTimeZoneKey->key);
                $meetingStartAdvisee = (clone $meetingStartUTC)->setTimezone($adviseeTimeZoneKey->key);
                $meetingEndAdvisee   = (clone $meetingEndUTC)->setTimezone($adviseeTimeZoneKey->key);

                $meeting_data->formated_date  = $meetingStart->format('l, M jS');
                $meeting_data->formated_start = ltrim($meetingStart->format('h:i A'), 0);
                $meeting_data->formated_end   = ltrim($meetingEnd->format('h:i A'), 0);

                $meeting_data->advisor_formated_date  = $meetingStartAdvisor->format('l, M jS');
                $meeting_data->advisor_formated_start = ltrim($meetingStartAdvisor->format('h:i A'), 0);
                $meeting_data->advisor_formated_end   = ltrim($meetingEndAdvisor->format('h:i A'), 0);

                $meeting_data->advisee_formated_date  = $meetingStartAdvisee->format('l, M jS');
                $meeting_data->advisee_formated_start = ltrim($meetingStartAdvisee->format('h:i A'), 0);
                $meeting_data->advisee_formated_end   = ltrim($meetingEndAdvisee->format('h:i A'), 0);

                $confirmDate_less_12 = Carbon::parse($meeting_data->starttime)->subHour(12);
                if(Carbon::now('UTC') >= $confirmDate_less_12){
                    $reschedule_warning = 1;
                }else{
                    $reschedule_warning = 0;
                }
            }
            $meeting_data->id = $meeting_id;
//		        Log::debug('ViewMeetingDataController Line 151 -  $meeting_data->id '. $meeting_data->id);

        return response()->json([
            'statusCode' => 200,
            'Success' => 'Successfully Data Fatched',
            'message' => 'Request has been processed',
            'meeting_data' => $meeting_data,
            'advisorData' => $advisorData,
            'adviseeData' => $adviseeData,
            'meeting_message' => $meeting_message,
            'time_intervals' => $time_intervals,
            'intervals_time_zone' => $intervals_time_zone,
            'advisor_time_zone' => $advisorTimeZone,
            'advisee_time_zone' => $adviseeTimeZone,
            'formatted_time_intervals' => $formated_time_intervals,
            'advisor_formatted_time_intervals' => $advisor_formatted_time_intervals,
            'advisee_formatted_time_intervals' => $advisee_formatted_time_intervals,
            'reschedule_warning' => $reschedule_warning,
        ]);

    }

}
