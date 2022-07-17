<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Area Name</th>
                <th>Rate</th>
                <th>Districts</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1 @endphp
            @foreach($deliver_setting as $row)
            <tr>
                <td>
                    {{$i}}
                </td>
                <td>{{ucwords($row->area_name)}}</td>
                <td>{{$row->rate}}</td>
                <td>
                    @forelse ($row->districts as $item)
                       <span class="btn">{{$item->en_name}}</span>
                    @empty

                    @endforelse
                </td>

                <td>
                    <a href="{{ route('deliveryServiceArea.edit',$row->id)}}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil font-14"></i></a>
                    {{-- <a href="{{url('/ns-admin/rows/delete/'.$row->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do You Really Wanna Delete?')"><i class="fa fa-trash font-14"></i></a> --}}
                </td>
            </tr>
            @php $i++ @endphp
            @endforeach

        </tbody>
    </table>
    {{$deliver_setting->links()}}

</div>
