<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Models\ParameterMaster;
use DB;
use App\Models\SchedulerHeader;
use App\Models\FacultySubject;
class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $SchedulerHeader = SchedulerHeader::groupBy("LineNo")->get();
                // $schedule = Schedule::get();
        return view('Schedule.index',compact('SchedulerHeader'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $CourseList =ParameterMaster::where("Parameter","CourseList")->where('Validity',"Active")->get(); 
        $SubjectsList =ParameterMaster::where("Parameter","SubjectsList")->where('Validity',"Active")->get(); 
        $Location =ParameterMaster::where("Parameter","VenueList")->where('Validity',"Active")->get(); 
        $BatchList=[];
        $schedule = Schedule::latest();
        return view('Schedule.create',compact('BatchList','schedule','SubjectsList','CourseList','Location'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  

        
        $storeLocation =  $request->storeLocation;
        $location = $request->location;
   
        $CourceCode= $request->CourseList;
        $BatchList = $request->BatchList;
        $HeaderDate= $request->HeaderDate;
        $HeaderDay = $request->HeaderDay;
        $dayStart  = $request->dayStart;
        $dayend    = $request->dayend;
        
        $subject  = $request->subject;
        $faculty  = $request->faculty;

  
        $keydate=0;

               
             
            $SchedulerHeader = new SchedulerHeader;
            $SchedulerHeader->LineNo = LectureCode();
            $SchedulerHeader->CourceCode=$CourceCode;
            $SchedulerHeader->BatchCode=$BatchList;
            $SchedulerHeader->Date=date('Y-m-d');
            $SchedulerHeader->Status="Active";
            $SchedulerHeader->save();

            $LineNo = $SchedulerHeader->LineNo;
            $storlocationString=[];
      
        


        foreach($dayStart as $i=>$startTime) // total row
        { 
            $k=1;
            foreach($HeaderDay as $j=>$dayname) // Total Column
            {

                  $storlocationString[]=$storeLocation[$i][$k];
                    $create =new  Schedule;
                    $create->CourceCode=$CourceCode;
                    $create->BatchCode=$BatchList;
                    $create->LectureCode=$LineNo;
                    $create->dayname=$dayname;
                    $create->date=(array_key_exists($j,$HeaderDate)) ? $HeaderDate[$j] : null;
                    $create->TimingFrom=(array_key_exists($k,$startTime)) ? $startTime[$k] : null;
                    $create->TimingUpto=(array_key_exists($i,$dayend) && array_key_exists($k,$dayend[$i])) ? $dayend[$i][$k] : null;
                    $create->SubjectCode=(array_key_exists($i,$subject) && array_key_exists($k,$subject[$i])) ? $subject[$i][$k] : null;
                    $create->FacultyCode=(array_key_exists($i,$faculty) && array_key_exists($k,$faculty[$i])) ? $faculty[$i][$k] : null;
                    $create->Venue=(array_key_exists($i,$location) && array_key_exists($k,$location[$i])) ? $location[$i][$k] : null;
                    $create->location=(array_key_exists($i,$storeLocation) && array_key_exists($k,$storeLocation[$i])) ? $storeLocation[$i][$k] : null; // which filed are your store location
                    $create->save();
             $k++;
            }
           
        }
      
        return redirect()->route('schedule.index')->with('msg','Created Successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $edit_schedule = Schedule::findOrFail($id);
        return view('Schedule.show',compact('edit_schedule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $SchedulerHeader = SchedulerHeader::find($id);
        $edit_schedule = Schedule::where("LectureCode",$SchedulerHeader->LineNo)->get();

        $CourseList =ParameterMaster::where("Parameter","CourseList")->where('Validity',"Active")->get(); 
        $SubjectsList =ParameterMaster::where("Parameter","SubjectsList")->where("ParaFilter1",  $SchedulerHeader->CourceCode)->where('Validity',"Active")->get(); 
        $Location =ParameterMaster::where("Parameter","VenueList")->where('Validity',"Active")->get(); 


     

        
        $datearray=[];
        $dayarray=[];

        $date='';
        $Row1=[];
        $Row2=[];
        $Row3=[];
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
                    "dayname"=>$d->dayname,
                    "Venue"=>$d->Venue,
                ];
       
            
        }
       
     
     
   
 
 
        $collection =['datearray'=>$datearray,"dayarray"=>$dayarray,"tableData"=>$tableData];
           $BatchList =ParameterMaster::where("Parameter","BatchList")->where("ParaDescription",$SchedulerHeader->BatchCode)->where('Validity',"Active")->get(); 

   
        return view('Schedule.create',compact('SchedulerHeader','edit_schedule','CourseList','SubjectsList','Location','BatchList','collection'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $storeLocation =  $request->storeLocation;
        $location = $request->location;
   
        $CourceCode= $request->CourseList;
        $BatchList = $request->BatchList;
        $HeaderDate= $request->HeaderDate;
        $HeaderDay = $request->HeaderDay;
        $dayStart  = $request->dayStart;
        $dayend    = $request->dayend;
        $subject  = $request->subject;
        $faculty  = $request->faculty;
        $Scheduler_id= $request->id;
       
        
        $SchedulerHeader = SchedulerHeader::find($request->SchedulerHeaderId);
        $SchedulerHeader->CourceCode=$CourceCode;
        $SchedulerHeader->BatchCode=$BatchList;
        $SchedulerHeader->save();

        $LineNo = $SchedulerHeader->LineNo;
        $storlocationString=[];

        
        foreach($dayStart as $i=>$startTime) // total row
        { 
            $k=1;
            foreach($HeaderDay as $j=>$dayname) // Total Column
            {   

             
                $scheduler_id =(array_key_exists($i,$Scheduler_id) && array_key_exists($k,$Scheduler_id[$i])) ? $Scheduler_id[$i][$k] : null;
                if(isset($scheduler_id))
                {
                    
                 
                    $create =Schedule::find($scheduler_id);
                    $create->CourceCode=$CourceCode;
                    $create->BatchCode=$BatchList;
               
                  
                    $create->TimingFrom=(array_key_exists($k,$startTime)) ? $startTime[$k] : null;
                    $create->TimingUpto=(array_key_exists($i,$dayend) && array_key_exists($k,$dayend[$i])) ? $dayend[$i][$k] : null;
                    $create->SubjectCode=(array_key_exists($i,$subject) && array_key_exists($k,$subject[$i])) ? $subject[$i][$k] : null;
                    $create->FacultyCode=(array_key_exists($i,$faculty) && array_key_exists($k,$faculty[$i])) ? $faculty[$i][$k] : null;
                    $create->Venue=(array_key_exists($i,$location) && array_key_exists($k,$location[$i])) ? $location[$i][$k] : null;
                    $create->location=(array_key_exists($i,$storeLocation) && array_key_exists($k,$storeLocation[$i])) ? $storeLocation[$i][$k] : null; // which filed are your store location
                    $create->save();
                    
                }
                $k++;
            }
     

        }
      

    
 
        $keydate=0;

               
             
 
       
        return redirect()->route('schedule.index')->with('msg','Updated Successfuly.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {

        $SchedulerHeader = SchedulerHeader::find($id);

        $edit_schedule = Schedule::where("LectureCode",$SchedulerHeader->LineNo)->get();
        if(!empty($edit_schedule))
        {
            foreach($edit_schedule as $data)
            {
               $data->delete();
            }
            
            $SchedulerHeader->delete();
        }
        return redirect()->route('schedule.index')
                        ->with('success','deleted successfully');
    }

    public function GetCourseWiseBatch(Request $request)
    {
        $value = $request->value;
         $CourseList =ParameterMaster::where("Parameter","BatchList")->where("ParaFilter1",$value)->get(); 

         $subject =ParameterMaster::where("Parameter","SubjectsList")->where("ParaFilter1",$value)->get(); 

         return response()->json(['msg'=>0,'CourseList'=>$CourseList,'subject'=>$subject,]);
    }
    public function GetSubjectWiseFacultyinShedule(Request $request)
    {
        $SubjectCode = $request->value;
        $CourseCode= $request->CourseCode;
        $facultysubject = DB::table('facultysubject as t1')
        ->join("faculty as t2",'t2.FacultyCode','=','t1.FacultyCode')
        ->where("CourseCode",$CourseCode)

        ->WhereRaw("find_in_set('".$SubjectCode."',SubjectCode) = 1")
       ->get(['t1.*','t2.firstName']);

       return response()->json(['msg'=>0,'facultysubject'=>$facultysubject]);

        
    }
    public function PrintScheduler($id)
    {
      
    
        $SchedulerHeader = SchedulerHeader::find($id);

          $edit_schedule = Schedule::where("LectureCode",$SchedulerHeader->LineNo)->get();

        $datearray=[];
        $dayarray=[];

        
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
                    "dayname"=>$d->dayname,
                    "Venue"=>$d->Venue,
                ];
        }

        $collection =['datearray'=>$datearray,"dayarray"=>$dayarray,"tableData"=>$tableData];

          return view('Schedule.printSchedule',compact('SchedulerHeader','edit_schedule','collection'));
    }
}
