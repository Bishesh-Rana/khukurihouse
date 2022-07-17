<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Owner Code</th>
                <th>Price</th>
                <th>Product Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $key => $product)
            <tr>
                <td>
                    {{++$key}}
                </td>
                <td>
                    {{ucwords($product->product_name)}}
                </td>

                <td>
                    @if(isset($product->seller_code))
                    {{ $product->seller_code }}
                    @else
                    {{
                    'admin'
                }}
                    @endif
                </td>
                <td>
                    Rs. {{number_format($product->product_original_price)}}/-
                </td>
                <td>
                    <img src="{{asset('')}}uploads/products/{{$product->image}}" alt="{{$product->name}}" height="50" width="50">
                </td>
                
            </tr>
            @endforeach

        </tbody>
    </table>
    {{$products->links()}}

</div>