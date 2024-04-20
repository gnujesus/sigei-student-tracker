<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Building;
use App\Models\Classroom;
use Illuminate\Http\Request;

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
        $buildings = Building::all();
        $classrooms = Classroom::all();
        $careers = Career::all();
        return view('home', ['buildings' => $buildings, 'classrooms'=> $classrooms, 'careers'=>$careers]);
    }
}
