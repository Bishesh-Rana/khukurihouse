@extends('front.layouts.app')

@section('title')
    Chat | Dashboard |
    @if ($setting->site_name)
        {{ $setting->site_name }}
    @endif
@stop

@section('content')
    @include('front.layouts.error')
    <div id="content" class="site-content">
        <div class="c-dashboard pt pb">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-3">
                        @include('front.customer.section.sidebar')
                    </div>

                    <div class="col-sm-9">
                        <div id="primary" class="content-area">
                        <header class="entry-header">
                            <div class="page-header-caption">
                                <h1 class="entry-title">Select Seller</h1>
                            </div>
                        </header>
                        <div class="row">
                            <div class="col-md-4 col-xl-3 chat">
                                <div class="card mb-sm-3 mb-md-0 contacts_card">
                                    <div class="card-body contacts_body">
                                        <ul class="contacts">
                                            @foreach ($sellers as $key => $row)
                                                <li class="<?php if (isset($active_seller)) {
    if ($active_seller == $row->id) {
        echo 'active';
    }
} ?>">
                                                    <div class="d-flex bd-highlight">
                                                        <div class="img_cont">
                                                            <img src="{{ asset('') }}uploads/sellers/{{ $row->image }}"
                                                                class="rounded-circle user_img">
                                                            <span class="online_icon online"></span>
                                                        </div>
                                                        <div class="user_info">
                                                            <a
                                                                href="{{ route('customer.seller.chat', $row->id) }}"><span>{{ $row->first_name }}</span></a>
                                                            {{ $row->first_name }}
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="card-footer"></div>
                                </div>
                            </div>
                            <div class="col-md-8 col-xl-9 chat">
                                @if (isset($messages))
                                    <div class="card">
                                        <div class="card-header msg_head">
                                            <div class="d-flex bd-highlight">
                                                <div class="img_cont">
                                                    <img src="{{ asset('') }}uploads/sellers/{{ $seller->image }}"
                                                        class="rounded-circle user_img">
                                                    <span class="online_icon"></span>
                                                </div>
                                                <div class="user_info">
                                                    <span>Chat with {{ $seller->first_name }}</span>
                                                    <p>{{ $messages->count() }} Messages</p>
                                                </div>

                                            </div>
                                            <span id="action_menu_btn"><i class="fa fa-ellipsis-v"></i></span>
                                            <div class="action_menu">
                                                <ul>
                                                    <li><i class="fa fa-user-circle"></i> View profile</li>
                                                    <li><i class="fa fa-users"></i> Add to close friends</li>
                                                    <li><i class="fa fa-plus"></i> Add to group</li>
                                                    <li><i class="fa fa-ban"></i> Block</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-body msg_card_body">
                                            @foreach ($messages as $message)
                                                @if ($message->send_by == 'customer')
                                                    <div class="d-flex justify-content-start mb-4">
                                                        <div class="img_cont_msg">
                                                            <img src="{{ asset('') }}uploads/customers/{{ Auth::guard('web')->user()->image }}"
                                                                class="rounded-circle user_img_msg">
                                                        </div>
                                                        <div class="msg_cotainer">
                                                            {{ $message->message }}

                                                            <span class="msg_time">
                                                                {{ date('h:i a', strtotime($message->created_at)) }},
                                                                {{ date('d M, Y', strtotime($message->created_at)) }}
                                                                @if ($message->seen_status == '1') | Seen @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="d-flex justify-content-end mb-4">
                                                        <div class="msg_cotainer_send">
                                                            {{ $message->message }}
                                                            <span class="msg_time_send">
                                                                {{ date('h:i a', strtotime($message->created_at)) }},
                                                                {{ date('d M, Y', strtotime($message->created_at)) }}
                                                                @if ($message->seen_status == '1') | Seen @endif
                                                            </span>
                                                        </div>
                                                        <div class="img_cont_msg">
                                                            <img src="{{ asset('') }}uploads/sellers/{{ $seller->image }}"
                                                                class="rounded-circle user_img_msg">
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="card-footer">
                                            <form action="{{ route('customer.seller.reply') }}" method="POST">
                                                @csrf
                                                <div class="input-group">
                                                    <div class="input-group-append">

                                                    </div>
                                                    <input type="hidden" name="seller_id" value="{{ $seller->id }}">
                                                    <textarea name="message" class="form-control type_msg"
                                                        placeholder="Type your message..."></textarea>

                                                    <div class="input-group-append">
                                                        <!-- <span class="input-group-text send_btn"><i class="fa fa-location-arrow"></i></span> -->
                                                        <input type="submit" value="Send" class="input-group-text send_btn">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        </div>
                    </div>

                </div>
                <!-- .row -->
            </div>
        </div>
        <!-- .col-full -->
    </div>
    <!-- #content -->
@stop

@section('footer')
    <script src="{{ asset('') }}assets/js/jquery-1.11.1.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.button-left').click(function() {
                $('.sidebar').toggleClass('fliph');
            });
        });
    </script>
@stop
