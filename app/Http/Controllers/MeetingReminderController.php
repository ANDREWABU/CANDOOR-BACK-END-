<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\Helpers\ApiResponseTrait;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use GuzzleHttp\Client;



class MeetingReminderController extends Controller
{
    //
    use ApiResponseTrait;

    public function MeetingReminderFlow(Request $request){

        //Get all meetings that are happening today
        $meetings_happening_today = DB::select( DB::raw(
            "SELECT 
            m.id,
            m.adviseeid,
            m.advisorid,
            m.meetingtype,
            m.starttime,
            m.confirmed_timezone,
            u1.firstname AS AdvisorFirstName,
            u1.lastname AS AdvisorLastName,
            u2.firstname AS AdviseeFirstName,
            u2.lastname AS AdviseeLastName,
            u1.meeting_email AS AdvisorEmail,
            u2.meeting_email AS AdviseeEmail
        FROM meetings m
        LEFT JOIN
            users u1 ON m.advisorid=u1.advisorid
        LEFT JOIN
            users u2 ON m.adviseeid=u2.adviseeid
        WHERE 
            meeting_status IN ('Confirmed')
            AND date(starttime)=current_date()"
        ));


        foreach($meetings_happening_today as $m){
            $meetingID = $m->id;

            $meetingdate = Carbon::createFromFormat('Y-m-d H:i:s', $m->starttime);

            //Change the meeting status to completed
            // DB::table('meetings')->where('id', $meetingID)->update([
            //     'meeting_status' => 'Completed',
            //     'last_status_update_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
            // ]);

            //Send out  post interaction feedback to advisee

            $advisee_client = new Client();
            $advisee_client_result = $advisee_client->request('POST', 'https://hook.us1.make.com/4g95gxecr11ely5rbe5u874h2w581wfa', [
                'form_params' => [
                    'advisee_meeting_email' => $m->AdviseeEmail,
                    'subject' => '[Candoor] Upcoming Meeting Reminder',
                    'advisee_first_name' => $m->AdviseeFirstName,
                    'advisee_last_name' => $m->AdviseeLastName,
                    'advisor_first_name' => $m->AdvisorFirstName,
                    'advisor_last_name' =>  $m->AdvisorLastName,
                    'meeting_type' => $m->meetingtype,
                    'meeting_time' => $meetingdate->format('h:iA'),
                    'meeting_timezone' => $m->confirmed_timezone,
                    'meeting_id' => $m->id,
                    'adviseeID' => $m->adviseeid,
                    'advisorID' => $m->advisorid,
                ]
            ]);


            // if($advisee_client_result->getStatusCode() == 200){
            //     DB::table('meetings')->where('id', $meetingID)->update([
            //         'AdviseeFeedbackSent' => 1,
            //         'last_status_update_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
            //     ]);
            // }
    
            // Send out post interaction feedback to Advisor
            $advisor_client = new Client();
            $advisor_client_result = $advisor_client->request('POST', 'https://hook.us1.make.com/m7whqq72fd33ujlcfcph2rriydw6wpm1', [
                'form_params' => [
                    'advisor_meeting_email' => $m->AdvisorEmail,
                    'subject' => '[Candoor] Upcoming Meeting Reminder',
                    'advisee_first_name' => $m->AdviseeFirstName,
                    'advisee_last_name' => $m->AdviseeLastName,
                    'advisor_first_name' => $m->AdvisorFirstName,
                    'advisor_last_name' =>  $m->AdvisorLastName,
                    'meeting_type' => $m->meetingtype,
                    'meeting_time' => $meetingdate->format('h:iA'),
                    'meeting_timezone' => $m->confirmed_timezone,
                    'meeting_id' => $m->id,
                    'adviseeID' => $m->adviseeid,
                    'advisorID' => $m->advisorid,
                ]
            ]);

            // if($advisor_client_result->getStatusCode() == 200){
            //     DB::table('meetings')->where('id', $meetingID)->update([
            //         'AdvisorFeedbackSent' => 1,
            //         'last_status_update_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
            //     ]);
            // }



        }


        return response()->json([
            'statusCode' => 200,
            'meetings' => $meetings_happening_today
        ]);



    }
}
