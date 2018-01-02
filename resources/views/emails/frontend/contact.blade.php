@component('mail::message')

Hola administrador.

Tienes una nueva consulta desde la web por favor no olvides responder al cliente.

# Nuevo contacto de usuario desde la app web
- Nombre: {{ $name }}
- Email: {{ $email }}
- Teléfono: {{ $phone ? $phone : '' }}

# Consulta:

{{ $content }}


Este mail fue generado por el usuario desde la app web,<br>
{{ config('app.name') }}
@endcomponent
