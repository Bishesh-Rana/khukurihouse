@section('title')

Affiliate | {{env('APP_NAME')}}

@stop

@extends('affiliate.layouts.app')

@section('custom-css')
<link rel="stylesheet" href="{{ asset('customcss/custom.css') }}">
@endsection

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">  
        <?php
        if (isset($affiliate)) {
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
    
    <br/>
    
    @include('admin.layouts.error')
    <form action="{{ route('affiliate.profile.update') }}" id="upload_form" class="form-horizontal" method="post" novalidate="novalidate" enctype="multipart/form-data">
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
                                } ?>">
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
                                } ?>">
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
                                } ?>">
                            </div>    
                        </div>

                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label class="product-form-label">Address</label>
                            </div>
                            
                            <div class="col-sm-10 form-group">
                                <input class="form-control" type="text" name="address" placeholder="Enter your address" value="<?php if (isset($affiliate->address)) {
                                    echo $affiliate->address;
                                } else {
                                    echo old('address');
                                } ?>">
                            </div>    
                        </div>   

                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label class="product-form-label">Phone</label>
                            </div>
                            
                            <div class="col-sm-10 form-group">
                                <input class="form-control" type="text" name="phone" placeholder="Enter your phone number" value="<?php if (isset($affiliate->phone)) {
                                    echo $affiliate->phone;
                                } else {
                                    echo old('phone');
                                } ?>">
                            </div>    
                        </div>

                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label class="product-form-label">Image</label>
                            </div>
                            
                            <div class="col-sm-10 form-group">
                                <div class="custom-file" style="width:40%">
                                    <input type="file" name="image" id="pro_image">
                                </div>
                                @if (!empty($affiliate->image))
                                <hr>
                                <img id="company-image" src="{{ asset('uploads/'.'affiliates/'.$affiliate->image) }}" alt="<?php if (isset($affiliate->first_name)) {
                                                                                                        echo $affiliate->first_name;
                                                                                                    } ?>" height="100" width="100">
                                <a title="Delete" id="delete" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></a>
                                @endif
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
                                } ?>">
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
                                } ?>">
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
                                } ?>">
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
                                } ?>">
                            </div>    
                        </div> 

                        
                        
                    </div>
                    
                </div>
            </div>
        </div>
        {{-- /.Bank Detail --}}


        {{--  Administration  --}}
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
                                <input class="form-control" type="text" name="email" placeholder="Enter your email address" value="<?php if (isset($affiliate->email)) {
                                    echo $affiliate->email;
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
        <a class="btn btn-warning" href="{{ route('affiliate.dashboard') }}">Cancel</a>
        
    </form>
    
    
<!-- END PAGE CONTENT-->
@stop
    
@section('footer')

<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

<script>
    CKEDITOR.replace( 'ckeditor' ,{
        filebrowserBrowseUrl : 'vendor/responsive_filemanager/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
        filebrowserUploadUrl : 'vendor/responsive_filemanager/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
        filebrowserImageBrowseUrl : 'vendor/responsive_filemanager/filemanager/dialog.php?type=1&editor=ckeditor&fldr='
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
                url: "{{URL::route('affiliate.affiliate.image')}}",
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
    
    $(document).ready(function(){
        $('#this-one').prop("disabled", true);
    });
</script>

<!-- Delete(Hide) image -->
<script>
    $(document).ready(function() {
        $('a#delete').click(function(){
            $('img#company-image').hide();
            $('a#delete').hide();
        })
    });
</script>

    
@include('admin.layouts.tinymce')

@stop