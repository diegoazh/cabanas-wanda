@component('mail::message')
    # NUEVO CÓDIGO DE RESERVA

Nuevo código para tu reserva del {{ \Jenssegers\Date\Date::createFromFormat('Y-m-d', $rental->dateFrom)->format('l, d \d\e F \d\e Y') }}

### {{ $code }}

Ten encuenta que lo necesitarás para operar en nuestro sitio web.
Guarda el mail, aunque si lo pierdes o eliminas siempre podrás obtener un nuevo código desde nuestro sitio web.

Saludos cordiales,<br>
{{ config('app.name') }}
@endcomponent
