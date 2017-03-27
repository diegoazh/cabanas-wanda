@extends('templates.frontend-layout')

@section('title')
    Editar: {{ $user->displayName() }}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ elixir('css/profile.css') }}" type="text/css">
@endsection

@section('content')
    <div class="col-md-offset-2 col-md-8">
        @if(Auth::check() && Auth::user()->isAdmin())
            <div class="text-right">
                <a href="{{ route('users.index') }}" class="btn btn-default btn-xs"><i class="fa fa-reply"></i> Volver</a>
            </div>
        @endif
        <img id="img_user" src="@if(!empty($user->imageProfile)) {{ asset('images/profiles/' . $user->imageProfile) }} @elseif($user->genre === 'm') {{ asset('images/profiles/chico-jopo.png') }} @else {{ asset('images/profiles/chica-rodete.png') }} @endif" alt="{{ $user->displayName() }}" class="img-responsive img-circle img-thumbnail">
        <h2 class="text-right page-header">
            {{ $user->displayName() }}
            <a href="{{ route('home.profile.show', $user->slug) }}" class="btn btn-success btn-xs">Perfil <i class="fa fa-user-circle" aria-hidden="true"></i></a>
            <br>
            <small>
                <span class="label @if($user->type === 'administrador' || $user->type === 'sysadmin') label-primary @elseif($user->type === 'frecuente') label-info @elseif($user->type === 'empleado') label-default @endif">{{ strtoupper($user->type) }}</span>
            </small>
        </h2>
        <div class="col-md-offset-3 col-md-6">
            {{ Form::open(['route' => ['home.profile.update', $user->slug], 'method' => 'PUT', 'files' => true]) }}
                <div class="form-group">
                    {{ Form::label('name', 'Nombre: ', ['class' => 'sr-only']) }}
                    <div class="input-group">
                        <div class="input-group-addon">Nombre:</div>
                        {{ Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('lastname', 'Apellido: ', ['class' => 'sr-only']) }}
                    <div class="input-group">
                        <div class="input-group-addon">Apellido:</div>
                        {{ Form::text('lastname', $user->lastname, ['class' => 'form-control', 'placeholder' => 'Ingrese el apellido']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('dateOfBirth', 'Nacimiento: ', ['class' => 'sr-only']) }}
                    <div class="input-group date">
                        <div class="input-group-addon date-piker"><i class="fa fa-calendar"></i> Nacimiento:</div>
                        {{ Form::text('dateOfBirth', $user->dateOfBirth->format('d/m/Y'), ['class' => 'form-control date-picker', 'id' => 'dateOfBirth', 'data-provide' => 'datepicker', 'data-date-format' => 'dd/mm/yyyy', 'placeholder' => 'Ingrese la fecha de nacimiento']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('genre', 'Sexo: ', ['class' => 'sr-only']) }}
                    <div class="input-group">
                        <div class="input-group-addon">Sexo:</div>
                        {{ Form::select('genre', ['m' => 'Masculino', 'f' => 'Femenino', 'o' => 'Otro'], $user->genre, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('dni', 'DNI: ', ['class' => 'sr-only']) }}
                    <div class="input-group">
                        <div class="input-group-addon">DNI:</div>
                        {{ Form::number('dni', $user->dni, ['class' => 'form-control', 'placeholder' => 'Ingrese el nº de pasaporte', 'disabled' => true]) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('passport', 'Pasaporte: ', ['class' => 'sr-only']) }}
                    <div class="input-group">
                        <div class="input-group-addon">Pasaporte:</div>
                        {{ Form::text('passport', $user->passport, ['class' => 'form-control', 'placeholder' => 'Ingrese el nº de pasaporte']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('email', 'E-mail: ', ['class' => 'sr-only']) }}
                    <div class="input-group">
                        <div class="input-group-addon">E-mail:</div>
                        {{ Form::email('email', $user->email, ['class' => 'form-control', 'placeholder' => 'Ingrese su email', 'disabled' => 'disabled']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('celphone', 'Celular: ', ['class' => 'sr-only']) }}
                    <div class="input-group">
                        <div class="input-group-addon">Celular:</div>
                        {{ Form::number('celphone', $user->celphone, ['class' => 'form-control', 'placeholder' => 'Ingrese su nº de celular']) }}
                    </div>
                    <small class="text-danger">*Recuerde ingresar su codigo de país sin el + (mas). Ejemplo: 541123456789</small>
                </div>
                <div class="form-group">
                    {{ Form::label('phone', 'Tel&eacute;fono: ', ['class' => 'sr-only']) }}
                    <div class="input-group">
                        <div class="input-group-addon">Tel&eacute;fono:</div>
                        {{ Form::number('phone', $user->phone, ['class' => 'form-control', 'placeholder' => 'Ingrese su nº de teléfono']) }}
                    </div>
                    <small class="text-danger">*Recuerde ingresar su codigo de país sin el + (mas). Ejemplo: 541123456789</small>
                </div>
                <div class="form-group">
                    {{ Form::label('address', 'Direcci&oacute;n: ', ['class' => 'sr-only']) }}
                    <div class="input-group">
                        <div class="input-group-addon">Direcci&oacute;n:</div>
                        {{ Form::text('address', $user->address, ['class' => 'form-control', 'placeholder' => 'Ingrese su nº de teléfono']) }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="upload_image" role="button">
                        <input id="upload_image" type="checkbox" value="false" role="button"> Subir foto
                    </label>
                </div>
                <div class="form-group imageProfile">
                    {{ Form::label('imageProfile', 'Foto de perfil: ', ['class' => 'sr-only']) }}
                    <div class="input-group">
                        <div class="input-group-addon">Foto de perfil:</div>
                        {{ Form::file('imageProfile', ['class' => 'form-control', 'id' => 'imageProfile']) }}
                        {{ Form::hidden('image_avatar') }}
                    </div>
                </div>
                <div id="avatar_profile" class="table-responsive">
                    <table class="table">
                    <tr>
                        <td class="text-center">
                            <img role="button" data-avatar="chica-carre.png" src="{{ asset('images/profiles/chica-carre.png') }}" alt="" class="img-responsive img-thumbnail img-circle img-avatar">
                        </td>
                        <td class="text-center">
                            <img role="button" data-avatar="chica-hombros.png" src="{{ asset('images/profiles/chica-hombros.png') }}" alt="" class="img-responsive img-thumbnail img-circle img-avatar">
                        </td>
                        <td class="text-center">
                            <img role="button" data-avatar="chica-rodete.png" src="{{ asset('images/profiles/chica-rodete.png') }}" alt="" class="img-responsive img-thumbnail img-circle img-avatar">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <img role="button" data-avatar="chico-barba.png" src="{{ asset('images/profiles/chico-barba.png') }}" alt="" class="img-responsive img-thumbnail img-circle img-avatar">
                        </td>
                        <td class="text-center">
                            <img role="button" data-avatar="chico-jopo.png" src="{{ asset('images/profiles/chico-jopo.png') }}" alt="" class="img-responsive img-thumbnail img-circle img-avatar">
                        </td>
                        <td class="text-center">
                            <img role="button" data-avatar="hombre-bigote.png" src="{{ asset('images/profiles/hombre-bigote.png') }}" alt="" class="img-responsive img-thumbnail img-circle img-avatar">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <img role="button" data-avatar="pelado1.png" src="{{ asset('images/profiles/pelado1.png') }}" alt="" class="img-responsive img-thumbnail img-circle img-avatar">
                        </td>
                        <td class="text-center">
                            <img role="button" data-avatar="pelado2.png" src="{{ asset('images/profiles/pelado2.png') }}" alt="" class="img-responsive img-thumbnail img-circle img-avatar">
                        </td>
                        <td class="text-center">
                            <img role="button" data-avatar="rubia.png" src="{{ asset('images/profiles/rubia.png') }}" alt="" class="img-responsive img-thumbnail img-circle img-avatar">
                        </td>
                    </tr>
                </table>
                </div>
                <div class="text-center">
                    {{ Form::submit('Actualizar info', ['class' => 'btn btn-success btn-lg']) }}
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('scripts')
@endsection
