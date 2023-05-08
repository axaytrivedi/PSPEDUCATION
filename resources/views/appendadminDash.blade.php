<div class="table-responsive">
    @if(count($rooms)!=0)
        <table class="table table-hover align-middle mb-0" >
                            <thead>
                                    <hr>
                                    <tr ><h4 style="text-align:center;font-weight: bold;">{{ date("d-m-Y")}}</h4></tr>
                                    <hr>
                                <tr>
                                    <th></th>   
                                    @if(!empty($rooms))
                                        @foreach($rooms as $r)
                                        <th> {{$r->ParaDescription}}</th>
                                        @endforeach
                                    @endif
                                </tr>
                            </thead>
                                <tbody>


                                @for($i=1;$i<=7;$i++)
                                    <tr>
                                         
                                 
                                                <td>
                                                    <div>
                                                    <strong>Time</strong> 
                                                    <div>
                                                
                                                    <div><strong>Subject</strong></div>
                                                    <div><strong>Course - Batch</div>
                                                    <div><strong>Faculty Name</strong></div>
                                                </td>
                                               
                                            @if(!empty($rooms))
                                  
                                            <?php $row=1; ?>

                                                @foreach($rooms as $r)
                                                <?php  $inarray=[];?>
                                                    <td>

                                      
                                                    @foreach($newcollection as $key=>$data)
                                                        <?php $placelocation = explode("_",$data['Location']); ?>
                                                        @if($data['Room'] != $r->ParaDescription  && $i== $placelocation[0])
                                                        <div style>{{$data['StartTime']}} - {{$data['EndTime']}}</div>
                                                       
                                                        
                                                        <div>{{$data['SubjectCode']}}</div>
                                                        <div><B>{{$data['CourceCode']}} /  {{$data['BatchCode']}}</B></div>
                                                        <div>{{ucfirst(FacultyName($data['FacultyCode']))}}</div>
                                                        <?php $inarray[]=$data['Room'];?>
                                                        
                                                       @endif
                                                      
                                                       
                                                    @endforeach
                                                    </td>
                                              
                                                  
                                                @endforeach

                                                <?php $row++; ?>
                                    @endif
                              
                                        
                                     
                                      
                                       
                                         
                                  
                                @endfor
                                </tr>
                                </tbody>
        </table>
    @else
    <table class="table table-hover align-middle mb-0" >
        <tr><th><h4 style="text-align:center"> Room not Found for this Location</h4></th></tr>
    </table>
    @endif
</div>