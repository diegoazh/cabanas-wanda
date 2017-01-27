@extends('templates.backend-layout')

@section('title', 'Listado de Usuarios')

@section('content')
    @include('backend.modals.modal-type-user')
    @include('backend.modals.modal-delete-user')
    <h1 class="tt-users">Usuarios registrados</h1>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Nombre completo</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">País</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td><a href="{{ route('users.show', $user->slug) }}" class="btn btn-link">{{ $user->displayName() }}</a></td>
                    <td>{{ $user->email }}</td>
                    <td><span class="label @if($user->country->abbreviation === 'AR') label-default @else label-success @endif">{{ $user->country->abbreviation }}</span></td>
                    <td><span class="label @if($user->type === 'administrador' || $user->type === 'sysadmin') label-primary @elseif($user->type === 'frecuente') label-info @elseif($user->type === 'empleado') label-default @endif">{{ strtoupper($user->type) }}</span></td>
                    <td>
                        <a role="button" class="btn btn-warning btn-xs btn-edit-type {{ $user->type }}-{{ $user->id }}" data-toggle="modal" data-target="#modalTypeUser">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar rol
                        </a>
                        <a role="button" class="btn btn-danger btn-xs {{ $user->lastname }}_{{ $user->name }}-{{ $user->id }}" data-toggle="modal" data-target="#modalDeleteUser">
                            <i class="fa fa-times" aria-hidden="true"></i> Eliminar
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="text-right"><small>Usuarios ordenados por fecha de registro del más reciente al más antiguo.</small></td>
                </tr>
            </tfoot>
        </table>
        <div class="text-center">{{ $users->render() }}</div>
    </div>
@endsection