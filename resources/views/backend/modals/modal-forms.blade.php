<!-- Modal -->
<div class="modal fade" id="modalForms" tabindex="-1" role="dialog" aria-labelledby="modalFormsLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalFormsLabel">
                    &iquest;Title of modal <span class="label label-danger span-delete"></span>?
                    <br>
                    <small class="text-danger">*Text to info alert.</small>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                {{ Form::open(['url' => 'admin/subdir/{id}', 'method' => 'DELETE', 'class' => 'form-inline', 'name' => 'modalFormId', 'id' => 'modalFormId']) }}
                    <div class="form-group">
                        {{ Form::label('inputFormId', 'Generic label:', ['class' => 'sr-only']) }}
                        <div id="container_input" class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Generic label</div>
                            </div>
                            {{ Form::number('inputFormId', null, ['class' => 'form-control disabled', 'require', 'disabled']) }}
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="submit_form" class="btn btn-primary">Enviar</button>
            </div>
        </div>
    </div>
</div>