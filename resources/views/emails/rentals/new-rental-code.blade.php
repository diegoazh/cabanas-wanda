@component('mail::message')
# NUEVO CÓDIGO DE RESERVA

Tu nuevo código de reserva es

### {{ $code }}

Ten encuenta que lo necesitarás para operar en nuestro sitio web.
Guarda el mail, aunque si lo pierdes o eliminas siempre podras obtener un nuevo código desde nuestro sitio web.

Te esperamos,<br>
{{ config('app.name') }}
@endcomponent
