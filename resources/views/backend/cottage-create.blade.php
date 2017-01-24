@extends('templates.backend-layout')

@section('title', 'Registrar Cabaña')

@section('content')
  <div class="panel panel-default form-panel">
    <div class="panel-heading">
      <h3 class="tt-cottages">Registrar Caba&ntilde;a</h3>
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
          <div class="help-info">
            <i class="fa fa-question-circle help-icon" aria-hidden="true" role="button"></i>
            <small class="text-warning help-text">Es el número que tiene asignada la cabaña.</small>
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('name', 'Nombre de la cabaña', ['class' => 'sr-only']) }}
          <div class="input-group">
            <div class="input-group-addon">Nombre de la Caba&ntilde;a</div>
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Por ejemplo A o Suit, etc. Máximo 10 caracteres.', 'maxlength' => 10, 'required']) }}
          </div>
          <div class="help-info">
            <i class="fa fa-question-circle help-icon" aria-hidden="true" role="button"></i>
            <small class="text-warning help-text">El nombre ayudará en la URL de la cabaña, además ponerle un nombre ayuda en las busquedas por internet y es más intuitivo. Puede tener como máximo 10 caracteres.</small>
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('type', 'Tipo de cabaña', ['class' => 'sr-only']) }}
          <div class="input-group">
            <div class="input-group-addon">Tipo de Caba&ntilde;a</div>
            {{ Form::select('type', ['simple' => 'Simple', 'matrimonial' => 'Matrimonial'], null, ['placeholder' => 'Seleccione el tipo de cabaña', 'class' => 'form-control'], 'required') }}
          </div>
          <div class="help-info">
            <i class="fa fa-question-circle help-icon" aria-hidden="true" role="button"></i>
            <small class="text-warning help-text">El tipo de cabaña indica si es con cama matrimonial o todas individuales, no tiene relación con la capacidad de la misma.</small>
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('accommodation', 'Capacidad', ['class' => 'sr-only']) }}
          <div class="input-group">
            <div class="input-group-addon">Capacidad</div>
            {{ Form::number('accommodation', null, ['placeholder' => 'Ingrese la capacidad de la cabaña', 'class' => 'form-control', 'min' => 1, 'max' => 6], 'required') }}
          </div>
          <div class="help-info">
            <i class="fa fa-question-circle help-icon" aria-hidden="true" role="button"></i>
            <small class="text-warning help-text">Cantidad de personas que pueden habitar la cabaña. Esta configurado con un máximo de 6 personas.</small>
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('description', 'Descripci&oacute;n', ['class' => 'sr-only']) }}
          <div class="input-group">
            <div class="input-group-addon">Descripci&oacute;n</div>
            {{ Form::textarea('description', null, ['placeholder' => 'Agregue una descripción significativa, por ejemplo: con aire acondicionado, televisión, DirecTv, wifi, etc', 'class' => 'form-control', 'rows' => 9, 'maxlength' => 255], 'required') }}
          </div>
          <div class="help-info">
            <i class="fa fa-question-circle help-icon" aria-hidden="true" role="button"></i>
            <small class="text-warning help-text">Una buena descripción es fundamental, recordar que como máximo tiene 255 caracteres, por lo cual es necesario ser conciso en la misma.</small>
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('price', 'Precio $', ['class' => 'sr-only']) }}
          <div class="input-group">
            <div class="input-group-addon">Precio $</div>
            {{ Form::number('price', null, ['placeholder' => 'Determine el precio de la cabaña', 'class' => 'form-control', 'step' => 0.01], 'required') }}
          </div>
          <div class="help-info">
            <i class="fa fa-question-circle help-icon" aria-hidden="true" role="button"></i>
            <small class="text-warning help-text">El precio de la cabaña es considerado por cabaña no por persona, vg. si se alquila una de 6 se cobra el precio de la cabaña así la habite una sola persona.</small>
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('images[]', 'Fotos', ['class' => 'sr-only']) }}
          <div class="input-group">
            <div class="input-group-addon">Fotos</div>
            {{ Form::file('images[]', ['placeholder' => 'Elija las fotos a subir', 'class' => 'form-control', 'multiple', 'required']) }}
          </div>
          <div class="help-info">
            <i class="fa fa-question-circle help-icon" aria-hidden="true" role="button"></i>
            <small class="text-warning help-text">Se pueden agregar varias imagenes a la vez. Para seleccionar diferentes imagenes por separado mantegra presionado <kbd>Ctrl</kbd> + <kbd>clic izq</kbd>. Para seleccionar un conjunto mantenga presionado <kbd>Shift</kbd> + <kbd>clic izq</kbd> en la primera y en la ultima imagen del conjunto.</small>
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('create_other', '¿Registrar y crear nuevo?') }}
          {{ Form::checkbox('create_other', '1') }}
          <div class="help-info">
            <i class="fa fa-question-circle help-icon" aria-hidden="true" role="button"></i>
            <small class="text-warning help-text">Si tilda esta opción volverá a esta página luego de registrar la cabaña.</small>
          </div>
        </div>
        <div class="text-center">
          {{ Form::reset('Limpiar formulario', ['class' => 'btn btn-default']) }}
          {{ Form::submit('Registrar cabaña', ['class' => 'btn btn-primary']) }}
        </div>
      {{ Form::close() }}
    </div>
  </div>
@endsection