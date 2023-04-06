                            
 @extends('layouts.app')
@section('content')                           

                            <div class="card mb-3">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Faculty Attendance</h6> 
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
                                <form id="facultyattForm" method="post"
                                    action=" @if(!empty($edit_facultyatt->id)!=0)  {{route('facultyAttendance.update',$edit_facultyatt->id)}}   @else {{route('facultyAttendance.store')}}@endif"
                                    enctype="multipart/form-data">

                                    @if(!empty($edit_facultyatt->id)) @method('PATCH') @endif @csrf
                                        <div class="row g-3 align-items-center">
                                        <div class="card-header">
                                            <h3 class="card-title">{{isset($edit_facultyatt)?'Edit':"Add"}} Faculty Attendance</h3>
                                            <a href="{{route('facultyAttendance.index')}}" class=" btn  my_btn  ml-auto"> Back</a>
                                        </div>
                                            <div class="col-md-6"> 
                                                <label for="firstname" class="form-label">Faculty Code</label>
                                                <input type="text" class="form-control" id="FacultyCode" 
                                                name="FacultyCode" value="{{ old('FacultyCode', isset($edit_facultyatt->FacultyCode) ?  $edit_facultyatt->FacultyCode  : '' ) }}" >
                                            </div>
                                            <div class="col-md-6">
                                                <label for="lastname" class="form-label">CalanderDate</label>
                                                <input type="date" class="form-control" id="CalanderDate" 
                                                name="CalanderDate" value="{{ old('CalanderDate', isset($edit_facultyatt->CalanderDate) ?  $edit_facultyatt->CalanderDate  : '' ) }}">

                                            </div>
                                            <div class="col-md-6">
                                                <label  class="form-label">InTime</label>
                                                <input type="time" class="form-control" id="InTime" 
                                                name="InTime" value="{{ old('InTime', isset($edit_facultyatt->InTime) ?  $edit_facultyatt->InTime  : '' ) }}">

                                            </div>
                                            <div class="col-md-6">
                                                <label  class="form-label">OutTime</label>
                                                <input type="time" class="form-control" id="OutTime" 
                                                name="OutTime" value="{{ old('OutTime', isset($edit_facultyatt->OutTime) ?  $edit_facultyatt->OutTime  : '' ) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label  class="form-label">AttendanceStatus</label>
                                                <input type="text" name="AttendanceStatus" class="form-control" id="AttendanceStatus" 
                                                name="AttendanceStatus" value="{{ old('AttendanceStatus', isset($edit_facultyatt->AttendanceStatus) ?  $edit_facultyatt->AttendanceStatus  : '' ) }}">
                                                <select class="form-label selectpicker" id="AttendanceStatus" name="AttendanceStatus" data-style="form-control btn-secondary"
                                                value="{{ old('AttendanceStatus', isset($edit_facultys->AttendanceStatus) ?  $edit_facultys->AttendanceStatus  : '' ) }}">
                                                    <option value="Present">Present</option>
                                                    <option value="Half-Day">Half-Day</option>
                                                    <option value="OnLeave">On Leave</option>
                                                    <option value="Absent">Absent</option>
                                                </select>
                                            </div>
                                        </div>
                                            <button type="submit" class="btn btn-success mt-4">@if(!empty($edit_facultyatt->id))
                                                Update @else Save @endif</button>
                                            <a href="{{route('facultyAttendance.index')}}" type="submit"
                                                class=" m-w-105 btn btn-danger mt-4">Cancel</a>
                                    </form>
                                </div>
                            </div>
<script>
$('#facultyattform').validate({
    rules: {
        FacultyCode: {
            required: true
        },
        CalanderDate: {
            required: true
        },
        InTime: {
            required: true
        },
        OutTime: {
            required: true
        },
        AttendanceStatus: {
            required: true
        },
    },
    messages: {
        FacultyCode: {
            required: "Please enter FacultyCode "
        },
        CalanderDate: {
            required: "Please enter CalanderDate "
        },
        InTime: {
            required: "Please enter InTime "
        },

        OutTime: {
            required: "Please enter OutTime "
        },
        AttendanceStatus: {
            required: "Please enter AttendanceStatus "
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