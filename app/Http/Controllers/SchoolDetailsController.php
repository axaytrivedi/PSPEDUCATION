<?php

namespace App\Http\Controllers;

use App\Models\SchoolDetails;
use Illuminate\Http\Request;
use DB;

class SchoolDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = SchoolDetails::all();
        return view('SchoolDetails.index',compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $details = SchoolDetails::latest();
        return view('SchoolDetails.create',compact('details'));
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
            
            'SchoolName' => 'required',
            'AddressLine1' => 'required',
            'AddressLine2' => 'required',
            'AddressLine3' => 'required',
            'City' => 'required',
            'State' => 'required' ,
            'Country' => 'required',
            'Pin' => 'required',
            'ContactPerson' => 'required',
            'Email' => 'required',
            'Phone1' => 'required',
            'Phone2' => 'required',
            'WhatsAppNo' => 'required',
            'WebsiteLink' =>'required',
            ]);
        $create = SchoolDetails::create([
            'id'=>$request->id,
            'SchoolName' => $request->SchoolName,
            'AddressLine1' => $request->AddressLine1,
            'AddressLine2' => $request->AddressLine2,
            'AddressLine3' => $request->AddressLine3,
            'City' => $request->schoolCity,
            'State' => $request->schoolState,
            'Country' => $request->schoolCountry,
            'Pin' => $request->Pin,
            'ContactPerson' => $request->ContactPerson,
            'Email' => $request->Email,
            'Phone1' => $request->Phone1,
            'Phone2' => $request->Phone2,
            'WhatsAppNo' => $request->WhatsAppNo,
            'WebsiteLink' => $request->WebsiteLink,

        ]);
        return redirect()->route('details.index')->with('msg','Created Successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SchoolDetails  $schoolDetails
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $edit_details = SchoolDetails::findOrFail($id);
        return view('SchoolDetails.show',compact('edit_details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SchoolDetails  $schoolDetails
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_details = SchoolDetails::find($id);
        return view('SchoolDetails.create',compact('edit_details'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SchoolDetails  $schoolDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
        
            'SchoolName' => 'required',
            'AddressLine1' => 'required',
            'AddressLine2' => 'required',
            'AddressLine3' => 'required',
            'City' => 'required',

        ]);
        $Details = SchoolDetails::find($id);
        $Details->SchoolName = $request->SchoolName;
        $Details->AddressLine1 = $request->AddressLine1;
        $Details->AddressLine2 = $request->AddressLine2;
        $Details->AddressLine3 = $request->AddressLine3;
        $Details->City = $request->schoolCity;
        $Details->State = $request->schoolState;
        $Details->Country = $request->schoolCountry;
        $Details->Pin = $request->Pin;
        $Details->ContactPerson = $request->ContactPerson;
        $Details->Email = $request->Email;
        $Details->Phone1 = $request->Phone1;
        $Details->Phone2 = $request->Phone2;
        $Details->WhatsAppNo = $request->WhatsAppNo;
        $Details->WebsiteLink = $request->WebsiteLink;

        $Details->save();
        return redirect()->route('details.index')->with('msg','Updated Successfuly.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolDetails  $schoolDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolDetails $schoolDetails)
    {
        $schoolDetails->delete();
       
        return redirect()->route('details.index')
                         ->with('success','deleted successfully');
    }

    function get_countries(Request $request)
    {
        // print_r($request->get('query'));exit();
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = DB::table('countries')->where('name', 'LIKE', "{$query}%")->where('deleted_at', '=', NULL)->get();
            $response = array();
            if(!$data->isEmpty())
            {
                foreach($data as $row)
                {
                    $response[] = array("value"=>$row->id,"label"=>$row->name);
                }
            }else{
                $response[] = array("value"=>"","label"=>'No record found');
            }

            echo json_encode($response);
            exit;
        }
    }

    function get_state(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $country = $request->get('country');
            $data = DB::table('states')->where('name', 'LIKE', "{$query}%")->where('deleted_at', '=', NULL)->where('country_id',$country)->get();
            $response = array();
            if(!$data->isEmpty())
            {
                foreach($data as $row)
                {
                    $response[] = array("value"=>$row->id,"label"=>$row->name);
                }
            }else{
                $response[] = array("value"=>"","label"=>'No record found');
            }

            echo json_encode($response);
            exit;
        }
    }

    function get_city(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $state = $request->get('state');
            $data = DB::table('cities')->where('name', 'LIKE', "{$query}%")->where('deleted_at', '=', NULL)->where('state_id',$state)->get();
            $data2 = DB::table('cities')
            ->join('states','cities.state_id','states.id')
            ->join('countries','states.country_id','countries.id')
            ->where('cities.name', 'LIKE', "{$query}%")
            ->where('cities.deleted_at', '=', NULL)
            ->select('cities.name','cities.id','cities.state_id','states.name as state_name','countries.name as country_name','states.country_id')
            ->get();
            $response = array();
            if(!$data->isEmpty())
            {
                foreach($data as $row)
                {
                    $response[] = array("value"=>$row->id,"label"=>$row->name);
                }
            }else{
                // foreach($data2 as $row)
                // {
                //     $response[] = array("country_name"=>$row->country_name,"country_id"=>$row->country_id,"state_name"=>$row->state_name,"state_id"=>$row->state_id,"value"=>$row->id,"label"=>$row->name);
                // }
                $response[] = array("value"=>"","label"=>'No record found');
            }

            echo json_encode($response);
            exit;
        }
    }
}
