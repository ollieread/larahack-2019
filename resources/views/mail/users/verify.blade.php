@component('mail::message')
# New Account

Hello {{ $user->name }} and welcome to The Ideas Company!

You have one last thing to do before you can get involved on the site, and that's verify your email address.

[{{ $url }}]({{ $url }})

Thanks,<br>
{{ config('app.name') }}
@endcomponent