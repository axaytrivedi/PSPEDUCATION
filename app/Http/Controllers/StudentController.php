<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\ParameterMaster;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return view('Student.index',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::latest();
        $batchCode = ParameterMaster::where('Parameter','BatchList')->get(['ParaCode','ParaDescription']); 
        $CourseList = ParameterMaster::where('Parameter','CourseList')->get(['ParaCode','ParaDescription']); 

        return view('Student.create',compact('students','batchCode','CourseList'));
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
            
            "StudentName"=> 'required|unique:student,id,deleted_at',
            'DOB' => 'required',
            'DateOfJoining' => 'required',

            ]);

        $create = Student::create([
            'id'=>$request->id,
            'StudentCode' => StudentCode(),
            'RollNo' => StudentRoll(),
            'StudentName' => $request->StudentName,
            'DOB' => $request->DOB,
            'DateOfJoining' => $request->DateOfJoining,
            'Gender' => $request->Gender,
            'CourceCode' => $request->CourceCode,
            'BatchCode' => $request->BatchCode,
            'AcademinSession' => $request->AcademinSession,
            'AddressLine1'=>$request->AddressLine1,
            'AddressLine2'=>$request->AddressLine2,
            'AddressLine3'=>$request->AddressLine3,
            'Status' => $request->Status,
        ]);
        return redirect()->route('student.index')->with('msg','Created Successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $students = Student::all();
        return view('Student.index',compact('students'));
        // $edit_students = Student::findOrFail($id);
        // return view('Student.show',compact('edit_students'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_students = Student::find($id);
        $batchCode = ParameterMaster::where('Parameter','BatchList')->get(['ParaCode','ParaDescription']); 
        $CourseList = ParameterMaster::where('Parameter','CourseList')->get(['ParaCode','ParaDescription']); 

        return view('Student.create',compact('edit_students','batchCode','CourseList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $request->validate([
            'StudentName' => 'required',
            'DOB' => 'required',
            'DateOfJoining' => 'required',
            'Gender' => 'required',
            'CourceCode' => 'required',
            'BatchCode' => 'required',
            'AcademinSession' => 'required',
            'Status' => 'required',

        ]);
        $students = Student::find($id);
        // $students->StudentCode = $request->StudentCode;
        $students->RollNo = $request->RollNo;
        $students->StudentName = $request->StudentName;
        $students->DOB = $request->DOB;
        $students->DateOfJoining = $request->DateOfJoining;
        $students->Gender = $request->Gender;
        $students->CourceCode = $request->CourceCode;
        $students->BatchCode = $request->BatchCode;
        $students->AcademinSession = $request->AcademinSession;
        $students->Status = $request->Status;
        $students->AddressLine1=$request->AddressLine1;
        $students->AddressLine2=$request->AddressLine2;
        $students->AddressLine3=$request->AddressLine3;
        $students->save();
        return redirect()->route('student.index')->with('msg','Updated Successfuly.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
       
        return redirect()->route('student.index')
                        ->with('success','deleted successfully');
    }
    public function studentlist()
    {
        $students = Student::all();
        return view('Student.studentlist',compact('students'));
    }

    public function getfilteredStudent(Request $request)
    {
        $studentCode= $request->studentCode;
        $studentBatchCode= $request->studentBatchCode;

        // dd($studentCode,  $studentBatchCode);
        $students = Student::where('CourceCode',$studentCode)->where('BatchCode',$studentBatchCode)
        ->where('Status',"OnRoll")->get();
       
        return view('Student.index',compact('studentCode','studentBatchCode','students'));
    }
}
