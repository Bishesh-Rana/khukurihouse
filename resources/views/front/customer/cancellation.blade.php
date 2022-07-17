@extends('front.layouts.app')

@section('title')
Orders | Dashboard |
@if($setting->site_name)
{{$setting->site_name}}
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
                        <main id="main" class="site-main">
                            <div class="type-page hentry">
                                <header class="entry-header">
                                    <div class="page-header-caption">
                                        <h1 class="entry-title">Cancelled Orders</h1>
                                    </div>
                                </header>
                                <!-- .entry-header -->
                                <div class="entry-content">
                                    @if(count($orders) > 0)
                                    <div class="table-responsive">
                                    <table class="shop_table cart wishlist_table table table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                                <th>S.N</th>
                                                <th class="product-name">
                                                    <span class="nobr">Order ID</span>
                                                </th>

                                                <th class="product-stock-status">
                                                    <span class="nobr">
                                                        Date
                                                    </span>
                                                </th>
                                                <th class="product-add-to-cart">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orders as $key => $order)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td class="product-name">
                                                    <a href="{{route('customer.cancel.view',$order->ref_id)}}">
                                                       {{$order->ref_id}}
                                                    </a>
                                                </td>
                                                <td class="product-stock-status">
                                                    <span>{{ date('M d, Y',strtotime($order->created_at)) }}</span>
                                                </td>
                                                <td class="product-add-to-cart">
                                                    <a class="button add_to_cart_button button alt" href="{{route('customer.cancel.view',$order->ref_id)}}"> View Details</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                    {{$orders->links()}}

                                    <!-- .wishlist_table -->
                                    @else
                                    YOU HAVEN'T CANCELLED ANY ORDERS. <a href="{{route('home.index')}}">BROWSE</a>
                                    @endif
                                </div>
                                <!-- .entry-content -->
                            </div>
                            <!-- .hentry -->
                        </main>
                        <!-- #main -->
                    </div>
                    <!-- #primary -->
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
<script src="{{asset('')}}assets/js/jquery-1.11.1.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.button-left').click(function() {
            $('.sidebar').toggleClass('fliph');
        });

        // $('#exampleModal1').on('shown.bs.modal', function() {
        //     $('#reason1').focus();
        // });

    });
</script>
@stop
