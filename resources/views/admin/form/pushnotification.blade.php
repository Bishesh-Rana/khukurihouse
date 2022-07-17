@section('title')

PushNotifications | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">PushNotifications</h1>
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
                <?php if (isset($pushnotification)) {
                    echo "Edit PushNotification";
                } else {
                    echo "Add PushNotification";
                } ?>
            </div>
            <div class="ibox-tools">
                <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
            </div>
        </div>
        <div class="ibox-body">
            @include('admin.layouts.error')
            
            <?php
            if (isset($pushnotification)) {
                $action = url('/ns-admin/pushnotifications/edit/' . $pushnotification->id);
                $button = 'Update';
            } else {
                $action = url('/ns-admin/pushnotifications/add');
                $button = 'Add';
            } ?>
            <form action="{{$action}}" id="upload_form" class="form-horizontal" method="post" novalidate="novalidate" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" type="text" name="title" placeholder="Enter the title" value="<?php if (isset($pushnotification->title)) {
                                echo $pushnotification->title;
                            } else {
                                echo old('title');
                            } ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="description">
                                Description
                            </label>
                            <textarea class="form-control ckeditor" name="description" rows="5" placeholder=""><?php if (isset($pushnotification->description)) {
                                echo $pushnotification->description;
                            } else {
                                echo old('description');
                            } ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Slug</label>
                            <input class="form-control" type="text" name="slug" placeholder="Enter the Url" value="<?php if (isset($pushnotification->slug)) {
                                echo $pushnotification->slug;
                            } else {
                                echo old('slug');
                            } ?>">
                        </div>
                        
                    </div>
                    
                    <div class="col-md-6">
                        
                        <div class="form-group">
                            <label>External Link</label>
                            <input class="form-control" type="text" name="external_url" placeholder="Enter the External Url" value="<?php if (isset($pushnotification->external_url)) {
                                echo $pushnotification->external_url;
                            } else {
                                echo old('external_url');
                            } ?>">
                        </div>
                        
                        <div class="form-group">
                            <label>Image</label>

                            <div></div>
                            <div class="custom-file" style="width:40%">
                                <input type="file" name="image" id="pro_image">
                                <div><br></div>
                                <img src="" id="profile-img-tag" width="100px" height="58px" style="display:none;" />
                            </div>

                            @if (!empty($pushnotification->image))
                            <br>
                            <img id="profile" src="{{ asset('uploads/'.'pushnotifications/'.$pushnotification->image) }}" alt="<?php if (isset($pushnotification->title)) {
                                echo $pushnotification->title;
                            } ?>" height="100" width="200">
                            <a title="Delete" id="delete" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></a>
                            @endif
                        </div>
                        <div><br></div>
                        
                        <div class="form-group">
                            <label class="control-label">Notification Type</label>
                            <select name="type" class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1">
                                <option <?php if (isset($pushnotification) && $pushnotification->type === 'product') {
                                            echo "selected";
                                        } ?> value="product">Product</option>
                                <option <?php if (isset($pushnotification) && $pushnotification->type === 'news') {
                                            echo "selected";
                                        } ?> value="news">News</option>
                                <option <?php if (isset($pushnotification) && $pushnotification->type === 'coupons') {
                                            echo "selected";
                                        } ?> value="coupons">Coupon</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <button class="btn btn-info" type="submit">Submit</button>
                <a class="btn btn-warning" href="{{ url('ns-admin/pushnotifications') }}">Cancel</a>
                
            </form>
        </div>
        
    </div>
</div>
<!-- END PAGE CONTENT-->

@stop

@section('footer')

<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

<script>
    CKEDITOR.replace( 'editor1' ,{
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
            console.log(formData);
            $.ajax({
                url: '{{url('/ns-admin/pushnotification/image')}}',
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
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#profile-img-tag').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $('#profile-img-tag').css('display', '');
            $('#profile').css('display','none');
            $('#delete').css('display','none');
            readURL(this);
        });
    });
</script>

<!-- Delete(Hide) image -->
<script>
    $(document).ready(function() {
        $('a#delete').click(function(){
            $('img#profile').hide();
            $('a#delete').hide();
        })
    });
</script>

        
@include('admin.layouts.ckeditor')
@stop