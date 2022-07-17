@section('title')

Financial Overview | Admin | {{env('APP_NAME')}}

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
@include('admin.layouts.error')
<div class="page-content fade-in-up" id="printpage">
    <div class="ibox invoice">
        <div class="invoice-header">
            <div class="row">
                <div class="col-12">
                    @if(isset($finance))
                    <div>
                        <div class="m-b-5 row">
                            <span class="m-r-20 font-bold col-md-3">
                                Opening Balance
                            </span>
                            <span class="m-l-20 m-r-20 col-md-4">
                                Unpaid balance from previous statements
                            </span>
                            <span class="m-l-20 col-md-3">
                                {{$finance->opening_balance}}
                            </span>
                        </div>
                        <hr>
                        <!-- orders -->
                        <div class="m-b-20 row">
                            <span class="m-r-20 font-bold col-md-3">
                                Orders
                            </span>
                            <span class="m-l-20 m-r-20 col-md-4">
                                Item Charges
                            </span>
                            <span class="m-l-20 col-md-3">
                                {{$finance->order_item_charge}}
                            </span>
                        </div>

                        <div class="m-b-20 row">
                            <span class="m-r-20 font-bold col-md-3">

                            </span>
                            <span class="m-l-20 m-r-20 col-md-4">
                                <a id="eshopping_fees"><i class="fa fa-angle-double-right icon"></i> {{ config('app.name') }} Fees</a>
                            </span>
                            <span class="m-l-20 col-md-3">
                                - {{$finance->order_eshopping_fee}}
                            </span>
                        </div>

                        <div id="to_collapse">

                            <div class="m-b-20 row">
                                <span class="m-r-20 font-bold col-md-3">

                                </span>
                                <span class="m-l-20 m-r-20 col-md-4" style="text-align: center;">
                                    <a href="{{route('admin.transaction.overview', ['transaction_type' => 'commission_fee', 'year' => $finance->year,'month' => $finance->month, 'seller_id' => $finance->seller_id])}}" style="color:blue" target="_blank">Commission</a>

                                </span>
                                <span class="m-l-20 col-md-3">
                                    {{$finance->order_commission_fee}}
                                </span>
                            </div>

                            <div class="m-b-20 row">
                                <span class="m-r-20 font-bold col-md-3">

                                </span>
                                <span class="m-l-20 m-r-20 col-md-4" style="text-align: center;">
                                    <a href="{{route('admin.transaction.overview', ['transaction_type' => 'payment_fee', 'year' => $finance->year,'month' => $finance->month, 'seller_id' => $finance->seller_id])}}" style="color:blue" target="_blank">Payment Fees </a>

                                </span>
                                <span class="m-l-20 col-md-3">
                                    {{$finance->order_payment_fee}}
                                </span>
                            </div>

                            <div class="m-b-20 row">
                                <span class="m-r-20 font-bold col-md-3">

                                </span>
                                <span class="m-l-20 m-r-20 col-md-4" style="text-align: center;">
                                    <a href="{{route('admin.transaction.overview', ['transaction_type' => 'shipping_fee', 'year' => $finance->year,'month' => $finance->month, 'seller_id' => $finance->seller_id])}}" style="color:blue" target="_blank">Shipping Charge</a>

                                </span>
                                <span class="m-l-20 col-md-3">
                                    {{$finance->order_shipping_fee}}
                                </span>
                            </div>

                        </div>

                        <div class="m-b-20 row">
                            <span class="m-r-20 font-bold col-md-3">

                            </span>
                            <span class="m-l-20 m-r-20 col-md-4">
                                VAT
                            </span>
                            <span class="m-l-20 col-md-3">
                                - {{$finance->order_vat}}
                            </span>
                        </div>

                        <div class="m-b-20 row">
                            <span class="m-r-20 font-bold col-md-3">

                            </span>
                            <span class="m-l-20 m-r-20 col-md-4 font-bold" style="text-align: right;">
                                Subtotal
                            </span>
                            <span class="m-l-20 col-md-3">
                                {{$finance->order_subtotal}}
                            </span>
                        </div>
                        <hr>

                        <!-- refund -->
                        <div class="m-b-20 row">
                            <span class="m-r-20 font-bold col-md-3">
                                Refunds
                            </span>
                            <span class="m-l-20 m-r-20 col-md-4">
                                Item Charges
                            </span>
                            <span class="m-l-20 col-md-3">
                                - {{$finance->refund_item_charge}}
                            </span>
                        </div>

                        <div class="m-b-20 row">
                            <span class="m-r-20 font-bold col-md-3">

                            </span>
                            <span class="m-l-20 m-r-20 col-md-4">
                            <a id="eshopping_fees2">
                                <i class="fa fa-angle-double-right icon2"></i>
                                Eshopping Fees
                            </a>
                            </span>
                            <span class="m-l-20 col-md-3">
                                {{$finance->refund_eshopping_fee}}
                            </span>
                        </div>

                        <div id="to_collapse2">

                            <div class="m-b-20 row">
                                <span class="m-r-20 font-bold col-md-3">

                                </span>
                                <span class="m-l-20 m-r-20 col-md-4" style="text-align: center;">
                                    <a href="{{route('admin.transaction.overview', ['transaction_type' => 'reversal_commission_fee', 'year' => $finance->year,'month' => $finance->month, 'seller_id' => $finance->seller_id])}}" style="color:blue" target="_blank">Commission</a>

                                </span>
                                <span class="m-l-20 col-md-3">
                                    {{$finance->refund_reversal_commission_fee}}
                                </span>
                            </div>

                            <div class="m-b-20 row">
                                <span class="m-r-20 font-bold col-md-3">

                                </span>
                                <span class="m-l-20 m-r-20 col-md-4" style="text-align: center;">
                                    <a href="{{route('admin.transaction.overview', ['transaction_type' => 'payment_fee_credit', 'year' => $finance->year,'month' => $finance->month, 'seller_id' => $finance->seller_id])}}" style="color:blue" target="_blank">Payment Fees</a>

                                </span>
                                <span class="m-l-20 col-md-3">
                                    {{$finance->refund_payment_fee_credit}}
                                </span>
                            </div>

                        </div>

                        <div class="m-b-20 row">
                            <span class="m-r-20 font-bold col-md-3">

                            </span>
                            <span class="m-l-20 m-r-20 col-md-4">
                                VAT
                            </span>
                            <span class="m-l-20 col-md-3">
                                {{$finance->refund_vat}}
                            </span>
                        </div>

                        <div class="m-b-20 row">
                            <span class="m-r-20 font-bold col-md-3">

                            </span>
                            <span class="m-l-20 m-r-20 col-md-4 font-bold" style="text-align: right;">
                                Subtotal
                            </span>
                            <span class="m-l-20 col-md-3">
                                {{$finance->refund_subtotal}}
                            </span>
                        </div>

                        <!-- closing balance -->
                        <hr>
                        <div class="m-b-5 row">
                            <span class="m-r-20 font-bold col-md-3">
                                Closing Balance
                            </span>
                            <span class="m-l-20 m-r-20 col-md-4">
                                Total Balance
                            </span>
                            <span class="m-l-20 col-md-3">
                                {{$finance->closing_balance}}
                            </span>
                        </div>

                        <!-- payout -->
                        <hr>
                        <div class="m-b-5 row">
                            <span class="m-r-20 col-md-3">

                            </span>
                            <span class="m-l-20 font-bold m-r-20 col-md-4">
                                Payout
                            </span>
                            <span class="m-l-20 col-md-3">
                                {{$finance->payout}}
                            </span>
                        </div>

                        <!-- <ul class="list-unstyled m-t-10">
                            <li class="m-b-5" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2" style="cursor:pointer;">
                                <span class="m-r-20 font-bold col-md-3">

                                </span>
                                <span class="m-l-20 m-r-20 col-md-4">
                                    Eshopping Fees
                                </span>
                                <span class="m-l-20 col-md-3">
                                    - {{$finance->order_eshopping_fee}}
                                </span>
                            </li>
                            <li id="multiCollapseExample1" class="collapse multi-collapse">
                                <span class="font-strong">Email:</span>eshopping
                            </li>
                            <li id="multiCollapseExample2" class="collapse multi-collapse">
                                <span class="font-strong">Phone:</span>eshopping
                            </li>
                        </ul> -->

                    </div>
                </div>
                @else
                <h2>No Statement Available</h2>
                @endif
            </div>
        </div>


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
<div class="text-right">
    <button class="btn btn-info" type="button" onclick="printDiv()"><i class="fa fa-print"></i> Print</button>
</div>

@if($finance->payout <= 0) <div class="ibox">
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

<!-- END PAGE CONTENT-->

@stop

@section('footer')

<!-- COLLAPSE SCRIPT -->
<script>

$(document).ready(function(){
    $("#to_collapse").hide();
    $("#to_collapse2").hide();
    $("#eshopping_fees").on('click',function(){
        $(".icon").toggleClass("fa-angle-double-right").toggleClass("fa-angle-double-down");
        $("#to_collapse").toggle();
    });
    $("#eshopping_fees2").on('click',function(){
        $(".icon2").toggleClass("fa-angle-double-right").toggleClass("fa-angle-double-down");
        $("#to_collapse2").toggle();
    });
})

</script>

<script>
    $('#demo').on('shown.bs.collapse', function() {
        $(".icon").removeClass("fa-angle-right").addClass("fa-angle-down");
    });

    $('#demo').on('hidden.bs.collapse', function() {
        $(".icon").removeClass("fa-angle-down").addClass("fa-angle-right");
    });
</script>

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

@stop