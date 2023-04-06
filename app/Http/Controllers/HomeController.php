<?php

namespace App\Http\Controllers;
use App\Models\User;
use Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\FacultyAttendance;

use App\Models\ParameterMaster;
use DB;
use App\Models\SchedulerHeader;

use App\Models\Schedule;

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

         $email = Auth::user()->email;
          
          $id= Auth::user()->id;
          $roleId= Auth::user()->Role;
           $Role= Role::where("id",$roleId)->first();

        
          $Faculty=Faculty::where("email",$email)->first('FacultyCode');

 
        if($Role->name=="Admin" || $Role->name="admin" && $Role->id==1 )
        {
    
         
            $FacultyAbsenceAttendance= FacultyAttendance::where('AttendanceStatus',"Absence")->count();
            $totalFaculty = Faculty::count();
            $CurrentStudent= Student::where('Status',"OnRoll")->count();
            $edit_schedule=[];
            $collection =['datearray'=>[],"dayarray"=>[],"tableData"=>[]];
        }
        else
        {

       
            $edit_schedule = Schedule::where("FacultyCode",$Faculty->FacultyCode)->get();
            $datearray=[];
            $dayarray=[];
            $date='';
            foreach($edit_schedule as $key=>$d)
            {   
                        if(!in_array($d->date, $datearray))
                        {
                            $datearray[]=$d->date;
                            $dayarray[]=$d->dayname;
                           
                        } 
             
                
                    $tableData[]=[
                        "id"=>$d->id,
                        "location"=>$d->location,
                        "LectureCode"=>$d->LectureCode,
                        "TimingFrom"=>$d->TimingFrom,
                        "TimingUpto"=>$d->TimingUpto,
                        "SubjectCode"=>$d->SubjectCode,
                        "FacultyCode"=>$d->FacultyCode,
                        "CourceCode"=>$d->CourceCode,
                        "BatchCode"=>$d->BatchCode,
                        "dayname"=>$d->dayname,
                        "Venue"=>$d->Venue,
                    ];
           
                
            }
            $collection =['datearray'=>$datearray,"dayarray"=>$dayarray,"tableData"=>$tableData];

            $FacultyAbsenceAttendance=0;
            $totalFaculty=0;
            $CurrentStudent=0;
        }
        

            
       

        return view('home',compact('totalFaculty','FacultyAbsenceAttendance','CurrentStudent','edit_schedule','collection'));
    }
}
