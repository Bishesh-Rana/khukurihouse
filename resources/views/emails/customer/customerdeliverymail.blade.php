@component('mail::message')

@if(isset($setting->site_logo))
<img src="{{asset('')}}uploads/settings/{{$setting->site_logo}}" height="130px" width="300px"><br>
@endif

# Thank you for shopping with {{ config('app.name') }}.
Your order has been Delivered.
Your order details are as follows:

Order Code: <strong> {{$payment->ref_id}}</strong><br>
Date: <strong> {{date('M d, Y',strtotime($payment->created_at))}}</strong><br>
Total Price To Pay: <strong> Rs. {{number_format($payment->total_price)}}</strong><br>
Payment method:
@if($payment->esewa == 1)<strong> Pay with Esewa</strong>
@elseif($payment->khalti == 1)<strong> Pay with Khalti</strong>
@elseif($payment->imepay == 1)<strong> Pay with IME Pay</strong>
@else <strong> Pay on Delivery</strong>@endif
<br>

<table>
@foreach($orders as $order)
<tr>
    <td>
        {{$order->product_name}}
        <strong>× {{$order->quantity}}</strong>
    </td>
    <td>
        <span><span>Rs. </span>{{number_format($order->product_original_price * $order->quantity)}}</span>
    </td>
</tr>
@endforeach
<tr>
    <td>Total</td>
    <td>Rs. {{$payment->total_price}}</td>
</tr>
</table>
<br>


Regards,<br>
@if(isset($setting->site_name)) {{$setting->site_name}} @else {{ config('app.name') }} @endif
@endcomponent