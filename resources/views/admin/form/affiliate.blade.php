@section('title')

Affiliates | {{env('APP_NAME')}}

@stop

@extends('admin.layouts.app')

@section('custom-css')
<link rel="stylesheet" href="{{ asset('customcss/custom.css') }}">
@endsection

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">
        <?php
        if (isset($affiliate)) {
            $action = url('/ns-admin/affiliates/edit/' . $affiliate->id);
            $button = 'Update';
        } else {
            $action = url('/ns-admin/affiliates/add');
            $button = 'Add';
        } ?>
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#"><i class="la la-home font-20"></i></a>
        </li>
    </ol>
</div>

<br />

@include('admin.layouts.error')
<form action="{{$action}}" id="upload_form" class="form-horizontal" method="post" novalidate="novalidate" enctype="multipart/form-data">
    @csrf

    {{-- Basic Information --}}
    <div class="row">
        <div class="col-md-12">
            <div class="ibox ibox-success">
                <div class="ibox-head custom-heading">
                    <div class="ibox-title top-heading">Basic Information</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        <a class="fullscreen-link"><i class="fa fa-expand"></i></a>

                    </div>
                </div>
                <div class="ibox-body">

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">First Name</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" type="text" name="first_name" placeholder="Enter your first name" value="<?php if (isset($affiliate->first_name)) {
                                                                                                                                        echo $affiliate->first_name;
                                                                                                                                    } else {
                                                                                                                                        echo old('first_name');
                                                                                                                                    } ?>" readonly>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Middle Name (Optional)</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" type="text" name="middle_name" placeholder="Enter your second name" value="<?php if (isset($affiliate->middle_name)) {
                                                                                                                                        echo $affiliate->middle_name;
                                                                                                                                    } else {
                                                                                                                                        echo old('middle_name');
                                                                                                                                    } ?>" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Last Name</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" type="text" name="last_name" placeholder="Enter your last name" value="<?php if (isset($affiliate->last_name)) {
                                                                                                                                    echo $affiliate->last_name;
                                                                                                                                } else {
                                                                                                                                    echo old('last_name');
                                                                                                                                } ?>" readonly>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    {{-- /. Basic Information --}}

    {{-- Bank Detail --}}
    <div class="row">
        <div class="col-md-12">
            <div class="ibox ibox-success">
                <div class="ibox-head custom-heading">
                    <div class="ibox-title top-heading">Bank Detail</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        <a class="fullscreen-link"><i class="fa fa-expand"></i></a>

                    </div>
                </div>
                <div class="ibox-body">

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Bank Name </label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" type="text" name="bank_name" placeholder="Enter bank name of your account" value="<?php if (isset($affiliate->bank_name)) {
                                                                                                                                                echo $affiliate->bank_name;
                                                                                                                                            } else {
                                                                                                                                                echo old('bank_name');
                                                                                                                                            } ?>" readonly>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Bank Account Number</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" type="text" name="bank_acc_number" placeholder="Enter your bank account number" value="<?php if (isset($affiliate->bank_acc_number)) {
                                                                                                                                                    echo $affiliate->bank_acc_number;
                                                                                                                                                } else {
                                                                                                                                                    echo old('bank_acc_number');
                                                                                                                                                } ?>" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Pan no.</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" type="text" name="pan_no" placeholder="Enter Pan Number" value="<?php if (isset($affiliate->pan_no)) {
                                                                                                                            echo $affiliate->pan_no;
                                                                                                                        } else {
                                                                                                                            echo old('pan_no');
                                                                                                                        } ?>" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Vat no.</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" type="text" name="vat_no" placeholder="Enter Vat Number" value="<?php if (isset($affiliate->vat_no)) {
                                                                                                                            echo $affiliate->vat_no;
                                                                                                                        } else {
                                                                                                                            echo old('vat_no');
                                                                                                                        } ?>" readonly>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    {{-- /.Bank Detail --}}



    {{-- Administration  --}}
    <div class="row">
        <div class="col-md-12">
            <div class="ibox ibox-success">
                <div class="ibox-head custom-heading">
                    <div class="ibox-title top-heading">Administration </div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        <a class="fullscreen-link"><i class="fa fa-expand"></i></a>

                    </div>
                </div>
                <div class="ibox-body">

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Email</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" type="email" name="email" placeholder="Enter your email address" value="<?php if (isset($affiliate->email)) {
                                                                                                                                    echo $affiliate->email;
                                                                                                                                } else {
                                                                                                                                    echo old('email');
                                                                                                                                } ?>" readonly>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    {{-- /. Administration  --}}


    {{-- Finance  --}}
    <div class="row">
        <div class="col-md-12">
            <div class="ibox ibox-success">
                <div class="ibox-head custom-heading">
                    <div class="ibox-title top-heading">Finance </div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                    </div>
                </div>
                <div class="ibox-body">

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Commission (In %)</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" type="text" name="commission" placeholder="Enter commission for this seller" value="<?php if (isset($affiliate->commission)) {
                                                                                                                                                echo $affiliate->commission;
                                                                                                                                            } else {
                                                                                                                                                echo old('commission');
                                                                                                                                            } ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Publish Status</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <div class="check-list">

                                <label class="ui-radio ui-radio-primary">
                                    <input type="radio" name="publish_status" value="0" <?php echo (isset($affiliate->publish_status) ? ((isset($affiliate->publish_status) && ($affiliate->publish_status == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                    <span class="input-span"></span>
                                    Banned
                                </label>
                                <label class="ui-radio ui-radio-primary">
                                    <input type="radio" name="publish_status" value="1" <?php echo (isset($affiliate->publish_status) && ($affiliate->publish_status == 1)) ? 'checked="checked"' : ''; ?>>
                                    <span class="input-span"></span>
                                    Active
                                </label>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    {{-- /. Finance  --}}



    <button class="btn btn-info" type="submit">{{$button}}</button>
    <a class="btn btn-warning" href="{{ url('ns-admin/affiliates') }}">Cancel</a>

</form>


<!-- END PAGE CONTENT-->
@stop

@section('footer')

<!-- FOR FORM VALIDATION -->
<script type="text/javascript">
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
            number: {
                required: !0,
                number: !0
            },
            min: {
                required: !0,
                minlength: 3
            },
            max: {
                required: !0,
                maxlength: 4
            },
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
</script>

@include('admin.layouts.ckeditor')

@stop