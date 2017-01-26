@extends('templates.backend-layout')
@section('content')
    @include('modals.modal-delete-cottage')
    <div class="panel">
        <h1 class="tt-cottages">Lista de Caba&ntilde;as</h1>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>N&uacute;mero</th>
                        <th>Nombre</th>
                        <th>Capacidad</th>
                        <th>Precio</th>
                        <th>Tipo</th>
                        <th>Acciones</th>
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
                            <i class="fa fa-usd" aria-hidden="true"></i> {{ $cottage->price }}
                        </td>
                        <td>
                            <span class="label @if($cottage->type === 'simple') label-primary @else label-success @endif">{{ $cottage->type }}</span>
                        </td>
                        <td>
                            <a href="{{ route('cottages.edit', $cottage) }}" role="button" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                            <a role="button" class="btn btn-danger btn-xs delete-cottage cottage-{{ $cottage->id }}_{{ $cottage->number }}" data-toggle="modal" data-target="#modalDeleteCottage"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6" class="text-right">
                            <small>Las caba&ntilde;as se encuentran ordenadas por número.</small>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <div class="text-center">{{ $cottages->render() }}</div>
        </div>
    </div>
@endsection