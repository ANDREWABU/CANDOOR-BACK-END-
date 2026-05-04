<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\Helpers\ApiResponseTrait;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use GuzzleHttp\Client;



class MeetingCompletionController extends Controller
{
    //
    use ApiResponseTrait;

    public function MeetingCompletedFlow(Request $request){

        $meetings_completed_yesterday = DB::select( DB::raw(
            "SELECT 
            u.firstname AS AdviseeFirstName,
            u.lastname AS AdviseeLastName,
            u.meeting_email AS AdviseeEmail,
            u2.firstname AS AdvisorFirstName,
            u2.lastname AS AdvisorLastName,
            u2.meeting_email AS AdvisorEmail,
            m.meetingtype AS meetingtype,
            m.id AS meetingID
        FROM meetings m
        LEFT JOIN
            users u ON m.adviseeid=u.adviseeid
        LEFT JOIN
            users u2 ON m.advisorid=u2.advisorid
        WHERE 
            meeting_status IN ('Confirmed')
            AND date(endtime)=date(DATE_SUB(CURRENT_TIMESTAMP(),INTERVAL 1 DAY))"
        ));


        foreach($meetings_completed_yesterday as $m){
            $meetingID = $m->meetingID;

            //Change the meeting status to completed
            DB::table('meetings')->where('id', $meetingID)->update([
                'meeting_status' => 'Completed',
                'last_status_update_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
            ]);

            //Send out  post interaction feedback to advisee

            $advisee_client = new Client();
            $advisee_client_result = $advisee_client->request('POST', 'https://hook.us1.make.com/2v7ja4azishmwtjehgmvf693654o8nop', [
                'form_params' => [
                    'advisee_meeting_email' => $m->AdviseeEmail,
                    'subject' => '[Candoor] Feedback Request: ' .$m->meetingtype.' with  '.$m->AdvisorFirstName,
                    'advisee_first_name' => $m->AdviseeFirstName,
                    'advisee_last_name' => $m->AdviseeLastName,
                    'advisor_first_name' => $m->AdvisorFirstName,
                    'advisor_last_name' =>  $m->AdvisorLastName,
                    'meeting_type' => $m->meetingtype
                ]
            ]);


            if($advisee_client_result->getStatusCode() == 200){
                DB::table('meetings')->where('id', $meetingID)->update([
                    'AdviseeFeedbackSent' => 1,
                    'last_status_update_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                ]);
            }
    
            //Send out post interaction feedback to Advisor
            $advisor_client = new Client();
            $advisor_client_result = $advisor_client->request('POST', 'https://hook.us1.make.com/hmtaboo93rkdn9aan0bkcy4hmdt4eidp', [
                'form_params' => [
                    'advisor_meeting_email' => $m->AdvisorEmail,
                    'subject' => '[Candoor] Feedback Request: ' .$m->meetingtype.' with  '.$m->AdviseeFirstName,
                    'advisee_first_name' => $m->AdviseeFirstName,
                    'advisee_last_name' => $m->AdviseeLastName,
                    'advisor_first_name' => $m->AdvisorFirstName,
                    'advisor_last_name' =>  $m->AdvisorLastName,
                    'meeting_type' => $m->meetingtype
                ]
            ]);

            if($advisor_client_result->getStatusCode() == 200){
                DB::table('meetings')->where('id', $meetingID)->update([
                    'AdvisorFeedbackSent' => 1,
                    'last_status_update_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
                ]);
            }



        }


        return response()->json([
            'statusCode' => 200,
            'meetings' => $meetings_completed_yesterday
        ]);



    }
}
