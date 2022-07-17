$(document).ready(function() {
    $('#confirm-button').click(function(e) {
        e.preventDefault();
        let payment_type = $("input[type='radio'][name='payment_method']:checked").val();
        console.log(payment_type);
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



        let form = document.getElementById('checkout-form');



        let data = {
            firstname: form['firstname'].value,
            lastname: form['lastname'].value,
            country: form['shipping_country'].value,
            street: form['shipping_street'].value,
            zipcode: form['shipping_zipcode'].value,
            number: form['shipping_phone'].value,
            email: form['email'].value,
            deliveryCost: deliveryPrice,
            shipping_country: form['shipping_country'].value,
            shipping_city: form['shipping_city'].value,
            shipping_street: form['shipping_street'].value,
            shipping_zipcode: form['shipping_zipcode'].value,
            shipping_phone: form['shipping_phone'].value,
            notes: $('#notes').val(),
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
            axios.post('api/esewa', data).then(res => {
                // if (res.data.id === undefined) {
                //     if (validation(res, e) == false) {
                //         return false;
                //     }
                // }

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
                $("body").removeClass("loading");
                document.body.appendChild(form);
                form.submit();
            });

        }
        if (payment_type == 'khaltiPay') {
            axios.post('api/khalti', data).then(res => {
                console.log(res.data.total_price);
                //         return false;
                // if (res.data.id === undefined) {
                //     if (validation(res, e) == false) {
                //         return false;
                //     }
                // }

                var config = {
                    "publicKey": "test_public_key_dc74e0fd57cb46cd93832aee0a507256",
                    "productIdentity": res.data.ref_id,
                    "productName": res.data.ref_id,
                    "productUrl": "https://eshoppingnepal.com/checkout",
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
                                    console.log("transaction succeed");
                                    // console.log(res);
                                    // return false;
                                    $("body").removeClass("loading");
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
                        sandbox: 'AbIlhU1gBKJmGQuWys5PoVyNwwBSIkYI90lqgLmDwRKGgeMfQ1Gsy6Z6GYSxq2O0dVB-q1Sgn_5KHq5S',
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
        if (payment_type == 'imepayPay') {
            var Apiuser = "ZXNob3BwaW5nOmltZUAxMjM0NQ==";
            var module1 = "RVNIT1BQSU5H";

            let totalPrice = $('#cartTotalPrice').val();

            var parameters = {
                "MerchantCode": "ESHOPPING",
                "Amount": totalPrice,
                "RefId": "GK-" + strRandom(8)
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
                            deliveryCost: deliveryPrice,
                            shipping_country: form['shipping_country']
                                .value,
                            shipping_state: form['shipping_state'].value,
                            shipping_street: form['shipping_street'].value,
                            shipping_zipcode: form['shipping_zipcode']
                                .value,
                            shipping_phone: form['shipping_phone'].value,
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
                                MerchantCode: res.data.MerchantCode,
                                RefId: res.data.RefId,
                                TranAmount: res.data.TranAmount,
                                RespUrl: 'https://eshoppingnepal.com/payment/success',
                                Source: 'W',
                            }
                            var form = document.createElement("form");
                            form.setAttribute("method", "POST");
                            form.setAttribute("action", path);

                            for (var key in params) {
                                var hiddenField = document
                                    .createElement("input");
                                hiddenField.setAttribute("type",
                                    "hidden");
                                hiddenField.setAttribute("name", key);
                                hiddenField.setAttribute("value",
                                    params[key]);
                                form.appendChild(hiddenField);
                            }

                            $("body").removeClass("loading");
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

}
var strRandom = function(length) {
    var result = '';
    var characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}
