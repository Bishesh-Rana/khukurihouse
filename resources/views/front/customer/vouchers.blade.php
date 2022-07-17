@extends('front.layouts.app')

@section('title')
Vouchers | Dashboard |
@if($setting->site_name)
{{$setting->site_name}}
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
                        <main id="main" class="site-main">
                            <div class="type-page hentry">
                                <header class="entry-header">
                                    <div class="page-header-caption">
                                        <h1 class="entry-title">Vouchers</h1>
                                    </div>
                                </header>
                                <!-- .entry-header -->
                                <div class="entry-content">
                                    @if(count($coupons) > 0)
                                    <form class="woocommerce" method="post" action="#">
                                        <table class="shop_table cart wishlist_table">
                                            <thead>
                                                <tr>
                                                    <th class="product-name">
                                                        <span class="nobr">Coupon Name</span>
                                                    </th>
                                                    <th class="product-price">
                                                        <span class="nobr">
                                                            Coupon Code
                                                        </span>
                                                    </th>
                                                    <th class="product-stock-status">
                                                        <span class="nobr">
                                                            Valid Till
                                                        </span>
                                                    </th>
                                                    <th class="product-add-to-cart"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($coupons as $coupon)
                                                <tr>
                                                    <td class="product-name">
                                                        {{$coupon->coupon_name}}
                                                    </td>
                                                    <td class="product-price">
                                                        {{$coupon->coupon_code}}
                                                    </td>
                                                    <td class="product-stock-status">
                                                        {{date('M d, Y',strtotime($coupon->end_date))}}
                                                    </td>
                                                    <td class="product-add-to-cart">
                                                        <a class="button add_to_cart_button button alt" href="{{route('product.checkout')}}">Use</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <!-- .wishlist_table -->
                                    </form>
                                    <!-- .woocommerce -->
                                    @else
                                    NO VOUCHERS CURRENTLY ACTIVE. <a href="{{route('home.index')}}">BROWSE</a>
                                    @endif
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
<script src="{{asset('')}}assets/js/jquery-1.11.1.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.button-left').click(function() {
            $('.sidebar').toggleClass('fliph');
        });
    });
</script>
@stop
