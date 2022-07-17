@section('title')

Advertisements | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Advertisements</h1>
    <ol class="breadcrumb">
        <a class="btn btn-outline-primary" href="{{url('/ns-admin/advertisements/create')}}"><i class="fa fa-plus"></i> Add Advertisement</a>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Advertisements</div>
        </div>
        <div class="ibox-body">
            @include('admin.layouts.error')

            <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ad Title</th>
                        <th>Ad Image</th>
                        <th>Ad Placement</th>
                        <th>Active Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @php $i = 1 @endphp
                    @foreach($advertisements as $advertisement)
                    <tr>
                        <td>
                            {{$i}}
                        </td>
                        <td>
                            {{ucwords($advertisement->title)}}
                        </td>
                        <td>
                            <img src="{{asset('')}}uploads/notices/{{$advertisement->image}}" height="50" width="50" alt="{{$advertisement->title}}">
                        </td>
                        <td>
                            <span class="label label-warning">{{$advertisement->placement}}</span>
                        </td>
                        <td>
                            @if($advertisement->publish_status == 1)
                            <span class="badge badge-success m-r-5 m-b-5">Active</span>
                            @else
                            <span class="badge badge-danger m-r-5 m-b-5">Banned</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{url('/ns-admin/advertisements/edit/'.$advertisement->id)}}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil font-14"></i></a>
                            <a href="{{url('/ns-admin/advertisements/delete/'.$advertisement->id)}}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do You Really Wanna Delete?')"><i class="fa fa-trash font-14"></i></a>
                            <a href="{{route('mailtosubscribers', $advertisement->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Mail to Subscribers" onclick="return confirm('Do You Really Wanna Send Mail?')"><i class="fa fa-envelope"></i></a>
                        </td>
                    </tr>
                    @php $i++ @endphp
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->

@stop
