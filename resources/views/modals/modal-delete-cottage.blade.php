<!-- Modal -->
<div class="modal fade" id="modalDeleteCottage" tabindex="-1" role="dialog" aria-labelledby="modalDeleteCottageLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalDeleteCottageLabel">
                    &iquest; Está seguro que desea eliminar la cabaña <span class="label label-danger cottage-delete"></span> ?
                    <br>
                    <small class="text-danger">*Esto eliminará la cabaña de la base de datos.</small>
                </h4>
            </div>
            <div class="modal-body">
                {{ Form::open(['url' => 'admin/cottages/{id}', 'method' => 'DELETE', 'class' => 'form-inline', 'name' => 'delete_cottage_form', 'id' => 'delete_cottage_form']) }}
                    <div class="form-group">
                        {{ Form::label('cottage_id', 'Cabaña a eliminar:', ['class' => 'sr-only']) }}
                        <div class="input-group">
                            <div class="input-group-addon">Cabaña a eliminar</div>
                            {{ Form::number('cottage_id', null, ['class' => 'form-control disabled', 'require', 'disabled']) }}
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="submit_form" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>