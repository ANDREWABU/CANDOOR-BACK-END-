<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use App\Models\Api\Experience;



class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $experience=Experience::all();
        $user_role=Role::all();
        return view ('AdminPanel.pages.settings', compact('experience','user_role'));
    }

    public function experienceedit(Experience $experience)
    {

        return response()->json($experience);

    }

    public function userRoleEdit(Role $userRole)
    {

        return response()->json($userRole);

    }

    public function userRoleUpdate(Request $request, Role $userRole)
    {
        $data = Validator::make($request->all(),[
            'name' => 'required',
        ])->validate();
        $userRole->update($data);
        session()->flash('update','Updated...');
        return back();

    }

    public function experienceUpdate(Request $request, Experience $experience)
    {

        $data=Validator::make($request->all(),[
            'title'=> 'required'
        ])->validate();
        $experience->update($data);
        session()->flash('update','Updated...');
        return back();

    }
}
