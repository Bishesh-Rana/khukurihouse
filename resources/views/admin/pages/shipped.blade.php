@section('title')

Shipped| {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Detail</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <a class="btn btn-outline-primary" href="{{ route('admin.order.shipped.list') }}"><i class="fa fa-step-backward"></i>  BACK</a>
        
        {{-- <a class="btn btn-outline-primary" href="{{ route('seller.order.shipping.update', $user_info->ref_id) }}"><i class="fa fa-plus"></i>Shipped</a> --}}
        
    </ol>
    @include('admin.layouts.error')
</div>
<!-- START PAGE CONTENT-->
<div class="page-content fade-in-up" id = "printpage">
    <div class="ibox invoice">
        <div class="invoice-header">
            <div class="row">
                <div class="col-6">
                 
                    <div>
                        <div class="m-b-5 font-bold">Customer Detail:</div>
                        <div>Name: {{ ucfirst($user_info->firstname) }} {{ ucfirst($user_info->lastname) }}</div>
                        <ul class="list-unstyled m-t-10">
                            <li class="m-b-5">
                                <span class="font-strong">Country:</span>{{ $user_info->country }}</li>
                                {{-- <li class="m-b-5">
                                    <span class="font-strong">State:</span>{{ $user_info->State }}</li>
                                     --}}
                                    </ul>
                                </div>
                         
                        </div>
                    </div>
                    <table class="table table-striped no-margin table-invoice">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total Price</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @php $sum = 0; @endphp
                            @foreach($ordered_products as $key => $row)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>
                                    {{ $row->product_name}}</td>
                                    <td>{{ $row->quantity }}</td>
                                    <td>{{ $row->product_original_price }}</td>
                                    @php 
                                    
                                    $total_qnty = $row->quantity;
                                    $unit_price = $row->product_original_price;
                                    $total_price = $total_qnty*$unit_price;
                                    $sum+=$total_price;
                                    @endphp
                                    <td>{{ $total_price }}</td>
                                    
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                        <table class="table no-border">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th width="15%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-right">
                                    <td>Subtotal:</td>
                                    <td>{{ $sum  }}</td>
                                </tr>
                                {{-- <tr class="text-right">
                                    <td>TAX 5%:</td>
                                    <td>$92</td>
                                </tr> --}}
                                <tr class="text-right">
                                    <td class="font-bold font-18">TOTAL:</td>
                                    <td class="font-bold font-18">{{ $sum }}</td>
                                </tr>
                            </tbody>
                        </table>
                    
                    </div>
                    <style>
                        .invoice {
                            padding: 20px
                        }
                        
                        .invoice-header {
                            margin-bottom: 50px
                        }
                        
                        .invoice-logo {
                            margin-bottom: 50px;
                        }
                        
                        .table-invoice tr td:last-child {
                            text-align: right;
                        }
                    </style>
                    
                </div>
                <!-- END PAGE CONTENT-->
@endsection
