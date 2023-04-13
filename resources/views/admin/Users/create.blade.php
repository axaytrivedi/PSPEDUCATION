@extends('layouts.app')
@section('content')

<div class="page-body clearfix">
                <!-- Basic Validation -->
                <!-- <div class="alert alert-success">
                
                </div> -->
                
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
                    <div class="panel-heading">User Create</div>
                        <div class="panel-body">
                            <form id="UserForm" method="post" action=" @if(!empty($edit_users->id)!=0)  {{route('user.update',$edit_users->id)}}   @else {{route('user.store')}}@endif" enctype="multipart/form-data">
                    
                                @if(!empty($edit_users->id))
                                     @method('PATCH')
                                @endif
                                     @csrf
                                <div class="row">
                                    
                                     
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First Name  <span class="required">*</span></label>
                                            <input type="text"  class="form-control allowCharcterOnly" name="first_name"  value="{{ old('first_name', isset($edit_users->first_name) ?  $edit_users->first_name  : '' ) }}"  />
                                        
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Name <span class="required">*</span></label>
                                            <input type="text"  class="form-control allowCharcterOnly" name="last_name" value="{{  old('last_name', isset($edit_users->last_name) ?  $edit_users->last_name  : '' ) }}" />
                                        
                                        </div>
                                    </div>
    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email Address  <span class="required">*</span></label>
                                            <input type="email"  class="form-control" name="email"   value="{{  old('email', isset($edit_users->email) ?  $edit_users->email  : '' ) }}"  />
                                        
                                        </div>
                                    </div>
                                
                                    @if(!isset($edit_users->password))
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Password  <span class="required">*</span></label>
                                            <input type="password"  class="form-control" name="password" maxlength="10" minlength="3"  />
                                        
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Roles  <span class="required">*</span></label>
    
    
                                            @php $id = auth()->user()->id; @endphp
                                            <select class="form-control" name="UserType">
                                            <option selected disabled>User Type</option>
                                                 @foreach($roles as $role)
                                                   
                                                    <option value=" {{$role->id}}" {{  old('UserType', (isset($edit_users->email) && $edit_users->Role == $role->id ) ? 'selected' : '') }}   >{{$role->name}}</option>
                                                 @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="country"> Country <span class="required">*</span></label>
                                            <input type="text" id="country" name="country" onchange="changecountry();"
                                                value="{{ old('country', isset($Countries->name) ? $Countries->name : '' )  }}"
                                                class="form-control">
                                            <input type="hidden" name="user_country" id='user_country' value="{{ old('user_country', isset($Countries->id) ? $Countries->id : '' )  }}">
    
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                         
                                            <label for="state"> State <span class="required">*</span></label>
                                            <input type="text" id="state" name="state" onchange="changestate();"
                                                value="{{ old('state', isset($States->name) ? $States->name : '' )  }}"
                                                class="form-control">
                                                <input type="hidden" name="user_state" id='user_state' value="{{ old('user_state', isset($States->id) ? $States->id : '' )  }}">
                                        </div>
                                    </div>
                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                         
                                        <label for="city"> City <span class="required">*</span></label>
                                        <input type="text" id="city" name="city"
                                                value="{{ old('city', isset($Cities->name) ? $Cities->name : '' )  }}"
                                                class="form-control">
                                                <input type="hidden" name="user_city" id='user_city' value="{{ old('user_city', isset($Cities->id) ? $Cities->id : '' )  }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Company <span class="required">*</span></label>
                                            <select  class="form-control" name="comp_id">    
                                                <option selected Disabled>Select Company</option>
                                                @foreach($Company as $comp)
                                                <option value="{{$comp->id}}" {{ (old('comp_id') == $comp->id || (isset($edit_users->comp_id)) && $edit_users->comp_id  ==  $comp->id)  ? "selected" : "" }}>{{ucfirst($comp->company_name)}}</option>
    
                                                @endforeach
    
                                            </select>
                                        
                                        </div>
                                    </div> 
    
                                    <div class="col-md-6">
                                        <label for="image">Status  </label>
                                            <div class="custom-file">
                                                <select class="form-control" name="user_status" >
                                                    <option value="Active" {{(isset($edit_users->user_status) && $edit_users->user_status=='Active')?'selected':'' }}>Active</option>
                                                    <option value="Inactive"  {{( isset($edit_users->user_status) && $edit_users->user_status=='Inactive')?'selected':'' }}>Inactive</option>
                                                </select>
                                            </div>
                                        
                                    </div> 
                                 
                                    <div class="col-md-6">
                                        <label for="image">User Image  </label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="check_img" name="image">
                                                        <label class="custom-file-label" for="image">Choose file</label>
                                                    </div>
                                                    <input type="hidden" name="image_2" @if(!empty($edit_users->Image)) value="{{$edit_users->Image}}" @endif>
                                                            
                                                        
                                                        @php
                                                        $img="no_preview.png";
                                                            
                                                                if(isset($edit_users->Image))
                                                                {
                                                                    $filename =  public_path('Admin/Users/'. $edit_users->Image);
    
                                                                    if($edit_users->Image != '' && file_exists($filename))
                                                                    {
                                                                        $img='Users/'.$edit_users->Image;
                                                                        
                                                                    }
                                                                }
                                                            
                                                    @endphp
                                                    
                                                    <img src="{{ URL::asset('Admin/'. $img) }}" id="showMe" alt="" width="300" height="150" class="img">
    
                                    </div>  
                                </div>
                                &nbsp;
                                <div class="row">
                                    <div class="form-group col-sm-12 form_Submit_cancel_btn" > 
    
                                        <button type="submit"   class=" m-w-105 btn btn-sm btn-success">@if(!empty($edit_users->id)) Update @else Save @endif</button>
            
            
                                            <a href="{{route('user.index')}}" type="submit" class=" m-w-105 btn btn-sm btn-danger">Cancel</a>
                                        </div>    
                                </div>    
                            </form>
                        </div>
                       
                    </div>
                </div>
           
            </div>

            <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> -->

<script>
$( document ).ready(function() {

    
    $('#UserForm').validate({
        rules: {
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            email: {
                required: true
            },
            password: {
                required: true
            },
            
            UserType: {
                required: true
            },
            
            country: {
                required: true
            },
            
            state: {
                required: true
            },
            city: {
                required: true
            },
            
        },
        messages: {
            firstName: {
                required: "Please enter First Name "
            },
            lastName: {
                required: "Please enter Last Name"
            },
            email: {
                required: "Please enter Email-Id"
            },
            password: {
                required: "Please enter password"
            },
            UserType: {
                required: "Please Select User Type"
            },
            country: {
                required: "Please enter country Name"
            },
            state: {
                required: "Please enter state Name"
            },
            city: {
                required: "Please enter city"
            },
   
        },
     
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });




    $("#country").autocomplete({
        source: function( request, response ) {
            var _token = $('input[name="_token"]').val();
          // Fetch data
          $.ajax({
            url:"{{route('all.get_countries')}}",
            type: 'post',
            dataType: "json",
            data: {
               _token: _token,
               query: request.term
            },
            success: function( data ) {
                //alert(data);
               response( data );
            }
          });
        },
        select: function (event, ui) {
            event.preventDefault();
            if(ui.item.value!='No record found'){
                $('#country').val(ui.item.label);
                $('#user_country').val(ui.item.value);
            }
            else{
                $('#country').val('');
                $('#user_country').val('');
            }
           return false;
        },
        focus: function (event, ui) {
            event.preventDefault();
            this.value = ui.item.label;
            if(ui.item.value!='No record found'){
                $("#country").val(ui.item.label);
                $('#user_country').val(ui.item.value);
            }
            else{
                $('#country').val('');
                $('#user_country').val('');
            }
        }
    });

    $("#state").autocomplete({
        source: function( request, response ) {
            var _token = $('input[name="_token"]').val();
            var country = $("#user_country").val();
          // Fetch data
          $.ajax({
            url:"{{route('all.get_state')}}",
            type: 'post',
            dataType: "json",
            data: {
               _token: _token,
               query: request.term,
               country:country
            },
            success: function( data ) {
                //alert(data);
               response( data );
            }
          });
        },
        select: function (event, ui) {
            event.preventDefault();
            if(ui.item.value!='No record found'){
                $('#state').val(ui.item.label);
                $('#user_state').val(ui.item.value);
            }
            else{
                $('#state').val('');
                $('#user_state').val('');
            }
           return false;
        },
        focus: function (event, ui) {
            event.preventDefault();
            this.value = ui.item.label;
            if(ui.item.value!='No record found'){
                $("#state").val(ui.item.label);
                $('#user_state').val(ui.item.value);
            }
            else{
                $('#state').val('');
                $('#user_state').val('');
            }
        }
    });

    $("#city").autocomplete({
        source: function( request, response ) {
            var _token = $('input[name="_token"]').val();
            var state = $("#user_state").val();
          // Fetch data
          $.ajax({
            url:"{{route('all.get_city')}}",
            type: 'post',
            dataType: "json",
            data: {
               _token: _token,
               query: request.term,
               state:state
            },
            success: function( data ) {
                //alert(data);
               response( data );
            }
          });
        },
        select: function (event, ui) {
            event.preventDefault();
            if(ui.item.value!='No record found'){
                $('#city').val(ui.item.label);
                $('#user_city').val(ui.item.value);
            }
            else{
                $('#city').val('');
                $('#user_city').val('');
            }
           return false;
        },
        focus: function (event, ui) {
            event.preventDefault();
            this.value = ui.item.label;
            if(ui.item.value!='No record found'){
                $("#city").val(ui.item.label);
                $('#user_city').val(ui.item.value);
            }
            else{
                $('#city').val('');
                $('#user_city').val('');
            }
        }
    });

// State 



//End State


// Cities 




// End Cities 

function changecountry(){
    $("#state").val('');
    $("#user_state").val('');
    $("#user_city").val('');
    $("#city").val('');
}

function changestate(){
    $("#city").val('');
    $("#account_city").val('');
}

$('#check_img').change(function(){
    const file = this.files[0];
    if (file){
        let reader = new FileReader();
        reader.onload = function(event){
        console.log(event.target.result);
        $('#showMe').attr('src', event.target.result);
        }
        reader.readAsDataURL(file);
    }
});
});
</script>
@endsection