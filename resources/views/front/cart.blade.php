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
                    <li class="breadcrumb-item"><a href="{{route('home.index')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shopping cart</li>
                </ol>
                </div>
            </div>
        </div>
    </nav>
    <!-- Breadcrumb End -->
    <!-- Cart Page -->
    <section class="cart-page mt mb">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="cart-main">
                        <div class="category-title">
                            <h3>Shopping Cart</h3>
                        </div>
                        <div class="cart-table">
                            <div class="table-responsive">
                                <form id="cart-form">
                                <table width="100%" class="table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Product Images</th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $subTotal = 0; $i = 0; ?>
                                        @foreach($cart_products as $key => $product)
                                        {{-- @dd($product) --}}
                                        @php
                                        $stock = DB::table('tbl_stocks')->where('product_id', $product['item']['id'])->first();
                                        // dd($stock);
                                        $totstock = $stock->total_stock;
                                    @endphp
                                        <tr>
                                            <input type="hidden" name="id[]" value="{{$product['item']['id']}}">
                                            <input type="hidden" name="aff_id[]" value="{{$product['affId']}}">
                                            <input type="hidden" id="product-slug{{$i++}}" value="{{$product['item']['product_slug']}}">
                                            <td>
                                                <a href="{{route('product.details',['product_slug' => $product['item']['product_slug']])}}"><img src="{{ getFrontImage( $product['item']['image'],'products') }}" alt="images"></a>
                                            </td>
                                            <td>
                                                <a href="{{route('product.details',['product_slug' => $product['item']['product_slug']])}}">{{$product['item']['product_name']}}</a>
                                            </td>
                                            <td>
                                                <a href="{{route('product.details',['product_slug' => $product['item']['product_slug']])}}">{{$product['item']['product_original_price']}}</a>
                                            </td>
                                            <td>
                                                <div class="qty">
                                                    <input id="quantity-input-1" type="number" name="qty[]" value="{{$product['qty']}}" title="Qty" class="input-text qty text" size="4" min="1" max="{{$totstock}}">
                                                </div>
                                            </td>
                                            <td>
                                                <?php $subTotal += $product['price']; ?>
                                                <a href="{{route('product.details',['product_slug' => $product['item']['product_slug']])}}">{{$product['price']}}</a>
                                            </td>
                                            <td>
                                                <a class="remove ajax-remove-from-cart" title="Remove this item" data-product_id="{{$product['item']['id']}}"><i class="fas fa-times"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="8">
                                                <input type="submit" value="Update cart" name="update_cart" class="button btn btn-primary m-btn">
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </form>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="cart-sidebar">
                        <div class="category-title">
                            <h3>Product Details</h3>
                        </div>
                        <div class="cd-table">
                            <div class="table-responsive">
                                <table width="100%">
                                    <thead>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{count($cart_products)}} item</td>
                                            <td>Rs.{{$subTotal}}</td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Total</td>
                                            <td>Rs.{{$subTotal}}</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="cart-btns">
                            <a href="{{route('home.index')}}" title="" class="btns">Continue Shopping</a>
                            <a href="{{route('product.checkout')}}" title="" class="btns">Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Cart Page End -->

@stop
@push('scripts')
<script>
    $(document).ready(function(){

        $(document).off('click', '.ajax-remove-from-cart ').on('click', '.ajax-remove-from-cart ',function(e){
            e.preventDefault();
            let data = {
                productId : $(this).data('product_id'),
            }

            axios.post("{{route('product.ajax.removeFromCart')}}",data).then(res => {
                $(".cart-products-list").html("");
                $(".cart-products-list").html(res.data);
                $(".mobile-cart-icon").load(" .mobile-cart-icon"); //For mobiles

                Lobibox.notify('success', {
                    size: 'mini',
                    soundPath: '{{asset('')}}admincast/assets/lobibox/sounds/',
                    sound: 'sound3',
                    icon: 'fa fa-close',
                    iconSource: "fontAwesome",
                    showClass: 'fadeInDown',
                    hideClass: 'fadeUpDown',
                    width: 400,
                    rounded: true,
                    msg: 'Product Removed From Cart',
                    delay: 3000,
                    delayIndicator: false,
                    onClickUrl: "{{route('product.cart')}}"
                });
                setTimeout(location.reload.bind(location), 2000);

            });
        })

        $("#cart-form").submit(function(e){
            e.preventDefault();

            var ids = $("input[name='id[]']")
              .map(function(){return $(this).val();}).get();

            var qty = $("input[name='qty[]']")
            .map(function(){return $(this).val();}).get();

            var affId = $("input[name='aff_id[]']")
            .map(function(){return $(this).val();}).get();

            let request = {}

            request['id'] = ids;
            request['qty'] = qty;
            request['aff_id'] = affId;

            axios.post("{{route('product.ajax.updateCart')}}", request).then(res => {
                $(".cart-products-list").html("");
                $(".cart-products-list").html(res.data);
                $(".mobile-cart-icon").load(" .mobile-cart-icon"); //For mobiles

                Lobibox.notify('success', {
                    size: 'mini',
                    soundPath: '{{asset('')}}admincast/assets/lobibox/sounds/',
                    sound: 'sound2',
                    icon: 'fa fa-check',
                    iconSource: "fontAwesome",
                    showClass: 'fadeInDown',
                    hideClass: 'fadeUpDown',
                    width: 400,
                    rounded: true,
                    msg: 'Cart Updated',
                    delay: 3000,
                    delayIndicator: false,
                    onClickUrl: "{{route('product.cart')}}"
                });
                setTimeout(location.reload.bind(location), 2000);

            });
        })


    });
</script>
@endpush
@section('footer')

@stop
