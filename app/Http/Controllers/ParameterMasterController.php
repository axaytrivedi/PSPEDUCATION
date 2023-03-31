<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParameterMaster;
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
        if($ParameterMaster->ParaDescription =="SubjectsList")
        {

             $SubjectsList = ParameterMaster::where('Parameter',"CourseList")->get(['ParaID','ParaDescription']);
        }
        else
        {
            $SubjectsList =[];
        }
        return view("parameter.create",compact('ParameterMaster','SubjectsList'));
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
    
        $ParaDescription = $request->ParaDescription;
        $Validity = $request->Validity;
        $Validity = $request->Validity;
        $file = $request->file;
        $ParaCode= $request->ParaCode;
     

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
}
