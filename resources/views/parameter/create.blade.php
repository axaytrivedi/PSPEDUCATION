@extends('layouts.app')
@section('content') 

<div class="card mb-3">
    <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
        <h6 class="mb-0 fw-bold ">Add {{$ParameterMaster->ParaDescription}} </h6>
    </div>
    <div class="card-body">
        <form method="post" id="parameterid" action="{{route('parameter.store')}}" enctype='multipart/form-data'>
            <div class="row g-3 align-items-center">
            @csrf
           
                <div class="col-md-3">
                    <label  class="form-label"> Name </label>
                    <div class="input-group  form-group mb-3">
                   
                    <input type="hidden" value=" {{$ParameterMaster->ParaDescription}}"name="ParaFilter1" class="form-control ">

                        <input type="text" name="ParaDescription" class="form-control allowCharcterOnly">
                            @if($errors->has('ParaDescription'))
                                <div class="error">{{ $errors->first('ParaDescription') }}</div>
                            @endif
                    </div>
                </div>
                
               
                 <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <div class="input-group form-group mb-3">
                    
                            <select class="form-control" name="Validity"> 
                            <option selected disabled >-- Select Status --</option>

                            <option value="Active">Active</option>
                            <option value="Inactive">In-Active</option>
                            </select>
                    </div>
                </div>
                <div class="col-md-12">
                        <button type="submit" class="btn btn-primary py-2 px-5 text-uppercase btn-set-task w-sm-100">Store</button>
                        <a href="{{url('parameter')}}" class="btn btn-danger py-2 px-5 text-uppercase btn-set-task w-sm-100">Cancle</a>     
                </div>

                
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
$(document).ready(function(){

    $("#filter").select2();
            $('#parameterid').validate({
                rules: {
                    ParaDescription: { required: true}, 
                    // file:{extension:"jpeg|png|jpg|gif|svg|webp",},
                    Validity:{required:true },
                },
                messages: {
                    ParaDescription: { required: "Please enter Category name ", },
                    // file:{extension:"Only Allow jpeg|png|jpg|gif|svg|webp",},
                    Validity:{required:"Please Select Status"}, 
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
});
</script>
@endsection