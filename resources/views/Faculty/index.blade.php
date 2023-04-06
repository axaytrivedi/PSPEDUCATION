@extends('layouts.app') @section('content') 
<div class="card mb-3">
   <div class="card-header py-3 bg-transparent border-bottom-0">
      <div>
         <div class="pull-left">
            <h6 class="mb-0 fw-bold ">Faculty Details Table</h6>
         </div>
         <div class="pull-right"> <a class="btn btn-success" href="{{ route('faculty.create') }}"> Create New</a> </div>
      </div>
   </div>
   <div class="card-body">
   <div class="alert {{(Session::has('msg') !='')? 'alert-success' :''}}" id="update" >
        {!! Session::has('msg') ? Session::get("msg") : '' !!}
    </div>
      <div class="table-responsive">
      <table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
            <thead>
               <tr>
                  <th>No</th>
                  <th>FacultyCode</th>
                  <th>Title</th>
                  <th>FacultyName</th>
                  <th>Status</th>
                  <th >Action</th>
               </tr>
            </thead>
            <tbody>
               @foreach($facultys as $k=>$values) 
               <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $values->FacultyCode }}</td>
                  <td>{{ $values->Title }}</td>
                  <td>{{ $values->firstName }} {{ $values->last_name }}</td>
                  <td>{{ $values->Status }}</td>
                  <td>
                    <a class="btn btn-primary" href="{{ route('faculty.edit',$values->id) }}"><i class="icofont-ui-edit"></i></a>  
                    <!-- <a href="javascript:void(0)"data-id="{{ $values->id}}" data-cName="{{ $values->FacultyCode }}" class="btn btn-danger Delete"><i class="icofont-ui-delete"></i></a>  -->
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
   var companyName= $(this).attr('data-cName');

    var confirms = confirm("Are you sure you want to delete this record ?"+companyName);
    if(confirms === true)
    {
        $.ajax({
            type: "POST",
            url: "{{url('FacultyDelete')}}",
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