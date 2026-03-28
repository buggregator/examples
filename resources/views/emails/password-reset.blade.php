@component('mail::message')
# Password Reset Request

Hello {{ $userName }},

We received a request to reset your password. Click the button below to choose a new one.

@component('mail::button', ['url' => $resetUrl, 'color' => 'primary'])
Reset Password
@endcomponent

This link will expire in 60 minutes. If you didn't request a password reset, you can safely ignore this email.

Thanks,<br>
{{ config('app.name') }}

@component('mail::subcopy')
If you're having trouble clicking the button, copy and paste the URL below into your browser: [{{ $resetUrl }}]({{ $resetUrl }})
@endcomponent
@endcomponent
