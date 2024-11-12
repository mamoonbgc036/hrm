<!DOCTYPE html>
<html lang="bn-BD" class="login-registration">

<head>

    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - {{ @$company_and_software_name->company_name }}</title>
    <link rel="shortcut icon" href="{{ asset('storage/' . Storage::get('icon')) }}">
    <link href="{{ URL::asset('assets/login/css/login.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ URL::asset('assets/login/css/app.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ URL::asset('assets/login/css/app-bangla.css') }}" type="text/css" rel="stylesheet" />
    <style>
        body {
            //font-family: 'Cambria', 'Times New Roman', serif;
            font-size: 100%;
            font-size: 16px;
            background-image: url('{{ asset('storage/' . @$branding_images->login_back) }}');
            background-size: cover;
            background-position: center center;
        }

        .form-left {
            background-image: url('{{ asset('storage/' . @$branding_images->login_bk_small) }}');
            /* background-size: contain; */
            background-position: 27% 46%;
        }
    </style>
</head>

<body class="login-registration">
    <div class="behave-table">
        <div class="behave-table-cell text-center">
            <div class="form-holder">
                <div class="form-left text-center">
                    <h3>{{ @$company_and_software_name->software_name }}</h3>
                    <h2 class="site-description">{{ @$company_and_software_name->company_name }}</h2>
                    <div class="footer-text">
                        {{--                    <p class="credit-line visible-desktop">ডিজাইন ও ডেভলপ করেছেন: <a href="http://technovista.com.bd?ref=kmsilo" target="_blank">টেকনোভিস্তা লিমিটেড</a></p> --}}
                    </div>

                    <div class="backdrop"></div>
                </div>
                <div class="form-right text-left">
                    {{-- logo --}}
                    <a href="{{ url('/login') }}">
                        <img src="{{ asset('storage/' . @$branding_images->company_logo) }}" alt="master.page_title"
                            width="120">
                    </a>
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        @csrf
                        {{--                <form method="POST" action="" > --}}

                        <h4 class="login-text">অফিস লগইন</h4>


                        <div class="form-group">
                            <label class="control-label" for="username">লগইন আইডি:</label>
                            {{--                        <input class="form-control" id="username" placeholder="লগইন আইডি" required="required" name="email" type="text"> --}}
                            <input name="email" type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                @if (old('email')) value="{{ old('email') }}" @endif id="username"
                                placeholder="লগইন আইডি" autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert" style="color: red;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="password">পাসওয়ার্ড:</label>
                            <input type="password" name="password"
                                class="form-control  @error('password') is-invalid @enderror" id="userpassword"
                                placeholder="পাসওয়ার্ড">
                            @error('password')
                                <span class="invalid-feedback" role="alert" style="color: red;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-group small">
                            <div class="row">
                                <div class="col-xs-6 checkbox">
                                    <label>
                                        <input class="styled" name="remember" type="checkbox" value="yes"> মনে রাখুন
                                    </label>
                                </div>
                                <div class="col-xs-6 text-right mt-10">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('পাসওয়ার্ড ভুলে গেছেন?') }}
                                        </a>
                                    @endif

                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary text-uppercase">লগইন</button>
                    </form>

                    {{--                <p class="credit-line visible-mobile">ডিজাইন ও ডেভলপ করেছেন: <a href="http://technovista.com.bd?ref=kmsilo" target="_blank">টেকনোভিস্তা লিমিটেড</a></p> --}}
                </div>
            </div>
            <!-- /.form-holder -->

            <div class="clearfix"></div>
        </div>
        <!-- /.behave-table-cell -->
    </div>
    <!-- /.behave-table -->

</body>

</html>

{{-- @extends('layouts.master-without-nav') --}}

{{-- @section('title') --}}
{{-- Login --}}
{{-- @endsection --}}

{{-- @section('body') --}}
{{-- <body> --}}
{{-- @endsection --}}

{{-- @section('content') --}}

{{--    <div class="home-btn d-none d-sm-block"> --}}
{{--        <a href="{{route('home')}}" class="text-dark"><i class="fas fa-home h2"></i></a> --}}
{{--    </div> --}}

{{--    <div class="account-pages my-5"> --}}
{{--        <div class="container"> --}}
{{--        <h2 class="text-primary text-center">FSCD CENTRAL STORE MANAGEMENT SYSTEM</h2> --}}
{{--            <div class="row justify-content-center"> --}}
{{--                <div class="col-md-8 col-lg-6 col-xl-5"> --}}
{{--                    <div class="card overflow-hidden"> --}}
{{--                        <div class="bg-soft-primary"> --}}
{{--                            <div class="row"> --}}
{{--                                <div class="col-7"> --}}
{{--                                    <div class="text-primary p-4"> --}}
{{--                                        <h5 class="text-primary">Welcome Back !</h5> --}}
{{--                                        <p>Sign in to continue to FSCD Store.</p> --}}
{{--                                    </div> --}}
{{--                                </div> --}}
{{--                                <div class="col-5 align-self-end"> --}}
{{--                                    <img src="assets/images/profile-img.png" alt="" class="img-fluid"> --}}
{{--                                </div> --}}
{{--                            </div> --}}
{{--                        </div> --}}
{{--                        <div class="card-body pt-0"> --}}
{{--                            <div> --}}
{{--                                <a href="{{url('index')}}"> --}}
{{--                                    <div class="avatar-md profile-user-wid mb-4"> --}}
{{--                                        <span class="avatar-title rounded-circle bg-light"> --}}
{{--                                            <img src="assets/images/logo.png" alt="" class="rounded-circle" height="44"> --}}
{{--                                        </span> --}}
{{--                                    </div> --}}
{{--                                </a> --}}
{{--                            </div> --}}
{{--                            <div class="p-2"> --}}
{{--                            <form class="form-horizontal" method="POST" action="{{ route('login') }}"> --}}
{{--                                @csrf --}}
{{--                                    <div class="form-group"> --}}
{{--                                        <label for="username">Email</label> --}}
{{--                                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" @if (old('email')) value="{{ old('email') }}" @endif id="username" placeholder="Enter email" autocomplete="email" autofocus> --}}
{{--                                        @error('email') --}}
{{--                                            <span class="invalid-feedback" role="alert"> --}}
{{--                                                <strong>{{ $message }}</strong> --}}
{{--                                            </span> --}}
{{--                                        @enderror --}}
{{--                                    </div> --}}

{{--                                    <div class="form-group"> --}}
{{--                                        <label for="userpassword">Password</label> --}}
{{--                                        <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" id="userpassword" value="12345678" placeholder="Enter password"> --}}
{{--                                        @error('password') --}}
{{--                                            <span class="invalid-feedback" role="alert"> --}}
{{--                                                <strong>{{ $message }}</strong> --}}
{{--                                            </span> --}}
{{--                                        @enderror --}}
{{--                                    </div> --}}

{{--                                    <div class="custom-control custom-checkbox"> --}}
{{--                                            <input type="checkbox" class="custom-control-input" id="customControlInline"> --}}
{{--                                            <label class="custom-control-label" for="customControlInline">Remember me</label> --}}
{{--                                    </div> --}}

{{--                                    <div class="mt-3"> --}}
{{--                                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button> --}}
{{--                                    </div> --}}

{{--                                    <div class="mt-4 text-center"> --}}
{{--                                        <a href="password/reset" class="text-muted"><i class="mdi mdi-lock mr-1"></i> Forgot your password?</a> --}}
{{--                                    </div> --}}
{{--                                </form> --}}
{{--                            </div> --}}
{{--                        </div> --}}

{{--                    </div> --}}

{{--                    <div class="mt-5 text-center"> --}}
{{--                        <p>Don't have an account ? <a href="{{url('register')}}" class="font-weight-medium text-primary"> Signup now </a> </p> --}}
{{--                        <p>© <script>document.write(new Date().getFullYear())</script> Perky Rabbit.</p> --}}
{{--                    </div> --}}

{{--                </div> --}}
{{--            </div> --}}
{{--        </div> --}}
{{--    </div> --}}
{{-- @endsection --}}
