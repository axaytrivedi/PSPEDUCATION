<?php

namespace App\Http\Controllers;

use App\Models\FacultySubject;
use Illuminate\Http\Request;
use App\Models\Faculty;

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
        return view('FacultySubject.create',compact('facultysub','facultys'));
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
            'SubjectCode' => $request->SubjectCode,
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
        return view('Faculty.create',compact('edit_facultysub'));
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
        $facultysub->SubjectCode = $request->SubjectCode;
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
}
