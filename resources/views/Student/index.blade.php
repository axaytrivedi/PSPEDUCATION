@extends('layouts.app')
@section('content')
                            <div class="card mb-3">
                                <div class="card-header py-3  bg-transparent border-bottom-0">
                                    <div>
                                            
                                            <div class="pull-right">
                                                <a class="btn btn-success" href="{{ route('student.create') }}"> Create New</a>
                                            </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="myDataTable" class=" table-responsive table table-hover align-middle mb-0" >
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>CourceCode</th>
                                                <th>BatchCode</th>
                                                <th>StudentCode</th>
                                                <th>RollNo</th>
                                                <th>StudentName</th>
                                                <th >Action</th>
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
                                                    <td>
                                                           <form action="{{ route('student.destroy',$values->id) }}" method="POST">
                                                                <a class="btn btn-primary" href="{{ route('student.edit',$values->id) }}"><i class="icofont-ui-edit"></i></a>
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