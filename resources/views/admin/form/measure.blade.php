@section('title')

Measures | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Measures</h1>
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
                <?php if (isset($measure)) {
                    echo "Edit Measure";
                } else {
                    echo "Add Measure";
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
            if (isset($measure)) {
                $action = url('/ns-admin/measures/edit/' . $measure->id);
                $button = 'Update';
            } else {
                $action = url('/ns-admin/measures/add');
                $button = 'Add';
            } ?>
            <form action="{{$action}}" id="upload_form" class="form-horizontal" method="post" novalidate="novalidate" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Measure Name</label>
                            <input class="form-control" type="text" name="measure_name" placeholder="Enter the Name" value="<?php if (isset($measure->measure_name)) {
                                echo $measure->measure_name;
                            } else {
                                echo old('measure_name');
                            } ?>">
                        </div>
                    </div>
                    
                    <div class="col-md-6">

                        <div class="check-list">
                            <label for="">Publish Status</label>
                            <label class="ui-radio ui-radio-primary">
                                <input type="radio" name="publish_status" value="0" <?php echo (isset($measure->publish_status) ? ((isset($measure->publish_status) && ($measure->publish_status == 0)) ? 'checked="checked"' : '') : 'checked="checked"'); ?>>
                                <span class="input-span"></span>
                                Banned
                            </label>
                            <label class="ui-radio ui-radio-primary">
                                <input type="radio" name="publish_status" value="1" <?php echo (isset($measure->publish_status) && ($measure->publish_status == 1)) ? 'checked="checked"' : ''; ?>>
                                <span class="input-span"></span>
                                Active
                            </label>
                        </div>
                    </div>
                </div>
                
                <button class="btn btn-info" type="submit">Submit</button>
                <a class="btn btn-warning" href="{{ url('ns-admin/measures') }}">Cancel</a>
                
            </form>
        </div>
        
    </div>
</div>
<!-- END PAGE CONTENT-->

@stop