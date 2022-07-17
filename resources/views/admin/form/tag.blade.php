@section('title')

News Tags | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">News Tags</h1>
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
                <?php if (isset($tag)) {
                    echo "Edit News Tag";
                } else {
                    echo "Add News Tag";
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
            if (isset($tag)) {
                $action = url('/ns-admin/tags/edit/' . $tag->id);
                $button = 'Update';
            } else {
                $action = url('/ns-admin/tags/add');
                $button = 'Add';
            } ?>
            <form action="{{$action}}" id="form-sample-1" class="form-horizontal" method="post" novalidate="novalidate" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tag Title</label>
                            <input class="form-control" type="text" name="tag_title" placeholder="Enter title of the tag" value="<?php if (isset($tag->tag_title)) {
                                                                                                                                        echo $tag->tag_title;
                                                                                                                                    } else {
                                                                                                                                        echo old('tag_title');
                                                                                                                                    } ?>">
                        </div>

                        <div class="form-group">
                            <label>Tag Slug</label>
                            <input class="form-control" type="text" name="tag_url" placeholder="Enter tag slug" value="<?php if (isset($tag->tag_url)) {
                                                                                                                                echo $tag->tag_url;
                                                                                                                            } else {
                                                                                                                                echo old('name');
                                                                                                                            } ?>">
                        </div>

                        <div class="check-list">
                            <label for="">Featured Status</label>
                            <label class="ui-radio ui-radio-primary">
                                <input type="radio" name="featured_status" value="0" <?php echo (isset($tag->featured_status) ? ((isset($tag->featured_status) && ($tag->featured_status == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                <span class="input-span"></span>
                                Banned
                            </label>
                            <label class="ui-radio ui-radio-primary">
                                <input type="radio" name="featured_status" value="1" <?php echo (isset($tag->featured_status) && ($tag->featured_status == 1)) ? 'checked="checked"' : ''; ?>>
                                <span class="input-span"></span>
                                Active
                            </label>
                        </div>

                        <div class="check-list">
                            <label for="">Publish Status</label>
                            <label class="ui-radio ui-radio-primary">
                                <input type="radio" name="publish_status" value="0" <?php echo (isset($tag->publish_status) ? ((isset($tag->publish_status) && ($tag->publish_status == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                <span class="input-span"></span>
                                Banned
                            </label>
                            <label class="ui-radio ui-radio-primary">
                                <input type="radio" name="publish_status" value="1" <?php echo (isset($tag->publish_status) && ($tag->publish_status == 1)) ? 'checked="checked"' : ''; ?>>
                                <span class="input-span"></span>
                                Active
                            </label>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="form-group m-form__group">
                            <label for="description">
                                Tag Details
                            </label>
                            <textarea class="form-control m-input ckeditor" id="my-editor" name="tag_body" rows="8" placeholder="News Body"><?php if (isset($tag->tag_body)) {
                                                                                                                                    echo $tag->tag_body;
                                                                                                                                } else {
                                                                                                                                    echo old('tag_body');
                                                                                                                                } ?></textarea>
                        </div>


                    </div>
                </div><br>
                <button class="btn btn-info" type="submit">Submit</button>
                <a class="btn btn-warning" href="{{ url('ns-admin/tags') }}">Cancel</a>

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

@include('admin.layouts.ckeditor')

@stop