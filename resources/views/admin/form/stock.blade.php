@section('title')

Stocks | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Stocks</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">
                Add Stock
            </div>
            <div class="ibox-tools">
                <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
            </div>
        </div>
        <div class="ibox-body">
            @include('admin.layouts.error')

            <form action="{{url('/ns-admin/stocks/edit/' . $stock->id)}}" id="form-sample-1" class="form-horizontal" method="post" novalidate="novalidate" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>New Stock</label>
                            <input class="form-control" type="number" min="0" name="new_stock" placeholder="Enter New Stock" value="<?php if (isset($stock->new_stock)) {
                                                                                                                                echo $stock->new_stock;
                                                                                                                            } else {
                                                                                                                                echo old('new_stock');
                                                                                                                            } ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Withholding Stock</label>
                            <input class="form-control" type="number" min="0" name="withholding_stock" placeholder="Enter Withholding Stock" value="<?php if (isset($stock->withholding_stock)) {
                                                                                                                                echo $stock->withholding_stock;
                                                                                                                            } else {
                                                                                                                                echo old('new_stock');
                                                                                                                            } ?>" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Damaged Stock</label>
                            <input class="form-control" type="number" min="0" name="damaged_stock" placeholder="Enter Damaged Stock" value="<?php if (isset($stock->damaged_stock)) {
                                                                                                                                        echo $stock->damaged_stock;
                                                                                                                                    } else {
                                                                                                                                        echo old('damaged_stock');
                                                                                                                                    } ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Delivered Stock</label>
                            <input class="form-control" type="number" min="0" name="delivered_stock" placeholder="Enter Delivered Stock" value="<?php if (isset($stock->delivered_stock)) {
                                                                                                                                        echo $stock->delivered_stock;
                                                                                                                                    } else {
                                                                                                                                        echo old('delivered_stock');
                                                                                                                                    } ?>" required>
                        </div>
                        
                    </div>

                    <div class="col-md-6">
                    <div class="form-group">
                            <label>Return Sellable Stock</label>
                            <input class="form-control" type="number" min="0" name="returned_stock" placeholder="Enter Sellable Return Stock" value="<?php if (isset($stock->returned_stock)) {
                                                                                                                                        echo $stock->returned_stock;
                                                                                                                                    } else {
                                                                                                                                        echo old('returned_stock');
                                                                                                                                    } ?>" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                    <div class="form-group">
                            <label>Return Damaged Stock</label>
                            <input class="form-control" type="number" min="0" name="returned_damage_stock" placeholder="Enter Damaged Return Stock" value="<?php if (isset($stock->returned_damage_stock)) {
                                                                                                                                        echo $stock->returned_damage_stock;
                                                                                                                                    } else {
                                                                                                                                        echo old('returned_damage_stock');
                                                                                                                                    } ?>" required>
                        </div>
                    </div>
                </div>
                <button class="btn btn-info" type="submit">Submit</button>
                <a class="btn btn-warning" href="{{ url('ns-admin/stocks') }}">Cancel</a>

            </form>

        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->

@stop

@section('footer')

<!-- FOR FORM VALIDATION -->
<!-- <script type="text/javascript">
    $("#form-sample-1").validate({
        rules: {
            name: {
                minlength: 2,
                required: !0
            },
            email: {
                required: !0,
                email: !0
            },
            url: {
                required: !0,
                url: !0
            },
            // number: {
            //     required: !0,
            //     number: !0
            // },
            // min: {
            //     required: !0,
            //     minlength: 3
            // },
            // max: {
            //     required: !0,
            //     maxlength: 4
            // },
            // password: {
            //     required: !0
            // },
            // password_confirmation: {
            //     required: !0,
            //     equalTo: "#password"
            // }
        },
        errorClass: "help-block error",
        highlight: function(e) {
            $(e).closest(".form-group.row").addClass("has-error")
        },
        unhighlight: function(e) {
            $(e).closest(".form-group.row").removeClass("has-error")
        },
    });
</script> -->

@stop