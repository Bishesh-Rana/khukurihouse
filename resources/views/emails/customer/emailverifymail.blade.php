@component('mail::message')
# Email Verification

Please click the button below to verify your email.

@component('mail::button', ['url' => url('/verify/'.$token), 'color' => 'success'])
Verify Email
@endcomponent

The verification link will expire in 10 minutes.

If you didn't register for @if(isset($setting->site_name)) {{$setting->site_name}} @else {{ config('app.name') }} @endif , kindly discard this message.

Regards,<br>
@if(isset($setting->site_name)) {{$setting->site_name}} @else {{ config('app.name') }} @endif
@endcomponent
