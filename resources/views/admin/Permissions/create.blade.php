@extends('layouts.app')
@section('content')

<div class="page-body clearfix">
                <!-- Basic Validation -->
             
                @if ($errors->any())
             
                    <div class="alert alert-danger" id="errors_all_page">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading">Module  Create</div>
                        <div class="panel-body">
                            <form method="post" action="{{route('Module.store')}}" id="permission">
                                @csrf
                                <div class="row">

                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Module Type</label>
                                            <select class="form-control" name="ModuleType" id="ModuleType" >
                                            <option value="" Selcted>--Select Module-- </option>

                                                    <option value="Master">Master </option>
                                                    <option value="Sub-Master">Sub-Master</option>
                                                </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 master">
                                        <div class="form-group">
                                                <label> Master </label>
                                                <input type="text"  class="form-control master " name="master" maxlength="30" minlength="3"  />
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6 Submaster">
                                        <div class="form-group">
                                                <label>Sub Master </label>
                                                <input type="text"  class="form-control sub_master" name="sub_master" maxlength="30" minlength="3"  />
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Route Type
                                            </label>
                                            <select class="form-control" name="RouteType" id="RouteTypeId" >
                                            <option value="" Selcted>--Select    Route Type -- </option>
                                                    <option value="resource">Resource</option>
                                                    <option value="custome">Custome</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 custome">
                                        <div class="form-group">
                                                <label>Module  Name</label>
                                                <input type="text"  class="form-control" name="ModuleName" maxlength="30" minlength="3"  />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="Status" id="StatusID" >
                                            <option value="" Selcted>--Select Status -- </option>
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 form_Submit_cancel_btn" > 
                                <button type="submit"   class=" m-w-105 btn btn-sm btn-success">Save</button>
                                <a href="{{route('role.index')}}" type="submit" class=" m-w-105 btn btn-sm btn-danger">Cancel</a>
                                </div>
                            </form>   
                            
                        </div>
                    </div>
                </div>
</div>

            <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> -->

<script>
  $(".Submaster").hide(); 
  $(".master").hide(); 
  
    $('#ModuleType').on('change',function(){
       var  type =  $('#ModuleType').val();
        if(type == "Sub-Master") 
        {
             $(".Submaster").show();
             $(".master").hide(); 
             $(".master").val('');  
        }
        else{ 
            $(".sub_master").val('');  
              $(".Submaster").hide();
             $(".master").show(); 
        }
        });

</script>

@endsection