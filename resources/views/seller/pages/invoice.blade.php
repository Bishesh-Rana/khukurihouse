@section('title')

Order Detail | {{env('APP_NAME')}}

@stop
@extends('seller.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Invoice</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>

        <a class="btn btn-outline-primary" href="{{ route('seller.order.shipping', $ref_id) }}"><i class="fa fa-plus"></i>Ready To Ship</a>

    </ol>
    @include('admin.layouts.error')
</div>
<div class="page-content fade-in-up">
    <div class="ibox invoice" id="printpage">
        <div class="invoice-header">
            <div class="row">
                <div class="col-6">
                    <div class="invoice-logo">
                        @if(isset($seller_info->image))
                        <img class="img-circle" src="{{ asset('uploads/sellers/'.$seller_info->image) }}" height="100" />
                        @else
                        <img class="img-circle" src="{{ asset('uploads/others/admin-avatar.png') }}" height="100" />
                        @endif
                        <img class="img-circle" src="{{ asset('uploads/sellers/'.$admin_logo->image)}}" height="100" style="margin-left:50%;" />
                    </div>
                    <div>
                        <div class="m-b-5 font-bold">Invoice from</div>
                        <div> @if(isset($seller_info->company_name)) {{ ucwords($seller_info->company_name) }} @else {{ ucfirst($seller_info->first_name) }} {{ ucfirst($seller_info->last_name) }} @endif</div>
                        <ul class="list-unstyled m-t-10">
                            <li class="m-b-5">
                                <span class="font-strong">Address:</span>{{ $seller_info->company_address }}
                            </li>
                            <li class="m-b-5">
                                <span class="font-strong">Email:</span>{{ $seller_info->email }}
                            </li>
                            <li>
                                <span class="font-strong">Phone:</span>{{ $seller_info->company_phone }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-6 text-right">
                    <div class="clf" style="margin-bottom:30px;">
                        <dl class="row pull-right" style="width:250px;">
                            <dt class="col-sm-6">Invoice Date</dt>
                        <dd class="col-sm-6">{{ date('M d, Y',strtotime($user_info->created_at)) }}</dd>
                            <dt class="col-sm-6">Reference ID.</dt>
                        <dd class="col-sm-6">{{ $user_info->ref_id }}</dd>
                        </dl>
                    </div>
                    <div>
                        <div class="m-b-5 font-bold">Invoice To</div>
                        <div> {{ ucfirst($user_info->firstname) }} {{ ucfirst($user_info->lastname) }}</div>
                        <ul class="list-unstyled m-t-10">
                            <li class="m-b-5">{{ $user_info->street }}</li>
                            <li class="m-b-5">{{ $user_info->country }}</li>
                            {{-- <li>{{ $user_info->phone }}</li> --}}
                        </ul>
                    </div>
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
    <div class="text-right">
        <button class="btn btn-info" type="button" onclick="printDiv()"><i class="fa fa-print"></i> Print</button>
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


@stop


@section('footer')

<script>
    function printDiv() {
        var value1 = document.getElementById('printpage').innerHTML;
        var value2 = document.body.innerHTML;
        document.body.innerHTML = value1;
        window.print();
        document.body.innerHTML = value2;
        location.reload();

    }
</script>
@endsection