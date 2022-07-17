@extends('front.layouts.app')

@section('title')
My Payment Options | Dashboard |
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
                                    <h1 class="entry-title">Payment Options</h1>
                                    @include('front.layouts.error')
                                </div>
                            </header>
                            <!-- .entry-header -->
                            <div class="entry-content">
                                <form class="wpcf7-form" novalidate="novalidate" method="post" action="{{route('customer.dashboard.payment.update',Auth::guard('web')->user()->id)}}">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-xs-12 col-md-6">
                                            <label>Country
                                            </label>
                                            <br>
                                            <span class="wpcf7-form-control-wrap first-name">
                                                <select autocomplete="country" class="country_to_state country_select select2-hidden-accessible" id="billing_country" name="country" tabindex="-1" aria-hidden="true" style="width: 93%;" required>
                                                    <option value="">Select a country…</option>
                                                    @foreach($countries as $country)
                                                    <option value="{{$country->name}}" @if($country->name == "Nepal") selected @endif>{{$country->name}}</option>
                                                    @endforeach
                                                </select>
                                            </span>
                                        </div>
                                        <!-- .col -->
                                        <div class="col-xs-12 col-md-6">
                                            <label>State/District
                                            </label>
                                            <br>
                                            <select autocomplete="country" class="country_to_state country_select select2-hidden-accessible" id="billing_state" name="state" tabindex="-1" aria-hidden="true" style="width: 93%;">
                                                <option value="">Select a district</option>
                                                @foreach($districts as $district)
                                                <option value="{{$district->district_name}}" <?php if (isset($customer) && $customer->state == $district->district_name) echo 'selected';?>>{{$district->district_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- .col -->
                                    </div>
                                    <div class="form-group row">

                                        <div class="col-xs-12 col-md-6">
                                            <label>Town
                                            </label>
                                            <br>
                                            <span class="wpcf7-form-control-wrap first-name">
                                                <input type="text" name="town" aria-invalid="false" aria-required="true" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input-text" size="40" value="<?php if (isset($customer)) echo $customer->town;
                                                                                                                                                                                                                        else echo old('town'); ?>">
                                            </span>
                                        </div>
                                        <!-- .col -->
                                        <div class="col-xs-12 col-md-6">
                                            <label>Street
                                            </label>
                                            <br>
                                            <span class="wpcf7-form-control-wrap last-name">
                                                <input type="text" name="street" aria-invalid="false" aria-required="true" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input-text" size="40" value="<?php if (isset($customer)) echo $customer->street;
                                                                                                                                                                                                                            else echo old('street'); ?>">
                                            </span>
                                        </div>
                                        <!-- .col -->
                                    </div>
                                    <!-- .form-group -->

                                    <div class="form-group row">

                                        <div class="col-xs-12 col-md-6">
                                            <label>Apartment
                                            </label>
                                            <br>
                                            <span class="wpcf7-form-control-wrap first-name">
                                                <input type="text" name="apartment" aria-invalid="false" aria-required="true" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input-text" size="40" value="<?php if (isset($customer)) echo $customer->apartment;
                                                                                                                                                                                                                            else echo old('apartment'); ?>">
                                            </span>
                                        </div>
                                        <!-- .col -->
                                        <div class="col-xs-12 col-md-6">
                                            <label>Zipcode
                                            </label>
                                            <br>
                                            <span class="wpcf7-form-control-wrap last-name">
                                                <input type="text" name="zipcode" aria-invalid="false" aria-required="true" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required input-text" size="40" value="<?php if (isset($customer)) echo $customer->zipcode;
                                                                                                                                                                                                                            else echo old('zipcode'); ?>">
                                            </span>
                                        </div>
                                        <!-- .col -->
                                    </div>
                                    <!-- .form-group -->

                                    <div class="form-group row">

                                        <div class="col-xs-12 col-md-6">
                                            <label>Select Payment Option
                                            </label>
                                            <br>
                                            <span class="wpcf7-form-control-wrap first-name">
                                                <select autocomplete="country" class="country_to_state country_select select2-hidden-accessible" id="billing_country" name="payment_option" tabindex="-1" aria-hidden="true" required>
                                                    <option value="">Select a payment option…</option>
                                                    <option value="cash" <?php if (isset($customer) && $customer->payment_option == "cash") echo 'selected'; ?>>Cash</option>
                                                    <option value="esewa" <?php if (isset($customer) && $customer->payment_option == "esewa") echo 'selected'; ?>>Esewa</option>
                                                    <option value="khalti" <?php if (isset($customer) && $customer->payment_option == "khalti") echo 'selected'; ?>>Khalti</option>
                                                    <option value="imepay" <?php if (isset($customer) && $customer->payment_option == "imepay") echo 'selected'; ?>>Imepay</option>
                                                    <option value="paypal" <?php if (isset($customer) && $customer->payment_option == "paypal") echo 'selected'; ?>>Paypal</option>
                                                </select>
                                            </span>
                                        </div>
                                        <!-- .col -->

                                    </div>
                                    <!-- .form-group -->

                                    <div class="form-group clearfix">
                                        <p>
                                            <input type="submit" value="Update" class="wpcf7-form-control wpcf7-submit" />
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
@stop
