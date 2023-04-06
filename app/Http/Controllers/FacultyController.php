<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Hash;
class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $facultys = Faculty::where('Status','OnRoll')->get();
        // return view('Faculty.index',compact('facultys'));

        if ($request->ajax()) {

            $data = Faculty::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('status', function($row){
                         if($row->status){
                            return '<span class="badge badge-primary">OnRoll</span>';
                         }else{
                            return '<span class="badge badge-danger">Left</span>';
                         }
                    })
                    ->filter(function ($instance) use ($request) {
                        if ($request->get('status') == '0' || $request->get('status') == '1') {
                            $instance->where('status', $request->get('status'));
                        }
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                $w->orWhere('facultycode', 'LIKE', "%$search%")
                                ->orWhere('facultyname', 'LIKE', "%$search%");
                            });
                        }
                    })
                    ->rawColumns(['status'])
                    ->make(true);
        }
                return view('Faculty.index',compact('facultys'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $RoleModel =Role::where('status','Active')->orderByDESC('id')->get();
        $facultys = Faculty::latest();
        return view('Faculty.create',compact('facultys','RoleModel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        $img =   $request->file('image');

     
        if(!empty($img) && $img->getClientOriginalName() != "" )
        {  
            $filename= $img->getClientOriginalName();
            $img->move(public_path('Admin/Users'),$filename);
        }

        $request->validate([
            'email' => 'required|unique:faculty,email,deleted_at',
            
            'Title' => 'required',

            'DOB' => 'required',
            'DateOfJoining' => 'required',
            'Gender' => 'required',
            'Qualification' => 'required',
            'WorkingStartTime' => 'required',
            'WorkingEndTime' => 'required',
            'Status' => 'required',
            ]);



   
        $create = Faculty::create([
            'id'=>$request->id,
            'FacultyCode' => FacultyCode(),
            'Title' => $request->Title,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'DOB' => $request->DOB,
            'DateOfJoining' => $request->DateOfJoining,
            'Gender' => $request->Gender,
            'Qualification' => $request->Qualification,
            'WorkingStartTime' => $request->WorkingStartTime,
            'WorkingEndTime' => $request->WorkingEndTime,
            'email'=>$request->email,
            'AddressLine1'=>$request->AddressLine1,
            'AddressLine2'=>$request->AddressLine2,
            'AddressLine3'=>$request->AddressLine3,
            'MobileNo'=>$request->MobileNo,

            'image'=>(isset($filename))?$filename:" ",
            'Role'=>$request->Role,
            'Status' => $request->Status,
        ]);
        if(isset($create->id))
        {   
            
        
                try{
                    $User= User::create([  'firstName' => $request->firstName,
                                        'lastName' => $request->lastName,
                                        'Role'=>$create->Role,
                                        'email'=>$request->email,
                                        'password'=>Hash::make($request->password),
                                        'Image'=>(isset($filename))?$filename:" ",
                                        'user_status'=>"Active",
                                    ]);
                    }
                    catch(Exception $e) 
                    {
                        Faculty::find($create->id)->delete();
                    }
              
            

                       
        }
        else
        {
           
        }

        return redirect()->route('faculty.index')->with('msg','Created Successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $edit_facultys = Faculty::findOrFail($id);
        return view('Faculty.show',compact('edit_facultys'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $RoleModel =Role::where('status','Active')->orderByDESC('id')->get();
        $edit_facultys = Faculty::find($id);
        return view('Faculty.create',compact('edit_facultys','RoleModel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
        
            
            'Title' => 'required',
       
            'DOB' => 'required',
            'DateOfJoining' => 'required',
            'Gender' => 'required',
            'Qualification' => 'required',
            'WorkingStartTime' => 'required',
            'WorkingEndTime' => 'required',
            'Status' => 'required',

        ]);

        $img =   $request->file('image');

     
        if(!empty($img) && $img->getClientOriginalName() != "" )
        {  
            $filename= $img->getClientOriginalName();
            $img->move(public_path('Admin/Users'),$filename);
        }
        $facultys = Faculty::find($id);
        $facultys->FacultyCode = FacultyCode();
        $facultys->Title = $request->Title;
        $facultys->firstName = $request->firstName;
        $facultys->lastName = $request->lastName;
        $facultys->DOB = $request->DOB;
        $facultys->DateOfJoining = $request->DateOfJoining;
        $facultys->Gender = $request->Gender;
        $facultys->Qualification = $request->Qualification;
        $facultys->WorkingStartTime = $request->WorkingStartTime;
        $facultys->WorkingEndTime = $request->WorkingEndTime;
        $facultys->email=$request->email;
        $facultys->AddressLine1=$request->AddressLine1;
        $facultys->AddressLine2=$request->AddressLine2;
        $facultys->AddressLine3=$request->AddressLine3;
        $facultys->MobileNo=$request->MobileNo;
        if(isset($filename)){    
             $facultys->image=$filename;
        }
       
        $facultys->Status = $request->Status;
        $facultys->save();

        $email = $facultys->email;
        if(isset($email))
        {
       
            $User = User::where("email",$email)->first();
            $User->user_status="In-Active";
            $User->save();
            
        } 
        return redirect()->route('faculty.index')->with('msg','Updated Successfuly.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        

        // $status = $faculty->id;
        // $Faculty = Faculty::find($status);
        // $Faculty->Status="Left";
        // $Faculty->save();
       

        // session()->flash('msg', 'Faculty Now Left successfully.');
        
        // return redirect()->route('faculty.index');
                     
    }
    public function FacultyDelete(Request $request)
    {
      
        
        $status = $faculty->id;
        $Faculty = Faculty::find($status)->delete();
        
        if($Faculty == true)
        {
            return response()->json(['msg'=>1]);
        }
        else
        {
            return response()->json(['msg'=>0]);
        }
      
    }

    // public function listfaculty(Request $request)
    // {
    //     $id = $request->id;
    //     $faculty =  Faculty::where('Parameter',$id)->first();
    //     $html = view('Parametermaster.index',compact('parameters'))->render();
    //     return response()->json(array('success'=> true,'html'=>$html)); 
    // }
}
