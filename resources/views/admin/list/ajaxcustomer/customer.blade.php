<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
          
            @php $i = 1 @endphp
                    @foreach($customers as $row)
                    <tr>
                        <td>
                            {{$i}}
                        </td>
                        <td>
                            {{$row->name}}
                        </td>
                        <td>
                            {{$row->email}}
                        </td>
                        <td>
                            {{$row->address}}
                        </td>
                        <td>
                            {{$row->phone}}
                        </td>

                        <td>
                            <a href="{{ route('admin.customer.purchase-history', $row->id) }}" target="_blank" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye font-14"></i></a>
                            <a href="{{ route('admin.customer.block', $row->id) }}" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do You Really Wanna Block?')"><i class="fa fa-trash font-14"></i></a>
                        </td>
                    </tr>
                    @php $i++ @endphp
                    @endforeach
        </tbody>
    </table>
    {{$customers->links()}}

</div>