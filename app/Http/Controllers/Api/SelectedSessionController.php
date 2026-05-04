<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\AppliedJob;
use App\Models\Api\MentorAvailability;
use App\Models\Api\MentorExpertise;
use App\Models\Api\SelectedSessions;
use App\Models\Day;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Helpers;
use Illuminate\Support\Carbon;

class SelectedSessionController extends Controller
{

    public function slots(Request $request){

        $date = Carbon::now();
        $currentDay = $date->toArray();
        $currentDate = date(('Y-m-d H:i:s'),strtotime($currentDay['formatted']));
        $currentDateSlots = date(('Y-m-d'),strtotime($currentDay['formatted']));

    //        $allDayAvailabilities = MentorAvailability::
    //            where('mentor_id', $request->id)
    //            ->where('available_date' ,'>=',$currentDateSlots)
    //            ->orderBy('available_date', 'DESC')
    //            ->with(['day'=> function($q) use($currentDay){$q->where('status',1);}])
    //            ->with('zone')
    //            ->get();
    //
    //        $allDaysSlots = [];
    //
    //        foreach ($allDayAvailabilities as $timeSlots)
    //        {
    //            $allTemp = $this->getTimeSlot(60,date('H:i',strtotime( $timeSlots->start_time)),
    //                date('H:i',strtotime( $timeSlots->end_time)),$timeSlots->available_date);
    //            $allDaysSlots = array_merge($allTemp,$allDaysSlots);
    //        }

        $currentDayAvailabilities = MentorAvailability::
        where('mentor_id', $request->id)
            ->where('day_id',$request->dayId)
            ->with(['day' => function($q) use($currentDay){$q->where('status',1);}])
            ->with('zone')
            ->get();


        $booked_session = SelectedSessions::
        where('mentor_id', $request->id)
            ->get();

        $mentorSessionsDuration = MentorExpertise::where('mentor_id', $request->id)->with(['expertise_details'=>function($q){
            $q->where('session_type','Hourly');
        }])->first();

        $duration_hour = 0;

        foreach ($mentorSessionsDuration->expertise_details as $se){
            $duration_hour = $se->session_duration;
        }
        $duration = $duration_hour * 60;

        $currentDaySlots = [];

        foreach ($currentDayAvailabilities as $currentAvailability) {

            $temp = $this->getTimeSlot($duration,
                date('H:i',strtotime( $currentAvailability->start_time)),
                date('H:i',strtotime( $currentAvailability->end_time)));
            $currentDaySlots  = array_merge($temp,$currentDaySlots);

        }

        foreach ($booked_session as $bookedTimeSlot){
            foreach ($currentDaySlots as $key => $val){
               if ( $bookedTimeSlot->start_time >=  $val['slot_start_time']
                    && $bookedTimeSlot->start_time <= $val['slot_end_time']
                    || $bookedTimeSlot->end_time < $val['slot_start_time']
                    && $bookedTimeSlot->end_time > $val['slot_end_time'])
               {
                    unset($currentDaySlots[$key]);
               }
            }
        }

        return Helpers::sendResponseBack([$currentDaySlots], 'AvailableSlots' , 'Slots Fetch', 'Something Went wrong please try again');



    }


    function getTimeSlot($interval, $start_time, $end_time)
    {
        $start = new DateTime($start_time);
        $end = new DateTime($end_time);
        $startTime = $start->format('H:i');
        $endTime = $end->format('H:i');
        $i=0;
        $time = [];
        while(strtotime($startTime) <= strtotime($endTime)){
            $start = $startTime;
            $end = date('H:i ',strtotime('+'.$interval.' minutes',strtotime($startTime)));
            $startTime = date('H:i ',strtotime('+'.$interval.' minutes',strtotime($startTime)));
            $i++;
            if(strtotime($startTime) <= strtotime($endTime)){
                $time[$i]['slot_start_time'] = date('H:i ', strtotime($start));
                $time[$i]['slot_end_time'] =  date('H:i ',strtotime($end));
            }
        }

        return $time;
    }



   public function store(Request $request){

       $date = Carbon::now();
       $currentDay = $date->toArray();
       $currentDateSlots = date(('Y-m-d'),strtotime($currentDay['formatted']));
       $validate = $request->validate([
          'session_id'=>'required',
       ]);
       $StoredSession = SelectedSessions::create(
           [
               'mentee_id' => auth('api')->id(),
               'mentor_id' => $request->mentor_id,
               'start_time' => $request->start_time,
               'end_time' => $request->end_time,
               'booked_date' => $request->booked_date,
               'status' => 1,
               'session_id' => $request->session_id,
               'type' => 'Hourly'
           ]);
       return Helpers::sendResponseBack($StoredSession, 'Selected', 'Session successfully selected', 'Something Went wrong please try again');
   }

   public function storeMonthlySession(Request $request){

       $date = Carbon::now();
       $currentDay = $date->toArray();
       $currentDateSlots = date(('Y-m-d'),strtotime($currentDay['formatted']));
       $validate = $request->validate([
           'session_id'=>'required',
       ]);
       $StoredSession = SelectedSessions::updateOrCreate(
           [
               'session_id' => $request->session_id,
               'mentor_id' => $request->mentor_id,
           ],
           [
               'mentee_id' => auth('api')->id(),
               'mentor_id' => $request->mentor_id,
               'booked_date' => $request->booked_date,
               'status' => 1,
               'session_id' => $request->session_id,
               'type' => 'Monthly'
           ]);
       return Helpers::sendResponseBack($StoredSession, 'Selected', 'Session successfully selected', 'Something Went wrong please try again');

   }


   public function mentorUpcomingSessions(Request $request){

       $date = Carbon::now();
       $currentDay = $date->toArray();
       $currentDateSlots = date(('Y-m-d'),strtotime($currentDay['formatted']));

       $mentor_upcoming_session = SelectedSessions::
       where('booked_date','>=',$currentDateSlots)
           ->where('mentee_id',auth('api')->id())
           ->with('expertise_details_session')
           ->with(['user' => function($q){
           $q->whereHas('roles', function ($q) {
               $q->where('name','Mentor');
           })->mentorInformation()
               ->with(['zone','careerSpaces','mentorExpertise.expertise_details','mentorAvailability']);
       }])->get();

       return Helpers::sendResponseBack($mentor_upcoming_session, 'Mentors', 'Mentors successfully fetched', 'Something Went wrong please try again');

   }

   public function mentorBookedSessions(Request $request){

        $mentorBookedSessions = User::whereHas('roles',function($q){
            $q->where('name', 'Mentor');
        })->whereHas('selectedSessions',function($q){
            $q->where('mentee_id',auth('api')->id());
        })->mentorInformation()
            ->with(['zone','careerSpaces','mentorExpertise.expertise_details','selectedSessions.expertise_details_session','mentorAvailability'])->get();

       return Helpers::sendResponseBack($mentorBookedSessions, 'BookedMentors', 'Mentors successfully fetched', 'Something Went wrong please try again');

   }



}
