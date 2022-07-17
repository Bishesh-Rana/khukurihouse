@extends('front.layouts.app')

@section('title')

    @if ($setting->site_name)
        {{ $setting->site_name }}
    @endif

@stop

@section('content')

@section('content')
<section class="login-page mt mb">
    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <div class="login-form">
                    <div class="category-title">
                        <h3>Password Reset</h3>
                    </div>
                    <form action="{{ route('customer.password.email') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <i class="far fa-envelope"></i>
                            <input type="email" name="email" class="form-control" placeholder="Email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>

                        <div class="log-btn log-two">
                            <button type="submit" class="btn btn-primary main-btn">Send Reset link</button>
                            <a href="{{ route('customer.login') }}" title="">Login Instead</a>
                        </div>
                    </form>




                </div>


            </div>



        </div>
    </div>
    </div>
</section>

@stop
