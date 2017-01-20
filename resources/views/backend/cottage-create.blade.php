@extends('backend.templates.layout')

@section('title', 'Registrar Cabaña')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3>Registrar Caba&ntilde;a</h3>
    </div>
    <div class="panel-body">
      @include('flash::message')
      @if(count($errors) > 0)
        <div class="alert alert-warning" role="alert">
          <ul>
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      {{ Form::open(['route' => 'cottages.store', 'method' => 'POST', 'files' => true]) }}
        <div class="form-group">
          {{ Form::label('number', 'Numero de cabaña', ['class' => 'sr-only']) }}
          <div class="input-group">
            <div class="input-group-addon">Numero de Caba&ntilde;a</div>
            {{ Form::number('number', '', ['class' => 'form-control', 'min' => 1, 'max' => 10, 'placeholder' => 'Ingrese el número de la cabaña', 'required']) }}
          </div>
          <small class="text-warning">Es el número que tiene asignada la cabaña.</small>
        </div>
        <div class="form-group">
          {{ Form::label('name', 'Nombre de la cabaña', ['class' => 'sr-only']) }}
          <div class="input-group">
            <div class="input-group-addon">Nombre de la Caba&ntilde;a</div>
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Por ejemplo A o Suit, etc. Máximo 10 caracteres.', 'maxlength' => 10, 'required']) }}
          </div>
          <small class="text-warning">El nombre ayudará en la URL de la cabaña, además ponerle un nombre ayuda en las busquedas por internet y es más intuitivo. Puede tener como máximo 10 caracteres.</small>
        </div>
        <div class="form-group">
          {{ Form::label('type', 'Tipo de cabaña', ['class' => 'sr-only']) }}
          <div class="input-group">
            <div class="input-group-addon">Tipo de Caba&ntilde;a</div>
            {{ Form::select('type', ['simple' => 'Simple', 'matrimonial' => 'Matrimonial'], null, ['placeholder' => 'Seleccione el tipo de cabaña', 'class' => 'form-control'], 'required') }}
          </div>
          <small class="text-warning">El tipo de cabaña indica si es con cama matrimonial o todas individuales, no tiene relación con la capacidad de la misma.</small>
        </div>
        <div class="form-group">
          {{ Form::label('accommodation', 'Capacidad', ['class' => 'sr-only']) }}
          <div class="input-group">
            <div class="input-group-addon">Capacidad</div>
            {{ Form::number('accommodation', null, ['placeholder' => 'Ingrese la capacidad de la cabaña', 'class' => 'form-control', 'min' => 1, 'max' => 6], 'required') }}
          </div>
          <small class="text-warning">Cantidad de personas que pueden habitar la cabaña. Esta configurado con un máximo de 6 personas.</small>
        </div>
        <div class="form-group">
          {{ Form::label('description', 'Descripci&oacute;n', ['class' => 'sr-only']) }}
          <div class="input-group">
            <div class="input-group-addon">Descripci&oacute;n</div>
            {{ Form::textarea('description', null, ['placeholder' => 'Agregue una descripción significativa, por ejemplo: con aire acondicionado, televisión, DirecTv, wifi, etc', 'class' => 'form-control', 'rows' => 9, 'maxlength' => 255], 'required') }}
          </div>
          <small class="text-warning">Una buena descripción es fundamental, recordar que como máximo tiene 255 caracteres, por lo cual es necesario ser conciso en la misma.</small>
        </div>
        <div class="form-group">
          {{ Form::label('price', 'Precio $', ['class' => 'sr-only']) }}
          <div class="input-group">
            <div class="input-group-addon">Precio $</div>
            {{ Form::number('price', null, ['placeholder' => 'Determine el precio de la cabaña', 'class' => 'form-control', 'step' => 0.01], 'required') }}
          </div>
          <small class="text-warning">El precio de la cabaña es considerado por cabaña no por persona, vg. si se alquila una de 6 se cobra el precio de la cabaña así la habite una sola persona.</small>
        </div>
        <div class="form-group">
          {{ Form::label('images[]', 'Fotos', ['class' => 'sr-only']) }}
          <div class="input-group">
            <div class="input-group-addon">Fotos</div>
            {{ Form::file('images[]', ['placeholder' => 'Elija las fotos a subir', 'class' => 'form-control', 'multiple', 'required']) }}
          </div>
          <small class="text-warning">El precio de la cabaña es considerado por cabaña no por persona, vg. si se alquila una de 6 se cobra el precio de la cabaña así la habite una sola persona.</small>
        </div>
        <div class="form-group">
          {{ Form::label('create_other', '¿Registrar y crear nuevo?') }}
          {{ Form::checkbox('create_other', '1') }}
        </div>
        <div class="text-center">
          {{ Form::reset('Limpiar formulario', ['class' => 'btn btn-default']) }}
          {{ Form::submit('Registrar cabaña', ['class' => 'btn btn-primary']) }}
        </div>
      {{ Form::close() }}
    </div>
  </div>
@endsection