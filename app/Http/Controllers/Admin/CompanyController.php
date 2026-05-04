<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return view('AdminPanel.pages.company.index', compact('companies'));
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
            'name.required'=>'Company Name is Required',
            'name.max'=>'Company Name must be less than 250 characters'
        ]);
        
        //Slug Stored in Model
        Company::Create([
            'name' => $request->name,
            'UserID' =>auth()->user()->id,
            ]);
        return redirect()->back()->with('success','Company Successfully inserted.')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $company->action=route('companies.update',$company->id);
        return response()->json([
            'status' => 'success',
            'message' => 'Companies Successfully retrieved.',
            'data'  => $company
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'update_id'=>'required|exists:companies,id',
            'update_name'=>'required|max:250'
        ],[
            'update_name.required'=>'Company Name is Required',
            'update_name.max'=>'Company Name must be less than 250 characters',
            'update_id.required'=>'Something Went Worng',
            'update_id.exists'=>'Something Went Worng'
        ]);
        
        $company->update(['name'=>$request->update_name,'UserID' =>auth()->user()->id,]);
        return redirect()->back()->with('success','Company Successfully updated.')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->back()->with('success','Company Successfully deleted..')->withInput();
    }
}
