<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Models\ParameterMaster;
use DB;
class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedule = Schedule::all();
        
        return view('Schedule.index',compact('schedule'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $CourseList =ParameterMaster::where("Parameter","CourseList")->get(); 
        $SubjectsList =ParameterMaster::where("Parameter","SubjectsList")->get(); 
        $Location =ParameterMaster::where("Parameter","VenueList")->get(); 

        $schedule = Schedule::latest();
        return view('Schedule.create',compact('schedule','SubjectsList','CourseList','Location'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  

      
        $CourceCode= $request->CourseList;
        $BatchList = $request->BatchList;
        $HeaderDate= $request->HeaderDate;
        $HeaderDay = $request->HeaderDay;
        $dayStart  = $request->dayStart;
        $dayend    = $request->dayend;
        
        $subject  = $request->subject;
        $faculty  = $request->faculty;
        $location = $request->location;

        dd($request->storeLocation);
        $keydate=0;
   
      
        foreach($dayStart as $key=>$date)
        {
            $create =new  Schedule;
            $create->CourceCode=$CourceCode;
            $create->BatchCode=$BatchList;
            $create->location=
            $create->date=(array_key_exists($keydate,$HeaderDate)) ? $HeaderDate[$keydate] : null;
            $create->dayname=(array_key_exists($keydate,$HeaderDay)) ? $HeaderDay[$keydate] : null;
            $create->TimingFrom=(array_key_exists($key,$date)) ? $date[$key] : null;
            $create->TimingUpto=(array_key_exists($key,$dayend) && array_key_exists($key,$dayend[$key])) ? $dayend[$key][$key] : null;
            $create->SubjectCode=(array_key_exists($key,$subject) && array_key_exists($key,$subject)) ? $subject[$key][$key] : null;
            $create->FacultyCode=(array_key_exists($key,$faculty) && array_key_exists($key,$faculty)) ? $faculty[$key][$key] : null;
            $create->Venue=(array_key_exists($key,$location) && array_key_exists($key,$location)) ? $location[$key][$key] : null;
            $create->save();
            $keydate++;
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
        $edit_schedule = Schedule::find($id);
        return view('Schedule.create',compact('edit_schedule'));
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
        $request->validate([
            'LectureCode' => 'required',
            'CourceCode' => 'required',
            'BatchCode' => 'required',
            'DateOfWeek' => 'required',
            'Session' => 'required',
            'TimingFrom' => 'required',
            'TimingUpto' => 'required',
            'SubjectCode' => 'required',
            'FacultyCode' => 'required',
            'Venue' => 'required',
            'EffFrom' => 'required',
            'EffUpto' => 'required',
         
        ]);
        $schedule = Schedule::find($id);
        $schedule->LectureCode = $request->LectureCode;
        $schedule->CourceCode = $request->CourceCode;
        $schedule->BatchCode = $request->BatchCode;
        $schedule->DateOfWeek = $request->DateOfWeek;
        $schedule->Session = $request->Session;
        $schedule->TimingFrom = $request->TimingFrom;
        $schedule->TimingUpto = $request->TimingUpto;
        $schedule->SubjectCode = $request->SubjectCode;
        $schedule->FacultyCode = $request->FacultyCode;
        $schedule->Venue = $request->Venue;
        $schedule->EffFrom = $request->EffFrom;
        $schedule->EffUpto = $request->EffUpto;
        $schedule->save();
        return redirect()->route('schedule.index')->with('msg','Updated Successfuly.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
       
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
}
