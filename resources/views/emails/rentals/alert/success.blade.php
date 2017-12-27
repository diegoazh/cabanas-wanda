@component('mail::message')
# ¡Nueva reserva online!

Han realizado una nueva reserva desde la [app web][web].

Los datos asociados a la misma se detallan a continuación.

Para más detalles [ingrese a la app web][app] como administrador y podrá ver toda la información en el panel principal.

## Información de la reserva

- Cabaña: **{{ $rental->cottage->name }}**
- Precio: **${{ $rental->cottage_price }} AR**
- Dias: **{{ $rental->total_days}}**
- Descuentos: **${{ $rental->deductions ? $rental->deductions : 0 }} AR**
- Precio total: **${{ $rental->finalPayment }} AR**
- Desde: **{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $rental->dateFrom . ' 10:00:00')->format('d/m/Y H:i:s') }}**
- Hasta: **{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $rental->dateTo . ' 10:00:00')->format('d/m/Y H:i:s') }}**
- Monto reserva: **${{ $rental->finalPayment * 30 / 100 }} AR**
- Vto. reserva: **{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $rental->dateFrom . ' 10:00:00')->subDay()->format('d/m/Y H:i:s') }}**

Por favor tenga en cuenta que pasada la fecha y hora del vto. de reserva el sistema cancelará automaticamente la misma. Si ya ha recibido la seña deberá cambiar su estado a confirmado manualmente desde el panel de administración de la [app web][web].

[web]:{{ config('app.url') }}
[app]:{{ config('app.url') . '/login' }}

Atte. su app web,<br>
{{ config('app.name') }}
@endcomponent
