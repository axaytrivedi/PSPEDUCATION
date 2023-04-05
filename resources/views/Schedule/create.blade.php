                            
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
                                     <h6 class="mb-0 fw-bold ">   @if(!empty($SchedulerHeader->id))Edit @else New  @endif Schedule</h6> 
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
                                                    <form method="post" id="Schedule" action="{{(isset($SchedulerHeader->id))? route('schedule.update',$SchedulerHeader->id) :route('schedule.store')}}" enctype='multipart/form-data'>

                                                      @if(!empty($SchedulerHeader->id)) @method('PATCH') @endif @csrf
                                                        <div class="row">
                                            
                                                            <div class="col-md-3">
                                                            
                                                                <label for="CourseList" class="form-label">Select Course </label>
                                                                <select class="form-select  CourseList" name="CourseList"  id="CourseList"aria-label="Default select example">
                                                                                    <option selected="">--Course List--</option>
                                                                                    @foreach($CourseList as $subject)
                                                                                    <option value="{{$subject->ParaDescription}}"
                                                                                        @if(isset($SchedulerHeader->CourceCode) && $SchedulerHeader->CourceCode == $subject->ParaDescription)  selected @endif>{{$subject->ParaDescription}}</option>
                                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3">
                                                            
                                                                <label for="CourseList" class="form-label">Select Batch </label>
                                                                <select class="form-select BatchList" name="BatchList" id="BatchList"aria-label="Default select example">
                                                                        <option disabled selected="">--Batch List--</option>
                                                                         @if(!empty($BatchList) && isset($SchedulerHeader->BatchCode))
                                                                            @foreach($BatchList as $batchlist)
                                                                            <option value="{{$subject->ParaDescription}}"
                                                                                        @if(isset($SchedulerHeader->BatchCode) && $SchedulerHeader->BatchCode == $batchlist->ParaDescription)  selected @endif>{{$batchlist->ParaDescription}}</option>
                                                                            @endforeach
                                                                        @endif
                                                                </select>
                                                            </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                @if(!empty($edit_schedule) && isset($SchedulerHeader->id))
                                                                        <!-- Edit Mode On -->

                                                                        <div class="col-md-12">
                                                                            <table class="table table-hover align-middle mb-0" style="width: 100%;">
                                                                                <thead>
                                                                                    <input type="hidden" name="SchedulerHeaderId" value="{{$SchedulerHeader->id}}">
                                                                                    <tr style="border-top:3px solid black;text-align: center;background: #dff0f5;" >
                                                                                        <th>DATE</th>
                                                                                        @foreach($collection['datearray'] as $date)
                                                                                            <th>{{$date}}
                                                                                                <input type="hidden" name="HeaderDate[]" value="{{$date}}">
                                                                                            </th>
                                                                                            
                                                                                        @endforeach
                                                                                        
                                                                                    </tr>
                                                                                    <tr style="border-bottom:3px solid black;text-align: center;background: #dff0f5;">
                                                                                        <th>DAY</th>
                                                                                        @foreach($collection['dayarray'] as $DAY)
                                                                                            <th>{{$DAY}}
                                                                                            <input type="hidden" name="HeaderDay[]" value="{{$DAY}}">

                                                                                            </th>

                                                                                        @endforeach
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>    
                                                                                    <!-- Main Loop -->
                                                                                @for($i=1;$i<=6; $i++)
                                                                                    <tr>
                                                                                         <td><strong>TIME</strong></td>
                                                                                  
                                                                                        <?php $row=1; ?>
                                                                                                @for($j=0;$j<=6; $j++)
                                                                                                    <td class="time" >
                                                                                                        <div class="d-flex">
                                                                                                            <div class="col-md-6 " style="width:100px">
            
                                                                                                                    @for($Mn=0;$Mn<=41; $Mn++)
                                                                                                                        @if(!empty($collection['tableData'][$Mn]['id']) &&  $collection['tableData'][$Mn]['location'] == $i."_".$row)
                                                                                                                            <input type="hidden" value ="{{$collection['tableData'][$Mn]['id']}}" name="id[{{$i}}][{{$row}}]">
                                                                                                                        @endif
                                                                                                                    @endfor
                                                                                                                
                                                                                                                <input type="time" 
                                                                                                                @for($Mn=0;$Mn<=41; $Mn++)

                                                                                                                    @if(!empty($collection['tableData'][$Mn]['TimingFrom']) &&  $collection['tableData'][$Mn]['location'] == $i."_".$row)
                                                                                                                        value ="{{$collection['tableData'][$Mn]['TimingFrom']}}"
                                                                                                                    @endif
                                                                                                                @endfor
                                                                                                            
                                                                                                                    name="dayStart[{{$i}}][{{$row}}]" class="form-control w-100">
                                                                                                                        <input type="hidden" name="storeLocation[{{$i}}]" value="{{$i}}_{{$row}}" class="form-control w-100">

                                                                                                            </div>
                                                                                                            <div class="col-md-6 ms-2">   
                                                                                                                <input type="time" 
                                                                                                                    
                                                                                                                @for($Mn=0;$Mn<=41; $Mn++)

                                                                                                                    @if(!empty($collection['tableData'][$Mn]['TimingUpto']) &&  $collection['tableData'][$Mn]['location'] == $i."_".$row)
                                                                                                                        value ="{{$collection['tableData'][$Mn]['TimingUpto']}}"
                                                                                                                    @endif
                                                                                                                @endfor
                                                                                                                name="dayend[{{$i}}][{{$row}}]"class="form-control w-100">
                                                                                                            </div> 
                                                                                                            
                                                                                                        </div> 
                                                                                                        
        
                                                                                                    </td>





                                                                                                    <?php $row++; ?>
                                                                                                @endfor
                                                                                                
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td><strong>SUB</strong></td>
                                                                                            <?php $row1=1; $subjectarray=[]; ?>
                                                                                            @for($j=0;$j<=6; $j++)

                                                                                            <td>
                                                                                                <input type="hidden" name="storeLocation[{{$i}}][{{$row1}}]" value="{{$i}}_{{$row1}}" class="form-control w-100">
                                                                                                @for($Mn=0;$Mn<=41; $Mn++)
                                                                                                                        @if(!empty($collection['tableData'][$Mn]['id']) &&  $collection['tableData'][$Mn]['location'] == $i."_".$row1)
                                                                                                                            <input type="hidden" value ="{{$collection['tableData'][$Mn]['id']}}" name="id[{{$i}}][{{$row1}}]">
                                                                                                                        @endif
                                                                                                @endfor

                                                                                                    <select class="form-select subject" name="subject[{{$i}}][{{$row1}}]" data-id="{{$i}}_{{$row1}}"  aria-label="Default select example">
                                                                                                    <option disabled selected="">--Subject--</option>
                                                                                                    
                                                                                                        @foreach($SubjectsList as $subject)

                                                                                                            @for($Mn=0;$Mn<=41; $Mn++)
                                                                                                                
                                                                                                                @if(!in_array($collection['tableData'][$Mn]['SubjectCode'],$subjectarray) && !empty($collection['tableData'][$Mn]['SubjectCode']) &&  $collection['tableData'][$Mn]['location'] == $i."_".$row1)
                                                                                                                    <option  selected value="{{$collection['tableData'][$Mn]['SubjectCode']}}">{{$collection['tableData'][$Mn]['SubjectCode']}}</option>
                                                                                                                    <?php  $subjectarray[]=$collection['tableData'][$Mn]['SubjectCode']; ?>

                                                                                                                @endif
                                                                                                                
                                                                                                            @endfor
                                                                                                            @if(!in_array($subject->ParaDescription,$subjectarray))

                                                                                                            <option   value="{{$subject->ParaDescription}}">{{$subject->ParaDescription}}</option>
                                                                                                             
                                                                                                            @endif
                                                                                                        
                                                                                                        @endforeach
                                                                                
                                                                                             
                                                                                        
                                                                                                 
                                                                                                    
                                                                                                    </select>
                                                                                            </td>
                                                                                            <?php $row1++; ?>
                                                                                            @endfor
                                                                                       
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <td><strong>FACULTY</strong></td>
                                                                                        <?php $row2=1; ?>
                                                                                        @for($j=0;$j<=6; $j++)
                                                                                        <td>
                                                                                        @for($Mn=0;$Mn<=41; $Mn++)
                                                                                                                        @if(!empty($collection['tableData'][$Mn]['id']) &&  $collection['tableData'][$Mn]['location'] == $i."_".$row2)
                                                                                                                            <input type="hidden" value ="{{$collection['tableData'][$Mn]['id']}}" name="id[{{$i}}][{{$row2}}]">
                                                                                                                        @endif
                                                                                                @endfor
                                                                                            <input type="hidden" name="storeLocation[{{$i}}][{{$row2}}]" value="{{$i}}_{{$row2}}" class="form-control w-100">
                                                                                            <select class="form-select faculty" name="faculty[{{$i}}][{{$row2}}]"  id="faculty{{$i}}_{{$row2}}" aria-label="Default select example">
                                                                                     
                                                                                                @for($Mn=0;$Mn<=41; $Mn++)

                                                                                                    @if(!empty($collection['tableData'][$Mn]['FacultyCode']) &&  $collection['tableData'][$Mn]['location'] == $i."_".$row2)
                                                                                                    <option  selected value="{{$collection['tableData'][$Mn]['FacultyCode']}}"> {{FacultyName($collection['tableData'][$Mn]['FacultyCode'])}}</option>


                                                                                                    @endif
                                                                                                @endfor
                                                                                            </select>
                                                                                        </td>
                                                                                        <?php $row2++; ?>
                                                                                            @endfor
                                                                                    </tr>
                                                                                    <tr style="border-bottom:3px solid black">
                                                                                        <td><strong>LOCATION</strong></td>
                                                                                        <?php $row3=1; $location=[]; ?>
                                                                                        @for($j=0;$j<=6; $j++)
                                                                                            <td>
                                                                                                @for($Mn=0;$Mn<=41; $Mn++)
                                                                                                                        @if(!empty($collection['tableData'][$Mn]['id']) &&  $collection['tableData'][$Mn]['location'] == $i."_".$row3)
                                                                                                                            <input type="hidden" value ="{{$collection['tableData'][$Mn]['id']}}" name="id[{{$i}}][{{$row3}}]">
                                                                                                                        @endif
                                                                                                @endfor
                                                                                           
                                                                                           
                                                                                                <input type="hidden" name="storeLocation[{{$i}}][{{$row3}}]" value="{{$i}}_{{$row3}}" class="form-control w-100">

                                                                                                <select class="form-select"  name="location[{{$i}}][{{$row3}}]" aria-label="Default select example">
                                                                                                    <option disabled selected>--Select-Location--</option>
                                                                                                  
                             
                                                                                                    @foreach($Location as $L)   
                                                                                                                                                            
                                                                                                        @for($Mn=0;$Mn<=41; $Mn++)

                                                                                                            @if(!in_array($collection['tableData'][$Mn]['Venue'],$location) &&!empty($collection['tableData'][$Mn]['Venue']) &&  $collection['tableData'][$Mn]['location'] == $i."_".$row3)
                                                                                                            <option  selected value="{{$collection['tableData'][$Mn]['Venue']}}">{{$collection['tableData'][$Mn]['Venue']}}</option>
                                                                                                            <?php $location[]=$collection['tableData'][$Mn]['Venue'];?>

                                                                                                            @endif
                                                                                                        @endfor
                                                                                                         @if(!in_array($L->ParaDescription,$location))

                                                                                                            <option   value="{{$L->ParaDescription}}">{{$L->ParaDescription}}</option>
                                                                                                             
                                                                                                            @endif
                                                                                                    @endforeach
                                                                                                  
                                                                                                </select>
                                                                                            </td>
                                                                                        <?php $row3++; ?>
                                                                                            @endfor
                                                                                    </tr>
                                                                                    
                                                                            @endfor
                                                                               
                                                                  

                                                                                    <!-- I Loop -->
                                                                             
                                                                                   
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                @else
                                                                    <div class="col-md-12">
                                                                        <table class="table table-hover align-middle mb-0" style="width: 100%;">
                                                                            <thead>
                                                                                <tr style="border-top:3px solid black;text-align: center;background: #dff0f5;" >
                                                                                    <th>DATE</th>
                                                                                    <?php
                                                                                        // for current date 
                                                                                        $date1 = date('d-M');
                                                                                         $day1 = date('D');

                                                                        
                                                                              
                                                                                        if($day1 =="Sun")
                                                                                        {
                                                                                            $day1 = date('D', strtotime($day1. ' + 1 days'));
                                                                                            $date1 = date('d-M', strtotime($date1. ' +1 days'));
                                                                                        }
                                                                                        elseif($day1 =="Tue")
                                                                                        {
                                                                                            $day1 = date('D', strtotime($day1. ' + 6 days'));
                                                                                            $date1 = date('d-M', strtotime($date1. ' +6 days'));
                                                                                          
                                                                                        }
                                                                                        elseif($day1 =="Thu")
                                                                                        {
                                                                                            $date1 = date('d-M',strtotime($day1. ' +5 days'));
                                                                                            $day1 = date('D',strtotime($day1. ' +5 days'));  
                                                                                        }
                                                                                        elseif($day1 =="Fri")
                                                                                        {
                                                                                            $date1 = date('d-M',strtotime($day1. ' +3 days'));
                                                                                            $day1 = date('D',strtotime($day1. ' +3 days')); 
                                                                                        }
                                                                                        elseif($day1 =="Sat")
                                                                                        {
                                                                                            $date1 = date('d-M',strtotime($day1. ' +2 days'));
                                                                                            $day1 = date('D',strtotime($day1. ' +2 days')); 
                                                                                        }
                                                                                        else
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
            
                                                                                @for($i=1;$i<=6; $i++)
                                                                                    <tr>
                                                                                        <td><strong>TIME</strong></td>
                                                                                        <?php $row=1; ?>
                                                                                        @for($j=0;$j<=6; $j++)
                                                                                        <td class="time" >
                                                                                            <div class="d-flex">
                                                                                                <div class="col-md-6 " style="width:100px">
                                                                                               
                                                                                                    <input type="time" 
                                                                                                    @if(!empty($collection['tableData'][$j]['TimingFrom']) &&  $collection['tableData'][$j]['location'] == $i."_".$row)
                                                                                                    value="{{$collection['tableData'][$j]['TimingFrom']}}"
                                                                                                    @endif
                                                                                                    name="dayStart[{{$i}}][{{$row}}]" class="form-control w-100">
                                                                                                    <input type="hidden" name="storeLocation[{{$i}}][{{$row}}]" value="{{$i}}_{{$row}}" class="form-control w-100">
                                                                                                </div>
                                                                                                <div class="col-md-6 ms-2">   
                                                                                                    <input type="time" 
                                                                                                    @if(!empty($collection['tableData'][$j]['TimingUpto']) &&  $collection['tableData'][$j]['location'] == $i."_".$row)
                                                                                                    value="{{$collection['tableData'][$j]['TimingUpto']}}"
                                                                                                    @endif
                                                                                                    name="dayend[{{$i}}][{{$row}}]"class="form-control w-100">
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                        <?php $row++; ?>
                                                                                        @endfor
                                                                                        </tr>


                                                                                        <tr>
                                                                                            <?php $row1=1; ?>
                                                                                            <td><strong>SUB</strong></td>
                                                                                            @for($j=0;$j<=6; $j++)
                                                                                            
                                                                                                <td>
                                                                                                    <input type="hidden" name="storeLocation[{{$i}}][{{$row1}}]" value="{{$i}}_{{$row1}}" class="form-control w-100">
                                                                                                    <select class="form-select subject" name="subject[{{$i}}][{{$row1}}]" data-id="{{$i}}_{{$row1}}"  aria-label="Default select example">
                                                                                                        <option disabled selected="">--Subject--</option>
                                                                                                    </select>
                                                                                                </td>
                                                                                                <?php $row1++; ?>
                                                                                            @endfor
                                                                                        </tr>


                                                                                        <tr>
                                                                                        <?php $row2=1; ?>
                                                                                            <td><strong>FACULTY</strong></td>
                                                                                            @for($j=0;$j<=6; $j++)
                                                                                                <td>

                                                                                                        <select class="form-select faculty" name="faculty[{{$i}}][{{$row2}}]"  id="faculty{{$i}}_{{$row2}}" aria-label="Default select example">
                                                                                                            <option disabled selected>-- Select-Faculty --</option>
                                                                                                    </select>
                                                                                                </td>
                                                                                            <?php $row2++; ?>
                                                                                            @endfor
                                                                                        </tr>

                                                                                        <tr style="border-bottom:3px solid black">
                                                                                            <td><strong>LOCATION</strong></td>
                                                                                            <?php $row3=1; ?>
                                                                                            @for($j=0;$j<=6; $j++)
                                                                                                <td>
                                                                                                    <input type="hidden" name="storeLocation[{{$i}}][{{$row3}}]" value="{{$i}}_{{$row3}}" class="form-control w-100">

                                                                                                    <select class="form-select"  name="location[{{$i}}][{{$row3}}]" aria-label="Default select example">
                                                                                                        <option disabled selected>--Select-Location--</option>
                                                                                                        @foreach($Location as $l)
                                                                                                        <option value="{{$l->ParaDescription}}">{{$l->ParaDescription}}</option>
                                                                                                        @endforeach
                                                                                                    </select>
                                                                                                </td>
                                                                                            <?php $row2++; ?>
                                                                                            @endfor

                                                                                        </tr>
</td>
                                                                                
                                                                                @endfor
            
                                                                                
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                @endif
        
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
     row='<option selected disabled>-- Select Batch --</option>';
     $("#BatchList").html(row);
        
     $.post("{{route('getCourseWiseBatch')}}",{"value":value,_token:"{{csrf_token()}}"},function(success){
         if(isNaN(success.CourseList))
         {
            
           
             $.each(success.CourseList,function(i,v){
                 row+='<option value="'+v.ParaDescription+'">'+v.ParaDescription+'</option>';
             });
         }
         else
         {
             row+='<option selected disabled>--No Batch Found --</option>';
         }
 
         if(isNaN(success.subject))
         {  
           
             row23='<option selected disabled>-- Select Subject --</option>';
             $.each(success.subject,function(i,v){
          
                row23+='<option value="'+v.ParaDescription+'">'+v.ParaDescription+'</option>';
             });
         }
         else
         {
            row23+='<option selected disabled>--No Subject Found --</option>';
         }
 
        
        
         $("#BatchList").html(row);
         $(".subject").html(row23);
     });
 });
$(document).on('change', '.subject', function() {
 
   
     var CourseCode =  $(".CourseList").val();
     var value = $(this).val();
     var data= $(this).data("id");
     alert(data);
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