@extends('layouts.app')
@section('content')
                            <div class="card mb-3">
                                <div class="card-header py-3  bg-transparent border-bottom-0">
                                    <div>
                                            <div class="pull-left">
                                            <h6 class="mb-0 fw-bold ">Student Details Table</h6> 
                                            </div>
                                            <div class="pull-right">
                                                <a class="btn btn-success" href="{{ route('studentAttendance.create') }}"> Create New</a>
                                            </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>LectureCode</th>
                                                <th>LectureDate</th>
                                                <th>StudentCode</th>
                                                <th>AttendanceStatus</th>
                                                <th width="280px">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($studentatt as $k=>$values)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $values->LectureCode }}</td>
                                                    <td>{{ $values->LectureDate }}</td>
                                                    <td>{{ $values->StudentCode }}</td>
                                                    <td>{{ $values->AttendanceStatus }}</td>

                                                    <td>
                                                        <form action="{{ route('studentAttendance.destroy',$values->id) }}" method="POST">
                                        
                                            
                                                            <a class="btn btn-primary" href="{{ route('studentAttendance.edit',$values->id) }}"><i class="icofont-ui-edit"></i></a>
                                        
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
                                </div>
                            </div>
@endsection