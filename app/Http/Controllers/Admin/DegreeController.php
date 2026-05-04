<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Degree;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DegreeController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $degrees = Degree::all();
        return view('AdminPanel.pages.degree.index', compact('degrees'));
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
            'name.required'=>'Degree Name is Required',
            'name.max'=>'Degree Name must be less than 250 characters'
        ]);
        
        //Slug Stored in Model
        Degree::Create([
            'name' => $request->name,
            'UserID' =>auth()->user()->id,
            ]);
        // session()->flash();
        return redirect()->back()->with('success','Degree Successfully inserted.')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Degree  $degree
     * @return \Illuminate\Http\Response
     */
    public function show(Degree $degree)
    {
        $degree->action=route('degrees.update',$degree->id);
        return response()->json([
            'status' => 'success',
            'message' => 'Degree Successfully retrieved.',
            'data'  => $degree
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Degree  $degree
     * @return \Illuminate\Http\Response
     */
    public function edit(Degree $degree)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Degree  $degree
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Degree $degree)
    {
        $request->validate([
            'update_id'=>'required|exists:degrees,id',
            'update_name'=>'required|max:250'
        ],[
            'update_name.required'=>'Degree Name is Required',
            'update_name.max'=>'Degree Name must be less than 250 characters',
            'update_id.required'=>'Something Went Worng',
            'update_id.exists'=>'Something Went Worng'
        ]);
        
        $degree->update(['name'=>$request->update_name,'UserID' =>auth()->user()->id,]);
        return redirect()->back()->with('success','Degree Successfully updated.')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Degree  $degree
     * @return \Illuminate\Http\Response
     */
    public function destroy(Degree $degree)
    {
        $degree->delete();
        return redirect()->back()->with('success','Degree Successfully deleted..')->withInput();
    }
}
