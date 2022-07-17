@component('mail::message')
<img src="{{$data['img_url']}}" width="100%">


<center><a href="{{$data['url']}}" style="display: inline-block; padding:12px 16px; background-color:#333;color:white;">Click Here</a></center>
{{-- @component('mail::button', ['url' => ''])
Click Here
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
