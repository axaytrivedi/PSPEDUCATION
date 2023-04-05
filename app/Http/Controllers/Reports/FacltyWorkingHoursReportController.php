<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\FacultyAttendance;
use DB;

class FacltyWorkingHoursReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Reports.FacltyWorkingHours.index');
    }

    public function getFacultyWorkingHours(Request $request)
    {
        // echo "<pre>";
        // print_r($_REQUEST);die;
        //DB::enableQueryLog(); // Enable query log
        // $startDate = date("Y-m-d H:i:s", strtotime($request->fromDate));
        // $endDate = date("Y-m-d H:i:s", strtotime($request->toDate));
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;

        $data = DB::table('faculty as t1')->select(
                't1.FacultyCode','t1.firstName as FirstName','t1.lastName as LastName','t1.Status',
                't2.*','t2.FacultyCode as facAttCode',
                't3.FacultyCode as schFacCode','t3.date','t3.TimingFrom','t3.TimingUpto',
                DB::raw('SUM(t3.TimingUpto - t3.TimingFrom) as noHoursLectures'),
                't4.Date'
            )
            ->leftJoin("facultyattendance as t2", "t2.FacultyCode", "=", "t1.FacultyCode")
            ->leftJoin("schedule as t3", "t3.FacultyCode", "=", "t2.FacultyCode")
            ->leftJoin("schedulerheader as t4", "t4.LineNo", "=", "t3.LectureCode")
            ->selectraw('TIMEDIFF(t2.OutTime,t2.InTime) as attInHrs')
            // ->selectraw('TIMEDIFF(t3.TimingUpto,t3.TimingFrom) as noHoursLectures')
            ->where('t1.Status','OnRoll')
            ->orderBy('t1.id', 'DESC')
            ->groupBy('t3.FacultyCode')
            ->where(function($query) use ($fromDate, $toDate){
                $query->whereBetween('t2.CalanderDate', [$fromDate, $toDate]);
            })
            ->where(function($query) use ($fromDate, $toDate){
                $query->whereBetween('t4.Date', [$fromDate, $toDate]);
            });
            // ->where(function($query) use ($fromDate, $toDate){
            //     $query->whereDate('t2.CalanderDate', '>=', $fromDate);
            //     $query->whereDate('t2.CalanderDate', '<=', $toDate);
            // });
           
            
        $data1 = $data->get();
        //dd(DB::getQueryLog()); // Show results of log
        $getdata=array();
        array_push($getdata,$data1);
        return response()->json($getdata);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
