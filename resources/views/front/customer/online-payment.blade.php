@extends('front.layouts.app')

@section('title')
Online Payment Service | Dashboard |
@if($setting->site_name)
{{$setting->site_name}}
@endif
@stop

@section('content')
    <div id="content" class="site-content">
        <div class="col-full">
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
                                        <h1 class="entry-title">Online Payment Service</h1>
                                        @include('front.layouts.error')
                                    </div>
                                </header>
                                <!-- .entry-header -->
                                <div class="entry-content">
                                    <form class="wpcf7-form" novalidate="novalidate" method="post" action="#" id="payment-form" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group row">
                                            <div class="col-xs-12 col-md-6">
                                                @if(isset(Auth::guard('web')->user()->image))
                                                <div> <img class="border " src="{{asset('')}}uploads/customers/{{$customer->image}}" alt="image" width="100" height="100"></div>
                                                @endif

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <label>Name
                                                </label>
                                                <br>
                                                <span class="wpcf7-form-control-wrap first-name">
                                                    <input type="text" name="name" aria-invalid="false" aria-required="true" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input-text" size="25" value="<?php if (isset($customer)) echo $customer->name;
                                                                                                                                                                                                                            else echo old('name'); ?>" <?php if ($customer->name != '' || $customer->name != null) echo 'readonly'; ?>>
                                                </span><br>

                                                <label>Phone Number
                                                </label>
                                                <br>
                                                <span class="wpcf7-form-control-wrap last-name">
                                                    <input type="text" name="phone" aria-invalid="false" aria-required="true" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input-text" size="20" value="">
                                                </span><br>

                                                <label>Amount
                                                </label>
                                                <br>
                                                <span class="wpcf7-form-control-wrap first-name">
                                                    <input type="number" name="amount" min="10" aria-invalid="false" aria-required="true" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input-text" size="40" value="">
                                                </span>
                                            </div>

                                        </div>
                                        <br>

                                        <div class="form-group clearfix">
                                            <p>
                                                <input type="submit" value="Proceed" id="payment-proceed" class="wpcf7-form-control wpcf7-submit" />
                                            </p>
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
        <!-- .col-full -->
    </div>
    <!-- #content -->
    @stop

    @section('footer')
    <script src="{{asset('')}}assets/js/jquery-1.11.1.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.button-left').click(function() {
                $('.sidebar').toggleClass('fliph');
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#payment-proceed').click(function(e) {
                e.preventDefault();
                console.log("i am here!");

                var today = new Date();

                var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();

                var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();

                let form = document.getElementById('payment-form');
                let data = {
                    companyCode: 'Nectar Digit',
                    serviceCode: form['phone'].value,
                    account: form['amount'].value,
                    special1: '',
                    special2: '',
                    transactionDate: date + ' ' + time,
                    transactionId: 'abcd',
                    refStan: 'asdf',
                    amount: form['amount'].value,
                    billNumber: '212212',
                    userId: 'NeCTArDT',
                    userPassword: 'NeCTArDT',
                    salePointType: '6',
                }
                console.log(data);
            });
        });
    </script>
    @stop
