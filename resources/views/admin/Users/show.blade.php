@extends('layouts.app')

@section('content')

<div class="page-body">
       
                <div class="alert {{(Session::has('msg') !='')? 'alert-success':''}}" id="Updaste" >
                     {!! Session::has('msg') ? Session::get("msg") : '' !!}
                </div>
    <div class="panel panel-default">
        <div class="panel-heading"> User Show  
            <div class="action_btn_box">
                
            </div>
        </div>
    
        <!-- <div class="panel-heading"> 
            <button class="btn btn-primary" >sdfsdf</button>
           </div> -->
        
            <div class="panel-body">
                <hr>
            <table  class="table table-responsive">

                <tr>
                    <td><b>Frist Name</b></td>
                    <td>:</td>
                    <td>{{$edit_users->first_name}}</td>
                </tr>

                <tr>
                    <td><b>Last Name</b></td>
                    <td>:</td>
                    <td>{{$edit_users->last_name}}</td>
                </tr>
                <tr>
                    <td><b>Email</b></td>
                    <td>:</td>
                    <td>{{$edit_users->email}}</td>
                </tr>
                <tr>
                    <td><b>User Type </b></td>
                    <td>:</td>
                    <td>{{getrolesName($edit_users->Role) }}</td>
                </tr>
                <tr>
                    <td><b>Country </b></td>
                    <td>:</td>
                    <td>{{$Countries->name}}</td>
                </tr>
                <tr>
                    <td><b>State</b></td>
                    <td>:</td>
                    <td>{{$States->name}}</td>
                </tr>

                <tr>
                    <td><b>City</b> </td>
                    <td>:</td>
                    <td>{{$Cities->name}}</td>
                </tr>
                <tr>
                    <td><b>Image </b> </td>
                    <td>:</td>
                    <td>
                        @php
                                        if(isset($edit_users->Image))
                                        {
                                            $filename =  public_path('Admin/Users/'. $edit_users->Image);

                                            if($edit_users->Image != '')
                                            {
                                                $img='Users/'.$edit_users->Image;
                                                
                                            }
                                        }
                                        else{
                                            $img="no_preview.png";
                                        }
                                            
                  
                               @endphp
                               <img src="{{ URL::asset('Admin/'. $img) }}" alt="" width="300" height="150" class="img">
                              
                    </td>
                </tr>

        </table>
            <div class="col-md-12 form_Submit_cancel_btn" > 


                <a href="{{route('user.index')}}" type="submit" class=" m-w-105 btn btn-sm btn-danger">Cancel</a>
            </div> 
            </div>
        </div>

    </div>
</div>

@endsection