<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

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
        $schedule = Schedule::latest();
        return view('Schedule.create',compact('schedule'));
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

        $create = Schedule::create([
            'id'=>$request->id,
            'LectureCode' => $request->LectureCode,
            'CourceCode' => $request->CourceCode,
            'BatchCode' => $request->BatchCode,
            'DateOfWeek' => $request->DateOfWeek,
            'Session' => $request->Session,
            'TimingFrom' => $request->TimingFrom,
            'TimingUpto' => $request->TimingUpto,
            'SubjectCode' => $request->SubjectCode,
            'FacultyCode' => $request->FacultyCode,
            'Venue' => $request->Venue,
            'EffFrom' => $request->EffFrom,
            'EffUpto' => $request->EffUpto,
        ]);
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
}
