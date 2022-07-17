@extends('front.layouts.app')


@section('title')

    @if ($setting->site_name)
        {{ $setting->site_name }}
    @endif

@stop
@push('styles')
    <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
@endpush

@section('content')

    <!-- Checkout Page -->
    <section class="checkout mt mb" id="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="checkout-main">
                        <div id="accordion" class="myaccordion">
                            <form action="{{ route('product.checkout.submit') }}" method="post" name="checkout"
                                id="checkout-form">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne"
                                            aria-expanded="false" aria-controls="collapseOne">
                                            <i class="las la-edit"></i> Personal Information
                                            <span class="fa-stack fa-sm">
                                                <i class="las la-minus"></i>
                                            </span>
                                        </a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                        data-parent="#accordion">
                                        <div class="card-body">

                                            <div class="personal-form">
                                                <div class="form-group row">
                                                    <label class="col-md-4">Social Title</label>
                                                    <div class="personal-check col-md-8">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="title"
                                                                id="inlineRadio1" value="mr" onclick="showCustomTitle()"
                                                                {{ Auth::check() && Auth::guard('web')->user()->title == 'mr' ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="inlineRadio1">Mr.</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="title"
                                                                id="inlineRadio2" value="mrs" onclick="showCustomTitle()"
                                                                {{ Auth::check() && Auth::guard('web')->user()->title == 'mrs' ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="inlineRadio2">Mrs.</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="title"
                                                                id="other_title" value="other" onclick="showCustomTitle()"
                                                                {{ Auth::check() && Auth::guard('web')->user()->title != 'mrs' && Auth::guard('web')->user()->title != 'mr' ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="other_title">Other</label>
                                                        </div>
                                                        <input type="text" name="other_title"
                                                            class="form-control {{ Auth::check() && Auth::guard('web')->user()->title != 'mrs' && Auth::guard('web')->user()->title != 'mr' ? '' : 'd-none' }}"
                                                            id="title_custom"
                                                            value="{{ Auth::check() && Auth::guard('web')->user()->title != 'mrs' && Auth::guard('web')->user()->title != 'mr' ? uth::guard('web')->user()->title : '' }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-4">Full Name</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="name" class="form-control"
                                                            value="{{ Auth::guard('web')->user()->name ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-4">Phone</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="phone" class="form-control"
                                                            value="{{ Auth::guard('web')->user()->phone ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-4">Address</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="address" class="form-control"
                                                            value="{{ Auth::guard('web')->user()->address ?? '' }}">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-4">Email</label>
                                                    <div class="col-md-8">
                                                        <input type="email" name="email" class="form-control"
                                                            value="{{ Auth::guard('web')->user()->email ?? '' }}">
                                                    </div>
                                                </div>
                                                {{-- <div class="create-user">
                                                    <span>Create an account (optional)</span>
                                                    <p>And save time on your next order!</p>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-4">Password</label>
                                                    <div class="col-md-8">
                                                        <input type="password" name="password" class="form-control" id="password" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-4">Confirm Password</label>
                                                    <div class="col-md-8">
                                                        <input type="password" name="confirm_password" class="form-control" id="confirm_password"/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="" class="col-md-4"></label>
                                                    <div class="col-md-8">
                                                        <div class="form-check next-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="acceptTerms" />
                                                            <label class="form-check-label" for="acceptTerms">
                                                                I agree to the terms and conditions and the privacy policy
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo">
                                            <i class="las la-shipping-fast"></i> Shipping Address
                                            <span class="fa-stack fa-sm">
                                                <i class="las la-plus"></i>
                                            </span>
                                        </a>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                        data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="personal-form">
                                                <p class="details">The selected address will be used both as your
                                                    personal address (for invoice) and as your delivery address.</p>
                                                <p id="billing_first_name_field"
                                                    class="form-row form-row-first validate-required">
                                                <div class="form-group row">
                                                    <label class="col-md-4">First Name</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="firstname" class="form-control"
                                                            value="{{ Auth::guard('web')->check() ? preg_split('/\s+/', Auth::guard('web')->user()->name, 2)[0] : '' }}" />
                                                    </div>
                                                </div>
                                                </p>
                                                <div class="form-group row">
                                                    <label class="col-md-4">Last Name</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="lastname" class="form-control"
                                                            value="{{ Auth::guard('web')->check() ? preg_split('/\s+/', Auth::guard('web')->user()->name, 2)[1] : '' }}" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-4">Company</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="company" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-4">VAT Number</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="vat_number" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-4">Country</label>
                                                    <div class="col-md-8">
                                                        <select class="form-control" name="shipping_country"
                                                            id="shipping_country" onchange="checkCountry()">
                                                            <option>----select country----</option>
                                                            @forelse ($countries as $country)
                                                                <option value="{{ $country->iso_2 }}"
                                                                    {{ $country->iso_2 == 'NP' ? 'selected' : '' }}>
                                                                    {{ $country->name }}</option>
                                                            @empty

                                                            @endforelse

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row" id="district">
                                                    <label class="col-md-4">Shipping District</label>
                                                    <div class="col-md-8">
                                                        <select class="form-control" id="shipping_district"
                                                            onchange="deliveryCharge()">
                                                            <option>----select shipping district----</option>
                                                            @forelse ($districts as $dist)
                                                                <option value="{{ $dist->dist_id }}">
                                                                    {{ $dist->en_name }}</option>
                                                            @empty

                                                            @endforelse

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-4">Shipping City</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="shipping_city" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-4">Shipping Street</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="shipping_street" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-4">Zip/Postal Code</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="shipping_zipcode" class="form-control" />
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label class="col-md-4">Phone</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="shipping_phone" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="" class="col-md-4"></label>
                                                    <div class="col-md-8">
                                                        <div class="form-check next-check">
                                                            <input class="form-check-input" type="checkbox" id="use_address"
                                                                name="use_address" />
                                                            <label class="form-check-label" for="use_address">
                                                                Use this address for invoice too
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <a class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">
                                            <i class="las la-info-circle"></i> Shipping Method
                                            <span class="fa-stack fa-sm">
                                                <i class="las la-plus"></i>
                                            </span>
                                        </a>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                        data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="shipping-top">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="shipping-name">
                                                            <div id="integrator" style="display: none;">
                                                                @forelse ($integrator as $key => $item)
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="integrator"
                                                                            id="integrator-{{ $key }}"
                                                                            value="{{ $item->id }}"
                                                                            onclick="checkInternationalPrice()">
                                                                        <label class="form-check-label"
                                                                            for="integrator-{{ $key }}">
                                                                            {{ $item->title }}
                                                                        </label>
                                                                    </div>

                                                                @empty

                                                                @endforelse

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 msg">
                                                        <label for="">If you want any
                                                            note, please mention the details here.</label>
                                                        <textarea name="notes" class="form-control"
                                                            id="notes"></textarea>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingFour">
                                        <a class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            <i class="las la-star"></i> Payment
                                            <span class="fa-stack fa-sm">
                                                <i class="las la-plus"></i>
                                            </span>
                                        </a>
                                    </div>
                                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                                        data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="payment">
                                                <div class="personal-check">
                                                    <div class="form-check form-check-inline">
                                                        <input class="payment-check" type="radio" name="payment_method"
                                                            onclick="showConfirmButton()" id="inlineRadio" value="hbl_pay"
                                                            {{ Auth::guard('web')->check() && Auth::guard('web')->user()->payment_option == 'hbl_pay' ? 'checked' : '' }} />
                                                        <label class="form-check-label" for="inlineRadio"><img src="{{ asset('') }}front/img/HBL-Logo.jpg"
                                                                alt="images"></label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="payment-check" type="radio" name="payment_method"
                                                            onclick="showConfirmButton()" id="inlineRadio2"
                                                            value="imepayPay"
                                                            {{ Auth::guard('web')->check() && Auth::guard('web')->user()->payment_option == 'imepay' ? 'checked' : '' }} />
                                                        <label class="form-check-label" for="inlineRadio2"><img
                                                                src="{{ asset('') }}front/img/card2.png"
                                                                alt="images"></label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="payment-check" type="radio" name="payment_method"
                                                            onclick="showConfirmButton()" id="inlineRadio3"
                                                            value="khaltiPay"
                                                            {{ Auth::guard('web')->check() && Auth::guard('web')->user()->payment_option == 'khalti' ? 'checked' : '' }} />
                                                        <label class="form-check-label" for="inlineRadio3"><img
                                                                src="{{ asset('') }}front/img/card3.png"
                                                                alt="images"></label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="payment-check" type="radio" name="payment_method"
                                                            onclick="showConfirmButton()" id="inlineRadio7"
                                                            value="paypalpay"
                                                            {{ Auth::guard('web')->check() && Auth::guard('web')->user()->payment_option == 'paypal' ? 'checked' : '' }} />
                                                        <label class="form-check-label" for="inlineRadio7"><img
                                                                src="{{ asset('') }}front/img/card4.png"
                                                                alt="images"></label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="payment-check" type="radio" name="payment_method"
                                                            onclick="showConfirmButton()" id="inlineRadio8" value="esewaPay"
                                                            {{ Auth::guard('web')->check() && Auth::guard('web')->user()->payment_option == 'esewa' ? 'checked' : '' }} />
                                                        <label class="form-check-label" for="inlineRadio8"><img
                                                                src="{{ asset('') }}front/img/card5.png"
                                                                alt="images"></label>
                                                    </div>
                                                </div>
                                                <input type="hidden" id="cartTotalPrice" name="cartTotalPrice"
                                                    value="{{ Session::get('cart')->totalPrice }}">
                                                <input type="hidden" id="delivery_cost" name="delivery_cost" value="">

                                                <button type="submit" class="btn btn-primary main-btn d-none"
                                                    id="confirm-button">Confirm Order</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="checkout-sidebar">
                        <div class="cd-table">
                            <div class="table-responsive">
                                <table width="100%">
                                    <thead>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Products</td>
                                            <td>
                                                <?php $subTotal = 0; ?>
                                                @foreach ($cart_products as $product)
                                                    <?php $subTotal += $product['price']; ?>
                                                    <strong class="product-quantity">{{ $product['qty'] }} ⨉ </strong>
                                                    {{ $product['item']['product_name'] }} <br>
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ count($cart_products) }} item</td>
                                            <td>Rs.{{ $subTotal }}</td>
                                        </tr>
                                        <tr>
                                            <td>Shipping Charge</td>
                                            <td>Rs.<span id="deliveryCharge">0</span></td>
                                        </tr>
                                        <tr>
                                            <td>Discount Amount</td>
                                            <td>Rs.<span id="discount_amount">0</span></td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td>Rs.<span id="totalPrice">{{ $subTotal }}</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="promo-code">
                                    <form action="" method="get">
                                        <input type="text" name="coupon_code" class="form-control"
                                            placeholder="Coupon code" id="coupon_code" required="">
                                        <button type="submit" class="btn btn-primary" id="apply_coupon">Add</button>
                                        <div style="color: green; display: none;" class="clear"
                                            id="coupon_success">&nbsp;&nbsp;&nbsp;&nbsp;Coupon applied successfully</div>
                                        <div style="color: red; display: none;" class="clear" id="coupon_error">
                                            &nbsp;&nbsp;&nbsp;&nbsp;Invalid Coupon code</div>
                                        <div style="color: red; display: none;" class="clear" id="coupon_used">
                                            &nbsp;&nbsp;&nbsp;&nbsp;Coupon already used</div>
                                        <div style="color: red; display: none;" class="clear" id="coupon_again">
                                            &nbsp;&nbsp;&nbsp;&nbsp;Coupon already applied</div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Checkout Page End -->

@stop
@push('scripts')
    <script src="{{ asset('js/validate.js') }}"></script>
    <script src="{{ asset('js/validate.min.js') }}"></script>
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>

    <script>
        function checkCountry() {
            admOptionValue = document.getElementById("shipping_country").value;
            if (admOptionValue == "NP") {
                document.getElementById("district").style.display = "";
                document.getElementById("integrator").style.display = "none";
            } else {
                document.getElementById("district").style.display = "none";
                document.getElementById("integrator").style.display = "";
            }
        }

        $(document).ready(function() {
            // jquery validation
            $.validator.addMethod("nowhitespace", function(value, element) {
                return this.optional(element) || /^\S+$/i.test(value);
            }, "No white space please");
            $('#checkout-form').validate({
                onkeyup: function(element) {
                    this.element(element);
                },

                onfocusout: function(element) {
                    this.element(element);
                },
                rules: {
                    firstname: {
                        required: true,
                        nowhitespace: true,

                    },

                    lastname: {
                        required: true,
                        nowhitespace: true,
                    },
                    shipping_country: {
                        required: true,
                    },

                    shipping_street: {
                        required: true,
                    },
                    shipping_city: {
                        required: true,
                    },



                    shipping_zipcode: {
                        required: true,
                        digits: true,
                        maxlength: 10,
                    },

                    email: {
                        required: true,
                        email: true,
                    },

                    shipping_phone: {
                        required: true,
                        digits: true,
                    },
                    payment_method: {
                        required: true,
                    },

                }
            });

            // end of jquery validation
        });
    </script>
    <script>
        function deliveryCharge() {
            var data = {
                dist_id: $('#shipping_district').val(),
                totalPrice: $('#cartTotalPrice').val(),


            }
            console.log(data);
            axios.post("{{ route('getDeliveryCharge') }}", data).then(res => {
                $("#deliveryCharge").html(res.data.deliveryCost);
                $("#totalPrice").html(res.data.totalPrice);
                $("input[name='cartTotalPrice']").val(res.data.totalPrice);
            });
        }

        function showCustomTitle() {
            if (document.getElementById('other_title').checked) {
                $('#title_custom').removeClass('d-none');

            } else
                $('#title_custom').addClass('d-none');
        }

        function showConfirmButton() {

            $('#confirm-button').removeClass('d-none');
        }
    </script>

    <script>
        $('#acceptTerms').click(function() {
            $("#submitButton").toggle(this.checked);
        });
    </script>

    <script>
        $(document).ready(function() {
        $('#confirm-button').click(function(e) {
                e.preventDefault();

                let payment_type = $("input[type='radio'][name='payment_method']:checked").val();
                console.log(payment_type);
                // return false;
                //Verify Stock
                axios.post('api/verifyStock').then(res => {
                    if (res.data.status == false) {
                        console.log('No items remaining in stock.');
                        window.location.href = "{{ '/cartStockError/' }}" + res.data.cart_product
                            .product_name;
                    }
                });

                //Verify Product
                axios.post('api/verifyProduct').then(res => {
                    if (res.data.status == false) {
                        console.log('Product does not exist.');
                        window.location.href = "{{ '/cartProductError/' }}" + res.data
                            .cart_product
                            .product_name;
                    }
                });

                let totalPrice = $('#cartTotalPrice').val();
                let deliveryPrice = $('#deliveryCharge').text();
                let discount_amount = $('#discount_amount').text();

                let form = document.getElementById('checkout-form');

                let data = {
                    firstname: form['firstname'].value,
                    lastname: form['lastname'].value,
                    country: form['shipping_country'].value,
                    street: form['shipping_street'].value,
                    zipcode: form['shipping_zipcode'].value,
                    number: form['shipping_phone'].value,
                    email: form['email'].value,
                    delivery_cost: deliveryPrice,
                    discount_amount: discount_amount,
                    shipping_country: form['shipping_country'].value,
                    shipping_city: form['shipping_city'].value,
                    shipping_street: form['shipping_street'].value,
                    shipping_zipcode: form['shipping_zipcode'].value,
                    shipping_phone: form['shipping_phone'].value,
                    company: form['company'].value,
                    vat_number: form['vat_number'].value,
                    notes: $('#notes').val(),
                    gift_wrap: $('#gift_wrap').val(),
                    cartTotalPrice: $('#cartTotalPrice').val(),
                }
                if (payment_type == 'cashPay') {
                    axios.post('api/cashPayment', data).then(res => {

                        if (res.data.id === undefined) {
                            if (validation(res, e) == false) {
                                return false;
                            }
                        }
                        let deliveryPrice = $('#deliveryCharge').text();

                        $('#delivery_cost').val(deliveryPrice);
                        form.submit();
                    });
                }
                if (payment_type == 'esewaPay') {

                    // return false;
                    axios.post('api/esewa', data)
                        .then(res => {
                            if (res.data.id === undefined) {
                                if (validation(res, e) == false) {
                                    return false;
                                }
                            }

                            var path = "https://uat.esewa.com.np/epay/main";

                            var params = {
                                amt: res.data.total_price,
                                psc: 0,
                                pdc: 0,
                                txAmt: 0,
                                tAmt: res.data.total_price,
                                pid: res.data.ref_id,
                                scd: "EPAYTEST",
                                su: "{{ route('payment.success') }}",
                                fu: "{{ route('payment.failure') }}",
                            }
                            var form = document.createElement("form");
                            form.setAttribute("method", "POST");
                            form.setAttribute("action", path);

                            for (var key in params) {
                                var hiddenField = document.createElement("input");
                                hiddenField.setAttribute("type", "hidden");
                                hiddenField.setAttribute("name", key);
                                hiddenField.setAttribute("value", params[key]);
                                form.appendChild(hiddenField);
                            }
                            document.body.appendChild(form);
                            form.submit();
                        });


                }
                if (payment_type == 'khaltiPay') {
                    axios.post('api/khalti', data).then(res => {
                        console.log(res.data.total_price);
                        // if (res.data.id === undefined) {
                        //     if (validation(res, e) == false) {
                        //         return false;
                        //     }
                        // }

                        var config = {
                            "publicKey": "test_public_key_dc74e0fd57cb46cd93832aee0a507256",
                            "productIdentity": res.data.ref_id,
                            "productName": res.data.ref_id,
                            "productUrl": "http://127.0.0.1:8000/checkout",
                            "paymentPreference": [
                                "KHALTI",
                                "EBANKING",
                                "MOBILE_BANKING",
                                "CONNECT_IPS",
                                "SCT",
                            ],
                            "eventHandler": {
                                onSuccess(payload) {
                                    // console.log(payload);
                                    // return false;
                                    $.ajax({
                                        url: "{{ route('khalti.verification') }}",
                                        type: 'POST',
                                        data: {
                                            amount: payload.amount,
                                            trans_token: payload.token,
                                            oid: payload.product_identity
                                        },
                                        success: function(res) {
                                            // console.log(res);
                                            // return false;
                                            window.location.href =
                                                "{{ '/checkout/khalti/success/' }}" +
                                                res.ref_id;
                                        },
                                        error: function(error) {
                                            $("body").removeClass("loading");
                                            console.log("transaction failed");
                                        }
                                    });
                                },
                                onError(error) {
                                    console.log(error);
                                },
                                onClose() {
                                    console.log('widget is closing');
                                    $("body").removeClass("loading");
                                }
                            }
                        };

                        var checkout = new KhaltiCheckout(config);
                        checkout.show({
                            amount: res.data.total_price * 100
                        });
                    });
                }
                if (payment_type == 'paypalpay') {
                    axios.post('api/paypal', data).then(res => {

                        // if (res.data.id === undefined) {
                        //     if (validation(res, e) == false) {
                        //         return false;
                        //     }
                        // }

                        var ref_id = res.data.ref_id;
                        var app_url = "{{ env('APP_URL') }}";
                        console.log(res);
                        paypal.Button.render({
                            // Configure environment
                            env: 'sandbox',
                            client: {
                                sandbox: 'AYcZnEjPKgJVFgXEWMyvpc_PnchIltkzhYs0QiwpuQ8c700BAZym9pciP2Efr3eyU0tGqY-LaciJklKh',
                                production: 'demo_production_client_id'
                            },
                            // Customize button (optional)
                            locale: 'en_US',
                            style: {
                                size: 'small',
                                color: 'gold',
                                shape: 'pill',
                            },

                            // Enable Pay Now checkout flow (optional)
                            commit: true,

                            // Set up a payment
                            payment: function(data, actions) {
                                return actions.payment.create({
                                    redirect_urls: {
                                        return_url: app_url +
                                            '/execute-payment/' + ref_id
                                    },
                                    transactions: [{
                                        amount: {
                                            total: parseFloat(res.data
                                                .total_price),
                                            currency: 'USD',
                                            // oid: 'abcd'
                                        }
                                    }]
                                });
                            },
                            // Execute the payment
                            onAuthorize: function(data, actions) {
                                // $("body").removeClass("loading");
                                // console.log(data);
                                // return false;
                                return actions.redirect();
                            }
                        }, '#confirm-button');
                    });
                }
                if (payment_type == 'hbl_pay') {
                    axios.post('api/hbl', data)
                        .then(function(response) {
                            var path = "https://hblpgw.2c2p.com/HBLPGW/Payment/Payment/Payment";

                            var params = {
                                paymentGatewayID: "{{ env('HBL_MERCHANT_ID')}}",
                                invoiceNo: response.data.ref_id,
                                productDesc: response.data.product_desc,
                                amount: response.data.amount,
                                currencyCode: "{{ env('HBL_CURRENCY_CODE')}}",
                                nonSecure: "{{ env('HBL_NON_SECURE')}}",
                                hashValue: response.data.hash,
                            }


                            var form = document.createElement("form");
                            form.setAttribute("method", "POST");
                            form.setAttribute("action", path);
                            for (var key in params) {
                                var hiddenField = document.createElement("input");
                                hiddenField.setAttribute("type", "hidden");
                                hiddenField.setAttribute("name", key);
                                hiddenField.setAttribute("value", params[key]);
                                form.appendChild(hiddenField);
                            }
                            document.body.appendChild(form);
                            form.submit();

                        })
                        .catch(function(error) {
                            console.log(error);
                        });

        }
        if (payment_type == 'imepayPay') {
            var Apiuser = "ZXNob3BwaW5nOmltZUAxMjM0NQ==";
            var module1 = "RVNIT1BQSU5H";

            let totalPrice = $('#cartTotalPrice').val();

            var parameters = {
                "MerchantCode": "ESHOPPING",
                "Amount": totalPrice,
                "RefId": "GK-" + strRandom(9)
            };

            $.ajax({
                type: 'POST',
                url: 'https://stg.imepay.com.np:7979/api/Web/GetToken',
                dataType: 'JSON',
                data: JSON.stringify(parameters),
                crossDomain: true,
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', 'Basic ' + Apiuser);
                    xhr.setRequestHeader('Module', module1);
                },
                success: function(responseData, status, xhr) {
                    let resData = {
                        responseCode: responseData.ResponseCode,
                        tokenId: responseData.TokenId,
                        amount: responseData.Amount,
                        refId: responseData.RefId,
                    }
                    console.log(resData);

                    axios.post('api/getToken', resData).then(res => {

                        let form = document.getElementById('checkout-form');
                        let deliveryPrice = $('#deliveryCharge').text();
                        let formData = {
                            firstname: form['firstname'].value,
                            lastname: form['lastname'].value,
                            country: form['shipping_country'].value,
                            street: form['shipping_street'].value,
                            zipcode: form['shipping_zipcode'].value,
                            number: form['shipping_phone'].value,
                            email: form['email'].value,
                            refId: res.data,
                            delivery_cost: deliveryPrice,
                            discount_amount: discount_amount,
                            cartTotalPrice: $('#cartTotalPrice').val(),
                            shipping_country: form['shipping_country']
                                .value,
                            shipping_state: form['shipping_state']
                                .value,
                            shipping_street: form['shipping_street']
                                .value,
                            shipping_zipcode: form['shipping_zipcode']
                                .value,
                            shipping_phone: form['shipping_phone']
                                .value,
                            notes: form['notes'].value,
                        }

                        axios.post('api/imepay', formData).then(res => {
                            if (res.data.TokenId === undefined) {
                                if (validation(res, e) == false) {
                                    return false;
                                }
                            }

                            var path =
                                "https://stg.imepay.com.np:7979/WebCheckout/Checkout";
                            var params = {
                                TokenId: res.data.TokenId,
                                MerchantCode: res.data
                                    .MerchantCode,
                                RefId: res.data.RefId,
                                TranAmount: res.data.TranAmount,
                                RespUrl: 'https://eshoppingnepal.com/payment/success',
                                Source: 'W',
                            }
                            var form = document.createElement(
                                "form");
                            form.setAttribute("method", "POST");
                            form.setAttribute("action", path);

                            for (var key in params) {
                                var hiddenField = document
                                    .createElement("input");
                                hiddenField.setAttribute("type",
                                    "hidden");
                                hiddenField.setAttribute("name",
                                    key);
                                hiddenField.setAttribute("value",
                                    params[key]);
                                form.appendChild(hiddenField);
                            }

                            document.body.appendChild(form);
                            form.submit();
                        });
                    });
                },
                error: function(request, status, error) {
                    console.log(request.responseText);
                }
            });
        }
        });
        });

        function validation(res, e) {


            if (res.data.firstname !== undefined) {
                $("body").removeClass("loading");
                $("p#billing_first_name_field").addClass("woocommerce-invalid");
                $("input[name='firstname']").focus();
                $("#firstname_error").html("Please enter your first name");
                return false;
            }

        }
    </script>
    <!-- Coupon Script -->
    <script>
        $(document).ready(function() {
            var unique = null;
            $("#apply_coupon").click(function(e) {
                e.preventDefault();
                var coupon = {
                    code: $("#coupon_code").val()
                };

                axios.post("{{ route('getCoupon') }}", coupon).then(res => {
                    if (res.data.status == 'fail') {
                        $("#coupon_error").css("display", "block");
                        $('#coupon_error').delay(3000).fadeOut('slow');
                    }
                    else if(res.data.status == 'used'){
                        $("#coupon_used").css("display", "block");
                        $('#coupon_used').delay(3000).fadeOut('slow');
                    }
                    else {

                        if (unique == null) {
                            var currentTotalPrice = $("#totalPrice").text();
                            var discountedTotalPrice = currentTotalPrice - res.data.discount;
                            console.log(discountedTotalPrice);
                            $("#coupon_success").css("display", "block");
                            $('#coupon_success').delay(3000).fadeOut('slow');
                            $("#discount_amount").html(res.data.discount);
                            $("#totalPrice").html(discountedTotalPrice);
                $("input[name='cartTotalPrice']").val(discountedTotalPrice);
                            unique = 1;
                        } else {
                            $("#coupon_again").css("display", "block");
                            $('#coupon_again').delay(3000).fadeOut('slow');
                        }
                    }
                });
            });
        });
    </script>
    <script>
        var strRandom = function(length) {
            var result = '';
            var characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }

    </script>
    <script>
        function checkInternationalPrice() {
            var data = {
                integrator: $("input[name='integrator']").val(),
                weight: '10',
                country: $('#shipping_country').val()
            }
            console.log(data);
            // return false;
            axios.post('https://algxpress.com/api/price', data)
                .then(function(response) {
                    totalPrice = $('#totalPrice').text();
                    $("#deliveryCharge").html(response.data.price);
                    $("#totalPrice").html(parseInt(totalPrice) + response.data.price);
                    $("input[name='cartTotalPrice']").val(parseInt(totalPrice) + response.data.price);
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    </script>
@endpush
@section('footer')

@stop
