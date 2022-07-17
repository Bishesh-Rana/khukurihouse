@section('title')

Admin Financial Overview | {{env('APP_NAME')}}

@stop

@extends('admin.layouts.app')


@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Financial Overview</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('admin.financial.statement')}}">Go Back<i class="la la-home font-20"></i></a>
        </li>
    </ol>
</div>

<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Statement</div>
        </div>
        @include('admin.layouts.error')

        <div class="ibox-body">
            <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                <!-- <button type="button"  data-toggle="collapse" data-target="#demo">Simple collapsible</button> -->
        </div>
        @if(isset($finance))
        <tbody>
            <tr>
                <th>Opening Balance</th>
                <td>{{$finance->opening_balance}}</td>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <th>Item Charges</th>
                <td>{{$finance->order_item_charge}}</td>
            </tr>
            <tr>
                <th data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2" style="cursor:pointer;">
                    <i class="fa fa-angle-right icon"></i> Eshopping Fees</th>
                <td> - {{$finance->order_eshopping_fee}}</td>
            </tr>
            <tr id="multiCollapseExample1" class="collapse multi-collapse">
                <th style="padding-left: 100px;">
                    <a href="{{route('admin.transaction.overview', ['transaction_type' => 'commission_fee', 'year' => $finance->year,'month' => $finance->month, 'seller_id' => $finance->seller_id])}}" style="color:blue" target="_blank">Commission</a>
                </th>
                <td>{{$finance->order_commission_fee}}</td>
            </tr>
            <tr id="multiCollapseExample2" class="collapse multi-collapse">
                <th style="padding-left: 100px;">
                    <a href="{{route('admin.transaction.overview', ['transaction_type' => 'payment_fee', 'year' => $finance->year,'month' => $finance->month, 'seller_id' => $finance->seller_id])}}" style="color:blue" target="_blank">Payment Fees </a>
                </th>
                <td>{{$finance->order_payment_fee}}</td>
            </tr>
            <tr id="multiCollapseExample3" class="collapse multi-collapse">
                <th style="padding-left: 100px;">
                    <a href="{{route('admin.transaction.overview', ['transaction_type' => 'shipping_fee', 'year' => $finance->year,'month' => $finance->month, 'seller_id' => $finance->seller_id])}}" style="color:blue" target="_blank">Shipping Charge</a>
                </th>
                <td>{{$finance->order_shipping_fee}}</td>
            </tr>
            <tr>
                <th>Penalties</th>
                <td>- {{$finance->order_penalties}}</td>
            </tr>
            <tr>
                <th>VAT</th>
                <td>- {{$finance->order_vat}}</td>
            </tr>
            <tr>
                <th style="text-align:right">Subtotal</th>
                <td>{{$finance->order_subtotal}}</td>
            </tr>
        </tbody>

        <tbody>
            <tr>
                <th>Refunds</th>
                <td></td>
            </tr>
            <tr>
                <th>Item Charges</th>
                <td>- {{$finance->refund_item_charge}}</td>
            </tr>
            <tr>
                <th data-toggle="collapse" data-target=".multi-collapse2" aria-expanded="false" aria-controls="multiCollapseExample4 multiCollapseExample5" style="cursor:pointer;">
                    <i class="fa fa-angle-right icon"></i> {{ config('app.name') }} Fees</th>
                <td> {{$finance->refund_eshopping_fee}}</td>
            </tr>
            <tr id="multiCollapseExample4" class="collapse multi-collapse2">
                <th style="padding-left: 100px;">
                    <a href="{{route('admin.transaction.overview', ['transaction_type' => 'reversal_commission_fee', 'year' => $finance->year,'month' => $finance->month, 'seller_id' => $finance->seller_id])}}" style="color:blue" target="_blank">Commission</a>
                </th>
                <td>{{$finance->refund_reversal_commission_fee}}</td>
            </tr>
            <tr id="multiCollapseExample5" class="collapse multi-collapse2">
                <th style="padding-left: 100px;">
                    <a href="{{route('admin.transaction.overview', ['transaction_type' => 'payment_fee_credit', 'year' => $finance->year,'month' => $finance->month, 'seller_id' => $finance->seller_id])}}" style="color:blue" target="_blank">Payment Fees</a>
                </th>
                <td>{{$finance->refund_payment_fee_credit}}</td>
            </tr>
            <tr>
                <th>Penalties</th>
                <td>- {{$finance->refund_penalties}}</td>
            </tr>
            <tr>
                <th>VAT</th>
                <td>{{$finance->refund_vat}}</td>
            </tr>
            <tr>
                <th style="text-align:right">Subtotal</th>
                <td>{{$finance->refund_subtotal}}</td>
            </tr>
        </tbody>

        <tbody>
            <tr>
                <th>Closing Balance</th>
                <td>{{$finance->closing_balance}}</td>
            </tr>
            <tr>
                <th>Payout</th>
                <td>{{$finance->payout}}</td>
            </tr>
        </tbody>
        @else
        <h2>No Statement Available</h2>
        @endif

        </table>

    </div>
</div>

@if($finance->payout <= 0)
<div class="ibox">
    <div class="ibox-head">
        <div class="ibox-title">Pay To Seller</div>
    </div>
    <div class="ibox-body">
        <form action="{{route('admin.payto.seller',$finance->id)}}" method="post" class="form-inline">
            @csrf
            <label class="sr-only" for="pay-now">Pay To Seller</label>
            <input class="form-control mb-2 mr-sm-2 mb-sm-0" id="pay-now" type="text" name="payment_amount" placeholder="Pay Now">
            <button class="btn btn-success" type="submit">Pay Now</button>
        </form>
    </div>
</div>
@else
<div class="ibox">
    <div class="ibox-head">
        <div class="ibox-title">Last Month Amount Paid Rs. {{$finance->payout}}</div>
    </div>
</div>

@endif

</div>

<!-- END PAGE CONTENT-->

@stop

@section('footer')

<script>
    $('#demo').on('shown.bs.collapse', function() {
        $(".icon").removeClass("fa-angle-right").addClass("fa-angle-down");
    });

    $('#demo').on('hidden.bs.collapse', function() {
        $(".icon").removeClass("fa-angle-down").addClass("fa-angle-right");
    });
</script>

@stop