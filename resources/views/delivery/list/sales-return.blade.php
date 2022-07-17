@section('title')

Sales Return | {{env('APP_NAME')}}

@stop

@extends('delivery.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Sales Return</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <a class="btn btn-outline-primary" href="{{route('delivery.sales.return.create')}}"><i class="fa fa-plus"></i> Add Sales Return</a>
    </ol>
</div>

<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Sales Returns</div>
        </div>
        <div class="ibox-body">
            @include('admin.layouts.error')

            <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Seller</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($salesReturns as $key => $row)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{$row->seller_name}}</td>
                        <td>{{$row->product_name}}</td>
                        <td>{{$row->quantity}}</td>
                        <td>
                            <a href="{{route('delivery.sales.return.edit',$row->id)}}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil font-14"></i></a>
                            <a href="{{route('delivery.sales.return.destroy',$row->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do You Really Wanna Delete?')"><i class="fa fa-trash font-14"></i></a>
                        </td>
                    </tr>

                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- END PAGE CONTENT-->

@stop