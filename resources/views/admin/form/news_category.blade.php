@section('title')

News Categories | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">News Categories</h1>
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
                <?php if (isset($category)) {
                    echo "Edit Profile";
                } else {
                    echo "Add Category";
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
                    <a class="nav-link active" href="#tab-7-1" data-toggle="tab">Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tab-7-3" data-toggle="tab">Meta</a>
                </li>
            </ul>
            <?php
            if (isset($category)) {
                $action = url('/ns-admin/newsCategories/edit/' . $category->id);
                $button = 'Update';
            } else {
                $action = url('/ns-admin/newsCategories/add');
                $button = 'Add';
            } ?>
            <form action="{{$action}}" id="upload_form" class="form-horizontal" method="post" novalidate="novalidate" enctype="multipart/form-data">
                @csrf
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-7-1">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category Title</label>
                                    <input type="text" name="category_title" class="form-control" placeholder="Category Title" value="<?php if (isset($category->category_title)) {
                                                                                                                                            echo $category->category_title;
                                                                                                                                        } else {
                                                                                                                                            echo old('category_title');
                                                                                                                                        } ?>">
                                </div>

                                <div class="form-group">
                                    <label>Category Icon</label>
                                    <input type="text" name="category_icon" class="form-control" placeholder="Category Icon" value="<?php if (isset($category->category_icon)) {
                                                                                                                                        echo $category->category_icon;
                                                                                                                                    } else {
                                                                                                                                        echo old('category_icon');
                                                                                                                                    } ?>">
                                </div>

                                <div class="form-group">
                                    <label>External Title (Optional)</label>
                                    <input type="text" name="external_link" class="form-control" placeholder="External Link" value="<?php if (isset($category->external_link)) {
                                                                                                                                        echo $category->external_link;
                                                                                                                                    } else {
                                                                                                                                        echo old('external_link');
                                                                                                                                    } ?>">
                                </div>



                                <div class="check-list">
                                    <label for="">Show on menu</label>
                                    <div class="m-radio-inline">
                                    <label class="ui-radio ui-radio-primary">
                                            <input type="radio" name="show_on_menu" value="N" <?php echo (isset($category->show_on_menu) && ($category->show_on_menu == 'N')) ? 'checked="checked"' : 'checked="checked"'; ?>>
                                            <span class="input-span"></span>None
                                        </label>
                                        <label class="ui-radio ui-radio-primary">
                                            <input type="radio" name="show_on_menu" value="H" <?php echo (isset($category->show_on_menu) ? ((isset($category->show_on_menu) && ($category->show_on_menu == 'H')) ? 'checked="checked"' : '') : ''); ?>>
                                            <span class="input-span"></span>Header
                                        </label>
                                        <label class="ui-radio ui-radio-primary">
                                            <input type="radio" name="show_on_menu" value="F" <?php echo (isset($category->show_on_menu) && ($category->show_on_menu == 'F')) ? 'checked="checked"' : ''; ?>>
                                            <span class="input-span"></span>Footer
                                        </label>
                                        <label class="ui-radio ui-radio-primary">
                                            <input type="radio" name="show_on_menu" value="B" <?php echo (isset($category->show_on_menu) && ($category->show_on_menu == 'B')) ? 'checked="checked"' : ''; ?>>
                                            <span class="input-span"></span>Both
                                        </label>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="description">
                                        Category Details
                                    </label>
                                    <textarea class="form-control ckeditor" id="my-editor" name="category_body" rows="5" placeholder="Category Body"><?php if (isset($category->category_body)) {
                                                                                                                                            echo $category->category_body;
                                                                                                                                        } else {
                                                                                                                                            echo old('category_body');
                                                                                                                                        } ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="pic">
                                        Parallex Image (Banner Image)
                                    </label>
                                    <div></div>
                                    <div class="custom-file" style="width:40%">
                                        <input type="file" name="parallex_img" id="pro_image">
                                        <div><br></div>
                                        <img src="" id="profile-img-tag" width="100px" height="58px" style="display:none;" />
                                    </div>

                                    @if (!empty($category->parallex_img))
                                    <br>
                                    <img id="profile" src="{{ asset('uploads/'.'newscategories/'.$category->parallex_img) }}" alt="<?php if (isset($category)) {
                                                                                                                            echo $category->category_title;
                                                                                                                        } ?>" height="100" width="110">
                                    <a title="Delete" id="delete" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></a>
                                    @endif
                                </div>
                                <div><br></div>

                                <div class="check-list">
                                    <label for="">Featured</label>
                                    <label class="ui-radio ui-radio-primary">
                                        <input type="radio" name="featured_category" value="0" <?php echo (isset($category->featured_category) ? ((isset($category->featured_category) && ($category->featured_category == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                        <span class="input-span"></span>No
                                    </label>
                                    <label class="ui-radio ui-radio-primary">
                                        <input type="radio" name="featured_category" value="1" <?php echo (isset($category->featured_category) && ($category->featured_category == 1)) ? 'checked="checked"' : ''; ?>>
                                        <span class="input-span"></span>Yes
                                    </label>
                                </div>

                                <div class="check-list">
                                    <label for="">Published Status</label>
                                    <label class="ui-radio ui-radio-primary">
                                        <input type="radio" name="publish_status" value="0" <?php echo (isset($category->publish_status) ? ((isset($category->publish_status) && ($category->publish_status == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                        <span class="input-span"></span>Inactive
                                    </label>
                                    <label class="ui-radio ui-radio-primary">
                                        <input type="radio" name="publish_status" value="1" <?php echo (isset($category->publish_status) && ($category->publish_status == 1)) ? 'checked="checked"' : ''; ?>>
                                        <span class="input-span"></span>Active
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="tab-pane" id="tab-7-3">
                        <div class="form-group">
                            <label>Meta Title</label>
                            <textarea class="form-control" name="meta_title" rows="4" placeholder="Enter Meta Title"><?php if (isset($category->meta_title)) {
                                                                                                                            echo $category->meta_title;
                                                                                                                        } else {
                                                                                                                            echo old('meta_title');
                                                                                                                        } ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Meta Keywords</label>
                            <textarea class="form-control" name="meta_keyword" rows="5" placeholder="Enter Meta Keywords"><?php if (isset($category->meta_keyword)) {
                                                                                                                                echo $category->meta_keyword;
                                                                                                                            } else {
                                                                                                                                echo old('meta_keyword');
                                                                                                                            } ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Meta Description</label>
                            <textarea class="form-control" name="meta_description" rows="6" placeholder="Enter Meta Description"><?php if (isset($category->meta_description)) {
                                                                                                                                        echo $category->meta_description;
                                                                                                                                    } else {
                                                                                                                                        echo old('meta_description');
                                                                                                                                    } ?></textarea>
                        </div>

                    </div>
                </div><br>
                <button class="btn btn-info" type="submit">Submit</button>
                <a class="btn btn-warning" href="{{ url('ns-admin/newsCategories') }}">Cancel</a>

            </form>

        </div>
    </div>
</div>
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


<!-- Dynamic Forms jQuery -->
<script>
    $("input:radio[name='home_delivery']").on('click', function() {
        if ($(this).val() === '1') {
            $('#delivery_area').removeAttr("disabled");
            $('#delivery_charges').removeAttr("disabled");
        } else {
            $('#delivery_area').attr("disabled", "disabled");
            $('#delivery_charges').attr("disabled", "disabled");
        }
    });

    $("input:radio[name='warranty']").on('click', function() {
        if ($(this).val() === '1') {
            $("input[name='warranty_period']").removeAttr("disabled");
            $("textarea[name='warranty_description']").removeAttr("disabled");
        } else {
            $("input[name='warranty_period']").attr("disabled", "disabled");
            $("textarea[name='warranty_description']").attr("disabled", "disabled");
        }
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
                url: '{{url('/ns-admin/news-cat/image')}}',
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
        $('a#delete').click(function() {
            $('img#profile').hide();
            $('a#delete').hide();
        })
    });
</script>

@include('admin.layouts.ckeditor')

@stop