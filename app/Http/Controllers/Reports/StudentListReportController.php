<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use DB;

class StudentListReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courseCode = Student::get(['id','CourceCode']);
        $batchName = Student::get(['id','BatchCode']);

        return view('Reports.StudentList.index', compact('courseCode','batchName'));
    }

    public function getStudentData(Request $request)
    {
        // echo "<pre>";
        // print_r($_REQUEST);die;
        //DB::enableQueryLog(); // Enable query log
        $courseCode=$request->courseCode;
        $batchCode=$request->batchCode;
        // dd($courseCode,'--',$batchCode);

        $data = DB::table('student')->select(
                'student.*',
            )
            ->orderBy('id', 'DESC');
           
            if($courseCode != '') 
            {
                $data->where('CourceCode',$courseCode);
            }  

            if($batchCode != '') 
            {
                $data->where('BatchCode',$batchCode);
            }  

        $data1 = $data->get();
        // dd($data1);

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
