

<table class="table">
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Remaining Stock</th>
            <th>Price</th>
            <th>Image</th>
        </tr>
    </thead>
    <tbody>
        @if (!empty($product))
            <tr>
                <td>{{ $product->product_name }}</td>
                <td>{{ optional($product->stock)->remaining_stock }}</td>
                <td>{{ $product->product_original_price }}</td>
                <td><img src="{{ asset('uploads/products/'.$product->image) }}" height="100px"></td>
            </tr>
        @else
            <tr>
                <td colspan="3">Invalid Product</td>
            </tr>
        @endif
        <tr>
            <td scope="row"></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>
