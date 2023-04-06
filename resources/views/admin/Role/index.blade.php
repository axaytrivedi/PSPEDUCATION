@extends('layouts.app')

@section('content')

<div class="page-body">
       
                <div class="alert {{(Session::has('msg') !='')? 'alert-success':''}}" id="update" >
                     {!! Session::has('msg') ? Session::get("msg") : '' !!}
                </div>
    <div class="panel panel-default">
        <div class="panel-heading"> 
        <div class="action_btn_box">
                <a  href="{{route('role.create')}}"type="button"  class="m-w-105 btn btn-success" >Create</a>
            <div class="btn-group">
                <!-- <button type="button" class="btn btn-primary">Action</button>
                <button type="button"  class="btn btn-primary dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button> -->
                <!-- <ul class="dropdown-menu">
                    <li><a href="javascript:void(0);" onclick="status('Active')">Active</a></li>
                    <li><a href="javascript:void(0);" onclick="status('Inactive')">Inactive</a></li>
                    
                </ul> -->
            </div>
</div>
        </div>
        <!-- <div class="panel-heading"> 
            <button class="btn btn-primary" >sdfsdf</button>
           </div> -->
        
            <div class="panel-body">
            <table class="table table-striped table-hover js-exportable dataTable">
                                <thead>
                                    <tr>
                                            <!-- <th style="width: 1%"><input type='checkbox' class="checkbox"  id='checkAll'></th> -->
                                        <th>Sr No.</th>
                                        <th>Name</th>
                                        <th>Permission</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($roles as $values)

                                    <tr id="id_rmv{{$values->id}}">
                                        <!-- <td><input type="checkbox" class="checkbox"  data-id="{{$values->id}}" name="checks[]" ></td> -->
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$values->name}}</td>
                                        <td> <a href="{{route('Module.permission',$values->id)}}"  class="badge bg-success" >Permission</a></td>

                                        <td  id="status{{$values->id}}"><p   class="badge {{($values->status == 'Active')? 'bg-success' :'bg-danger'}}  btn-sm">{{$values->status}}</p></td>
                                        <td>
                                            <div class="action_btn_group">
                                                <!-- <a href="{{route('role.show',$values->id)}}"class="btn btn-primary"><i class="fa fa-eye"></i></a> -->
                                                <a href="{{route('role.edit',$values->id)}}" class="btn btn-primary"btn btn-primary" ><i class="fa fa-edit"></i></a>
                                                <!-- <button href="#" data-id="{{$values->id}}" data-roleName="{{$values->role_name}}" class="btn btn-danger Delete"><i class="fa fa-trash-o"></i></button> -->
                                            </div>
                                        </td>
                                  
                                    
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                    <!-- <th></th> -->
                                    <th>Sr No.</th>
                                        <th>Name</th>
                                        <th>Permission</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                            </table>
            </div>
        </div>

    </div>
</div>
<script>
$.ajaxSetup({
                        headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
             });
$(".Delete").click(function(){
    id= $(this).data('id');
    roleName= $(this).attr('data-roleName');
    
    
    var confirms  =confirm("Are You Sure  you Want to delete this "+roleName);
    if(confirms === true)
    {
        $.ajax({
            type: "POST",
            url: "{{url('role_destroy')}}",
            data: {
                // "_token": "{{ csrf_token() }}",
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
//     $("#Updaste").html('');
// $("#Updaste").removeClass('alert-success');
});

function status(flag)
{

    var idsArr = [];
        $(".checkbox:checked").each(function() {
            idsArr.push($(this).attr('data-id'));
        });

        if (idsArr.length <= 0) {
            alert("Please select atleast one record to status change.");
        } else {
            // var strIds = idsArr.join(",");

        }

        $.ajax({
                type: "POST",
                url: "{{ route('role.status') }}",
                data: {
                    id: idsArr,
                    value: flag
                },
                dataType: 'json',
                success: function(res) {
                  
                    $("#update").addClass("alert-success")
                    if(res.msg == 1)
                    {
                        $("#update").html("Roles Status Actived  Successfully ")

                       
                       
                        $(".checkbox:checked").each(function() {
                            $(".checkbox").prop( "checked", false );
                        });
                      
                        $.each(idsArr,function(index,value){
                            if(flag ==='Active')
                            {
                                var Classes="badge bg-success";

                            }
                            else
                            {
                                var Classes="badge bg-danger";
                            }
                            $("#status"+value).html('<p class="'+Classes+ '" status">'+flag+'</p>')
                        });
                      
                
                    }
                    else
                    {
                        $("#update").html("Roles Status In-actived  Successfully ")
                    }
          
                }
            });
  
}
</script>
@endsection