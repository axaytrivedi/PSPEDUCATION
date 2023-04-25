@extends('layouts.app')
@section('content')
<div class="card mb-3">
    <div class="card-header py-3  bg-transparent border-bottom-0">
        <div>
            <h6 class="mb-0 fw-bold ">Faculty Monthly Report Of Hours</h6> 
            <hr>
            <form id="submit_Form">
                @csrf  
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><strong>From Date :</strong><span class="text-danger pl-1">*</span></label>
                            <input type="text" class="form-control" placeholder="MM/DD/YYYY" name="from_date" id="from_date" value="{{Date('d-m-Y')}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><strong>To Date :</strong><span class="text-danger pl-1">*</span></label>
                            <?php
                                $date = new DateTime();

                               
                                $date->modify("last day of this month");

                                
               
                            ?>
                            <input type="text" class="form-control" placeholder="MM/DD/YYYY" name="to_date" id="to_date" value="{{$date->format('d-m-Y')}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><strong>Select Faculty :</strong><span class="text-danger pl-1">*</span></label>

                            <select name="faculty" class="form-control" id="faculty">
                                <option selected disabled>-- Select Faculty --</option>
                                @if(!empty($Faculty))
                                    @foreach($Faculty as $faculty)
                                        <option value="{{$faculty->FacultyCode}}">{{$faculty->FacultyCode}} /{{$faculty->firstName }} {{$faculty->lastName}}</option>
                                    @endforeach
                                @endif
                            </select>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <button style="margin-top: 21px;" type="submit" class="btn btn-success" name="search" id="search">Search</button>
                        
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-2 ms-auto" id="accessButtons" style="display: none;">
                        <button style="margin-top: 21px;" id="Excel" type="button" class="btn btn-success text-white" title="excel"><i class="icofont-file-excel fs-5"></i></button>
                        <button style="margin-top: 21px;" id="PDF" type="button" class="btn btn-danger text-white" title="pdf"><i class="icofont-file-pdf fs-5"></i></button>
                        <button style="margin-top: 21px;" id="Print" type="button" class="btn btn-warning" title="print"><i class="icofont-print fs-5"></i></button>
                    </div>
                </div>
                    
            </form>
        </div>
    </div>
    <div class="card-body" id="report">
        <div class="table-responsive" id="printThis">
            <div class="date_txt" id="reportDate" style="display: none;">
                <p>
                    <b>From Date : </b>
                    <span id="start_date"></span>
                </p>
                <p>
                    <b>To Date : </b>
                    <span id="end_date"></span>
                </p>
            </div>
            <table class="table table-hover" id="StudentListReport">
                <thead>
                <tr>    
                    <th>SrNo.</th>
                    <th>Faculty Id</th>
                    <th>Name</th>
                    
                    <th>Date</th>
                    <th>Location</th>
                    <th>In Time</th>
                    <th>Out Time</th>
                
                    <!-- <th>Coures</th>
                    <th>Batch</th>
                    <th>Subject</th> -->
                    <th>Working Hours</th>
                </tr>
                </thead>
                <tbody id="tbldata">
        

                </tbody>
                
                <tbody class="report_message" id="report_message"> 
                    <tr>
                        <td colspan="6" style="text-align: center;">No record found</td>
                    </tr>
                </tbody>
                <tfoot class="TotalHours">
                    
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- <script src="{{ URL::asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ URL::asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ URL::asset('plugins/jquery-validation/additional-methods.min.js') }}"></script> -->

<script type="text/javascript">
    $(document).ready(function() {


        $( "#to_date" ).datepicker({
            dateFormat: 'dd-m-yy'
        });
        $( "#from_date" ).datepicker({
            dateFormat: 'dd-m-yy'
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#submit_Form').validate({
            rules: {
                from_date: {
                    required: true
                },
                to_date: {
                    required: true
                },
                faculty:
                {
                    required: true
                }
            },
            messages: {
                from_date: {
                    required: "Please enter from date"
                },
                to_date: {
                    required: "Please enter to date"
                },
                faculty: {
                    required: "Please Select Faculty"
                }
            
            },
            submitHandler: function (form) { 
                $("#tbldata").html('');
                var fromDate = $('#from_date').val();
                var toDate = $('#to_date').val();
                var faculty = $('#faculty').val();
         
                var newFromdate = fromDate.split("-").reverse().join("-");
                var newTodate = toDate.split("-").reverse().join("-");
                
                $.ajax({   
                    type: "POST",
                    url : '{{route('GetMonthlyFacultyWiseReport')}}',
                    data: {
                        fromDate: fromDate,
                        toDate: toDate,
                        faculty:faculty,
                        _token:"{{csrf_token()}}",
                    },
                    //cache: false,
                    success: function(data) {
                            // console.log(data);
                            $('#report').show();
                            $('#start_date').html(newFromdate);
                            $('#end_date').html(newTodate);
                            $('#reportDate').show();
                            $('#accessButtons').show();
                            var tbldata = '';

                            var count = 1;
                            var noHoursLectures=0 ;
                            var totalTime=data['totalTime'];
                            for(var k=0; k < data["GetData"].length; k++)
                            {
                                var  noHoursLectures=0;
                                
                                if( data["GetData"][k].noHoursLectures != null)
                                {  
                                    noHoursLectures = data["GetData"][k].noHoursLectures;
                                }
                                else
                                {
                                      noHoursLectures=0;
                                }
                                var CourceCode="";
                                if( data["GetData"][k].CourceCode != null)
                                {  
                                    CourceCode = data["GetData"][k].CourceCode;
                                }
                                else
                                {
                                    CourceCode="--";
                                }

                                var BatchCode="";
                                if( data["GetData"][k].BatchCode != null)
                                {  
                                    BatchCode = data["GetData"][k].BatchCode;
                                }
                                else
                                {
                                    BatchCode="--";
                                }
                                var SubjectCode="";
                                if( data["GetData"][k].SubjectCode != null)
                                {  
                                    SubjectCode = data["GetData"][k].SubjectCode;
                                }
                                else
                                {
                                    SubjectCode="--";
                                }
                             

                                
                                tbldata += '<tr><td>'+count+'</td>'+
                                        '<td>'+data["GetData"][k].FacultyCode+'</td><td>'+data["GetData"][k].FirstName.toUpperCase()+' '+data["GetData"][k].LastName.toUpperCase()+'</td>'+
                                        '<td>'+data["GetData"][k].CalanderDate+'</td>'+
                                        '<td>'+data["GetData"][k].AttendanceStatus+'</td>'+
                                        '<td>'+data["GetData"][k].InTime+'</td>'+
                                        '<td>'+data["GetData"][k].OutTime+'</td>'+
                                        // '<td>'+CourceCode+'</td>'+
                                        // '<td>'+BatchCode+'</td>'+
                                        // '<td>'+SubjectCode+'</td>'+
                                        '<td>'+data["GetData"][k].attInHrs+'</td>'+
                                        '</tr>';
                                count++;      
                                var noHoursLectures =   0;

                            }
                            
                            $("#tbldata").html(tbldata);
                            if(data["GetData"].length > 0)
                            {
                                $('.report_message').hide();
                            }
                            else
                            {
                                $('.report_message').show();
                               
                            }
                            
                            $(".TotalHours").html("<tr><th  colspan='8' style='text-align: right;'>Total Working Hours </th><th> <b>"+totalTime+"</b></b></th></tr>");
                        }
                    }); 
                },
                errorElement: 'span',
                errorPlacement: function(label, element) {
                    if( element.attr( "name" ) == "exchange_rate"  ) {
                        element.parent().append( label ); 
                    }
                    else if(element.attr("name") == "quotation_date" ) 
                    {
                        element.closest('.form-group').append(label);
                    } 
                    else {
                        label.insertAfter( element ); 
                    
                    }
                    label.addClass('invalid-feedback');
                    
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

<!-- ExportToCSV -->
<script>
    function htmlToCSV(html, filename,get_array) {
        var data = [];
        var rows = document.querySelectorAll("table tr");

        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll("td, th");

            for (var j = 0; j < cols.length; j++) {

                    row.push(cols[j].innerText);
            }

            data.push(row.join(","));
        }

        downloadCSVFile(data.join("\n"), filename);

        var atags ='';

        var html = document.querySelector('table').innerHTML;
    }

    function downloadCSVFile(csv, filename) {
        var csv_file, download_link;
        csv_file = new Blob([csv], {type: "text/csv"});
        download_link = document.createElement("a");
        download_link.download = filename;
        download_link.href = window.URL.createObjectURL(csv_file);
        download_link.style.display = "none";
        document.body.appendChild(download_link);
        download_link.click();
    }
</script>

<script src="{{ URL::asset('assets/js/jquery.table2excel.min.js') }}"></script>
<script>
    document.getElementById("Excel").addEventListener("click", function () {

        var atags ='';
        var atagArray=[];

        var htmls = $('#StudentListReport tr').each(function(index, tr) {
            $(tr).find('td').each (function (index, td) {
            $(td).find('a').each(function(i,atag){
                // console.log( $(atag).html());
                    atagArray.push($(tr).html());
                    var result = ($(atag).html()).replace('&nbsp;','');
                    $(td).html(result);

                });
            });
        });

        var html = document.querySelector('table').innerHTML;

        // console.log(atagArray);

        var response =  htmlToCSV(html, "Faculty_Working_hours.csv",atagArray);

        $("#search").click();
    });

</script>

<!-- ExportToPDF -->
<script src="{{ URL::asset('assets/js/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/html2canvas.min.js') }}"></script>
<script type="text/javascript">
    $('#PDF').click(function () {
        html2canvas($('#StudentListReport')["GetData"], {
            onrendered: function (canvas) {
                var data = canvas.toDataURL();
                var docDefinition = {
                    content: [{
                        image: data,
                        width: 500
                    }]
                };
                pdfMake.createPdf(docDefinition).download("Faculty_Working_hours.pdf");
            }
        });
    });
</script>

<!-- PrintTableData -->
<script src="{{ URL::asset('assets/js/print.min.js') }}"></script>
<script>
    $('#Print').on('click', function() {
        $.print("#printThis");
    });
</script>
@endsection 