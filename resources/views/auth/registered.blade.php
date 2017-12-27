@extends('templates.frontend-layout')

@section('styles')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="card my-5">
                    <div class="card-header bg-secondary text-light h3"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>¡Gracias por registrarte!</div>
                    <div class="card-body">
                        <h1 class="text-center">¡Gracias por registrarte!</h1>
                        <p class="text-justify">Tu cuenta aún <b>no está confirmada</b>. Te hemos enviado un email al correo <b>{{ $user->email }}</b> con el link de verificación.</p>
                        <p class="text-justify">Solo debes hacer clic en el link o copiarlo en tu navegador preferido para que tu cuenta quede confirmada y activa, una vez hecho esto podrás empezar a operar en nuestro sitio.</p>
                        <p class="text-justify">Si no encuentras el correo en tu bandeja de entrada <b>no olvides revisar la carpeta de spam</b>.</p>
                        <p class="text-justify">Muchas gracias nuevamente y perdón por las molestias ocasionadas.</p>
                        <p class="text-right">Atte. el equipo de Caba&ntilde;as de Wanda.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
