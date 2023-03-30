@extends('layouts.app')
@section('content')
                            <div class="card mb-3">
                                <div class="card-header py-3  bg-transparent border-bottom-0">
                                    <div>
                                            <div class="pull-left">
                                            <h6 class="mb-0 fw-bold ">Faculty Details Table</h6> 
                                            </div>
                                            <div class="pull-right">
                                                <a class="btn btn-success" href="{{ route('faculty.create') }}"> Create New</a>
                                            </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>FacultyCode</th>
                                                <th>Title</th>
                                                <th>FacultyName</th>
                                                <th>DOB</th>
                                                <th>DateOfJoining</th>
                                                <th>Gender</th>
                                                <th>Qualification</th>
                                                <th>WorkingStartTime</th>
                                                <th>WorkingEndTime</th>
                                                <th>Status</th>
                                                <th width="280px">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($facultys as $k=>$values)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $values->FacultyCode }}</td>
                                                    <td>{{ $values->Title }}</td>
                                                    <td>{{ $values->FacultyName }}</td>
                                                    <td>{{ $values->DOB }}</td>
                                                    <td>{{ $values->DateOfJoining }}</td>
                                                    <td>{{ $values->Gender }}</td>
                                                    <td>{{ $values->Qualification }}</td>
                                                    <td>{{ $values->WorkingStartTime }}</td>
                                                    <td>{{ $values->WorkingEndTime }}</td>
                                                    <td>{{ $values->Status }}</td>
                                                    <td>
                                                        <form action="{{ route('faculty.destroy',$values->id) }}" method="POST">
                                                                                    
                                                            <a class="btn btn-primary" href="{{ route('faculty.edit',$values->id) }}"><i class="icofont-ui-edit"></i></a>
                                        
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