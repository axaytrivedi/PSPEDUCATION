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
        $attendance_id= $request->attendance_id;


        $checkId = $request->checks;
        $FacultyCode = $request->FacultyCode;
        $CalanderDate = $request->CalanderDate;
        $InTime = $request->InTime;
        $OutTime = $request->OutTime;
        $AttendanceStatus = $request->AttendanceStatus;

     
        // for ($i=0; $i < sizeof($checkId); $i++) { 


           
        //     dd(sizeof($checkId));
        //         $create = FacultyAttendance::create([
        //         'FacultyCode' => $FacultyCode[$i],
        //         'CalanderDate' => $CalanderDate,
        //         'InTime' => $InTime[$i],
        //         'OutTime' => $OutTime[$i],
        //         'AttendanceStatus' => $AttendanceStatus[$i]
        //     ]);
        // }

            


        foreach($InTime as $key=>$data)
        {
               
            
          
            if(array_key_exists($key,$InTime))
            {
                if(array_key_exists($key,$attendance_id) && !empty($attendance_id[$key]))
                {
                   $create = FacultyAttendance::where('id',$attendance_id[$key])->update([
                        'FacultyCode' => $FacultyCode[$key],
                        'CalanderDate' => $CalanderDate,
                        'InTime' => $InTime[$key],
                        'OutTime' => $OutTime[$key],
                        'AttendanceStatus' => $AttendanceStatus[$key]
                    ]);
                }
                else
                {
                    
                  
                    dd("NewOLD");
                    $create = FacultyAttendance::create([
                        'FacultyCode' => $FacultyCode[$key],
                        'CalanderDate' => $CalanderDate,
                        'InTime' => $InTime[$key],
                        'OutTime' => $OutTime[$key],
                        'AttendanceStatus' => $AttendanceStatus[$key]
                    ]);
                }

               
            }
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
