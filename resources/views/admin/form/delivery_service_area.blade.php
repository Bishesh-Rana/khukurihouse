@section('title')

    Deliever Service Area | {{ env('APP_NAME') }}

@stop
@extends('admin.layouts.app')

@section('content')

    <!-- START PAGE CONTENT-->
    <div class="page-heading">
        <h1 class="page-title">Delivery Service Area</h1>
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
                        echo 'Edit Deliver Service Area';
                    } else {
                        echo 'Add Deliver Service Area';
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
                    $action = route('deliveryServiceArea.update', $deliver_setting->id);
                    $button = 'Update';
                } else {
                    $action = route('deliveryServiceArea.store');
                    $button = 'Add';

                } ?>
                <form action="{{ $action }}" id="upload_form" class="form-horizontal" method='post'>
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Delivery Service Area Name</label>
                                <input class="form-control" type="text" name="area_name"
                                    placeholder="Delivery Service Area Name" value="{{ @$deliver_setting->area_name }}">
                            </div>
                            <div class="form-group">
                                <label>Select District</label>
                                <select class="form-control select2" multiple="multiple" name="districts[]">
                                    @foreach ($districts as $item)
                                        <option value="{{ $item->dist_id }}" {{in_array($item->dist_id,$selected) ? 'selected' : ''}}>{{ $item->en_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="col-md-6">


                            <div class="form-group">
                                <label>Standard Delivery Charge</label>
                                <input class="form-control" type="number" min="1" name="rate"
                                    placeholder="Delivery Charge" value="<?php if (isset($deliver_setting->rate)) {
    echo $deliver_setting->rate;
} else {
    echo old('rate');
} ?>">
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" id="" cols="10" rows="2" class="form-control"></textarea>
                            </div>

                        </div>

                    </div>

                    <button class="btn btn-info" type="submit">{{ $button }}</button>
                    <a class="btn btn-warning" href="{{ route('admin.deliever_setting.list') }}">Cancel</a>

                </form>
            </div>

        </div>
    </div>
    <!-- END PAGE CONTENT-->

@stop
@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".select2").select2({
                placeholder: 'Select Districts',
            });
        })
    </script>
@stop
