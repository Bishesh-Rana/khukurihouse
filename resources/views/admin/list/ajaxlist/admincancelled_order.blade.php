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
                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal{{$loop->iteration}}">
                    View Reason
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@foreach($pendings as $key => $row)
<!-- Modal -->
<div class="modal fade" id="exampleModal{{$loop->iteration}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cancelled Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Customer Name : {{ ucfirst($row->firstname) }} {{ ucfirst($row->lastname) }} <hr>
                Cancelled Reason : <br>
                {{$row->reason}}
            </div>
        </div>
    </div>
</div>
@endforeach

{{$pendings->links()}}