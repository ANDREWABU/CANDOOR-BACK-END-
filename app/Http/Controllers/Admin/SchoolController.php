<?php

namespace App\Http\Controllers\Admin;

use App\Models\School;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = School::all();
        return view('AdminPanel.pages.school.index', compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:250'
        ],[
            'name.required'=>'School Name is Required',
            'name.max'=>'School Name must be less than 250 characters'
        ]);
        
        //Slug Stored in Model
        School::Create([
            'name' => $request->name,
            'UserID' =>auth()->user()->id,
            ]);
        // session()->flash();
        return redirect()->back()->with('success','School Successfully inserted.')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        $school->action=route('schools.update',$school->id);
        return response()->json([
            'status' => 'success',
            'message' => 'School Successfully retrieved.',
            'data'  => $school
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
        
        $request->validate([
            'update_id'=>'required|exists:schools,id',
            'update_name'=>'required|max:250'
        ],[
            'update_name.required'=>'School Name is Required',
            'update_name.max'=>'School Name must be less than 250 characters',
            'update_id.required'=>'Something Went Worng',
            'update_id.exists'=>'Something Went Worng'
        ]);
        
        $school->update(['name'=>$request->update_name,'UserID' =>auth()->user()->id,]);
        return redirect()->back()->with('success','School Successfully updated.')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        $school->delete();
        return redirect()->back()->with('success','School Successfully deleted..')->withInput();
    }
}
