@component('mail::message')
Hello {{ $admin->name }},

<p>We understand that you've requested to reset your password.</p>

<p>If you didn't make this request, you can safely ignore this email. Your account security is important to us.</p>

@component('mail::button', ['url' => url('/password/reset/' . $admin->remember_token)])
Reset Password
@endcomponent

<p>If you encounter any issues while resetting your password or need further assistance, please don't hesitate to reach out to our support team.</p>

<p>Support Email: <strong>roleandpermission@gmail.com</strong></p>

Thanks, <br>
{{ config('app.name') }}

@endcomponent
