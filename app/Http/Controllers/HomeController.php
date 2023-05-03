<?php

namespace App\Http\Controllers;
use App\Models\User;
use Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\FacultyAttendance;

use DB;
use App\Models\SchedulerHeader;

use App\Models\Schedule;
use App\Models\ParameterMaster;
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

  

            $date= date("Y-m-d");
            
            $day=date("D");

                $schedulerheader = schedulerheader::get();
            $Todayschedule = Schedule::where("dayname", $day)->get();
            $rooms = ParameterMaster::where("Parameter","VenueList")->where('Validity',"Active")->get(); 

            $newcollection=[];
           
                foreach($schedulerheader as $hader)
                {   
                    foreach($Todayschedule as $child)
                    {
                       if($day && $hader->LineNo == $child->LectureCode && $child->Venue !=  null )
                        {              
                                $newcollection[]=[
                                                "lineNo"=>$hader->LineNo,
                                                "Location"=>$child->location ,
                                                "StartTime"=>$child->TimingFrom,
                                                "EndTime"=>$child->TimingUpto,
                                                "FacultyCode"=>$child->FacultyCode,
                                                "SubjectCode"=>$child->SubjectCode,
                                                "BatchCode"=>$child->BatchCode,
                                                "CourceCode"=>$child->CourceCode,
                                                "Room"=>$child->Venue
                                            ];
                        }
                    }
                }
              
            
                          
            $collection =['datearray'=>[],"dayarray"=>[],"tableData"=>[]];
        }
        else
        {

       
            $edit_schedule = Schedule::where("FacultyCode",$Faculty->FacultyCode)->get();

            
            $datearray=[];
            $dayarray=[];
            $date='';
            // dd( $edit_schedule);
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

            // dd($tableData);
            $collection =['datearray'=>$datearray,"dayarray"=>$dayarray,"tableData"=>$tableData];

            $FacultyAbsenceAttendance=0;
            $totalFaculty=0;
            $CurrentStudent=0;
            $rooms=[];
         
            $newcollection=[];
        }
        


        $MainLocation = ParameterMaster::where('Parameter',"Location")->get(['ParaID','ParaDescription']);

       

        return view('home',compact('MainLocation','newcollection','rooms','totalFaculty','FacultyAbsenceAttendance','CurrentStudent','edit_schedule','collection'));
    }

    public function AppendAdminDash(Request $request)
    {

        $location = $request->id;
       
        $FacultyAbsenceAttendance= FacultyAttendance::where('AttendanceStatus',"Absence")->count();
        $totalFaculty = Faculty::count();
        $CurrentStudent= Student::where('Status',"OnRoll")->count();
        $edit_schedule=[];



        $date= date("Y-m-d");
        
        $day=date("D");

            $schedulerheader = schedulerheader::get();
        $Todayschedule = Schedule::where("dayname", $day)->get();
        // $rooms = ParameterMaster::where("Parameter","VenueList")->where('Validity',"Active")->get(); 
        $rooms = ParameterMaster::where('Parameter',"Room")->where('ParaFilter1',$location)->get();

        $newcollection=[];
       
            foreach($schedulerheader as $hader)
            {   
                foreach($Todayschedule as $child)
                {
                   if($day && $hader->LineNo == $child->LectureCode && $child->Venue !=  null )
                    {              
                            $newcollection[]=[
                                            "lineNo"=>$hader->LineNo,
                                            "Location"=>$child->location ,
                                            "StartTime"=>$child->TimingFrom,
                                            "EndTime"=>$child->TimingUpto,
                                            "FacultyCode"=>$child->FacultyCode,
                                            "SubjectCode"=>$child->SubjectCode,
                                            "BatchCode"=>$child->BatchCode,
                                            "CourceCode"=>$child->CourceCode,
                                            "Room"=>$child->Venue
                                        ];
                    }
                }
            }
          
        
                      
        $collection =['datearray'=>[],"dayarray"=>[],"tableData"=>[]];

                                         
        $html = view('appendadminDash',compact('newcollection','rooms','totalFaculty','FacultyAbsenceAttendance','CurrentStudent','edit_schedule','collection'))->render();
 
        return response()->json(array('success'=> true,'html'=>$html)); 
    
    }
}
