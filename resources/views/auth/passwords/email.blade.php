@extends('templates.frontend-layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card my-5">
                <div class="card-header bg-secondary text-light h3"><i class="fa fa-envelope" aria-hidden="true"></i> Resetear Contrase&ntilde;a</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

                        <div class="form-group row{{ $errors->has('email') ? ' has-warning' : '' }}">
                            <label for="email" class="col-md-4 col-form-label"><i class="fa fa-envelope" aria-hidden="true"></i> Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong class="text-muted">{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <div class="col-12 col-md-6 text-center">
                                <button type="submit" class="btn btn-outline-primary">
                                    Enviar link de reseteo
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
