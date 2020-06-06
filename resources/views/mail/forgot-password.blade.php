@component('mail::message')
#Hello!
You are receiving this email because we received a password reset request for your account.

@component('mail::button', ['url' => ''])
Reset Password
@endcomponent

This password reset link will expire in 60 minutes.
If you did not request a password reset, no further action is required.<br>
Regards,
{{ config('app.name') }}
If you’re having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:
http://handiman.club/password/reset/{{$token}}?email={{$email}}
@endcomponent
