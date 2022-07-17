@extends('front.layouts.app')
@section('title')
    @if ($setting->site_name)
        {{ $setting->site_name }}
    @endif
@stop
    @section('content')
    <section class="general-page mt mb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                         <h2>{{$content->content_title}}</h2>
                     </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="floating_elem"><img src="{{asset('uploads/contents/'.$content->featured_img)}}" alt=""></div>
                    {!! $content->content_body !!}
                </div>
            </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
