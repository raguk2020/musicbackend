@component('mail::message')
#Change your password Request

Click on the button  below to change Password

@component('mail::button', ['url' => 'http://localhost:4200/response-password-reset?token='.$token->token])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
