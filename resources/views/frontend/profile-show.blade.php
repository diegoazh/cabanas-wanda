@extends('templates.frontend-layout')

@section('title')
    {{ $user->displayName() }}
@endsection

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/frontend/profile.css') }}">
@endsection

@section('content')
    <div class="col-md-offset-2 col-md-8">
        @if(Auth::check() && Auth::user()->isAdmin())
            <div class="text-right">
                <a href="{{ route('users.index') }}" class="btn btn-default btn-xs"><i class="fa fa-reply"></i> Volver</a>
            </div>
        @endif
        <img  id="img_user" src="@if(!empty($user->image_profile)) {{ asset('images/profiles/' . $user->image_profile) }} @elseif($user->genre === 'm') {{ asset('images/profiles/chico-jopo.png') }} @else {{ asset('images/profiles/chica-rodete.png') }} @endif" alt="{{ $user->displayName() }}" class="img-responsive img-circle img-thumbnail">
        <h2 class="text-right page-header">
            {{ $user->displayName() }}
            @if(Auth::check() && Auth::user()->dni === $user->dni)
                <a href="{{ route('home.profile.edit', $user->slug) }}" class="btn btn-warning btn-xs">Editar <i class="fa fa-edit"></i></a>
            @endif
            <br>
            <small>
                <span class="label @if($user->type === 'administrador' || $user->type === 'sysadmin') label-primary @elseif($user->type === 'frecuente') label-info @elseif($user->type === 'empleado') label-default @endif">{{ strtoupper($user->type) }}</span>
            </small>
        </h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" colspan="2" class="text-right">Detalles del Perfil</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Nombre:</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Apellido:</th>
                        <td>{{ $user->lastname }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Sexo:</th>
                        <td>@if($user->genre === 'm') Hombre @elseif('f') Mujer @else Otro @endif</td>
                    </tr>
                    <tr>
                        <th scope="row">País</th>
                        <td><span class="label @if($user->country->abbreviation === 'AR') label-default @else label-success @endif">{{ $user->country->country }}</span></td>
                    </tr>
                    @if(Auth::check() && Auth::user()->isAdmin())
                        <tr>
                            <th scope="row">Fecha de nacimiento:</th>
                            <td>{{ $user->date_of_birth->diffForHumans() }}</td>
                        </tr>
                        <tr>
                            <th scope="row">DNI:</th>
                            <td>{{ $user->dni }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Pasaporte:</th>
                            <td>{{ $user->passport }}</td>
                        </tr>
                        <tr>
                            <th scope="row">E-mail:</th>
                            <td><span class="label label-email">{{ $user->email }}</span></td>
                        </tr>
                        <tr>
                            <th scope="row">Celular:</th>
                            <td>{{ $user->celphone }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Tel&eacute;fono:</th>
                            <td>{{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Direcci&oacute;n:</th>
                            <td>{{ $user->address }}</td>
                        </tr>
                        <tr>
                            <th scope="row">&Uacute;ltima actualizaci&oacute;n</th>
                            <td>{{ ucfirst($user->created_at->format('l\, d')) . ' de ' . ucfirst($user->created_at->format('F')) . ' de ' . $user->created_at->format('Y') }}</td>
                        </tr>
                    @endif
                    <tr>
                        <th scope="row">Fecha de alta:</th>
                        <td>{{ ucfirst($user->updated_at->format('l\, d')) . ' de ' . ucfirst($user->updated_at->format('F')) . ' de ' . $user->updated_at->format('Y') }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
