@extends('templates.backend-layout')
@section('content')
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
                            <i class="fa fa-hashtag" aria-hidden="true"></i> {{ $cottage->number }}
                        </td>
                        <td>{{ $cottage->name }}</td>
                        <td>
                            <span class="label @if($cottage->accommodation < 3) label-default @else label-primary @endif">{{ $cottage->accommodation }}</span>
                        </td>
                        <td>
                            <i class="fa fa-usd" aria-hidden="true"></i> {{ $cottage->price }}
                        </td>
                        <td>
                            <span class="label @if($cottage->type === 'simple') label-info @else label-danger @endif">{{ $cottage->type }}</span>
                        </td>
                        <td></td>
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