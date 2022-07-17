@extends('front.layouts.app')

@section('title')
Returns | Dashboard |
@if($setting->site_name)
{{$setting->site_name}}
@endif
@stop

@section('content')
@include('front.layouts.error')
<div id="content" class="site-content">
    <div class="col-full">
        <div class="row">
            <div class="col-sm-3">
            @include('front.customer.section.sidebar')

            </div>

            <div class="col-sm-9">

            </div>

        </div>
        <!-- .row -->
    </div>
    <!-- .col-full -->
</div>
<!-- #content -->
@stop

@section('footer')
<script src="{{asset('')}}assets/js/jquery-1.11.1.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.button-left').click(function() {
            $('.sidebar').toggleClass('fliph');
        });
    });
</script>
@stop
