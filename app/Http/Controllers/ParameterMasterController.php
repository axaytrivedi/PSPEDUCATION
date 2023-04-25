<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParameterMaster;
use Illuminate\Validation\Rule;
class ParameterMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $ParameterMaster = ParameterMaster::groupBy('Parameter')->get(['ParaID','Parameter']);

        $ParameterMaster = ParameterMaster::where('Parameter','Title')->get(['ParaID','ParaDescription']);
        return view("parameter.index",compact('ParameterMaster'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function newparameter(Request $request)
     {
     
            
        $filter = $request->filter;
        
          $ParameterMaster = ParameterMaster::where('ParaID',$filter)->first();
        if($ParameterMaster->ParaDescription =="BatchList" ||$ParameterMaster->ParaDescription =="SubjectsList"
            ||$ParameterMaster->ParaDescription =="CourseList"
            ||$ParameterMaster->ParaDescription =="Room")
        {
            $CourseList = ParameterMaster::where('Parameter',"Location")->get(['ParaID','ParaDescription']);
        }
        else
        {
            $CourseList=[];
        
        }
        return view("parameter.create",compact('ParameterMaster','CourseList'));
    }
    public function create()
    {
       
    //    return view("admin.parameter.index",)
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $filter = $request->filter;
        $parameter = $request->ParaFilter1;
        $ParaFilter2 = $request->ParaFilter2;
        
        $ParaDescription = $request->ParaDescription;
        $Validity = $request->Validity;
        $Validity = $request->Validity;
        $file = $request->file;
        $ParaCode= $request->ParaCode;

        // $request->validate([
        //     // 'ParaDescription' => 'required|unique:parameter_masters|max:255',
        //     'ParaDescription' => 'required',Rule::unique('parameter_masters', 'Parameter', 'ParaDescription')
            
        // ]);
        if(!empty($file) && isset($file))
        {  
          
            $CategoryDesignImge= $file->getClientOriginalName();
            $file->move(public_path('AdminAssest/Category'),$CategoryDesignImge);


        }
        else
        {
            $CategoryDesignImge = ' ';
        }
        
        ParameterMaster::create([
                "ParaID"=>paraidCreate(),
                "Parameter"=>$parameter,
                'ParaFilter1'=> (isset($filter))? $filter : null,
                'ParaFilter2'=> (isset($ParaFilter2))? $ParaFilter2 : null,
                "ParaCode"=>$ParaCode,
                'ParaDescription'=>ucfirst($ParaDescription),
                'ParaValue'=>$CategoryDesignImge,
                'Validity'=>$Validity,
            ]);
        return redirect()->route('parameter.index')
            ->with('msg','Category created successfully.');


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
    public function getDepenedentFilters(Request $request)
    {
        $paraid = $request->id;

         $ParameterMaster = ParameterMaster::where('ParaID',$paraid)->first('ParaDescription');



             $MailParameterMaster = ParameterMaster::where('Parameter',trim($ParameterMaster->ParaDescription))->
             where('Validity',"Active")->get();
             $html = view('parameter.getfillterwisedata',compact('MailParameterMaster'))->render();
             return response()->json(array('success'=> true, 'html'=>$html));
     
    }

    public function GetLocationWieseCourse(Request $request)
    {
         $parameter =  $request->id;
   
       $ParameterMaster = ParameterMaster::where("Parameter","CourseList")->where('ParaFilter1',$parameter)->where("ParaFilter2",null)->get('ParaDescription');
       $CommingRoom = ParameterMaster::where("Parameter","Room")->where('ParaFilter1',$parameter)->where("ParaFilter2",null)->get('ParaDescription');

       return response()->json(array('success'=> true, 'data'=>$ParameterMaster,"CommingRoom"=>$CommingRoom));
    }
    public function GetCourseWiseBatch(Request $request)
    {
        $parameter =  $request->id;
        $Location = $request->Location;

       $ParameterMaster = ParameterMaster::where("Parameter","BatchList")->where("Parameter","BatchList")
       ->where("ParaFilter2",$parameter)
       ->where('ParaFilter1',$Location)->get('ParaDescription');
       return response()->json(array('success'=> true, 'data'=>$ParameterMaster));
    }

    
}
