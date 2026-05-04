<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HiringRole;
use Illuminate\Http\Request;
use Helpers;

class HiringRoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $hiringRoles = HiringRole::orderBy('id','DESC')->get();
        return view('AdminPanel.pages.setting.hiring-role', compact('hiringRoles'))->with('success', 'Data successfully inserted');
    }
    public function show($id)
    {
        $data = HiringRole::find($id);
        return Helpers::sendResponseBack($data,'hiringRoles', 'Hiring Roles successfully created', 'Something Went wrong please try again');

    }


    public function store(Request $request)
    {
        // dd($request->all());

        $validate = $request->validate([
            'role_name' => 'required|unique:hiring_roles,role_name,except,id',
        ]);
        $data = HiringRole::create($validate);
        return Helpers::sendResponseBack($data,'hiringRoles', 'Hiring Roles successfully created', 'Something Went wrong please try again');
    }
    public function update($id,Request $request)
    {
        $validate = $request->validate([
            'role_name' => 'required|unique:hiring_roles,role_name,except,id',
        ]);
        $data = HiringRole::find($id)->update(['role_name' => $request->role_name]);
        return Helpers::sendResponseBack($data,'hiringRoles', 'Hiring Roles successfully update', 'Something Went wrong please try again');
    }

    public function destroy($id)
    {
        $data = HiringRole::destroy($id);
        if($data){
            return response()->json([
                'status' => 200,
                'success' => "Hiring role successfully deleted"
            ]);
        }else{
            return response()->json([
                'status' => "error",
                'success' => "Something went wrong please try again!"
            ],401);
        }
    }
}
