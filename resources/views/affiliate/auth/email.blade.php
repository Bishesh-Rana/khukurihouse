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
</head>

<body class="bg-silver-300">

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
        @include('admin.layouts.error')

        <form role="form" method="POST" action="{{ route('affiliate.password.email') }}">
            @csrf
            <h2 class="login-title">Affiliate Password Reset</h2>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-envelope"></i></div>
                    <input class="form-control" type="email" name="email" id="email" placeholder="Email" autocomplete="email" required autofocus>
                </div>
            </div>
            <div class="form-group d-flex justify-content-between">
                
                <a href="{{route('affiliate.login')}}">Login</a>
            </div>
            <div class="form-group">
                <button class="btn btn-info btn-block" type="submit">Send Password Reset Link</button>
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