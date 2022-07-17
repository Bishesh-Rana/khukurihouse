<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Image</th>
                <th>Slug</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pushnotifications as $key => $pushnotification)
            <tr>
                <td>
                    {{$key+1}}
                </td>
                <td>
                    {{ucwords($pushnotification->title)}}
                </td>
                <td>
                    <img src="{{asset('')}}uploads/pushnotifications/{{$pushnotification->image}}" alt="{{$pushnotification->name}}" height="56" width="192">
                </td>
                <td>
                {{$pushnotification->slug}}
                </td>
                <td>
                {{$pushnotification->type}}
                </td>
                <td>
                    <a href="{{url('/ns-admin/pushnotifications/edit/'.$pushnotification->id)}}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil font-14"></i></a>
                    <a href="{{url('/ns-admin/pushnotifications/delete/'.$pushnotification->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do You Really Wanna Delete?')"><i class="fa fa-trash font-14"></i></a>
                    <a href="{{url('/ns-admin/pushnotifications/send/'.$pushnotification->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Send" onclick="return confirm('Are you sure?')"><i class="fa fa-eye font-14"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$pushnotifications->links()}}

</div>