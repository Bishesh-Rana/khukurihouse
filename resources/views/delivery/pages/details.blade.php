@extends('delivery.layouts.app')

@section('title')

Seller and Customer Details | {{env('APP_NAME')}}

@stop

@section('content')

<div class="page-heading">
    <h1 class="page-title">Seller and Customer Details</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{url('/ns-delivery/pending-orders')}}">Go Back<i class="la la-home font-20"></i></a>
        </li>
    </ol>
</div>

<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">
            Customer Details
            </div>
        </div>
        <div class="ibox-body">
            <table class="table table-striped no-margin table-invoice">
                <tbody>
                    <tr>
                        <th>Full Name</th>
                        <td>{{$customer_info->firstname}}</td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td>{{$customer_info->lastname}}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{$customer_info->street}}, {{$customer_info->town}} , {{$customer_info->state}} </td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{$customer_info->email}}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{$customer_info->number}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    @foreach($seller_info as $key => $row)
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">
            Sellers ({{$key+1}}) Details
            </div>
        </div>
        
        <div class="ibox-body">
            
            <table class="table table-striped no-margin table-invoice">
                <tbody>
                    <tr>
                        <th>Company Name</th>
                        <td>{{$row->company_name}}</td>
                    </tr>
                    <tr>
                        <th>Company Address</th>
                        <td>{{$row->company_address}}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{$row->email}}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{$row->company_phone}}</td>
                    </tr>
                </tbody>
            </table>
           
        </div> 
    </div>@endforeach
</div>

@stop