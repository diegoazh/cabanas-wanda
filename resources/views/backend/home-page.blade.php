@extends('templates.backend-layout')

@section('title', 'Configuraci&oacute;n p&aacute;gina principal')

@section('content')
    <div class="panel-heading">
        <h2>P&aacute;gina principal</h2>
    </div>
    <div class="panel-body">
        {{ Form::open(['url' => '']) }}
        <div class="form-group"><label for="tt-presentation" class="sr-only">Titulo presentación</label>
            <div class="input-group">
                <div class="input-group-addon">Título de presentación</div>
                {{ Form::textarea('tt-presentation', '', ['class' => 'form-control', 'placeholder' => 'Ingrese el titulo de presentación de la página principal...']) }}
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection