@extends('seller.layouts.app')

@section('title')

Stock | {{env('APP_NAME')}}

@stop

@section('content')

<div class="page-heading">
    <h1 class="page-title">{{ucwords($stock->product_name)}} Stock Details</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{url('/ns-seller/stocks')}}">Go Back<i class="la la-home font-20"></i></a>
        </li>
    </ol>
</div>

<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-body">
            <table class="table table-striped no-margin table-invoice">
                <tbody>
                    <tr>
                        <th>Product Name</th>
                        <td>{{ucwords($stock->product_name)}}</td>
                    </tr>
                    <tr>
                        <th>Old Stock</th>
                        <td>{{$stock->old_stock}}</td>
                    </tr>
                    <tr>
                        <th>New Stock</th>
                        <td>{{$stock->new_stock}}</td>
                    </tr>
                    <tr>
                        <th>Total Stock</th>
                        <td>{{$stock->total_stock}}</td>
                    </tr>
                    <tr>
                        <th>Withholding Stock</th>
                        <td>{{$stock->withholding_stock}}</td>
                    </tr>
                    <tr>
                        <th>Deliverd Stock</th>
                        <td>{{$stock->delivered_stock}}</td>
                    </tr>
                    <tr>
                        <th>Returned Stock</th>
                        <td>{{$stock->returned_stock}}</td>
                    </tr>
                    <tr>
                        <th>Sellable Stock</th>
                        <td>{{$stock->sellable_stock}}</td>
                    </tr>
                    <tr>
                        <th>Remaining Stock</th>
                        <td>{{$stock->remaining_stock}}</td>
                    </tr>
                    <tr>
                        <th>Damaged Stock</th>
                        <td>{{$stock->damaged_stock}}</td>
                    </tr>
                    <tr>
                        <th>Return Damaged Stock</th>
                        <td>{{$stock->returned_damage_stock}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@stop