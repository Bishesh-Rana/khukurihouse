@section('title')

Financial Overview | {{env('APP_NAME')}}

@stop

@extends('seller.layouts.app')


@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Financial Overview</h1>
    <ol class="breadcrumb">
        <form action="{{route('seller.view.monthly.statement')}}" method="post">
            @csrf
            <div class="row">

                <div class="form-group">
                    <label>Select Month</label>
                    <select class="form-control select2_demo_1" name="month" required>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    <button class="btn btn-outline-primary">View</button>
                </div>
            </div>
        </form>
    </ol>
</div>

<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Orders</div>
        </div>
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
                    <a href="{{route('seller.transaction.overview', ['transaction_type' => 'commission_fee', 'year' => $finance->year,'month' => $finance->month])}}" style="color:blue" target="_blank">Commission</a>
                </th>
                <td>{{$finance->order_commission_fee}}</td>
            </tr>
            <tr id="multiCollapseExample2" class="collapse multi-collapse">
                <th style="padding-left: 100px;">
                    <a href="{{route('seller.transaction.overview', ['transaction_type' => 'payment_fee', 'year' => $finance->year,'month' => $finance->month])}}" style="color:blue" target="_blank">Payment Fees </a>
                </th>
                <td>{{$finance->order_payment_fee}}</td>
            </tr>
            <tr id="multiCollapseExample3" class="collapse multi-collapse">
                <th style="padding-left: 100px;">
                    <a href="{{route('seller.transaction.overview', ['transaction_type' => 'shipping_fee', 'year' => $finance->year,'month' => $finance->month])}}" style="color:blue" target="_blank">Shipping Charge</a>
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
                    <i class="fa fa-angle-right icon"></i> Eshopping Fees</th>
                <td> {{$finance->refund_eshopping_fee}}</td>
            </tr>
            <tr id="multiCollapseExample4" class="collapse multi-collapse2">
                <th style="padding-left: 100px;">
                    <a href="{{route('seller.transaction.overview', ['transaction_type' => 'reversal_commission_fee', 'year' => $finance->year,'month' => $finance->month])}}" style="color:blue" target="_blank">Commission</a>
                </th>
                <td>{{$finance->refund_reversal_commission_fee}}</td>
            </tr>
            <tr id="multiCollapseExample5" class="collapse multi-collapse2">
                <th style="padding-left: 100px;">
                    <a href="{{route('seller.transaction.overview', ['transaction_type' => 'payment_fee_credit', 'year' => $finance->year,'month' => $finance->month])}}" style="color:blue" target="_blank">Payment Fees</a>
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