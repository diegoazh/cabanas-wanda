@component('mail::message')

Gracias por contactarnos {{ $name }}

Hemos recibido tu consulta y te resonderemos a la brevedad al mail que ingresaste.

Nuevamente gracias por escribirnos y esperamos tenerte pronto como huesped.

Atte.

{{ config('app.name') }}<br>
<hr>
<small>Este mail fue generado automáticamente por nuestra app web,</small>
@endcomponent
