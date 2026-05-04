<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Experience;
use App\Models\Countries;
use App\Models\Cities;
use App\Models\State;
use App\Models\Day;
use App\Models\CareerSpace;
use Spatie\Permission\Models\Role;
use App\Models\HiringRole;
use App\Models\Language;
use App\Models\User;
use App\Models\HiringBudget;
use App\Http\Traits\Helpers\ApiResponseTrait;
use App\Models\TimeZone;
use Helpers;
use Illuminate\Support\Facades\DB;

class ApiGenericController extends Controller
{
    use ApiResponseTrait;
    //
    public function getExperience()
    {
        $experience = Experience::all();
        return Helpers::sendResponseBack($experience,'experience', 'Experience details successfully retrieved', 'Something Went wrong please try again');
    }
    public function getRoles()
    {
        $role = Role::where('id','!=',1)->get();
        return Helpers::sendResponseBack($role,'roles', 'Role details successfully retrieved', 'Something Went wrong please try again');
    }

    public function getCountries()
    {
        $country = Countries::all();
        return $this->respondSuccessWithData($country,'Countries successfully retrieved',200);
        // return Helpers::sendResponseBack($country,'countries', 'Countries successfully retrieved', 'Something Went wrong please try again');
    }

    

    

    public function getStatesByCountryId($country_id)
    {
        $states = State::where('country_id',$country_id)->get();
        return $this->respondSuccessWithData($states,'Country States successfully retrieved',200);
        // return Helpers::sendResponseBack($states,'States', 'States successfully retrieved', 'Something Went wrong please try again');
    }

    public function getCitiesByCountryId($country_id)
    {
        $cities = Cities::where('country_id',$country_id)->get();
        return $this->respondSuccessWithData($cities,'Country Cities successfully retrieved',200);
        // return Helpers::sendResponseBack($cities,'cities', 'Country Cities successfully retrieved', 'Something Went wrong please try again');
    }

    public function getAdvertisementChannel()
    {
        $channels = DB::table('advertisement_channels')->get();
        return $this->respondSuccessWithData($channels,'Advertisement Channels successfully retrieved',200);
    }


    public function getSpacesList()
    {
        $spaces = CareerSpace::all();
        return Helpers::sendResponseBack($spaces,'spaces', 'Career Spaces successfully retrieved', 'No Data Found');
    }

    public function getDays()
    {
        $days = Day::all();
        return Helpers::sendResponseBack($days,'days', 'Days successfully retrieved', 'No Data Found');
    }

    public function getHiringRoles()
    {
        $data = HiringRole::orderBy('id','DESC')->get();
        return Helpers::sendResponseBack($data,'hiringRoles', 'Hiring Roles successfully retrieved', 'Something Went wrong please try again');
    }

    public function getHiringBudget()
    {
        $data = HiringBudget::orderBy('id','DESC')->get();
        return Helpers::sendResponseBack($data,'hiringBudget', 'Hiring Budget successfully retrieved', 'Something Went wrong please try again');
    }

    public function getLanguages()
    {
        $data = Language::orderBy('id','DESC')->get();
        return Helpers::sendResponseBack($data,'languages', 'Languages successfully retrieved', 'Something Went wrong please try again');
    }

    public function profileStatusUpdate()
    {
        $user = User::where('id',Auth('api')->id())->update(['profile_filled' => 1 ]);
        return Helpers::sendResponseBack($user,'user', 'User profile status successfully updated', 'Something Went wrong please try again');
    }
}
