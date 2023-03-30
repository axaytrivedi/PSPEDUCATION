<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Models\Admin\RoleModel;
use App\Models\Admin\Countries;
use App\Models\Admin\Cities;
use App\Models\Admin\States;

use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
USE DB;
use App\Models\Admin\Company;
class UserControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $users = User::where('deleted_at',NULL)->orderByDESC('id')->get();

        return view("admin.Users.index",compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $edit_users= "";
        $Countries = "";
        $States  = "";
        $Cities = "";

        $Company = Company::get();
      
       return view('admin.Users.create',compact('edit_users','roles','Countries','States','Cities','Company'));
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
            'email' => 'required|unique:users,email,deleted_at',

            'first_name' => 'required|regex:/^[a-zA-Z]+$/u',
            'last_name' => 'required|regex:/^[a-zA-Z]+$/u',
            'password' => 'required',
            'UserType' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'user_status' => 'required',
         
         
        ]);

        $comp_id = (isset(Compnay()->id))?Compnay()->id :1;
        $users = User::create([
                            'first_name' => $request->first_name,
                            'last_name' => $request->last_name,
                            'email' => $request->email,
                            'password' =>Hash::make($request->password),
                            'Role' => $request->UserType,
                            'Country' => $request->user_country,
                            'State' => $request->user_state,
                            'city' => $request->user_city,
                            'user_status' => $request->user_status,
                            'comp_id'=>$comp_id,
                            'Image' =>(isset($filename)?$filename :NULL),
                            'comp_id'=>$request->comp_id,
                            ]);

                        
        $users->assignRole($request->UserType);

        session()->flash('msg', 'User Created Successfuly.');
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $edit_users= User::findOrFail($id);
        $roles = Role::all();
         $Countries = Countries::findOrFail($edit_users->Country);
        $States  = States::findOrFail($edit_users->State);


        $Cities = Cities::findOrFail($edit_users->city);
        return view('admin.Users.show',compact('edit_users','Countries','States','Cities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
   
        $roles = Role::all();
        $edit_users= User::find($id);

       
        $Countries = Countries::find($edit_users->Country);
          $States  = States::find($edit_users->State);


        $Cities = Cities::find($edit_users->city);
        $Company = Company::get();
        return view('admin.Users.create',compact('edit_users','roles','Countries','States','Cities','Company'));
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
       
        $img =   $request->file('image');

        if(!empty($img) && $img->getClientOriginalName() != "" )
        {  
            $filename= $img->getClientOriginalName();

            $img->move(public_path('Admin/Users'),$filename);
          
        }
       
        $request->validate([
            'email' => 'required|unique:users,email,'.$id.',id,deleted_at,NULL',

            'first_name' => 'required|regex:/^[a-zA-Z]+$/u',
            'last_name' => 'required|regex:/^[a-zA-Z]+$/u',
             
            'UserType' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'user_status' => 'required',
         ]);




   
        $User = User::find($id);
        $User->first_name=$request->first_name;
        $User->last_name=$request->last_name;
        $User->email=$request->email;
        $User->Role=$request->UserType;
        $User->Country=$request->user_country;
        $User->city=$request->user_city;
        $User->user_status=$request->user_status;

        $User->comp_id = $request->comp_id;
        if(isset($filename)){     $User->Image=$filename;}
        $User->save();                  
        
        DB::table('model_has_roles')->where('model_id',$id)->delete();  
           
        $User->assignRole($request->UserType);

        
        session()->flash('msg', 'User Updated Successfuly.');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $User = User::find($request->id)->delete();
        return response()->json(['success'=>'User deleted successfully.']);
    }

    public function Status(Request $request)
    {
        $id_array = $request->id;
        $flag= $request->value;
        $Roles = User::whereIn('id',$id_array)->update(["user_status"=>$flag]);
        if($Roles == true)
        {
            return response()->json(['msg'=>1]);
        }
        else
        {
            return response()->json(['msg'=>0]);
        }
    }
}
