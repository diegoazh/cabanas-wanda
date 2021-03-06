@extends('templates.backend-layout')

@section('title', 'Listado de Cabañas')

@section('content')
    @include('backend.modals.modal-forms')
    <h1 class="pl-3 py-3"><i class="fas fa-home" aria-hidden="true"></i> Lista de Caba&ntilde;as
        @if(Auth::user()->isAdmin())
            <button class="btn btn-outline-info pull-right mr-3" type="button" data-toggle="modal" data-target="#bulkActions">
                <i class="fa fa-bolt" aria-hidden="true"></i> Acciones masivas
            </button>
        @endif
    </h1>
        <table class="table table-striped table-hover">
            <thead class="thead bg-dark text-light">
                <tr>
                    <th>N&uacute;mero</th>
                    <th>Nombre</th>
                    <th>Capacidad</th>
                    <th>Estado</th>
                    <th>Precio</th>
                    <th>Tipo</th>
                    @if(Auth::user()->type === 'administrador' || Auth::user()->type === 'sysadmin')
                        <th>Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>
            @foreach($cottages as $cottage)
                <tr data-object="{{ $cottage->id }}">
                    <td>
                        <span class="badge badge-secondary"><i class="fas fa-hashtag" aria-hidden="true"></i> {{ $cottage->number }}</span>
                    </td>
                    <td><a class="btn btn-link" href="{{ route('cottages.show', $cottage->slug) }}">{{ strtoupper($cottage->name) }}</a></td>
                    <td>
                        {{ $cottage->accommodation }} <i class="glyphicon glyphicon-user"></i>
                    </td>
                    <td>
                        <span class="badge @if($cottage->state === 'enabled') badge-success @elseif($cottage->state === 'maintenance') badge-warning @elseif($cottage->state === 'disabled') badge-danger @endif">@if($cottage->state === 'enabled') Habilitada @elseif($cottage->state === 'disabled') Deshabilitada @else Mantenimiento @endif</span>
                    </td>
                    <td>
                        <i class="fas fa-dollar-sign" aria-hidden="true"></i> {{ $cottage->price }}
                    </td>
                    <td>
                        <span class="text-capitalize badge @if($cottage->type === 'simple') badge-primary @else badge-success @endif">{{ $cottage->type }}</span>
                    </td>
                    @if(Auth::user()->type === 'administrador' || Auth::user()->type === 'sysadmin')
                        <td>
                            <a href="{{ route('cottages.edit', $cottage) }}" role="button" class="btn btn-outline-warning btn-sm text-dark"><i class="fa fa-edit" aria-hidden="true"></i> Editar</a>
                            <a role="button" class="btn btn-outline-danger btn-sm delete-cottage" data-toggle="modal" data-target="#modalForms" data-object-display="{{ $cottage->name }}" data-object-value="{{ $cottage->number }}"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar</a>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="{{ (Auth::user()->type === 'administrador' || Auth::user()->type === 'sysadmin') ? 7 : 6 }}" class="text-right">
                        <small class="text-muted">Las caba&ntilde;as se encuentran ordenadas por número.</small>
                    </td>
                </tr>
            </tfoot>
        </table>
        <div class="row justify-content-center">
            <div class="text-center">{{ $cottages->links('vendor.pagination.bootstrap-4') }}</div>
        </div>
@endsection
@include('backend.modals.modal-bulk-actions')