<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Number</th>
                <th>Email</th>
                <th>Profile</th>
                <th>Status</th>
                <th>Commission</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1 @endphp
            @foreach($affiliates as $affiliate)
            <tr>
                <td>
                    {{$i}}
                </td>
                <td>
                    {{ucwords($affiliate->first_name)}} {{ucwords($affiliate->last_name)}}
                </td>
                <td>{{$affiliate->phone}}</td>
                <td>
                    {{$affiliate->email}}
                </td>
                <td>
                    <img src="{{asset('')}}uploads/affiliates/{{$affiliate->image}}" alt="{{$affiliate->first_name}}" height="50" width="50">
                </td>
                <td>
                    @if($affiliate->publish_status == 1)
                    <span class="badge badge-success m-r-5 m-b-5">Active</span>
                    @else
                    <span class="badge badge-danger m-r-5 m-b-5">Banned</span>
                    @endif
                </td>
                <td>
                    <input type="text" name="commission" class="custom-form-control" id="commission{{$affiliate->id}}" maxlength="3" size="3" value="<?php echo $affiliate->commission ?? old('commission') ?>">
                    <a class="btn btn-default btn-xs m-r-5 update" data-id="{{$affiliate->id}}">Update</a>
                </td>
                <td>
                    <a href="{{ route('admin.affiliate.order-history',$affiliate->id) }}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye font-14"></i></a>
                    <a href="{{url('/ns-admin/affiliates/edit/'.$affiliate->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Edit" ><i class="fa fa-edit font-14"></i></a>
                    <a href="{{url('/ns-admin/affiliates/delete/'.$affiliate->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do You Really Wanna Delete?')"><i class="fa fa-trash font-14"></i></a>
                </td>
            </tr>
            @php $i++ @endphp
            @endforeach

        </tbody>
    </table>
    {{$affiliates->links()}}

</div>