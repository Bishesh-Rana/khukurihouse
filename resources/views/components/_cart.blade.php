@props(['productId'])

<span>
    <a rel="nofollow" class="ajax-add-to-cart" data-product_id={{ $productId }}>
        <i class="fas fa-cart-plus"></i>
    </a>
</span>
@once
    @push('scripts')
        @include('front.include.cartScript')
    @endpush
@endonce
