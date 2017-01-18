@extends('backend.templates.layout')

@section('title', 'Registrar Cabaña')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3>Registrar Caba&ntilde;a</h3>
    </div>
    <div class="panel-body">
      {{ Form::open(['route' => 'cottages.store', 'method' => 'POST']) }}
        <div class="form-group">
          {{ Form::label('number', 'Numero de cabaña', ['class' => 'sr-only']) }}
          <div class="input-group">
            <div class="input-group-addon">Numero de Caba&ntilde;a</div>
            {{ Form::number('number', '', ['class' => 'form-control', 'min' => 1, 'max' => 10, 'placeholder' => 'Ingrese el número de la cabaña']) }}
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('name', 'Nombre de la cabaña', ['class' => 'sr-only']) }}
          <div class="input-group">
            <div class="input-group-addon">Nombre de la Caba&ntilde;a</div>
            {{ Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Por ejemplo A o Suit, etc. Máximo 10 caracteres.', 'maxlength' => 10]) }}
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('type', 'Tipo de cabaña', ['class' => 'sr-only']) }}
          <div class="input-group">
            <div class="input-group-addon">Tipo de Caba&ntilde;a</div>
            {{ Form::select('type', ['simple' => 'Simple', 'matrimonial' => 'Matrimonial'], null, ['placeholder' => 'Seleccione el tipo de cabaña', 'class' => 'form-control']) }}
          </div>
        </div>
      {{ Form::close() }}
    </div>
  </div>
@endsection