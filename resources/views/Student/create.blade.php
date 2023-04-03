                            
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
                                            <h3 class="card-title">{{isset($edit_students)?'Edit':"Add"}} Item</h3>
                                            <a href="{{route('student.index')}}" class=" btn  my_btn  ml-auto"> Back</a>
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
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Student Name</label>
                                                <input type="text" class="form-control" id="StudentName" 
                                                name="StudentName" value="{{ old('StudentName', isset($edit_students->StudentName) ?  $edit_students->StudentName  : '' ) }}">

                                            </div>
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
                                                <select class="form-control selectpicker" id="Gender" name="Gender" data-style="form-control btn-secondary"
                                                value="{{ old('Gender', isset($edit_students->Gender) ?  $edit_students->Gender  : '' ) }}">
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Cource Code</label>

                                                <select  class="form-control" id="CourceCode" name="CourceCode" >
                                                    
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
                                                <label  class="form-label">Status</label>
                                                
                                                <select class="form-control selectpicker" id="Status" name="Status" data-style="form-control btn-secondary"
                                                value="{{ old('Status', isset($edit_facultys->Status) ?  $edit_facultys->Status  : '' ) }}">
                                                    <option value="OnRoll">OnRoll</option>
                                                    <option value="Short-Left">Short-Left</option>
                                                    <option value="Completed">Completed</option>
                                                    <option value="Promoted">Promoted</option>
                                                    <option value="PassOut">Pass Out</option>
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
        Status: {
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
        Status: {
            required: "Please enter Status "
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