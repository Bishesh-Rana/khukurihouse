@component('mail::message')
# Change Your Password

You recently logged into {{ $setting->site_name }}.
This is to inform you that your password for login is:
#{{$data}}

You may change it from the Dashboard at any time.

Cheers,<br>
{{ config('app.name') }}
@endcomponent