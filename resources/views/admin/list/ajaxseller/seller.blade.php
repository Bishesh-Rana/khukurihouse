<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Company</th>
                <th>Number</th>
                <th>Email</th>
                <th>Profile</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1 @endphp
            @foreach($sellers as $seller)
            <tr>
                <td>
                    {{$i}}
                </td>
                <td>
                    {{ucwords($seller->first_name)}} {{ucwords($seller->last_name)}} 
                </td>
                <td>{{ucwords($seller->company_name)}}</td>
                <td>{{$seller->company_phone}}</td>
                <td>
                    {{$seller->email}}
                </td>
                <td>
                    <img src="{{asset('')}}uploads/sellers/{{$seller->image}}" alt="{{$seller->first_name}}" height="50" width="50">
                </td>
                <td>
                    @if($seller->publish_status == 1)
                    <span class="badge badge-success m-r-5 m-b-5">Active</span>
                    @else
                    <span class="badge badge-danger m-r-5 m-b-5">Banned</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.seller.order-history',$seller->id) }}" target="_blank" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye font-14"></i></a>
                    <a href="{{url('/ns-admin/sellers/edit/'.$seller->id)}}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil font-14"></i></a>
                    <a href="{{url('/ns-admin/sellers/delete/'.$seller->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do You Really Wanna Delete?')"><i class="fa fa-trash font-14"></i></a>
                </td>
            </tr>
            @php $i++ @endphp
            @endforeach

        </tbody>
    </table>
    {{$sellers->links()}}

</div>