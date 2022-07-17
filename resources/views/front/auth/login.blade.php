@extends('front.layouts.app')

@section('title')

    @if ($setting->site_name)
        {{ $setting->site_name }}
    @endif

@stop

@section('content')

    <!-- Login Page -->
    <section class="login-page mt mb">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="login-main">
                        <div class="category-title">
                            <h3>New Customers</h3>
                        </div>
                        <p>
                            By creating an account with our store, you will be able to move through the checkout process
                            faster, store multiple shipping addresses, view and track your orders in your account and more.
                        </p>
                        <a href="{{ route('customer.register') }}" title="" class="btn btn-primary main-btn">Create an
                            Account</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="login-form">
                        <div class="category-title">
                            <h3>Login to Your Account</h3>
                        </div>
                        <form action="{{ route('customer.login.submit') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <i class="far fa-envelope"></i>
                                <input type="email" name="email" class="form-control" placeholder="Email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>
                            <div class="form-group">
                                <i class="las la-key"></i>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="log-btn log-two">
                                <button type="submit" class="btn btn-primary main-btn">Sign IN</button>
                                <a href="{{ route('customer.password.request') }}" title="">Forgot your password?</a>
                            </div>
                        </form>




                    </div>


                </div>
                {{-- <div class="offset-6 col-md-6">
                    <ul class="signin-option">
                        <li class="facebook">
                            <a href="{{ url('auth/facebook') }}"><i class="lab la-facebook-f"></i> Sign In With Facebook</a>
                        </li>
                        <li class="google">
                            <a href="{{ url('auth/google') }}">
                                <i class="lab la-google"></i>Sign In With Google</a>
                        </li>

                    </ul>
                </div> --}}


            </div>
        </div>
        </div>
    </section>
    <!-- Login Page End -->

@stop

@section('footer')

@stop
