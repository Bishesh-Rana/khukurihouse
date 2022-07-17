@section('title')

Deliveries | {{env('APP_NAME')}}

@stop

@extends('delivery.layouts.app')

@section('custom-css')
<link rel="stylesheet" href="{{ asset('customcss/custom.css') }}">
@endsection

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">
        <?php
        if (isset($delivery)) {
            echo 'Update';
        } else {
            echo 'Add';
        } ?> Information </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#"><i class="la la-home font-20"></i></a>
        </li>
    </ol>
</div>

<br />

@include('admin.layouts.error')
<form action="{{ route('delivery.form.update') }}" id="upload_form" class="form-horizontal" method="post" novalidate="novalidate" enctype="multipart/form-data">
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
                            <input class="form-control" type="text" name="first_name" placeholder="Enter your first name" value="<?php if (isset($delivery->first_name)) {
                                                                                                                                        echo $delivery->first_name;
                                                                                                                                    } else {
                                                                                                                                        echo old('first_name');
                                                                                                                                    } ?>">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Middle Name (Optional)</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" type="text" name="middle_name" placeholder="Enter your second name" value="<?php if (isset($delivery->middle_name)) {
                                                                                                                                        echo $delivery->middle_name;
                                                                                                                                    } else {
                                                                                                                                        echo old('middle_name');
                                                                                                                                    } ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Last Name</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" type="text" name="last_name" placeholder="Enter your last name" value="<?php if (isset($delivery->last_name)) {
                                                                                                                                    echo $delivery->last_name;
                                                                                                                                } else {
                                                                                                                                    echo old('last_name');
                                                                                                                                } ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Activite Holiday Mode</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <div class="check-list">

                                <label class="ui-radio ui-radio-primary">
                                    <input type="radio" name="holiday_mode" value="0" <?php echo (isset($delivery->holiday_mode) ? ((isset($delivery->holiday_mode) && ($delivery->holiday_mode == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                    <span class="input-span"></span>
                                    OFF
                                </label>
                                <label class="ui-radio ui-radio-primary">
                                    <input type="radio" name="holiday_mode" value="1" <?php echo (isset($delivery->holiday_mode) && ($delivery->holiday_mode == 1)) ? 'checked="checked"' : ''; ?>>
                                    <span class="input-span"></span>
                                    ON
                                </label>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    {{-- /. Basic Information --}}


    {{-- Company information --}}
    <div class="row">
        <div class="col-md-12">
            <div class="ibox ibox-success">
                <div class="ibox-head custom-heading">
                    <div class="ibox-title top-heading">Company information</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        <a class="fullscreen-link"><i class="fa fa-expand"></i></a>

                    </div>
                </div>
                <div class="ibox-body">

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Company Legal Name</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" type="text" name="company_name" placeholder="Enter your company name" value="<?php if (isset($delivery->company_name)) {
                                                                                                                                            echo $delivery->company_name;
                                                                                                                                        } else {
                                                                                                                                            echo old('company_name');
                                                                                                                                        } ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Company Website (Optional)</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" type="text" name="company_website" placeholder="Company Website Link" value="<?php if (isset($delivery->company_website)) {
                                                                                                                                            echo $delivery->company_website;
                                                                                                                                        } else {
                                                                                                                                            echo old('company_website');
                                                                                                                                        } ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Phone</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" type="text" name="company_phone" placeholder="Enter your phone number" value="<?php if (isset($delivery->company_phone)) {
                                                                                                                                            echo $delivery->company_phone;
                                                                                                                                        } else {
                                                                                                                                            echo old('company_phone');
                                                                                                                                        } ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Company Image</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <div class="custom-file" style="width:40%">
                                <input type="file" name="image" id="pro_image">
                            </div>
                            @if (!empty($delivery->image))
                            <hr>
                            <img id="company-image" src="{{ asset('uploads/deliveries/'.$delivery->image) }}" alt="<?php if (isset($delivery->company_name)) {
                                                                                                                        echo $delivery->company_name;
                                                                                                                    } ?>" height="100" width="100">
                            <a title="Delete" id="delete" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></a>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label"> Company Short Description</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <textarea class="form-control m-input ckeditor" name="company_description" rows="5" placeholder="Discribe your company in short"><?php if (isset($delivery->company_description)) {
                                                                                                                                                                    echo $delivery->company_description;
                                                                                                                                                                } else {
                                                                                                                                                                    echo old('company_description');
                                                                                                                                                                } ?></textarea>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    {{-- /.Company information --}}

    {{-- Contact Address Info --}}
    <div class="row">
        <div class="col-md-12">
            <div class="ibox ibox-success">
                <div class="ibox-head custom-heading">
                    <div class="ibox-title top-heading">Contact Address Information</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        <a class="fullscreen-link"><i class="fa fa-expand"></i></a>

                    </div>
                </div>
                <div class="ibox-body">

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Country</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <select class="form-control select2_demo_1" name="company_country">
                                @foreach($countries as $row)
                                <option <?php if (isset($delivery) && $row->name == $delivery->company_country) {
                                            echo "selected";
                                        } ?> value="{{ $row->name }}">{{ ucwords($row->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">City</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" type="text" name="company_city" placeholder="Enter your city name" value="<?php if (isset($delivery->company_city)) {
                                                                                                                                        echo $delivery->company_city;
                                                                                                                                    } else {
                                                                                                                                        echo old('company_city');
                                                                                                                                    } ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">State</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" type="text" name="company_state" placeholder="Enter your state name" value="<?php if (isset($delivery->company_state)) {
                                                                                                                                        echo $delivery->company_state;
                                                                                                                                    } else {
                                                                                                                                        echo old('company_state');
                                                                                                                                    } ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Zip Code</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" type="text" name="zip_code" placeholder="Enter your country zip code" value="<?php if (isset($delivery->zip_code)) {
                                                                                                                                            echo $delivery->zip_code;
                                                                                                                                        } else {
                                                                                                                                            echo old('zip_code');
                                                                                                                                        } ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Address</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" type="text" name="company_address" placeholder="Enter your address" value="<?php if (isset($delivery->company_address)) {
                                                                                                                                        echo $delivery->company_address;
                                                                                                                                    } else {
                                                                                                                                        echo old('company_address');
                                                                                                                                    } ?>">
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    {{-- /. Contact Address Info --}}


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
                            <input class="form-control" type="text" name="bank_name" placeholder="Enter bank name of your account" value="<?php if (isset($delivery->bank_name)) {
                                                                                                                                                echo $delivery->bank_name;
                                                                                                                                            } else {
                                                                                                                                                echo old('bank_name');
                                                                                                                                            } ?>">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Bank Account Number</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" type="text" name="bank_acc_number" placeholder="Enter your bank account number" value="<?php if (isset($delivery->bank_acc_number)) {
                                                                                                                                                    echo $delivery->bank_acc_number;
                                                                                                                                                } else {
                                                                                                                                                    echo old('bank_acc_number');
                                                                                                                                                } ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Pan no.</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" type="text" name="pan_no" placeholder="Enter Pan Number" value="<?php if (isset($delivery->pan_no)) {
                                                                                                                            echo $delivery->pan_no;
                                                                                                                        } else {
                                                                                                                            echo old('pan_no');
                                                                                                                        } ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Vat no.</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" type="text" name="vat_no" placeholder="Enter Vat Number" value="<?php if (isset($delivery->vat_no)) {
                                                                                                                            echo $delivery->vat_no;
                                                                                                                        } else {
                                                                                                                            echo old('vat_no');
                                                                                                                        } ?>">
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
                            <input class="form-control" type="text" name="email" placeholder="Enter your email address" value="<?php if (isset($delivery->email)) {
                                                                                                                                    echo $delivery->email;
                                                                                                                                } else {
                                                                                                                                    echo old('email');
                                                                                                                                } ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Password</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" type="password" name="password" placeholder="Enter Password">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label class="product-form-label">Confirm Password</label>
                        </div>

                        <div class="col-sm-10 form-group">
                            <input class="form-control" type="password" name="password_confirmation" placeholder="Password Confirmation">
                        </div>
                    </div>



                </div>

            </div>
        </div>
    </div>
    {{-- /. Administration  --}}
    <button class="btn btn-info" type="submit">Submit</button>
    <a class="btn btn-warning" href="{{ route('delivery.dashboard') }}">Cancel</a>

</form>


<!-- END PAGE CONTENT-->
@stop

@section('footer')

<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

<script>
    CKEDITOR.replace('ckeditor', {
        filebrowserBrowseUrl: 'vendor/responsive_filemanager/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
        filebrowserUploadUrl: 'vendor/responsive_filemanager/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
        filebrowserImageBrowseUrl: 'vendor/responsive_filemanager/filemanager/dialog.php?type=1&editor=ckeditor&fldr='
    });
</script>

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



<!-- Dynamic Forms jQuery -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        $('#pro_image').change(function(e) {
            e.preventDefault();
            var formData = new FormData(upload_form);
            $.ajax({
                url: "{{route('delivery.deliveryimage')}}",
                method: "POST",
                data: formData,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(resp) {
                    if (resp.status == 'success') {
                        Lobibox.notify(resp.status, {
                            showClass: 'fadeInDown',
                            hideClass: 'fadeUpDown',
                            width: 400,
                            msg: resp.message,
                            delay: 3000,
                        });
                    } else {
                        Lobibox.notify(resp.status, {
                            showClass: 'fadeInDown',
                            hideClass: 'fadeUpDown',
                            width: 400,
                            msg: resp.message['image'],
                            delay: 3000,
                        });
                        $(".dropify-clear").click();
                    }
                },
                error: function(resp) {
                    Lobibox.notify('default', {
                        continueDelayOnInactiveTab: true,
                        size: 'mini',
                        delayIndicator: false,
                        msg: 'Internal Server Error.'
                    });
                    $(".dropify-clear").click();
                }
            });
        });
    });

    $(document).ready(function() {
        $('#this-one').prop("disabled", true);
    });
</script>

<!-- Delete(Hide) image -->
<script>
    $(document).ready(function() {
        $('a#delete').click(function() {
            $('img#company-image').hide();
            $('a#delete').hide();
        })
    });
</script>


@include('admin.layouts.tinymce')

@stop