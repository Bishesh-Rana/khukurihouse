<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Reference Code</th>
                <th>Customer Name</th>
                <!-- <th>Customer Email</th> -->
                <th>Customer Number</th>
                <!-- <th>Customer Address</th> -->
                <th>Total weight</th>
                <th>Total Product</th>
                <th>Total Quantity</th>
                <th>Order Date</th>
                <th>Seller Status</th>
                <th>Select Delivery</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($pending_list as $key => $row)
        <tr>
            <!-- <td>
                {{ ++$key }}
            </td> -->
            
        <td class="ref_id">{{ @$row->ref_id }}</td>
        
            <td>
                {{ ucfirst(@$row->firstname) }} {{ ucfirst(@$row->lastname) }}
            </td>

            <!-- <td>{{@$row->email}}</td> -->
            <td>{{@$row->number}}</td>
            <td>{{@$row->total_weight}}</td>
            
            <td>
                {{ @$row->total_product }}
            </td>

            <td>
                {{ @$row->total_quantity }}
            </td>

            <td>
                {{ date('M d, Y',strtotime(@$row->created_at)) }}
            </td>
            
            <td id="arr_ship">
                @foreach($arr_ship[@$row->ref_id] as $key => $data)
                    @if($data == '1')
                        <a href="javascript:void(0)" class="btn btn-success">{{ $arr_sel[$key] }}</a>
                    @else
                        <a href="{{route('send.mail.ship.notification',[$key,@$row->ref_id])}}" onclick="return confirm('Do You Really Want to send remainder?')" class="btn btn-danger">{{ $arr_sel[$key] }}</a>
                    @endif
                @endforeach
            </td>

            <td>
                <div id="toast" style="display: none; color: red; ">Please select a Delivery</div>
                <select name="delivery_name" id="delivery_name" class="form-control delivery_name">
                 <option  selected disabled>Select Delivery</option>
                 @foreach($delivery_list as $del)

                <option <?php  if(isset($assing_deliver)){foreach($assing_deliver as $data) if ($data->ref_id == @$row->ref_id) {
                    echo "selected";
                } }?> value="{{ $del->id }}">{{ $del->company_name }} ({{ $del->company_address }})</option>
                 @endforeach
                </select>
            </td>
            
            <td>    
            <a href="{{ route('admin.list.view.order', @$row->ref_id) }}"> <span class="badge badge-primary m-r-5 m-b-5">View</span></a>
            @if(@$row->check_status == '1')
                @if(@$row->delivery_assign_status == '0')
                <a href="#" class="delivery_assign"><span class="badge badge-danger m-r-5 m-b-5">Assign Deliver</span></a>
                @else
                <a href="javascript:void(0)"><span class="badge badge-success m-r-5 m-b-5">Assigned</span></a>
                @endif
            @endif            
            {{-- <a href="{{   route('seller.order.shipping', @$row->ref_id) }}"></i><span class="badge badge-success m-r-5 m-b-5">Ready Shipping</span></a> --}}
            
        </td>
        </tr>
        
        @endforeach
        </tbody>
    </table>
    {{$pending_list->links()}}

</div>
