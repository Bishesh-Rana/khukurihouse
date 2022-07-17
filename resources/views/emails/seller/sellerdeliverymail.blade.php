@component('mail::message')

@if(isset($setting->site_logo))
<img src="{{asset('')}}uploads/settings/{{$setting->site_logo}}" height="130px" width="300px"><br>
@endif

# DELIVERED ORDER
The order details are as follows:

Order Code: <strong> {{$payment->ref_id}}</strong><br>
Date: <strong> {{date('M d, Y',strtotime($payment->created_at))}}</strong><br>
Payment method:
@if($payment->esewa == 1)<strong> Pay with Esewa</strong>
@elseif($payment->khalti == 1)<strong> Pay with Khalti</strong>
@elseif($payment->imepay == 1)<strong> Pay with IME Pay</strong>
@else <strong> Pay on Delivery</strong>@endif
<br>

<table>
<?php $totalPrice = 0; ?>
@foreach($orders as $order)
<tr>
    <td>
        {{$order->product_name}}
        <strong>× {{$order->quantity}}</strong>
    </td>
    <td>
        <span><span>Rs. </span>{{number_format($order->product_original_price * $order->quantity)}}</span>
    </td>
    <?php
        $totalPrice += $order->product_original_price * $order->quantity;
    ?>
</tr>
@endforeach
<tr>
    <td>Total</td>
    <td>Rs. {{$totalPrice}}</td>
</tr>
</table>
<br>

Regards,<br>
@if(isset($setting->site_name)) {{$setting->site_name}} @else {{ config('app.name') }} @endif
@endcomponent