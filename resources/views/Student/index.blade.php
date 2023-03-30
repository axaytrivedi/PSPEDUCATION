@extends('layouts.app')
@section('content')
                            <div class="card mb-3">
                                <div class="card-header py-3  bg-transparent border-bottom-0">
                                    <div>
                                          

                                            <h6 class="mb-0 fw-bold ">Student Details Table</h6> 
                                            <hr>
                                                <form method="post" action="{{route('getfilteredStudent')}}">
                                                  @csrf  
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                <label><strong>Course Code :</strong></label>
                                                                <select id='status' name="studentCode"class="form-control" style="width: 200px">
                                                                    <option value="">--Select Code--</option>
                                                                    <option value="1"
                                                                        @if(isset($studentCode) && $studentCode ==1) selected @endif>1</option>
                                                                    <option value="2"  @if(isset($studentCode) && $studentCode ==2) selected @endif>2</option>
                                                                </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label><strong>Batch Code :</strong></label>
                                                                    <select id='status'name="studentBatchCode" class="form-control" style="width: 200px">
                                                                        <option value="">--Select  Batch Code--</option>
                                                                        <option value="1" @if(isset($studentBatchCode) && $studentBatchCode ==1) selected @endif>1</option>
                                                                        <option value="2"  @if(isset($studentBatchCode) && $studentBatchCode ==2) selected @endif>2</option>
                                                                
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <button style="margin-top: 21px;"type="submit" class="btn btn-success" name="search">Search</button>

                                                            </div>

                                                        </div>
                                                       
                                                    </div>
                                                </form>
                                            
                                            
                                            <!-- <div class="pull-right">
                                                <a class="btn btn-success" href="{{ route('student.create') }}"> Create New</a>
                                            </div> -->
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>CourceCode</th>
                                                <th>BatchCode</th>
                                                <th>StudentCode</th>
                                                <th>RollNo</th>
                                                <th>StudentName</th>
                                                <!-- <th>DOB</th> -->
                                                <!-- <th>DateOfJoining</th> -->
                                                <!-- <th>Gender</th> -->
                                                <!-- <th>AcademinSession</th> -->
                                                <!-- <th>Status</th> -->
                                                <!-- <th width="280px">Action</th> -->
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($students as $k=>$values)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $values->CourceCode }}</td>
                                                    <td>{{ $values->BatchCode }}</td>
                                                    <td>{{ $values->StudentCode }}</td>
                                                    <td>{{ $values->RollNo }}</td>
                                                    <td>{{ $values->StudentName }}</td>
                                                    <!-- <td>{{ $values->DOB }}</td> -->
                                                    <!-- <td>{{ $values->DateOfJoining }}</td> -->
                                                    <!-- <td>{{ $values->Gender }}</td> -->
                                                    <!-- <td>{{ $values->AcademinSession }}</td> -->
                                                    <!-- <td>{{ $values->Status }}</td> -->
                                                    
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
@endsection