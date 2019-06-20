@component('mail::message')
# Solicitud de cambio de contraseña

Haga clic en el botón de abajo para cambiar la contraseña

@component('mail::button', ['url' => 'http://localhost:4200/response-password-reset?token='.$token])
Restablecer Contraseña
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent