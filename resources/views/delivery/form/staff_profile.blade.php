@section('title')

Profile | {{env('APP_NAME')}}

@stop
@extends('delivery.layouts.app')

@section('custom-css')
<link rel="stylesheet" href="{{ asset('customcss/custom.css') }}">
@endsection

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">
        Update Profile
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#"><i class="la la-home font-20"></i></a>
        </li>
    </ol>
</div>

<br />

@include('admin.layouts.error')
<form method="POST" id="upload_form" action="{{ url('ns-delivery/my-profile/update/'.$staff->id) }}" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>First Name</label>
                <input class="form-control" type="text" name="first_name" placeholder="Enter first name" value="<?php if (isset($staff->first_name)) {
                                                                                                                    echo $staff->first_name;
                                                                                                                } else {
                                                                                                                    echo old('first_name');
                                                                                                                } ?>">
            </div>

            <div class="form-group">
                <label>Last Name</label>
                <input class="form-control" type="text" name="last_name" placeholder="Enter last name" value="<?php if (isset($staff->last_name)) {
                                                                                                                    echo $staff->last_name;
                                                                                                                } else {
                                                                                                                    echo old('last_name');
                                                                                                                } ?>">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input class="form-control" id="password" type="password" name="password" placeholder="Enter password">
            </div>

            <div class="form-group">
                <label>Password Confirmation</label>
                <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm password">
            </div>
        </div>

        <div class="col-md-6">
        <div class="form-group">
                <label>Email</label>
                <input class="form-control" type="text" name="email" placeholder="Enter email" value="<?php if (isset($staff->email)) {
                                                                                                        echo $staff->email;
                                                                                                    } else {
                                                                                                        echo old('email');
                                                                                                    } ?>">
            </div>

            <div class="form-group">
                <label>Profile Picture</label>
                <div></div>
                <div class="custom-file" style="width:40%">
                    <input type="file" name="image" id="pro_image">
                    <img src="" id="profile-img-tag" width="100px" height="58px" style="display:none;" />
                                                                                                
                </div>
                @if (!empty($staff->image))
                <hr>
                <img id="profile" src="{{ asset('uploads/'.'deliveries/'.$staff->image) }}" alt="<?php if (isset($staff->first_name)) {
                                                                                    echo $staff->first_name;
                                                                                } ?>" height="100" width="100">
                <a title="Delete" id="delete" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></a>

                @endif
            </div>

            <div class="check-list">
                <label for="">Publish Status</label>
                <label class="ui-radio ui-radio-primary">
                    <input type="radio" name="publish_status" value="0" <?php echo (isset($staff->publish_status) ? ((isset($staff->publish_status) && ($staff->publish_status == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                    <span class="input-span"></span>
                    Banned
                </label>
                <label class="ui-radio ui-radio-primary">
                    <input type="radio" name="publish_status" value="1" <?php echo (isset($staff->publish_status) && ($staff->publish_status == 1)) ? 'checked="checked"' : ''; ?>>
                    <span class="input-span"></span>
                    Active
                </label>
            </div>
        </div>
    </div><br>
    {{-- /. What You Are Selling Section --}}

    <button class="btn btn-info" type="submit">Update</button>
    
</form>


<!-- END PAGE CONTENT-->
@stop

@section('footer')


<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#profile-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#pro_image").change(function() {
        $('#profile-img-tag').css('display', '');
        readURL(this);
    });
</script>

<!-- Delete(Hide) image -->
<script>
    $(document).ready(function() {
        $('a#delete').click(function(){
            $('#profile').css('display', 'none');
            $('a#delete').css('display', 'none');
        })
    });
</script>

@stop