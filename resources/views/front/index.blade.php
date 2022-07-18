@extends('front.layouts.app')


@section('title')

    @if ($setting->site_name)
        {{ $setting->site_name }}
    @endif

@stop


    @section('content')
<!-- Slider -->
<section class="slider">
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
            @foreach ($sliders as $index=>$slider)
            <div class="carousel-item {{$loop->first ? 'active' : ''}}">
                <a href="link">
                <img src="{{ asset('') }}uploads/sliders/{{ $slider->image }}" alt="{{ $slider->title }}">
                </a>
            </div>

            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>
<!-- Slider End -->

<!-- Information -->
<section class="information mt mb">
    <div class="container">
        <div class="row margin">
            <div class="col-lg-3 col-md-6 col-sm-6 padding">
                <div class="inform-wrap">
                    <div class="inform-icon">
                        <i class="las la-shipping-fast"></i>
                    </div>
                    <div class="inform-content">
                        <span>Free Shipping</span>
                        <p>Our products fly to any part of the globe from Kathmandu.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 padding">
                <div class="inform-wrap">
                    <div class="inform-icon">
                        <i class="lab la-envira"></i>
                    </div>
                    <div class="inform-content">
                        <span>Handmade Eco-Friendly</span>
                        <p>Our products fly to any part of the globe from Kathmandu.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 padding">
                <div class="inform-wrap">
                    <div class="inform-icon">
                        <i class="las la-balance-scale"></i>
                    </div>
                    <div class="inform-content">
                        <span>Fair Trading</span>
                        <p>Our products fly to any part of the globe from Kathmandu.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 padding">
                <div class="inform-wrap">
                    <div class="inform-icon">
                        <i class="las la-users"></i>
                    </div>
                    <div class="inform-content">
                        <span>User Participation</span>
                        <p>Our products fly to any part of the globe from Kathmandu.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Information End -->

<!-- Popular Product -->
<section id="popular" class="popular-product mb">
    <div class="container">
        <div class="main-title">
            <h3>Latest Product</h3>
        </div>
        <div class="owl-carousel owl-theme product">
            @foreach ($newProducts as $product)
            <div class="item">
                <div class="product-wrap">
                    <div class="product-img">
                        @php
                            $product_name = $product->product_name;
                            $product_name = str_replace('"','',$product_name);
                        @endphp
                        <a href="{{ route('product.details', $product->product_slug) }}"><img src="{{getFrontImage($product->image,'products')}}" alt="{{$product->product_name}}" /></a>
                        <div class="group-btn">
                            <x-_wishlist wishlist="{{$product->userWish}}"  :productId="$product->id"  > </x-_wishlist>
                            <x-_cart :productId="$product->id"  > </x-_cart>
                        </div>
                    </div>
                    <div class="product-content">
                        <h4><a href="{{ route('product.details', $product->product_slug) }}">{{$product_name}}</a></h4>
                        @if ($product->product_compare_price > $product->product_original_price)
                            <span><small><del>{{$product->currency}}&nbsp;{{ number_format($product->product_compare_price) }}</del></small> {{$product->currency}}&nbsp;{{ number_format($product->product_original_price) }}</span>
                        @else
                            <span>{{$product->currency}}&nbsp;{{ number_format($product->product_original_price) }}</span>
                        @endif
                        <a href="{{ route('product.details', $product->product_slug) }}" class="btn">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Popular Product End -->

<!-- Ads Section -->
<section class="ads-section mb">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="ads-wrap">
                    <a href="{{@$midLeftAd->link}}"><img src="{{getFrontImage(@$midLeftAd->image,'notices')}}" alt="Left Advertisement"></a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="ads-wrap">   
                    <a href="{{@$midRightAd->link}}"><img src="{{ getFrontImage(@$midRightAd->image,'notices') }}" alt="Right Advertisement"></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Ads Section End -->

<!-- Product Listing -->
<section class="product-listing mb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="pl-main">
                    <div class="main-title">
                        <h3>On Sales Products</h3>
                    </div>
                    <div class="row mg-10">
                        @foreach ($onSaleProducts as $product)
                        <div class="item col-md-3 col-sm-6">
                            <div class="product-wrap">
                                <div class="product-img">
                                    @php
                                        $product_name = $product->product_name;
                                        $product_name = str_replace('"','',$product_name);
                                    @endphp
                                    <a href="{{ route('product.details', $product->product_slug) }}"><img src="{{ getFrontImage($product->image,'products') }}" /></a>
                                    <div class="group-btn">
                                        <x-_wishlist wishlist="{{$product->userWish}}"  :productId="$product->id"  > </x-_wishlist>
                                        <x-_cart :productId="$product->id"  > </x-_cart>
                                    </div>
                                </div>
                                <div class="product-content">
                                    @php
                                        $product_name = $product->product_name;
                                        $product_name = str_replace('"','',$product_name);
                                    @endphp
                                    <h4><a href="{{ route('product.details', $product->product_slug) }}">{{$product_name}}</a></h4>
                                    @if ($product->product_compare_price > $product->product_original_price)
                                        <span><small><del>{{$product->currency}}&nbsp;{{ number_format($product->product_compare_price) }}</del></small> {{$product->currency}}{{ number_format($product->product_original_price) }}</span>
                                    @else
                                        <span>{{$product->currency}}&nbsp;{{ number_format($product->product_original_price) }}</span>
                                    @endif
                                    <a href="{{ route('product.details', $product->product_slug) }}" class="btn">View Details</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Listing end -->

<!-- Product Categories -->
<section class="product-categories mb">
    <div class="container">
        <div class="main-title">
            <h3>Shop All Categories</h3>
        </div>
        <div class="row mg-10">
            @foreach ($featuredCategories as $category)
            <div class="col-lg-2 col-md-4 col-sm-6 pd-10">
                <div class="pc-wrap">
                    <div class="pc-img">
                        <a href="{{ route('product.category', ['category_slug' => $category->category_slug]) }}"><img src="{{ getFrontImage($category->image,'categories') }}"></a>
                        <h4>
                            <a href="{{ route('product.category', ['category_slug' => $category->category_slug]) }}">{{$category->category_name}}</a>
                        </h4>
                    </div>
                    {{-- <div class="pc-content">
                        <span>Starting From</span>
                        <p>$100.45</p>
                    </div> --}}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Product Categories End -->

<!-- Ads Section -->
<section class="ads-section1 mb">
    <div class="container">
        <div class="row m-0">
            @foreach ($dealAds as $dealAd)
            <div class="col-md-4 p-0">
                <div class="ads-wrap">
                    <a href="{{$dealAd->link}}"><img src="{{ getFrontImage($dealAd->image,'notices') }}" alt="Deals Advertisement"></a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Ads Section End -->

<!-- All Product -->
<section class="all-product mb">
    <div class="container">
        <div class="main-title">
            <h3>Best Rated Products</h3>
        </div>
        <div class="row mg-10">
            @foreach ($bestRatedProducts as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 pd-10">
                <div class="product-wrap">
                    <div class="product-img">
                        <a href="{{ route('product.details', $product->product_slug) }}"><img src="{{ getFrontImage($product->image,'products') }}" /></a>
                        <div class="group-btn">
                            <x-_wishlist wishlist="{{$product->userWish}}"  :productId="$product->id"  > </x-_wishlist>
                            <x-_cart :productId="$product->id"  > </x-_cart>
                        </div>
                    </div>
                    <div class="product-content">
                        @php
                            $product_name = $product->product_name;
                            $product_name = str_replace('"','',$product_name);
                        
                        @endphp
                        <h4><a href="{{ route('product.details', $product->product_slug) }}">{{$product_name}}</a></h4>
                        @if ($product->product_compare_price > $product->product_original_price)
                            <span><small><del>{{$product->currency}}&nbsp;{{ number_format($product->product_original_price) }}</del></small> {{$product->currency}}&nbsp;{{ number_format($product->product_compare_price) }}</span>
                        @else
                            <span>{{$product->currency}}&nbsp;{{ number_format($product->product_original_price) }}</span>
                        @endif
                        <a href="{{ route('product.details', $product->product_slug) }}" class="btn">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- All Product End -->

    @stop

    @section('footer')

    @stop
