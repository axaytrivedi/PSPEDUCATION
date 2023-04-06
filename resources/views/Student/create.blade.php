                            
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
                                        <div class="card-header">
                                            <h3 class="card-title">{{isset($edit_students)?'Edit':"Add"}} Student Details</h3>
                                            <!-- <a href="{{route('student.index')}}" class=" btn  my_btn  ml-auto"> Back</a> -->
                                        </div>

                                        <div class="form-group col-sm-3">
                                            <label class="form-label">Title</label>
                                            <select class="form-control selectpicker" id="Title" name="Title" data-style="form-control btn-secondary"
                                            value="{{ old('Title', isset($edit_students->Title) ?  $edit_students->Title  : '' ) }}">
                                                <option value="">--Select Title--</option>
                                                <option value="Mr" {{ old('Title', isset($edit_students) ? $edit_students->Title : '')=='Mr' ? 'selected' : '' }}> Mr.</option>
                                                <option value="Ms" {{ old('Title', isset($edit_students) ? $edit_students->Title : '')=='Ms' ? 'selected' : '' }}>Ms.</option>
                                                <option value="Mrs" {{ old('Title', isset($edit_students) ? $edit_students->Title : '')=='Mrs' ? 'selected' : '' }}>Mrs.</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6">
                                                <label class="form-label">Student Name</label>
                                                <input class="form-control allowCharcterOnly"  type="text" id="StudentName" 
                                                name="StudentName" value="{{ old('StudentName', isset($edit_students->StudentName) ?  $edit_students->StudentName  : '' ) }}">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                                <label class="form-label">Mobile Number </label>
                                                <input class="form-control"  type="text" id="mobile" 
                                                name="mobile" value="{{ old('mobile', isset($edit_students->mobile) ?  $edit_students->mobile  : '' ) }}">
                                        </div>

                                        <div class="form-group  col-md-6 col-sm-12">
                                            <label class="form-label">Email </label>
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
                                                <input type="date" class="form-control dobCheck" id="DOB" 
                                                name="DOB" value="{{ old('DOB', isset($edit_students->DOB) ?  $edit_students->DOB  : '' ) }}">
                                                <puthereError id="puthereError"></puthereError>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Date Of Joining</label>
                                                <input type="date" name="DateOfJoining" class="form-control" id="DateOfJoining" 
                                                name="DateOfJoining" value="{{ old('DateOfJoining', isset($edit_students->DateOfJoining) ?  $edit_students->DateOfJoining  : '' ) }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Gender</label>
                                                <select class="form-control selectpicker" id="Gender" name="Gender" data-style="form-control btn-secondary"
                                                value="{{ old('Gender', isset($edit_students->Gender) ?  $edit_students->Gender  : '' ) }}">
                                                    <option value="">Select Gender</option>
                                                    <option value="Male" {{ old('Gender', isset($edit_students) ? $edit_students->Gender : '')=='Male' ? 'selected' : '' }}> Male</option>
                                                    <option value="Female" {{ old('Gender', isset($edit_students) ? $edit_students->Gender : '')=='Female' ? 'selected' : '' }}>Female</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Cource Code</label>

                                                <select  class="form-control" id="CourceCode" name="CourceCode" >
                                                <option value="">Select Cource Code</option>
                                                    @foreach($CourseList as $clist)
                                                        <option value="{{$clist->ParaDescription}}" {{old('CourceCode')}}
                                                        @if(isset($edit_students->CourceCode)  &&  $clist->ParaDescription == $edit_students->CourceCode ) selected @endif
                                                        >{{$clist->ParaCode}} / {{$clist->ParaDescription}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Batch Code</label>

                                                <select   class="form-control" id="BatchCode"  name="BatchCode" >
                                                <option value="">Select Batch Code</option>
                                                    @foreach($batchCode as $blist)
                                                        <option value="{{$blist->ParaDescription}}" {{old('BatchCode')}}
                                                        @if(isset($edit_students->BatchCode) &&  $blist->ParaDescription == $edit_students->BatchCode) selected @endif
                                                        >{{$blist->ParaDescription}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Academin Session</label>
                                                <input type="text" class="form-control" id="AcademinSession" 
                                                name="AcademinSession" value="{{ old('AcademinSession', isset($edit_students->AcademinSession) ?  $edit_students->AcademinSession  : '' ) }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">AddressLine 1</label>
                                                <input type="text" class="form-control" id="AddressLine1" 
                                                name="AddressLine1" value="{{ old('AddressLine1', isset($edit_students->AddressLine1) ?  $edit_students->AddressLine1  : '' ) }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">AddressLine  2</label>
                                                <input type="text" class="form-control" id="AddressLine2" 
                                                name="AddressLine2" value="{{ old('AddressLine2', isset($edit_students->AddressLine2) ?  $edit_students->AddressLine2  : '' ) }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">AddressLine  3</label>
                                                <input type="text" class="form-control" id="AddressLine3" 
                                                name="AddressLine3" value="{{ old('AddressLine3', isset($edit_students->AddressLine3) ?  $edit_students->AddressLine3  : '' ) }}">
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Title</label>
                                                <select class="form-control selectpicker" id="Status" name="Status" data-style="form-control btn-secondary"
                                                value="{{ old('Status', isset($edit_students->Status) ?  $edit_students->Status  : '' ) }}">
                                                    <option value="">Select Status</option>
                                                    <option value="OnRoll" {{ old('Status', isset($edit_students) ? $edit_students->Status : '')=='OnRoll' ? 'selected' : '' }}>OnRoll</option>
                                                    <option value="Short-Left" {{ old('Status', isset($edit_students) ? $edit_students->Status : '')=='Short-Left' ? 'selected' : '' }}>Short-Left</option>
                                                    <option value="Completed" {{ old('Status', isset($edit_students) ? $edit_students->Status : '')=='Completed' ? 'selected' : '' }}>Completed</option>
                                                    <option value="Promoted" {{ old('Status', isset($edit_students) ? $edit_students->Status : '')=='Promoted' ? 'selected' : '' }}>Promoted</option>
                                                    <option value="PassOut" {{ old('Status', isset($edit_students) ? $edit_students->Status : '')=='PassOut' ? 'selected' : '' }}>Pass Out</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">12th/TY Bcom Classes Name</label>
                                                <input type="text" name="prevclsname" class="form-control" id="prevclsname" 
                                                name="prevclsname" value="{{ old('prevclsname', isset($edit_students->prevclsname) ?  $edit_students->prevclsname  : '' ) }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">12th/TY Bcom Classes Owner Name</label>
                                                <input type="text" name="prevownername" class="form-control" id="prevownername" 
                                                name="prevownername" value="{{ old('prevownername', isset($edit_students->prevownername) ?  $edit_students->prevownername  : '' ) }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">12th/TY Bcom Classes Owner Mobile Number</label>
                                                <input type="text" name="prevownerno" class="form-control" id="prevownerno" 
                                                name="prevownerno" value="{{ old('prevownerno', isset($edit_students->prevownerno) ?  $edit_students->prevownerno  : '' ) }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Information About Our Classes</label>
                                                <select class="form-control selectpicker" id="classinfo" name="classinfo" data-style="form-control btn-secondary"
                                                value="{{ old('classinfo', isset($edit_students->classinfo) ?  $edit_students->classinfo  : '' ) }}">
                                                    <option value="">Select</option>
                                                    <option value="Reference" {{ old('classinfo', isset($edit_students) ? $edit_students->classinfo : '')=='Reference' ? 'selected' : '' }}>Reference</option>
                                                    <option value="Social Media" {{ old('classinfo', isset($edit_students) ? $edit_students->classinfo : '')=='Social Media' ? 'selected' : '' }}>Social Media</option>
                                                    <option value="Seminar" {{ old('classinfo', isset($edit_students) ? $edit_students->classinfo : '')=='Seminar' ? 'selected' : '' }}>Seminar</option>
                                                    <option value="Google" {{ old('classinfo', isset($edit_students) ? $edit_students->classinfo : '')=='Google' ? 'selected' : '' }}>Google</option>
                                                    <option value="Others" {{ old('classinfo', isset($edit_students) ? $edit_students->classinfo : '')=='Others' ? 'selected' : '' }}>Others</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Opted For Courses</label>
                                                <select class="form-control selectpicker" id="courses" name="courses" data-style="form-control btn-secondary"
                                                value="{{ old('courses', isset($edit_students->courses) ?  $edit_students->courses  : '' ) }}">
                                                        <option value="">Select</option>
                                                        <option value="CA Foundation" {{ old('courses', isset($edit_students) ? $edit_students->courses : '')=='CA Foundation' ? 'selected' : '' }}>CA Foundation</option>
                                                        <option value="CA Inter"  {{ old('courses', isset($edit_students) ? $edit_students->courses : '')=='CA Inter' ? 'selected' : '' }} >CA Inter</option>
                                                        <option value="CA Final"  {{ old('courses', isset($edit_students) ? $edit_students->courses : '')=='CA Final' ? 'selected' : '' }}>CA Final</option>
                                                        <option value="ACCA-Knowledge"  {{ old('courses', isset($edit_students) ? $edit_students->courses : '')=='ACCA-Knowledge' ? 'selected' : '' }}>ACCA-Knowledge</option>
                                                        <option value="ACCA- Skill"  {{ old('courses', isset($edit_students) ? $edit_students->courses : '')=='ACCA- Skill' ? 'selected' : '' }}>ACCA- Skill</option>
                                                        <option value="ACCA- Professional"  {{ old('courses', isset($edit_students) ? $edit_students->courses : '')=='ACCA- Professional' ? 'selected' : '' }}>ACCA- Professional</option>
                                                        <option value="CMA - Foundation"  {{ old('courses', isset($edit_students) ? $edit_students->courses : '')=='CMA - Foundation' ? 'selected' : '' }}>CMA - Foundation</option>
                                                        <option value="CMA - Inter"  {{ old('courses', isset($edit_students) ? $edit_students->courses : '')=='CMA - Inter' ? 'selected' : '' }}>CMA - Inter</option>
                                                        <option value="CMA - Final"  {{ old('courses', isset($edit_students) ? $edit_students->courses : '')=='CMA - Final' ? 'selected' : '' }}>CMA - Final</option>
                                                        <option value="CPA US"  {{ old('courses', isset($edit_students) ? $edit_students->courses : '')=='CPA US' ? 'selected' : '' }}>CPA US</option>
                                                        <option value="CMA US"  {{ old('courses', isset($edit_students) ? $edit_students->courses : '')=='CMA US' ? 'selected' : '' }}>CMA US</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Completed and Promoted to Next</label>
                                                <select class="form-control selectpicker" id="promoted" name="promoted" data-style="form-control btn-secondary"
                                                value="{{ old('promoted', isset($edit_students->promoted) ?  $edit_students->promoted  : '' ) }}">
                                                    <option value="">Select</option>
                                                    <option value="CA Inter" {{ old('promoted', isset($edit_students) ? $edit_students->promoted : '')=='CA Inter' ? 'selected' : '' }} >CA Inter</option>
                                                    <option value="CA Final"{{ old('promoted', isset($edit_students) ? $edit_students->promoted : '')=='CA Final' ? 'selected' : '' }}>CA Final</option>
                                                    <option value="ACCA- Skill" {{ old('promoted', isset($edit_students) ? $edit_students->promoted : '')=='ACCA- Skill' ? 'selected' : '' }}>ACCA- Skill</option>
                                                    <option value="ACCA- Professional" {{ old('promoted', isset($edit_students) ? $edit_students->promoted : '')=='ACCA- Professional' ? 'selected' : '' }}>ACCA- Professional</option>
                                                    <option value="CMA- Inter" {{ old('promoted', isset($edit_students) ? $edit_students->promoted : '')=='CMA- Inter' ? 'selected' : '' }}>CMA - Inter</option>
                                                    <option value="CMA- Final" {{ old('promoted', isset($edit_students) ? $edit_students->promoted : '')=='CMA- Final' ? 'selected' : '' }}>CMA - Final</option>
                                                    <option value="CPA US" {{ old('promoted', isset($edit_students) ? $edit_students->promoted : '')=='CPA US' ? 'selected' : '' }}>CPA US</option>
                                                    <option value="CMA US" {{ old('promoted', isset($edit_students) ? $edit_students->promoted : '')=='CMA US' ? 'selected' : '' }}>CMA US</option>
                                                    <option value="Drop Out" {{ old('promoted', isset($edit_students) ? $edit_students->promoted : '')=='Drop Out' ? 'selected' : '' }}>Drop Out</option>
                                                    <option value="Shifted to Other Classes" {{ old('promoted', isset($edit_students) ? $edit_students->promoted : '')=='Shifted to Other Classes' ? 'selected' : '' }}>Shifted to Other Classes</option>
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
  
    $(".dobCheck").on("change",function(){
        
        var currentTime = new Date();
        var current_year = currentTime.getFullYear();
        var dob = $(this).val();
        dob = dob.split("-");
        var oldyear = dob[0];
        var checkmevalid = current_year-parseInt(dob[0]);
        if(checkmevalid <= 18)
        {
            $("#puthereError").html("<span class='text-danger pl-1'>Your age is less for CA </span>");
            // $(".dobCheck").val(" ");
        }
        else
        {
            $("#puthereError").html(" ");
        }
    });
$("#CourceCode").select2({ placeholder: "Select a Cource Code ",allowClear: true});
$("#BatchCode").select2({ placeholder: "Select a Batch Code ",allowClear: true});

$('#studentform').validate({
    rules: {
        // StudentCode: {
        //     required: true
        // },
        // RollNo: {
        //     required: true
        // },
        StudentName: {
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
            required: true
        },
        email: {
            required: true
        },
        prevclsname: {
            required: true
        },
        prevownername: {
            required: true
        },
        prevownerno: {
            required: true
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
            required: "Please enter BatchCode "
        },
        DateOfJoining: {
            required: "Please enter DateOfJoining "
        },
        DOB: {
            required: "Please enter DOB "
        },
        Gender: {
            required: "Please enter Gender "
        },
        CourceCode: {
            required: "Please enter CourceCode "
        },
        BatchCode: {
            required: "Please enter BatchCode "
        },
        AcademinSession: {
            required: "Please enter AcademinSession "
        },
        AddressLine1: {
            required: "Please enter AddressLine1 "
        },
        AddressLine2: {
            required: "Please enter AddressLine2 "
        },
        AddressLine3: {
            required: "Please enter AddressLine3 "
        },
        Status: {
            required: "Please enter Status "
        },
        mobile: {
            required: "Please enter mobile "
        },
        email: {
            required: "Please enter email "
        },
        prevclsname: {
            required: "Please enter classname "
        },
        prevownername: {
            required: "Please enter ownername "
        },
        prevownerno: {
            required: "Please enter ownerno "
        },
        classinfo: {
            required: "Please select classinfo "
        },
        courses: {
            required: "Please select courses "
        },
        promoted: {
            required: "Please select promoted "
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
</script>
@endsection