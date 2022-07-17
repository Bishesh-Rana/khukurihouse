<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>S.N.</th>
                <th>Reference Code</th>
                <th>Customer Name</th>
                <th>Country</th>
                <th>Total Product</th>
                <th>Total Quantity</th>
                <th>Paid Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pendings as $key => $row)
            <tr>
                <td>
                    {{ ++$key }}
                </td>
                
            <td>{{ $row->ref_id }}</td>
                <td>
                    {{ ucfirst($row->firstname) }} {{ ucfirst($row->lastname) }}
                </td>
                <td>
                    {{$row->country}}
                </td>
                <td>
                    {{ $row->total_product }}
                </td>

                <td>
                    {{ $row->total_quantity }}
                </td>
                
                <td>
                    @if($row->paid_status == 1)
                    <span class="badge badge-success m-r-5 m-b-5">Paid</span>
                    @else
                    <span class="badge badge-danger m-r-5 m-b-5">unpaid</span>
                    @endif
                    
                </td>
                
                <td>    
                    <a href="{{ route('seller.order.ready.shipping.view', $row->ref_id) }}"> <span class="badge badge-primary m-r-5 m-b-5">View</span> </a>
                    {{-- <a href="{{ route('seller.order.shipping.update', $row->ref_id) }}"> <span class="badge badge-success m-r-5 m-b-5">Shipped</span></a> --}}
                </td>
            </tr>
            
            @endforeach
        </tbody>
    </table>
    {{$pendings->links()}}

</div>