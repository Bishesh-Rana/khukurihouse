@if ($message = Session::get('subscribe-success'))
<p id="success" class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
    Success! {{$message}}
</p>
@endif