@extends('layouts.app')
@section('content')
                            <div class="card mb-3">
                                <div class="card-header py-3  bg-transparent border-bottom-0">
                                    <div>
                                            <div class="pull-left">
                                            <h6 class="mb-0 fw-bold ">Faculty Attendance Details Table</h6> 
                                            </div>
                                            <!-- <div class="pull-right">
                                                <a class="btn btn-success" href="{{ route('facultyAttendance.create') }}"> Create New</a>
                                            </div> -->
                                    </div>
                                </div>
                                <!-- <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>FacultyCode</th>
                                                <th>CalanderDate</th>
                                                <th>InTime</th>
                                                <th>OutTime</th>
                                                <th width="280px">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($facultyatt as $k=>$values)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $values->FacultyCode }}</td>
                                                    <td>{{ $values->CalanderDate }}</td>
                                                    <td>{{ $values->InTime }}</td>
                                                    <td>{{ $values->OutTime }}</td>
                                                    <td>
                                                        <form action="{{ route('facultyAttendance.destroy',$values->id) }}" method="POST">
                                                                                    
                                                            <a class="btn btn-primary" href="{{ route('facultyAttendance.edit',$values->id) }}"><i class="icofont-ui-edit"></i></a>
                                        
                                                            @csrf
                                                            @method('DELETE')
                                            
                                                            <button type="submit" class="btn btn-danger"><i class="icofont-ui-delete"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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
                                <form id="facultyattForm" method="post" action="{{route('facultyAttendance.store')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3 ms-1">
                                        <div class="col-md-3">
                                            <label for="lastname" class="form-label">CalanderDate</label>
                                            <input type="date" class="form-control" id="CalanderDate"  name="CalanderDate" value="">
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    
                                                    <table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 1%"><input type='checkbox' id='checkAll'></th>
                                                                <th>No</th>
                                                                <th>FacultyCode</th>
                                                                <th>Attandance Status</th>
                                                                <th>INTIME</th>
                                                                <th>OUTTIME</th>
                                                            
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($facultys as $k=>$values)
                                                            <tr>
                                                                <input type="hidden" name="attendance_id[]" 
                                                             @if(isset(FacultyAttendanceget($values->FacultyCode,date('Y-m-d'))->Att_id))  value="{{FacultyAttendanceget($values->FacultyCode,date('Y-m-d'))->Att_id}}" @endif>
                                                                <td><input type="checkbox" class="checkbox" data-id="{{$values->id}}" name="checks[{{$k}}][]"></td>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td><strong><input type="hidden" class="form-control" id="FacultyCode" name="FacultyCode[]" value="{{ $values->FacultyCode }}">{{ $values->FacultyCode }} - {{ $values->firstName }}</strong></td>
                                                                <td>
                                                                    <select class="form-select" aria-label="Default select example" id="AttendanceStatus" name="AttendanceStatus[]">
                                                                        <option selected value="">--Attandance Status--</option>
                                                                        <option value="Half Day" 
                                                                        {{ old('AttendanceStatus', isset($values)  && isset(FacultyAttendanceget($values->FacultyCode,date('Y-m-d'))->AttendanceStatus) ?  FacultyAttendanceget($values->FacultyCode,date('Y-m-d'))->AttendanceStatus  : '')=='Half Day' ? 'selected' : '' }} 
                                                                       >Half Day</option>
                                                                        <option value="Full Day" 
                                                                        {{ old('AttendanceStatus', isset($values)  && isset(FacultyAttendanceget($values->FacultyCode,date('Y-m-d'))->AttendanceStatus) ?  FacultyAttendanceget($values->FacultyCode,date('Y-m-d'))->AttendanceStatus  : '')=='Full Day' ? 'selected' : '' }} 
                                                                        >Full Day</option>
                                                                        <option value="Absence"
                                                                        
                                                                        {{ old('AttendanceStatus', isset($values)  && isset(FacultyAttendanceget($values->FacultyCode,date('Y-m-d'))->AttendanceStatus) ?  FacultyAttendanceget($values->FacultyCode,date('Y-m-d'))->AttendanceStatus  : '')=='Absence' ? 'selected' : '' }} 
                                                                        >Absence</option>

                                                                        <!-- 
                                                                        {{ old('AttendanceStatus', isset($values) ?  $values->AttendanceStatus  : '')=='Full Day' ? 'selected' : '' }}
                                                                        {{ old('AttendanceStatus', isset($values) ?  $values->AttendanceStatus  : '')=='Absence' ? 'selected' : '' }} -->
                                                                    </select>
                                                                </td>
                                                                <td><input type="time" class="form-control" id="InTime" name="InTime[]" @if(isset(FacultyAttendanceget($values->FacultyCode,date('Y-m-d'))->InTime))  value="{{FacultyAttendanceget($values->FacultyCode,date('Y-m-d'))->InTime}}" @else value="" @endif> </td>
                                                                <td><input type="time" class="form-control" id="OutTime" name="OutTime[]" value="@if(isset(FacultyAttendanceget($values->FacultyCode,date('Y-m-d'))->OutTime)){{FacultyAttendanceget($values->FacultyCode,date('Y-m-d'))->OutTime}}@endif"></td>

                                                            </tr>
                                                            @endforeach
                                                        
                                                        </tbody>
                                                    </table>
                                                    <button type="submit" class="btn btn-success mt-4">@if(!empty($edit_facultyatt->id))
                                                        Update @else Save @endif</button>
                                                    <!-- <a href="{{route('facultyAttendance.index')}}" type="submit"
                                                        class=" m-w-105 btn btn-danger mt-4">Cancel</a> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

<script>
    // Check/Uncheck ALl
    $('#checkAll').change(function() {
        if ($(this).is(':checked')) {
            $('input[name="checks[]"]').prop('checked', true);
        } else {
            $('input[name="checks[]"]').each(function() {
                $(this).prop('checked', false);
            });
        }
    });

    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    if(dd<10) {
        dd = '0'+dd
    } 

    if(mm<10) {
        mm = '0'+mm
    } 
    // today = yyyy + '/' + mm + '/' + dd;
    today = yyyy + '-' + mm + '-' + dd;
    //  console.log(today);
    //  document.getElementById('CalanderDate').value = today;
    $('#CalanderDate').val(today);

</script>
@endsection