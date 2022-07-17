@component('mail::message')

<img src="{{asset('')}}uploads/settings/{{$setting->site_logo}}" height="120px" width="350px"><br>

# Welcome to {{ config('app.name') }}

Thank you for signing up. Contact {{ config('app.name') }} for your account activation.

Please click on the below link to login to your Affiliate Dashboard once your account is activated.

#<a href="{{route('affiliate.dashboard')}}">{{$setting->site_url.'ns-affiliate'}}</a>

Regards,<br>
{{ config('app.name') }}
@endcomponent