@extends('front.layouts.app')

@section('title')
    Orders | Dashboard |
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
                            <main id="main" class="site-main">
                                <div class="type-page hentry">
                                    <header class="entry-header">
                                        <div class="page-header-caption">
                                            <h1 class="entry-title">Orders</h1>
                                        </div>
                                    </header>
                                    <!-- .entry-header -->
                                    <div class="entry-content">
                                        @if (count($orders) > 0)
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
                                                        <th class="product-add-to-cart">Details</th>
                                                        {{-- <th>Action</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($orders as $key => $order)
                                                        <tr>
                                                            <td>{{ ++$key }}</td>
                                                            <td class="product-name">
                                                                <a href="{{ route('customer.order.view', $order->ref_id) }}">
                                                                    {{ $order->ref_id }}
                                                                </a>
                                                            </td>
                                                            <td class="product-stock-status">
                                                                <span>{{ $order->created_at->format('M d, Y') }}</span>
                                                            </td>
                                                            <td class="product-add-to-cart">
                                                                <a class="button add_to_cart_button button alt"
                                                                    href="{{ route('customer.order.view', $order->ref_id) }}">
                                                                    View Details</a>
                                                            </td>
                                                            {{-- <td class="product-add-to-cart">
                                                                <button type="button"
                                                                    class="button add_to_cart_button button alt"
                                                                    data-toggle="modal"
                                                                    data-target="#exampleModal{{ $loop->iteration }}">
                                                                    Cancel
                                                                </button>
                                                            </td> --}}
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                            {{ $orders->links() }}

                                            @foreach ($orders as $order)
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{ $loop->iteration }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Please
                                                                    tell us the reason why you are cancelling this order.
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            {{-- <form
                                                                action="{{ route('customer.order.cancel', $order->ref_id) }}"
                                                                method="post">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <input type="text" name="reason"
                                                                        id="reason{{ $loop->iteration }}"
                                                                        style="width: 400px;" required>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Cancel
                                                                        Order</button>
                                                                </div>
                                                            </form> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <!-- .wishlist_table -->
                                        @else
                                            YOU HAVEN'T ORDERED ANY PRODUCTS. <a
                                                href="{{ route('home.index') }}">BROWSE</a>
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
    <script src="{{ asset('') }}assets/js/jquery-1.11.1.min.js"></script>

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
