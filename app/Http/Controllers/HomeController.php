<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $test = State::find(1)->country->id;
        dd($test);
        return view('home');
    }
}
