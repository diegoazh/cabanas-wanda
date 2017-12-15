@extends('templates.frontend-layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/selectize.bootstrap3.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card mb-5">
                <div class="card-header bg-secondary text-light h3"><i class="fa fa-address-book" aria-hidden="true"></i> Registrarse como miembro</div>
                <div class="card-body">
                    @if(count($errors) > 0)
                        <div class="alert alert-warning" role="alert">
                            <ul>
                                @foreach($errors as $error)
                                    <li>$error</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group row{{ $errors->has('name') ? ' has-warning' : '' }}">
                            <label for="name" class="col-md-4 col-form-label">Nombre</label>

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
                            <label for="lastname" class="col-md-4 col-form-label">Apellido</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required autofocus>

                                @if ($errors->has('lastname'))
                                    <span class="form-text">
                                        <strong class="text-muted">{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('dni') ? ' has-warning' : '' }}">
                            <label for="dni" class="col-md-4 col-form-label">DNI</label>

                            <div class="col-md-6">
                                <input id="dni" type="text" class="form-control" name="dni" value="{{ old('dni') }}" required autofocus>

                                @if ($errors->has('dni'))
                                    <span class="form-text">
                                        <strong class="text-muted">{{ $errors->first('dni') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('passport') ? ' has-warning' : '' }}">
                            <label for="passport" class="col-md-4 col-form-label">Pasaporte <br><small class="text-info">Solo si es extranjero.</small></label>

                            <div class="col-md-6">
                                <input id="passport" type="text" class="form-control" name="passport" value="{{ old('passport') }}" autofocus>

                                @if ($errors->has('passport'))
                                    <span class="form-text">
                                        <strong class="text-muted">{{ $errors->first('passport') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('email') ? ' has-warning' : '' }}">
                            <label for="email" class="col-md-4 col-form-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="form-text">
                                        <strong class="text-muted">{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('genre') ? ' has-warning' : '' }}">
                            <label for="genre" class="col-md-4 col-form-label">Genero</label>

                            <div class="col-md-6">
                                <select id="genre" class="form-control" name="genre" value="{{ old('genre') }}" required>
                                    <option value="" disabled selected>Seleccione una opción</option>
                                    <option value="m">Masculino</option>
                                    <option value="f">Femenino</option>
                                    <option value="o">Otro</option>
                                </select>

                                @if ($errors->has('genre'))
                                    <span class="form-text">
                                        <strong class="text-muted">{{ $errors->first('genre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('country_id') ? ' has-warning' : '' }}">
                            <label for="country_id" class="col-md-4 col-form-label">País</label>

                            <div class="col-md-6">
                                <select id="country_id" type="country_id" class="form-control" name="country_id" required>
                                    <option value="" disabled selected>Seleccióne un país de la lista</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" @if(old('country') === $country->id) selected @endif>{{ $country->country }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('country_id'))
                                    <span class="form-text">
                                        <strong class="text-muted">{{ $errors->first('country_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('password') ? ' has-warning' : '' }}">
                            <label for="password" class="col-md-4 col-form-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="form-text">
                                        <strong class="text-muted">{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row justify-content-center mt-4">
                            <div class="col-12 col-md-6 text-center">
                                <button type="submit" class="btn btn-outline-primary">
                                    Registrarme
                                </button>
                            </div>
                        </div>
                    </form>
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
