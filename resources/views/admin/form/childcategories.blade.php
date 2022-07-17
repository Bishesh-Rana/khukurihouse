@section('title')

Child Categories | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Child Categories</h1>
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
                <?php if (isset($childCategory)) {
                    echo "Edit Profile";
                } else {
                    echo "Add Child Category";
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
            if (isset($childCategory)) {
                $action = url('/ns-admin/childCategories/edit/' . $childCategory->id);
                $button = 'Update';
            } else {
                $action = url('/ns-admin/childCategories/add');
                $button = 'Add';
            } ?>
            <form action="{{$action}}" id="upload_form" class="form-horizontal" method="post" novalidate="novalidate" enctype="multipart/form-data">
                @csrf
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-7-1">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Child Category Name</label>
                                    <input class="form-control" type="text" name="child_category_name" placeholder="Enter Child Category Name" value="<?php if (isset($childCategory->child_category_name)) {
                                                                                                                                                            echo $childCategory->child_category_name;
                                                                                                                                                        } else {
                                                                                                                                                            echo old('child_category_name');
                                                                                                                                                        } ?>">
                                </div>

                                <div class="form-group m-form__group">
                                    <label for="pic">
                                        Child Category Image
                                    </label>
                                    <div></div>
                                    <div class="custom-file" style="width:40%">
                                        <input type="file" name="image" id="cat_image">
                                    </div>

                                    @if (!empty($childCategory->image))
                                    <hr>
                                    <img src="{{ asset('uploads/'.'categories/'.$childCategory->image) }}" alt="<?php if (isset($childCategory->sub_category_name)) {
                                                                                                                    echo $childCategory->sub_category_name;
                                                                                                                } ?>" height="100" width="100">

                                    @endif
                                </div>

                                <div class="check-list">
                                    <label for="">Publish Status</label>
                                    <label class="ui-radio ui-radio-primary">
                                        <input type="radio" name="publish_status" value="0" <?php echo (isset($childCategory->publish_status) ? ((isset($childCategory->publish_status) && ($childCategory->publish_status == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                        <span class="input-span"></span>
                                        Banned
                                    </label>
                                    <label class="ui-radio ui-radio-primary">
                                        <input type="radio" name="publish_status" value="1" <?php echo (isset($childCategory->publish_status) && ($childCategory->publish_status == 1)) ? 'checked="checked"' : ''; ?>>
                                        <span class="input-span"></span>
                                        Active
                                    </label>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Child Category Slug</label>
                                    <input class="form-control" type="text" name="child_category_slug" placeholder="Enter Child Category Slug" value="<?php if (isset($childCategory->child_category_slug)) {
                                                                                                                                                            echo $childCategory->child_category_slug;
                                                                                                                                                        } else {
                                                                                                                                                            echo old('child_category_slug');
                                                                                                                                                        } ?>">
                                </div>

                                <div class="form-group">
                                    <label>
                                        Sub Category
                                    </label>
                                    <select class="form-control select2_demo_1" name="sub_category_id">
                                        @foreach($parentCategories as $parentCategory)
                                        <optgroup label="@if(count($parentCategory->subcategory) > 0){{$parentCategory->parent_category_name}} @endif">
                                            @foreach($parentCategory->subcategory as $row)
                                            <option <?php
                                                    if (isset($childCategory) && $row->id == $childCategory->sub_category_id) {
                                                        echo "selected";
                                                    }
                                                    ?> value="{{ $row->id }}">{{ ucwords($row->sub_category_name) }}</option>
                                            @endforeach
                                        </optgroup>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab-7-2">
                        <div class="form-group">
                            <label>Meta Title</label>
                            <textarea class="form-control" name="meta_title" rows="4" placeholder="Enter Meta Title"><?php if (isset($childCategory->meta_title)) {
                                                                                                                            echo $childCategory->meta_title;
                                                                                                                        } else {
                                                                                                                            echo old('meta_title');
                                                                                                                        } ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Meta Keywords</label>
                            <textarea class="form-control" name="meta_keyword" rows="5" placeholder="Enter Meta Keywords"><?php if (isset($childCategory->meta_keyword)) {
                                                                                                                                echo $childCategory->meta_keyword;
                                                                                                                            } else {
                                                                                                                                echo old('meta_keyword');
                                                                                                                            } ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Meta Description</label>
                            <textarea class="form-control" name="meta_description" rows="6" placeholder="Enter Meta Description"><?php if (isset($childCategory->meta_description)) {
                                                                                                                                        echo $childCategory->meta_description;
                                                                                                                                    } else {
                                                                                                                                        echo old('meta_description');
                                                                                                                                    } ?></textarea>
                        </div>

                    </div>
                    
                </div><br>
                <button class="btn btn-info" type="submit">Submit</button>
                <a class="btn btn-warning" href="{{ url('ns-admin/childCategories') }}">Cancel</a>

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

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        $('#cat_image').change(function(e) {
            e.preventDefault();
            var formData = new FormData(upload_form);
            console.log(formData);
            $.ajax({
                url: '{{url('/ns-admin/child-cat/image')}}',
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
        });
    });
</script>

@stop