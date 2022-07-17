@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
@if(isset($setting->site_logo))
<img src="{{asset('')}}uploads/settings/{{$setting->site_logo}}" height="90px" width="300px"><br>
@endif
@endcomponent
@endslot

{{-- Body --}}
<style>
table {
font-family: arial, sans-serif;
border-collapse: collapse;
width: 100%;
}

td,
th {
border: 1px solid #dddddd;
text-align: left;
padding: 8px;
}

tr:nth-child(even) {
background-color: #dddddd;
}
</style>
# Thank you for shopping with {{ config('app.name') }}.
Your order has been received.
Your order details are as follows:

Order Code: <strong> {{$payment->ref_id}}</strong><br>
Date: <strong> {{date('M d, Y',strtotime($payment->created_at))}}</strong><br>
Total Price To Pay: <strong> Rs. {{number_format($payment->total_price + $payment->delivery_cost)}}</strong><br>
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
<td>Subtotal</td>
<td>Rs. {{number_format($payment->total_price)}}</td>
</tr>
<tr>
<td>Delivery Charge</td>
<td>Rs. {{number_format($payment->delivery_cost)}}</td>
</tr>
<tr>
<td>Total</td>
<td>Rs. {{number_format($payment->total_price + $payment->delivery_cost)}}</td>
</tr>

</tr>
</table>
<br>

{{-- Subcopy --}}
@slot('subcopy')
@component('mail::subcopy')
Regards,<br>
@if(isset($setting->site_name)) {{$setting->site_name}} @else {{ config('app.name') }} @endif
@endcomponent
@endslot


{{-- Footer --}}
@slot('footer')
@component('mail::footer')
<div class="copyright">Copyright &copy; {{date('Y')}} <a href="{{route('home.index')}}">{{$setting->site_name}}</a>. All rights reserved.
@endcomponent
@endslot
@endcomponent