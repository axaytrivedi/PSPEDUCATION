                            
 @extends('layouts.app')
@section('content')                           

                            <div class="card mb-3">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Students</h6> 
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
                                <form id="studentform" method="post"
                                    action=" @if(!empty($edit_students->id)!=0)  {{route('student.update',$edit_students->id)}}   @else {{route('student.store')}}@endif"
                                    enctype="multipart/form-data">

                                    @if(!empty($edit_students->id)) @method('PATCH') @endif @csrf
                                        <div class="row g-3 align-items-center">

                                        <div class="col-sm-3 form-group">
                                            <label class="form-label">Title</label>
                                            <select class="form-control selectpicker" id="Title" name="Title" data-style="form-control btn-secondary"
                                            value="{{ old('Title', isset($edit_students->Title) ?  $edit_students->Title  : '' ) }}">
                                                <option value="">--Select Title--</option>
                                                <option value="Mr"  @if(isset($edit_students->Title) && $edit_students->Title == 'Mr') selected @endif >Mr.</option>
                                                <option value="Ms"  @if(isset($edit_students->Title) && $edit_students->Title == 'Ms') selected @endif >Ms.</option>
                                                <option value="Mrs"  @if(isset($edit_students->Title) && $edit_students->Title == 'Mrs') selected @endif >Mrs.</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6 form-group">
                                                <label class="form-label ">Student Name</label>
                                                <input class="form-control allowCharcterOnly"  type="text" id="StudentName" placeholder= "Enter Student Name"
                                                name="StudentName" value="{{ old('StudentName', isset($edit_students->StudentName) ?  $edit_students->StudentName  : '' ) }}">
                                        </div>
                                        <div class="col-md-6 col-sm-12 form-group">
                                                <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                                                <input class="form-control"  type="text" id="mobile" placeholder= "Enter Mobile Number"
                                                name="mobile" value="{{ old('mobile', isset($edit_students->mobile) ?  $edit_students->mobile  : '' ) }}">
                                        </div>
                                        <div class="col-md-6 col-sm-12 form-group">
                                            <label class="form-label">Email <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control"  id="email" 
                                                name="email" value="{{ old('email', isset($edit_students->email) ?  $edit_students->email  : '' ) }}">
                                        </div>

                                            <div class="col-md-6 form-group">
                                                <label for="firstname" class="form-label">Student Code</label>
                                                <input type="text" readonly class="form-control" id="StudentCode" 
                                                name="StudentCode" value="{{ old('StudentCode', isset($edit_students->StudentCode) ?  $edit_students->StudentCode  : '' ) }}" >
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="lastname" class="form-label">Roll No</label>
                                                <input type="text" readonly class="form-control" id="RollNo" 
                                                name="RollNo" value="{{ old('RollNo', isset($edit_students->RollNo) ?  $edit_students->RollNo  : '' ) }}">

                                            </div>
                                            <!-- <div class="col-md-6 form-group">
                                                <label  class="form-label">Student Name</label>
                                                <input type="text" class="form-control" id="StudentName" 
                                                name="StudentName" value="{{ old('StudentName', isset($edit_students->StudentName) ?  $edit_students->StudentName  : '' ) }}">

                                            </div> -->
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">DOB</label>
                                                <input type="date" class="form-control" id="DOB" 
                                                name="DOB" value="{{ old('DOB', isset($edit_students->DOB) ?  $edit_students->DOB  : '' ) }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Date Of Joining</label>
                                                <input type="date" name="DateOfJoining" class="form-control" id="DateOfJoining" 
                                                name="DateOfJoining" value="{{ old('DateOfJoining', isset($edit_students->DateOfJoining) ?  $edit_students->DateOfJoining  : '' ) }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Gender</label>
                                           
                                                <select class="form-control selectpicker" id="Gender" name="Gender" data-style="form-control btn-secondary">
                                                    <option value="">Select Gender</option>
                                                    <option value="Male"  @if(isset($edit_students->Gender) && $edit_students->Gender == 'Male') selected @endif >Male</option>
                                                    <option value="Female"@if(isset($edit_students->Gender) && $edit_students->Gender == 'Female') selected @endif >Female</option>

                                                </select>
                                            </div>

                                            
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Select Location</label>

                                                <select  class="form-control" id="Location" name="Location" >
                                                <option value="">Select Location</option>
                                                    @if(isset($Location) && !empty($Location))
                                                   
                                                        @foreach($Location as $l)
                                                        <option value="{{$l->ParaDescription}}" {{old('CourceCode')}}
                                                            {{ old('Location', isset($edit_students->Location) ? $edit_students->Location : '')==$l->ParaDescription ? 'selected' : '' }}> {{$l->ParaDescription}}</option>
                                                        @endforeach
                                                    @endif

                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Course Code</label>

                                                <select  class="form-control" id="CourceCode" name="CourceCode" >
                                                <option value="">Select Course Code</option>
                                                    @foreach($CourseList as $clist)
                                                        <option value="{{$clist->ParaDescription}}" {{old('CourceCode')}}
                                                        {{ old('CourceCode', isset($edit_students->CourceCode) ? $edit_students->CourceCode : '')==$clist->ParaDescription ? 'selected' : '' }}>{{$clist->ParaCode}} / {{$clist->ParaDescription}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Batch Code</label>

                                                <select   class="form-control" id="BatchCode"  name="BatchCode" >
                                                <option value="">Select Batch Code</option>
                                                    @foreach($batchCode as $blist)
                                                        <option value="{{$blist->ParaDescription}}" {{old('BatchCode')}}
                                                     

                                                        {{ old('BatchCode', isset($edit_students->BatchCode) ? $edit_students->BatchCode : '')==$blist->ParaDescription ? 'selected' : '' }}
                                                        >{{$blist->ParaDescription}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">

                                                <label  class="form-label">Academic Session</label>

                                                <label  class="form-label">Academin Session</label>

                                                <input type="text" class="form-control" id="AcademinSession"  placeholder= "Enter Admission Session"
                                                name="AcademinSession" value="{{ old('AcademinSession', isset($edit_students->AcademinSession) ?  $edit_students->AcademinSession  : '' ) }}">
                                            </div>
                                            <div class="col-md-6 form-group">

                                                <label  class="form-label">Address Line 1</label>

                                                <label  class="form-label">AddressLine 1</label>

                                                <input type="text" class="form-control" id="AddressLine1" placeholder= "Enter Address1"
                                                name="AddressLine1" value="{{ old('AddressLine1', isset($edit_students->AddressLine1) ?  $edit_students->AddressLine1  : '' ) }}">
                                            </div>
                                            <div class="col-md-6 form-group">

                                                <label  class="form-label">Address Line  2</label>

                                                <label  class="form-label">AddressLine  2</label>

                                                <input type="text" class="form-control" id="AddressLine2" placeholder= "Enter Address2"
                                                name="AddressLine2" value="{{ old('AddressLine2', isset($edit_students->AddressLine2) ?  $edit_students->AddressLine2  : '' ) }}">
                                            </div>
                                            <div class="col-md-6 form-group">

                                                <label  class="form-label">Address Line  3</label>

                                                <label  class="form-label">AddressLine  3</label>

                                                <input type="text" class="form-control" id="AddressLine3" placeholder= "Enter Address 3"
                                                name="AddressLine3" value="{{ old('AddressLine3', isset($edit_students->AddressLine3) ?  $edit_students->AddressLine3  : '' ) }}">
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Status</label>
                                                <select class="form-control selectpicker" id="Status" name="Status" data-style="form-control btn-secondary">
                                                    <option value="">Select Status</option>
                                                    <option value="OnRoll" @if(isset($edit_students->Status) && $edit_students->Status == 'OnRoll') selected @endif>OnRoll</option>
                                                    <option value="Short-Left" @if(isset($edit_students->Status) && $edit_students->Status == 'Short-Left') selected @endif>Short-Left</option>
                                                    <option value="Completed" @if(isset($edit_students->Status) && $edit_students->Status == 'Completed') selected @endif>Completed</option>
                                                    <option value="Promoted" @if(isset($edit_students->Status) && $edit_students->Status == 'Promoted') selected @endif>Promoted</option>
                                                    <option value="PassOut" @if(isset($edit_students->Status) && $edit_students->Status == 'PassOut') selected @endif>Pass Out</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">12th/TY Bcom Classes Name</label>
                                                <input type="text" name="prevclsname" class="form-control" id="prevclsname" placeholder= "Enter Class Name"
                                                name="prevclsname" value="{{ old('prevclsname', isset($edit_students->prevclsname) ?  $edit_students->prevclsname  : '' ) }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">12th/TY Bcom Classes Owner Name</label>
                                                <input type="text" name="prevownername" class="form-control" id="prevownername" placeholder= "Enter Owner's Name"
                                                name="prevownername" value="{{ old('prevownername', isset($edit_students->prevownername) ?  $edit_students->prevownername  : '' ) }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">12th/TY Bcom Classes Owner Mobile Number</label>
                                                <input type="text" name="prevownerno" class="form-control" id="prevownerno" placeholder= "Enter Owner's Number"
                                                name="prevownerno" value="{{ old('prevownerno', isset($edit_students->prevownerno) ?  $edit_students->prevownerno  : '' ) }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Information About Our Classes</label>
                                                <select class="form-control selectpicker" id="classinfo" name="classinfo" data-style="form-control btn-secondary"
                                                value="{{ old('classinfo', isset($edit_students->classinfo) ?  $edit_students->classinfo  : '' ) }}">
                                                    <option value="">Select</option>
                                                    <option value="Reference"  @if(isset($edit_students->classinfo) && $edit_students->classinfo == 'Reference') selected @endif>Reference</option>
                                                    <option value="Social Media" @if(isset($edit_students->classinfo) && $edit_students->classinfo == 'Social Media') selected @endif>Social Media</option>
                                                    <option value="Seminar" @if(isset($edit_students->classinfo) && $edit_students->classinfo == 'Seminar') selected @endif>Seminar</option>
                                                    <option value="Google" @if(isset($edit_students->classinfo) && $edit_students->classinfo == 'Google') selected @endif>Google</option>
                                                    <option value="Others" @if(isset($edit_students->classinfo) && $edit_students->classinfo == 'Others') selected @endif>Others</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Opted For Courses</label>
                                                <select class="form-control selectpicker" id="courses" name="courses" data-style="form-control btn-secondary"
                                                value="{{ old('courses', isset($edit_students->courses) ?  $edit_students->courses  : '' ) }}">
                                                        <option value="">Select</option>
                                                        <option value="CA Foundation"  @if(isset($edit_students->courses) && $edit_students->courses == 'CA Foundation') selected @endif>CA Foundation</option>
                                                        <option value="CA Inter"  @if(isset($edit_students->courses) && $edit_students->courses == 'CA Inter') selected @endif>CA Inter</option>
                                                        <option value="CA Final"  @if(isset($edit_students->courses) && $edit_students->courses == 'CA Final') selected @endif>CA Final</option>
                                                        <option value="ACCA-Knowledge"  @if(isset($edit_students->courses) && $edit_students->courses == 'ACCA-Knowledge') selected @endif>ACCA-Knowledge</option>
                                                        <option value="ACCA- Skill"  @if(isset($edit_students->courses) && $edit_students->courses == 'ACCA- Skill') selected @endif>ACCA- Skill</option>
                                                        <option value="ACCA- Professional"  @if(isset($edit_students->courses) && $edit_students->courses == 'ACCA- Professional') selected @endif>ACCA- Professional</option>
                                                        <option value="CMA - Foundation"  @if(isset($edit_students->courses) && $edit_students->courses == 'CMA - Foundation') selected @endif>CMA - Foundation</option>
                                                        <option value="CMA - Inter"  @if(isset($edit_students->courses) && $edit_students->courses == 'CMA - Inter') selected @endif>CMA - Inter</option>
                                                        <option value="CMA - Final"  @if(isset($edit_students->courses) && $edit_students->courses == 'CMA - Final') selected @endif>CMA - Final</option>
                                                        <option value="CPA US"  @if(isset($edit_students->courses) && $edit_students->courses == 'CPA US') selected @endif>CPA US</option>
                                                        <option value="CMA US"  @if(isset($edit_students->courses) && $edit_students->courses == 'CMA US') selected @endif>CMA US</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Completed and Promoted to Next</label>
                                                <select class="form-control selectpicker" id="promoted" name="promoted" data-style="form-control btn-secondary"
                                                value="{{ old('promoted', isset($edit_students->promoted) ?  $edit_students->promoted  : '' ) }}">
                                                    <option value="">Select</option>
                                                    <option value="CA Inter" @if(isset($edit_students->promoted) && $edit_students->promoted == 'CA Inter') selected @endif>CA Inter</option>
                                                    <option value="CA Final" @if(isset($edit_students->promoted) && $edit_students->promoted == 'CA Final') selected @endif>CA Final</option>
                                                    <option value="ACCA- Skill" @if(isset($edit_students->promoted) && $edit_students->promoted == 'ACCA- Skill') selected @endif>ACCA- Skill</option>
                                                    <option value="ACCA- Professional" @if(isset($edit_students->promoted) && $edit_students->promoted == 'ACCA- Professional') selected @endif>ACCA- Professional</option>
                                                    <option value="CMA- Inter"@if(isset($edit_students->promoted) && $edit_students->promoted == 'CMA- Inter') selected @endif>CMA - Inter</option>
                                                    <option value="CMA- Final"@if(isset($edit_students->promoted) && $edit_students->promoted == 'CMA- Final') selected @endif>CMA - Final</option>
                                                    <option value="CPA US"@if(isset($edit_students->promoted) && $edit_students->promoted == 'CPA US') selected @endif>CPA US</option>
                                                    <option value="CMA US"@if(isset($edit_students->promoted) && $edit_students->promoted == 'CMA US') selected @endif>CMA US</option>
                                                    <option value="Drop Out"@if(isset($edit_students->promoted) && $edit_students->promoted == 'Drop Out') selected @endif>Drop Out</option>
                                                    <option value="Shifted to Other Classes"@if(isset($edit_students->promoted) && $edit_students->promoted == 'Shifted to Other Classes') selected @endif>Shifted to Other Classes</option>
                                                </select>
                                            </div>
                                        </div>
                                            <button type="submit" class="btn btn-success mt-4">@if(!empty($edit_students->id))
                                                Update @else Save @endif</button>
                                            <a href="{{route('student.index')}}" type="submit"
                                                class=" m-w-105 btn btn-danger mt-4">Cancel</a>
                                    </form>
                                </div>
                            </div>
<script>
<<<<<<< HEAD
            $("#Location").on("change",function(){
              $.post("{{route('GetLocationWieseCourse')}}",{id:$(this).val(),'_token':"{{csrf_token()}}"},function(suc){
                var row=" ";
                var row1=" ";
                if(isNaN(suc.data))
                {        row="<option selected> Select Course </option>";
                    $.each(suc.data,function(i,v){
                    row+="<option value='"+v.ParaDescription+"'>"+v.ParaDescription+"</option>";
                  
                    row1="<option selected> Select Batch </option>";
                });
                }
                else
                {
                    row="<option selected> No  Course Found For this Location </option>";
                    row1="<option selected> No  Batch Found For this Course </option>";

                }
               
                $("#CourceCode").html(row);
                $("#BatchCode").html(row1);
              });
            }); 
            $("#CourceCode").on("change",function(){
                var Location =$("#Location").val();

    
              $.post("{{route('GetCourseWiseBatch')}}",{"Location":Location,"id":$(this).val(),'_token':"{{csrf_token()}}"},function(suc){
                var row=" ";
        
                if(isNaN(suc.data))
                {        row="<option selected> Select Batch </option>";
                    $.each(suc.data,function(i,v){
                    row+="<option value='"+v.ParaDescription+"'>"+v.ParaDescription+"</option>";
                 });
                }
                else
                {C
                    row="<option selected> No  Batch Found For this Course </option>";
                }
               
                $("#BatchCode").html(row);
             
              });
            }); 
=======
>>>>>>> f0f3fe8dc611ca86a0fe3af9a2b986dca9fad970
$("#CourceCode").select2({ placeholder: "Select a Cource Code ",allowClear: true});
$("#BatchCode").select2({ placeholder: "Select a Batch Code ",allowClear: true});
$("#classinfo").select({ placeholder: "Select an Option ",allowClear: true});
$("#courses").select({ placeholder: "Select an Option ",allowClear: true});
$("#promoted").select({ placeholder: "Select an Option ",allowClear: true});
$("#Title").select({ placeholder: "Select Title ",allowClear: true});
$("#Gender").select({ placeholder: "Select Gender ",allowClear: true});


$('#studentform').validate({
    rules: {
        // StudentCode: {
        //     required: true
        // },
        // RollNo: {
        //     required: true
        // },
        StudentName: {
            required: true,
            maxlength: 20,
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
        CourceCode: {
            required: true
        },
        BatchCode: {
            required: true
        },
        AcademinSession: {
            required: true
        },
        AddressLine1: {
            required: true
        },
        AddressLine2: {
            required: true
        },
        AddressLine3: {
            required: true
        },

        Status: {
            required: true
        },
        mobile: {
            required: true,
                 minlength: 10,
                maxlength: 10,
                number:true
        },
        email: {
            required: true,
            email: true,
            maxlength: 50,
            email:true
        },
        prevclsname: {
            required: true
        },
        prevownername: {
            required: true
        },
        prevownerno: {
            required: true,
                 minlength: 10,
                maxlength: 10,
                number:true
                
        },
        classinfo: {
            required: true
        },
        courses: {
            required: true
        },
        promoted: {
            required: true
        },
        Title: {
            required: true
        },
    
    },
    messages: {
        // StudentCode: {
        //     required: "Please enter StudentCode "
        // },
        // RollNo: {
        //     required: "Please enter RollNo "
        // },
        StudentName: {
            required: "Name is required",
            maxlength: "First name cannot be more than 20 characters"
        },
        DateOfJoining: {
            required: "Please enter Date Of Joining "
        },
        DOB: {
            required: "Please enter DOB "
        },
        Gender: {
            required: "Please enter Gender "
        },
        CourceCode: {
            required: "Please enter Cource Code "
        },
        BatchCode: {
            required: "Please enter Batch Code "
        },
        AcademinSession: {
            required: "Please enter Academin Session "
        },
        AddressLine1: {
            required: "Please enter Address Line 1 "
        },
        AddressLine2: {
            required: "Please enter Address Line 2 "
        },
        AddressLine3: {
            required: "Please enter Address Line 3 "
        },
       
        Status: {
            required: "Please enter Status "
        },
        mobile: {
            required: "Please enter mobile no. ",
                minlength: "Please altist 10 digits. ",
                maxlength: "More than 10 digits ",
                number: "Enter valid Number"
        },
        email: {
            required: "Email is required",
                email: "Email must be a valid email address",
                maxlength: "Email cannot be more than 50 characters",
                email:"Please enter valid email",
        },
        prevclsname: {
            required: "Please enter Class Name "
        },
        prevownername: {
            required: "Please enter Owner Name "
        },
        prevownerno: {
            required: "Please enter Owner No. ",
                minlength: "Please altist 10 digits. ",
                maxlength: "More than 10 digits ",
                number: "Enter valid Number"
        },
        classinfo: {
            required: "Please select Class Info "
        },
        courses: {
            required: "Please select Courses "
        },
        promoted: {
            required: "Please select Promoted "
        },
        Title: {
            required: "Please select Title "
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
$("#phone").keypress(function (e) {
 //if the letter is not digit then display error and don't type anything
 if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
//display error message
$("#errmsg").html("Digits Only").show().fadeOut("slow");
 return false;
 }
});

</script>
@endsection