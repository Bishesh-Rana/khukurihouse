@section('title')

Coupons | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Coupons</h1>
    <ol class="breadcrumb">
        <a class="btn btn-outline-primary" href="{{url('/ns-admin/coupons/create')}}"><i class="fa fa-plus"></i> Add Coupon</a>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Coupons</div>
        </div>
        <div class="ibox-body">
            @include('admin.layouts.error')

            <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Coupon Title</th>
                        <th>Coupon Code</th>
                        <th>Discount</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Coupon Title</th>
                        <th>Coupon Code</th>
                        <th>Discount</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach($coupons as $row)
                    <tr>
                        <th scope="row"> {{$i}} </th>
                        <td>{{ucwords($row->coupon_name)}}</td>
                        <td>{{$row->coupon_code}}</td>
                        <td>{{$row->discount_price}}</td>
                        <td>{{date('M d, Y',strtotime($row->start_date))}}</td>
                        <td>{{date('M d, Y',strtotime($row->end_date))}}</td>
                        <td>
                            @if($row->publish_status == 1)
                            <span class="label label-success">Active</span>
                            @else
                            <span class="label label-danger">Banned</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{url('/ns-admin/coupons/edit/'.$row->id)}}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit">
                                <i class="fa fa-pencil font-14"></i>
                            </a>
                            <a href="{{url('/ns-admin/coupons/delete/'.$row->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do You Really Wanna Delete?')">
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