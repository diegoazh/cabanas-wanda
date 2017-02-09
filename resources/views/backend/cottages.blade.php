@extends('templates.backend-layout')

@section('title', 'Listado de Cabañas')

@section('content')
    @include('backend.modals.modal-forms')
    <h1 class="tt-cottages">Lista de Caba&ntilde;as</h1>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
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
                <tr>
                    <td>
                        <span class="label label-default"><i class="fa fa-hashtag" aria-hidden="true"></i> {{ $cottage->number }}</span>
                    </td>
                    <td><a class="btn btn-link" href="{{ route('cottages.show', $cottage->slug) }}">{{ strtoupper($cottage->name) }}</a></td>
                    <td>
                        {{ $cottage->accommodation }} <i class="glyphicon glyphicon-user"></i>
                    </td>
                    <td>
                        <span class="label @if($cottage->state === 'libre') label-success @elseif($cottage->state === 'reservada') label-warning @elseif($cottage->state === 'ocupada') label-primary @elseif($cottage->state === 'mantenimiento') label-default @else label-danger @endif">{{ $cottage->state }}</span>
                    </td>
                    <td>
                        <i class="fa fa-usd" aria-hidden="true"></i> {{ $cottage->price }}
                    </td>
                    <td>
                        <span class="label @if($cottage->type === 'simple') label-primary @else label-success @endif">{{ $cottage->type }}</span>
                    </td>
                    @if(Auth::user()->type === 'administrador' || Auth::user()->type === 'sysadmin')
                        <td>
                            <a href="{{ route('cottages.edit', $cottage) }}" role="button" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                            <a role="button" class="btn btn-danger btn-xs delete-cottage {{ $cottage->name }}-{{ $cottage->number }}-{{ $cottage->id }}" data-toggle="modal" data-target="#modalForms"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar</a>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="{{ (Auth::user()->type === 'administrador' || Auth::user()->type === 'sysadmin') ? 6 : 5 }}" class="text-right">
                        <small>Las caba&ntilde;as se encuentran ordenadas por número.</small>
                    </td>
                </tr>
            </tfoot>
        </table>
        <div class="text-center">{{ $cottages->render() }}</div>
    </div>
@endsection