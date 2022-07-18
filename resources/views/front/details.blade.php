@extends('front.layouts.app')


@section('title')

    @if ($setting->site_name)
        {{ $setting->site_name }}
    @endif

@stop


@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('product.category', @$product->category->category_slug) }}">{{ @$product->category->category_name }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ @$product->product_name }}</li>
                </ol>
                </div>
            </div>
        </div>
    </nav>
    <!-- Breadcrumb End -->
    <!-- Details Page -->
    <section class="details-page mt mb">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="details-slide">
                        <ul id="slide" class="gallery list-unstyled cS-hidden">
                            <li data-thumb="{{ getFrontImage($product->image,'products') }}">
                                <img src="{{ getFrontImage($product->image,'products') }}" alt="images" />
                            </li>
                            @foreach ($product->photos as $item)

                                <li data-thumb="{{ getFrontImage($item->image,'products') }}">
                                    <img src="{{ getFrontImage($item->image,'products') }}" alt="images" />
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="details-content">
                        <h3>{{ @$product->product_name }}</h3>
                        <span><i class="las la-truck"></i> Shipping is Free for this item</span>
                       
                        <b>{{$product->currency}}{{ @$product->product_original_price }}</b>
                        <span class="stock">In Stock</span>

                        <div class="choose-color">
                            <div class="total-qty">
                                <div class="qty-list">
                                    <span>Total Quantity</span>
                                    <b>
                                        <input type="number" name="total_quantity" class="form-control total_quantity"
                                            id="total_quantity" onchange="calculateTotalPrice()" value="1" min="1">
                                        <input type="hidden" value="{{$product->currency}}" id="currency">
                                    </b>
                                </div>
                                <div class="qty-list">
                                    <span>Total Price</span>
                                    <b id="total_price">{{$product->currency}}{{ @$product->product_original_price }}</b>
                                </div>
                                <div class="qty-list">
                                    <span>Model</span>
                                    <b id="total_price">{{ @$product->product_model }}</b>
                                </div>
                                <div class="qty-list">
                                    <span>Cargo</span>
                                    <b id="total_price">${{ @$product->cargo }}</b>
                                </div>
                            </div>
                            <div class="details-group-btn">
                                <a href="#" title=""
                                class="btn btn-primary product-add-to-cart cartAdd {{ $product->stock->remaining_stock == 0 ? 'disabled' : '' }}"
                                data-product_id="{{ $product->id }}">Add To Cart</a>
                                <a href="{{ route('product.addToWishlist', $product->id) }}" class="btn btn-primary product-add-to-cart ">Add To Wishlist</a>
                            </div>
                            <div class="details-content-list">
                                <div class="footer-middle-center">
                            <!-- ShareThis BEGIN --><div class="sharethis-inline-share-buttons"></div><!-- ShareThis END -->

                                    {{-- <ul>
                                        <li class="facebook">
                                            <a href="{{ $setting->facebook }}"><i class="lab la-facebook-f"></i></a>
                                        </li>
                                        <li class="twitter">
                                            <a href="{{ $setting->twitter }}"><i class="lab la-twitter"></i></a>
                                        </li>
                                        <li class="instagram">
                                            <a href="{{ $setting->instagram }}"><i class="lab la-instagram"></i></a>
                                        </li>
                                        <li class="linkedin">
                                            <a href="{{ $setting->linkedin }}"><i class="lab la-linkedin"></i></a>
                                        </li>
                                    </ul> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Details Page End -->

    <!-- Details Content -->
    <section class="dp-details mb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                        <div class="dp-main">
                        <div class="dp-details-wrap">
                            <div id="accordion" class="myaccordion">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne"
                                            aria-expanded="false" aria-controls="collapseOne">
                                            <i class="las la-edit"></i> Product Details
                                            <span class="fa-stack fa-sm">
                                                <i class="las la-plus"></i>
                                            </span>
                                        </button>
                                    </div>
                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                        data-parent="#accordion">
                                        <div class="card-body">
                                            {!! @$product->product_description !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo">
                                            <i class="las la-shipping-fast"></i> Specifications
                                            <span class="fa-stack fa-sm">
                                                <i class="las la-plus"></i>
                                            </span>
                                        </button>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                        data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table width="100%" class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <th width="50%">Blade</th>
                                                            <td width="50%">{{@$product->blade}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th width="50%">Handle</th>
                                                            <td width="50%">{{@$product->handle}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th width="50%">Blade Weight</th>
                                                            <td width="50%">{{@$product->blade_weight}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th width="50%">Total Weight</th>
                                                            <td width="50%">{{@$product->total_weight}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th width="50%">Material</th>
                                                            <td width="50%">{{@$product->material}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingFour">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour"
                                            aria-expanded="false" aria-controls="collapseFour">
                                            <i class="las la-star"></i> Reviews
                                            <span class="fa-stack fa-sm">
                                                <i class="las la-plus"></i>
                                            </span>
                                        </button>
                                    </div>
                                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                                        data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="reviews-btn">
                                                <div class="review-count">
                                                    @php
                                                        $avgrating = ((int)ceil($product->reviews->avg('rating') == 0 ) ? 5 : (int)ceil($product->reviews->avg('rating')));
                                                    @endphp
                                                    <div class="review-list">
                                                        @for ($i = 0; $i < $avgrating; $i++)
                                                        <i class="las la-star"></i>

                                                        @endfor
                                                    </div>
                                                    <span>{{$product->reviews->count()}} Reviews</span>
                                                </div>
                                                {{-- <button type="submmit" class="btn btn-primary"><i class="las la-edit"></i> Write
                                                    a Review</button> --}}
                                            </div>
                                            @foreach ($product->reviews as $rating)
                                            <div class="reviews">
                                                <div class="review-head">
                                                    <div class="review-left">
                                                        <div class="review-img">
                                                            <img src="{{asset('')}}uploads/customers/{{$rating->customer->image}}" alt="images" />
                                                        </div>
                                                        <div class="review-info">
                                                            <h3>{{$rating->customer->name}}</h3>
                                                            <div class="review-list">
                                                                @for ($i = 0; $i < $rating->rating; $i++)
                                                                <i class="las la-star"></i>
                                                                @endfor
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="review-date">
                                                        <span>{{$rating->customer->name}}</span>
                                                    </div>
                                                </div>
                                                <span>{{ @$rating->review}}</span>
                                                <p>
                                                {{@$rating->reply}}
                                                </p>
                                                <a href="#" title=""><i class="fas fa-share-square"></i> Share</a>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Details Content End -->
    <!-- Related Product -->
    <section class="related-product mb">
        <div class="container">
            <div class="main-title">
                <h3>Related Product</h3>
            </div>
            <div class="row">
                @foreach ($product->category->getChildProducts(4) as $product)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product-wrap">
                        <div class="product-img">
                            <a href="{{ route('product.details', $product->product_slug) }}"><img src="{{getFrontImage($product->image,'products')}}" alt="images"></a>
                            <div class="group-btn">
                                <x-_wishlist wishlist="{{$product->userWish}}"  :productId="$product->id"  > </x-_wishlist>
                                <x-_cart :productId="$product->id"  > </x-_cart>
                            </div>
                        </div>
                        <div class="product-content">
                            <h4><a href="{{ route('product.details', $product->product_slug) }}">{{@$product->product_name}}</a></h4>
                            <span>{{$product->currency}}{{ number_format($product->product_original_price) }}</span>
                            <a href="{{ route('product.details', $product->product_slug) }}" class="btn">View Details</a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- Related Product End -->

@stop
@push('scripts')
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=6052dad06f7ab900129ce9ee&product=sop' async='async'></script>

    <script>
        function calculateTotalPrice() {
            var total_quantity = $("#total_quantity").val();
            var currency = $("#currency").val();

            let total_price = 0;
            let product_price = {{ $product->product_original_price }};
            total_price = product_price * total_quantity
            
            

            $('#total_price').text( currency + total_price);


        }
    </script>
    <script>
        $(document).ready(function() {

            $(".cartAdd").on('click', function(e) {
                e.preventDefault();
                let data = {
                    productId: $(this).data('product_id'),
                    qty: $('#total_quantity').val(),
                    cur: $('#currency').val(),
                }

                const urlParams = new URLSearchParams(window.location.search);
                const myParams = urlParams.get('aff_id');
                affId = myParams ?? '0';

                axios.post("{{ route('product.ajax.addToCart') }}" + "?aff_id=" + affId, data).then(
                res => {
                    $(".cart-products-list").html("");
                    $(".cart-products-list").html(res.data);
                    Lobibox.notify('success', {
                        size: 'mini',
                        soundPath: '{{ asset('') }}admincast/assets/lobibox/sounds/',
                        sound: 'sound4',
                        icon: 'fa fa-check',
                        iconSource: "fontAwesome",
                        showClass: 'fadeInDown',
                        hideClass: 'fadeUpDown',
                        width: 400,
                        rounded: true,
                        msg: 'Product Added To Cart',
                        delay: 3000,
                        delayIndicator: false,
                        onClickUrl: "{{ route('product.cart') }}"
                    });
                });
            })
            // For success layout fade out
            $('#success').delay(5000).fadeOut('slow');
        });
    </script>
@endpush
@section('footer')

@stop
