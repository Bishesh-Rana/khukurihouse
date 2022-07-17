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
                        <h3>New Password Form</h3>
                    </div>
                    <form action="{{ route('customer.password.request') }}" method="post">
                        @csrf
                        <input type="hidden" class="input-group-addon" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <i class="far fa-envelope"></i>
                            <input type="email" name="email" class="form-control" placeholder="Email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>
                        <div class="form-group">
                            <i class="las la-key"></i>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <i class="las la-key"></i>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                        </div>
                        <div class="log-btn log-two">
                            <button type="submit" class="btn btn-primary main-btn">Change Password</button>
                            <a href="{{ route('customer.password.request') }}" title="">Forgot your password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

@endsection
