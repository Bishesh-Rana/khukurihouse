<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Transaction Type</th>
                <th>Transaction Number</th>
                <th>Order ID</th>
                <th>Details</th>
                <th>Amount</th>
                <!-- <th>VAT</th> -->
                <th>Statement</th>
            </tr>
        </thead>
        <tbody>
            @if(count($transactions) > 0)
                @php $i = 1 @endphp
                @foreach($transactions as $row)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$row->date}}</td>
                        <td>{{ ucwords(str_replace('_',' ',$row->transaction_type))}}</td>
                        <td>{{$row->transaction_number}}</td>
                        <td>{{$row->order_number}}</td>
                        <td>{{$row->details}}</td>
                        <td>{{$row->amount}}</td>
                        <!-- <td>{{$row->vat}}</td> -->
                        <td>{{$row->statement}}</td>
                    </tr>
                @php $i++ @endphp
                @endforeach
            @else
            <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
                <td>No data available in table</td>
            </tr>
            @endif
        </tbody>
    </table>
    @if(count($transactions) > 0)
    {{$transactions->links()}}
    @endif

</div>