@extends('front.layouts.app')


@section('title')
Verification |
    @if ($setting->site_name)
        {{ $setting->site_name }}
    @endif

@stop


@section('content')


    <section class="login-page mt mb">
        <div class="container">
            <div class="row">

                <div class="col-md-6">
                    <div class="login-form">
                        <div class="category-title">
                            <h3>Please insert the 6 digit OTP that you received in your email.</h3>
                        </div>
                        <form action="{{route('customer.verification')}}" method="post">
                            @csrf
                            <input type="hidden" class="input-text" name="email" value="{{$customer->email}}" required autofocus />
                            <div class="form-group">
                                {{-- <i class="far fa-envelope"></i> --}}
                                <input type="text" name="otp" class="form-control" placeholder="OTP"
                                    value="{{ old('otp') }}" required autocomplete="otp" autofocus>
                            </div>

                            <div class="log-btn log-two">
                                <button type="submit" class="btn btn-primary main-btn">Verify</button>
                                <a href="{{route('customer.otp',[$customer->id , 'resend' => '1'])}}" title="">Resend Code?</a>
                            </div>
                        </form>




                    </div>


                </div>

            </div>
        </div>
        </div>
    </section>

@stop

@section('footer')

@stop
