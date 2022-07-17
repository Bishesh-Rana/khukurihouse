@section('title')

Product Categories | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Product Categories</h1>
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
                <?php if (isset($selectCategory)) {
                    echo "Edit Product Category";
                } else {
                    echo "Add Product Category";
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
                    <a class="nav-link active" href="#tab-7-1" data-toggle="tab"><i class="fa fa-line-chart"></i> Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tab-7-2" data-toggle="tab"><i class="fa fa-heartbeat"></i> Meta</a>
                </li>
            </ul>
            <?php
            if (isset($selectCategory)) {
                $action = url('/ns-admin/categories/edit/' . $selectCategory->id);
                $button = 'Update';
            } else {
                $action = url('/ns-admin/categories/add');
                $button = 'Add';
            } ?>
            <form action="{{$action}}" id="upload_form" class="form-horizontal" method="post" novalidate="novalidate" enctype="multipart/form-data">
                @csrf
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-7-1">


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Select Parent</label>

                                    <select class="form-control select2_demo_1" name="category_id" required>
                                        <option value="0">Root</option>
                                        {!!$htmlOption!!}
                                    </select>

                                </div>

                                <div class="form-group">
                                    <label>Product Category Name</label>
                                    <input class="form-control" required type="text" id="category_name" name="category_name" required placeholder="Enter Product Category Name" value="<?php if (isset($selectCategory->category_name)) {
                                                                                                                                                                            echo $selectCategory->category_name;
                                                                                                                                                                        } else {
                                                                                                                                                                            echo old('category_name');
                                                                                                                                                                        } ?>">
                                </div>

                                <div class="form-group m-form__group">
                                    <label for="pic">
                                        Product Category Image
                                    </label>
                                    <div></div>
                                    <div class="custom-file" style="width:40%">
                                        <input type="file" required name="image" id="cat_image">
                                        <img src="" id="profile-img-tag" width="90px" />

                                    </div>

                                    @if (!empty($selectCategory->image))
                                    <hr>
                                    <img id="category-image" src="{{ asset('uploads/categories/'.$selectCategory->image) }}" alt="<?php if (isset($selectCategory->category_name)) {
                                                                                                                                        echo $selectCategory->category_name;
                                                                                                                                    } ?>" height="100" width="100">
                                    <a title="Delete" id="delete" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></a>

                                    {{-- <a title="Delete" id="delete" href="{{url('ns-admin/categories/removeImage/'.$selectCategory->image)}}" onclick="return confirm('Do you really want to delete the product category image?')" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></a> --}}
                                    @endif
                                </div>
                                <br>

                                <div class="form-group m-form__group">
                                    <label for="pic">
                                        Category Banner Image (1322 x 552)
                                    </label>
                                    <div></div>
                                    <div class="custom-file" style="width:40%">
                                        <input type="file" required name="banner_image" id="ban_image">
                                        <img src="" id="profile-img-tag1" width="90px" />

                                    </div>

                                    @if (!empty($selectCategory->banner_image))
                                    <hr>
                                    <img id="category-image1" src="{{ asset('uploads/categories/'.$selectCategory->banner_image) }}" alt="<?php if (isset($selectCategory->category_name)) {
                                                                                                                                                echo $selectCategory->category_name;
                                                                                                                                            } ?>" height="55" width="130">
                                    <a title="Delete" id="delete1" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></a>

                                    {{-- <a title="Delete" id="delete" href="{{url('ns-admin/categories/removeBanner/'.$selectCategory->banner_image)}}" onclick="return confirm('Do you really want to delete the category banner image?')" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></a> --}}
                                    @endif
                                </div>
                                <br>

                                <div class="form-group m-form__group">
                                    <label for="pic">
                                        Category Icon Image
                                    </label>
                                    <div></div>
                                    <div class="custom-file" style="width:40%">
                                        <input type="file" required name="category_icon" id="ban_image">
                                        <img src="" id="profile-img-tag1" width="90px" />
                                    </div>

                                    @if (!empty($selectCategory->category_icon))
                                    <hr>
                                    <img id="category-image1" src="{{ asset('uploads/categories/'.$selectCategory->category_icon) }}" alt="<?php if (isset($selectCategory->category_name)) {
                                                                                                                                                echo $selectCategory->category_name;
                                                                                                                                            } ?>" height="55" width="130">
                                    <a title="Delete" id="delete1" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></a>

                                    {{-- <a title="Delete" id="delete" href="{{url('ns-admin/categories/removeBanner/'.$selectCategory->category_icon)}}" onclick="return confirm('Do you really want to delete the category banner image?')" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></a> --}}
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-sm-2 form-group">
                                        <label class="product-form-label">Image Alt Tag</label>
                                    </div>
                                    <div class="col-sm-10 form-group">
                                        <textarea required class="form-control m-input" name="alt" rows="1"><?php if (isset($selectCategory->alt)) {
                                                                                                        echo $selectCategory->alt;
                                                                                                    } else {
                                                                                                        echo old('alt');
                                                                                                    } ?></textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Category Position</label>
                                    <input class="form-control" required type="number" min="1" name="position" placeholder="Enter Category Position" value="<?php if (isset($selectCategory->position)) {
                                                                                                                                                        echo $selectCategory->position;
                                                                                                                                                    } else {
                                                                                                                                                        echo old('1');
                                                                                                                                                    } ?>">
                                </div>

                                <div class="form-group">
                                    <label>Product Category Slug</label>
                                    <input class="form-control" required type="text" id="category_slug" name="category_slug" placeholder="Enter Product Category Slug" value="<?php if (isset($selectCategory->category_slug)) {
                                                                                                                                                                            echo $selectCategory->category_slug;
                                                                                                                                                                        } else {
                                                                                                                                                                            echo old('category_slug');
                                                                                                                                                                        } ?>">
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Placement</label>
                                    <select name="placement" class="form-control custom-select" data-placeholder="Choose a Placement" required>
                                        <option value="none" disabled> ---Select Placement --- </option>
                                        <option <?php if (isset($selectCategory) && $selectCategory->placement === 'none') {
                                                    echo "selected";
                                                } ?> value="none">None</option>
                                        <option <?php if (isset($selectCategory) && $selectCategory->placement === 'first') {
                                                    echo "selected";
                                                } ?> value="first">First</option>
                                        <option <?php if (isset($selectCategory) && $selectCategory->placement === 'second') {
                                                    echo "selected";
                                                } ?> value="second">Second</option>
                                        <option <?php if (isset($selectCategory) && $selectCategory->placement === 'third') {
                                                    echo "selected";
                                                } ?> value="third">Third (Must Be Root Category)</option>
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="check-list">
                                            <label for="">Show On Home</label>
                                            <label class="ui-radio ui-radio-primary">
                                                <input type="radio" name="show_on_home" value="0" <?php echo (isset($selectCategory->show_on_home) ? ((isset($selectCategory->show_on_home) && ($selectCategory->show_on_home == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                                <span class="input-span"></span>
                                                No
                                            </label>
                                            <label class="ui-radio ui-radio-primary">
                                                <input type="radio" name="show_on_home" value="1" <?php echo (isset($selectCategory->show_on_home) && ($selectCategory->show_on_home == 1)) ? 'checked="checked"' : ''; ?>>
                                                <span class="input-span"></span>
                                                Yes
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="check-list">
                                            <label for="">Hot Best Sellers</label>
                                            <label class="ui-radio ui-radio-primary">
                                                <input type="radio" name="hot_best_sellers" value="0" <?php echo (isset($selectCategory->hot_best_sellers) ? ((isset($selectCategory->hot_best_sellers) && ($selectCategory->hot_best_sellers == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                                <span class="input-span"></span>
                                                No
                                            </label>
                                            <label class="ui-radio ui-radio-primary">
                                                <input type="radio" name="hot_best_sellers" value="1" <?php echo (isset($selectCategory->hot_best_sellers) && ($selectCategory->hot_best_sellers == 1)) ? 'checked="checked"' : ''; ?>>
                                                <span class="input-span"></span>
                                                Yes
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="check-list">
                                            <label for="">Hot New Arrivals</label>
                                            <label class="ui-radio ui-radio-primary">
                                                <input type="radio" name="hot_new_arrivals" value="0" <?php echo (isset($selectCategory->hot_new_arrivals) ? ((isset($selectCategory->hot_new_arrivals) && ($selectCategory->hot_new_arrivals == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                                <span class="input-span"></span>
                                                No
                                            </label>
                                            <label class="ui-radio ui-radio-primary">
                                                <input type="radio" name="hot_new_arrivals" value="1" <?php echo (isset($selectCategory->hot_new_arrivals) && ($selectCategory->hot_new_arrivals == 1)) ? 'checked="checked"' : ''; ?>>
                                                <span class="input-span"></span>
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="check-list">
                                    <label for="">Featured Status</label>
                                    <label class="ui-radio ui-radio-primary">
                                        <input type="radio" name="featured" value="0" <?php echo (isset($selectCategory->featured) ? ((isset($selectCategory->featured) && ($selectCategory->featured == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                        <span class="input-span"></span>
                                        No
                                    </label>
                                    <label class="ui-radio ui-radio-primary">
                                        <input type="radio" name="featured" value="1" <?php echo (isset($selectCategory->featured) && ($selectCategory->featured == 1)) ? 'checked="checked"' : ''; ?>>
                                        <span class="input-span"></span>
                                        Yes
                                    </label>
                                </div><br>

                                <div class="check-list">
                                    <label for="">Publish Status</label>
                                    <label class="ui-radio ui-radio-primary">
                                        <input type="radio" name="publish_status" value="0" <?php echo (isset($selectCategory->publish_status) ? ((isset($selectCategory->publish_status) && ($selectCategory->publish_status == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                        <span class="input-span"></span>
                                        Banned
                                    </label>
                                    <label class="ui-radio ui-radio-primary">
                                        <input type="radio" name="publish_status" value="1" <?php echo (isset($selectCategory->publish_status) && ($selectCategory->publish_status == 1)) ? 'checked="checked"' : ''; ?>>
                                        <span class="input-span"></span>
                                        Active
                                    </label>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab-7-2">
                        <div class="form-group">
                            <label>Meta Title</label>
                            <textarea class="form-control" name="meta_title" rows="4" placeholder="Enter Meta Title"><?php if (isset($selectCategory->meta_title)) {
                                                                                                                            echo $selectCategory->meta_title;
                                                                                                                        } else {
                                                                                                                            echo old('meta_title');
                                                                                                                        } ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Meta Keywords</label>
                            <textarea class="form-control" name="meta_keyword" rows="5" placeholder="Enter Meta Keyword"><?php if (isset($selectCategory->meta_keyword)) {
                                                                                                                                echo $selectCategory->meta_keyword;
                                                                                                                            } else {
                                                                                                                                echo old('meta_keyword');
                                                                                                                            } ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Meta Description</label>
                            <textarea class="form-control" name="meta_description" rows="6" placeholder="Enter Meta Description"><?php if (isset($selectCategory->meta_description)) {
                                                                                                                                        echo $selectCategory->meta_description;
                                                                                                                                    } else {
                                                                                                                                        echo old('meta_description');
                                                                                                                                    } ?></textarea>
                        </div>

                    </div>
                </div><br>
                <button class="btn btn-info" type="submit">Submit</button>
                <a class="btn btn-warning" href="{{ url('ns-admin/categories') }}">Cancel</a>

            </form>

        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->

@stop

@section('footer')

<!-- FOR AUTO SLUG GENERATION -->
<script type="text/javascript">
    $(document).ready(function() {
        $("#category_name").keyup(function() {
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^\w ]+/g, ''); //removes non-alphanumeric
            Text = Text.replace(/ +/g, '-'); // replaces space with hyphen
            $("#category_slug").val(Text);
        });
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

        $('#delete').on('click', function() {
            $('#category-image').css('display', 'none');
            $('#delete').css('display', 'none');
        });

        $('#delete1').on('click', function() {
            $('#category-image1').css('display', 'none');
            $('#delete1').css('display', 'none');
        });
        $('#cat_image').change(function(e) {
            e.preventDefault();
            var formData = new FormData(upload_form);
            console.log(formData);
            $.ajax({
                url: "{{ route('category.image') }}",
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
                            msg: resp.message['blog_image'],
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

            readURL(this);

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#profile-img-tag').attr('src', e.target.result);
                        $('#category-image').css('display', 'none');
                        $('#delete').css('display', 'none');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        });


        function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#profile-img-tag1').attr('src', e.target.result);
                    $('#category-image1').css('display', 'none');
                    $('#delete1').css('display', 'none');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#ban_image").change(function() {
            readURL1(this);
        });

    });
</script>

<!-- Delete(Hide) image -->
<!-- <script>
    $(document).ready(function() {
        $('a#delete').click(function(){
            $('img#category-image').hide();
            $('a#delete').hide();
        })
    });
</script> -->


@stop
