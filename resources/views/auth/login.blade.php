@extends('templates.frontend-layout')

@section('styles')
    <style>
        #arrows_div, #alerts_errors_messages {
            background-color: rgb(249,249,249);
        }
        #content {
            margin-right: -15px;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card my-5">
                <div class="card-header bg-secondary h3 text-light"><i class="fas fa-id-card" aria-hidden="true"></i> Ingreso de miembros</div>
                <div class="card-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group row{{ $errors->has('email') ? ' has-warning' : '' }}">
                            <label for="email" class="col-md-4 col-form-label text-right">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="form-text">
                                        <strong class="text-muted">{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('password') ? ' has-warning' : '' }}">
                            <label for="password" class="col-md-4 col-form-label text-right">Contrase&ntilde;a</label>

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
                            <div class="col-md-6 offset-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Recordarme
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <div class="col-12 col-md-8 text-center">
                                <button type="submit" class="btn btn-outline-primary">
                                    Ingresar
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Recuperar contrase&ntilde;a
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
