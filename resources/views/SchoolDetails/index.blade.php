@extends('layouts.app')
@section('content')
                            <div class="card mb-3">
                                <div class="card-header py-3  bg-transparent border-bottom-0">
                                    <div>
                                            <div class="pull-left">
                                            <h6 class="mb-0 fw-bold ">Company Details Table</h6> 
                                            </div>
                                            <div class="pull-right">
                                                <a class="btn btn-success" href="{{ route('details.create') }}"> Create New</a>
                                            </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>CompanyName</th>
                                                <th>AddressLine1</th>
                                                <th>AddressLine2</th>
                                                <th>AddressLine3</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>Country</th>
                                                <th>Pin</th>
                                                <th>ContactPerson</th>
                                                <th>Email</th>
                                                <th>Phone1</th>
                                                <th>Phone2</th>
                                                <th>WhatsAppNo</th>
                                                <th>WebsiteLink</th>
                                                <th width="280px">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($details as $k=>$values)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $values->SchoolName }}</td>
                                                    <td>{{ $values->AddressLine1 }}</td>
                                                    <td>{{ $values->AddressLine2 }}</td>
                                                    <td>{{ $values->AddressLine3 }}</td>
                                                    <td>{{ $values->City }}</td>
                                                    <td>{{ $values->State }}</td>
                                                    <td>{{ $values->Country }}</td>
                                                    <td>{{ $values->Pin }}</td>
                                                    <td>{{ $values->ContactPerson }}</td>
                                                    <td>{{ $values->Email }}</td>
                                                    <td>{{ $values->Phone1 }}</td>
                                                    <td>{{ $values->Phone2 }}</td>
                                                    <td>{{ $values->WhatsAppNo }}</td>
                                                    <td>{{ $values->WebsiteLink }}</td>
                                                    <td>
                                                        <form action="{{ route('details.destroy',$values->id) }}" method="POST">
            
                                                            <a class="btn btn-primary" href="{{ route('details.edit',$values->id) }}"><i class="icofont-ui-edit"></i></a>
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