<div class="modal fade" tabindex="-1" role="dialog" id="modalEmailContact">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h3 class="modal-title"><i class="fa fa-envelope-open" aria-hidden="true"></i> Escribenos un e-mail</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-12">
                        {{ Form::open(['route' => 'home.front.userContact', 'method' => 'POST']) }}
                            <fieldset>
                                <legend class="text-secondary">Mail a la administración</legend>
                                <div class="alert alert-info alert-important">
                                    <h6><i class="fa fa-info-circle"></i> Los campos marcados con <sup class="text-danger"><b>*</b></sup> son obligatorios.</h6>
                                </div>
                                <div class="form-group form-row">
                                    <label for="name" class="col-form-label sr-only">Nombre completo:<sup class="text-danger"><b>*</b></sup></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Nombre completo<sup class="text-danger"><b>*</b></sup></span>
                                        </div>
                                        <input type="text" id="name" name="name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group form-row">
                                    <label for="email" class="col-form-label sr-only">Email:<sup class="text-danger"><b>*</b></sup></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Email<sup class="text-danger"><b>*</b></sup></span>
                                        </div>
                                        <input type="email" id="email" name="email" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group form-row">
                                    <label for="phone" class="col-form-label sr-only">Tel&eacute;fono:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Tel&eacute;fono</span>
                                        </div>
                                        <input type="number" id="phone" name="phone" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group form-row">
                                    <label for="subject" class="col-form-label sr-only">Asunto:<sup class="text-danger"><b>*</b></sup></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Asunto<sup class="text-danger"><b>*</b></sup></span>
                                        </div>
                                        <input type="text" id="subject" name="subject" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group form-row">
                                    <label for="content" class="col-form-label sr-only">Descripción:<sup class="text-danger"><b>*</b></sup></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Descripción<sup class="text-danger"><b>*</b></sup></span>
                                        </div>
                                        <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-12 text-center">
                                        <input type="reset" value="Limpiar contenido" class="btn btn-outline-secondary">
                                        <input type="submit" value="Enviar email" class="btn btn-outline-success">
                                    </div>
                                </div>
                            </fieldset>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            <div class="modal-footer  bg-dark text-light">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>