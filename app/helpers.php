<?php
use Spatie\Permission\Models\Role;
use App\Models\FacultyAttendance;
use App\Models\StudentAttendance;
function checkRole($id)
{

    $role= Role::find($id);
    return $role->name;
}
function CheckPermissionExitOrNot($Permisstion,$role_id)
{
    

 
     $get = checkRole($role_id);

       $main_selected_permission = DB::table('permissions as t1')->Join('role_has_permissions as t2','t1.id','=','t2.permission_id')
       ->where('t2.role_id',$role_id)->get();
        // if($get  !="Admin")
        // {
        //     $main_selected_permission1->where('t2.model_id',"=",$role_id);
        // }
        
        // $main_selected_permission = $main_selected_permission1->get();
   


    //  dd($main_selected_permission);
 
    $array=array();

    foreach($main_selected_permission as $chekded_id)
    {
        $array[$chekded_id->id]=['cheked'=>$chekded_id->id];
    }
return  $array;
}

function paraidCreate()
{
    $last = DB::table('parameter_masters')->latest('id')->first('ParaID');
    $get_perfectLast_id=0000;
    if(!empty($last))
    {
         $last = explode('-',$last->ParaID);

        $code = $last[1];
        $get_perfectLast_id  = $code;
        $get_perfectLast_id++;
    }
     if($get_perfectLast_id == 0000)
    {
        $get_perfectLast_id=0001;
    }


    $get_perfectLast_id =  'P-'.$get_perfectLast_id;

    return $get_perfectLast_id = str_pad($get_perfectLast_id, 3, '0', STR_PAD_LEFT);

}

function FacultyCode()
{
    $last = DB::table('faculty')->latest('id')->first('FacultyCode');
    $get_perfectLast_id=0000;
    if(!empty($last))
    {
         $last = explode('-',$last->FacultyCode);

        $code = $last[1];
        $get_perfectLast_id  = $code;
        $get_perfectLast_id++;
    }
     if($get_perfectLast_id == 0000)
    {
        $get_perfectLast_id=0001;
    }


    $get_perfectLast_id =  'PSPF-'.$get_perfectLast_id;

    return $get_perfectLast_id = str_pad($get_perfectLast_id, 3, '0', STR_PAD_LEFT);

}

function StoreNewDateFormat($date)
{
   
    if($date !=""){ return $newDate = date("Y-m-d", strtotime($date)); }else { return false; }
}
function ShowNewDateFormat($date)
{
    if($date !=""){ return date("d-m-Y",strtotime($date)); }else { return false; }
}


function StudentCode()
{
    $last = DB::table('student')->latest('id')->first('StudentCode');
    $get_perfectLast_id=0000;
    if(!empty($last))
    {
         $last = explode('-',$last->StudentCode);

        $code = $last[1];
        $get_perfectLast_id  = $code;
        $get_perfectLast_id++;
    }
     if($get_perfectLast_id == 0000)
    {
        $get_perfectLast_id=0001;
    }


    $get_perfectLast_id =  'PSPS-'.$get_perfectLast_id;

    return $get_perfectLast_id = str_pad($get_perfectLast_id, 3, '0', STR_PAD_LEFT);

}
function StudentRoll()
{
    $last = DB::table('student')->latest('id')->first('RollNo');
    $get_perfectLast_id=0000;
    if(!empty($last))
    {
         $last = explode('-',$last->RollNo);

        $code = $last[1];
        $get_perfectLast_id  = $code;
        $get_perfectLast_id++;
    }
     if($get_perfectLast_id == 0000)
    {
        $get_perfectLast_id=0001;
    }


    $get_perfectLast_id =  'ROLL-'.$get_perfectLast_id;

    return $get_perfectLast_id = str_pad($get_perfectLast_id, 3, '0', STR_PAD_LEFT);

}

function getcountry($country){
	$getcountry = DB::table('countries')->select('name')->where('id',$country)->first();
    return $getcountry->name;
}
function getstate($state){
	$getstate = DB::table('states')->select('name')->where('id',$state)->first();
    return $getstate->name;
}
function getcities($cities){
	$getcities = DB::table('cities')->select('name')->where('id',$cities)->first();
    return $getcities->name;
}

function FacultyAttendanceget($id,$date)
{


    try{
          $facultyatt = FacultyAttendance::where('FacultyCode',$id)->where('CalanderDate',"=",$date)->first(['FacultyCode','InTime','OutTime','AttendanceStatus']);

    }
    catch(Exception $e) {
        $facultyatt =  " "; 
      }
      return $facultyatt;
}

function StudentAttendanceget($id,$date)
{

    try{
          $StudentCode = StudentAttendance::where('StudentCode',$id)->where('LectureDate',"=",$date)->first(['StudentCode','InTime','OutTime','AttendanceStatus']);

    }
    catch(Exception $e) {
        $StudentCode =  " "; 
      }
      return $StudentCode;
}