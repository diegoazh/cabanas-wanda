@extends('templates.frontend-layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/selectize.bootstrap3.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card my-5">
                <div class="card-header bg-secondary text-light h3"><i class="fa fa-envelope" aria-hidden="true"></i> Reenviar email de confirmación</div>
                <div class="card-body">
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

                        <div class="form-group row{{ $errors->has('name') ? ' has-warning' : '' }}">
                            <label for="name" class="col-md-4 col-col-form-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="form-text">
                                        <strong class="text-muted">{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('lastname') ? ' has-warning' : '' }}">
                            <label for="lastname" class="col-md-4 control-label">Apellido</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required autofocus>

                                @if ($errors->has('lastname'))
                                    <span class="form-text">
                                        <strong class="text-muted">{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('email') ? ' has-warning' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="form-text">
                                        <strong class="text-muted">{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <div class="col-12 col-md-6 text-center">
                                <button type="submit" class="btn btn-outline-primary">
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
