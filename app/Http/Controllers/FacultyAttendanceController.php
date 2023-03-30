<?php

namespace App\Http\Controllers;

use App\Models\FacultyAttendance;
use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facultyatt = FacultyAttendance::all();
        $facultys = Faculty::where('Status','OnRoll')->get();
        return view('FacultyAttendance.index',compact('facultyatt','facultys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $facultyatt = FacultyAttendance::latest();
        return view('FacultyAttendance.create',compact('facultyatt'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $checkId = $request->checks;
        $FacultyCode = $request->FacultyCode;
        $CalanderDate = $request->CalanderDate;
        $InTime = $request->InTime;
        $OutTime = $request->OutTime;
        $AttendanceStatus = $request->AttendanceStatus;
        // dd($CalanderDate);

        for ($i=0; $i < $checkId; $i++) { 
                $create = FacultyAttendance::create([
                'id'=>$checkId,
                'FacultyCode' => $FacultyCode,
                'CalanderDate' => $CalanderDate,
                'InTime' => $InTime,
                'OutTime' => $OutTime,
                'AttendanceStatus' => $AttendanceStatus
            ]);
        }
        return redirect()->route('facultyAttendance.index')->with('msg','Created Successfuly');
        
        // $request->validate([
        //     'FacultyCode' => 'required',
        //     'CalanderDate' => 'required',
        //     'InTime' => 'required',
        //     'OutTime' => 'required',
        //     'AttendanceStatus' => 'required',
        //     ]);

        // $create = FacultyAttendance::create([
        //     'id'=>$request->id,
        //     'FacultyCode' => $request->FacultyCode,
        //     'CalanderDate' => $request->CalanderDate,
        //     'InTime' => $request->InTime,
        //     'OutTime' => $request->OutTime,
        //     'AttendanceStatus' => $request->AttendanceStatus,
        // ]);
        // return redirect()->route('facultyAttendance.index')->with('msg','Created Successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FacultyAttendance  $facultyAttendance
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $edit_facultyatt = FacultyAttendance::findOrFail($id);
        return view('FacultyAttendance.show',compact('edit_facultyatt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FacultyAttendance  $facultyAttendance
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_facultyatt = FacultyAttendance::find($id);
        return view('FacultyAttendance.create',compact('edit_facultyatt'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FacultyAttendance  $facultyAttendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([

            'FacultyCode' => 'required',
            'CalanderDate' => 'required',
            'InTime' => 'required',
            'OutTime' => 'required',
            'AttendanceStatus' => 'required',
         
        ]);
        $facultyatt = FacultyAttendance::find($id);
        $facultyatt->FacultyCode = $request->FacultyCode;
        $facultyatt->CalanderDate = $request->CalanderDate;
        $facultyatt->InTime = $request->InTime;
        $facultyatt->OutTime = $request->OutTime;
        $facultyatt->AttendanceStatus = $request->AttendanceStatus;
        $facultyatt->save();
        return redirect()->route('facultyAttendance.index')->with('msg','Updated Successfuly.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FacultyAttendance  $facultyAttendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacultyAttendance $facultyAttendance)
    {
        $facultyAttendance->delete();
       
        return redirect()->route('facultyAttendance.index')
                        ->with('success','deleted successfully');
    }
}
