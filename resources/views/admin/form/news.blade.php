@section('title')

News | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">News</h1>
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
                <?php if (isset($news1)) {
                    echo "Edit Profile";
                } else {
                    echo "Add News";
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
            if (isset($news1)) {
                $action = url('/ns-admin/news/edit/' . $news1->id);
                $button = 'Update';
            } else {
                $action = url('/ns-admin/news/add');
                $button = 'Add';
            } ?>
            <form action="{{$action}}" id="upload_form" class="form-horizontal" method="post" novalidate="novalidate" enctype="multipart/form-data">
                @csrf
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-7-1">

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>News Title</label>
                                    <input type="text" name="news_title" class="form-control" placeholder="News Title" value="<?php if (isset($news1->news_title)) {
                                        echo $news1->news_title;
                                    } else {
                                        echo old('news_title');
                                    } ?>">
                                </div>

                                <div class="form-group">
                                    <label>Writer</label>
                                    <select class="form-control select2_demo_1" name="writer_id[]" multiple="multiple" required>
                                        @foreach($writers as $row)
                                        <option <?php if (isset($news1->writer)) {
                                            foreach ($news1->writer as $author) {
                                                if (isset($news1) && $row->id == $author->pivot->writer_id) {
                                                    echo "selected";
                                                }
                                            }
                                        }
                                        ?> value="{{ $row->id }}">{{ ucwords($row->writer_title) }}</option>
                                        @endforeach
                                    </select>
                                    <a class="btn btn-primary btn-xs" href="{{ url('ns-admin/writers/create') }}">Add Writer</a>
                                </div>

                                <div class="form-group m-form__group">
                                    <label for="description">
                                        News Excerpt
                                    </label>
                                    <textarea class="form-control m-input" name="news_excerpt" rows="5" placeholder="News Excerpt"><?php if (isset($news1->news_excerpt)) {
                                        echo $news1->news_excerpt;
                                    } else {
                                        echo old('news_excerpt');
                                    } ?></textarea>
                                </div>

                                <div class="form-group m-form__group">
                                    <label for="description">
                                        News Details
                                    </label>
                                    <textarea class="form-control m-input ckeditor" id="my-editor" name="news_body" rows="10" placeholder="News Body"><?php if (isset($news1->news_body)) {
                                        echo $news1->news_body;
                                    } else {
                                        echo old('news_body');
                                    } ?></textarea>
                                </div>



                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>News Date</label>
                                    <input type="date" name="news_date" class="form-control" value="<?php if (isset($news1->news_date)) {
                                        echo $news1->news_date->format('Y-m-d');
                                    } else {
                                        echo 'hello';
                                    } ?>">
                                </div>


                                <div class="form-group m-form__group">
                                    <label>
                                        News Category:
                                    </label>
                                    <select class="form-control select2_demo_1" name="news_category_id[]" multiple="multiple" required>
                                        @foreach($categories as $row)
                                        <option <?php if (isset($news1->newscategory)) {
                                            foreach ($news1->newscategory as $CAT) {
                                                if (isset($news1) && $row->id == $CAT->pivot->news_category_id) {
                                                    echo "selected";
                                                }
                                            }
                                        }
                                        ?> value="{{ $row->id }}">{{ ucwords($row->category_title) }}</option>
                                        @endforeach
                                    </select>
                                    <a class="btn btn-primary btn-xs" href="{{ url('ns-admin/newsCategories/create') }}">Add News Category</a>

                                </div>

                                <div class="form-group m-form__group">
                                    <label>
                                        News Tags:
                                    </label>
                                    <select class="form-control select2_demo_1" name="tag_id[]" multiple="multiple" required>
                                        @foreach($tags as $row)
                                        <option <?php if (isset($news1->tag)) {
                                            foreach ($news1->tag as $tag) {
                                                if (isset($news1) && $row->id == $tag->pivot->tag_id) {
                                                    echo "selected";
                                                }
                                            }
                                        }
                                        ?> value="{{ $row->id }}">{{ ucwords($row->tag_title) }}</option>
                                        @endforeach
                                    </select>
                                    <a class="btn btn-primary btn-xs" href="{{ url('ns-admin/tags/create') }}">Add News Tag</a>

                                </div>

                                <div class="form-group m-form__group">
                                    <label for="example_input_full_name">
                                        Embed Code
                                    </label>
                                    <input type="text" name="news_code" class="form-control m-input" placeholder="Embed Code" value="<?php if (isset($news1->news_code)) {
                                        echo $news1->news_code;
                                    } else {
                                        echo old('news_code');
                                    } ?>">
                                </div>

                                <div class="form-group m-form__group">
                                    <label for="example_input_full_name">
                                        External Link (Optional):
                                    </label>
                                    <input type="text" name="external_link" class="form-control m-input" placeholder="External Link" value="<?php if (isset($news1->external_link)) {
                                        echo $news1->external_link;
                                    } else {
                                        echo old('external_link');
                                    } ?>">
                                </div>

                                <div class="form-group">
                                    <label for="pic">
                                        Featured Image (Banner Image)
                                    </label>
                                    <div></div>
                                    <div class="custom-file" style="width:40%">
                                        <input type="file" name="parallex_img" id="pro_image">
                                        <div><br></div>
                                        <img src="" id="profile-img-tag" width="100px" height="58px" style="display:none;" />
                                    </div>

                                    @if (!empty($news1->parallex_img))
                                    <br>
                                    <img id="profile" src="{{ asset('uploads/'.'news/'.$news1->parallex_img) }}" alt="<?php if (isset($news1)) {
                                        echo $news1->category_title;
                                    } ?>" height="100" width="110">
                                    <a title="Delete" id="delete" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></a>

                                    @endif
                                </div>
                                <div><br></div>

                                <div class="check-list">
                                    <label for="">Featured Status</label>
                                    <label class="ui-radio ui-radio-primary">
                                        <input type="radio" name="featured_news" value="0" <?php echo (isset($news1->featured_news) ? ((isset($news1->featured_news) && ($news1->featured_news == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                        <span class="input-span"></span>
                                        No
                                    </label>
                                    <label class="ui-radio ui-radio-primary">
                                        <input type="radio" name="featured_news" value="1" <?php echo (isset($news1->featured_news) && ($news1->featured_news == 1)) ? 'checked="checked"' : ''; ?>>
                                        <span class="input-span"></span>
                                        Yes
                                    </label>
                                </div>

                                

                                <div class="check-list">
                                    <label for="">Publish Status</label>
                                    <label class="ui-radio ui-radio-primary">
                                        <input type="radio" name="publish_status" value="0" <?php echo (isset($news1->publish_status) ? ((isset($news1->publish_status) && ($news1->publish_status == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                        <span class="input-span"></span>
                                        No
                                    </label>
                                    <label class="ui-radio ui-radio-primary">
                                        <input type="radio" name="publish_status" value="1" <?php echo (isset($news1->publish_status) && ($news1->publish_status == 1)) ? 'checked="checked"' : ''; ?>>
                                        <span class="input-span"></span>
                                        Yes
                                    </label>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab-7-3">
                        <div class="form-group">
                            <label>Meta Title</label>
                            <textarea class="form-control" name="meta_title" rows="4" placeholder="Enter Meta Title"><?php if (isset($news1->meta_title)) {
                                echo $news1->meta_title;
                            } else {
                                echo old('meta_title');
                            } ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Meta Keywords</label>
                            <textarea class="form-control" name="meta_keyword" rows="5" placeholder="Enter Meta Keywords"><?php if (isset($news1->meta_keyword)) {
                                echo $news1->meta_keyword;
                            } else {
                                echo old('meta_keyword');
                            } ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Meta Description</label>
                            <textarea class="form-control" name="meta_description" rows="6" placeholder="Enter Meta Description"><?php if (isset($news1->meta_description)) {
                                echo $news1->meta_description;
                            } else {
                                echo old('meta_description');
                            } ?></textarea>
                        </div>

                    </div>
                </div><br>
                <button class="btn btn-info" type="submit">Submit</button>
                <a class="btn btn-warning" href="{{ url('ns-admin/news') }}">Cancel</a>

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
        $('#pro_image').change(function(e) {
            e.preventDefault();
            var formData = new FormData(upload_form);
            $.ajax({
                url: '{{route('news.image')}}',
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