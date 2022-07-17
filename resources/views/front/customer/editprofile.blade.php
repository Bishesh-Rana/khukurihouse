@extends('front.layouts.app')

@section('title')
    Edit Profile | Dashboard |
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
                                            <h1 class="entry-title">Edit Profile</h1>
                                        </div>
                                    </header>
                                    <!-- .entry-header -->
                                    <div class="entry-content">
                                        <form class="wpcf7-form" novalidate="novalidate" method="post"
                                            action="{{ route('customer.dashboard.profile.update', Auth::guard('web')->user()->id) }}"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="row">
                                                <div class="col-xs-12 col-md-3">
                                                    @if (isset(Auth::guard('web')->user()->image))
                                                        <div> <img class="border pf-images"
                                                                src="{{ asset('') }}uploads/customers/{{ $customer->image }}"
                                                                alt="image"></div>
                                                    @endif

                                                </div>
                                                <!-- .col -->
                                                <div class="col-xs-12 col-md-9">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Upload Photo</label>
                                                                <div class="overlay"><input type="file" name="image"
                                                                        class="form-control"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-md-6">
                                                            <div class="form-group">
                                                                <label>Name</label>
                                                                <span class="wpcf7-form-control-wrap first-name">
                                                                    <input type="text" name="name" aria-invalid="false"
                                                                        aria-required="true"
                                                                        class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input-text form-control"
                                                                        size="25" value="<?php if (isset($customer)) {
            echo $customer->name;
        } else {
            echo old('name');
        } ?>" <?php if ($customer->name != '' || $customer->name != null) {
            echo 'readonly';
        } ?>>
                                                                </span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Phone</label>
                                                                <span class="wpcf7-form-control-wrap last-name">
                                                                    <input type="text" name="phone" aria-invalid="false"
                                                                        aria-required="true"
                                                                        class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input-text form-control"
                                                                        size="20" value="<?php if (isset($customer)) {
            echo $customer->phone;
        } else {
            echo old('phone');
        } ?>" <?php if ($customer->phone != '' || $customer->phone != null) {
            echo 'readonly';
        } ?>>
                                                                </span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Password</label>
                                                                <span class="wpcf7-form-control-wrap first-name">
                                                                    <input type="password" aria-invalid="false" aria-required="true"
                                                                        class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input-text form-control"
                                                                        size="40" value="" name="password">
                                                                </span>
                                                            </div>
                                                        </div>
        
                                                        <div class="col-xs-12 col-md-6">
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <span class="wpcf7-form-control-wrap first-name">
                                                                    <input type="text" name="email" aria-invalid="false"
                                                                        aria-required="true"
                                                                        class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input-text form-control"
                                                                        size="40" value="<?php if (isset($customer)) {
            echo $customer->email;
        } else {
            echo old('email');
        } ?>" <?php if (isset($customer->email)) {
            echo 'readonly';
        } ?>>
                                                                </span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Address</label>
                                                                <span class="wpcf7-form-control-wrap last-name">
                                                                    <input type="text" name="address" aria-invalid="false"
                                                                        aria-required="true"
                                                                        class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input-text form-control"
                                                                        size="40" value="<?php if (isset($customer)) {
            echo $customer->address;
        } else {
            echo old('address');
        } ?>">
                                                                </span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Confirm Password</label>
                                                                <span class="wpcf7-form-control-wrap last-name">
                                                                    <input type="password" aria-invalid="false" aria-required="true"
                                                                        class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input-text form-control"
                                                                        size="40" value="" name="password_confirmation">
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group clearfix">
                                                                <input type="submit" value="Update"
                                                                    class="wpcf7-form-control wpcf7-submit btn btn-primary m-btn" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- .col -->
                                            </div>

                                            
                                            <!-- .form-group-->
                                            <div class="wpcf7-response-output wpcf7-display-none"></div>
                                        </form>
                                        <!-- .wpcf7-form -->
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
                <!-- .row -->
            </div>
        </div>
        <!-- .col-full -->
    </div>
    <!-- #content -->
@stop

@section('footer')
    <script src="{{ asset('') }}assets/js/jquery-1.11.1.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.button-left').click(function() {
                $('.sidebar').toggleClass('fliph');
            });
        });
    </script>
@stop
