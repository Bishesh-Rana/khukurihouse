@section('title')

News | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">News</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <a class="btn btn-outline-primary" href="{{url('/ns-admin/news/create')}}"><i class="fa fa-plus"></i> Add News</a>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">News</div>
        </div>
        <div class="ibox-body">
            @include('admin.layouts.error')

            <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>News Title</th>
                        <th>News Image</th>
                        <th>News Categories</th>
                        <th>News Tags</th>
                        <th>News Writers</th>
                        <th>Featured</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1 @endphp
                    @foreach($news as $row)
                    <tr>
                        <td>
                            {{$i}}
                        </td>
                        <td>{{ucwords($row->news_title)}}</td>
                        <td>
                            @if(isset($row->featured_img))
                            <img src="{{asset('')}}uploads/news/{{$row->featured_img}}" alt="{{$row->news_title}} Image" height="50" width="50">
                            @endif
                            @if(isset($row->parallex_img))
                            <img src="{{asset('')}}uploads/news/{{$row->parallex_img}}" alt="{{$row->news_title}} Image" height="50" width="50">
                            @endif
                        </td>
                        <td>
                            @foreach($row->newscategory as $item)
                            <span class="label label-warning">{{$item->category_title}}</span>&nbsp;
                            @endforeach
                        </td>
                        <td>
                            @foreach($row->tag as $item)
                            <span class="label label-warning">{{$item->tag_title}}</span>&nbsp;
                            @endforeach
                        </td>
                        <td>
                            @foreach($row->writer as $item)
                            <span class="label label-info">{{$item->writer_title}}</span>&nbsp;
                            @endforeach
                        </td>
                        <td>
                            @if($row->featured_news == 1)
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
                            <a href="{{url('/ns-admin/news/edit/'.$row->id)}}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil font-14"></i></a>
                            <a href="{{url('/ns-admin/news/delete/'.$row->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do You Really Wanna Delete?')"><i class="fa fa-trash font-14"></i></a>
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