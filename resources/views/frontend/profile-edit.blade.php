@extends('templates.frontend-layout')

@section('title')
    Editar: {{ $user->formalFullname }}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.datetimepicker.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/selectize.bootstrap3.css') }}" type="text/css">
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            @if(Auth::check() && Auth::user()->isAdmin())
                <div class="text-right">
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-sm"><i class="fa fa-reply"></i> Volver</a>
                </div>
            @endif
            <img id="img_user" src="@if(!empty($user->imageProfile)) {{ asset('images/profiles/' . $user->imageProfile) }} @elseif($user->genre === 'm') {{ asset('images/profiles/chico-jopo.png') }} @else {{ asset('images/profiles/chica-rodete.png') }} @endif" alt="{{ $user->formalFullname }}" class="img-fluid rounded-circle img-thumbnail">
            <h2 class="text-right page-header">
                {{ $user->formalFullname }}
                <a href="{{ route('home.profile.show', $user->slug) }}" class="btn btn-success btn-sm">Perfil <i class="fa fa-user-circle" aria-hidden="true"></i></a>
                <br>
                <small>
                    <span class="badge @if($user->type === 'administrador' || $user->type === 'sysadmin') badge-primary @elseif($user->type === 'frecuente') badge-info @elseif($user->type === 'empleado') badge-secondary @endif">{{ strtoupper($user->type) }}</span>
                </small>
            </h2>
            <div class="row justify-content-center">
                <div class="col-12 col-md-7 mb-5">
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
                            <div id="birth" class="input-group">
                                <div class="input-group-addon date-piker"><i class="fa fa-calendar"></i></div>
                                {{ Form::text('dateOfBirth', $user->dateOfBirth->format('d/m/Y'), ['class' => 'form-control date-picker', 'id' => 'dateOfBirth', 'placeholder' => 'Ingrese la fecha de nacimiento']) }}
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
                            <small class="text-danger">*Recuerde ingresar su codigo de país sin el + (mas) o reemplacelo por 00. Ejemplo: 005491123456789</small>
                        </div>
                        <div class="form-group">
                            {{ Form::label('phone', 'Tel&eacute;fono: ', ['class' => 'sr-only']) }}
                            <div class="input-group">
                                <div class="input-group-addon">Tel&eacute;fono:</div>
                                {{ Form::number('phone', $user->phone, ['class' => 'form-control', 'placeholder' => 'Ingrese su nº de teléfono']) }}
                            </div>
                            <small class="text-danger">*Recuerde ingresar su codigo de país sin el + (mas) o reemplacelo por 00. Ejemplo: 005491123456789</small>
                        </div>
                        <div class="form-group">
                            {{ Form::label('address', 'Direcci&oacute;n: ', ['class' => 'sr-only']) }}
                            <div class="input-group">
                                <div class="input-group-addon">Direcci&oacute;n:</div>
                                {{ Form::text('address', $user->address, ['class' => 'form-control', 'placeholder' => 'Ingrese su dirección']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="upload_image" role="button" style="cursor: pointer;">
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
                                    <img id="chica-carre" role="button" data-avatar="chica-carre.png" src="{{ asset('images/profiles/chica-carre.png') }}" alt="" class="img-fluid img-thumbnail rounded-circle img-avatar">
                                </td>
                                <td class="text-center">
                                    <img id="chica-hombros" role="button" data-avatar="chica-hombros.png" src="{{ asset('images/profiles/chica-hombros.png') }}" alt="" class="img-fluid img-thumbnail rounded-circle img-avatar">
                                </td>
                                <td class="text-center">
                                    <img id="chica-rodete" role="button" data-avatar="chica-rodete.png" src="{{ asset('images/profiles/chica-rodete.png') }}" alt="" class="img-fluid img-thumbnail rounded-circle img-avatar">
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <img id="chico-barba" role="button" data-avatar="chico-barba.png" src="{{ asset('images/profiles/chico-barba.png') }}" alt="" class="img-fluid img-thumbnail rounded-circle img-avatar">
                                </td>
                                <td class="text-center">
                                    <img id="chico-jopo" role="button" data-avatar="chico-jopo.png" src="{{ asset('images/profiles/chico-jopo.png') }}" alt="" class="img-fluid img-thumbnail rounded-circle img-avatar">
                                </td>
                                <td class="text-center">
                                    <img id="hombre-bigote" role="button" data-avatar="hombre-bigote.png" src="{{ asset('images/profiles/hombre-bigote.png') }}" alt="" class="img-fluid img-thumbnail rounded-circle img-avatar">
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <img id="pelado1" role="button" data-avatar="pelado1.png" src="{{ asset('images/profiles/pelado1.png') }}" alt="" class="img-fluid img-thumbnail rounded-circle img-avatar">
                                </td>
                                <td class="text-center">
                                    <img id="pelado2" role="button" data-avatar="pelado2.png" src="{{ asset('images/profiles/pelado2.png') }}" alt="" class="img-fluid img-thumbnail rounded-circle img-avatar">
                                </td>
                                <td class="text-center">
                                    <img id="rubia" role="button" data-avatar="rubia.png" src="{{ asset('images/profiles/rubia.png') }}" alt="" class="img-fluid img-thumbnail rounded-circle img-avatar">
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
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function (e) {
            window.profileFunc = function() {
                var sex = '<?php echo $user->genre ?>';
                var imgStored = '<?php echo $user->imageProfile ?>';
                if (!imgStored) {
                    if (sex === 'm') {
                        $('#chico-jopo').addClass('avatar-selected');
                    } else {
                        $('#chica-rodete').addClass('avatar-selected');
                    }
                }
            };
            $('#genre').selectize({
                create: false,
                placeholder: 'Seleccióne una opción de la lista',
                preload: true,
                inputClass: 'form-control selectize-input',
                dropdownParent: 'body'
            });
            window.profileFunc();
        });
    </script>
@endsection
