<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faculty;
use DB;
use Carbon\Carbon;
class FacultyMonthlyReportController extends Controller
{
   public function index()
   {
    $Faculty = Faculty::where("Status","OnRoll")->get()->sortDesc();
    return view("Reports.Facultymonthly.FacultyMonthlyReport",compact("Faculty"));
   }

   public function GetMonthlyFacultyWiseReport(Request $request)
   {
        $FacultyCode= $request->faculty;
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;
        $fromDate = date("Y-m-d",strtotime($fromDate));
        $toDate = date("Y-m-d",strtotime($toDate));
       
        $table=DB::table('faculty as t1')
        ->select(
            't1.FacultyCode','t1.firstName as FirstName','t1.lastName as LastName','t1.Status',
            't2.*','t2.FacultyCode as facAttCode',
            't3.FacultyCode as schFacCode','t3.date','t3.TimingFrom','t3.TimingUpto',
            DB::raw('SUM(t3.TimingUpto - t3.TimingFrom) as noHoursLectures'),
            't4.Date','t3.CourceCode','t3.BatchCode','t3.SubjectCode',
           )
            ->leftJoin("facultyattendance as t2", "t2.FacultyCode", "=", "t1.FacultyCode")
            ->leftJoin("schedule as t3", "t3.FacultyCode", "=", "t2.FacultyCode")
            ->leftJoin("schedulerheader as t4", "t4.LineNo", "=", "t3.LectureCode")
            ->selectraw('TIMEDIFF(t2.OutTime,t2.InTime) as attInHrs')
   
            ->where(function($query) use ($fromDate, $toDate){
                $query->whereBetween('t2.CalanderDate', [$fromDate, $toDate]);
            })
          
         
            ->where('t1.Status','OnRoll')
            ->where('t2.FacultyCode',$FacultyCode)
            ->groupBy('t2.CalanderDate')
            ->get();

         
 
            $sum = strtotime('00:00:00');
 
            $totaltime = 0;
             
            foreach( $table as $element ) {
                 

                $timeinsec = strtotime($element->attInHrs) - $sum;
                 
              
                $totaltime = $totaltime + $timeinsec;
            }
             
        
          
            $h = intval($totaltime / 3600);
             
            $totaltime = $totaltime - ($h * 3600);
          
            $m = intval($totaltime / 60);
             
          
            $s = $totaltime - ($m * 60);
             
          
            if(strlen($m)==1)
            {
                $m = "00";
            }
   
            $totalTime = $h.":".$m;
            $getdata=array();
            $getdata["GetData"]= $table;
            
            $getdata["totalTime"]= $totalTime;
            return response()->json($getdata);
   }
}
