<table class="table table-striped table-bordered table-hover" id="" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>S.N.</th>
            <th>Reference Code</th>
            <th>Customer Name</th>
            <th>Total Product</th>
            <th>Total Quantity</th>
            <th>Order Date</th>
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
                {{ $row->total_product }}
            </td>
            <td>
                {{ $row->total_quantity }}
            </td>
            <td>
                {{ date('M d, Y | g:i a',strtotime($row->created_at)) }}
            </td>
            <td>
                @if($row->paid_status == 1)
                <span class="badge badge-success m-r-5 m-b-5">Paid</span>
                @else
                <span class="badge badge-danger m-r-5 m-b-5">unpaid</span>
                @endif
            </td>
            <td>
            <a href="{{ route('admin.order.shipped.view', $row->ref_id) }}"> <span class="badge badge-primary m-r-5 m-b-5">View</span></a>
            @if (request()->is('ns-admin/shipped'))
            <a href="{{   route('admin.order.delivered', $row->ref_id) }}"></i><span class="badge badge-success m-r-5 m-b-5">Deliver Order</span></a>

            @endif

        </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$pendings->links()}}
