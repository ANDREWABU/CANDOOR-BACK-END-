<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\Helpers\ApiResponseTrait;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use GuzzleHttp\Client;

class BookingsReminderController extends Controller
{
    //
    use ApiResponseTrait;


    public function BookingsReminderFlowOutstandingRequest(Request $request){
            
            $meetings_needing_reminders = DB::select( DB::raw(
                "SELECT
                m.id,
                m.meetingtype,
                u1.firstname AS AdvisorFirstName,
                u1.lastname AS AdvisorLastName,
                u1.meeting_email AS AdvisorEmail,
                u2.firstname AS AdviseeFirstName,
                u2.lastname AS AdviseeLastName,
                u2.meeting_email AS AdviseeEmail,
                m.AdvisorID,
                m.AdviseeID
            FROM meetings m
            LEFT JOIN
                users u1 ON m.advisorid=u1.advisorid
            LEFT JOIN
                users u2 ON m.adviseeid=u2.adviseeid
            WHERE
                meeting_status IN ('Request Sent','Request Viewed')
                and date(request_sent_EST) IN (date_sub(current_date(),interval 2 day),date_sub(current_date(),interval 5 day),date_sub(current_date(),interval 7 day))
                "
            ));

            foreach($meetings_needing_reminders as $m){
                $meetingID = $m->id;
                $make_client = new Client();
                $make_client_result = $make_client->request('POST', 'https://hook.us1.make.com/17a5slamntueaj00i0oc5y11pj7vpct7', [
                    'form_params' => [
                        'advisor_first_name' => $m->AdvisorFirstName,
                        'advisor_last_name' =>  $m->AdvisorLastName,
                        'advisee_first_name' => $m->AdviseeFirstName,
                        'advisee_last_name' => $m->AdviseeLastName,
                        'advisor_meeting_email' => $m->AdvisorEmail,
                        'advisee_meeting_email' => $m->AdviseeEmail,
                        'subject' => '[Action Required] Outstanding Candoor Meeting Request with '.$m->AdviseeFirstName,
                        'meeting_type' => $m->meetingtype,
                        'meeting_id' => $m->id,
                        'adviseeID' => $m->AdviseeID,
                        'advisorID' => $m->AdvisorID,
                    ]
                ]);
            }

            return response()->json([
                'statusCode' => 200,
                'meetings' => $meetings_needing_reminders
            ]); 
    }

    public function BookingsReminderFlowAdvisorAction(Request $request){
            
        $meetings_needing_reminders = DB::select( DB::raw(
            "SELECT
            m.id,
            m.meetingtype,
            u1.firstname AS AdvisorFirstName,
            u1.lastname AS AdvisorLastName,
            u1.meeting_email AS AdvisorEmail,
            u2.firstname AS AdviseeFirstName,
            u2.lastname AS AdviseeLastName,
            u2.meeting_email AS AdviseeEmail,
            m.AdvisorID,
            m.AdviseeID
        FROM meetings m
        LEFT JOIN
            users u1 ON m.advisorid=u1.advisorid
        LEFT JOIN
            users u2 ON m.adviseeid=u2.adviseeid
        WHERE
            meeting_status IN ('Alternate Times Proposed','Rescheduling')
            and availability_last_provided_by IN ('Advisee')
            and date(last_status_update_EST) IN (date_sub(current_date(),interval 2 day),date_sub(current_date(),interval 5 day),date_sub(current_date(),interval 7 day))
            "
        ));

        foreach($meetings_needing_reminders as $m){
            $meetingID = $m->id;
            $make_client = new Client();
            $make_client_result = $make_client->request('POST', 'https://hook.us1.make.com/us1tcwpgdg92ef7ai7bwqej6mla6yojc', [
                'form_params' => [
                    'advisor_first_name' => $m->AdvisorFirstName,
                    'advisor_last_name' =>  $m->AdvisorLastName,
                    'advisee_first_name' => $m->AdviseeFirstName,
                    'advisee_last_name' => $m->AdviseeLastName,
                    'advisor_meeting_email' => $m->AdvisorEmail,
                    'advisee_meeting_email' => $m->AdviseeEmail,
                    'subject' => '[Action Required] Outstanding Meeting with '.$m->AdviseeFirstName,
                    'meeting_type' => $m->meetingtype,
                    'meeting_id' => $m->id,
                    'adviseeID' => $m->AdviseeID,
                    'advisorID' => $m->AdvisorID,
                ]
            ]);
        }


        return response()->json([
            'statusCode' => 200,
            'meetings' => $meetings_needing_reminders
        ]); 
    }

    public function BookingsReminderFlowAdviseeAction(Request $request){
            
        $meetings_needing_reminders = DB::select( DB::raw(
            "SELECT
            m.id,
            m.meetingtype,
            u1.firstname AS AdvisorFirstName,
            u1.lastname AS AdvisorLastName,
            u1.meeting_email AS AdvisorEmail,
            u2.firstname AS AdviseeFirstName,
            u2.lastname AS AdviseeLastName,
            u2.meeting_email AS AdviseeEmail,
            m.AdvisorID,
            m.AdviseeID
        FROM meetings m
        LEFT JOIN
            users u1 ON m.advisorid=u1.advisorid
        LEFT JOIN
            users u2 ON m.adviseeid=u2.adviseeid
        WHERE
            meeting_status IN ('Alternate Times Proposed','Rescheduling')
            and availability_last_provided_by IN ('Advisor')
            and date(last_status_update_EST) IN (date_sub(current_date(),interval 2 day),date_sub(current_date(),interval 5 day),date_sub(current_date(),interval 7 day))
            "
        ));

        foreach($meetings_needing_reminders as $m){
            $meetingID = $m->id;
            $make_client = new Client();
            $make_client_result = $make_client->request('POST', 'https://hook.us1.make.com/3oviiu57gn71xa1p6bj6xdvi6at2sa1x', [
                'form_params' => [
                    'advisor_first_name' => $m->AdvisorFirstName,
                    'advisor_last_name' =>  $m->AdvisorLastName,
                    'advisee_first_name' => $m->AdviseeFirstName,
                    'advisee_last_name' => $m->AdviseeLastName,
                    'advisor_meeting_email' => $m->AdvisorEmail,
                    'advisee_meeting_email' => $m->AdviseeEmail,
                    'subject' => '[Action Required] Outstanding Meeting with '.$m->AdvisorFirstName,
                    'meeting_type' => $m->meetingtype,
                    'meeting_id' => $m->id,
                    'adviseeID' => $m->AdviseeID,
                    'advisorID' => $m->AdvisorID,
                ]
            ]);
        }


        return response()->json([
            'statusCode' => 200,
            'meetings' => $meetings_needing_reminders
        ]); 
    }

    public function FinalBookingsReminderFlowOutstandingRequest(Request $request){
            
        $meetings_needing_reminders = DB::select( DB::raw(
            "SELECT
            m.id,
            m.meetingtype,
            u1.firstname AS AdvisorFirstName,
            u1.lastname AS AdvisorLastName,
            u1.meeting_email AS AdvisorEmail,
            u2.firstname AS AdviseeFirstName,
            u2.lastname AS AdviseeLastName,
            u2.meeting_email AS AdviseeEmail,
            m.AdvisorID,
            m.AdviseeID
        FROM meetings m
        LEFT JOIN
            users u1 ON m.advisorid=u1.advisorid
        LEFT JOIN
            users u2 ON m.adviseeid=u2.adviseeid
        WHERE
            meeting_status IN ('Request Sent','Request Viewed')
            and date(request_sent_EST) IN (date_sub(current_date(),interval 10 day))
            "
        ));

        foreach($meetings_needing_reminders as $m){
            $meetingID = $m->id;
            $make_client = new Client();
            $make_client_result = $make_client->request('POST', 'https://hook.us1.make.com/wwfou71ddm6envsejpzhyzxvh5jo7zsh', [
                'form_params' => [
                    'advisor_first_name' => $m->AdvisorFirstName,
                    'advisor_last_name' =>  $m->AdvisorLastName,
                    'advisee_first_name' => $m->AdviseeFirstName,
                    'advisee_last_name' => $m->AdviseeLastName,
                    'advisor_meeting_email' => $m->AdvisorEmail,
                    'advisee_meeting_email' => $m->AdviseeEmail,
                    'subject' => '[Action Required] Outstanding Candoor Meeting Request with '.$m->AdviseeFirstName,
                    'meeting_type' => $m->meetingtype,
                    'meeting_id' => $m->id,
                    'adviseeID' => $m->AdviseeID,
                    'advisorID' => $m->AdvisorID,
                ]
            ]);
        }

        return response()->json([
            'statusCode' => 200,
            'meetings' => $meetings_needing_reminders
        ]); 
    }

    public function FinalBookingsReminderFlowAdvisorAction(Request $request){
            
        $meetings_needing_reminders = DB::select( DB::raw(
            "SELECT
            m.id,
            m.meetingtype,
            u1.firstname AS AdvisorFirstName,
            u1.lastname AS AdvisorLastName,
            u1.meeting_email AS AdvisorEmail,
            u2.firstname AS AdviseeFirstName,
            u2.lastname AS AdviseeLastName,
            u2.meeting_email AS AdviseeEmail,
            m.AdvisorID,
            m.AdviseeID
        FROM meetings m
        LEFT JOIN
            users u1 ON m.advisorid=u1.advisorid
        LEFT JOIN
            users u2 ON m.adviseeid=u2.adviseeid
        WHERE
            meeting_status IN ('Alternate Times Proposed','Rescheduling')
            and availability_last_provided_by IN ('Advisee')
            and date(last_status_update_EST) IN (date_sub(current_date(),interval 10 day))
            "
        ));

        foreach($meetings_needing_reminders as $m){
            $meetingID = $m->id;
            $make_client = new Client();
            $make_client_result = $make_client->request('POST', 'https://hook.us1.make.com/wv57ictdxl3x52x1tnvtmgxrtq80udc9', [
                'form_params' => [
                    'advisor_first_name' => $m->AdvisorFirstName,
                    'advisor_last_name' =>  $m->AdvisorLastName,
                    'advisee_first_name' => $m->AdviseeFirstName,
                    'advisee_last_name' => $m->AdviseeLastName,
                    'advisor_meeting_email' => $m->AdvisorEmail,
                    'advisee_meeting_email' => $m->AdviseeEmail,
                    'subject' => '[Action Required] Outstanding Meeting with '.$m->AdviseeFirstName,
                    'meeting_type' => $m->meetingtype,
                    'meeting_id' => $m->id,
                    'adviseeID' => $m->AdviseeID,
                    'advisorID' => $m->AdvisorID,
                ]
            ]);
        }

        return response()->json([
            'statusCode' => 200,
            'meetings' => $meetings_needing_reminders
        ]); 
    }


    public function FinalBookingsReminderFlowAdviseeAction(Request $request){
            
        $meetings_needing_reminders = DB::select( DB::raw(
            "SELECT
            m.id,
            m.meetingtype,
            u1.firstname AS AdvisorFirstName,
            u1.lastname AS AdvisorLastName,
            u1.meeting_email AS AdvisorEmail,
            u2.firstname AS AdviseeFirstName,
            u2.lastname AS AdviseeLastName,
            u2.meeting_email AS AdviseeEmail,
            m.AdvisorID,
            m.AdviseeID
        FROM meetings m
        LEFT JOIN
            users u1 ON m.advisorid=u1.advisorid
        LEFT JOIN
            users u2 ON m.adviseeid=u2.adviseeid
        WHERE
            meeting_status IN ('Alternate Times Proposed','Rescheduling')
            and availability_last_provided_by IN ('Advisor')
            and date(last_status_update_EST) IN (date_sub(current_date(),interval 10 day))
            "
        ));

        foreach($meetings_needing_reminders as $m){
            $meetingID = $m->id;
            $make_client = new Client();
            $make_client_result = $make_client->request('POST', 'https://hook.us1.make.com/af3qq8fx0xzqo3h79b3b71r9m4yevldq', [
                'form_params' => [
                    'advisor_first_name' => $m->AdvisorFirstName,
                    'advisor_last_name' =>  $m->AdvisorLastName,
                    'advisee_first_name' => $m->AdviseeFirstName,
                    'advisee_last_name' => $m->AdviseeLastName,
                    'advisor_meeting_email' => $m->AdvisorEmail,
                    'advisee_meeting_email' => $m->AdviseeEmail,
                    'subject' => '[Action Required] Outstanding Meeting with '.$m->AdvisorFirstName,
                    'meeting_type' => $m->meetingtype,
                    'meeting_id' => $m->id,
                    'adviseeID' => $m->AdviseeID,
                    'advisorID' => $m->AdvisorID,
                ]
            ]);
        }


        return response()->json([
            'statusCode' => 200,
            'meetings' => $meetings_needing_reminders
        ]); 
    }

    public function BookingsReminderExpired(Request $request){
        $meetings_needing_reminders = DB::select( DB::raw(
            "SELECT
            m.id,
            m.meetingtype,
            m.meeting_status,
            m.availability_last_provided_by,
            m.AdvisorID,
            m.AdviseeID,
            u1.firstname AS AdvisorFirstName,
            u1.lastname AS AdvisorLastName,
            u1.meeting_email AS AdvisorEmail,
            u2.firstname AS AdviseeFirstName,
            u2.lastname AS AdviseeLastName,
            u2.meeting_email AS AdviseeEmail
        FROM meetings m
        LEFT JOIN
            users u1 ON m.advisorid=u1.advisorid
        LEFT JOIN
            users u2 ON m.adviseeid=u2.adviseeid
        WHERE
            (meeting_status IN ('Request Sent','Request Viewed')
            and date(request_sent_EST) IN (date_sub(current_date(),interval 12 day)))
            or
            (meeting_status IN ('Alternate Times Proposed','Rescheduling')
            and date(last_status_update_EST) IN (date_sub(current_date(),interval 12 day)))
            "
        ));


        foreach($meetings_needing_reminders as $m){
            $meetingID = $m->id;
            //Change the meeting status to expired
            DB::table('meetings')->where('id', $meetingID)->update([
                'meeting_status' => 'Expired',
                'last_status_update_EST' => Carbon::parse(now(),'EST')->setTimeZone('EST'),
            ]);
            
            if ($m->availability_last_provided_by == 'Advisee'){
                //Get advisee meetings left 
                $advisee_meetings_left = DB::table('advisees')->where('AdviseeID' ,$m->AdviseeID)->select('monthly_requests_remaining')->first();
                $meetings_left = $advisee_meetings_left->monthly_requests_remaining;
                
                //Update advisee meetings left by one
                DB::table('advisees')->where('AdviseeID' ,$m->AdviseeID)->update([
                    'monthly_requests_remaining' => $meetings_left + 1,
                ]);
                
            }

            $make_client = new Client();
            $make_client_result = $make_client->request('POST', 'https://hook.us1.make.com/hujkn7uj1z5otl869qhvvw6bsn1yi5hj', [
                'form_params' => [
                    'advisor_first_name' => $m->AdvisorFirstName,
                    'advisor_last_name' =>  $m->AdvisorLastName,
                    'advisee_first_name' => $m->AdviseeFirstName,
                    'advisee_last_name' => $m->AdviseeLastName,
                    'advisor_meeting_email' => $m->AdvisorEmail,
                    'advisee_meeting_email' => $m->AdviseeEmail,
                    'availability_last_provided_by' => $m->availability_last_provided_by,
                    'subject' => '[Action Required] Expired meeting: '.$m->id,
                    'meeting_type' => $m->meetingtype,
                    'meeting_id' => $m->id,
                    'adviseeID' => $m->AdviseeID,
                    'advisorID' => $m->AdvisorID,
                ]
            ]);
        }

        return response()->json([
            'statusCode' => 200,
            'meetings' => $meetings_needing_reminders
        ]); 
    }
}
