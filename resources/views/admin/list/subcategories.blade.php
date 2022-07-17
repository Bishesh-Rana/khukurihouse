@section('title')

Sub Categories | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Sub Categories</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <a class="btn btn-outline-primary" href="{{url('/ns-admin/subCategories/create')}}"><i class="fa fa-plus"></i> Add Sub Category</a>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Sub Categories</div>
        </div>
        <div class="ibox-body">
            @include('admin.layouts.error')
            <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Sub Category Name</th>
                        <th>Sub Category Slug</th>
                        <th>Sub Category Image</th>
                        <th>Parent Category </th>
                        <th>Active Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Sub Category Name</th>
                        <th>Sub Category Slug</th>
                        <th>Parent Category </th>
                        <th>Active Status</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    @php $i = 1 @endphp
                    @foreach($subCategories as $subCategory)
                    <tr>
                        <td>
                            {{$i}}
                        </td>
                        <td>
                            {{ucwords($subCategory->sub_category_name)}}
                        </td>
                        <td>
                            {{$subCategory->sub_category_slug}}
                        </td>
                        <td>
                            <img src="{{asset('')}}uploads/categories/{{$subCategory->image}}" height="50" width="50" alt="{{$subCategory->sub_category_name}}">
                        </td>
                        <td>
                            {{$subCategory->parentcategory->parent_category_name}}
                        </td>
                        <td>
                            @if($subCategory->publish_status == 1)
                            <span class="badge badge-success m-r-5 m-b-5">Active</span>
                            @else
                            <span class="badge badge-danger m-r-5 m-b-5">Banned</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{url('/ns-admin/subCategories/edit/'.$subCategory->id)}}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil font-14"></i></a>
                            <a href="{{url('/ns-admin/subCategories/delete/'.$subCategory->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do You Really Wanna Delete?')"><i class="fa fa-trash font-14"></i></a>
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