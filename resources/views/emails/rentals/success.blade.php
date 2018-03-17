@component('mail::message')
# ¡La reserva se concretó exitosamente!

Muchas gracias por elegirnos.

Por favor conserva este e-mail como comprobante de la reserva pues el código de la misma es únicamente conocido por tí.

## Información de la reserva

- Cabaña: **{{ $rental->cottage->name }}**
- Precio: **${{ $rental->cottage_price }} AR**
- Dias: **{{ $rental->total_days}}**
- Descuentos: **${{ $rental->deductions ? $rental->deductions : 0 }} AR**
- Precio total: **${{ $rental->finalPayment }} AR**
- Desde: **{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $rental->dateFrom . ' 10:00:00')->format('d/m/Y H:i:s') }}**
- Hasta: **{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $rental->dateTo . ' 10:00:00')->format('d/m/Y H:i:s') }}**
- Monto reserva: **${{ $rental->finalPayment * 30 / 100 }} AR**
- Vto. reserva: **{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $rental->dateReservationPayment)->format('d/m/Y H:i:s') }}**
- Código de reserva: **{{ $rental->code ? $rental->code : 'Sin código, contacte al administrador.' }}**

## Depositos y transferencias

Para confirmar la reserva deberá realizar el deposito de la seña en la siguiente cuenta bancaria antes de la fecha de vto. de la misma.

- Banco: **{{ $rental->banking->bank }}**
- Sucursal: **{{ $rental->banking->branch_office }}**
- Tipo de Cta.: **{{ strtoupper(preg_replace("/_/"," ", $rental->banking->type)) }}**
- Titular de Cta.: **{{ strtoupper($rental->banking->account_holder) }}**
- C.U.I.T.: **{{ $rental->banking->cuit }}**
- Nro. Cta.: **{{ $rental->banking->nro_cta }}**
- C.B.U.: **{{ $rental->banking->cbu }}**
- Alias: **{{ !empty($rental->banking->alias) ? strtoupper($rental->banking->alias) : ' ' }}**

**Recuerde que al momento de check in le solicitaremos su DNI o DU y una fotocopia del mismo (frente y dorso), si es pasaporte la fotocopia debe ser de la primera hoja (donde figuran sus datos y fotografía) y de la hoja donde consta la fecha de ingreso al país con el sello correspondiente.**

Por favor tenga en cuenta que si pierde este email, no podemos recuperar el código de la reserva y deberá generar uno nuevo ingresando como usuario a [nuestro sitio web][web].

[web]:{{ config('app.url') }}
@component('mail::button', ['url' => ''])
    {{ $rental->code ? $rental->code : 'Sin código, contacte al administrador' }}
@endcomponent

Te esperamos,<br>
{{ config('app.name') }}
@endcomponent
