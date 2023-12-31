                            
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
                                         <div class="col-md-6 form-group">
                                                <label for="FacultyCode" class="form-label">FacultyCode / Name</label>
                          
                                                <select class="form-control" id="FacultyCode"  name="FacultyCode">
                                                    <option selected disabled>-- Select Faculty Code/Name --</option>
                                                    @foreach($facultys as $fact)
                                                    
                                                     <option value="{{$fact->FacultyCode}}"
                                                     @if(isset($edit_facultysub->FacultyCode) &&$edit_facultysub->FacultyCode == $fact->FacultyCode  ) selected @endif 
                                                     > {{$fact->FacultyCode}} / {{$fact->firstName}} </option>

                                                    @endforeach
                                                </select>
                                                
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="CourseCode" class="form-label">Location</label>
                                            
                                          
                                                <select  name="Location"  class="form-control Location" id="MainLocation" >
                                                    <option selected disabled>-- Select Location --</option>
                                                    @foreach($Location as $l)
                                                     <option value="{{$l->ParaDescription}}" 
                                                       
                                                        {{ old('Location', isset($edit_facultysub->Location) ? $edit_facultysub->Location : '')==$l->ParaDescription? 'selected' : '' }}
                                                        > {{$l->ParaDescription}} </option>

                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="CourseCode" class="form-label">CourceCode/CourseName</label>
                                            

                                                <select  name="CourceCode"  class="form-control CourseCode" id="CourseCode" >
                                                    <option selected disabled>-- Select Course --</option>
                                                    @if(isset($edit_facultysub->CourseCode))

                                                   
                                                     <option value="{{$edit_facultysub->CourseCode}}" selected>{{$edit_facultysub->CourseCode}}</option>

                                         
                                    
                                                    @endif
                                                </select>
                                            </div>
                                           
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">SubjectCode / Name</label>
                                           
                                                <select multiple name="SubjectCode[]" class="form-control" id="SubjectCode" >
                                                @if(isset($edit_facultysub->SubjectCode))
                                                    @foreach($SubjectCode as $c)
                                                     <option value="{{$c->ParaDescription}}" 
                                                    
                                                     @if(isset($edit_facultysub->SubjectCode) && in_array($c->ParaDescription,explode(",",$edit_facultysub->SubjectCode)))
                                                     selected
                                                     @endif

                                                     >  {{$c->ParaDescription}} </option>

                                                    @endforeach
                                                @endif

                                                
                                                </select> 

                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">EffFrom</label>
                                                <input type="date" class="form-control" id="EffFrom" 
                                                name="EffFrom" value="{{ old('EffFrom', isset($edit_facultysub->EffFrom) ?  $edit_facultysub->EffFrom  : '' ) }}">
                                            </div>
                                            <!-- <div class="col-md-6 form-group">
                                                <label  class="form-label">EffUpto</label>
                                                <input type="date" class="form-control" id="EffUpto" 
                                                name="EffUpto" value="{{ old('EffUpto', isset($edit_facultysub->EffUpto) ?  $edit_facultysub->EffUpto  : '' ) }}">
                                                <customeDateAlert id="customeDateAlert"> </customeDateAlert>
                                            </div> -->
                                         </div>
                                             <button type="submit" class="btn btn-success mt-4">@if(!empty($edit_facultysub->id))
                                                 Update @else Save @endif</button>
                                             <a href="{{route('facultySubject.index')}}" type="submit"
                                                 class=" m-w-105 btn btn-danger mt-4">Cancel</a>
                                     </form>
                                 </div>
                             </div>
<script>
$( document ).ready(function() {

    $("#FacultyCode").select2();
    $("#CourceCode").select2({  placeholder: "Select Course Code", allowClear: true});
    $("#SubjectCode").select2({  placeholder: "Select Subject Code/Name", allowClear: true});
   
   
    $("#MainLocation").on("change",function(){
              $.post("{{route('GetLocationWieseCourse')}}",{id:$(this).val(),'_token':"{{csrf_token()}}"},function(suc){
                var row=" ";
                var row1=" ";
                if(isNaN(suc.data))
                {  

                    row="<option selected>-- Select Course --</option>";
                    $.each(suc.data,function(i,v){
                    row+="<option value='"+v.ParaDescription+"'>"+v.ParaDescription+"</option>";
                  
                    // row1="<option selected>-- Select Subject --</option>";
                });
                }
                else
                {
                    row="<option selected> No  Course Found For this Location </option>";
                    row1="<option selected> No  Subject  Found For this Course </option>";
                    $("#SubjectCode").html(row1);
                }
               
                $(".CourseCode").html(row);
             
                $("#SubjectCode").empty().trigger('change');
              });
    }); 
    
    $(".CourseCode").on("change",function(){
        var id= $(this).val();
        var MainLocation = $("#MainLocation").val();
        getSubject(MainLocation,id);
    });


    
    function getSubject(MainLocation,id)
    {
        $.post("{{route('GetsubjectCode')}}",{"MainLocation":MainLocation,"id":id,_token:"{{csrf_token()}}"},function(ak){

        // $("#SubjectCode").select2({  placeholder: "Select Subject Code/Name", allowClear: true});
        $("#SubjectCode").empty().trigger('change');
        var row="";
        if(isNaN(ak))
        {
            
            $.each(ak,function(i,v){
                row+="<option value='"+v.ParaDescription+"'>"+v.ParaDescription+"</option>";
            });
        }
        $("#SubjectCode").html(row);
        });
    }
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
                required: "Please Select FacultyCode "
            },
            CourceCode: {
                required: "Please Select CourceCode "
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
});
</script>
<script>



</script>
 @endsection