@component('mail::message')
# Hello

This is Genie.
Thank you for contacting us.
We hope to provide you with the assistance you need.
i will we work on the design later
@component('mail::button', ['url' => ''])
Click me
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
