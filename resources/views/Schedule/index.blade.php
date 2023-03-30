@extends('layouts.app')
@section('content')
                            <div class="card mb-3">
                                <div class="card-header py-3  bg-transparent border-bottom-0">
                                    <div>
                                            <div class="pull-left">
                                            <h6 class="mb-0 fw-bold ">Schedule Table</h6> 
                                            </div>
                                            <div class="pull-right">
                                                <a class="btn btn-success" href="{{ route('schedule.create') }}"> Create New</a>
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
                                                <th>CourceCode</th>
                                                <th>BatchCode</th>
                                                <th>DateOfWeek</th>
                                                <th>Session</th>
                                                <th>TimingFrom</th>
                                                <th>TimingUpto</th>
                                                <th>SubjectCode</th>
                                                <th>FacultyCode</th>
                                                <th>Venue</th>
                                                <th>EffFrom</th>
                                                <th>EffUpto</th>
                                                <th width="280px">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($schedule as $k=>$values)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $values->LectureCode }}</td>
                                                    <td>{{ $values->CourceCode }}</td>
                                                    <td>{{ $values->BatchCode }}</td>
                                                    <td>{{ $values->DateOfWeek }}</td>
                                                    <td>{{ $values->Session }}</td>
                                                    <td>{{ $values->TimingFrom }}</td>
                                                    <td>{{ $values->TimingUpto }}</td>
                                                    <td>{{ $values->SubjectCode }}</td>
                                                    <td>{{ $values->FacultyCode }}</td>
                                                    <td>{{ $values->Venue }}</td>
                                                    <td>{{ $values->EffFrom }}</td>
                                                    <td>{{ $values->EffUpto }}</td>
                                                    <td>
                                                        <form action="{{ route('schedule.destroy',$values->id) }}" method="POST">
                                                                                    
                                                            <a class="btn btn-primary" href="{{ route('schedule.edit',$values->id) }}"><i class="icofont-ui-edit"></i></a>
                                        
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