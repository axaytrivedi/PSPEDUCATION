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
                                        <table class=" table-responsive table table-hover align-middle mb-0" >
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
                                                           
                                                                <a class="btn btn-primary" href="{{ route('student.edit',$values->id) }}"><i class="icofont-ui-edit"></i></a>
                                                                    
                                                                <!-- <a href="javascript:void(0)"data-id="{{ $values->id }}" data-cName="{{ $values->CourceCode }}" class="btn btn-danger Delete"><i class="icofont-ui-delete"></i></a>                                                         -->
                                                    </td>
                                                    
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
<script>
$(".Delete").click(function(){
   var id= $(this).data('id');
   alert(id);
   var companyName= $(this).attr('data-cName');
    var confirms = confirm("Are you sure you want to delete this record ?"+companyName);
    if(confirms === true)
    {
        $.ajax({
            type: "POST",
            url: "{{url('StudentDelete')}}",
            data: {
                "_token": "{{ csrf_token() }}",
                id: id
            },
            dataType: 'json',
            success: function(res)
            {
                $("#update").addClass('alert-success');
                $("#update").html(res.msg);
                $("#id_rmv"+id).remove();
            }
        });
    }
    // $("#update").html('');
    // $("#update").removeClass('alert-success');
});  

</script>
@endsection