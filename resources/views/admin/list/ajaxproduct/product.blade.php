<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Owner Code</th>
                <th>Product Code</th>
                <th>Price</th>
                <th>Product Image</th>
                <th>Categories</th>
                <th>Product Created Date</th>
                <th>Status</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1 @endphp
            @foreach($products as $product)
            <tr>
                <td>
                    {{$i}}
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
            <td>{{$product->product_code}}</td>
                <td>
                    {{number_format($product->product_original_price)}}
                </td>
                <td>
                    <img src="{{asset('')}}uploads/products/{{$product->image}}" alt="{{$product->name}}" height="50" width="50">
                </td>
                <td>

                    <label class="label label-warning">{{$product->category->category_name}}</label>
                    <!-- <label class="label label-warning">asdf</label> -->

                </td>

                <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d M, Y') }}


                </td>
                <td>
                    @if($product->publish_status == 1)
                    <span class="badge badge-success m-r-5 m-b-5">Active</span>
                    @else
                    <span class="badge badge-danger m-r-5 m-b-5">Banned</span>
                    @endif
                </td>
                <td>
                    @if($product->publish_status == 1)
                    <span class="badge badge-success m-r-5 m-b-5">Active</span>
                    @else
                    <span class="badge badge-danger m-r-5 m-b-5">Banned</span>
                    @endif
                </td>
                <td width="12%">
                    <a href="{{url('/ns-admin/products/view/'.$product->id)}}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye font-14"></i></a>
                    <a href="{{url('/ns-admin/products/edit/'.$product->id)}}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil font-14"></i></a>
                    <a href="{{url('/ns-admin/products/delete/'.$product->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do You Really Wanna Delete?')"><i class="fa fa-trash font-14"></i></a>
                </td>
            </tr>
            @php $i++ @endphp
            @endforeach

        </tbody>
    </table>
    {{$products->links()}}

</div>
