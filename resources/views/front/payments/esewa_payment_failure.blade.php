@extends('front.layouts.app')

@section('title')
    Checkout |
    @if ($setting->site_name)
        {{ $setting->site_name }}
    @endif
@stop

@section('content')
    <nav aria-label="breadcrumb" class="breadcrumbs">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Checkout</a></li>
                <li class="breadcrumb-item active" aria-current="page">Order received</li>
            </ol>
        </div>
    </nav>

    <section class="details-page mt mb">
        <div class="container-fluid">


            <div class="entry-content">
                <p class="">Sorry! Payment Failure.</p>

            </div>


        </div>
        <!-- .row -->
        </div>
    </section>

    <!-- #content -->

@stop

@section('footer')



@stop
