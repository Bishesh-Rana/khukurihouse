@component('mail::message')

<img src="{{asset('')}}uploads/settings/{{$setting->site_logo}}" height="120px" width="350px"><br>

# Welcome to {{ config('app.name') }}

Thank you for signing up as an Affiliate.

Your OTP for affiliate verification is:

#{{$affiliate->verify_otp}}

It will expire in 5 mins.

Regards,<br>
{{ config('app.name') }}
@endcomponent