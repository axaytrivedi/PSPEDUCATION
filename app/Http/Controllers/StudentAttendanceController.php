<?php

namespace App\Http\Controllers;

use App\Models\StudentAttendance;
use Illuminate\Http\Request;

class StudentAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentatt = StudentAttendance::all();
        return view('StudentAttendance.index',compact('studentatt'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $studentatt = StudentAttendance::latest();
        return view('StudentAttendance.create',compact('studentatt'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       

        $request->validate([
            'LectureCode' => 'required',
            'LectureDate' => 'required',
            'StudentCode' => 'required',
            'AttendanceStatus' => 'required',
        
            ]);

        $create = StudentAttendance::create([
            'id'=>$request->id,
            'LectureCode' => $request->LectureCode,
            'LectureDate' => $request->LectureDate,
            'StudentCode' => $request->StudentCode,
            'AttendanceStatus' => $request->AttendanceStatus,
        ]);
        return redirect()->route('studentAttendance.index')->with('msg','Created Successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentAttendance  $studentAttendance
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $edit_studentatt = StudentAttendance::findOrFail($id);
        return view('StudentAttendance.show',compact('edit_studentatt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentAttendance  $studentAttendance
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_studentatt = StudentAttendance::find($id);
        return view('StudentAttendance.create',compact('edit_studentatt'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentAttendance  $studentAttendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'LectureCode' => 'required',
            'LectureDate' => 'required',
            'StudentCode' => 'required',
            'AttendanceStatus' => 'required',
         
        ]);
        $studentatt = StudentAttendance::find($id);
        $studentatt->LectureCode = $request->LectureCode;
        $studentatt->LectureDate = $request->LectureDate;
        $studentatt->StudentCode = $request->StudentCode;
        $studentatt->AttendanceStatus = $request->AttendanceStatus;
        $studentatt->save();
        return redirect()->route('studentAttendance.index')->with('msg','Updated Successfuly.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentAttendance  $studentAttendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentAttendance $studentAttendance)
    {
        $studentAttendance->delete();
       
        return redirect()->route('studentAttendance.index')
                        ->with('success','deleted successfully');
    }
}
