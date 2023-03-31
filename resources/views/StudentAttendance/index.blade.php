@extends('layouts.app')
@section('content')
                            <div class="card mb-3">
                                <div class="card-header py-3  bg-transparent border-bottom-0">
                                    <div>
                                            <div class="pull-left">
                                            <h6 class="mb-0 fw-bold ">Student Attendance Details Table</h6> 
                                            </div>
                                            <!-- <div class="pull-right">
                                                <a class="btn btn-success" href="{{ route('facultyAttendance.create') }}"> Create New</a>
                                            </div> -->
                                    </div>
                                </div>
                              
                                @if ($errors->any())
                                <div class="alert alert-danger" id="errors_all_page">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <form id="facultyattForm" method="post" action="{{route('studentAttendance.store')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3 ms-1">
                                        <div class="col-md-3">
                                            <label for="lastname" class="form-label">CalanderDate</label>
                                            <input type="date" class="form-control" id="CalanderDate"  name="CalanderDate" value="">
                                        </div>
                                        <div class="col-md-3">
                                        <div class="form-group">
                                                <label><strong>Course Code :</strong></label>
                                                <select id='courseCode' name="courseCode"class="form-control" style="width: 200px">
                                                    <option value="">--Select Course Code--</option>
                                                    @foreach ($CourseList as $code)
                                                    <option value="{{ $code->ParaDescription }}">
                                                        {{ $code->ParaDescription }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                        </div>

                                        </div>
                                        CourseList
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
                                                                <th>Student Code</th>
                                                                <th>Attandance Status</th>
                                                                <th>INTIME</th>
                                                                <th>OUTTIME</th>
                                                            
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                          
                                                            @foreach($Student as $k=>$values)
                                                            <tr>
                                                                <td><input type="checkbox" class="checkbox" data-id="{{$values->id}}" name="checks[]"></td>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td><strong><input type="hidden" class="form-control" id="StudentCode" name="StudentCode[]" value="{{ $values->StudentCode }}">{{ $values->StudentCode }} - {{ $values->StudentName }}</strong></td>
                                                                <td>
                                                                    <select class="form-select" aria-label="Default select example" id="AttendanceStatus" name="AttendanceStatus[]">
                                                                        <option selected value="">--Attandance Status--</option>
                                                                   
                                                                        <option value="Present" 
                                                                        {{ old('AttendanceStatus', isset($values) && isset(StudentAttendanceget($values->FacultyCode,date('Y-m-d'))->AttendanceStatus) ?  StudentAttendanceget($values->FacultyCode,date('Y-m-d'))->AttendanceStatus  : '')=='Present' ? 'selected' : '' }} 
                                                                        >Present</option>
                                                                        <option value="Absence"
                                                                        
                                                                        {{ old('AttendanceStatus', isset($values) && isset(StudentAttendanceget($values->FacultyCode,date('Y-m-d'))->AttendanceStatus) ?  StudentAttendanceget($values->FacultyCode,date('Y-m-d'))->AttendanceStatus  : '')=='Absence' ? 'selected' : '' }} 
                                                                        >Absence</option>

                                                                       
                                                                    </select>
                                                                </td>
                                                                <td><input type="time" class="form-control" id="InTime" name="InTime[]" value="@if(isset(StudentAttendanceget($values->FacultyCode,date('Y-m-d'))->InTime)){{StudentAttendanceget($values->FacultyCode,date('Y-m-d'))->InTime}} @endif"></td>
                                                                <td><input type="time" class="form-control" id="OutTime" name="OutTime[]" value="@if(isset(StudentAttendanceget($values->FacultyCode,date('Y-m-d'))->OutTime)){{StudentAttendanceget($values->FacultyCode,date('Y-m-d'))->OutTime}} @endif"></td>
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