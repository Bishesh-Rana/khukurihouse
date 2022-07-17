<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>source</th>
                <th>destination</th>
                <th>Weight</th>
                <th>Rate</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1 @endphp
            @foreach($deliver_settings as $row)
            <tr>
                <td>
                    {{$i}}
                </td>
                <td>{{ucwords($row->source)}}</td>
                <td>{{ucwords($row->destination)}}</td>
                <td>
                    {{ucwords($row->weight_min)}} - {{ucwords($row->weight_max)}} 
                </td>
              
                <td>{{$row->rate}}</td>
               
                <td>
                    <a href="{{ route('admin.deliever_setting.edit',$row->id)}}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil font-14"></i></a>
                    {{-- <a href="{{url('/ns-admin/rows/delete/'.$row->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do You Really Wanna Delete?')"><i class="fa fa-trash font-14"></i></a> --}}
                </td>
            </tr>
            @php $i++ @endphp
            @endforeach

        </tbody>
    </table>
    {{$deliver_settings->links()}}

</div>