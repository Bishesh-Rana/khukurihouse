<li class="animate-dropdown dropdown ">
    <a class="cart-contents" href="#" data-toggle="dropdown" title="View your shopping cart">
        <i class="fas fa-cart-arrow-down"></i>
        {{-- <span class="amount">Cart</span> --}}
        <span class="count totalQty">
            @if (Session::has('cart')){{ Session::get('cart')->totalQty }} @else 0 @endif
        </span>

    </a>
    <ul class="dropdown-menu dropdown-menu-mini-cart">
        @if (Session::has('cart'))
        
            <li>
                <div class="widget woocommerce widget_shopping_cart">
                    <div class="widget_shopping_cart_content">
                        <ul class="woocommerce-mini-cart cart_list product_list_widget ">
                           
                            @foreach ($cart_products as $product)
                                <li class="woocommerce-mini-cart-item mini_cart_item">
                                    <div class="c-list-wrap">
                                        <div class="c-list-img">
                                            <a
                                                href="{{ route('product.details', ['product_slug' => $product['item']['product_slug']]) }}">
                                                <img src="{{ getFrontImage($product['item']['image'],'products') }}"
                                                    class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image"
                                                    alt="@if (isset($product->alt)) {{ $product->alt }} @endif">
                                            </a>
                                            <a href="{{ route('product.remove', ['id' => $product['item']['id']]) }}"
                                                class="remove ajax-remove-from-cart" aria-label="Remove this item"
                                                data-product_id="{{ $product['item']['id'] }}"><i class="fas fa-times"></i></a>
                                        </div>
                                        <div class="c-list-info">
                                            <span class="p-list">{{ $product['item']['product_name'] }}&nbsp;</span>
                                            <span class="quantity">{{ $product['qty'] }} ×
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">{{$product['item']['currency']}}
                                                    </span>{{ number_format($product['item']['product_original_price']) }}</span>
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <!-- .cart_list -->
                        <p class="woocommerce-mini-cart__total total">
                            <strong>Subtotal:</strong>
                            <span class="woocommerce-Price-amount amount">
                                <span class="woocommerce-Price-currencySymbol">{{$product['item']['currency']}}
                                </span>{{ number_format(Session::get('cart')->totalPrice) }}</span>
                        </p>
                        <p class="woocommerce-mini-cart__buttons buttons">
                            <a href="{{ route('product.cart') }}" class="button wc-forward">View cart</a>
                            <a href="{{ route('product.checkout') }}" class="button checkout wc-forward">Checkout</a>
                        </p>
                    </div>
                    <!-- .widget_shopping_cart_content -->
                </div>
                <!-- .widget_shopping_cart -->
            </li>
        @else
            <li>
                <div class="widget woocommerce widget_shopping_cart">
                    <div class="widget_shopping_cart_content">
                        <ul class="woocommerce-mini-cart cart_list product_list_widget ">
                            <li>No Products in Cart</li>
                        </ul>
                    </div>
                </div>
            </li>
        @endif

    </ul>

    <!-- .dropdown-menu-mini-cart -->
</li>
