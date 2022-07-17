<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Total Stock</th>
                <th>WithHolding Stock</th>
                <th>Sellable Stock</th>
                <th>Remaining Stock</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($stocks as $key => $stock)
            <tr>
                <td>
                    {{++$key}}
                </td>
                <td>
                    {{ucwords($stock->product_name)}}
                </td>
                <td>
                    {{$stock->total_stock}}
                </td>

                <td>
                    {{$stock->withholding_stock}}
                </td>
                <td>
                    {{$stock->sellable_stock}}
                </td>
                <td>
                    {{$stock->remaining_stock}}
                </td>
                <td>
                    <img src="{{asset('')}}uploads/products/{{$stock->image}}" alt="{{$stock->product_name}}" height="50" width="50">
                </td>
                <!-- <td>
                    <a class="btn btn-default btn-xs m-r-5" href="{{route('stock.decreaseByOne',['id' => $stock->id])}}">
                        <i class="fa fa-minus"></i>
                    </a>
                    <input style="width: 10px;" type="text" value="{{$stock->qty}}" class="form-control" width="1" readonly>
                    <a class="btn btn-default btn-xs m-r-5" href="{{route('stock.increaseByOne',['id' => $stock->id])}}">
                        <i class="fa fa-plus"></i>
                    </a>
                </td> -->
                <td>
                    <a href="{{url('/ns-admin/stocks/edit/'.$stock->id)}}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit Stock"><i class="fa fa-pencil font-14"></i></a>
                    <a href="{{url('/ns-admin/stocks/view/'.$stock->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="View Stock"><i class="fa fa-eye font-14"></i></a>
                    <!-- <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#exampleModalLong{{$key}}"><i class="fa fa-eye font-14"></i></button> -->
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
    {{$stocks->links()}}

    @foreach($stocksModal as $key => $stockModal)
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
                            <td>{{$stockModal->product_name}}</td>
                        </tr>
                        <tr height="50">
                            <th>Old Stock</th>
                            <td>{{$stockModal->old_stock}}</td>
                        </tr>
                        <tr height="50">
                            <th>New Stock</th>
                            <td>{{$stockModal->new_stock}}</td>
                        </tr>
                        <tr height="50">
                            <th>Total Stock</th>
                            <td>{{$stockModal->total_stock}}</td>
                        </tr>
                        <tr height="50">
                            <th>Withholding Stock</th>
                            <td>{{$stockModal->withholding_stock}}</td>
                        </tr>
                        <tr height="50">
                            <th>Deliverd Stock</th>
                            <td>{{$stockModal->delivered_stock}}</td>
                        </tr>
                        <tr height="50">
                            <th>Returned Stock</th>
                            <td>{{$stockModal->returned_stock}}</td>
                        </tr>
                        <tr height="50">
                            <th>Sellable Stock</th>
                            <td>{{$stockModal->sellable_stock}}</td>
                        </tr>
                        <tr height="50">
                            <th>Remaining Stock</th>
                            <td>{{$stockModal->remaining_stock}}</td>
                        </tr>
                        <tr height="50">
                            <th>Damaged Stock</th>
                            <td>{{$stockModal->damaged_stock}}</td>
                        </tr>
                        <tr height="50">
                            <th>Return Damaged Stock</th>
                            <td>{{$stockModal->returned_damage_stock}}</td>
                        </tr>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
    @endforeach
</div>