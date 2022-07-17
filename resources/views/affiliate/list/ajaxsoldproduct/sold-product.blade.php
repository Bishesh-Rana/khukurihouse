<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Owner Code</th>
                <th>Price</th>
                <th>Product Image</th>
                <th>Categories</th>
                <th>Status</th>
                <th>Live Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $key => $product)
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
                <td>
                    <label class="label label-warning">{{$product->category->category_name}}</label>
                    <!-- <label class="label label-warning">asdf</label> -->
                </td>

                <td>
                    @if($product->publish_status == 1)
                    <span class="badge badge-success m-r-5 m-b-5">Active</span>
                    @else
                    <span class="badge badge-danger m-r-5 m-b-5">Banned</span>
                    @endif
                </td>
                <td>
                    @if($product->live_status == 1)
                    <span class="badge badge-success m-r-5 m-b-5">Active</span>
                    @else
                    <span class="badge badge-danger m-r-5 m-b-5">Banned</span>
                    @endif
                </td>
                <td>
                    <a class="btn btn-default btn-xs" target="_blank" href="{{route('product.details',$product->product_slug)}}" data-toggle="tooltip" data-original-title="Product Detail">
                        <i class="fa fa-reply font-14"></i>
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td>
                    No Data
                </td>
            </tr>
                @endforelse

        </tbody>
    </table>
    {{$products->links()}}

</div>