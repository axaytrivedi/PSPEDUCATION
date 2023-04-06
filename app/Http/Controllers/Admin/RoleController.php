<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\RoleModel;
use Illuminate\Support\Facades\Input;
// use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Session;
use Auth;
        
class RoleController extends Controller
{
    function __construct()
    {


        //  $this->middleware('permission:Role-index|Role-create|Role-show|Role-destroy', ['only' => ['index','show']]);
        //  $this->middleware('permission:Role-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:Role-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:Role-destroy', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(auth()->user()->can('Role-index'));
        // if(auth()->user()->can('Role-index')) 
        // {
        // $role = Role::create(['name' =>'Admin',"status"=>'Active',"description"=>"Admin"]);
            $roles = Role::where('status','Active')->orderByDESC('id')->get();

            return view("admin.Role.index",compact('roles'));
        // }
        // else
        // {
        //     $auth =Auth::user();
        //   return view('errors.custome_404',compact('auth'));
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
            return view("admin.Role.create");
      
        
            
    
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
                'role_name' => 'required|unique:roles,name,NULL,id,deleted_at,NULL',
                // 'role_name' => 'required|unique:role_models|max:255',
               
            
            ]);
           
            
            $role = Role::create(['name' =>$request->role_name,"status"=>$request->status,"description"=>$request->Description]);
            // $role = RoleModel::create(["role_name"=>$request->role_name,]);
            session()->flash('msg', 'Role Created Successfuly.');
            
            return redirect()->route('role.index');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
       
       
            $edit_role =  Role::find($id);

            return view("admin.Role.show",compact('edit_role'));
       

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
            $edit_role = Role::find($id);
       
        return view("admin.Role.edit",compact('edit_role'));  
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

     
            $request->validate([

                // 'role_name' => 'required|unique:roles,name,'.$id.',id,deleted_at,NULL',
                'role_name'=>  'required|unique:roles,name,NULL,id,deleted_at,NULL'.$id,
            ]);


            $auth =Auth::user()->comp_id;
            $role = Role::where('id',$id)->update(['name' =>$request->role_name,"status"=>$request->Status,"description"=>$request->Description,'comp_id'=>$auth]);
            session()->flash('msg', 'Role Updated Successfuly.');
           return  redirect()->route('role.index');
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    { 
       
            $Roles = Role::find($request->id)->delete();
            return response()->json(['success'=>'Role deleted successfully.']);
        
    }
    public function Status(Request $request)
    {
      
            $id_array = $request->id;
            $flag= $request->value;

            $Roles = Role::whereIn('id',$id_array)->update(["status"=>$flag]);
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
