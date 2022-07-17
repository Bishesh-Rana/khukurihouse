@extends('front.layouts.app')


@section('title')

    @if ($setting->site_name)
        {{ $setting->site_name }}
    @endif

@stop


@section('content')
@include('front.layouts.error')
    <!-- Register Page -->
    <section class="register-page mt mb">
        <div class="container">
            <div class="category-title">
                <h3>Create an Account</h3>
            </div>
            <div class="personal-form">
                <p class="details">Already have an account? <a href="{{ route('customer.login') }}" title="">Log
                        in
                        instead!</a></p>
                <form class="register" method="post" action="{{ route('customer.register.post') }}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-2">Social Title</label>
                        <div class="personal-check col-md-8">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="title" id="inlineRadio1" value="mr"
                                    onclick="showCustomTitle()" checked="checked">
                                <label class="form-check-label" for="inlineRadio1">Mr.</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="title" id="inlineRadio2" value="mrs"
                                    onclick="showCustomTitle()">
                                <label class="form-check-label" for="inlineRadio2">Mrs.</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="title" id="other_title" value="other"
                                    onclick="showCustomTitle()">
                                <label class="form-check-label" for="other_title">Other</label>
                            </div>
                            <input type="text" name="other_title" class="form-control" id="title_custom"
                                style="display: none">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">Full Name</label>
                        <div class="col-md-8">
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">Phone</label>
                        <div class="col-md-8">
                            <input type="text" name="phone" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">Address</label>
                        <div class="col-md-8">
                            <input type="text" name="address" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2">Email</label>
                        <div class="col-md-8">
                            <input type="email" name="email" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">Password</label>
                        <div class="col-md-8">
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">Confirm Password</label>
                        <div class="col-md-8">
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-2"></label>
                        <div class="col-md-8">
                            <div class="form-check next-check">
                                <input class="form-check-input" type="checkbox" id="acceptTerms">
                                <label class="form-check-label" for="acceptTerms">
                                    I agree to the terms and conditions and the privacy policy
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-2"></label>
                        <div class="col-md-8" id="submitButton" style="display: none;">
                            <button type="submit" class="btn btn-primary main-btn">Sign Up</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Register Page End -->

@stop
@push('scripts')
    <script>
        function showCustomTitle() {
            if (document.getElementById('other_title').checked) {
                document.getElementById('title_custom').style.display = 'block';
            } else document.getElementById('title_custom').style.display = 'none';

        }
    </script>
    <script>
        $('#acceptTerms').click(function() {
            $("#submitButton").toggle(this.checked);
        });
    </script>
@endpush

@section('footer')

@stop
