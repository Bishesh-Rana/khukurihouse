@section('title')

Affiliate Financial Overview | Admin | {{env('APP_NAME')}}

@stop

@extends('affiliate.layouts.app')


@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Financial Overview</h1>
    <ol class="breadcrumb">
        <form action="{{route('affiliate.view.monthly.statement')}}" method="post">
            @csrf
            <div class="row">

                <div class="form-group col-sm-8">
                    <label>For the Month</label>
                    <input type="month" class="form-control" id="month" name="month" value="2020-01">
                </div>
                <!-- <select class="form-control select2_demo_1" name="month" required>
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
                    </select> -->
                <div class="col-sm-4">
                <label>Click to view</label>

                    <button class="btn btn-outline-primary">View</button>
                </div>
                <!-- </div> -->
            </div>
        </form>
    </ol>
</div>

@if(isset($finance))
<div class="ibox">
    <div class="ibox-head">
        <div class="ibox-title">
        Statement For the Month of @if(isset($forTheMonth))for {{$forTheMonth}}@endif
        </div>
    </div>
</div>
@endif

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
                                Commission
                            </span>
                            <span class="m-l-20 m-r-20 col-md-4">
                            <a href="{{route('affiliate.transaction.overview', ['year' => $finance->year,'month' => $finance->month])}}" style="color:blue" target="_blank">Total Commission</a>
                            </span>
                            <span class="m-l-20 col-md-3">
                                {{$finance->commission_earned}}
                            </span>
                        </div>

                        <!-- refund -->
                        <div class="m-b-20 row">
                            <span class="m-r-20 font-bold col-md-3">
                                Reversal Commission
                            </span>
                            <span class="m-l-20 m-r-20 col-md-4">
                            <a href="{{route('affiliate.refund.transaction.overview', ['year' => $finance->year,'month' => $finance->month])}}" style="color:blue" target="_blank">Reversal Commission</a>
                            </span>
                            <span class="m-l-20 col-md-3">
                                {{$finance->commission_refund}}
                            </span>
                        </div>
                        

                        <!-- closing balance -->
                        <hr>
                        <div class="m-b-5 row">
                            <span class="m-r-20 font-bold col-md-3">
                                <!-- Closing Balance -->
                            </span>
                            <span class="m-l-20 m-r-20 col-md-4">
                                Total Balance
                            </span>
                            <span class="m-l-20 col-md-3">
                                {{$finance->opening_balance+$finance->commission_earned-$finance->commission_refund}}
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
                        <hr>
                        <div class="m-b-5 row">
                            <span class="m-r-20 font-bold col-md-3">
                                <!-- Closing Balance -->
                            </span>
                            <span class="m-l-20 m-r-20 col-md-4">
                                Closing Balance
                            </span>
                            <span class="m-l-20 col-md-3">
                                {{$finance->closing_balance}}
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
                <h2>No Statement Available @if(isset($forTheMonth))for {{$forTheMonth}}@endif</h2>
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