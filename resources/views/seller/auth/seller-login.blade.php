<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>{{$setting->site_name}} | Login</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="{{asset('')}}admincast/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{asset('')}}admincast/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="{{asset('')}}admincast/assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="{{asset('')}}admincast/assets/css/main.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <link href="{{asset('')}}admincast/assets/css/pages/auth-light.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link rel="stylesheet" href="{{asset('')}}admincast/assets/signin.css">
    <link rel="shortcut icon" href="{{asset('')}}uploads/settings/{{$setting->site_mini_logo}}">

</head>

<body class="bg-silver-300">
    <!-- <section id="sign-in-page1">
        <div class="sign-in-form">
            <form role="form" method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <h2 class="title101">sign in</h2>
                <div class="form-group">
                    <label for="">email</label>
                    <input name="email" class="form-control" type="text">
                </div>
                <div class="form-group">
                    <label for="">password</label>
                    <input name="password" class="form-control" type="text">
                </div>

                <div id="custom-checkbox1">
                    <div class="custom-control custom-checkbox">
                        <input name="remember" type="checkbox" class="custom-control-input" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">Keep me Signed in</label>
                    </div>
                </div>

                <button type="submit">sign in</button>
                <a href="{{route('admin.password.request')}}" class="forgot-pass-btn">forgot password ?</a>
            </form>
        </div>

    </section> -->

    <div class="content">
        <div class="brand">
            <a class="link" href="{{ route('home.index') }}">
            @if(isset($setting->site_logo))
            <img src="{{asset('uploads/settings/'.$setting->site_logo)}}" alt="{{$setting->site_name}}">
            @else
            {{ $setting->site_name }}
            @endif
            </a>
        </div>
        @include('seller.layouts.error')

        <form role="form" method="POST" action="{{ route('seller.login.submit') }}">
            @csrf
            <h2 class="login-title">Seller Login</h2>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-envelope"></i></div>
                    <input class="form-control" type="string" name="email" id="email" placeholder="Email" autocomplete="email" required autofocus>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                    <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
                </div>
            </div>
            <div class="form-group d-flex justify-content-between">
                <label class="ui-checkbox ui-checkbox-info">
                    <input type="checkbox">
                    <span class="input-span"></span>Remember me</label>
                <a href="{{route('seller.password.request')}}">Forgot password?</a>
            </div>
            <div class="form-group">
                <button class="btn btn-info btn-block" type="submit">Login</button>
            </div>
        </form>
    </div>

    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS -->
    <script src="{{asset('')}}admincast/assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="{{asset('')}}admincast/assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="{{asset('')}}admincast/assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS -->
    <script src="{{asset('')}}admincast/assets/vendors/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="{{asset('')}}admincast/assets/js/app.js" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">
        $(function() {
            $('#login-form').validate({
                errorClass: "help-block",
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                },
                highlight: function(e) {
                    $(e).closest(".form-group").addClass("has-error")
                },
                unhighlight: function(e) {
                    $(e).closest(".form-group").removeClass("has-error")
                },
            });
        });
    </script>
</body>

</html>