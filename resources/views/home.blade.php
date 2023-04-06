@extends('layouts.app')

@section('content')

  <style>
         .table>:not(caption)>*>* {
             padding: 3px 5px !important;
         } 
         .table{
            border: 1px solid;
            table-layout: fixed;
         }
         th,td{
            border-right:1px solid;
         }
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

            <div class="body d-flex py-3">
            <div class="card mb-3">
                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                    <h6 class="mb-0 fw-bold "> </h6>
                    <h6 class="mb-0 fw-bold "><Button type="button" class="printmeClick btn btn-primary py-2 px-5 btn-set-task w-sm-100">Print </Button> </h6> 
                </div>
            </div>
                <div class="container-xxl">

                    @if(Auth::user()->Role ==1)
                    <div class="row g-3 mb-3 row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-4">
                        <div class="col">
                            <div class="alert-success alert mb-0">
                                <div class="d-flex align-items-center">
                                    <div class="avatar rounded no-thumbnail bg-success text-light"><i class="fa fa-dollar fa-lg"></i></div>
                                    <div class="flex-fill ms-3 text-truncate">
                                        <div class="h6 mb-0">Total Faculty</div>
                                        <span class="small">{{ $totalFaculty}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="alert-danger alert mb-0">
                                <div class="d-flex align-items-center">
                                    <div class="avatar rounded no-thumbnail bg-danger text-light"><i class="fa fa-credit-card fa-lg"></i></div>
                                    <div class="flex-fill ms-3 text-truncate">
                                        <div class="h6 mb-0">Today Absence Faculty</div>
                                        <span class="small">{{$FacultyAbsenceAttendance}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="alert-warning alert mb-0">
                                <div class="d-flex align-items-center">
                                    <div class="avatar rounded no-thumbnail bg-warning text-light"><i class="fa fa-smile-o fa-lg"></i></div>
                                    <div class="flex-fill ms-3 text-truncate">
                                        <div class="h6 mb-0">Total Student</div>
                                        <span class="small">{{$CurrentStudent}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col">
                            <div class="alert-info alert mb-0">
                                <div class="d-flex align-items-center">
                                    <div class="avatar rounded no-thumbnail bg-info text-light"><i class="fa fa-shopping-bag" aria-hidden="true"></i></div>
                                    <div class="flex-fill ms-3 text-truncate">
                                        <div class="h6 mb-0">New StoreOpen</div>
                                        <span class="small">8,925</span>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div><!-- Row end  -->
                    @endif

                    <div class="row g-3">
                        <div class="col-lg-12 col-md-12">
                        @if(Auth::user()->Role ==2 )
                             <table class="table table-hover align-middle mb-0 printThis" >
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
                                        <div class="col-md-6">
                                        @for($Mn=0;$Mn<=sizeof($collection['tableData']); $Mn++)
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
                                        <div class="col-md-6 " >
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
                                    @for($Mn=0;$Mn<=sizeof($collection['tableData']); $Mn++)
                                    @if(!empty($collection['tableData'][$Mn]['SubjectCode']) &&  $collection['tableData'][$Mn]['location'] == $i."_".$row1)
                                    <b>{{$collection['tableData'][$Mn]['SubjectCode']}}</b>
                                    @endif
                                    @endfor
                                </td>
                                <?php $row1++; ?>
                                @endfor
                            </tr>
                            <tr>
                                <td><strong>COURSE / BATCH </strong></td>
                                <?php $row2=1; ?>
                                @for($j=0;$j<=6; $j++)
                                <td style="text-align:center">
                                    @for($Mn=0;$Mn<=sizeof($collection['tableData']); $Mn++)
                                    @if(!empty($collection['tableData'][$Mn]['CourceCode']) &&  $collection['tableData'][$Mn]['location'] == $i."_".$row2)
                                    <b>{{$collection['tableData'][$Mn]['CourceCode']}} / {{$collection['tableData'][$Mn]['BatchCode']}}</b>
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
                                    @for($Mn=0;$Mn<=sizeof($collection['tableData']); $Mn++)
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
                        @endif
                        </div>
                    </div><!-- Row end  -->
                </div>
            </div>

            <script src="{{ URL::asset('assets/js/print.min.js') }}"></script>
<script>
$(".printmeClick").click(function(){


        $.print(".printThis");
   
});
</script>
@endsection
