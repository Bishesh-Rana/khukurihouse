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
                    <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#exampleModal{{$key}}">Generate URL</button>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
    {{$products->links()}}

    @foreach($products as $key => $product)
    <div class="modal fade" id="exampleModal{{++$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Below is your affiliate URL for this product.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <a style="color: blue;" target="_blank" href="{{$setting->site_url.'product/'.$product->product_slug.'?aff_id='.Auth::guard('affiliate')->user()->affiliate_code}}">
                        <!-- {{route('product.details',['product_slug' => $product->product_slug, 'aff_id' => Auth::guard('affiliate')->user()->affiliate_code])}} -->
                        {{$setting->site_url.'product/'.$product->product_slug.'?aff_id='.Auth::guard('affiliate')->user()->affiliate_code}}
                    </a>
                </div>
                <div class="modal-footer">
                    <!-- <input type="text" value="{{route('product.details',['product_slug' => $product->product_slug, 'aff_id' => Auth::guard('affiliate')->user()->affiliate_code])}}" id="affiliate_url{{$key}}"> -->
                    <input type="text" value="{{$setting->site_url.'product/'.$product->product_slug.'?aff_id='.Auth::guard('affiliate')->user()->affiliate_code}}" id="affiliate_url{{$key}}">
                    <button onclick="copyText({{$key}})" type="button" class="btn btn-primary">Copy</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>