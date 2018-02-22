@extends('templates.frontend-layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card my-5">
                <div class="card-header bg-secondary text-light h3">Cambiar contrase&ntilde;a</div>
                <div class="card-body">

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('home.password.reset') }}">
                        {{ csrf_field() }}

                        <div class="form-group row{{ $errors->has('password') ? ' has-warning' : '' }}">
                            <label for="password" class="col-md-4 col-form-label text-right"><i class="fa fa-lock"></i> Contrase&ntilde;a</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="form-text">
                                        <strong class="text-muted">{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('password') ? ' has-warning' : '' }}">
                            <label for="passwordNew" class="col-md-4 col-form-label text-right"><i class="fa fa-lock"></i>Nueva Contrase&ntilde;a</label>

                            <div class="col-md-6">
                                <input id="passwordNew" type="password" class="form-control" name="passwordNew" required>

                                @if ($errors->has('password'))
                                    <span class="form-text">
                                        <strong class="text-muted">{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('password_confirmation') ? ' has-warning' : '' }}">
                            <label for="password-confirm" class="col-md-4 col-form-label text-right"><i class="fa fa-lock"></i> Confirmar nueva contrase&ntilde;a</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="form-text">
                                        <strong class="text-muted">{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <div class="col-12 col-md-6 text-center">
                                <button type="submit" class="btn btn-outline-primary">
                                    Cambiar contrase&ntilde;a
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
