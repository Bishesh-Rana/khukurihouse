@extends('front.layouts.app')

@section('title')
Orders | Dashboard |
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
                                    @if(count($ordered_products) > 0)
                                    <form class="woocommerce" method="post" action="{{route('customer.order.update')}}">
                                        @csrf
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
                                                                Qty
                                                            </span>
                                                        </th>
                                                        {{-- <th class="product-add-to-cart"></th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($ordered_products as $key => $product)
                                                    <tr>
                                                        <input type="hidden" name="ref_id" value="{{$ref_id}}">
                                                        <input type="hidden" name="id[]" value="{{$product->id}}">
                                                        <input type="hidden" id="product-slug{{$key++}}" value="{{$product->product_slug}}"> <!-- for delivery charge -->
                                                        <td class="product-thumbnail">
                                                            <a href="{{route('product.details',$product->product_slug)}}">
                                                                <img width="180" height="180" alt="" class="wp-post-image" src="{{getFrontImage(@$product->image,'products')}}">
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
                                                        <td class="product-quantity" data-title="Quantity">
                                                                <div class="quantity">
                                                                    {{$product->quantity}}
                                                                    {{-- <label for="quantity-input-1">Quantity</label> --}}
                                                                    {{-- <input id="quantity-input-1" type="number" name="qty[]" value="{{$product->quantity}}" title="Qty" class="input-text qty text" size="4" min="1" max="{{$product->quantity}}"> --}}
                                                                </div>
                                                            </td>
                                                        <!-- <td class="product-add-to-cart">
                                                            <a class="button add_to_cart_button button alt" href="{{route('customer.order.cancel',$product->ref_id)}}"> Update</a>
                                                        </td> -->
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="action">
                                                {{-- <input type="submit" name="update_cart" value="Update Order" class="button btn btn-primary m-btn"> --}}
                                            </div>
                                        </div>
                                        <!-- .wishlist_table -->
                                    </form>
                                    <!-- .woocommerce -->
                                    @else
                                    YOU HAVEN'T ORDERED ANY PRODUCTS. <a href="{{route('home.index')}}">BROWSE</a>
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
