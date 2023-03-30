@extends('layouts.app')
@section('content')

<div class="page-body clearfix">
                <!-- Basic Validation -->
             
                @if ($errors->any())
             
                <div class="alert alert-danger" id="errors_all_page">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <div class="panel panel-default">
                    <div class="panel-heading">Role Create</div>
                    <div class="panel-body">
                      
                        <form action="{{ isset($edit_role) ? route('role.update', $edit_role->id) : route('role.store') }}" method="POST" id="RoleForm" autocomplete="off">
                            @csrf
                            {{ isset($edit_role) ? method_field('PUT') : '' }}
                
                             <!-- Add Tender Form -->
                            <div class="card">
                              <div class="card-header">
                                <h3 class="card-title">{{ isset($edit_role) ? 'Edit' : 'Add' }} Role</h3>
                              </div>
                              
                              <!-- form start -->
                              
                                <div class="card-body">
                                  <div class="row">
                                    <div class="form-group col-sm-6 col-lg-4 col-xl-3">
                                      <label for="name">Role Name <span class="required text-danger">*</span></label>
                                      <input type="text" class="form-control" name="role_name" id="role_name" placeholder="Role Name" value="{{ old('name', isset($edit_role) ? $edit_role->name : '' )  }}" >
                                    </div>

                                    <div class="form-group col-sm-6 col-lg-4 col-xl-3">
                                      <label for="description">Description</label>
                                      <textarea class="form-control" name="Description">{{ old('Description', isset($edit_role) ? $edit_role->description : '' )  }}</textarea>
                                    </div>

                                    <div class="form-group col-sm-6 col-lg-4 col-xl-3">
                                        <label>Status <span class="required text-danger">*</span></label>
                                        <select class="form-control" name="status" id="status">
                                          <option {{ old('status', isset($edit_role)&&($edit_role->status==1) ? 'selected' : '' ) }} value="Active">Active</option>
                                          <option {{ old('status', isset($edit_role)&&($edit_role->status==0) ? 'selected' : '' ) }} value="In-Active">Inactive</option>
                                        </select>
                                    </div>
                
                                   
                
                                  </div>
                                  
                                    <div class="card-footer">
                                    <button type="submit"   class=" m-w-105 btn btn-sm btn-success">@if(!empty($edit_users->id)) Update @else Save @endif</button>
            
            
            <a href="{{route('role.index')}}" type="submit" class=" m-w-105 btn btn-sm btn-danger">Cancel</a>
                                 </div>
                                </div>
                            </form>
              <!-- /.card -->
  
        
                              
                </div>
            </div>

            <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> -->


<script>

    
    $('#RoleForm').validate({
        rules: {
            role_name: {
                required: true
            },
            status: {
                required: true
            },
        },
        messages: {
            role_name: {
                required: "Please enter a Role name "
            },
            status: {
                required: "Please select status"
            },
   
        },
     
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

</script>


@endsection