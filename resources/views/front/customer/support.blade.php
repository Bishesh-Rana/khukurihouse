@extends('front.layouts.app')

@section('title')
    Support | Dashboard |
    @if ($setting->site_name)
        {{ $setting->site_name }}
    @endif
@stop

@section('content')
    @include('front.layouts.error')
    <div id="content" class="site-content">
        <div class="c-dashboard pt pb">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-3">
                        @include('front.customer.section.sidebar')
                    </div>
                    <div class="col-sm-9">
                        <div id="primary" class="content-area">
                            <header class="entry-header">
                                <div class="page-header-caption">
                                    <h1 class="entry-title">Help and Support</h1>
                                </div>
                            </header>
                            <div class="text-block">
                                <ul>
                                    <li>
                                        @if (isset($setting->address))
                                            {{ $setting->address }}
                                        @endif
                                    </li>
                                    <li>
                                        <span>Got Questions ? Call us 24/7!</span> 
                                    </li>
                                    <li>
                                        <b>Phone:</b>
                                        <a href="tel:{{ $setting->phone }}">{{ $setting->phone }}</a>
                                    </li>
                                    <li>
                                        <b>Viber Us:</b>
                                        <a href="tel:{{ $setting->viber }}">{{ $setting->viber }}</a>
                                    </li>
                                    <li>
                                        <b>Whatsapp Us:</b>
                                        <a href="tel:{{ $setting->whatsapp }}">{{ $setting->whatsapp }}</a>
                                    </li>
                                    <li>
                                        <b>Email us:</b>
                                        <a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
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
