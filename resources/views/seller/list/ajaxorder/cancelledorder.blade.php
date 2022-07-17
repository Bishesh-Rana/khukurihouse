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
                <th>Order Status</th>
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
                    <span class="badge badge-danger m-r-5 m-b-5">Cancelled</span>
                    
                </td>
            
            </tr>
            
            @endforeach
        </tbody>
    </table>
    {{$pendings->links()}}

</div>