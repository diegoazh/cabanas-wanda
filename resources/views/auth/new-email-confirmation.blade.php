@extends('templates.frontend-layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/selectize.bootstrap3.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reenviar email de confirmación</div>
                <div class="panel-body">
                    @if(count($errors) > 0)
                        <div class="alert alert-warning">
                            <ul>
                                @foreach($errors as $error)
                                    <li>$error</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {!! Form::open(['method' => 'post', 'route' => 'home.register.sendNewEmail', 'class' => 'form-horizontal']) !!}
                        {{ csrf_field() }}

                        <p class="text-center">Por favor ingrese los datos con los que se registró previamente.</p>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            <label for="lastname" class="col-md-4 control-label">Apellido</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required autofocus>

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Reenviar email <i class="fa fa-envelope" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#genre').selectize({
                create: false,
                placeholder: 'Seleccione una opción',
                preload: true
            });
            $('#country_id').selectize({
                create: false,
                placeholder: 'Seleccióne un país de la lista',
                preload: true
            })
        });
    </script>
@endsection
