<?php

namespace App\Http\Controllers\Admin;

use App\Models\FieldOfStudy;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FieldOfStudyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $field_of_studies = FieldOfStudy::all();
        return view('AdminPanel.pages.fields-of-study.index', compact('field_of_studies'));
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
            'name.required'=>'Field of Study Name is Required',
            'name.max'=>'Field Of Study Name must be less than 250 characters'
        ]);
        
        //Slug Stored in Model
        FieldOfStudy::Create([
            'name' => $request->name,
            'UserID' =>auth()->user()->id,
            ]);
        // session()->flash();
        return redirect()->back()->with('success','Field Of Study Successfully inserted.')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FieldOfStudy  $fieldOfStudy
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fieldOfStudy=FieldOfStudy::findorfail($id);
        $fieldOfStudy->action=route('fieldsOFStudy.update',$fieldOfStudy->id);
        return response()->json([
            'status' => 'success',
            'message' => 'Degree Successfully retrieved.',
            'data'  => $fieldOfStudy
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FieldOfStudy  $fieldOfStudy
     * @return \Illuminate\Http\Response
     */
    public function edit(FieldOfStudy $fieldOfStudy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FieldOfStudy  $fieldOfStudy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'update_id'=>'required|exists:field_of_studies,id',
            'update_name'=>'required|max:250'
        ],[
            'update_name.required'=>'Degree Name is Required',
            'update_name.max'=>'Degree Name must be less than 250 characters',
            'update_id.required'=>'Something Went Worng',
            'update_id.exists'=>'Something Went Worng'
        ]);
        
        $fieldOfStudy=FieldOfStudy::findorfail($id);
        $fieldOfStudy->update(['name'=>$request->update_name,'UserID' =>auth()->user()->id,]);
        return redirect()->back()->with('success','Field Of Study Successfully updated.')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FieldOfStudy  $fieldOfStudy
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FieldOfStudy::findorfail($id)->delete();
        return redirect()->back()->with('success','Field Of StudySuccessfully deleted..')->withInput();
    }
}
