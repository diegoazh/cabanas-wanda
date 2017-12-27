@extends('templates.backend-layout')

@section('title')
    {{ (isset($cottage)) ? 'Editar caba&ntilde;a' : 'Registrar Caba&ntilde;a' }}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/selectize.bootstrap3.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/editor.md/css/editormd.css') }}">
@endsection

@section('content')
    <div class="card-header bg-dark text-light">
        <h3 class="tt-cottages">{{ (isset($cottage)) ? 'Editar caba&ntilde;a' : 'Registrar Caba&ntilde;a' }}</h3>
    </div>
    <div class="card-body form-panel">
        {{ Form::open(['route' => ((isset($cottage)) ? ['cottages.update', $cottage] : 'cottages.store'), 'method' => ((isset($cottage)) ? 'PUT' : 'POST'), 'files' => true, 'id' => (isset($cottage) ? 'frmUpdateCottage' : 'frmCreateCottage')]) }}
        <div class="form-group">
            {{ Form::label('number', 'Numero de cabaña', ['class' => 'sr-only']) }}
            <div class="input-group">
                <div class="input-group-addon">Numero de Caba&ntilde;a</div>
                {{ Form::number('number', (isset($cottage)) ? $cottage->number : null, ['id' => 'number', 'class' => 'form-control', 'min' => 1, 'max' => 10, 'placeholder' => 'Ingrese el número de la cabaña', (isset($cottage)) ? 'disabled' : 'required']) }}
            </div>
            <div class="help-info d-block">
                <i class="fa fa-question-circle help-icon cursorPointer" aria-hidden="true" role="button"></i>
                <small class="text-muted help-text">Es el número que tiene asignada la cabaña. Tenga en cuenta que una vez creada la cabaña este campo no podrá modificarse.</small>
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('name', 'Nombre de la cabaña', ['class' => 'sr-only']) }}
            <div class="input-group">
                <div class="input-group-addon">Nombre de la Caba&ntilde;a</div>
                {{ Form::text('name', (isset($cottage)) ? $cottage->name : null, ['class' => 'form-control', 'placeholder' => 'Por ejemplo A o Suit, etc. Máximo 10 caracteres.', 'maxlength' => 10, 'required']) }}
            </div>
            <div class="help-info d-block">
                <i class="fa fa-question-circle help-icon cursorPointer" aria-hidden="true" role="button"></i>
                <small class="text-muted help-text">El nombre ayudará en la URL de la cabaña, además ponerle un nombre ayuda en las busquedas por internet y es más intuitivo. Puede tener como máximo 10 caracteres.</small>
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('type', 'Tipo de cabaña', ['class' => 'sr-only']) }}
            <div class="input-group">
                <div class="input-group-addon">Tipo de Caba&ntilde;a</div>
                {{ Form::select('type', ['simple' => 'Simple', 'matrimonial' => 'Matrimonial'], (isset($cottage)) ? $cottage->type : null, ['placeholder' => ((isset($cottage)) ? null : 'Seleccione el tipo de cabaña'), 'class' => 'form-control', 'required']) }}
            </div>
            <div class="help-info d-block">
                <i class="fa fa-question-circle help-icon cursorPointer" aria-hidden="true" role="button"></i>
                <small class="text-muted help-text">El tipo de cabaña indica si es con cama matrimonial o todas individuales, no tiene relación con la capacidad de la misma.</small>
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('accommodation', 'Capacidad', ['class' => 'sr-only']) }}
            <div class="input-group">
                <div class="input-group-addon">Capacidad</div>
                {{ Form::number('accommodation', (isset($cottage)) ? $cottage->accommodation : null, ['placeholder' => 'Ingrese la capacidad de la cabaña', 'class' => 'form-control', 'min' => 1, 'max' => 6], 'required') }}
            </div>
            <div class="help-info d-block">
                <i class="fa fa-question-circle help-icon cursorPointer" aria-hidden="true" role="button"></i>
                <small class="text-muted help-text">Cantidad de personas que pueden habitar la cabaña. Esta configurado con un máximo de 6 personas.</small>
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('price', 'Precio $', ['class' => 'sr-only']) }}
            <div class="input-group">
                <div class="input-group-addon">Precio $</div>
                {{ Form::number('price', (isset($cottage)) ? $cottage->price : null, ['placeholder' => 'Determine el precio de la cabaña', 'class' => 'form-control', 'step' => 0.01], 'required') }}
            </div>
            <div class="help-info d-block">
                <i class="fa fa-question-circle help-icon cursorPointer" aria-hidden="true" role="button"></i>
                <small class="text-muted help-text">El precio de la cabaña es considerado por cabaña no por persona, vg. si se alquila una de 6 se cobra el precio de la cabaña así la habite una sola persona.</small>
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('state', 'Estado', ['class' => 'sr-only']) }}
            <div class="input-group">
                <div class="input-group-addon">Estado</div>
                {{ Form::select('state', ['enabled' => 'Habilitada', 'disabled' => 'Deshabilitada'], (isset($cottage)) ? $cottage->state : 'disabled', ['class' => 'form-control', 'required']) }}
            </div>
            <div class="help-info d-block">
                <i class="fa fa-question-circle help-icon cursorPointer" aria-hidden="true" role="button"></i>
                <small class="text-muted help-text">El estado de la cabaña, dependiendo de cual se configure aparecerá como disponible o no. Se configura por defecto en MANTENIMIENTO para evitar problemas con las reservas, dado que de otra forma aparecería automáticamente como disponible para reservarse y no simpre que se da de alta una nueva cabaña en el sistema necesariamente está lista para ser habitada.</small>
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('images[]', 'Fotos', ['class' => 'sr-only']) }}
            <div class="input-group">
                <div class="input-group-addon">Fotos</div>
                {{ Form::file('images[]', ['placeholder' => 'Elija las fotos a subir', 'class' => 'form-control', 'multiple', (!isset($cottage))?'required':'']) }}
            </div>
            <div class="help-info d-block">
                <i class="fa fa-question-circle help-icon cursorPointer" aria-hidden="true" role="button"></i>
                <small class="text-muted help-text">Se pueden agregar varias imagenes a la vez. Para seleccionar diferentes imagenes por separado mantegra presionado <kbd>Ctrl</kbd> + <kbd>clic izq</kbd>. Para seleccionar un conjunto mantenga presionado <kbd>Shift</kbd> + <kbd>clic izq</kbd> en la primera y en la ultima imagen del conjunto.</small>
            </div>
        </div>
        <div class="form-group">
            <button id="modal_description" class="btn btn-info btn-block" data-toggle="modal" data-target="#modalMD">A&ntilde;adir una descripci&oacute;n a la cabaña.</button>
            <div id="modalMD" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editorMarkDown">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Editor Markdown a HTML (Editor.md) <button id="clearTestContent" class="btn btn-outline-secondary btn-sm">Eliminar contenido de prueba</button></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div id="editormd">
                            <textarea id="description" name="description" style="display:none;">{{ (isset($cottage)) ? $cottage->description : $contents }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(!isset($cottage))
            <div class="form-group">
                {{ Form::label('create_other', '¿Registrar y crear nuevo?', ['role' => 'button']) }}
                {{ Form::checkbox('create_other', '1', false) }}
                <div class="help-info d-block">
                    <i class="fa fa-question-circle help-icon cursorPointer" aria-hidden="true" role="button"></i>
                    <small class="text-muted help-text">Si tilda esta opción volverá a esta página luego de registrar la cabaña.</small>
                </div>
            </div>
        @else
            {{ Form::hidden('actualImages', $cottage->images, ['id' => 'actualImages']) }}
            {{ Form::hidden('removedImages', null, ['id' => 'removedImages']) }}
        @endif
        <div class="text-center">
            @if(isset($cottage))
                {{ Form::submit('Actualizar cabaña', ['class' => 'btn btn-outline-success', 'id' => 'updateCottage']) }}
                <a href="{{ route('cottages.index') }}" class="btn btn-outline-warning btn-sm">Volver</a>
            @else
                {{ Form::reset('Limpiar formulario', ['class' => 'btn btn-outline-secondary']) }}
                {{ Form::submit('Registrar cabaña', ['class' => 'btn btn-outline-success', 'id' => 'createCottage']) }}
            @endif
        </div>
        {{ Form::close() }}
    </div>
@endsection

@section('optional')
    @if(isset($cottage))
        <div id="optional_content" class="col-md-4">
            <div class="card card-body">
                <h3 class="text-center tt-actual-images pl-3">
                    <span>Im&aacute;genes actuales</span>
                    <br>
                    <small class="text-right text-muted">Seleccione las im&aacute;genes que quiera eliminar.</small>
                </h3>
                @php $images = explode('|', $cottage->images); @endphp
                @for($i = 0; $i <= count($images) - 1;)
                    <div class="row cottage-images">
                        @for($j = 1; $j >= 0; $j--)
                            @if(!empty($images[$i]))
                                <div class="col-md-6">
                                    <img src="{{ asset('images/cabanias/' . $images[$i]) }}" alt="{{ $images[$i] }}" role="button" class="img-responsive img-thumbnail img-clickable">
                                </div>
                            @endif
                            @php $i++ @endphp
                        @endfor
                    </div>
                @endfor
                <div class="text-center">
                    <small class="text-danger">*Tenga en cuenta que las imágenes se eliminaran de forma física y de manera permanente</small>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    <script src="{{ asset('lib/editor.md/editormd.min.js') }}"></script>
    <script src="{{ asset('lib/editor.md/languages/en.js') }}"></script>
    <script>
        $(document).ready(function() {
            var editor;
            $('#type').selectize({
                create: false,
                placeholder: 'Seleccione el tipo de cabaña',
                preload: true,
                inputClass: 'form-control selectize-input',
                dropdownParent: 'body'
            });
            $('#state').selectize({
                create: false,
                placeholder: 'Seleccione el estado de la cabaña',
                preload: true,
                inputClass: 'form-control selectize-input',
                dropdownParent: 'body'
            });
            $('#modal_description').click(function (e) {
                e.preventDefault();
                $('.modal-lg').attr('style', 'max-width: 90%');
                $('.modal-content #editormd').animate({
                    height: '850px'
                }, 1000, 'swing', function () {
                    editor = editormd({
                     id      : 'editormd',
                     width   : "100%",
                     height  : '800px',
                     path    : "/lib/editor.md/lib/",
                     syncScrolling : true,
                     saveHTMLToTextarea : true
                     });
                    $('#clearTestContent').click(function (e) {
                        editor.clear();
                    })
                });
            });
            $('#updateCottage').click(function (e) {
                e.preventDefault();
                $('#number').removeAttr('disabled');
                $('#frmUpdateCottage').submit();
            });
        });
    </script>
@endsection