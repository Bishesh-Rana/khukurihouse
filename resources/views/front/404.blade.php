@extends('front.layouts.app')

@section('title')

@if($setting->site_name)
Page Not Found | {{$setting->site_name}}
@endif

@stop

@section('body')
<body class="page-template-default error-page">
@stop

@section('content')
<section class="login-page mt mb">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="login-main">
                    <div class="category-title">
                        <h3>404!</h3>
                    </div>
                    <p>
                        Oops! That page can’t be found.
                    </p>
                    <a href="{{ route('home.index') }}" title="" class="btn btn-primary main-btn">Return To Home</a>
                </div>
            </div>

        </div>
    </div>
    </div>
</section>

<!-- #content -->

@stop
