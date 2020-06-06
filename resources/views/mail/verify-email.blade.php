@component('mail::message')
#Dear,{{$content['name']}}
You are receiving this email because we received a signup request for your this mail account.

@component('mail::button', ['url' => ''])
Verify Email
@endcomponent


If you did not send a sigup request, no further action is required.<br>
Regards,
{{ config('app.name') }}

@endcomponent
