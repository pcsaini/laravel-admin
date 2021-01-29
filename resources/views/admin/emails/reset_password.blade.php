@component('mail::message')
Dear {{ $user->adminProfile->name }},

We have received a reset password request from your email. Please click on the below button to reset your password.

@component('mail::button', ['url' => route('admin.reset_password', ['token' => $user->token]), 'color' => 'green'])
    Reset Password
@endcomponent

If you have not requested to reset your password, send us an email <a
    href="mailto:{{ config('constants.support_mail') }}">{{ config('constants.support_mail') }}</a>.

Thanks,
{{ config('app.name') }}
@endcomponent
