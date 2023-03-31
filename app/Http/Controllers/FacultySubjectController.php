<?php

namespace App\Http\Controllers;

use App\Models\FacultySubject;
use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\ParameterMaster;
class FacultySubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facultysub = FacultySubject::all();
        return view('FacultySubject.index',compact('facultysub'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $facultysub = FacultySubject::latest();
        $facultys = Faculty::where('Status','OnRoll')->get();
        $Coursedata = ParameterMaster::where('Parameter','CourseList')->get(); 
        return view('FacultySubject.create',compact('facultysub','facultys','Coursedata'));
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
            'FacultyCode' => 'required',
            'CourceCode' => 'required',
            'SubjectCode' => 'required',
            'EffFrom' => 'required',
            'EffUpto' => 'required',
            ]);

        $create = FacultySubject::create([
            'id'=>$request->id,
            'FacultyCode' => $request->FacultyCode,
            'CourceCode' => $request->CourceCode,
            'SubjectCode' =>implode(",", $request->SubjectCode),
            'EffFrom' => $request->EffFrom,
            'EffUpto' => $request->EffUpto,
        ]);
        return redirect()->route('facultySubject.index')->with('msg','Created Successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FacultySubject  $facultySubject
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $edit_facultysub = FacultySubject::findOrFail($id);
        return view('FacultySubject.show',compact('edit_facultysub'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FacultySubject  $facultySubject
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_facultysub = FacultySubject::find($id);

        $facultys = Faculty::where('Status','OnRoll')->get();
        $Coursedata = ParameterMaster::where('Parameter','CourseList')->get(); 
         $SubjectCode = ParameterMaster::whereIn('ParaDescription',explode(",",$edit_facultysub->SubjectCode))->get(['ParaID','ParaDescription']); 

      
        return view('FacultySubject.create',compact('edit_facultysub','facultys','Coursedata','SubjectCode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FacultySubject  $facultySubject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([        
            'FacultyCode' => 'required',
            'CourceCode' => 'required',
            'SubjectCode' => 'required',
            'EffFrom' => 'required',
            'EffUpto' => 'required',

        ]);
        $facultysub = FacultySubject::find($id);
        $facultysub->FacultyCode = $request->FacultyCode;
        $facultysub->CourceCode = $request->CourceCode;
        $facultysub->SubjectCode = implode(",", $request->SubjectCode);
        $facultysub->EffFrom = $request->EffFrom;
        $facultysub->EffUpto = $request->EffUpto;
        $facultysub->save();
        return redirect()->route('facultySubject.index')->with('msg','Updated Successfuly.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FacultySubject  $facultySubject
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacultySubject $facultySubject)
    {
        $facultySubject->delete();
       
        return redirect()->route('facultySubject.index')
                        ->with('success','deleted successfully');
    }
    public function GetsubjectCode(Request $request)
    {
         $ParaFilter1= $request->id;
         return $Coursedata = ParameterMaster::where('ParaFilter1',$ParaFilter1)->get(); 

         
    }
}
