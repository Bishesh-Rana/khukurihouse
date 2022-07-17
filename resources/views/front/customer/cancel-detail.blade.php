@extends('front.layouts.app')

@section('title')
Cancelled Orders | Dashboard |
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
                                        <h1 class="entry-title">Order ID : {{$ref_id}}</h1>
                                    </div>
                                </header>
                                <!-- .entry-header -->
                                <div class="entry-content">
                                    @if(count($cancelled_products) > 0)
                                    <form class="woocommerce" method="post" action="#">
                                        <div class="table-responsive">
                                        <table class="shop_table cart wishlist_table table table-bordered" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class="product-thumbnail">Product Images</th>
                                                    <th class="product-name">
                                                        <span class="nobr">Product Name</span>
                                                    </th>
                                                    <th class="product-price">
                                                        <span class="nobr">
                                                            Unit Price
                                                        </span>
                                                    </th>
                                                    <th class="product-stock-status">
                                                        <span class="nobr">
                                                            Date
                                                        </span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($cancelled_products as $product)
                                                <tr>
                                                    <td class="product-thumbnail">
                                                        <a href="{{route('product.details',$product->product_slug)}}">
                                                            <img width="180" height="180" alt="" class="wp-post-image" src="{{asset('')}}uploads/products/{{$product->image}}">
                                                        </a>
                                                    </td>
                                                    <td class="product-name">
                                                        <a href="{{route('product.details',$product->product_slug)}}">{{$product->product_name}}</a>
                                                    </td>
                                                    <td class="product-price">
                                                        <ins>
                                                            <span class="woocommerce-Price-amount amount">
                                                                <span class="woocommerce-Price-currencySymbol">Rs. </span>{{number_format($product->product_original_price)}}</span>
                                                        </ins>
                                                        @if($product->product_compare_price > $product->product_original_price)
                                                        <del>
                                                            <span class="woocommerce-Price-amount amount">
                                                                <span class="woocommerce-Price-currencySymbol">Rs. </span>{{number_format($product->product_compare_price)}}</span>
                                                        </del>
                                                        @endif
                                                    </td>
                                                    <td class="product-stock-status">
                                                        <span>{{ date('M d, Y',strtotime($product->created_at)) }}</span>
                                                    </td>

                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                        <!-- .wishlist_table -->
                                    </form>
                                    <!-- .woocommerce -->
                                    @else
                                    YOU HAVEN'T CANCELLED ANY PRODUCTS YET. <a href="{{route('customer.dashboard.orders')}}">BROWSE ORDERS</a>
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
