<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Image</th>
                <th>Status</th>
                <th>Hide Text</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sliders as $key => $slider)
            <tr>
                <td>
                    {{$key+1}}
                </td>
                <td>
                    {{ucwords($slider->title)}}
                </td>
                <td>
                    <img src="{{asset('')}}uploads/sliders/{{$slider->image}}" alt="{{$slider->name}}" height="56" width="192">
                </td>
                <td>
                    @if($slider->publish_status == 1)
                    <span class="badge badge-success m-r-5 m-b-5">Active</span>
                    @else
                    <span class="badge badge-danger m-r-5 m-b-5">Banned</span>
                    @endif
                </td>
                <td>
                    @if($slider->hide_status == 1)
                    <span class="badge badge-success m-r-5 m-b-5">On</span>
                    @else
                    <span class="badge badge-danger m-r-5 m-b-5">Off</span>
                    @endif
                </td>
                <td>
                    <a href="{{url('/ns-admin/sliders/edit/'.$slider->id)}}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil font-14"></i></a>
                    <a href="{{url('/ns-admin/sliders/delete/'.$slider->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do You Really Wanna Delete?')"><i class="fa fa-trash font-14"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$sliders->links()}}

</div>