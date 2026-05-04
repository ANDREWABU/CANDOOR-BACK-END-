<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use Helpers;

class LanguageController extends Controller
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
        $languages = Language::orderBy('id','DESC')->get();
        return view('AdminPanel.pages.setting.languages', compact('languages'))->with('success', 'Data successfully inserted');
    }
    public function show($id)
    {
        $data = Language::find($id);
        return Helpers::sendResponseBack($data,'language', 'Hiring Roles successfully created', 'Something Went wrong please try again');
    }


    public function store(Request $request)
    {
        // dd($request->all());

        $validate = $request->validate([
            'lang_name' => 'required|unique:languages,lang_name,except,id',
        ]);
        $data = Language::create($validate);
        return Helpers::sendResponseBack($data,'hiringRoles', 'Hiring Roles successfully created', 'Something Went wrong please try again');
    }
    public function update($id,Request $request)
    {
        $validate = $request->validate([
            'lang_name' => 'required|unique:languages,lang_name,except,id',
        ]);
        $data = Language::find($id)->update(['lang_name' => $request->lang_name]);
        return Helpers::sendResponseBack($data,'hiringRoles', 'Hiring Roles successfully update', 'Something Went wrong please try again');
    }

    public function destroy($id)
    {
        $data = Language::destroy($id);
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
