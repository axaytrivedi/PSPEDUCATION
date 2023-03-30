@extends('layouts.app')
@section('content')

                                <div class="card-body"> 
                                    <table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">  
                                    <table class="table table-hover">
                                        
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>StudentCode</th>
                                                <th>RollNo</th>
                                                <th>StudentName</th>
                                                <th>DOB</th>
                                                <th>DateOfJoining</th>
                                                <th>Gender</th>
                                                <th>CourceCode</th>
                                                <th>BatchCode</th>
                                                <th>AcademinSession</th>
                                                <th>Status</th>
                                                <th width="280px">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($students as $k=>$values)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $values->StudentCode }}</td>
                                                    <td>{{ $values->RollNo }}</td>
                                                    <td>{{ $values->StudentName }}</td>
                                                    <td>{{ $values->DOB }}</td>
                                                    <td>{{ $values->DateOfJoining }}</td>
                                                    <td>{{ $values->Gender }}</td>
                                                    <td>{{ $values->CourceCode }}</td>
                                                    <td>{{ $values->BatchCode }}</td>
                                                    <td>{{ $values->AcademinSession }}</td>
                                                    <td>{{ $values->Status }}</td>
                                                    <td>
                                                        <form action="{{ route('student.destroy',$values->id) }}" method="POST">
                                        
                                                            <a class="btn btn-info" href="{{ route('student.show',$values->id) }}">Show</a>
                                                            <a class="btn btn-primary" href="{{ route('student.edit',$values->id) }}">Edit</a>
                                        
                                                            @csrf
                                                            @method('DELETE')
                                            
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                        </tbody>
                                    </table>
                                </div>
@endsection