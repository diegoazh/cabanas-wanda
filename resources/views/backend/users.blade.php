@extends('templates.backend-layout')
@section('content')
    <h1>Usuarios registrados</h1>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">Nombre completo</th>
                <th scope="col">E-mail</th>
                <th scope="col">País</th>
                <th scope="col">Tipo</th>
            </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
            <tr>
                <td colspa="4"></td>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection