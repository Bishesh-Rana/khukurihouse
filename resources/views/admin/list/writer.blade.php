@section('title')

Writers | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Writers</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <a class="btn btn-outline-primary" href="{{url('/ns-admin/writers/create')}}"><i class="fa fa-plus"></i> Add Writer</a>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Writers</div>
        </div>
        <div class="ibox-body">
            @include('admin.layouts.error')

            <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Writer Title</th>
                        <th>Writer Image</th>
                        <th>Writer Type</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Writer Title</th>
                        <th>Writer Image</th>
                        <th>Writer Type</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach($writers as $row)
                    <tr>
                        <th scope="row"> {{$i}} </th>
                        <td>{{ucwords($row->writer_title)}}</td>
                        <td>
                            <img src="{{asset('')}}uploads/writers/{{$row->featured_img}}" alt="{{$row->writer_title}} Image" height="50" width="50">
                        </td>
                        <td>{{ucwords($row->writer_type)}}</td>
                        <td>
                            @if($row->publish_status == 1)
                            <span class="label label-success">Active</span>
                            @else
                            <span class="label label-danger">Banned</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{url('/ns-admin/writers/edit/'.$row->id)}}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit">
                                <i class="fa fa-pencil font-14"></i>
                            </a>
                            <a href="{{url('/ns-admin/writers/delete/'.$row->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do You Really Wanna Delete?')">
                                <i class="fa fa-trash font-14"></i>
                            </a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->

@stop