<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\FacultyAttendance;
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
        $FacultyAbsenceAttendance= FacultyAttendance::where('AttendanceStatus',"Absence")->count();
        $totalFaculty = Faculty::count();
        $CurrentStudent= Student::where('Status',"OnRoll")->count();
        return view('home',compact('totalFaculty','FacultyAbsenceAttendance','CurrentStudent'));
    }
}
