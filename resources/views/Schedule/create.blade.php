                            
 @extends('layouts.app')
 @section('content')       
 <style>
         .table>:not(caption)>*>* {
             padding: 3px 5px !important;
         } 
     .table tr td {
         border-color: var(--border-color);
         color: var(--text-color);
         border: 1px solid;
     }
     .table th {
         border-color: var(--border-color);
         color: var(--text-color);
         border: 1px solid;
     }
 </style>                    
 
                             <div class="card mb-3">
                                 <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                     <h6 class="mb-0 fw-bold ">Schedule</h6> 
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
                                     <div class="row g-3 mb-3">
                                         <div class="col-md-12">
                                             <div class="card">
                                                <div class="card-body" style="overflow: scroll;">
                                                    <form method="post" id="Schedule" action="{{route('schedule.store')}}" enctype='multipart/form-data'>
                                                      @csrf 
                                                        <div class="row">
                                            
                                                            <div class="col-md-3">
                                                            
                                                                <label for="CourseList" class="form-label">Select Course </label>
                                                                <select class="form-select  CourseList" name="CourseList"  id="CourseList"aria-label="Default select example">
                                                                                    <option selected="">--Course List--</option>
                                                                                    @foreach($CourseList as $subject)
                                                                                    <option value="{{$subject->ParaDescription}}">{{$subject->ParaDescription}}</option>
                                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3">
                                                            
                                                                <label for="CourseList" class="form-label">Select Batch </label>
                                                                <select class="form-select BatchList" name="BatchList" id="BatchList"aria-label="Default select example">
                                                                        <option selected="">--Batch List--</option>
                                                                </select>
                                                            </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <table class="table table-hover align-middle mb-0" style="width: 100%;">
                                                                        <thead>
                                                                            <tr style="border-top:3px solid black;text-align: center;background: #dff0f5;" >
                                                                                <th>DATE</th>
                                                                                <?php
                                                                                    $date1 = date('d-M');
                                                                                    $day1 = date('D');
                                                                                    $day2 = date('D', strtotime($day1. ' + 1 days'));
                                                                                    if($day1 =="Sun")
                                                                                    {
                                                                                        $day1 = date('D', strtotime($day1. ' + 1 days'));
                                                                                        $date1 = date('d-M', strtotime($date1. ' +1 days'));
                                                                                    }      
                                                                                ?>
                                                                                    @for($i=0;$i<=6;$i++)

                                                                                        <th>
                                                                                            {{date('d-M', strtotime($date1. ' +' .$i.' days'))}}
                                                                                            <input type="hidden" name="HeaderDate[]" value="{{date('d-M', strtotime($date1. ' +' .$i.' days'))}}">
                                                                                        </th>
                                                                                    @endfor
                                                                            
                                                                                
                                                                            </tr>
                                                                            <tr style="border-bottom:3px solid black;text-align: center;background: #dff0f5;">
                                                                                <th>DAY</th>
                                                                                
                                                                                    @for($i=0;$i<=6;$i++)
                                                                                        <th> {{date('D', strtotime($day1. ' +' .$i.' days'))}}
                                                                                        <input type="hidden" name="HeaderDay[]" value="{{date('D', strtotime($day1. ' +' .$i.' days'))}}">

                                                                                        </th>
                                                                                    @endfor
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
        
                                                                        @for($i=1;$i<=4; $i++)
                                                                            <tr>
                                                                                <td><strong>TIME</strong></td>
                                                                                <td class="time" >
                                                                                    <div class="d-flex">
                                                                                        <div class="col-md-6 " style="width:100px">
                                                                                            <input type="time" name="dayStart[1][{{$i}}]" class="form-control w-100">
                                                                                            <input type="hidden" name="=storeLocation[1][{{$i}}]" value="1_{{$i}}" class="form-control w-100">

                                                                                        </div>

                                                                                        
                                                                                    
                                                                                        <div class="col-md-6 ms-2">   
                                                                                            <input type="time" name="dayend[1][{{$i}}]"class="form-control w-100">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
        
                                                                                <td class="time" >
                                                                                    <div class="d-flex">
                                                                                        <div class="col-md-6 " style="width:100px">
                                                                                            <input type="time"   name="dayStart[2][{{$i}}]"
                                                                                        class="form-control w-100">
                                                                                        </div>
                                                                                        <div class="col-md-6 ms-2">   
                                                                                            <input type="time"  name="dayend[2][{{$i}}]"class="form-control w-100">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            
                                                                                <td class="time" >
                                                                                    <div class="d-flex">
                                                                                        <div class="col-md-6 " style="width:100px">
                                                                                            <input type="time" name="dayStart[3][{{$i}}]" class="form-control w-100">
                                                                                        </div>
                                                                                        <div class="col-md-6 ms-2">   
                                                                                            <input type="time"   name="dayend[3][{{$i}}]"class="form-control w-100">
                                                                                        </div> 
                                                                            
                                                                                    </div>
                                                                                    
                                                                                    
                                                                                </td>
                                                                                <td class="time" >
                                                                                    <div class="d-flex">
                                                                                        <div class="col-md-6 "  style="width:100px">
                                                                                            <input type="time" name="dayStart[4][{{$i}}]" class="form-control w-100">
                                                                                        </div>
                                                                                        <div class="col-md-6 ms-2">   
                                                                                            <input type="time" name="dayend[4][{{$i}}]" class="form-control w-100">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td class="time" >
                                                                                    <div class="d-flex">
                                                                                        <div class="col-md-6 " style="width:100px">
                                                                                            <input type="time"  name="dayStart[5][{{$i}}]" class="form-control w-100">
                                                                                        </div>
                                                                                        <div class="col-md-6 ms-2">   
                                                                                            <input type="time"  name="dayend[5][{{$i}}]" class="form-control w-100">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td class="time" >
                                                                                    <div class="d-flex">
                                                                                        <div class="col-md-6 " style="width:100px">
                                                                                            <input type="time"  name="dayStart[6][{{$i}}]" class="form-control w-100">
                                                                                        </div>
                                                                                        <div class="col-md-6 ms-2">   
                                                                                            <input type="time" name="dayend[6][{{$i}}]" class="form-control w-100">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td class="time" >
                                                                                    <div class="d-flex">
                                                                                        <div class="col-md-6 " style="width:100px">
                                                                                            <input type="time"  name="dayStart[7][{{$i}}]" class="form-control w-100">
                                                                                        </div>
                                                                                        <div class="col-md-6 ms-2">   
                                                                                            <input type="time" name="dayend[7][{{$i}}]" class="form-control w-100">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                
                                                                                <td><strong>SUB</strong></td>
                                                                                <td>
                                                                                    <select class="form-select subject" name="subject[1][{{$i}}]" data-id="1_{{$i}}"  aria-label="Default select example">
                                                                                    <option disabled selected="">--Subject--</option>
        
                                                                                    
                                                                                    </select>
                                                                                </td>
        
                                                                                <td>
                                                                                    <select class="form-select subject" name="subject[2][{{$i}}]"  data-id="2_{{$i}}" aria-label="Default select example">
                                                                                        <option disabled selected="">--Subject--</option>
                                                                                    
                                                                                    </select>
                                                                                </td>
        
                                                                                <td>
                                                                                    <select class="form-select subject" name="subject[3][{{$i}}]"  data-id="3_{{$i}}" aria-label="Default select example">
                                                                                        <option disabled selected="">--Subject--</option>
                                                                                        
                                                                                    </select>
                                                                                </td>
        
                                                                                <td>
                                                                                    <select class="form-select subject" name="subjec[4][{{$i}}]"  data-id="4_{{$i}}"aria-label="Default select example">
                                                                                        <option disabled selected="">--Subject--</option>
                                                                                        
                                                                                    </select>
                                                                                </td>
        
                                                                                <td>
                                                                                    <select class="form-select subject" name="subject[5][{{$i}}]"  data-id="5_{{$i}}" aria-label="Default select example">
                                                                                        <option disabled selected="">--Subject--</option>
                                                                                    
                                                                                    </select>
                                                                                </td>
        
                                                                                <td>
                                                                                    <select class="form-select subject" name="subject[6][{{$i}}]"  data-id="6_{{$i}}" aria-label="Default select example">
                                                                                        <option disabled selected="">--Subject--</option>
                                                                                        
                                                                                    </select>
                                                                                </td>
        
                                                                                <td>
                                                                                    <select class="form-select subject" name="subject[7][{{$i}}]"  data-id="7_{{$i}}" aria-label="Default select example">
                                                                                        <option disabled selected="">--Subject--</option>
                                                                                        
                                                                                    </select>
                                                                                </td>
                                                                                
                                                                    
                                                                            </tr>
                                                                            <tr>
                                                                                <td><strong>FACULTY</strong></td>
                                                                                <td>
                                                                                    <select class="form-select faculty" name="faculty[1][{{$i}}]"  id="faculty1_{{$i}}" aria-label="Default select example">
                                                                                        <option disabled selected>-- Select-Faculty --</option>
                                                                                
                                                                                    </select>
                                                                                </td>
        
                                                                                <td>
                                                                                    <select class="form-select faculty"  name="faculty[2][{{$i}}]" id="faculty2_{{$i}}" aria-label="Default select example">
                                                                                        <option disabled selected>-- Select-Faculty --</option>
                                                                                    </select>
                                                                                </td>
        
                                                                                <td>
                                                                                    <select class="form-select faculty"  name="faculty[3][{{$i}}]"  id="faculty3_{{$i}}" aria-label="Default select example">
                                                                                        <option disabled selected>-- Select-Faculty --</option>
                                                                                    </select>
                                                                                </td>
        
                                                                                <td>
                                                                                    <select class="form-select faculty"   name="faculty[4][{{$i}}]" id="faculty4_{{$i}}" aria-label="Default select example">
                                                                                        <option disabled selected>-- Select-Faculty --</option>
                                                                                    </select>
                                                                                </td>
        
                                                                                <td>
                                                                                    <select class="form-select faculty"   name="faculty[5][{{$i}}]"  id="faculty5_{{$i}}" aria-label="Default select example">
                                                                                        <option disabled selected>-- Select-Faculty --</option>
                                                                                    </select>
                                                                                </td>
        
                                                                                <td>
                                                                                    <select class="form-select faculty"  name="faculty[6][{{$i}}]" id="faculty6_{{$i}}" aria-label="Default select example">
                                                                                        <option disabled selected>-- Select-Faculty --</option>
                                                                                    </select>
                                                                                </td>
        
                                                                                <td>
                                                                                    <select class="form-select faculty"  name="faculty[7][{{$i}}]" id="faculty7_{{$i}}" aria-label="Default select example">
                                                                                        <option  disabled selected>-- Select-Faculty --</option>
                                                                                    </select>
                                                                                </td>
                                                                            
                                                                            
                                                                            </tr>
                                                                            <tr style="border-bottom:3px solid black">
                                                                                <td><strong>LOCATION</strong></td>
                                                                                <td>
                                                                                    <select class="form-select"  name="location[1][{{$i}}]" aria-label="Default select example">
                                                                                        <option disabled selected>--Select-Location--</option>
                                                                                        @foreach($Location as $l)
                                                                                            <option value="{{$l->ParaDescription}}">{{$l->ParaDescription}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <select class="form-select" name="location[2][{{$i}}]" aria-label="Default select example">
                                                                                        <option disabled selected>--Select-Location--</option>
                                                                                        @foreach($Location as $l)
                                                                                            <option value="{{$l->ParaDescription}}">{{$l->ParaDescription}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <select class="form-select" name="location[3][{{$i}}]" aria-label="Default select example">
                                                                                        <option disabled selected>--Select-Location--</option>
                                                                                        @foreach($Location as $l)
                                                                                            <option value="{{$l->ParaDescription}}">{{$l->ParaDescription}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <select class="form-select" name="location[4][{{$i}}]" aria-label="Default select example">
                                                                                        <option disabled selected>--Select-Location--</option>
                                                                                        @foreach($Location as $l)
                                                                                            <option value="{{$l->ParaDescription}}">{{$l->ParaDescription}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <select class="form-select" name="location[5][{{$i}}]" aria-label="Default select example">
                                                                                        <option disabled selected>--Select-Location--</option>
                                                                                        @foreach($Location as $l)
                                                                                            <option value="{{$l->ParaDescription}}">{{$l->ParaDescription}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <select class="form-select" name="location[6][{{$i}}]" aria-label="Default select example">
                                                                                        <option disabled selected>--Select-Location--</option>
                                                                                        @foreach($Location as $l)
                                                                                            <option value="{{$l->ParaDescription}}">{{$l->ParaDescription}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <select class="form-select" name="location[7][{{$i}}]" aria-label="Default select example">
                                                                                        <option disabled selected>--Select-Location--</option>
                                                                                        @foreach($Location as $l)
                                                                                            <option value="{{$l->ParaDescription}}">{{$l->ParaDescription}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                        @endfor
        
                                                                            
                                                                        </tbody>
                                                                    </table>
                                                                </div>
        
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 form_Submit_cancel_btn" > 
                                                            <button type="submit"   class=" m-w-105 btn btn-sm btn-success">Save</button>
                                                                <a href="{{route('schedule.index')}}" type="submit" class=" m-w-105 btn btn-sm btn-danger">Cancel</a>
                                                            </div>
                                                        </div>

                                                    </form>
                                             </div>
                                         </div>
                                     </div>
                                 
                                 </div>
                             </div>
 <script>
 
 $(".subject").select2({
     placeholder: "Select a Subject",
     allowClear: true
 });
 

 
 $(".CourseList").on("change",function(){
 

 var value = $(this).val();
     var row='';
     var  row1='';
     $.post("{{route('getCourseWiseBatch')}}",{"value":value,_token:"{{csrf_token()}}"},function(success){
         if(isNaN(success.CourseList))
         {
             row='<option selected disabled>-- Select Batch --</option>';
             $.each(success.CourseList,function(i,v){
                 row+='<option value='+v.ParaDescription+'>'+v.ParaDescription+'</option>';
             });
         }
         else
         {
             row+='<option selected disabled>--No Batch Found --</option>';
         }
 
         if(isNaN(success.subject))
         {
             row1='<option selected disabled>-- Select Subject --</option>';
             $.each(success.subject,function(i,v){
                 row1+='<option value='+v.ParaDescription+'>'+v.ParaDescription+'</option>';
             });
         }
         else
         {
             row1+='<option selected disabled>--No Subject Found --</option>';
         }
 
        
        
         $("#BatchList").html(row);
         $(".subject").html(row1);
     });
 });
$(document).on('change', '.subject', function() {
 
   
     var CourseCode =  $(".CourseList").val();
     var value = $(this).val();
     var data= $(this).data("id");
     
     var row2='';
     $.post("{{route('getSubjectWiseFacultyinShedule')}}",{"value":value,"CourseCode":CourseCode,_token:"{{csrf_token()}}"},function(success){
        if(isNaN(success.facultysubject))
         {
             var row2='<option selected disabled>-- Select Faculty --</option>';
             $.each(success.facultysubject,function(i,v){
                 row2+='<option value='+v.FacultyCode+'>'+v.firstName+'</option>';
             });
         }
         else
         {
             row2+='<option selected disabled>--No Faculty Found --</option>';
             $("faculty").html(row2);
         }
         
         $("#faculty"+data).html(row2);
    });

   
   
 });
 $('#schedule').validate({
     rules: {
         LectureCode: {
             required: true
         },
         CourceCode: {
             required: true
         },
         BatchCode: {
             required: true
         },
         DateOfWeek: {
             required: true
         },
         session: {
             required: true
         },
         TimingFrom: {
             required: true
         },
         TimingUpto: {
             required: true
         },
         EffUpto: {
             required: true
         },
         SubjectCode: {
             required: true
         },
         FacultyCode: {
             required: true
         },
         Venue: {
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
         LectureCode: {
             required: "Please enter LectureCode "
         },
         CourceCode: {
             required: "Please enter CourceCode "
         },
         BatchCode: {
             required: "Please enter BatchCode "
         },
         DateOfWeek: {
             required: "Please enter DateOfWeek "
         },
         session: {
             required: "Please enter EffUpto "
         },
         TimingFrom: {
             required: "Please enter TimingFrom "
         },
         TimingUpto: {
             required: "Please enter TimingFrom "
         },
         EffUpto: {
             required: "Please enter EffUpto "
         },
         SubjectCode: {
             required: "Please enter SubjectCode "
         },
         FacultyCode: {
             required: "Please enter FacultyCode "
         },
         Venue: {
             required: "Please enter Venue "
         },
         EffFromFrom: {
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