<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>S.N.</th>
                <th>Product Name</th>
                <th>Customer Name</th>
                <th>Reference Id</th>
                <th>Total Quantity</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $key => $row)
            <tr>
                <td>
                    {{$key+1}}
                </td>
                <td>
                    {{$row->p_id}}
                </td>
                <td>
                    {{ $row->firstname }}
                </td>
                <td>
                    {{ $row->ref_id }}

                </td>
                <td>
                    {{ $row->total_quantity }}

                </td>
                <td>
                    {{ date('M d, Y | g:i a',strtotime($row->created_at)) }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$orders->links()}}

</div>