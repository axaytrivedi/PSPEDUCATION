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
                           
                                    <div class="row " >
                                        <div class="col-md-6 " >
                                        <select class="form-group form-control" id="filter" name="filter">
                                            <option disabled selected>-- Select Filter --</option>
                                            @foreach(  $ParameterMaster as $p)
                                            <option value="{{$p->ParaID}}">{{$p->ParaDescription}}</option>

                                            @endforeach
                                        </select>
                                        </div>
                                        <div class="col-md-6 " >
                                        <button class="btn btn-primary">Add New</button>
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
     
$("#filter").select2();
    $("#filter").on("change",function(){
        var id = $(this).val();
        $("appendHereTable").html(" ");
        $.post("{{route('getDepenedentFilters')}}",{'id':id,_token:"{{csrf_token()}}"},function(success){
                $(".appendHereTable").html(success.html);     
        });
    });
// $('.js-example-basic-single').select2();
</script>
@endsection