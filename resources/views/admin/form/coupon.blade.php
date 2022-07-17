@section('title')

Coupons | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Coupons</h1>
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
                <?php if (isset($coupon)) {
                    echo "Edit";
                } else {
                    echo "Add";
                } ?> Coupon
            </div>
            <div class="ibox-tools">
                <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
            </div>
        </div>
        <div class="ibox-body">
            @include('admin.layouts.error')

            <?php
            if (isset($coupon)) {
                $action = url('/ns-admin/coupons/edit/' . $coupon->id);
                $button = 'Update';
            } else {
                $action = url('/ns-admin/coupons/add');
                $button = 'Add';
            } ?>
            <form action="{{$action}}" id="upload_form" class="form-horizontal" method="post" novalidate="novalidate" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">
                            <label>Coupon Name</label>
                            <input type="text" name="coupon_name" class="form-control" placeholder="Coupon Name" value="<?php if (isset($coupon->coupon_name)) {
                                                                                                                            echo $coupon->coupon_name;
                                                                                                                        } else {
                                                                                                                            echo old('coupon_name');
                                                                                                                        } ?>">
                        </div>

                        <div class="form-group">
                            <label>Coupon Code</label>
                            <input type="text" name="coupon_code" class="form-control" placeholder="Coupon Code" value="<?php if (isset($coupon->coupon_code)) {
                                                                                                                            echo $coupon->coupon_code;
                                                                                                                        } else {
                                                                                                                            echo old('coupon_code');
                                                                                                                        } ?>">
                        </div>

                        <div class="form-group">
                            <label>Discount Price</label>
                            <input type="text" name="discount_price" class="form-control" placeholder="Discount Price" value="<?php if (isset($coupon->discount_price)) {
                                                                                                                            echo $coupon->discount_price;
                                                                                                                        } else {
                                                                                                                            echo old('discount_price');
                                                                                                                        } ?>">
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" name="start_date" class="form-control" placeholder="Start Date" value="<?php if (isset($coupon->start_date)) {
                                                                                                                            echo $coupon->start_date;
                                                                                                                        } else {
                                                                                                                            echo old('start_date');
                                                                                                                        } ?>">
                        </div>

                        <div class="form-group">
                            <label>End Date</label>
                            <input type="date" name="end_date" class="form-control" placeholder="End Date" value="<?php if (isset($coupon->end_date)) {
                                                                                                                            echo $coupon->end_date;
                                                                                                                        } else {
                                                                                                                            echo old('end_date');
                                                                                                                        } ?>">
                        </div>



                        <div class="check-list">
                            <label for="">Status</label>
                            <label class="ui-radio ui-radio-primary">
                                <input type="radio" name="publish_status" value="0" <?php echo (isset($coupon->publish_status) ? ((isset($coupon->publish_status) && ($coupon->publish_status == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                <span class="input-span"></span>Inactive
                            </label>
                            <label class="ui-radio ui-radio-primary">
                                <input type="radio" name="publish_status" value="1" <?php echo (isset($coupon->publish_status) && ($coupon->publish_status == 1)) ? 'checked="checked"' : ''; ?>>
                                <span class="input-span"></span>Active
                            </label>
                        </div>

                    </div>
                </div>
                
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group m-form__group">
                            <label for="description">
                                Coupon Description
                            </label>
                            <textarea class="form-control m-input ckeditor" id="my-editor" name="coupon_description" rows="10" placeholder="Coupon Description"><?php if (isset($coupon->coupon_description)) {
                                                                                                                                        echo $coupon->coupon_description;
                                                                                                                                    } else {
                                                                                                                                        echo old('coupon_description');
                                                                                                                                    } ?></textarea>
                        </div>
                    </div>
                </div>

                <button class="btn btn-info" type="submit">Submit</button>
                <a class="btn btn-warning" href="{{ url('ns-admin/coupons') }}">Cancel</a>

            </form>

        </div>
    </div>
</div>

@endsection

@section('footer')

@include('admin.layouts.ckeditor')

@stop