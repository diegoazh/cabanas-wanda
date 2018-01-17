<div id="bulkActions" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title"><i class="fa fa-bolt" aria-hidden="true"></i> Acciones masivas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="bg-info text-white rounded p-2">Habilitar/Deshabilitar</h4>
                            <hr>
                            {!! Form::open(['method' => 'post', 'action' => 'Administration\CottagesController@cottagesBulkActions', 'class' => 'form-inline']) !!}
                                <div class="form-group mr-2">
                                    {!! Form::label('enableAll', 'Habilitar todas las cabañas', ['class' => 'col-form-label']) !!}
                                    {!! Form::hidden('action', 'enable') !!}
                                </div>
                                {!! Form::submit('Habilitar', ['class' => 'btn btn-sm btn-outline-success cursorPointer']) !!}
                            {!! Form::close() !!}

                            {!! Form::open(['method' => 'post', 'action' => 'Administration\CottagesController@cottagesBulkActions', 'class' => 'form-inline']) !!}
                                <div class="form-group mr-2">
                                    {!! Form::label('disableAll', 'Deshabilitar todas las cabañas', ['class' => 'col-form-label']) !!}
                                    {!! Form::hidden('action', 'disable') !!}
                                </div>
                                {!! Form::submit('Deshabilitar', ['class' => 'btn btn-sm btn-outline-danger cursorPointer']) !!}
                            {!! Form::close() !!}
                            <h4 class="bg-info text-white rounded p-2">Operaciones</h4>
                            <hr>
                            {!! Form::open(['method' => 'post', 'action' => 'Administration\CottagesController@cottagesBulkActions']) !!}
                                <div class="form-group">
                                    {!! Form::label('cottagesNumbers', 'Selecione las cabañas', ['class' => 'col-form-label']) !!}
                                    {!! Form::select('cottages', [1 => 'Num 1', 2 => 'Num 2', 3 => 'Num 3', 4 => 'Num 4', 5 => 'Num 5', 6 => 'Num 6', 7 => 'Num 7', 8 => 'Num 8', 9 => 'Num 9', 10 => 'Num 10'], null, ['class' => 'form-control', 'multiple' => 'multiple', 'name' => 'cottages[]']) !!}
                                    <small class="text-muted">Recuerde que manteniendo presionado <kbd>Ctrl</kbd> o <kbd>Shift</kbd> puede seleccionar varias a la vez.</small>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="bulkState" class="cursorPointer">
                                        {!! Form::checkbox('bulkState', 'state', false, ['id' => 'bulkState']) !!} Estado de las cabaña
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="stateEnabled" class="cursorPointer">
                                        Habilitada {!! Form::radio('state', 'enabled', false, ['id' => 'stateEnabled']) !!}
                                    </label>
                                    <i class="fa fa-exchange" aria-hidden="true"></i>
                                    <label for="stateDisabled" class="cursorPointer">
                                        Deshabilitada {!! Form::radio('state', 'disabled', false, ['id' => 'stateDisabled']) !!}
                                    </label>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="bulkType" class="cursorPointer">
                                        {!! Form::checkbox('bulkType', 'type', false, ['id' => 'bulkType']) !!} Tipo de cabaña
                                    </label>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('typeCottages', 'Tipo de cabaña', ['class' => 'col-form-label sr-only']) !!}
                                    <div class="input-group">
                                        <div class="input-group-addon">Tipo</div>
                                        {!! Form::select('type', ['simple' => 'Simple', 'matrimonial' => 'Matrimonial'], 'simple', ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="bulkAccommodation" class="cursorPointer">
                                        {!! Form::checkbox('bulkAccommodation', 'accomodation', false, ['id' => 'bulkAccommodation']) !!} Capacidad de las cabañas
                                    </label>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('accommodationCottages', 'Capacidad de las cabañas', ['class' => 'col-form-label sr-only']) !!}
                                    <div class="input-group">
                                        <div class="input-group-addon">Capacidad</div>
                                        {!! Form::number('accommodationCottages', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la capacidad de las cabañas...']) !!}
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="bulkPrice" class="cursorPointer">
                                        {!! Form::checkbox('bulkPrice', 'price', false, ['id' => 'bulkPrice']) !!} Precio de las cabañas
                                    </label>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('priceCottages', 'Precio de las cabañas', ['class' => 'col-form-label sr-only']) !!}
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-dollar" aria-hidden="true"></i></div>
                                        {!! Form::number('priceCottages', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el precio de las cabañas...']) !!}
                                    </div>
                                </div>
                                {!! Form::submit('Realizar modificación masiva', ['class' => 'btn btn-outline-primary']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>