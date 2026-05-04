<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Api\ApiUserRepo;
use Spatie\Permission\Models\Role;
use App\Models\Api\UserExperience;
use App\Models\User;
use App\Models\ModelHasRole;
use Helpers;

class ApiUserController extends Controller
{
    protected $repo;
    public function __construct(ApiUserRepo $repo)
    {
        $this->repo = $repo;
    }

    public function userAssignRole(Request $request)
    {
        $request->validate([
            'user_role_id' => 'required',
            'experience' => 'required',
        ]);
        $user_id = Auth('api')->id();
        $user = Auth('api')->user();
        UserExperience::updateOrCreate([
            'user_id' => $user_id],[
            'experience_id' => $request->experience,
            ]);
        ModelHasRole::where('model_id',$user_id)->delete();
        ModelHasRole::insert([
            'model_id' => $user_id,
            'model_type' => 'App\Models\User',
            'role_id' =>  $request->user_role_id
            ]);
        $user = User::where('id',$user_id)->with('roles')->with('experience')->get();

        return Helpers::sendResponseBack($user,'user', 'User Role Successfully created', 'Something Went wrong please try again');
    }
}
