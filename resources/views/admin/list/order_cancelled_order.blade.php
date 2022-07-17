@section('title')

Updated Order List | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Updated Order</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        {{-- <a class="btn btn-outline-primary" href="{{url('/ns-admin/tags/create')}}"><i class="fa fa-plus"></i> Add Tag</a> --}}
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Updated Order</div>
        </div>
        <div class="ibox-body">
            @include('admin.layouts.error')

            <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer Name</th>
                        <th>Ref ID</th>
                        <th>Street</th>
                        <th>Email</th>
                        <th>Number</th>
                        <th>Refund Amount</th>
                        <th>Payment Gateway</th>
                        <th>Paid Status</th>
                      
                    </tr>
                </thead>
                
                <tbody>
                    @php $i = 1 @endphp
                    @foreach($orders as $row)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{ucwords($row->firstname)}} {{ ucwords($row->lastname)}}</td>
                    <td>{{ $row->ref_id }}</td>
                        <td>{{ucwords($row->state)}}</td>
                        <td>{{ $row->email}}</td>
                        <td>{{ $row->number}}</td>
                        <td>
                         
                            {{ $row->total_price+$row->delivery_cost}}
                        </td>

                        <td>
                            @if($row->khalti == 1)
                            <span class="badge badge-success m-r-5 m-b-5">Khalti</span>
                            @elseif($row->esewa == 1)
                            <span class="badge badge-success m-r-5 m-b-5">Esewa</span> 
                             @elseif($row->imepay == 1)
                            <span class="badge badge-success m-r-5 m-b-5">ImePay</span>
                            @elseif($row->paypal == 1)
                            <span class="badge badge-success m-r-5 m-b-5">Paypal</span>
                            @else
                            <span class="badge badge-success m-r-5 m-b-5">Cash</span>
                            @endif
                        </td>
                        <td>
                            @if($row->paid_status == 1)
                            <span class="badge badge-success m-r-5 m-b-5">Yes</span>
                            @else
                            <span class="badge badge-danger m-r-5 m-b-5">No</span>
                            @endif
                        </td>
                        {{-- <td>
                          
                        </td>
                        <td>
                            <a href="{{url('/ns-admin/tags/edit/'.$row->id)}}" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil font-14"></i></a>
                            <a href="{{url('/ns-admin/tags/delete/'.$row->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do You Really Wanna Delete?')"><i class="fa fa-trash font-14"></i></a>
                        </td> --}}
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