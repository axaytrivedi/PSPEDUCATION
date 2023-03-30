                            
 @extends('layouts.app')
 @section('content')                           
 
                             <div class="card mb-3">
                                 <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                     <h6 class="mb-0 fw-bold ">Faculty Subject</h6> 
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
                                 <form id="facultysubform" method="post"
                                     action=" @if(!empty($edit_facultysub->id)!=0)  {{route('facultySubject.update',$edit_facultysub->id)}}   @else {{route('facultySubject.store')}}@endif"
                                     enctype="multipart/form-data">
 
                                     @if(!empty($edit_facultysub->id)) @method('PATCH') @endif @csrf
                                         <div class="row g-3 align-items-center">
                                         <div class="card-header">
                                             <h3 class="card-title">{{isset($edit_facultysub)?'Edit':"Add"}} Faculty Subject</h3>
                                             <a href="{{route('facultySubject.index')}}" class=" btn  my_btn  ml-auto"> Back</a>
                                         </div>
                                         <div class="col-md-6">
                                                <label for="FacultyCode" class="form-label">FacultyCode</label>
                                              
                                                <select type="text" class="form-control" id="FacultyCode"  name="FacultyCode">
                                                    <option selected disabled>-- Select Faculty Code/Name --</option>
                                                    @foreach($facultys as $fact)
                                                     <option value="{{$fact->id}}" {{ old('FacultyCode', isset($edit_facultysub->FacultyCode) && $fact->id ?  'selected' : '' ) }}"> {{$fact->FacultyCode}} / {{$fact->firstName}} </option>

                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="CourseCode" class="form-label">CourceCode</label>
                                                <input type="text" class="form-control" id="CourceCode" 
                                                name="CourceCode" value="{{ old('CourceCode', isset($edit_facultysub->CourceCode) ?  $edit_facultysub->CourceCode  : '' ) }}" >
                                            </div>
                                           
                                            <div class="col-md-6">
                                                <label  class="form-label">SubjectCode</label>
                                                <input type="text" class="form-control" id="SubjectCode" 
                                                name="SubjectCode" value="{{ old('SubjectCode', isset($edit_facultysub->SubjectCode) ?  $edit_facultysub->SubjectCode  : '' ) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label  class="form-label">EffFrom</label>
                                                <input type="date" class="form-control" id="EffFrom" 
                                                name="EffFrom" value="{{ old('EffFrom', isset($edit_facultysub->EffFrom) ?  $edit_facultysub->EffFrom  : '' ) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label  class="form-label">EffUpto</label>
                                                <input type="date" class="form-control" id="EffUpto" 
                                                name="EffUpto" value="{{ old('EffUpto', isset($edit_facultysub->EffUpto) ?  $edit_facultysub->EffUpto  : '' ) }}">
                                            </div>
                                         </div>
                                             <button type="submit" class="btn btn-success mt-4">@if(!empty($edit_facultysub->id))
                                                 Update @else Save @endif</button>
                                             <a href="{{route('facultySubject.index')}}" type="submit"
                                                 class=" m-w-105 btn btn-danger mt-4">Cancel</a>
                                     </form>
                                 </div>
                             </div>
<script>

    $("#FacultyCode").select2();
$('#facultysubform').validate({
    rules: {
        FacultyCode: {
            required: true
        },
        CourceCode: {
            required: true
        },
        SubjectCode: {
            required: true
        },
        EffFrom: {
            required: true
        },
        EffUpto: {
            required: true
        },
    },
    messages: {
        FacultyCode: {
            required: "Please enter FacultyCode "
        },
        CourceCode: {
            required: "Please enter CourceCode "
        },
        SubjectCode: {
            required: "Please enter SubjectCode "
        },

        EffFrom: {
            required: "Please enter EffFrom "
        },
        EffUpto: {
            required: "Please enter EffUpto "
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