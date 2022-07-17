@section('title')

Advertisements | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Advertisements</h1>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">
                <?php if (isset($advertisement)) {
                    echo "Edit Advertisement";
                } else {
                    echo "Add Advertisement";
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
            if (isset($advertisement)) {
                $action = url('/ns-admin/advertisements/edit/' . $advertisement->id);
                $button = 'Update';
            } else {
                $action = url('/ns-admin/advertisements/add');
                $button = 'Add';
            } ?>
            <form action="{{$action}}" id="upload_form" class="form-horizontal" method="post" novalidate="novalidate" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" type="text" name="title" placeholder="Enter the title" value="<?php if (isset($advertisement->title)) {
                                echo $advertisement->title;
                            } else {
                                echo old('title');
                            } ?>">
                        </div>

                        <div class="form-group">
                            <label for="description">
                                Description
                            </label>
                            <textarea class="form-control ckeditor" id="my-editor" name="body" rows="5" placeholder=""><?php if (isset($advertisement->body)) {
                                echo $advertisement->body;
                            } else {
                                echo old('body');
                            } ?></textarea>
                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label>Advertisement Link</label>
                            <input class="form-control" type="text" name="link" placeholder="Enter the link" value="<?php if (isset($advertisement->link)) {
                                echo $advertisement->link;
                            } else {
                                echo old('link');
                            } ?>">
                        </div>

                        <div class="form-group">
                            <label class="control-label">Page Type</label>
                            <select name="placement" class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1">
                                <option value="none">None</option>
                                <option <?php if (isset($advertisement) && $advertisement->placement === 'plain-text') {
                                            echo "selected";
                                        } ?> value="plain-text">Plain Text (No Image)</option>
                                <option <?php if (isset($advertisement) && $advertisement->placement === 'mid-left') {
                                            echo "selected";
                                        } ?> value="mid-left">Mid Left (1300x260)</option>
                                <option <?php if (isset($advertisement) && $advertisement->placement === 'mid-right') {
                                            echo "selected";
                                        } ?> value="mid-right">Mid Right (420x260)</option>
                                <option <?php if (isset($advertisement) && $advertisement->placement === 'full-width') {
                                            echo "selected";
                                        } ?> value="full-width">Full Width (1450x236)</option>
                                <option <?php if (isset($advertisement) && $advertisement->placement === 'deal-ad') {
                                            echo "selected";
                                        } ?> value="deal-ad">Replace Deals (420x855)</option>
                                <option <?php if (isset($advertisement) && $advertisement->placement === 'google-play') {
                                            echo "selected";
                                        } ?> value="google-play">Google Play (200x66)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Image</label>
                            <div></div>
                            <div class="custom-file" style="width:40%">
                                <input type="file" name="image" id="pro_image">
                                <div><br></div>
                                <img src="" id="profile-img-tag" width="100px" height="58px" style="display:none;" />
                            </div>

                            @if (!empty($advertisement->image))
                            <br>
                            <img id="profile" src="{{ asset('uploads/notices/'.$advertisement->image) }}" alt="<?php if (isset($advertisement->title)) {
                                echo $advertisement->title;
                            } ?>" height="100" width="100">
                            <a title="Delete" id="delete" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></a>
                            @endif
                        </div>
                        <div><br></div>

                        <div class="check-list">
                            <label for="">Featured Status</label>
                            <label class="ui-radio ui-radio-primary">
                                <input type="radio" name="featured" value="0" <?php echo (isset($advertisement->featured) ? ((isset($advertisement->featured) && ($advertisement->featured == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                <span class="input-span"></span>
                                No
                            </label>
                            <label class="ui-radio ui-radio-primary">
                                <input type="radio" name="featured" value="1" <?php echo (isset($advertisement->featured) && ($advertisement->featured == 1)) ? 'checked="checked"' : ''; ?>>
                                <span class="input-span"></span>
                                Yes
                            </label>
                        </div>

                        <div class="check-list">
                            <label for="">Publish Status</label>
                            <label class="ui-radio ui-radio-primary">
                                <input type="radio" name="publish_status" value="0" <?php echo (isset($advertisement->publish_status) ? ((isset($advertisement->publish_status) && ($advertisement->publish_status == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                <span class="input-span"></span>
                                Banned
                            </label>
                            <label class="ui-radio ui-radio-primary">
                                <input type="radio" name="publish_status" value="1" <?php echo (isset($advertisement->publish_status) && ($advertisement->publish_status == 1)) ? 'checked="checked"' : ''; ?>>
                                <span class="input-span"></span>
                                Active
                            </label>
                        </div>
                    </div>
                </div>

                <button class="btn btn-info" type="submit">Submit</button>
                <a class="btn btn-warning" href="{{ url('ns-admin/advertisements') }}">Cancel</a>

            </form>
        </div>

    </div>
</div>
<!-- END PAGE CONTENT-->

@stop

@section('footer')

@include('admin.layouts.ckeditor')

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
            $.ajax({
                url: "{{route('advertisement.image')}}",
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

@stop
