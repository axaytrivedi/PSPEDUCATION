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
        <h6 class="mb-0 fw-bold "> </h6>
        <h6 class="mb-0 fw-bold "><Button type="button" class="printmeClick btn btn-primary py-2 px-5 btn-set-task w-sm-100">Print </Button> </h6> 
    </div>
    <div class="card-body">
        <div class="row g-3 mb-3">
            <div class="col-md-12">
                <div class="card">
                <div class="card-body printThis" style="overflow: scroll;">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="CourseList" class="form-label"><h5><b>Course</b> :  {{ $SchedulerHeader->CourceCode}}</h5> </label>
                                                                
                            </div>
                            <div class="col-md-3">
                                <label for="CourseList" class="form-label"><h5><b>Batch </b> :  {{ $SchedulerHeader->BatchCode}}</h5></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-hover align-middle mb-0" style="width: 100%;">
                                    <thead>
                                        <tr style="border-top:3px solid black;text-align: center;background: #dff0f5;" >
                                            <th>DATE</th>
                                            @foreach($collection['datearray'] as $date)
                                                <th>{{$date}}</th>
                                            @endforeach
                                        </tr>
                                        <tr style="border-top:3px solid black;text-align: center;background: #dff0f5;" >
                                            <th>Day</th>
                                            @foreach($collection['dayarray'] as $DAY)
                                                <th>{{$DAY}}
                                                   
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
                                                                                                    <td style="text-align:center" class="time" >
                                                                                                        <div class="d-flex">
                                                                                                            <div class="col-md-6 " style="width:100px">
            
                                                                                                                    
                                                                                                                
                                                                                                             
                                                                                                                @for($Mn=0;$Mn<=41; $Mn++)

                                                                                                                    @if(!empty($collection['tableData'][$Mn]['TimingFrom']) &&  $collection['tableData'][$Mn]['location'] == $i."_".$row)
                                                                                                                       <b>{{$collection['tableData'][$Mn]['TimingFrom']}}</b>
                                                                                                                    @endif
                                                                                                                @endfor
                                                                                                                </div>
                                                                                                                @for($Mn=0;$Mn<=41; $Mn++)
                                                                                                                    @if(!empty($collection['tableData'][$Mn]['TimingUpto']) &&  $collection['tableData'][$Mn]['location'] == $i."_".$row)
                                                                                                                        <p><b>To</b></p>
                                                                                                                    @endif
                                                                                                                @endfor
                                                                                                                <div class="col-md-6 " style="width:100px">
                                                                                                                @for($Mn=0;$Mn<=41; $Mn++)

                                                                                                                    @if(!empty($collection['tableData'][$Mn]['TimingUpto']) &&  $collection['tableData'][$Mn]['location'] == $i."_".$row)
                                                                                                                        <b>{{$collection['tableData'][$Mn]['TimingUpto']}}</b> 
                                                                                                                    @endif
                                                                                                                @endfor
                                                                                                              
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

                                                                                            <td style="text-align:center">
                                                                                                            @for($Mn=0;$Mn<=41; $Mn++)
                                                                                                                
                                                                                                                @if(!in_array($collection['tableData'][$Mn]['SubjectCode'],$subjectarray) && !empty($collection['tableData'][$Mn]['SubjectCode']) &&  $collection['tableData'][$Mn]['location'] == $i."_".$row1)
                                                                                                                    <b>{{$collection['tableData'][$Mn]['SubjectCode']}}</b>
                                                 

                                                                                                                @endif
                                                                                                                
                                                                                                            @endfor
                                                                                                </td>
                                                                                            <?php $row1++; ?>
                                                                                            @endfor
                                                                                       
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <td><strong>FACULTY</strong></td>
                                                                                        <?php $row2=1; ?>
                                                                                        @for($j=0;$j<=6; $j++)
                                                                                            <td style="text-align:center">
                                                                                           
                                                                                                        @for($Mn=0;$Mn<=41; $Mn++)

                                                                                                            @if(!empty($collection['tableData'][$Mn]['FacultyCode']) &&  $collection['tableData'][$Mn]['location'] == $i."_".$row2)
                                                                                                            <b>{{FacultyName($collection['tableData'][$Mn]['FacultyCode'])}}</b>
                                                                                                            @endif
                                                                                                        @endfor
                                                                                             
                                                                                             
                                                                                            </td>        
                                                                                                <?php $row2++; ?>
                                                                                        @endfor
                                                                                    </tr>
                                                                                    <tr style="border-bottom:3px solid black">
                                                                                        <td><strong>LOCATION</strong></td>
                                                                                        <?php $row3=1;  ?>
                                                                                        @for($j=0;$j<=6; $j++)
                                                                                            <td style="text-align:center">
                                                                                                  @for($Mn=0;$Mn<=41; $Mn++)

                                                                                                            @if(!empty($collection['tableData'][$Mn]['Venue']) &&  $collection['tableData'][$Mn]['location'] == $i."_".$row3)
                                                                                                                <b>{{$collection['tableData'][$Mn]['Venue']}}</b>
                                           
                                                                                                            @endif
                                                                                                @endfor
                                                                           
                                                                                                  
                                                                                                </select>
                                                                                            </td>
                                                                                            <?php $row3++; ?>
                                                                                        @endfor
                                                                                    </tr>
                                                                                    
                                                                                @endfor                                                                     
                                                                               
                                                                                       
                                        </tbody>
                                <table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(".printmeClick").click(function(){
    alert("sfsdf");
});
// printmeClick
</script>
 @endsection