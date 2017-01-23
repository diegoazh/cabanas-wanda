@extends('templates.backend-layout')
@section('content')
    <h1>Usuarios registrados</h1>
    <div class="panel">
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
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->displayName() }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->country->abbreviation }}</td>
                        <td><span class="label @if($user->type === 'administrador' || $user->type === 'sysadmin') label-primary @elseif($user->type === 'frecuente') label-info @elseif($user->type === 'empleado') label-default @endif">{{ $user->type }}</span></td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="4" class="text-left"><small>Usuarios ordenados por fecha de registro del más reciente al más antiguo.</small></td>
                </tr>
                </tfoot>
            </table>
            <div class="text-center">{{ $users->render() }}</div>
        </div>
    </div>
@endsection