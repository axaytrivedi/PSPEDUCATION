                            
 @extends('layouts.app')
@section('content')                           

                            <div class="card mb-3">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Company Details</h6> 
                                </div>
                                <div class="card-body">
                                @if ($errors->any())
                                <div class="alert alert-danger" id="errors_all_page">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <form id="brandDetailes" method="post"
                                    action=" @if(!empty($edit_details->id)!=0)  {{route('details.update',$edit_details->id)}}   @else {{route('details.store')}}@endif"
                                    enctype="multipart/form-data">

                                    @if(!empty($edit_details->id)) @method('PATCH') @endif @csrf
                                        <div class="row g-3 align-items-center">
                                        <div class="card-header">
                                            <b><h5 class="card-title">{{isset($edit_details)?'Edit':"Add"}} Details</h5></b>
                                            <!-- <b href="{{route('details.index')}}" class="btn btn-primary py-2 px-5 btn-set-task w-sm-100> Back</a> -->
                                        </div>
                                            <div class="col-md-6 form-group">
                                                <label for="firstname" class="form-label">School Name</label>
                                                <input type="text" class="form-control" id="SchoolName" 
                                                name="SchoolName" value="{{ old('SchoolName', isset($edit_details->SchoolName) ?  $edit_details->SchoolName  : '' ) }}" required>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="lastname" class="form-label">AddressLine 1</label>
                                                <input type="text" class="form-control" id="AddressLine1" required
                                                name="AddressLine1" value="{{ old('AddressLine1', isset($edit_details->AddressLine1) ?  $edit_details->AddressLine1  : '' ) }}">

                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">AddressLine 2</label>
                                                <input type="text" class="form-control" id="AddressLine2" required
                                                name="AddressLine2" value="{{ old('AddressLine2', isset($edit_details->AddressLine2) ?  $edit_details->AddressLine2  : '' ) }}">

                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">AddressLine 3</label>
                                                <input type="text" class="form-control" id="AddressLine3" required
                                                name="AddressLine3" value="{{ old('AddressLine3', isset($edit_details->AddressLine3) ?  $edit_details->AddressLine3  : '' ) }}">
                                            </div>
                                            <!-- <div class="col-md-6 form-group">
                                                <label  class="form-label">Country</label>
                                                <input type="text" class="form-control" id="Country" required
                                                name="Country" value="{{ old('Country', isset($edit_details->Country) ?  $edit_details->Country  : '' ) }}">
                                            </div> -->
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Country</label>
                                                <input type="text" id="Country" name="Country" required onchange="changecountry();" autocomplete="off"
                                                    @if(isset($edit_details))
                                                        @if ($edit_details->Country == NULL)
                                                        value="{{ old('Country', isset($edit_details) ?  ($edit_details->Country) : '' )  }}"
                                                        @else
                                                        value="{{ old('Country', isset($edit_details) ?   getcountry($edit_details->Country) : '' )  }}"
                                                        @endif
                                                    @endif
                                                        class="form-control">
                                                <input type="hidden" name="schoolCountry" id='schoolCountry' value="{{ old('Country', isset($edit_details) ? $edit_details->Country : '' )  }}">
                                            </div>
                                            <!-- <div class="col-md-6 form-group">
                                                <label  class="form-label">State</label>
                                                <input type="text" class="form-control" id="State" required
                                                name="State" value="{{ old('State', isset($edit_details->State) ?  $edit_details->State  : '' ) }}">
                                            </div> -->
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">State</label>
                                                <input type="text" id="State" name="State" required onchange="changestate();" autocomplete="off"
                                                    @if(isset($edit_details))
                                                        @if ($edit_details->State == NULL)
                                                        value="{{ old('State', isset($edit_details) ?  ($edit_details->State) : '' )  }}"
                                                        @else
                                                        value="{{ old('State', isset($edit_details) ?   getstate($edit_details->State) : '' )  }}"
                                                        @endif
                                                    @endif
                                                        class="form-control">
                                                <input type="hidden" name="schoolState" id='schoolState' value="{{ old('State', isset($edit_details) ? $edit_details->State : '' )  }}">
                                            </div>
                                            <!-- <div class="col-md-6 form-group">
                                                <label  class="form-label">City</label>
                                                <input type="text" name="City" class="form-control" id="City" required
                                                name="schoolname" value="{{ old('City', isset($edit_details->City) ?  $edit_details->City  : '' ) }}">
                                            </div> -->
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">City</label>
                                                <input type="text" id="City" name="City" required autocomplete="off"
                                                    @if(isset($edit_details))
                                                        @if ($edit_details->City == NULL)
                                                        value="{{ old('City', isset($edit_details) ?  ($edit_details->City) : '' )  }}"
                                                        @else
                                                        value="{{ old('City', isset($edit_details) ?   getcities($edit_details->City) : '' )  }}"
                                                        @endif
                                                    @endif
                                                        class="form-control">
                                                <input type="hidden" name="schoolCity" id='schoolCity' value="{{ old('City', isset($edit_details) ? $edit_details->City : '' )  }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Pin</label>
                                                <input type="text" class="form-control" id="Pin" required
                                                name="Pin" value="{{ old('Pin', isset($edit_details->Pin) ?  $edit_details->Pin  : '' ) }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Contact Person</label>
                                                <input type="text" class="form-control" id="ContactPerson" required
                                                name="ContactPerson" value="{{ old('ContactPerson', isset($edit_details->ContactPerson) ?  $edit_details->ContactPerson  : '' ) }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Email</label>
                                                <input type="email" class="form-control" id="Email" required
                                                name="Email" value="{{ old('Email', isset($edit_details->Email) ?  $edit_details->Email  : '' ) }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Phone 1</label>
                                                <input type="text" class="form-control" id="Phone1" required
                                                name="Phone1" value="{{ old('Phone1', isset($edit_details->Phone1) ?  $edit_details->Phone1  : '' ) }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Phone2</label>
                                                <input type="text" class="form-control" id="Phone2" required
                                                name="Phone2" value="{{ old('Phone2', isset($edit_details->Phone2) ?  $edit_details->Phone2  : '' ) }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">WhatsApp No</label>
                                                <input type="text" class="form-control" id="WhatsAppNo" required
                                                name="WhatsAppNo" value="{{ old('WhatsAppNo', isset($edit_details->WhatsAppNo) ?  $edit_details->WhatsAppNo  : '' ) }}">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label  class="form-label">Website Link</label>
                                                <input type="url" class="form-control" id="WebsiteLink" required
                                                name="WebsiteLink" value="{{ old('WebsiteLink', isset($edit_details->WebsiteLink) ?  $edit_details->WebsiteLink  : '' ) }}">
                                            </div>
                                        </div>
                                            <button type="submit" class="btn btn-success mt-4">@if(!empty($edit_details->id))
                                                Update @else Save @endif</button>
                                            <a href="{{route('details.index')}}" type="submit"
                                                class=" m-w-105 btn btn-danger mt-4">Cancel</a>
                                    </form>
                                </div>
                            </div>
<script>
$(document).ready(function () {
    $('#brandDetailes').validate({
        rules: {
            SchoolName: {
                required: true
            },
            AddressLine1: {
                required: true
            },
            AddressLine2: {
                required: true
            },
            AddressLine3: {
                required: true
            },
            State: {
                required: true
            },
            City: {
                required: true
            },
            Country: {
                required: true
            },
            Pin: {
                required: true
            },
            Email: {
                required: true
            },
           
        },
        messages: {
            SchoolName: {
                required: "Please enter SchoolName "
            },
            AddressLine1: {
                required: "Please enter AddressLine1 "
            },
            AddressLine2: {
                required: "Please enter AddressLine2 "
            },
            AddressLine3: {
                required: "Please enter AddressLine3 "
            },
            State: {
                required: "Please enter State "
            },
            City: {
                required: "Please enter City "
            },
            Country: {
                required: "Please enter Country "
            },
            Pin: {
                required: "Please enter Pin "
            },
            ContactPerson: {
                required: "Please enter ContactPerson "
            },

            Email: {
                required: "Please enter Email "
            },
           
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

    $("#Country").autocomplete({
        source: function( request, response ) {
            var _token = $('input[name="_token"]').val();
        // Fetch data
        $.ajax({
            url:"{{route('school.get_countries')}}",
            type: 'get',
            dataType: "json",
            data: {
            _token: _token,
            query: request.term
            },
            success: function( data ) {
                //alert(data);
                console.log(data);
            response( data );
            }
        });
        },
        select: function (event, ui) {
            event.preventDefault();
            if(ui.item.value!='No record found'){
                $('#Country').val(ui.item.label);
                $('#schoolCountry').val(ui.item.value);
            }
            else{
                $('#Country').val('');
                $('#schoolCountry').val('');
            }
        return false;
        },
        focus: function (event, ui) {
            event.preventDefault();
            this.value = ui.item.label;
            if(ui.item.value!='No record found'){
                $("#Country").val(ui.item.label);
                $('#schoolCountry').val(ui.item.value);
            }
            else{
                $('#Country').val('');
                $('#schoolCountry').val('');
            }
        }
    });

    $("#State").autocomplete({
        source: function( request, response ) {
            var _token = $('input[name="_token"]').val();
            var country = $("#schoolCountry").val();
        // Fetch data
        $.ajax({
            url:"{{route('school.get_state')}}",
            type: 'post',
            dataType: "json",
            data: {
            _token: _token,
            query: request.term,
            country:country
            },
            success: function( data ) {
                //alert(data);
            response( data );
            }
        });
        },

        select: function (event, ui) {
            event.preventDefault();
            if(ui.item.value!='No record found'){
                $('#State').val(ui.item.label);
                $('#schoolState').val(ui.item.value);
            }
            else{
                $('#State').val('');
                $('#schoolState').val('');
            }
        return false;
        },
        focus: function (event, ui) {
            event.preventDefault();
            this.value = ui.item.label;
            if(ui.item.value!='No record found'){
                $("#State").val(ui.item.label);
                $('#schoolState').val(ui.item.value);
            }
            else{
                $('#State').val('');
                $('#schoolState').val('');
            }
        }
    });

    $("#City").autocomplete({
        source: function( request, response ) {
            var _token = $('input[name="_token"]').val();
            var state = $("#schoolState").val();
        // Fetch data
        $.ajax({
            url:"{{route('school.get_city')}}",
            type: 'post',
            dataType: "json",
            data: {
            _token: _token,
            query: request.term,
            state:state
            },
            success: function( data ) {
                console.log(data);
            response( data );
            }
        });
        },
        select: function (event, ui) {
            event.preventDefault();
            if(ui.item.value!='No record found'){
                $('#City').val(ui.item.label);
                $('#schoolCity').val(ui.item.value);
            }
            else{
                $('#City').val('');
                $('#schoolCity').val('');
            }
        return false;
        },
        focus: function (event, ui) {
            event.preventDefault();
            this.value = ui.item.label;
            if(ui.item.value!='No record found'){
                $("#City").val(ui.item.label);
                $('#schoolCity').val(ui.item.value);
            }
            else{
                $('#City').val('');
                $('#schoolCity').val('');
            }
        }
    });
});

function changecountry(){
    $("#State").val('');
    $("#schoolState").val('');
    $("#City").val('');
    $("#schoolCity").val('');
}
function changestate(){
    $("#City").val('');
    $("#schoolCity").val('');
}
</script>
@endsection