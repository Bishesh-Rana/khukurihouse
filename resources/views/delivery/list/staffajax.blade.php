<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <!-- <th>#</th> -->
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($staffs as $key => $row)
            <tr>
                <!-- <td>
                    <label class="ui-checkbox">
                        <input type="checkbox">
                        <span class="input-span"></span>
                    </label>
                </td> -->
                <td>{{ucwords($row->first_name)}}</td>
                <td>{{ucwords($row->last_name)}}</td>
                <td>{{$row->email}}</td>
                <td>
                    <a href="{{url('/ns-delivery/staffs/edit/'.$row->id)}}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit Staff"><i class="fa fa-pencil font-14"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$staffs->links()}}

</div>