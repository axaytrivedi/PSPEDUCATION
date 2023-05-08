<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<!-- Mirrored from pixelwibes.com/template/ebazar/html/dist/ui-elements/auth-password-reset.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Feb 2022 07:32:18 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PSP EDUCTATION</title>
    <link rel="icon" href="{{URL::asset('assets/psp.jpg')}}" type="image/x-icon"> 
 

    <!-- project css file  -->
    <link rel="stylesheet" href="{{URL::asset('assets/css/ebazar.style.min.css')}}">
</head>
<body>
    <div id="ebazar-layout" class="theme-blue">

        <!-- main body area -->
        <div class="main p-2 py-3 p-xl-5">
            
            <!-- Body: Body -->
            <div class="body d-flex p-0 p-xl-5">
                <div class="container-xxl">

                    <div class="row g-0">
                        <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center rounded-lg auth-h100">
                            <div style="max-width: 25rem;">
                                <div class="text-center mb-5">
                            
                                </div>
                                <div class="mb-5">
                                </div>
                                <!-- Image block -->
                                <div class="">
                                <img src="{{URL::asset('PSP_image.png')}}" alt="login-img">

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
                        
                            <div class="w-100 p-3 p-md-5 card border-0 shadow-sm" style="max-width: 32rem;">
                                <!-- Form -->
                                <form  class="row g-1 p-3 p-md-4"method="POST" action="{{ route('password.email') }}">
                                 @csrf


                                    <div class="col-12 text-center mb-5">

                                        <h1>Forgot password?</h1>
                                    </div>
                                    <div class="mb-5">
                                        @if (session('status'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('status') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-2">
                                            <label class="form-label">Email address</label>
                                            <input type="email" id="email"name="email" class="form-control @error('email') is-invalid @enderror form-control-lg" required autocomplete="email" autofocusvalue="{{ old('email') }}" placeholder="name@example.com">
                                                @error('email')
                                                
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 text-center mt-4">
                                        <button type="submit" class="btn btn-lg btn-block btn-light lift text-uppercase">  {{ __('Send Password Reset Link') }}</button>
                                    </div>
                                    <div class="col-12 text-center mt-4">
                                        <span class="text-muted"><a href="{{route('login')}}" class="text-secondary">Back to Sign in</a></span>
                                    </div>
                                </form>
                                <!-- End Form -->
                                
                            </div>
                        </div>
                    </div> <!-- End Row -->
                    
                </div>
            </div>

        </div>

    </div>

    <!-- Jquery Core Js -->
    <script src="../assets/bundles/libscripts.bundle.js"></script>
</body>

<!-- Mirrored from pixelwibes.com/template/ebazar/html/dist/ui-elements/auth-password-reset.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Feb 2022 07:32:19 GMT -->
</html>