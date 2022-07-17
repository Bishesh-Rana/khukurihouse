@extends('admin.layouts.app')

@section('title')

{{ucwords($category->category_name)}} | {{env('APP_NAME')}}

@stop

@section('content')

<div class="page-heading">
    <h1 class="page-title">Category Details</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{url('/ns-admin/categories')}}">Go Back<i class="la la-home font-20"></i></a>
        </li>
    </ol>
</div>

<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-body">
            <table class="table table-striped no-margin table-invoice">
                <tbody>
                    <tr>
                        <th>Category Name</th>
                        <td>{{ucwords($category->category_name)}}</td>
                    </tr>
                    <tr>
                        <th>Parent Category</th>
                        <td>{{$category->parentCategory}}</td>
                    </tr>
                    <tr>
                        <th>Product Count</th>
                        <td>{{$category->products->count()}}</td>
                    </tr>
                    <tr>
                        <th>Show on home</th>
                        <td>
                            @if($category->show_on_home == 1)
                            <span class="badge badge-success m-r-5 m-b-5">Active</span>
                            @else
                            <span class="badge badge-danger m-r-5 m-b-5">Banned</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Publish Status</th>
                        <td>
                            @if($category->show_on_home == 1)
                            <span class="badge badge-success m-r-5 m-b-5">Active</span>
                            @else
                            <span class="badge badge-danger m-r-5 m-b-5">Banned</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Category Image</th>
                        <td>
                            <img src="{{asset('')}}uploads/categories/{{$category->image}}" height="50" width="50" alt="{{$category->category_name}}">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@stop