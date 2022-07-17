@section('title')

Dashboard | {{env('APP_NAME')}}

@stop
@extends('seller.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-content fade-in-up">
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-success color-white widget-stat">
                <a href="{{ route('seller.product.index') }}">
                    <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">{{ $all }}</h2>
                        <div class="m-b-5">All Product</div><i class="ti-shopping-cart widget-stat-icon"></i>
                        <div><i class="fa fa-level-up m-r-5"></i></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-info color-white widget-stat">
                <a href="{{ route('seller.product.live') }}">
                <div class="ibox-body">
                <h2 class="m-b-5 font-strong">{{ $live }}</h2>
                    <div class="m-b-5">LIVE PRODUCT</div><i class="ti-bar-chart widget-stat-icon"></i>
                    <div><i class="fa fa-level-up m-r-5"></i></div>
                </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-warning color-white widget-stat">
            <a href="{{ route('seller.product.noimage') }}">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">{{ $missing_image }}</h2>
                    <div class="m-b-5">Image Missing</div><i class="ti-image widget-stat-icon"></i>
                    <div><i class="fa fa-level-up m-r-5"></i></div>
                </div>
            </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-danger color-white widget-stat">
            <a href="{{ route('seller.product.poorquality') }}">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">{{ $poor_quality }}</h2>
                    <div class="m-b-5">POOR QUALITY</div><i class="ti-widget widget-stat-icon"></i>
                    <div><i class="fa fa-level-down m-r-5"></i></div>
                </div>
            </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-success color-white widget-stat">
            <a href="{{ route('seller.product.soldout') }}">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">{{ $sold_out }}</h2>
                    <div class="m-b-5">SOLD OUT PRODUCT</div><i class="ti-pie-chart widget-stat-icon"></i>
                    <div><i class="fa fa-level-up m-r-5"></i></div>
                </div>
            </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-info color-white widget-stat">
            <a href="{{ route('seller.product.inactive') }}">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">{{ $inactive }}</h2>
                    <div class="m-b-5">INACTIVE PRODUCT</div><i class="ti-info-alt widget-stat-icon"></i>
                    <div><i class="fa fa-level-up m-r-5"></i></div>
                </div>
            </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-warning color-white widget-stat">
            <a href="{{ route('seller.product.policyviolation') }}">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">{{ $policy_violation }}</h2>
                    <div class="m-b-5">POLICY VIOLATION</div><i class="ti-alert widget-stat-icon"></i>
                    <div><i class="fa fa-level-up m-r-5"></i></div>
                </div>
            </a>
            </div>
        </div>
        {{-- <div class="col-lg-3 col-md-6">
            <div class="ibox bg-danger color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">108</h2>
                    <div class="m-b-5">NE</div><i class="ti-user widget-stat-icon"></i>
                    <div><i class="fa fa-level-down m-r-5"></i><small>-12% Lower</small></div>
                </div>
            </div>
        </div> --}}
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