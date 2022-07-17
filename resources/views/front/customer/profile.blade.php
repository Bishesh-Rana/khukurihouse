@extends('front.layouts.app')

@section('title')
    Profile | Dashboard |
    @if ($setting->site_name)
        {{ $setting->site_name }}
    @endif
@stop

@section('content')
    <div id="content" class="site-content">
        <div class="c-dashboard pt pb">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-3">
                        @include('front.customer.section.sidebar')
                    </div>
                    <div class="col-sm-9">
                        <div id="primary" class="content-area">
                            <main id="main" class="site-main">
                                <div class="type-page hentry">
                                    <header class="entry-header">
                                        <div class="page-header-caption">
                                            <h1 class="entry-title">Profile</h1>
                                            {{-- <span>Reward Point: {{ $data->reward_point }}</span> --}}
                                        </div>
                                    </header>
                                    <!-- .entry-header -->
                                    <div class="entry-content">
                                        <div class="form-group row">
                                            <div class="col-xs-12 col-md-3">
                                                @if (isset($data->image))
                                                    <img class="border pf-images"
                                                        src="{{ asset('') }}uploads/customers/{{ $data->image }}"
                                                        alt="profile-image">
                                                @endif
                                                <a href="{{ route('customer.dashboard.profile.edit', Auth::guard('web')->user()->id) }}"
                                                    class="dash-btn">@if (isset($data->image))Change @else Upload @endif
                                                    Profile Pic</a>
                                            </div>
                                            <!-- .col -->
                                            <div class="col-xs-12 col-md-9">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <ul class="d-list">
                                                            <li>
                                                                <b>Name:</b>
                                                                <span>{{ $data->name }}</span>
                                                            </li>
                                                            <li>
                                                                <b>Phone:</b>
                                                                <span>{{ $data->phone }}</span>
                                                            </li>
                                                            <li>
                                                                <b>Address:</b>
                                                                <span>{{ $data->address }}</span>
                                                            </li>
                                                            <li>
                                                                <b>Email:</b>
                                                                <span>{{ $data->email }}</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    {{-- <div class="col-md-6">
                                                        <ul class="d-list">
                                                            <li>
                                                                <b>Country:</b>
                                                                <span>{{ $data->country }}</span>
                                                            </li>
                                                            <li>
                                                                <b>State:</b>
                                                                <span>{{ $data->state }}</span>
                                                            </li>
                                                            <li>
                                                                <b>Town:</b>
                                                                <span>{{ $data->town }}</span>
                                                            </li>
                                                            <li>
                                                                <b>Street:</b>
                                                                <span>{{ $data->street }}</span>
                                                            </li>
                                                            <li>
                                                                <b>Apartment:</b>
                                                                <span>{{ $data->apartment }}</span>
                                                            </li>
                                                            <li>
                                                                <b>Zipcode:</b>
                                                                <span>{{ $data->zipcode }}</span>
                                                            </li>
                                                        </ul>
                                                    </div> --}}
                                                </div>
                                            </div>
                                            <div class="col-md-3">

                                            </div>
                                            {{-- <div class="col-md-9">
                                                <div class="dp-option">
                                                    <h6>Payment Option:</h6>
                                                    @if ($data->payment_option == 'cash') Cash @endif
                                                    @if ($data->payment_option == 'esewa')<img class="payment-icon-image" src="{{ asset('') }}esewa.png" width="50" height="50" alt="esewa" />Esewa @endif
                                                    @if ($data->payment_option == 'khalti')<img class="payment-icon-image" src="{{ asset('') }}khalti.png" width="50" height="50" alt="esewa" />Khalti @endif
                                                    @if ($data->payment_option == 'imepay')<img class="payment-icon-image" src="{{ asset('') }}imepay.png" width="50" height="50" alt="esewa" />Imepay @endif
                                                    @if ($data->payment_option == 'paypal')<img class="payment-icon-image" src="{{ asset('') }}assets/images/credit-cards/paypal.svg" width="50" height="50" alt="paypal" />Paypal @endif
                                                </div>
                                            </div> --}}
                                            <!-- .col -->
                                        </div>

                                    </div>
                                    <!-- .entry-content -->
                                </div>
                                <!-- .hentry -->
                            </main>
                            <!-- #main -->
                        </div>
                        <!-- #primary -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
    <script src="{{ asset('') }}assets/js/jquery-1.11.1.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.button-left').click(function() {
                $('.sidebar').toggleClass('fliph');
            });
            $('#success').delay(5000).fadeOut('slow');
        });
    </script>
@stop
