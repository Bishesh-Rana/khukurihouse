<div class="table-responsive hatauney">
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
                <td><img src="{{asset('')}}uploads/products/{{$row->image}}" width="50px;" height="50px" alt=""></td>
                <td>{{$row->product_sku}}</td>
                <td>{{$row->created_at->format('Y-m-d')}}</td>
                @if(auth()->guard('seller')->user()->parent_id == null)
                <td>{{$row->created_by}}</td>
                <td>{{$row->updated_by}}</td>
                @endif
                <td>{{$row->product_original_price}}</td>
                <td>{{$row->product_compare_price}}</td>
                <td>
                    <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#exampleModalLong{{++$key}}"><i class="fa fa-houzz font-14"></i></button>
                    <a href="{{url('/ns-seller/products/view/'.$row->id)}}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye font-14"></i></a>
                    <a href="{{route('seller.product.edit',$row->id)}}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil font-14"></i></a>
                    <a class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash font-14"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$products->links()}}

    @foreach($productModals as $key => $productModal)
    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong{{++$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Stock Preview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <table class="table">
                        <tr height="50">
                            <th>Product Name</th>
                            <td>{{ucwords($productModal->pname)}}</td>
                        </tr>
                        <tr height="50">
                            <th>Seller is on holiday</th>
                            <td>
                                @if($productModal->holiday_mode == 1)
                                <span class="badge badge-success m-r-5 m-b-5">yes</span>
                                @else
                                <span class="badge badge-danger m-r-5 m-b-5">no</span>
                                @endif
                            </td>
                        </tr>
                        <tr height="50">
                            <th>Seller is verified</th>
                            <td>
                                @if($productModal->sps == 1)
                                <span class="badge badge-success m-r-5 m-b-5">yes</span>
                                @else
                                <span class="badge badge-danger m-r-5 m-b-5">no</span>
                                @endif
                            </td>
                        </tr>
                        <tr height="50">
                            <th>Product Status is active</th>
                            <td>
                                @if($productModal->pps == 1)
                                <span class="badge badge-success m-r-5 m-b-5">yes</span>
                                @else
                                <span class="badge badge-danger m-r-5 m-b-5">no</span>
                                @endif
                            </td>
                        </tr>
                        <tr height="50">
                            <th>
                                Stock Available
                            </th>
                            <td>
                                @if($productModal->rs > 0)
                                <span class="badge badge-success m-r-5 m-b-5">yes</span>
                                @else
                                <span class="badge badge-danger m-r-5 m-b-5">no</span>
                                @endif
                            </td>
                        </tr>
                        <tr height="50">
                            <th>Quallity Check Successful</th>
                            <td>
                                @if($productModal->quality_status == 0)
                                <span class="badge badge-success m-r-5 m-b-5">yes</span>
                                @else
                                <span class="badge badge-danger m-r-5 m-b-5">no</span>
                                @endif
                            </td>
                        </tr>
                        <tr height="50">
                            <th>Uploaded to shop</th>
                            <td>
                                @if($productModal->live_status == 1)
                                <span class="badge badge-success m-r-5 m-b-5">yes</span>
                                @else
                                <span class="badge badge-danger m-r-5 m-b-5">no</span>
                                @endif
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
    @endforeach
</div>