@extends('layouts.app')
@section('content')
<div class="card mb-3">
    <div class="card-header py-3  bg-transparent border-bottom-0">
        <div>
            <h6 class="mb-0 fw-bold ">Student List Report</h6> 
            <hr>
            <form id="submit_Form">
                @csrf  
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><strong>Course Code :</strong></label>
                            <select id='courseCode' name="courseCode"class="form-control" style="width: 200px">
                                <option value="">--Select Course Code--</option>
                                @foreach ($courseCode as $code)
                                <option value="{{ $code->CourceCode }}">
                                    {{ $code->CourceCode }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><strong>Batch Code :</strong></label>
                            <select id='studentBatchCode'name="studentBatchCode" class="form-control" style="width: 200px">
                                <option value="">--Select Batch Code--</option>
                                @foreach ($batchName as $bCode)
                                <option value="{{ $bCode->BatchCode }}">
                                    {{ $bCode->BatchCode }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><strong>Status :</strong></label>
                            <select id='Status'name="Status" class="form-control" style="width: 200px">
                                <option value="">--Select Status--</option>
                                <option value="OnRoll">OnRoll</option>
                                <option value="Short-Left">Short-Left</option>
                                <option value="Completed">Completed</option>
                                <option value="Promoted">Promoted</option>
                                <option value="PassOut">Pass Out</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
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
            <table class="table table-hover" id="StudentListReport">
                <thead>
                <tr>
                    <th>Sr No</th>
                    <th>Cource Code</th>
                    <th>Batch Code</th>
                    <th>Student Code</th>
                    <th>Roll No</th>
                    <th>Student Name</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody id="tbldata">
        
        
                </tbody>
                <tbody class="report_message" id="report_message"> 
                    <tr>
                        <td colspan="6" style="text-align: center;">No record found</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- <script src="{{ URL::asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ URL::asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ URL::asset('plugins/jquery-validation/additional-methods.min.js') }}"></script> -->

<script type="text/javascript">
    $(document).ready(function() {
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#submit_Form').validate({
            rules: {
                // start: {
                //     required: true
                // },
                // end: {
                //     required: true
                // }
            },
            messages: {
                // start: {
                //     required: "Please enter from date"
                // },
                // end: {
                //     required: "Please enter to date"
                // }
            
            },
            submitHandler: function (form) { 
                $("#tbldata").html('');
                var courseCode = $('#courseCode').val();
                var batchCode = $('#studentBatchCode').val();
                var status = $('#Status').val();
                
                $.ajax({   
                    type: "POST",
                    url : '{{route('studentList.getStudentData')}}',
                    data: {
                        courseCode: courseCode,
                        batchCode: batchCode,
                        status: status,
                        _token:"{{csrf_token()}}",
                    },
                    //cache: false,
                    success: function(data) {
                            // console.log(data);
                            $('#report').show();
                            $('#accessButtons').show();
                            var tbldata = '';

                            var count = 1;
                            for(var k=0; k < data[0].length; k++)
                            {
                                tbldata += '<tr><td>'+count+'</td><td>'+data[0][k].CourceCode+'</td><td>'+data[0][k].BatchCode+'</td><td>'+data[0][k].StudentCode+'</td><td>'+data[0][k].RollNo+'</td><td>'+data[0][k].StudentName+'</td><td>'+data[0][k].Status+'</td></tr>';
                                count++;        
                            }

                            $("#tbldata").html(tbldata);
                            if(data[0].length > 0)
                            {
                                $('.report_message').hide();
                            }
                            else
                            {
                                $('.report_message').show();
                            }
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

<!-- <script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script> -->
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

        var response =  htmlToCSV(html, "Student_List.csv",atagArray);

        $("#search").click();
    });

</script>

<!-- ExportToPDF -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script> -->
<script src="{{ URL::asset('assets/js/pdfmake.min.js') }}"></script>
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script> -->
<script src="{{ URL::asset('assets/js/html2canvas.min.js') }}"></script>
<script type="text/javascript">
    $('#PDF').click(function () {
        html2canvas($('#StudentListReport')[0], {
            onrendered: function (canvas) {
                var data = canvas.toDataURL();
                var docDefinition = {
                    content: [{
                        image: data,
                        width: 500
                    }]
                };
                pdfMake.createPdf(docDefinition).download("Student_List.pdf");
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