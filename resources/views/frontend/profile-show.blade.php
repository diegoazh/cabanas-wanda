@extends('templates.frontend-layout')

@section('title')
    {{ $user->formalFullname }}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            @if(Auth::check() && Auth::user()->isAdmin())
                <div class="text-right">
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-sm"><i class="fa fa-reply"></i> Volver</a>
                </div>
            @endif
            <img  id="img_user" src="@if(!empty($user->imageProfile)) {{ asset('images/profiles/' . $user->imageProfile) }} @elseif($user->genre === 'm') {{ asset('images/profiles/chico-jopo.png') }} @else {{ asset('images/profiles/chica-rodete.png') }} @endif" alt="{{ $user->formalFullname }}" class="img-fluid rounded-circle img-thumbnail">
            <h2 class="text-right page-header">
                {{ $user->formalFullname }}
                @if(Auth::check() && Auth::user()->dni === $user->dni)
                    <a href="{{ route('home.profile.edit', $user->slug) }}" class="btn btn-warning btn-sm">Editar <i class="fa fa-edit"></i></a>
                @endif
                <br>
                <small>
                    <span class="badge @if($user->type === 'administrador' || $user->type === 'sysadmin') badge-primary @elseif($user->type === 'frecuente') badge-info @elseif($user->type === 'empleado') badge-secondary @endif">{{ strtoupper($user->type) }}</span>
                </small>
            </h2>
            <table class="table table-sm table-striped mb-5">
                <thead class="thead-dark">
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
                        <td><span class="badge @if($user->country->abbreviation === 'AR') badge-secondary @else badge-success @endif">{{ $user->country->country }}</span></td>
                    </tr>
                    @if(Auth::check() && Auth::user()->isAdmin())
                        <tr>
                            <th scope="row">Fecha de nacimiento:</th>
                            <td>{{ $user->dateOfBirth->diffForHumans() }}</td>
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
                            <td><span class="badge badge-pill badge-info">{{ $user->email }}</span></td>
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
