<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <!-- <th width="50px"></th> -->
                <th>Name</th>
                <th>Image</th>
                <th>SKU</th>
                <th>Created at</th>
                @if(auth()->guard('seller')->user()->parent_id == null)
                <th>Added By</th>
                <th>Updated By</th>
                @endif
                <th>Retail Price</th>
                <th>Sale Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($products as $key => $row)
            <tr>
                <!-- <td>
                    <label class="ui-checkbox">
                        <input type="checkbox">
                        <span class="input-span"></span>
                    </label>
                </td> -->
                <td>{{ucwords($row->product_name)}}</td>
                <td><img src="{{asset('')}}uploads/products/{{$row->image}}" width="50px;" height="50px"  alt=""></td>
                <td>{{$row->product_sku}}</td>
                <td>{{$row->created_at->format('Y-m-d')}}</td>
                @if(auth()->guard('seller')->user()->parent_id == null)
                <td>{{$row->created_by}}</td>
                <td>{{$row->updated_by}}</td>
                @endif
                <td>{{$row->product_original_price}}</td>
                <td>{{$row->product_compare_price}}</td>
                <td>
                    <a href="{{route('seller.product.edit',$row->id)}}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil font-14"></i></a>
                    <a class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash font-14"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$products->links()}}

</div>