@section('title')

News Tags | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">News Tags</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <a class="btn btn-outline-primary" href="{{url('/ns-admin/tags/create')}}"><i class="fa fa-plus"></i> Add Tag</a>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">News Tags</div>
        </div>
        <div class="ibox-body">
            @include('admin.layouts.error')

            <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tag Title</th>
                        <th>Total News</th>
                        <th>Featured</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                
                <tbody>
                    @php $i = 1 @endphp
                    @foreach($tags as $row)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{ucwords($row->tag_title)}}</td>
                        <td>{{ucwords($row->news->count())}}</td>
                        <td>
                            @if($row->featured_status == 1)
                            <span class="badge badge-success m-r-5 m-b-5">Yes</span>
                            @else
                            <span class="badge badge-danger m-r-5 m-b-5">No</span>
                            @endif
                        </td>
                        <td>
                            @if($row->publish_status == 1)
                            <span class="badge badge-success m-r-5 m-b-5">Active</span>
                            @else
                            <span class="badge badge-danger m-r-5 m-b-5">Banned</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{url('/ns-admin/tags/edit/'.$row->id)}}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil font-14"></i></a>
                            <a href="{{url('/ns-admin/tags/delete/'.$row->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do You Really Wanna Delete?')"><i class="fa fa-trash font-14"></i></a>
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