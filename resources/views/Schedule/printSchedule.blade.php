@extends('layouts.app')
@section('content')       
 <style>
         /* .table>:not(caption)>*>* {
             padding: 3px 5px !important;
         }  */
     
         tbody, td, tfoot, th, thead, tr{ border-color:#333 !important;}
     
     @page {

        size: landscape;margin:0; padding: 0;
        }
        @media print { 
            *{box-sizing:border-box; margin:0;padding:0;}
            html,body{
            padding:10px; page-break-after: always;
            font-size:13px;
            }
            .table tr td,.table tr th{ padding:2px;}
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
                <div class="card-body " style="overflow: scroll;">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered printThis " >
                                    <thead>
                                        <tr>
                                            <th colspan="8" style="text-align:center"> 
                                           
                                       
                                                  <h5><b>Course :  {{ $SchedulerHeader->CourceCode}}</b></h5> 
                                                  <br>
                                                  <h5><b>Batch :  {{ $SchedulerHeader->BatchCode}}</b></h5>
                                               
                                            </th>
                                          
                                        </tr>
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
                                    @for($i=1;$i<=6; $i++)
                                        <tr>
                                            <td><strong>TIME</strong></td>
                                            <?php $row=1; ?>
                                            @for($j=0;$j<=6; $j++)
                                            <td style="text-align:center" class="time" >
                                                <div class="d-flex" style="text-align:center">
                                                    <div class=" "   >
                                                        @for($Mn=0;$Mn<=41; $Mn++)
                                                        @if(!empty($collection['tableData'][$Mn]['TimingFrom']) &&  $collection['tableData'][$Mn]['location'] == $i."_".$row)
                                                        <b>{{$collection['tableData'][$Mn]['TimingFrom']}}</b>
                                                        @endif
                                                        @endfor
                                                    </div>

                                                    @for($Mn=0;$Mn<=41; $Mn++)
                                                    @if(!empty($collection['tableData'][$Mn]['TimingUpto']) &&  $collection['tableData'][$Mn]['location'] == $i."_".$row)
                                                    <p><b>&nbsp; To &nbsp;</b></p>
                                                    @endif
                                                    @endfor
                                                    <div >
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
                                            <td >
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
<script src="{{ URL::asset('assets/js/print.min.js') }}"></script>
<script>
$(".printmeClick").click(function(){

   
        $.print(".printThis");
   
});

</script>
 @endsection