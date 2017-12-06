@extends('templates.frontend-layout')

@section('styles')
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-offset-4 col-md-4 col-lg-offset-4 col-lg-4">
            <div class="panel">
                <h1 class="text-center">¡Gracias por registrarte!</h1>
                <p class="text-justify">Tu cuenta aún <b>no está confirmada</b>. Te hemos enviado un email al correo <b>{{ $user->email }}</b> con el link de verificación.</p>
                <p class="text-justify">Solo debes hacer clic en el link o copiarlo en tu navegador preferido para que tu cuenta quede confirmada y activa, una vez hecho esto podrás empezar a operar en nuestro sitio.</p>
                <p class="text-justify">Si no encuentras el correo en tu bandeja de entrada <b>no olvides revisar la carpeta de spam</b>.</p>
                <p class="text-justify">Muchas gracias nuevamente y perdón por las molestias ocasionadas.</p>
                <p class="text-right">Atte. el equipo de Caba&ntilde;as de Wanda.</p>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
