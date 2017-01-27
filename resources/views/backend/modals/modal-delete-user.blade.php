<!-- Modal -->
<div class="modal fade" id="modalDeleteUser" tabindex="-1" role="dialog" aria-labelledby="modalDeleteUserLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalDeleteUserLabel">
                    &iquest; Está seguro que desea eliminar el usuario <span class="label label-danger span-delete"></span> ?
                    <br>
                    <small class="text-danger">*Esto eliminará el usuario de la base de datos.</small>
                </h4>
            </div>
            <div class="modal-body">
                {{ Form::open(['url' => 'admin/users/{id}', 'method' => 'DELETE', 'class' => 'form-inline', 'name' => 'delete_user_form', 'id' => 'delete_user_form']) }}
                    <div class="form-group">
                        {{ Form::label('user_fullName', 'Eliminar usuario:', ['class' => 'sr-only']) }}
                        <div class="input-group">
                            <div class="input-group-addon">Eliminar usuario</div>
                            {{ Form::text('user_fullName', null, ['class' => 'form-control disabled', 'require', 'disabled']) }}
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" id="submit_form" class="btn btn-primary">
                    <i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar usuario
                </button>
            </div>
        </div>
    </div>
</div>