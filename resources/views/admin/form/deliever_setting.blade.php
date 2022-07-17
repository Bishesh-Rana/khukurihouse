@section('title')

Deliever Setting | {{env('APP_NAME')}}

@stop
@extends('admin.layouts.app')

@section('content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Deliever</h1>
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
                <?php if (isset($deliver_setting)) {
                    echo "Edit Deliver Setting";
                } else {
                    echo "Add Deliver Setting";
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
            if (isset($deliver_setting)) {
                $action = route('admin.deliever_setting.update', $deliver_setting->id);
                $button = 'Update';
            } else {
                $action = route('admin.deliever_setting.add');
                $button = 'Add';
            } ?>
            <form action="{{$action}}" id="upload_form" class="form-horizontal" method="post">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Source</label>
                            <input class="form-control" type="text" name="source" placeholder="Source" readonly value="Kathmandu">
                        </div>
                        
                        <div class="form-group">
                            <label>Min Weight</label>
                            <input class="form-control" type="number" min="0" name="weight_min" value="<?php if (isset($deliver_setting->weight_min)) {
                                echo $deliver_setting->weight_min;
                            } else {
                                echo old('weight_min');
                            } ?>">
                        </div>
                        
                    </div>
                    
                    <div class="col-md-6">
                        
                        <div class="form-group">
                            <label>Destination</label>
                            <input class="form-control" type="text" name="destination" placeholder="Enter your destination" value="<?php if (isset($deliver_setting->destination)) {
                                echo $deliver_setting->destination;
                            } else {
                                echo old('destination');
                            } ?>">
                        </div>
                     
                        
                        <div class="form-group">
                            <label>Max Weight</label>
                            <input class="form-control" type="number" min="1" name="weight_max"  value="<?php if (isset($deliver_setting->weight_max)) {
                                echo $deliver_setting->weight_max;
                            } else {
                                echo old('weight_max');
                            } ?>">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Rate</label>
                            <input class="form-control" type="number" min="1" name="rate"  value="<?php if (isset($deliver_setting->rate)) {
                                echo $deliver_setting->rate;
                            } else {
                                echo old('rate');
                            } ?>">
                        </div>
                    </div>
                  
                </div>
                
            <button class="btn btn-info" type="submit">{{ $button }}</button>
                <a class="btn btn-warning" href="{{ route('admin.deliever_setting.list')}}">Cancel</a>
                
            </form>
        </div>
        
    </div>
</div>
<!-- END PAGE CONTENT-->

@stop
