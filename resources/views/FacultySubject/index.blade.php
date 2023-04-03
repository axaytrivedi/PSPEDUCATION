@extends('layouts.app')
@section('content')
                            <div class="card mb-3">
                                <div class="card-header py-3  bg-transparent border-bottom-0">
                                    <div>
                                            <div class="pull-left">
                                            <h6 class="mb-0 fw-bold ">Faculty Details Table</h6> 
                                            </div>
                                            <div class="pull-right">
                                                <a class="btn btn-success" href="{{ route('facultySubject.create') }}"> Create New</a>
                                            </div>
                                    </div>
                                </div>
                                <div class="card-body">
                             
                                    <table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>FacultyCode</th>
                                                <th>Cource Name</th>
                                                <th>Subject Names</th>
                                                <th>EffFrom</th>
                                                <th>EffUpto</th>
                                                <th width="280px">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($facultysub as $k=>$values)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $values->FacultyCode }}</td>
                                                    <td>{{ $values->CourseCode }}</td>
                                                    <td>{{ $values->SubjectCode }}</td>
                                                    <td>{{ ShowNewDateFormat($values->EffFrom) }}</td>
                                                    <td>{{ ShowNewDateFormat($values->EffUpto) }}</td>
                                                    <td>
                                                        <form action="{{ route('facultySubject.destroy',$values->id) }}" method="POST">
                                        
                                                            <a class="btn btn-primary" href="{{ route('facultySubject.edit',$values->id) }}"><i class="icofont-ui-edit"></i></a>
                                        
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
@endsection