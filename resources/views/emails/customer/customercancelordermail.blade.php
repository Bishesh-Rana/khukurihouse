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
#  {{ config('app.name') }}.
This is to confirm that your order for the following product has been cancelled.

Order Code: <strong> {{$order->ref_id}}</strong><br>
Date: <strong> {{date('M d, Y',strtotime($order->updated_at))}}</strong><br>

<br>

<table>
<tr>
<td>
{{$order->product_name}}
<strong>× {{$order->quantity}}</strong>
</td>
<td>
<span><span>Rs. </span>{{number_format($order->product_original_price * $order->quantity)}}</span>
</td>
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