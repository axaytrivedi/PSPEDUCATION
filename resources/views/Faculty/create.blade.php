                            
 @extends('layouts.app')
@section('content')                           

                            <div class="card mb-3">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Faculty</h6> 
                                </div>
                                <div class="card-body">
                                @if ($errors->any())
                                <div class="alert alert-danger" id="errors_all_page">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <form id="facultyform" method="post"
                                    action=" @if(!empty($edit_facultys->id)!=0)  {{route('faculty.update',$edit_facultys->id)}}   @else {{route('faculty.store')}}@endif"
                                    enctype="multipart/form-data">

                                    @if(!empty($edit_facultys->id)) @method('PATCH') @endif @csrf
                                        <div class="row g-3 align-items-center">
                                        <div class="card-header">
                                            <h3 class="card-title">{{isset($edit_facultys)?'Edit':"Add"}} Item</h3>
                                            <a href="{{route('faculty.index')}}" class=" btn  my_btn  ml-auto"> Back</a>
                                        </div>
                                            <div class="col-md-6 form-group ">
                                                <label for="FacultyCode" class=" form-label">FacultyCode</label>
                                                <input type="text" class="form-control" id="FacultyCode" 
                                                name="FacultyCode" readonly value="{{ old('FacultyCode', isset($edit_facultys->FacultyCode) ?  $edit_facultys->FacultyCode  : '' ) }}" >
                                            </div>
                                            <div class="col-md-6 form-group">
                                            <label for="Title" class="form-label">Title</label>
                                                <select class="form-control selectpicker" id="Title" name="Title" data-style="form-control btn-secondary"
                                                value="{{ old('Title', isset($edit_facultys->Title) ?  $edit_facultys->Title  : '' ) }}">
                                                    <option value="Mr">Mr.</option>
                                                    <option value="Ms">Ms.</option>
                                                    <option value="Mrs">Mrs.</option>
                                                    <option value="Dr">Dr.</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">First Name</label>
                                                <input type="text" class="form-control allowCharcterOnly" id="firstName" 
                                                name="firstName" value="{{ old('firstName', isset($edit_facultys->firstName) ?  $edit_facultys->firstName  : '' ) }}">

                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Last Name</label>
                                                <input type="text" class="form-control allowCharcterOnly" id="lastName" 
                                                name="lastName" value="{{ old('lastName', isset($edit_facultys->lastName) ?  $edit_facultys->lastName  : '' ) }}">

                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">DOB</label>
                                                <input type="text" class="form-control" id="DOB" 
                                                name="DOB" value="{{ old('DOB', isset($edit_facultys->DOB) ?  $edit_facultys->DOB  : '' ) }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Date Of Joining</label>
                                                <input type="date" name="DateOfJoining" class="form-control" id="DateOfJoining" 
                                                name="DateOfJoining" value="{{ old('DateOfJoining', isset($edit_facultys->DateOfJoining) ?  $edit_facultys->DateOfJoining  : '' ) }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Gender</label>
                                                <select class="form-control selectpicker" id="Gender" name="Gender" data-style="form-control btn-secondary"
                                                value="{{ old('Gender', isset($edit_facultys->Gender) ?  $edit_facultys->Gender  : '' ) }}">
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Qualification</label>
                                                <input type="text" class="form-control" id="Qualification" 
                                                name="Qualification" value="{{ old('Qualification', isset($edit_facultys->Qualification) ?  $edit_facultys->Qualification  : '' ) }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Role</label>
                                                <select name="Role" class="form-control" >
                                                    <option selected disabled>-- Select Role --</option>
                                                    @foreach($RoleModel as $role)

                                                    <option value="{{$role->id}}" @if(isset($edit_facultys->Role) && $role->id)  selected @endif>  {{$role->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Email Id</label>
                                                <input type="text" class="form-control" id="email" 
                                                name="email" value="{{ old('email', isset($edit_facultys->email) ?  $edit_facultys->email  : '' ) }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Mobile No</label>
                                                <input type="number" class="form-control" id="MobileNo" 
                                                name="MobileNo" value="{{ old('MobileNo', isset($edit_facultys->MobileNo) ?  $edit_facultys->MobileNo  : '' ) }}">
                                            </div>
                                            @if(!isset($edit_facultys->id))
                                                <div class="col-md-6 form-group">
                                                    <label  class="form-label">Password *</label>
                                                    <input type="password" class="form-control" id="password" 
                                                    name="password" value="{{ old('password', isset($edit_facultys->password) ?  $edit_facultys->password  : '' ) }}">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label  class="form-label">Re Type Password *</label>
                                                    <input type="password" class="form-control" id="retypePassword" 
                                                    name="retypePassword" value="{{ old('retypePassword')}}">
                                                </div>
                                            @endif

                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">WorkingStartTime</label>
                                                <input type="time" class="form-control" id="WorkingStartTime" 
                                                name="WorkingStartTime" value="{{ old('WorkingStartTime', isset($edit_facultys->WorkingStartTime) ?  $edit_facultys->WorkingStartTime  : '' ) }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">WorkingEndTime</label>
                                                <input type="time" class="form-control" id="WorkingEndTime" 
                                                name="WorkingEndTime" value="{{ old('WorkingEndTime', isset($edit_facultys->WorkingEndTime) ?  $edit_facultys->WorkingEndTime  : '' ) }}">
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">AddressLine 1</label>
                                                <input type="text" class="form-control" id="AddressLine1" 
                                                name="AddressLine1" value="{{ old('AddressLine1', isset($edit_facultys->AddressLine1) ?  $edit_facultys->AddressLine1  : '' ) }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">AddressLine  2</label>
                                                <input type="text" class="form-control" id="AddressLine2" 
                                                name="AddressLine2" value="{{ old('AddressLine2', isset($edit_facultys->AddressLine2) ?  $edit_facultys->AddressLine2  : '' ) }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">AddressLine  3</label>
                                                <input type="text" class="form-control" id="AddressLine3" 
                                                name="AddressLine3" value="{{ old('AddressLine3', isset($edit_facultys->AddressLine3) ?  $edit_facultys->AddressLine3  : '' ) }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Status</label>
                                                <select class="form-control selectpicker" id="Status" name="Status" data-style="form-control btn-secondary"
                                                 value="{{ old('Status', isset($edit_facultys->Status) ?  $edit_facultys->Status  : '' ) }}">
                                                    <option value="OnRoll">OnRoll</option>
                                                    <option value="Left">Left</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="form-control custom-file-input" id="check_img" name="image">
                                                        <label class="custom-file-label form-control" for="image">Choose file</label>
                                                    </div>
                                                    <input type="hidden" name="image_2" @if(!empty($edit_facultys->image)) value="{{$edit_facultys->image}}" @endif>
                                                            
                                                        
                                                        @php
                                                        $img="no_preview.png";
                                                      
                                                                if(isset($edit_facultys->image))
                                                                {
                                                                    $filename =  public_path('Admin/Users/'. $edit_facultys->image);
    
                                                                    if($edit_facultys->image != '' && file_exists($filename))
                                                                    {
                                                                        $img='Users/'.$edit_facultys->image;
                                                                        
                                                                    }
                                                                }
                                                            
                                                    @endphp
                                                    
                                                    <img src="{{ URL::asset('Admin/'. $img) }}" id="showMe" alt="" width="300" height="150" class="img">
    
                                            </div>
                                             
                                        </div>
                                            <button type="submit" class="btn btn-success mt-4">@if(!empty($edit_facultys->id))
                                                Update @else Save @endif</button>
                                            <a href="{{route('faculty.index')}}" type="submit"
                                                class=" m-w-105 btn btn-danger mt-4">Cancel</a>
                                    </form>
                                </div>
                            </div>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.js">></script>

<script>

    var minDate= new Date();

    $("#DOB" ).datepicker({

        minDate: new Date(),
    });
    
$('#facultyform').validate({
    rules: {
        // FacultyCode: {
        //     required: true
        // },
        Title: {
            required: true
        },
        FacultyName: {
            required: true
        },
        DOB: {
            required: true
        },
        DateOfJoining: {
            required: true
        },
        Gender: {
            required: true
        },
        Qualification: {
            required: true
        },
        WorkingStartTime: {
            required: true
        },
        WorkingEndTime: {
            required: true
        },
        Status: {
            required: true
        },
        password: {
            required:true
        },
        retypePassword: {
            equalTo: "#password"
        },
        MobileNo: {
            required: true,
            minlength: 10,
            maxlength: 10,
            number:true
        },
    },
    messages: {
        // FacultyCode: {
        //     required: "Please enter FacultyCode "
        // },
        Title: {
            required: "Please enter Title "
        },
        FacultyName: {
            required: "Please enter FacultyName "
        },

        DOB: {
            required: "Please enter DOB "
        },
        DateOfJoining: {
            required: "Please enter DateOfJoining "
        },
        Gender: {
            required: "Please enter Gender "
        },
        Qualification: {
            required: "Please enter Qualification "
        },
        WorkingStartTime: {
            required: "Please enter WorkingStartTime "
        },
        WorkingEndTime: {
            required: "Please enter WorkingEndTime "
        },
       Status: {
            required: "Please enter Status "
        },
        retypePassword:{
            equalTo: "Password and Re Enter Password Not Same"
        },
        MobileNo: {
            required: "Please enter mobile no. ",
            minlength: "Please altist 10 digits. ",
            maxlength: "More than 10 digits ",
            number: "Enter valid Number"
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
</script>
@endsection