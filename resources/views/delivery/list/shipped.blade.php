@section('title')

Shipped Order | {{env('APP_NAME')}}

@stop

@extends('delivery.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading" style="margin-top:14px;">
    @include('delivery.partials.order_boxes')
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Shipped Orders</div>
            </div>
            <div class="ibox-body">
                @include('admin.layouts.error')

                <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Reference Code</th>
                            <th>Customer Name</th>
                            <th>Country</th>
                            <th>Total Product</th>
                            <th>Total Quantity</th>
                            <th>Delivery Assign Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($pendings as $key => $row)
                        <tr>
                            <td>
                                {{ ++$key }}
                            </td>

                            <td id="ref_id">{{ $row->ref_id }}</td>
                            <td>
                                {{ ucfirst($row->firstname) }} {{ ucfirst($row->lastname) }}
                            </td>
                            <td>
                                {{$row->country}}
                            </td>
                            <td>
                                {{ $row->total_product }}
                            </td>

                            <td>
                                {{ $row->total_quantity }}
                            </td>

                            <td>
                                {{ date('M d, Y | g:i a',strtotime($row->delivery_assigned_date)) }}
                            </td>

                            <td>
                                <a href="{{ route('delivery.order.detail', $row->ref_id) }}"> <span class="badge badge-primary m-r-5 m-b-5">View</span></a>
                                <a href="{{ route('delivery.order.fail', $row->ref_id) }}" onclick="return confirm('Are You Sure?')"><span class="badge badge-danger m-r-5 m-b-5">Fail Delivery</span></a>
                                <a href="{{ route('delivery.order.delivered', $row->ref_id) }}" onclick="return confirm('Are You Sure?')"></i><span class="badge badge-success m-r-5 m-b-5">Delivered</span></a>
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
