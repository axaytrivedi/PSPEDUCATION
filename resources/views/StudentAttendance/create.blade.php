                            
 @extends('layouts.app')
@section('content')                           

                            <div class="card mb-3">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Student Attendance</h6> 
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
                                <form id="studentattform" method="post"
                                    action=" @if(!empty($edit_studentatt->id)!=0)  {{route('studentAttendance.update',$edit_studentatt->id)}}   @else {{route('studentAttendance.store')}}@endif"
                                    enctype="multipart/form-data">

                                    @if(!empty($edit_studentatt->id)) @method('PATCH') @endif @csrf
                                        <div class="row g-3 align-items-center">
                                        <div class="card-header">
                                            <h3 class="card-title">{{isset($edit_studentatt)?'Edit':"Add"}} Student Attendance</h3>
                                            <a href="{{route('studentAttendance.index')}}" class=" btn  my_btn  ml-auto"> Back</a>
                                        </div>
                                            <div class="col-md-6"> 
                                                <label for="firstname" class="form-label">Lecture Code</label>
                                                <input type="text" class="form-control" id="LectureCode" 
                                                name="LectureCode" value="{{ old('LectureCode', isset($edit_studentatt->LectureCode) ?  $edit_studentatt->LectureCode  : '' ) }}" >
                                            </div>
                                            <div class="col-md-6">
                                                <label for="LectureDate" class="form-label">Lecture Date</label>
                                                <input type="date" class="form-control" id="LectureDate" 
                                                name="LectureDate" value="{{ old('LectureDate', isset($edit_studentatt->LectureDate) ?  $edit_studentatt->LectureDate  : '' ) }}">

                                            </div>
                                            <div class="col-md-6">
                                                <label  class="form-label">Student Code</label>
                                                <input type="text" class="form-control" id="StudentCode" 
                                                name="StudentCode" value="{{ old('StudentCode', isset($edit_studentatt->StudentCode) ?  $edit_studentatt->StudentCode  : '' ) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label  class="form-label">AttendanceStatus</label>
                                                <input type="text" class="form-control" id="AttendanceStatus" 
                                                name="AttendanceStatus" value="{{ old('AttendanceStatus', isset($edit_studentatt->AttendanceStatus) ?  $edit_studentatt->AttendanceStatus  : '' ) }}">
                                                <select class="form-label selectpicker" id="AttendanceStatus" name="AttendanceStatus" data-style="form-control btn-secondary"
                                                value="{{ old('AttendanceStatus', isset($edit_facultys->AttendanceStatus) ?  $edit_facultys->AttendanceStatus  : '' ) }}">
                                                    <option value="Present">Present</option>
                                                    <option value="Absent">Absent</option>
                                                </select>
                                            </div>
                                        </div>
                                            <button type="submit" class="btn btn-success mt-4">@if(!empty($edit_studentatt->id))
                                                Update @else Save @endif</button>
                                            <a href="{{route('studentAttendance.index')}}" type="submit"
                                                class=" m-w-105 btn btn-danger mt-4">Cancel</a>
                                    </form>
                                </div>
                            </div>
                            <script>
$('#studentattform').validate({
    rules: {
        StudentCode: {
            required: true
        },
        LectureDate: {
            required: true
        },
        LectureCode: {
            required: true
        },
        AttendanceStatus: {
            required: true
        },
    },
    messages: {
        StudentCode: {
            required: "Please enter StudentCode "
        },
        LectureDate: {
            required: "Please enter LectureDate "
        },
        LectureCode: {
            required: "Please enter LectureCode "
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