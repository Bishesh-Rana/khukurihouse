@section('title')

Contents | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Contents</h1>
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
                <?php if (isset($content)) {
                    echo "Edit Content";
                } else {
                    echo "Add Content";
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
            if (isset($content)) {
                $action = url('/ns-admin/contents/edit/' . $content->id);
                $button = 'Update';
            } else {
                $action = url('/ns-admin/contents/add');
                $button = 'Add';
            } ?>
            <form action="{{$action}}" id="upload_form" class="form-horizontal" method="post" novalidate="novalidate" enctype="multipart/form-data">
                @csrf
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-7-1">

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Content Title</label>
                                    <input type="text" name="content_title" class="form-control" placeholder="Content Title" value="<?php if (isset($content->content_title)) {
                                                                                                                                        echo $content->content_title;
                                                                                                                                    } else {
                                                                                                                                        echo old('content_title');
                                                                                                                                    } ?>">
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Page Type</label>
                                    <select name="content_type" class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1">
                                        <option value="none" disabled> ---Select Page Type --- </option>
                                        <option @php if (isset($content) && $content->content_type === 'about') {
                                                    echo "selected";
                                                } @endphp value="about">About</option>
                                        <option @php if (isset($content) && $content->content_type === 'news') {
                                                    echo "selected";
                                                } @endphp value="news">News</option>
                                        {{-- <option @php if (isset($content) && $content->content_type === 'service') {
                                                    echo "selected";
                                                } @endphp value="service">Service</option>
                                        <option @php if (isset($content) && $content->content_type === 'service-icon') {
                                                    echo "selected";
                                                } @endphp value="service-icon">Service Icon</option>
                                        <option @php if (isset($content) && $content->content_type === 'service-selected') {
                                                    echo "selected";
                                                } @endphp value="service-selected">Service Selected</option> --}}
                                        <option @php if (isset($content) && $content->content_type === 'contact') {
                                                    echo "selected";
                                                } @endphp value="contact">Contact</option>
                                        {{-- <option @php if (isset($content) && $content->content_type === 'team') {
                                                    echo "selected";
                                                } @endphp value="team">Team</option>
                                        <option @php if (isset($content) && $content->content_type === 'brand') {
                                                    echo "selected";
                                                } @endphp value="brand">Brand</option>
                                        <option @php if (isset($content) && $content->content_type === 'category') {
                                                    echo "selected";
                                                } @endphp value="category">Category</option>
                                        <option @php if (isset($content) && $content->content_type === 'product') {
                                                    echo "selected";
                                                } @endphp value="product">Product</option> --}}
                                        <option @php if (isset($content) && $content->content_type === 'page') {
                                                    echo "selected";
                                                } @endphp value="page">Page</option>
                                        {{-- <option @php if (isset($content) && $content->content_type === 'gallery') {
                                                    echo "selected";
                                                } @endphp value="gallery">Gallery</option>
                                        <option @php if (isset($content) && $content->content_type === 'video') {
                                                    echo "selected";
                                                } @endphp value="video">Video</option> --}}
                                        {{-- <option @php if (isset($content) && $content->content_type === 'testimonial') {
                                                    echo "selected";
                                                } @endphp value="testimonial">Testimonial</option>
                                        <option @php if (isset($content) && $content->content_type === 'faq') {
                                                    echo "selected";
                                                } @endphp value="faq">FAQ</option> --}}
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="pic">
                                        Featured Image (Banner Image)
                                    </label>

                                    <input type="file" name="featured_img" id="par_image">
                                    <img src="" id="profile-img-tag" width="200px"/>
                                    @if (!empty($content->featured_img))
                                    <hr>
                                    <img src="{{ asset('uploads/'.'contents/'.$content->featured_img) }}" alt="<?php if (isset($content)) {
                                                                                                                    echo $content->content_title;
                                                                                                                } ?>" height="50" width="50" id="db_image">
                                   <a title="Delete" id="delete" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></a>

                                    {{-- <a class="btn btn-danger btn-circle btn-xs" href="{{url('ns-admin/contents/removeFeature/'.$content->featured_img)}}" onclick="return confirm('Do You Really Wanna Delete?')">
                                        <i class="fa fa-times"></i>
                                    </a> --}}
                                    @endif
                                </div>


                                <div class="form-group m-form__group">
                                    <label for="description">
                                        Content Details
                                    </label>
                                    <textarea class="form-control m-input ckeditor" id="my-editor" name="content_body" rows="10" placeholder="Content Body"><?php if (isset($content->content_body)) {
                                                                                                                                                echo $content->content_body;
                                                                                                                                            } else {
                                                                                                                                                echo old('content_body');
                                                                                                                                            } ?></textarea>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group m-form__group">
                                    <label for="example_input_full_name">
                                        Content Icon
                                    </label>
                                    <input type="text" name="content_icon" class="form-control m-input" placeholder="Content Icon" value="<?php if (isset($content->content_icon)) {
                                                                                                                                                echo $content->content_icon;
                                                                                                                                            } else {
                                                                                                                                                echo old('content_icon');
                                                                                                                                            } ?>">
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Parent Menu</label>
                                    <select name="parent_id" class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1">
                                        <option value="0">None</option>
                                        @foreach($contents as $row)
                                        <option <?php if (isset($content) && $row->id == $content->parent_id) {
                                                    echo "selected";
                                                } ?> value="{{ $row->id }}">{{ ucwords($row->content_title) }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group m-form__group">
                                    <label>
                                        Select Products:
                                    </label>
                                    <select class="form-control select2_demo_1" name="product_id[]" multiple="multiple" required>
                                        @foreach($products as $row)
                                        <option <?php if (isset($content->products))
                                                    foreach ($content->products as $prod) {
                                                        if (isset($content) && $row->id == $prod->pivot->product_id) {
                                                            echo "selected";
                                                        }
                                                    } ?> value="{{ $row->id }}">{{ ucwords($row->product_name) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Position</label>
                                    <input type="number" id="position" name="position" class="form-control" placeholder="Position" value="<?php if (isset($content->position)) {
                                                                                                                                                echo $content->position;
                                                                                                                                            } else {
                                                                                                                                                echo ('1');
                                                                                                                                            } ?>">
                                </div>

                                <div class="form-group m-form__group">
                                    <label for="example_input_full_name">
                                        External Link (Optional):
                                    </label>
                                    <input type="text" name="external_link" class="form-control m-input" placeholder="External Link" value="<?php if (isset($content->external_link)) {
                                                                                                                                                echo $content->external_link;
                                                                                                                                            } else {
                                                                                                                                                echo old('external_link');
                                                                                                                                            } ?>">
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="check-list">
                                            <label for="Show On Menu">Show On Menu</label>
                                            <label class="ui-radio ui-radio-primary">
                                                <input type="radio" name="show_on_menu" value="N" <?php echo (isset($content->show_on_menu) ? ((isset($content->show_on_menu) && ($content->show_on_menu == 'N')) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                                <span class="input-span"></span>
                                                None
                                            </label>
                                            <label class="ui-radio ui-radio-primary">
                                                <input type="radio" name="show_on_menu" value="H" <?php echo (isset($content->show_on_menu) && ($content->show_on_menu == 'H')) ? 'checked="checked"' : ''; ?>>
                                                <span class="input-span"></span>
                                                Header
                                            </label>
                                            <label class="ui-radio ui-radio-primary">
                                                <input type="radio" name="show_on_menu" value="F" <?php echo (isset($content->show_on_menu) && ($content->show_on_menu == 'F')) ? 'checked="checked"' : ''; ?>>
                                                <span class="input-span"></span>
                                                Footer
                                            </label>
                                            <label class="ui-radio ui-radio-primary">
                                                <input type="radio" name="show_on_menu" value="B" <?php echo (isset($content->show_on_menu) && ($content->show_on_menu == 'B')) ? 'checked="checked"' : ''; ?>>
                                                <span class="input-span"></span>
                                                Both
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="check-list">
                                            <label for="">Publish Status</label>
                                            <label class="ui-radio ui-radio-primary">
                                                <input type="radio" name="publish_status" value="0" <?php echo (isset($content->publish_status) ? ((isset($content->publish_status) && ($content->publish_status == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                                <span class="input-span"></span>
                                                Banned
                                            </label>
                                            <label class="ui-radio ui-radio-primary">
                                                <input type="radio" name="publish_status" value="1" <?php echo (isset($content->publish_status) && ($content->publish_status == 1)) ? 'checked="checked"' : ''; ?>>
                                                <span class="input-span"></span>
                                                Active
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab-7-3">
                        <div class="form-group">
                            <label>Meta Title</label>
                            <textarea class="form-control" name="meta_title" rows="4" placeholder="Enter Meta Title"><?php if (isset($content->meta_title)) {
                                                                                                                            echo $content->meta_title;
                                                                                                                        } else {
                                                                                                                            echo old('meta_title');
                                                                                                                        } ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Meta Keywords</label>
                            <textarea class="form-control" name="meta_keyword" rows="5" placeholder="Enter Meta Keywords"><?php if (isset($content->meta_keyword)) {
                                                                                                                                echo $content->meta_keyword;
                                                                                                                            } else {
                                                                                                                                echo old('meta_keyword');
                                                                                                                            } ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Meta Description</label>
                            <textarea class="form-control" name="meta_description" rows="6" placeholder="Enter Meta Description"><?php if (isset($content->meta_description)) {
                                                                                                                                        echo $content->meta_description;
                                                                                                                                    } else {
                                                                                                                                        echo old('meta_description');
                                                                                                                                    } ?></textarea>
                        </div>

                    </div>
                </div><br>
                <button class="btn btn-info" type="submit">Submit</button>
                <a class="btn btn-warning" href="{{ url('ns-admin/contents') }}">Cancel</a>

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
        $('#delete').on('click',function(){
            $('#db_image').css('display', 'none');
            $('#delete').css('display', 'none');
        });
        $('#par_image').change(function(e) {
            e.preventDefault();
            var formData = new FormData(upload_form);
            $.ajax({
                url: "{{route('content.image')}}",
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
                            msg: resp.message['featured_img'],
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

            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);
                $('#db_image').css('display', 'none');
                $('#delete').css('display', 'none');

            }
            reader.readAsDataURL(input.files[0]);
        }
  }
        });
    });
</script>

@include('admin.layouts.ckeditor')

@stop
