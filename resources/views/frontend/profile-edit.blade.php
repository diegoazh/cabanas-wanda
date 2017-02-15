@extends('templates.frontend-layout')

@section('title')
    Editar: {{ $user->displayName() }}
@endsection

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/frontend/profile.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('js/bootstrap-datepicker-1.6.4-dist/css/bootstrap-datepicker3.min.css') }}" type="text/css">
@endsection

@section('content')
    <div class="col-md-offset-2 col-md-8">
        @if(Auth::check())
            @if(Auth::user()->type === 'administrador' || Auth::user()->type === 'sysadmin')
                <div class="text-right">
                    <a href="{{ route('users.index') }}" class="btn btn-default btn-xs"><i class="fa fa-reply"></i> Volver</a>
                </div>
            @endif
            @if(Auth::user()->dni === $user->dni)
                <img src="@if(!empty($user->image_profile)) {{ $user->image_profile }} @elseif($user->genre === 'm') {{ asset('images/avatars-icons/chico-jopo.png') }} @else {{ asset('images/avatars-icons/chica-rodete.png') }} @endif" alt="{{ $user->displayName() }}" class="img-responsive img-circle img-thumbnail">
                <h2 class="text-right">
                    {{ $user->displayName() }}
                    @if(Auth::check() && Auth::user()->dni === $user->dni)
                        <a href="{{ route('home.profile.show', $user->slug) }}" class="btn btn-success btn-xs">Perfil <i class="fa fa-user-circle" aria-hidden="true"></i></a>
                    @endif
                    <br>
                    <small>
                        <span class="label @if($user->type === 'administrador' || $user->type === 'sysadmin') label-primary @elseif($user->type === 'frecuente') label-info @elseif($user->type === 'empleado') label-default @endif">{{ strtoupper($user->type) }}</span>
                    </small>
                </h2>
                <div class="col-md-offset-2 col-md-5">
                    {{ Form::open() }}
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
                        {{ Form::label('date_of_birth', 'Nacimiento: ', ['class' => 'sr-only']) }}
                        <div class="input-group date">
                            <div class="input-group-addon date-piker"><i class="fa fa-calendar"></i> Nacimiento:</div>
                            {{ Form::text('date_of_birth', $birth->format('d/m/Y'), ['class' => 'form-control date-picker', 'id' => 'date_of_birth', 'data-provide' => 'datepicker', 'data-date-format' => 'dd/mm/yyyy', 'placeholder' => 'Ingrese la fecha de nacimiento']) }}
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
                            {{ Form::number('dni', $user->dni, ['class' => 'form-control', 'placeholder' => 'Ingrese el nº de pasaporte']) }}
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
                    {{ Form::close() }}
                </div>
            @else
            @endif
        @endif
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/bootstrap-datepicker-1.6.4-dist/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/frontend/profile-edit.js') }}" type="text/javascript"></script>
@endsection
