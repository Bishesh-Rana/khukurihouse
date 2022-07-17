@section('title')

Failed Delivery List | {{env('APP_NAME')}}

@stop
@extends('seller.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading" style="margin-top:14px;">
    @include('seller.partials.order_boxes')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
    </ol>

<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Failed Delivery List</div>
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
                        <th>Paid Status</th>
                        
                    </tr>
                </thead>
                
                <tbody>
                    
                    @foreach($pendings as $key => $row)
                    <tr>
                        <td>
                            {{ ++$key }}
                        </td>
                        
                    <td>{{ $row->ref_id }}</td>
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
                            @if($row->paid_status == 1)
                            <span class="badge badge-success m-r-5 m-b-5">Paid</span>
                            @else
                            <span class="badge badge-danger m-r-5 m-b-5">unpaid</span>
                            @endif
                            
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