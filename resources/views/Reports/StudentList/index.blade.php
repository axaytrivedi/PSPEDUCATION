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
                    <div class="col-md-4">
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
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><strong>Batch Code :</strong></label>
                            <select id='studentBatchCode'name="studentBatchCode" class="form-control" style="width: 200px">
                                <option value="">--Select Course Code--</option>
                                @foreach ($batchName as $bCode)
                                <option value="{{ $bCode->BatchCode }}">
                                    {{ $bCode->BatchCode }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button style="margin-top: 21px;"type="submit" class="btn btn-success" name="search">Search</button>

                    </div>

                </div>
                    
            </form>
            
            <!-- <div class="pull-right">
                <a class="btn btn-success" href="{{ route('student.create') }}"> Create New</a>
            </div> -->
        </div>
    </div>
    <div class="card-body" id="report" >
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>SrNo</th>
                    <th>CourceCode</th>
                    <th>BatchCode</th>
                    <th>StudentCode</th>
                    <th>RollNo</th>
                    <th>StudentName</th>
                </tr>
                </thead>
                <tbody id="tbldata">
        
        
                </tbody>
                <tbody  class="report_message"> 
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
                
                $.ajax({   
                    type: "POST",
                    url : '{{route('studentList.getStudentData')}}',
                    data: {
                        courseCode: courseCode,
                        batchCode: batchCode,
                    },
                    //cache: false,
                    success: function(data) {
                        // console.log(data);
                        $('#report').show();
                        var tbldata = '';

                        var count = 1;
                        for(var k=0; k < data[0].length; k++)
                        {
                            tbldata += '<tr><td>'+count+'</td><td>'+data[0][k].CourceCode+'</td><td>'+data[0][k].BatchCode+'</td><td>'+data[0][k].StudentCode+'</td><td>'+data[0][k].RollNo+'</td><td>'+data[0][k].StudentName+'</td></tr>';
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
@endsection