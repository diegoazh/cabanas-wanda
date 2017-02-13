@extends('templates.backend-layout')

@section('title', 'Listado de Usuarios')

@section('content')
    @include('backend.modals.modal-forms')
    <h1 class="tt-users">Usuarios registrados</h1>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Nombre completo</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">País</th>
                    <th scope="col">Tipo</th>
                    @if(Auth::user()->type === 'administrador' || Auth::user()->type === 'sysadmin')
                        <th scope="col">Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr data-object-id="{{ $user->id }}">
                    <td><a href="{{ route('users.show', $user->slug) }}" class="btn btn-link">{{ $user->displayName() }}</a></td>
                    <td>{{ $user->email }}</td>
                    <td><span class="label @if($user->country->abbreviation === 'AR') label-default @else label-success @endif">{{ $user->country->abbreviation }}</span></td>
                    <td><span class="label @if($user->type === 'administrador' || $user->type === 'sysadmin') label-primary @elseif($user->type === 'frecuente') label-info @elseif($user->type === 'empleado') label-default @endif">{{ strtoupper($user->type) }}</span></td>
                    @if(Auth::user()->type === 'administrador' || Auth::user()->type === 'sysadmin')
                        <td>
                            <a role="button" class="btn btn-warning btn-xs btn-edit-type" data-toggle="modal" data-target="#modalForms" data-object-display="{{ $user->displayName() }}" data-object-value="{{ $user->type }}">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar rol
                            </a>
                            <a role="button" class="btn btn-danger btn-xs btn-delete-user" data-toggle="modal" data-target="#modalForms" data-object-display="{{ $user->displayName() }}" data-object-value="{{ $user->displayName() }}">
                                <i class="fa fa-user-times" aria-hidden="true"></i> Eliminar
                            </a>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="{{ (Auth::user()->type === 'administrador' || Auth::user()->type === 'sysadmin') ? 5 : 4 }}" class="text-right"><small>Usuarios ordenados por fecha de registro del más reciente al más antiguo.</small></td>
                </tr>
            </tfoot>
        </table>
        <div class="text-center">{{ $users->render() }}</div>
    </div>
@endsection