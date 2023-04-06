@extends('layouts.app')
@section('content') 

<div class="row g-3 mb-3"> 
                        <div class="col-md-12">
                                <div class="alert {{(Session::has('msg') !='')? 'alert-success' :''}}" id="update" >
                                    {!! Session::has('msg') ? Session::get("msg") : '' !!}
                                </div>
                            <div class="card"> 
                                <div class="card-body "> 
                                <form action="{{ route('newparameter') }}" id="parameter" method="post">
                                     @csrf
                           
                                    <div class="row" >
                               
                                                <div class="col-md-6 form-group ">Filter 
                                       
                                                <select class=" form-control" id="filter" name="filter">
                                                <option disabled selected>-- Select Filter --</option>
                                                @foreach(  $ParameterMaster as $p)
                                                <option value="{{$p->ParaID}}">{{$p->ParaDescription}}</option>

                                                @endforeach
                                            </select>
                                           
                                        </div>
                                        <div class="col-md-6 " >
                                        <button class="btn btn-primary checkDesc">Add New</button>
                                        </div>
                            
                                        <div class="col-md-12 appendHereTable" >
                                      
                                        
                                        </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div> 
<script>
 $(document).ready(function(){   

    $("#filter").select2();
        $("#filter").on("change",function(){
            var id = $(this).val();
            $("appendHereTable").html(" ");
                $.post("{{route('getDepenedentFilters')}}",{'id':id,_token:"{{csrf_token()}}"},function(success){
                    $(".appendHereTable").html(success.html);     
            });
        });
       
        $("#filter").select2();
            $('#parameter').validate({
                rules: {
                    filter: { required: true}, 
                    // file:{extension:"jpeg|png|jpg|gif|svg|webp",},
                    // Validity:{required:true },
                },
                messages: {
                    filter: { required: "Please Select Filter ", },
                    // file:{extension:"Only Allow jpeg|png|jpg|gif|svg|webp",},
                    // Validity:{required:"Please Select Status"}, 
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
@endsection