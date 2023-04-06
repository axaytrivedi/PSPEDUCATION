@extends('layouts.app')

@section('content')
<style>
   .checkbox_other_list
   {
   margin:10px 5% 0 !important; width:10%; 
   }
   .checkbox_list
   {
   margin:10px 5% 0 !important; width:10%;
   }
   @media only screen and (max-width: 767px)
   {
   .checkbox_list 
   {
   margin:10px 0 0 !important; width:100%; white-space:normal; 
   }
   .checkbox_other_list
   {
   margin:10px 0% 0 !important; width:50%; white-space:normal;
   }
   }
</style>
<div class="card mb-3">
   <div class="card-header py-3 bg-transparent border-bottom-0">
      <div>
         <div class="pull-left">
            <h6 class="mb-0 fw-bold ">Faculty Details Table</h6>
         </div>
         <!-- <div class="pull-right"> <a class="btn btn-success" href="{{ route('faculty.create') }}"> Create New</a> </div> -->
      </div>
   </div>
   <div class="card-body">
      <div class="alert {{(Session::has('msg') !='')? 'alert-success' :''}}" id="update" >
         {!! Session::has('msg') ? Session::get("msg") : '' !!}
      </div>
      <div class="table-responsive">
      <form method="post" action="{{route('Module.GivePermission')}}">
                @csrf
                <table class="table table-responsive">   

                   
                        @forelse($perant as $per)
                        <tr>
                            <td>
                            @php  $cheked_id=   CheckPermissionExitOrNot($per['id'],$role_id);     @endphp
                                <input type="checkbox"  class="checkval_parent  customeparent{{$per['id']}}" @if(isset($cheked_id[$per['id']])) checked    @endif    data-parent="{{$per['id']}}"> <b>{{$per['Name']}}<b>

                                    <div style="display: flex;
                                                flex-wrap: wrap;
                                                
                                                margin-top: 15px;">
                                            @foreach($permisson as $child)
                                            

                                                    @if($child->moduleName  ==  $per['Name'])

                                                       
                                                    @php $module = explode("-",$child->name);
                                                    

                                                    @endphp
                                                        @if($per['Name'] =="OrderBook")


                                                        <div class="checkbox checkbox_list" style="">
                                                            <label>
                                                                <input type="hidden" name="role" value="{{$role_id}}"> 
                                                                <input type="checkbox" name="child[]"  class="child{{$per['id']}}" id="{{$per['id']}}" value="{{$child->name}}"  @if(isset($cheked_id[$child->id])) checked  @endif  > @php echo ucfirst( str_replace("_"," ",$module[1])); @endphp</label>
                                                          </div>

                                                        @else

                                                        @php
                                                        $cheked_id= CheckPermissionExitOrNot($child->id,$role_id);     // helper function
                                                        
                                                        @endphp
                                                         
                                                     

                                                        <div class="checkbox checkbox_other_list" style="">
                                                            <label>
                                                                <input type="hidden" name="role" value="{{$role_id}}"> 
                                                                <input type="checkbox" name="child[]"  class="child{{$per['id']}}" id="{{$per['id']}}" value="{{$child->name}}"  @if(isset($cheked_id[$child->id])) checked  @endif  >
                                                                
                                                                @php echo ucfirst( str_replace("_"," ",$module[1])); @endphp
                                                            </label>
                                                          </div>
                                                        @endif
                                                    @endif
                                        

                                        @endforeach 
                                    </div>

                            </td>
                        </tr>

                    @empty
                        <tr><td style="text-align:center;"><b>No Modules Found...!</b></td></tr>
                    @endforelse
                </table> 
                    <div class="col-md-12 form_Submit_cancel_btn" > 
                        <button type="submit"   class=" m-w-105 btn btn-sm btn-success">@if(!empty($edit_users->id)) Update @else Save @endif</button>
                        <a href="{{route('role.index')}}" type="submit" class=" m-w-105 btn btn-sm btn-danger">Cancel</a>
                    </div>   
            </form>
      </div>
   </div>
</div>
<script>
$(".checkval_parent").click(function(){

    var parent =$(this).attr('data-parent');
   var checkparent =  $(".customeparent"+parent).is(':checked');
    
    if( checkparent== true)
    {   
        var child = $(".child"+parent).prop("checked", true);
    }
    else if( checkparent== false )
    {
        var child = $(".child"+parent).removeAttr('checked');
        console.log(child);
    }
    
   

});
</script>
@endsection