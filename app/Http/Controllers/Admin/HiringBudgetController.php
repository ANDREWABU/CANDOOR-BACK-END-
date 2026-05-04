<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HiringBudget;
use Helpers;
use Auth;

class HiringBudgetController extends Controller
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
        $hiringBudget = HiringBudget::orderBy('id','DESC')->get();
        return view('AdminPanel.pages.setting.hiring-budget', compact('hiringBudget'));
    }
    public function show($id)
    {
        $data = HiringBudget::find($id);
        return Helpers::sendResponseBack($data,'hiringBudget', 'Hiring Budget successfully created', 'Something Went wrong please try again');

    }


    public function store(Request $request)
    {
        // dd($request->all());

        $validate = $request->validate([
            'start_price' => 'required',
            'end_price' => 'required',
        ]);
        $data = HiringBudget::create(array_merge($validate,['user_id' => Auth::id()]));
        return Helpers::sendResponseBack($data,'hiringBudget', 'Hiring Budget successfully created', 'Something Went wrong please try again');
    }
    public function update($id,Request $request)
    {
        $validate = $request->validate([
            'start_price' => 'required',
            'end_price' => 'required',
        ]);
        $data = HiringBudget::find($id)->update(['start_price' => $request->start_price,'end_price' => $request->end_price]);
        return Helpers::sendResponseBack($data,'hiringBudget', 'Hiring Budget successfully update', 'Something Went wrong please try again');
    }

    public function destroy($id)
    {
        $data = HiringBudget::destroy($id);
        if($data){
            return response()->json([
                'status' => 200,
                'success' => "Hiring Budget successfully deleted"
            ]);
        }else{
            return response()->json([
                'status' => "error",
                'success' => "Something went wrong please try again!"
            ],401);
        }
    }
}
