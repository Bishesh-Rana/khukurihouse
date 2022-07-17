@extends('front.layouts.app')


@section('title')

    @if ($setting->site_name)
        {{ $setting->site_name }}
    @endif

@stop


@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="breadcrumbs">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Accessories</a></li>
                        <li class="breadcrumb-item active" aria-current="page">1cm Felt Balls Wholesale Felt Balls</li>
                    </ol>
                </div>
            </div>
           
        </div>
    </nav>
    <!-- Breadcrumb End -->
    <!-- Forgot Page -->
    <section class="forgot-page mt mb">
        <div class="container">
            <div class="category-title">
                <h3>Forgot Your Password</h3>
            </div>
            <div class="personal-form">
                <p class="details">Please enter the email address you used to register. You will receive a temporary link to reset your password.</p>
                <form action="" method="get">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <i class="far fa-envelope"></i>
                            <input type="email" name="" class="form-control" placeholder="Email Address">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary main-btn">Sign Up</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Forgot Page End -->

@stop

@section('footer')

@stop
