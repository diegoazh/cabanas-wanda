@extends('templates.backend-layout')

@section('title', 'Usuarios registrados')

@section('content')
    @include('backend.modals.modal-forms')
    <h1 class="tt-users pl-3 py-3">
        Usuarios registrados
        {!! Form::open(['route' => 'users.index', 'method' => 'get', 'class' => 'form-inline float-right mr-3']) !!}
            <div class="form-group">
                <label for="searchUser" class="col-form-label sr-only">Buscar mail:</label>
                {!! Form::text('search', isset($search) ? $search : null, ['class' => 'form-control', 'id' => 'searchUser', 'placeholder' => 'Buscar mail...', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Presione ENTER para buscar']) !!}
            </div>
        {!! Form::close() !!}
    </h1>
    <table class="table table-striped table-hover">
        <thead class="thead bg-dark text-light">
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
            <tr data-object="{{ $user->id }}">
                <td><a href="{{ route('home.profile.show', $user->slug) }}" class="btn btn-link">{{ $user->formalFullname }}</a></td>
                <td class="email-lower">{{ $user->email }}</td>
                <td><span class="badge @if($user->country->abbreviation === 'AR') badge-secondary @else badge-success @endif">{{ $user->country->abbreviation }}</span></td>
                <td><span class="badge @if($user->type === 'administrador' || $user->type === 'sysadmin') badge-primary @elseif($user->type === 'frecuente') badge-info @elseif($user->type === 'empleado') badge-secondary @endif">{{ strtoupper($user->type) }}</span></td>
                @if(Auth::user()->type === 'administrador' || Auth::user()->type === 'sysadmin')
                    <td>
                        <a role="button" class="btn btn-outline-warning btn-sm btn-edit-type" data-toggle="modal" data-target="#modalForms" data-object-display="{{ $user->formalFullname }}" data-object-value="{{ $user->type }}">
                            <i class="fas fa-edit" aria-hidden="true"></i> Editar rol
                        </a>
                        <a role="button" class="btn btn-outline-danger btn-sm btn-delete-user" data-toggle="modal" data-target="#modalForms" data-object-display="{{ $user->formalFullname }}" data-object-value="{{ $user->formalFullname }}">
                            <i class="fas fa-user-times" aria-hidden="true"></i> Eliminar
                        </a>
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="{{ (Auth::user()->type === 'administrador' || Auth::user()->type === 'sysadmin') ? 5 : 4 }}" class="text-right">
                    <small class="text-muted">Usuarios ordenados por fecha de registro del más reciente al más antiguo.</small>
                </td>
            </tr>
        </tfoot>
    </table>
    <div class="text-center align-self-center mt-1 mb-3">{{ $users->links('vendor.pagination.bootstrap-4') }}</div>
@endsection

@section('scripts')
@endsection