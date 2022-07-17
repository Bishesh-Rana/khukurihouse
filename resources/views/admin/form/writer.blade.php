@section('title')

Writers | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Writers</h1>
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
                <?php if (isset($writer)) {
                    echo "Edit";
                } else {
                    echo "Add";
                } ?> Writer
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
                    <a class="nav-link active" href="#tab-7-1" data-toggle="tab">Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tab-7-3" data-toggle="tab">Social</a>
                </li>
            </ul>
            <?php
            if (isset($writer)) {
                $action = url('/ns-admin/writers/edit/' . $writer->id);
                $button = 'Update';
            } else {
                $action = url('/ns-admin/writers/add');
                $button = 'Add';
            } ?>
            <form action="{{$action}}" id="upload_form" class="form-horizontal" method="post" novalidate="novalidate" enctype="multipart/form-data">
                @csrf
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-7-1">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Writer Name</label>
                                    <input type="text" name="writer_title" class="form-control" placeholder="Writer Name" value="<?php if (isset($writer->writer_title)) {
                                                                                                                                        echo $writer->writer_title;
                                                                                                                                    } else {
                                                                                                                                        echo old('writer_title');
                                                                                                                                    } ?>">
                                </div>

                                <div class="form-group">
                                    <label>Writer Designation</label>
                                    <input type="text" name="writer_designation" class="form-control" placeholder="Writer Designation" value="<?php if (isset($writer->writer_designation)) {
                                                                                                                                                    echo $writer->writer_designation;
                                                                                                                                                } else {
                                                                                                                                                    echo old('writer_designation');
                                                                                                                                                } ?>">
                                </div>


                                <div class="form-group m-form__group">
                                    <label>
                                        Phone:
                                    </label>
                                    <input type="text" name="writer_phone" class="form-control m-input" placeholder="Phone" value="<?php if (isset($writer->writer_phone)) {
                                                                                                                                        echo $writer->writer_phone;
                                                                                                                                    } else {
                                                                                                                                        echo old('writer_phone');
                                                                                                                                    } ?>">
                                </div>

                                <div class="form-group m-form__group">
                                    <label>
                                        Address:
                                    </label>
                                    <input type="text" name="writer_address" class="form-control m-input" placeholder="Address" value="<?php if (isset($writer->writer_address)) {
                                                                                                                                            echo $writer->writer_address;
                                                                                                                                        } else {
                                                                                                                                            echo old('writer_address');
                                                                                                                                        } ?>">
                                </div>

                                <div class="form-group m-form__group">
                                    <label>
                                        Email:
                                    </label>
                                    <input type="text" name="writer_email" class="form-control m-input" placeholder="Email" value="<?php if (isset($writer->writer_email)) {
                                                                                                                                        echo $writer->writer_email;
                                                                                                                                    } else {
                                                                                                                                        echo old('writer_email');
                                                                                                                                    } ?>">
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="description">
                                        Writer Details
                                    </label>
                                    <textarea class="form-control ckeditor" id="my-editor" name="writer_body" rows="5" placeholder="Writer Details"><?php if (isset($writer->writer_body)) {
                                                                                                                                        echo $writer->writer_body;
                                                                                                                                    } else {
                                                                                                                                        echo old('writer_body');
                                                                                                                                    } ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Featured Image</label>

                                    <div></div>
                                    <div class="custom-file" style="width:40%">
                                        <input type="file" name="featured_img" id="pro_image">
                                        <div><br></div>
                                        <img src="" id="profile-img-tag" width="100px" height="58px" style="display:none;" />
                                    </div>

                                    @if (!empty($writer->featured_img))
                                    <br>
                                    <img id="profile" src="{{ asset('uploads/'.'writers/'.$writer->featured_img) }}" alt="<?php if (isset($writer)) {
                                                                                                                    echo $writer->writer_title;
                                                                                                                } ?>" height="100" width="100">
                                    <a title="Delete" id="delete" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></a>

                                    @endif
                                </div>
                                <div><br></div>

                                <div class="check-list">
                                    <label for="">Status</label>
                                    <label class="ui-radio ui-radio-primary">
                                            <input type="radio" name="publish_status" value="0" <?php echo (isset($writer->publish_status) ? ((isset($writer->publish_status) && ($writer->publish_status == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                            <span class="input-span"></span>Inactive
                                        </label>
                                        <label class="ui-radio ui-radio-primary">
                                            <input type="radio" name="publish_status" value="1" <?php echo (isset($writer->publish_status) && ($writer->publish_status == 1)) ? 'checked="checked"' : ''; ?>>
                                            <span class="input-span"></span>Active
                                        </label>
                                </div>

                                <div class="check-list">
                                    <label for="">Writer Type</label>
                                    <label class="ui-radio ui-radio-primary">
                                            <input type="radio" name="writer_type" value="reporter" <?php echo (isset($writer->writer_type) ? ((isset($writer->writer_type) && ($writer->writer_type == 'reporter')) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                            <span class="input-span"></span>Reporter
                                        </label>
                                        <label class="ui-radio ui-radio-primary">
                                            <input type="radio" name="writer_type" value="guest" <?php echo (isset($writer->writer_type) && ($writer->writer_type == 'guest')) ? 'checked="checked"' : ''; ?>>
                                            <span class="input-span"></span>Guest
                                        </label>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab-7-3">
                        <div class="form-group m-form__group">
                            <label>
                                Facebook:
                            </label>
                            <input type="text" name="writer_facebook" class="form-control m-input" placeholder="Facebook" value="<?php if (isset($writer->writer_facebook)) {
                                                                                                                                        echo $writer->writer_facebook;
                                                                                                                                    } else {
                                                                                                                                        echo old('writer_facebook');
                                                                                                                                    } ?>">
                        </div>

                        <div class="form-group m-form__group">
                            <label>
                                YouTube:
                            </label>
                            <input type="text" name="writer_youtube" class="form-control m-input" placeholder="YouTube" value="<?php if (isset($writer->writer_youtube)) {
                                                                                                                                    echo $writer->writer_youtube;
                                                                                                                                } else {
                                                                                                                                    echo old('writer_youtube');
                                                                                                                                } ?>">
                        </div>

                        <div class="form-group m-form__group">
                            <label>
                                Twitter:
                            </label>
                            <input type="text" name="writer_twitter" class="form-control m-input" placeholder="Twitter" value="<?php if (isset($writer->writer_twitter)) {
                                                                                                                                    echo $writer->writer_twitter;
                                                                                                                                } else {
                                                                                                                                    echo old('writer_twitter');
                                                                                                                                } ?>">
                        </div>
                    </div>
                </div><br>
                <button class="btn btn-info" type="submit">Submit</button>
                <a class="btn btn-warning" href="{{ url('ns-admin/writers') }}">Cancel</a>

            </form>

        </div>
    </div>
</div>

@endsection

@section('footer')

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
                url: '{{url('/ns-admin/writer/image')}}',
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
@endsection