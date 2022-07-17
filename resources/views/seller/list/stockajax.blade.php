<div class="ibox-body">

    <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                @if(auth()->guard('seller')->user()->parent_id == null)
                <!-- <th>Added By</th> -->
                <th>Updated By</th>
                @endif
                <th>Total Stock</th>
                <th>WithHolding Stock</th>
                <th>Sellable Stock</th>
                <th>Remaining Stock</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                @if(auth()->guard('seller')->user()->parent_id == null)
                <!-- <th>Added By</th> -->
                <th>Updated By</th>
                @endif
                <th>Total Stock</th>
                <th>WithHolding Stock</th>
                <th>Sellable Stock</th>
                <th>Remaining Stock</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </tfoot>
        <tbody>

            @foreach($stocks as $key => $stock)
            <tr>
                <td>
                    {{++$key}}
                </td>
                <td>
                    {{ucwords($stock->product_name)}}
                </td>
                @if(auth()->guard('seller')->user()->parent_id == null)
                <!-- <td>{{$stock->created_by}}</td> -->
                <td>{{$stock->updated_by}}</td>
                @endif
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
                    <a href="{{url('/ns-seller/stocks/edit/'.$stock->id)}}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit Stock"><i class="fa fa-pencil font-14"></i></a>
                    <a href="{{url('/ns-seller/stocks/view/'.$stock->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="View Stock"><i class="fa fa-eye font-14"></i></a>
                    <!-- <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#exampleModalLong{{$key}}"><i class="fa fa-eye font-14"></i></button> -->
                </td>
            </tr>

            @endforeach

        </tbody>
    </table>
    {{$stocks->links()}}
</div>