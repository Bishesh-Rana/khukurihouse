@extends('front.layouts.app')

@section('title')
    Checkout |
    @if ($setting->site_name)
        {{ $setting->site_name }}
    @endif
@stop

@section('content')
    <nav aria-label="breadcrumb" class="breadcrumbs">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Checkout</a></li>
                <li class="breadcrumb-item active" aria-current="page">Order received</li>
            </ol>
        </div>
    </nav>

    <section class="details-page mt mb">
        <div class="container-fluid">
            <div class="entry-content">
                <div class="s-msg">
                    <p class="alert-success">Thank you. Your order has been received.</p>
                </div>
                    <div class="woocommerce-order">
                        <h2 class="">Order details</h2>
                        <ul class="p-top-details">

                            <li class="">
                                Order Code:<strong>{{ $payment->ref_id }}</strong>
                            </li>

                            <li class="">
                                Date:<strong>{{ date('M d, Y', strtotime($payment->created_at)) }}</strong>
                            </li>
                        </ul>
                        <div class="row">
                            {{-- <div class="col-md-4">
                                <h2 class="">Order Information</h2>
                                <ul class="">

                                    <li class="">
                                        Order Code:<strong>{{ $payment->ref_id }}</strong>
                                    </li>

                                    <li class="">
                                        Date:<strong>{{ date('M d, Y', strtotime($payment->created_at)) }}</strong>
                                    </li>

                                    <li class="">
                                        Total:<strong>Rs.<span id="totalPrice"></span></strong>
                                    </li>

                                    <li class="">
                                        Payment method:
                                        @if ($payment->esewa == 1)<strong>Paid with
                                                Esewa</strong>
                                        @elseif($payment->khalti == 1)<strong>Paid with Khalti</strong>
                                        @elseif($payment->paypal == 1)<strong>Paid with Paypal</strong>
                                        @elseif($payment->imepay == 1)<strong>Paid with IME Pay</strong>
                                        @else <strong>Pay on Delivery</strong>@endif
                                    </li>

                                </ul>
                            </div> --}}
                            <div class="col-md-12">
                                <section class="">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="">Product</th>
                                                    <th class="">Total</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php $totalPrice = 0; ?>
                                                @foreach ($orders as $order)
                                                    <tr class="">

                                                        <td class="">
                                                            <a
                                                                href="{{ route('product.details', $order->product_slug) }}">{{ $order->product_name }}</a>
                                                            <strong class="product-quantity">× {{ $order->quantity }}</strong>
                                                        </td>

                                                        <td class="">
                                                            <span class=""><span class="">Rs.
                                                                </span>{{ number_format($order->product_original_price * $order->quantity) }}</span>
                                                        </td>
                                                        <?php
                                                        $totalPrice += $order->product_original_price * $order->quantity;
                                                        ?>

                                                    </tr>
                                                @endforeach
                                            </tbody>

                                            <tfoot>
                                                <tr>
                                                    <td scope="row"><b>Subtotal:</b></td>
                                                    <td><span>{{ number_format($totalPrice) }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td scope="row"><b>Delivery Charge:</b></td>
                                                    <td><span>{{ number_format($payment->delivery_cost) }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td scope="row"><b>Discount:</b></td>
                                                    <td><span>{{ number_format($payment->discount_amount) }}</span></td>
                                                </tr>
                                                <!-- <tr>
                                                                        <th scope="row">Shipping:</th>
                                                                        <td><span>100.00</span>&nbsp;<small class="shipped_via">via Normal Delivery</small></td>
                                                                    </tr> -->
                                                <tr>
                                                    <td scope="row"><b>Payment method:</b></td>
                                                    <td>
                                                        @if ($payment->esewa == 1)Paid with
                                                                Esewa
                                                        @elseif($payment->khalti == 1)<strong>Paid with Khalti</strong>
                                                        @elseif($payment->paypal == 1)<strong>Paid with Paypal</strong>
                                                        @elseif($payment->imepay == 1)<strong>Paid with IME Pay</strong>
                                                        @elseif($payment->hbl_pay == 1)<strong>Paid with Himalayan Bank Ltd</strong>
                                                        @else <strong>Pay on Delivery</strong>@endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td scope="row"><b>Total:</b></td>
                                                    <td>Rs.<span
                                                            id="belowPrice">{{ number_format($payment->total_price) }}</span></span>
                                                    </td>
                                                </tr>

                                            </tfoot>

                                        </table>
                                    </div>
                                </section>
                            </div>
                            <div class="col-md-12">
                                <a href="{{ route('customer.downloadpdf', $ref_id) }}" target="_blank"
                            class="btn btn-success"><i class="fa fa-download"></i> Download Invoice</a>
                            </div>
                        </div>
                    </div>
            </div>


        </div>
        <!-- .row -->
        </div>
    </section>

    <!-- #content -->

@stop
@push('scripts')
    <script>
        $(document).ready(function() {
            var price = $("#belowPrice").text();
            console.log(price);
            $("#totalPrice").html(price);
        });
    </script>
@endpush

@section('footer')



@stop
