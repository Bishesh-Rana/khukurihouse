@section('title')

    Settings | {{ env('APP_NAME') }}

@stop
@extends('admin.layouts.app')

@section('content')

    <!-- START PAGE CONTENT-->
    <div class="page-heading">
        <h1 class="page-title">Settings</h1>
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
                    <?php if (isset($setting)) {
                        echo 'Edit Profile';
                    } else {
                        echo 'Add Setting';
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
                        <a class="nav-link" href="#tab-7-2" data-toggle="tab">Social</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-7-3" data-toggle="tab">Meta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-7-4" data-toggle="tab">Others</a>
                    </li>
                </ul>
                <?php
                if (isset($setting)) {
                    $action = url('/ns-admin/settings/edit/' . $setting->id);
                    $button = 'Update';
                } else {
                    $action = url('/ns-admin/settings/add');
                    $button = 'Add';
                } ?>
                <form action="{{ $action }}" id="upload_form" class="form-horizontal" method="post"
                    novalidate="novalidate" enctype="multipart/form-data">
                    @csrf
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-7-1">

                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Site Name</label>
                                        <input class="form-control" type="text" name="site_name"
                                            placeholder="Enter your site name" value="<?php if (isset($setting->site_name)) {
    echo $setting->site_name;
} else {
    echo old('site_name');
} ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" type="text" name="email"
                                            placeholder="Enter your email" value="<?php if (isset($setting->email)) {
    echo $setting->email;
} else {
    echo old('email');
} ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Site URL</label>
                                        <input class="form-control" type="text" name="site_url"
                                            placeholder="Enter your site url" value="<?php if (isset($setting->site_url)) {
    echo $setting->site_url;
} else {
    echo old('site_url');
} ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Map Embed Link</label>
                                        <textarea class="form-control ckeditor" id="my-editor" name="map_embed_link"
                                            rows="5" placeholder=""><?php if (isset($setting->map_embed_link)) {
    echo $setting->map_embed_link;
} else {
    echo old('map_embed_link');
} ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Map Link</label>
                                        <input class="form-control" type="text" name="map_link"
                                            placeholder="Enter your map link" value="<?php if (isset($setting->map_link)) {
    echo $setting->map_link;
} else {
    echo old('map_link');
} ?>">
                                    </div>



                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input class="form-control" type="text" name="address"
                                                placeholder="Enter your address" value="<?php if (isset($setting->address)) {
    echo $setting->address;
} else {
    echo old('address');
} ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input class="form-control" type="text" name="phone"
                                                placeholder="Enter your phone" value="<?php if (isset($setting->phone)) {
    echo $setting->phone;
} else {
    echo old('phone');
} ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">
                                            Hours of operation
                                        </label>
                                        <textarea class="form-control ckeditor" id="operation" name="operation" rows="5"
                                            placeholder=""><?php if (isset($setting->operation)) {
                                                echo $setting->operation;
                                            } else {
                                                echo old('operation');
                                            } ?></textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Site Logo</label>
                                                <div></div>
                                                <div class="custom-file" style="width:40%">
                                                    <input type="file" name="site_logo" id="pro_image">
                                                    <div><br></div>
                                                    <img src="" id="profile-img-tag" width="100px" height="58px"
                                                        style="display:none;" />
                                                </div>
                                                @if (!empty($setting->site_logo))
                                                    <br>
                                                    <img id="site-logo"
                                                        src="{{ asset('uploads/' . 'settings/' . $setting->site_logo) }}"
                                                        alt="<?php if (isset($setting->site_name)) {
                                                            echo $setting->site_name;
                                                        } ?>" height="100" width="220">
                                                    <!-- <a title="Delete" id="delete" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></a> -->
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Favicon</label>
                                                <div></div>
                                                <div class="custom-file" style="width:40%">
                                                    <input type="file" name="site_mini_logo" id="site_mini">
                                                    <div><br></div>
                                                    <img src="" id="mini-img-tag" width="50px" height="50px"
                                                        style="display:none;" />
                                                </div>
                                                @if (!empty($setting->site_mini_logo))
                                                    <br>
                                                    <img id="site-logo-mini"
                                                        src="{{ asset('uploads/' . 'settings/' . $setting->site_mini_logo) }}"
                                                        alt="<?php if (isset($setting->site_name)) {
                                                            echo $setting->site_name;
                                                        } ?>" height="50" width="50">
                                                    <!-- <a title="Delete" id="delete" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></a> -->
                                                @endif
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab-7-2">

                            <div class="form-group">
                                <label>Facebook</label>
                                <input class="form-control" type="text" name="facebook" placeholder="Enter Facebook Name"
                                    value="<?php if (isset($setting->facebook)) {
                                        echo $setting->facebook;
                                    } else {
                                        echo old('facebook');
                                    } ?>">
                            </div>


                            <div class="form-group">
                                <label>Twitter</label>
                                <input class="form-control" type="text" name="twitter" placeholder="Enter Twitter Link"
                                    value="<?php if (isset($setting->twitter)) {
                                        echo $setting->twitter;
                                    } else {
                                        echo old('twitter');
                                    } ?>">
                            </div>

                            <div class="form-group">
                                <label>Instagram</label>
                                <input class="form-control" type="text" name="instagram"
                                    placeholder="Enter your Instagram Link" value="<?php if (isset($setting->instagram)) {
    echo $setting->instagram;
} else {
    echo old('instagram');
} ?>">
                            </div>

                            <div class="form-group">
                                <label>LinkedIn</label>
                                <input class="form-control" type="text" name="linkedin"
                                    placeholder="Enter your LinkedIn Link" value="<?php if (isset($setting->linkedin)) {
    echo $setting->linkedin;
} else {
    echo old('linkedin');
} ?>">
                            </div>

                            <div class="form-group">
                                <label>YouTube</label>
                                <input class="form-control" type="text" name="youtube"
                                    placeholder="Enter your YouTube Link" value="<?php if (isset($setting->youtube)) {
    echo $setting->youtube;
} else {
    echo old('youtube');
} ?>">
                            </div>

                            <div class="form-group">
                                <label>Viber</label>
                                <input class="form-control" type="text" name="viber" placeholder="Enter your Viber"
                                    value="<?php if (isset($setting->viber)) {
                                        echo $setting->viber;
                                    } else {
                                        echo old('viber');
                                    } ?>">
                            </div>

                            <div class="form-group">
                                <label>WhatsApp</label>
                                <input class="form-control" type="text" name="whatsapp"
                                    placeholder="Enter your WhatsApp Link" value="<?php if (isset($setting->whatsapp)) {
    echo $setting->whatsapp;
} else {
    echo old('whatsapp');
} ?>">
                            </div>

                        </div>

                        <div class="tab-pane" id="tab-7-3">
                            <div class="form-group">
                                <label>Meta Title</label>
                                <textarea class="form-control" name="meta_title" rows="4"
                                    placeholder="Enter Meta Title"><?php if (isset($setting->meta_title)) {
    echo $setting->meta_title;
} else {
    echo old('meta_title');
} ?></textarea>
                            </div>

                            <div class="form-group">
                                <label>Meta Keywords</label>
                                <textarea class="form-control" name="meta_keyword" rows="5"
                                    placeholder="Enter Meta Keywords"><?php if (isset($setting->meta_keyword)) {
    echo $setting->meta_keyword;
} else {
    echo old('meta_keyword');
} ?></textarea>
                            </div>

                            <div class="form-group">
                                <label>Meta Description</label>
                                <textarea class="form-control" name="meta_description" rows="6"
                                    placeholder="Enter Meta Description"><?php if (isset($setting->meta_description)) {
    echo $setting->meta_description;
} else {
    echo old('meta_description');
} ?></textarea>
                            </div>

                        </div>

                        <div class="tab-pane" id="tab-7-4">

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Dollar Rate</label>
                                            <input class="form-control" type="number" name="dollar_rate"
                                                placeholder="Enter dollar rate" value="<?php if (isset($setting->dollar_rate)) {
    echo $setting->dollar_rate;
} else {
    echo old('dollar_rate');
} ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>VAT</label>
                                            <input class="form-control" type="number" name="vat" placeholder="Enter vat"
                                                value="<?php if (isset($setting->vat)) {
                                                    echo $setting->vat;
                                                } else {
                                                    echo old('vat');
                                                } ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Payment Fee</label>
                                            <input class="form-control" type="number" name="payment_fee"
                                                placeholder="Enter your payment_fee" value="<?php if (isset($setting->payment_fee)) {
    echo $setting->payment_fee;
} else {
    echo old('payment_fee');
} ?>">
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Refer Reward (In numbers)</label>
                                            <input class="form-control" type="number" name="refer_reward"
                                                placeholder="Ex: 50" value="<?php if (isset($setting->refer_reward)) {
    echo $setting->refer_reward;
} else {
    echo old('refer_reward');
} ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Register Reward (In numbers)</label>
                                            <input class="form-control" type="number" name="register_reward"
                                                placeholder="Ex: 50" value="<?php if (isset($setting->register_reward)) {
    echo $setting->register_reward;
} else {
    echo old('register_reward');
} ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Purchase Reward (In points)</label>
                                            <input class="form-control" type="number" name="purchase_reward"
                                                placeholder="Ex: 2" value="<?php if (isset($setting->purchase_reward)) {
    echo $setting->purchase_reward;
} else {
    echo old('purchase_reward');
} ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="expressCharge">Express Charge</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="expressCharge" placeholder="expressCharge"
                                                min="0" max="100" value="{{ @$setting->expressCharge }}">
                                            <div class="input-group-addon">%</div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="form-group">
                                <label>Privacy Policy</label>
                                <textarea class="form-control ckeditor" id="my-editor" name="privacy_policy" rows="4"
                                    placeholder="Enter Privacy Policy"><?php if (isset($setting->privacy_policy)) {
    echo $setting->privacy_policy;
} else {
    echo old('privacy_policy');
} ?></textarea>
                            </div>

                            <div class="form-group">
                                <label>Terms and Conditions</label>
                                <textarea class="form-control ckeditor" id="my-editor" name="terms_and_conditions" rows="4"
                                    placeholder="Enter Privacy Policy"><?php if (isset($setting->terms_and_conditions)) {
    echo $setting->terms_and_conditions;
} else {
    echo old('terms_and_conditions');
} ?></textarea>
                            </div>


                        </div>
                    </div><br>
                    <button class="btn btn-info" type="submit">Submit</button>
                    <a class="btn btn-warning" href="{{ url('ns-admin/settings') }}">Cancel</a>

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
                    url: "{{ url('/ns-admin/settings/image') }}",
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
                $('#site-logo').css('display', 'none');
                $('#delete').css('display', 'none');
                readURL(this);


            });

            $('#site_mini').change(function(e) {
                function readURL1(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('#mini-img-tag').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }
                $('#mini-img-tag').css('display', '');
                $('#site-logo-mini').css('display', 'none');
                $('#delete').css('display', 'none');
                readURL1(this);
            });

        });
    </script>

    <!-- Delete(Hide) image -->
    <script>
        $(document).ready(function() {
            $('a#delete').click(function() {
                $('img#site-logo').hide();
                $('a#delete').hide();
            })
        });
    </script>

    @include('admin.layouts.ckeditor')

@stop
