@component('mail::message')

<img src="{{asset('')}}uploads/settings/{{$setting->site_logo}}" height="150px" width="350px"><br>

# Forgot Password

Your OTP for forgot password is:

#{{$forgot_password_otp}}

It will expire in 5 mins.

Thanks,<br>
{{ config('app.name') }}
@endcomponent