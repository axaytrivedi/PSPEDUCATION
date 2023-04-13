                            
 @extends('layouts.app')
 @section('content')                           
 
                             <div class="card mb-3">
                                 <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                     <h6 class="mb-0 fw-bold ">Role</h6> 
                                 </div>
                                 <div class="card-body">
                                 @if ($errors->any())
                                 <div class="alert alert-danger" id="errors_all_page">
                                     <ul>
                                         @foreach ($errors->all() as $error)
                                         <li>{{ $error }}</li>
                                         @endforeach
                                     </ul>
                                 </div>
                                 @endif
                                 <form id="facultyattForm" method="post"
                                     action=" @if(!empty($edit_role->id)!=0)  {{route('role.update',$edit_role->id)}}   @else {{route('role.store')}}@endif"
                                     enctype="multipart/form-data">
 
                                     @if(!empty($edit_role->id)) @method('PATCH') @endif @csrf
                                         <div class="row g-3 align-items-center">
                                         <div class="card-header">
                                             <h3 class="card-title">{{isset($edit_role)?'Edit':"Add"}} Role</h3>
                                             <!-- <a href="{{route('role.index')}}" class=" btn  my_btn  ml-auto"> Back</a> -->
                                         </div>
                                             <div class="col-md-6"> 
                                             <label for="name">Role Name <span class="required text-danger">*</span></label>
                                             <input type="text" class="form-control" name="role_name" id="role_name" placeholder="Role Name" value="{{ old('name', isset($edit_role) ? $edit_role->name : '' )  }}" >
                                            </div>
                                             <div class="col-md-6">
                                             <label for="description">Description</label>
                                      <textarea class="form-control" name="Description">{{ old('Description', isset($edit_role) ? $edit_role->description : '' )  }}</textarea>
                                   </div>
                                             <div class="col-md-6">
                                             <label>Status <span class="required text-danger">*</span></label>
                                        <select class="form-control" name="status" id="status">
                                          <option {{ old('status', isset($edit_role)&&($edit_role->status==1) ? 'selected' : '' ) }} value="Active">Active</option>
                                          <option {{ old('status', isset($edit_role)&&($edit_role->status==0) ? 'selected' : '' ) }} value="In-Active">Inactive</option>
                                        </select>
                                             </div>
                                         </div>
                                         <br>
                                         <button type="submit"   class=" m-w-105 btn btn-sm btn-success">@if(!empty($edit_users->id)) Update @else Save @endif</button>
                                    <a href="{{route('role.index')}}" type="submit" class=" m-w-105 btn btn-sm btn-danger">Cancel</a>
                                    </div>     
                                </form>
                                 </div>
                             </div>
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

 @endsection