<!-- Modal -->
<div class="modal fade" id="modalTypeUser" tabindex="-1" role="dialog" aria-labelledby="modalTypeUserLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalTypeUserLabel">
                    &iquest; Está seguro que desea modificar el rol de usuario ?
                    <br>
                    <small class="text-danger">*Esto dará mayor acceso al sistema dependiendo el rol que elija.</small>
                </h4>
            </div>
            <div class="modal-body">
                {{ Form::open(['url' => 'admin/users/{id}', 'method' => 'PUT', 'class' => 'form-inline', 'name' => 'edit_type_user_form', 'id' => 'edit_type_user_form']) }}
                    <div class="form-group">
                        {{ Form::label('user_type', 'Rol del usuario:', ['class' => 'sr-only']) }}
                        <div class="input-group">
                            <div class="input-group-addon">Rol del usuario</div>
                            {{ Form::select('user_type', ['frecuente' => 'Frecuente', 'empleado' => 'Empleado', 'administrador' => 'Administrador', 'sysadmin' => 'Sysadmin'], null, ['class' => 'form-control', 'require']) }}
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" id="submit_form" class="btn btn-primary"><i class="fa fa-exchange" aria-hidden="true"></i> Cambiar rol</button>
            </div>
        </div>
    </div>
</div>