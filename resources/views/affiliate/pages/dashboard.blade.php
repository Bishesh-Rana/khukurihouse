@section('title')

Affiliate Dashboard | {{env('APP_NAME')}}

@stop
@extends('affiliate.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-content fade-in-up">
    <h5>Products</h5>
    <hr>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-success color-white widget-stat">
                <a href="{{route('affiliate.product.index')}}">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{$totalProducts}}</h2>
                        <div class="m-b-5">Total PRODUCTS</div><i class="ti-package widget-stat-icon"></i>
                        <div><i class="fa fa-level-up m-r-5"></i>View All</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-info color-white widget-stat">
                <a href="{{route('affiliate.product.sold')}}">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{$totalSoldProducts}}</h2>
                        <div class="m-b-5">Total SOLD PRODUCTS</div><i class="ti-shopping-cart widget-stat-icon"></i>
                        <div><i class="fa fa-level-up m-r-5"></i>View All</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-warning color-white widget-stat">
                <a href="{{route('affiliate.product.cancelled')}}">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{$totalCancelledProducts}}</h2>
                        <div class="m-b-5">Total CANCELLED PRODUCTS</div><i class="ti-back-left widget-stat-icon"></i>
                        <div><i class="fa fa-level-up m-r-5"></i>View All</div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <h5>Finance</h5>
    <hr>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-grey color-white widget-stat">
                <a href="{{route('affiliate.view.transaction.overview')}}">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">.</h2>
                        <div class="m-b-5">TRANSACTION OVERVIEW</div><i class="ti-bar-chart widget-stat-icon"></i>
                        <div><i class="fa fa-level-up m-r-5"></i>View</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-teal color-white widget-stat">
                <a href="{{route('affiliate.financial.overview')}}">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">.</h2>
                        <div class="m-b-5">FINANCIAL OVERVIEW</div><i class="ti-bar-chart widget-stat-icon"></i>
                        <div><i class="fa fa-level-up m-r-5"></i>View</div>
                    </div>
                </a>
            </div>
        </div>

    </div>

    <style>
        .visitors-table tbody tr td:last-child {
            display: flex;
            align-items: center;
        }

        .visitors-table .progress {
            flex: 1;
        }

        .visitors-table .progress-parcent {
            text-align: right;
            margin-left: 10px;
        }
    </style>

</div>
<!-- END PAGE CONTENT-->

@stop