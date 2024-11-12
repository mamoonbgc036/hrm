

<!-- display page title -->


<!DOCTYPE html>
<html lang="bn-BD" class="login-registration">
<head>

    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>পাসওয়ার্ড রিসেট - বাংলাদেশ ফায়ার সার্ভিস ও সিভিল ডিফেন্স</title>
    <link rel="shortcut icon" href="{{ URL::asset('assets/login/image/favicon.ico')}}">
    <!-- FontAwesome v4.6.3 -->
    <link href="http://efire.viewdemo.xyz/assets/css/icons/fontawesome/styles.min.css?ver=4.6.3" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="{{ URL::asset('assets/login/image/favicon.ico')}}">
    <link href="{{ URL::asset('assets/login/css/login.css')}}" type="text/css" rel="stylesheet" />
    <link href="{{ URL::asset('assets/login/css/app.css')}}" type="text/css" rel="stylesheet" />
    <link href="{{ URL::asset('assets/login/css/app-bangla.css')}}" type="text/css" rel="stylesheet" />

    <!-- jQuery v2.1.4 -->
    <script type="text/javascript" src="http://efire.viewdemo.xyz/assets/js/core/libraries/jquery.min.js?ver=2.1.4"></script>

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
                <a href="http://efire.viewdemo.xyz">
                    <img src="http://efire.viewdemo.xyz/assets/images/logo-bfscd.png" alt="master.page_title" width="120">
                </a>


                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <h4 class="login-text">পাসওয়ার্ড রিসেট</h4>
                    <div class="form-group has-feedback has-feedback-left">
                        <label class="control-label" for="login">ব্যবহারকারী নাম/ ইমেইল</label>
                        <input class="form-control" placeholder="আপনার ব্যবহারকারী নাম কিংবা ইমেইল দিন" required="required" id="login" name="email" type="text">
                        <div class="form-control-feedback"><i class="icon-mail5 text-muted"></i></div>
                    </div>

                    <input class="btn btn-primary text-uppercase" type="submit" value="রিসেট লিংক পাঠান">

                </form>

                <p class="credit-line visible-mobile">ডিজাইন ও ডেভলপ করেছেন: <a href="http://technovista.com.bd?ref=kmsilo" target="_blank">টেকনোভিস্তা লিমিটেড</a></p>
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
