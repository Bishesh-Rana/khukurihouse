@extends('front.layouts.app')

@section('title')

    @if ($setting->site_name)
        Track Your Order | {{ $setting->site_name }}
    @endif

@stop

@section('body')

    <body class="page home page-template-default woocommerce-order-received">
    @stop

    @section('content')

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tracking Page</li>
                        </ol>
                    </div>
                </div>
            </div>
        </nav>

        <section class="category-page mt mb">
            <div class="container">
                <div class="category-top">
                    <div class="category-title">
                        <h3>Track Your Order</h3>
                    </div>
                </div>
                @include('front.layouts.error')

                <form class="row" method="post" action="{{ route('track.order.post') }}">
                    @csrf

                    <div class="form-group col-6">
                        <label for="">Order Email</label>
                        <input type="email" class="form-control" placeholder="Email you used during checkout."
                            id="orderemail" name="order_email" value="{{ old('order_email') }}">
                        @error('order_email')
                            <small id="helpId" class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label for="">Order Id</label>
                        <input type="text" name="order_id" id="orderId" class="form-control"
                            placeholder="Found in your order confirmation email." aria-describedby="helpId">
                        @error('order_id')
                            <small id="helpId" class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary main-btn">Track</button>
                    </div>
                </form>
            </div>
        </section>

    @stop
