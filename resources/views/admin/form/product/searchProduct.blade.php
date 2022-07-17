
    @forelse ($products as $product)
        <option class="productViews" data-id="{{ $product->id }}" value="{{ $product->product_name }}">
    @empty
        <option value="" disabled>No product Found</option>
    @endforelse


