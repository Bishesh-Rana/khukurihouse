@props(['productId', 'wishlist' => null])

<span>
    <a href="{{ route('product.addToWishlist', $productId) }}" rel="nofollow" class="add_to_wishlist">
        <i class="fas fa-heart {{ $wishlist ? 'text-danger' : null }}"></i>
    </a>
</span>
