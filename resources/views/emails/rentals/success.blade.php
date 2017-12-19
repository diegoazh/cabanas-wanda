@component('mail::message')
# ¡La reserva se concretó exitosamente!

Muchas gracias por elegirnos.

Por favor conserva este e-mail como comprobante de la reserva pues el código de la misma es únicamente conocido por tí.

## Información de la reserva

- Cabaña: **{{ $rental->cottage->name }}**
- Precio: **${{ $rental->cottage_price }} AR**
- Dias: **{{ $rental->total_days}}**
- Descuentos: **${{ $rental->deductions ? $rental->deductions : 0 }} AR**
- Precio total: **${{ ($rental->cottage_price * $rental->total_days) - $rental->deductions }} AR**
- Desde: **{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $rental->dateFrom . ' 10:00:00')->format('d/m/Y H:i:s') }}**
- Hasta: **{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $rental->dateTo . ' 10:00:00')->format('d/m/Y H:i:s') }}**
- Vto. reserva: **{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $rental->dateFrom . ' 10:00:00')->subDay()->format('d/m/Y H:i:s') }}**
- Código de reserva: **{{ $rental->code ? $rental->code : 'Sin código, contacte al administrador.' }}**

Por favor ten encuenta que si pierdes el código de la reserva no podremos recuperarlo y deberás generar uno nuevo ingresando como usuario a [nuestro sitio web][web].

[web]:{{ config('app.url') }}
@component('mail::button', ['url' => ''])
    {{ $rental->code ? $rental->code : 'Sin código, contacte al administrador' }}
@endcomponent

Te esperamos,<br>
{{ config('app.name') }}
@endcomponent
