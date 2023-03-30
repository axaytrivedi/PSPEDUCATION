                            
 @extends('layouts.app')
@section('content')                           

                            <div class="card mb-3">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Schedule</h6> 
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
                                <form id="schedule" method="post"
                                    action=" @if(!empty($edit_schedule->id)!=0)  {{route('schedule.update',$edit_schedule->id)}}   @else {{route('schedule.store')}}@endif"
                                    enctype="multipart/form-data">

                                    @if(!empty($edit_schedule->id)) @method('PATCH') @endif @csrf
                                        <div class="row g-3 align-items-center">
                                        <div class="card-header">
                                            <h3 class="card-title">{{isset($edit_schedule)?'Edit':"Add"}} Schedule</h3>
                                            <a href="{{route('schedule.index')}}" class=" btn  my_btn  ml-auto"> Back</a>
                                        </div>  
                                            <div class="col-md-6"> 
                                                <label for="firstname" class="form-label">Lecture Code</label>
                                                <input type="text" class="form-control" id="LectureCode" 
                                                name="LectureCode" value="{{ old('LectureCode', isset($edit_schedule->LectureCode) ?  $edit_schedule->LectureCode  : '' ) }}" >
                                            </div>
                                            <div class="col-md-6">
                                                <label for="CourceCode" class="form-label">Cource Code</label>
                                                <input type="text" class="form-control" id="CourceCode" 
                                                name="CourceCode" value="{{ old('CourceCode', isset($edit_schedule->CourceCode) ?  $edit_schedule->CourceCode  : '' ) }}">

                                            </div>
                                            <div class="col-md-6">
                                                <label  class="form-label">Batch Code</label>
                                                <input type="text" class="form-control" id="BatchCode" 
                                                name="BatchCode" value="{{ old('BatchCode', isset($edit_schedule->BatchCode) ?  $edit_schedule->BatchCode  : '' ) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label  class="form-label">Day of Week</label>
                                               
                                                <select class="form-control selectpicker" id="DateOfWeek" name="DateOfWeek" data-style="form-control btn-secondary"
                                                value="{{ old('DateOfWeek', isset($edit_schedule->DateOfWeek) ?  $edit_schedule->DateOfWeek  : '' ) }}">
                                                    <option value="Mon">Mon</option>
                                                    <option value="Tue">Tue</option>
                                                    <option value="Wed">Wed</option>
                                                    <option value="Thurs">Thur</option>
                                                    <option value="Fri">Fri</option>
                                                    <option value="Sat">Sat</option>
                                                    <option value="Sun">Sun</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6"> 
                                                <label for="firstname" class="form-label">Session</label>
                                                <select class="form-control selectpicker" id="Session" name="Session" data-style="form-control btn-secondary"
                                                value="{{ old('Session', isset($edit_schedule->Session) ?  $edit_schedule->Session  : '' ) }}">
                                                    <option value="Morning">Morning</option>
                                                    <option value="Afternoon">Afternoon</option>
                                                    <option value="Noon">Noon</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="TimingFrom" class="form-label">Timing From</label>
                                                <input type="time" class="form-control" id="TimingFrom" 
                                                name="TimingFrom" value="{{ old('TimingFrom', isset($edit_schedule->TimingFrom) ?  $edit_schedule->TimingFrom  : '' ) }}">

                                            </div>
                                            <div class="col-md-6">
                                                <label  class="form-label">Timing Upto</label>
                                                <input type="time" class="form-control" id="TimingUpto" 
                                                name="TimingUpto" value="{{ old('TimingUpto', isset($edit_schedule->TimingUpto) ?  $edit_schedule->TimingUpto  : '' ) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label  class="form-label">Subject Code</label>
                                                <input type="text" class="form-control" id="SubjectCode" 
                                                name="SubjectCode" value="{{ old('SubjectCode', isset($edit_schedule->SubjectCode) ?  $edit_schedule->SubjectCode  : '' ) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label  class="form-label">Faculty Code</label>
                                                <input type="text" class="form-control" id="FacultyCode" 
                                                name="FacultyCode" value="{{ old('FacultyCode', isset($edit_schedule->FacultyCode) ?  $edit_schedule->FacultyCode  : '' ) }}">
                                            </div>
                                            <div class="col-md-6"> 
                                                <label for="firstname" class="form-label">Venue</label>
                                                <input type="text" class="form-control" id="Venue" 
                                                name="Venue" value="{{ old('Venue', isset($edit_schedule->Venue) ?  $edit_schedule->Venue  : '' ) }}" >
                                            </div>
                                            <div class="col-md-6">
                                                <label for="EffFrom" class="form-label">EffFrom</label>
                                                <input type="date" class="form-control" id="EffFrom" 
                                                name="EffFrom" value="{{ old('EffFrom', isset($edit_schedule->EffFrom) ?  $edit_schedule->EffFrom  : '' ) }}">

                                            </div>
                                            <div class="col-md-6">
                                                <label  class="form-label">EffUpto</label>
                                                <input type="date" class="form-control" id="EffUpto" 
                                                name="EffUpto" value="{{ old('EffUpto', isset($edit_schedule->EffUpto) ?  $edit_schedule->EffUpto  : '' ) }}">
                                            </div>
                                          
                                        </div>
                                            <button type="submit" class="btn btn-success mt-4">@if(!empty($edit_schedule->id))
                                                Update @else Save @endif</button>
                                            <a href="{{route('schedule.index')}}" type="submit"
                                                class=" m-w-105 btn btn-danger mt-4">Cancel</a>
                                    </form>
                                </div>
                            </div>
                            <script>
$('#schedule').validate({
    rules: {
        LectureCode: {
            required: true
        },
        CourceCode: {
            required: true
        },
        BatchCode: {
            required: true
        },
        DateOfWeek: {
            required: true
        },
        session: {
            required: true
        },
        TimingFrom: {
            required: true
        },
        TimingUpto: {
            required: true
        },
        EffUpto: {
            required: true
        },
        SubjectCode: {
            required: true
        },
        FacultyCode: {
            required: true
        },
        Venue: {
            required: true
        },
        EffFrom: {
            required: true
        },
        EffUpto: {
            required: true
        },
    },
    messages: {
        LectureCode: {
            required: "Please enter LectureCode "
        },
        CourceCode: {
            required: "Please enter CourceCode "
        },
        BatchCode: {
            required: "Please enter BatchCode "
        },
        DateOfWeek: {
            required: "Please enter DateOfWeek "
        },
        session: {
            required: "Please enter EffUpto "
        },
        TimingFrom: {
            required: "Please enter TimingFrom "
        },
        TimingUpto: {
            required: "Please enter TimingFrom "
        },
        EffUpto: {
            required: "Please enter EffUpto "
        },
        SubjectCode: {
            required: "Please enter SubjectCode "
        },
        FacultyCode: {
            required: "Please enter FacultyCode "
        },
        Venue: {
            required: "Please enter Venue "
        },
        EffFromFrom: {
            required: "Please enter EffFrom "
        },
        EffUpto: {
            required: "Please enter EffUpto "
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