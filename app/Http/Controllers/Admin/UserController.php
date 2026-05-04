<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Auth;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $user=User::with('roles')->orderBy('id','DESC')->get();
        $roles = Role::all();
        return view('AdminPanel.pages.user', compact('user','roles'));
    }
    public function userEdit($id){

        $user=User::where('id',$id)->with('roles')->get();
        return response()->json($user);

    }

    public function updateUser(Request $request, User $user){
        $data = Validator::make($request->all(),[
            'first_name' => 'required',
            'last_name' => 'required',
            'user_role_id' => 'required|in:1,2,3,4',
            'status' => 'required'
        ])->validate();
        // if(Auth::user()->hasRole('Super Admin')){
        //     unset($data['status']);
        // }
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'status' => $request->status
        ];
        $roleName = Role::where('id',$request->user_role_id)->value('name');
        // dd($roleName);
        $user->syncRoles($request->user_role_id);
        $user->update($data);
        session()->flash('update','Updated...');
        return back();
    }

    public function updateUserStatus(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'userId' => 'required'
        ]);
        User::where('id',$request->userId)->update(['status' => $request->status]);
        session()->flash('success','User Status Successfully updated');
        return response()->json([
            'status' => 'success',
            "message" => "successfully update"
        ]);
    }
}
