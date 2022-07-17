@section('title')

Sliders | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Sliders</h1>
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
                <?php if (isset($slider)) {
                    echo "Edit Slider";
                } else {
                    echo "Add Slider";
                } ?>
            </div>
            <div class="ibox-tools">
                <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
            </div>
        </div>
        <div class="ibox-body">
            @include('admin.layouts.error')
            <ul class="nav nav-tabs tabs-line">
                <li class="nav-item">
                    <a class="nav-link active" href="#tab-7-1" data-toggle="tab"><i class="fa fa-info-circle"></i> Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tab-7-2" data-toggle="tab"><i class="fa fa-tag"></i> Meta</a>
                </li>
            </ul>
            <?php
            if (isset($slider)) {
                $action = url('/ns-admin/sliders/edit/' . $slider->id);
                $button = 'Update';
            } else {
                $action = url('/ns-admin/sliders/add');
                $button = 'Add';
            } ?>
            <form action="{{$action}}" id="upload_form" class="form-horizontal" method="post" novalidate="novalidate" enctype="multipart/form-data">
                @csrf
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-7-1">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input class="form-control" type="text" name="title" placeholder="Enter the title" value="<?php if (isset($slider->title)) {
                                        echo $slider->title;
                                    } else {
                                        echo old('title');
                                    } ?>">
                                </div>
                                
                                <div class="form-group">
                                    <label for="description">
                                        Description
                                    </label>
                                    <textarea class="form-control ckeditor" name="body" rows="5" placeholder=""><?php if (isset($slider->body)) {
                                        echo $slider->body;
                                    } else {
                                        echo old('body');
                                    } ?></textarea>
                                </div>
                                
                            </div>
                            
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label>External Link</label>
                                    <input class="form-control" type="text" name="link" placeholder="Enter the link" value="<?php if (isset($slider->link)) {
                                        echo $slider->link;
                                    } else {
                                        echo old('link');
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

                                    @if (!empty($slider->image))
                                    <br>
                                    <div class="image-cover">
                                    <img id="profile" src="{{ asset('uploads/'.'sliders/'.$slider->image) }}" alt="<?php if (isset($slider->title)) {
                                        echo $slider->title;
                                    } ?>" height="100" width="200">
                                    <a title="Delete" id="delete" data-value="{{ $slider->id }}" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></a>
                                </div>
                                    @endif
                                </div>
                                <div><br></div>

                                <div class="form-group">
                                    <label>Alt Img</label>
                                    <input class="form-control" type="text" name="alt_img" placeholder="Enter the alt tag value" value="<?php if (isset($slider->alt_img)) {
                                        echo $slider->alt_img;
                                    } else {
                                        echo old('alt_img');
                                    } ?>">
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="check-list">
                                            <label for="">Publish Status</label>
                                            <label class="ui-radio ui-radio-primary">
                                                <input type="radio" name="publish_status" value="0" <?php echo (isset($slider->publish_status) ? ((isset($slider->publish_status) && ($slider->publish_status == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                                <span class="input-span"></span>
                                                Banned
                                            </label>
                                            <label class="ui-radio ui-radio-primary">
                                                <input type="radio" name="publish_status" value="1" <?php echo (isset($slider->publish_status) && ($slider->publish_status == 1)) ? 'checked="checked"' : ''; ?>>
                                                <span class="input-span"></span>
                                                Active
                                            </label>
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="check-list">
                                            <label for="">Hide Text</label>
                                            <label class="ui-radio ui-radio-primary">
                                                <input type="radio" name="hide_status" value="0" <?php echo (isset($slider->hide_status) ? ((isset($slider->hide_status) && ($slider->hide_status == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                                <span class="input-span"></span>
                                                Off
                                            </label>
                                            <label class="ui-radio ui-radio-primary">
                                                <input type="radio" name="hide_status" value="1" <?php echo (isset($slider->hide_status) && ($slider->hide_status == 1)) ? 'checked="checked"' : ''; ?>>
                                                <span class="input-span"></span>
                                                On
                                            </label>
                                        </div>

                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>

                    <div class="tab-pane" id="tab-7-2">
                        <div class="form-group">
                            <label>Meta Title</label>
                            <textarea class="form-control" name="meta_title" rows="4" placeholder="Enter Meta Title"><?php if (isset($slider->meta_title)) {
                                echo $slider->meta_title;
                            } else {
                                echo old('meta_title');
                            } ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Meta Keywords</label>
                            <textarea class="form-control" name="meta_keyword" rows="5" placeholder="Enter Meta Keyword"><?php if (isset($slider->meta_keyword)) {
                                echo $slider->meta_keyword;
                            } else {
                                echo old('meta_keyword');
                            } ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Meta Description</label>
                            <textarea class="form-control" name="meta_desc" rows="6" placeholder="Enter Meta Description"><?php if (isset($slider->meta_desc)) {
                                echo $slider->meta_desc;
                            } else {
                                echo old('meta_desc');
                            } ?></textarea>
                        </div>

                    </div>
                    </div><br>
              
                <button class="btn btn-info" type="submit">Submit</button>
                <a class="btn btn-warning" href="{{ url('ns-admin/sliders') }}">Cancel</a>
                
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
                url: '{{url('/ns-admin/slider/image')}}',
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
      let filterObject = {
        deleteImage: null,
        path:null,
    }

    $(document).ready(function() {
        $('a#delete').click(function(e){
            e.preventDefault();
            filterObject.deleteImage = $('#delete').data('value');
            filterObject.path = "{{ route('admin.slider.img.delete') }}";
            var result = confirm("Do Want to delete?");
            if (result) {
               
            
            $.ajax({
                method: "GET",
                url: filterObject.path,
                data:filterObject,
                success: function(resp) {
                    if (resp.status == 'success') {
                        Lobibox.notify(resp.status, {
                            showClass: 'fadeInDown',
                            hideClass: 'fadeUpDown',
                            width: 400,
                            msg: resp.message,
                            delay: 3000,
                        });
                        $('.image-cover').hide();
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
            }
          

        })
    });
</script>

        
@include('admin.layouts.ckeditor')
@stop