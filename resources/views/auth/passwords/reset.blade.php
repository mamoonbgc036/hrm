<!DOCTYPE html>
<html lang="bn-BD" class="login-registration">
<head>

    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>লগইন - বাংলাদেশ ফায়ার সার্ভিস ও সিভিল ডিফেন্স</title>
    <link rel="shortcut icon" href="{{ URL::asset('assets/login/image/favicon.ico')}}">
    <link href="{{ URL::asset('assets/login/css/login.css')}}" type="text/css" rel="stylesheet" />
    <link href="{{ URL::asset('assets/login/css/app.css')}}" type="text/css" rel="stylesheet" />
    <link href="{{ URL::asset('assets/login/css/app-bangla.css')}}" type="text/css" rel="stylesheet" />
</head>
<body class="login-registration">
<div class="behave-table">
    <div class="behave-table-cell text-center">
        <div class="form-holder">
            <div class="form-left text-center">
                <h3>হিউম্যান রিসোর্স ম্যানেজমেন্ট সিস্টেম</h3>
                <h2 class="site-description">বাংলাদেশ ফায়ার সার্ভিস ও সিভিল ডিফেন্স</h2>
                <div class="footer-text">
                    {{--                    <p class="credit-line visible-desktop">ডিজাইন ও ডেভলপ করেছেন: <a href="http://technovista.com.bd?ref=kmsilo" target="_blank">টেকনোভিস্তা লিমিটেড</a></p>--}}
                </div>

                <div class="backdrop"></div>
            </div>
            <div class="form-right text-left">
                <a href="{{ url('/login') }}">
                    <img src="{{url(asset('assets\login\image\logo-bfscd.png'))}}" alt="master.page_title" width="120">
                </a>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <h4 class="login-text">অফিস লগইন</h4>
                    <div class="form-group">
                        <label for="email" class="control-label">{{ __('লগইন আইডি') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="password">পাসওয়ার্ড:</label>
                       <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="পাসওয়ার্ড" autofocus>
                        @error('password')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                                                <strong>{{ $message }}</strong>
                                            </span>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="password-confirm" class="control-label">কনফার্ম পাসওয়ার্ড:</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                    </div>
                    <button class="btn btn-primary text-uppercase">রিসেট পাসওয়ার্ড</button>
                </form>

                {{--                <p class="credit-line visible-mobile">ডিজাইন ও ডেভলপ করেছেন: <a href="http://technovista.com.bd?ref=kmsilo" target="_blank">টেকনোভিস্তা লিমিটেড</a></p>--}}
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
