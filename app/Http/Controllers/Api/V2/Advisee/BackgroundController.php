<?php

namespace App\Http\Controllers\Api\V2\Advisee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Api\AddBackgroundStepRequest;
use App\Http\Traits\Helpers\ApiResponseTrait;
use App\Models\UserBackground;
use Carbon\Carbon;
use App\Http\Resources\UserBackgroundResource;

class BackgroundController extends Controller
{
    use ApiResponseTrait;

    public function getDataForBackground(Request $request)
    {
        $countries = DB::table('countries')->orderBy('name', 'ASC')->get();
        $timezones = DB::table('time_zones')->orderBy('name', 'ASC')->get();
        $states = DB::table('states')->orderBy('name', 'ASC')->get();
        $race_ethnicities = DB::table('race_ethnicities')->orderBy('name', 'ASC')->get();
        $usa_states=DB::table('states')->orderBy('name', 'ASC')->get();
        $background =UserBackground::where('UserID',$request->user()->id)->first();
        $genders = DB::table('gender_identity')->get();
        // $socio_economic_status = DB::table('socio_economic_status')->orderBy('socio_economic_status', 'ASC')->get();


        $identity = array(
            "0"=> "From a family whose parent(s) did not complete a four-year college degree (e.g. first generation college student)",
            "1" => "From a low-income family (e.g. Pell Grant or Work-Study eligible)", 
            "2" => "A member or former member of the U.S. Armed Forces",
            "3" => "LGBTQ+",
            "4" => "A person with a disablility or disablilites",
            "5" => "A person with undocumented status",
            "6" => "A person with a foster youth background",
            "7" => "A person who has been formerly incarcerated",
            "8" => "Prefer not to answer"
        );
       
        $data=[
            'countries' =>$countries,
            'timezones' =>$timezones,
            'states' => $states,
            'race_ethnicities' =>$race_ethnicities,
            'user_background' =>$background,
            'usa_states' =>$usa_states,
            'gender' => $genders,
            'identity' => $identity,
        ];
        $advisee=DB::table('advisees')->where('UserID',$request->user()->id);

        return $this->respondSuccessWithData($data,'Countries , Timezones ,Race Ethinicities Listing',200);
    }

    public function addUserBackground(AddBackgroundStepRequest $request)
    {
        $background =new UserBackground();
        $background->updateOrCreate(['UserID'=>$request->user()->id],[
            'country'=>$request->country,
            'city'=>$request->city,
            'state'=>$request->state,
            'time_zone'=>$request->time_zone,
            'gender'=>$request->gender,
            'race'=>json_encode($request->race),
            'extra_info'=>$request->extra_info ?? '',
            'belongs_to'=>json_encode($request->belongs_to),
        ]);

        $advisee=DB::table('advisees')->where('UserID',$request->user()->id)->update([
            'additional_background_info'=>$request->extra_info,
            'funnel_status'=>'Demographic Info Complete',
            'last_funnel_status_update_timestamp'=>Carbon::now(),
            'Signup_background_complete_timestamp'=>Carbon::now(),
        ]);
        $background=$background->where('UserID',$request->user()->id)->first();
        return $this->respondWithResource(new UserBackgroundResource($background),'User Background',200);
    }

    public function getUserBackground(Request $request)
    {
        $background =UserBackground::where('UserID',$request->user()->id)->first();
        if($background)
        {
            return $this->respondSuccessWithData(new UserBackgroundResource($background),'User Background',200);
        }

        return $this->respondNoContent('User Carrer Goals',200);
    }
}
