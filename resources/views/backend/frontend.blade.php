@extends('templates.backend-layout')

@section('title', 'Configuraci&oacute;n p&aacute;gina principal')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/selectize.bootstrap3.css') }}">
@endsection

@section('content')
    <div class="card-header bg-dark text-light">
        <h2 class="pl-3"><i class="fa fa-gears" aria-hidden="true"></i> P&aacute;gina principal</h2>
    </div>
    <div class="card-body">
        {{ Form::open(['route' => (isset($front)) ? ['frontend.update', $front->id] : 'frontend.store', 'files' => true, 'method' => (isset($front)) ? 'PUT' : 'POST']) }}
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="nav-item"><a href="#welcome" aria-controls="welcome" role="tab" data-toggle="tab" class="nav-link active">Presentación</a></li>
                <li role="presentation" class="nav-item"><a href="#slogan1" aria-controls="slogan1" role="tab" data-toggle="tab" class="nav-link">Slogan 1</a></li>
                <li role="presentation" class="nav-item"><a href="#slogan2" aria-controls="slogan2" role="tab" data-toggle="tab" class="nav-link">Slogan 2</a></li>
                <li role="presentation" class="nav-item"><a href="#slogan3" aria-controls="slogan3" role="tab" data-toggle="tab" class="nav-link">Slogan 3</a></li>
                <li role="presentation" class="nav-item"><a href="#slogan4" aria-controls="slogan4" role="tab" data-toggle="tab" class="nav-link">Slogan 4</a></li>
                <li role="presentation" class="nav-item"><a href="#slogan5" aria-controls="slogan5" role="tab" data-toggle="tab" class="nav-link">Slogan 5</a></li>
                <li role="presentation" class="nav-item"><a href="#slogan6" aria-controls="slogan6" role="tab" data-toggle="tab" class="nav-link">Slogan 6</a></li>
                <li role="presentation" class="nav-item"><a href="#socialsnetworks" aria-controls="socialsnetworks" role="tab" data-toggle="tab" class="nav-link">Redes sociales</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade show active" id="welcome">
                    <br>
                    <div class="form-group">
                        <label for="imgs_header" class="sr-only">Imagenes de la cabecera</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><div class="input-group-text">Imagenes de la cabecera</div></div>
                            {{ Form::file('imgs_header[]', ['class' => 'form-control', 'id' => 'imgs_header', 'multiple' => 'multiple']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="remove_olds_imgs_header" role="button">
                            {{ Form::checkbox('remove_olds_imgs_header', true, false, ['id' => 'remove_olds_imgs_header']) }} ¿Desea eliminar las imagenes anteriores?
                        </label>
                        <small class="text-danger">Esto eliminará las imagenes de forma permanente.</small>
                    </div>
                    <div class="form-group"><label for="tt_presentation" class="sr-only">Titulo presentación</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><div class="input-group-text">Título de presentación</div></div>
                            {{ Form::text('tt_presentation', (isset($front->tt_presentation)) ? $front->tt_presentation : '', ['id' => 'tt_presentation', 'class' => 'form-control', 'placeholder' => 'Ingrese el titulo de presentación de la página principal...']) }}
                        </div>
                    </div>
                    <div class="form-group"><label for="msg_presentation" class="sr-only">Mensaje de presentación</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><div class="input-group-text">Mensaje de presentación</div></div>
                            {{ Form::textarea('msg_presentation', (isset($front->msg_presentation)) ? $front->msg_presentation : '', ['id' => 'msg_presentation', 'class' => 'form-control', 'placeholder' => 'Ingrese la descripción de la presentación en la página principal...']) }}
                        </div>
                    </div>
                    <div class="form-group"><label for="txt_btn_presentation" class="sr-only">Texto botón presentación</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><div class="input-group-text">Texto botón presentación</div></div>
                            {{ Form::text('txt_btn_presentation', (isset($front->txt_btn_presentation)) ? $front->txt_btn_presentation : '', ['id' => 'txt_btn_presentation', 'class' => 'form-control', 'placeholder' => 'Ingrese el texto del botón de la página principal...']) }}
                        </div>
                    </div>
                    <div class="form-group"><label for="lnk_btn_presentation" class="sr-only">Link del botón de presentación</label>
                        <div class="input-group" style="height: 38px">
                            <div class="input-group-prepend"><div class="input-group-text">Link del botón de presentación</div></div>
                            {{ Form::select('lnk_btn_presentation', [], (isset($front->lnk_btn_presentation)) ? $front->lnk_btn_presentation : null, ['id' => 'lnk_btn_presentation', 'class' => 'form-control', 'placeholder' => 'Seleccióne el link del boton de la página principal, también puede escribirlo...']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="show_testimonies" role="button">
                            {{ Form::checkbox('show_testimonies', true, (isset($front->show_testimonies)) ? $front->show_testimonies : false, ['id' => 'show_testimonies']) }} ¿Mostrar sección de testimonios?
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="show_slogans_456" role="button">
                            {{ Form::checkbox('show_slogans_456', true, (isset($front->show_slogans_456)) ? $front->show_slogans_456 : false, ['id' => 'show_slogans_456']) }} ¿Mostrar slogans 4, 5 y 6?
                        </label>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="slogan1">
                    <div class="text-right">
                        <span class="badge badge-warning">Slogan requerido</span>
                    </div>
                    <br>
                    <div class="form-group"><label for="tt_slogan_one" class="sr-only">Título slogan 1</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><div class="input-group-text">Título slogan 1</div></div>
                            {{ Form::text('tt_slogan_one', (isset($front->tt_slogan_one)) ? $front->tt_slogan_one : '', ['id' => 'tt_slogan_one', 'class' => 'form-control', 'placeholder' => 'Ingrese el titulo del slogan 1...']) }}
                        </div>
                    </div>
                    <div class="form-group"><label for="desc_slogan_one" class="sr-only">Descripción sologan 1</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><div class="input-group-text">Descripción sologan 1</div></div>
                            {{ Form::textarea('desc_slogan_one', (isset($front->desc_slogan_one)) ? $front->desc_slogan_one : '', ['id' => 'desc_slogan_one', 'class' => 'form-control', 'placeholder' => 'Ingrese la descripción del slogan 1...']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="img_slogan_one" class="sr-only">Imagen del slogan 1</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><div class="input-group-text">Imagen del slogan 1</div></div>
                            {{ Form::file('img_slogan_one', ['id' => 'img_slogan_one', 'class' => 'form-control', 'placeholder' => 'Ingrese la imágen del slogan 1...']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="remove_olds_slogan1" role="button">
                            {{ Form::checkbox('remove_olds_slogan1', true, false, ['id' => 'remove_olds_slogan1']) }} ¿Desea eliminar la im&aacute;gen anterior?
                        </label>
                        <small class="text-danger">Esto eliminará la imagen de forma permanente.</small>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="slogan2">
                    <div class="text-right">
                        <span class="badge badge-warning">Slogan requerido</span>
                    </div>
                    <br>
                    <div class="form-group"><label for="tt_slogan_two" class="sr-only">Título slogan 2</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><div class="input-group-text">Título slogan 2</div></div>
                            {{ Form::text('tt_slogan_two', (isset($front->tt_slogan_two)) ? $front->tt_slogan_two : '', ['id' => 'tt_slogan_two', 'class' => 'form-control', 'placeholder' => 'Ingrese el titulo del slogan 2...']) }}
                        </div>
                    </div>
                    <div class="form-group"><label for="desc_slogan_two" class="sr-only">Descripción sologan 2</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><div class="input-group-text">Descripción sologan 2</div></div>
                            {{ Form::textarea('desc_slogan_two', (isset($front->desc_slogan_two)) ? $front->desc_slogan_two : '', ['id' => 'desc_slogan_two', 'class' => 'form-control', 'placeholder' => 'Ingrese la descripción del slogan 2...']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="img_slogan_two" class="sr-only">Imagen del slogan 2</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><div class="input-group-text">Imagen del slogan 2</div></div>
                            {{ Form::file('img_slogan_two', ['id' => 'img_slogan_two', 'class' => 'form-control', 'placeholder' => 'Ingrese la imágen del slogan 2...']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="remove_olds_slogan2" role="button">
                            {{ Form::checkbox('remove_olds_slogan2', true, false, ['id' => 'remove_olds_slogan2']) }} ¿Desea eliminar la im&aacute;gen anterior?
                        </label>
                        <small class="text-danger">Esto eliminará la imagen de forma permanente.</small>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="slogan3">
                    <div class="text-right">
                        <span class="badge badge-warning">Slogan requerido</span>
                    </div>
                    <br>
                    <div class="form-group"><label for="tt_slogan_three" class="sr-only">Título slogan 3</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><div class="input-group-text">Título slogan 3</div></div>
                            {{ Form::text('tt_slogan_three', (isset($front->tt_slogan_three)) ? $front->tt_slogan_three : '', ['id' => 'tt_slogan_three', 'class' => 'form-control', 'placeholder' => 'Ingrese el titulo del slogan 3...']) }}
                        </div>
                    </div>
                    <div class="form-group"><label for="desc_slogan_three" class="sr-only">Descripción sologan 3</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><div class="input-group-text">Descripción sologan 3</div></div>
                            {{ Form::textarea('desc_slogan_three', (isset($front->desc_slogan_three)) ? $front->desc_slogan_three : '', ['id' => 'desc_slogan_three', 'class' => 'form-control', 'placeholder' => 'Ingrese la descripción del slogan 3...']) }}
                        </div>
                    </div>
                    <div class="form-group"><label for="img_slogan_three" class="sr-only">Imagen del slogan 3</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><div class="input-group-text">Imagen del slogan 3</div></div>
                            {{ Form::file('img_slogan_three', ['id' => 'img_slogan_three', 'class' => 'form-control', 'placeholder' => 'Ingrese la imágen del slogan 3...']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="remove_olds_slogan3" role="button">
                            {{ Form::checkbox('remove_olds_slogan3', true, false, ['id' => 'remove_olds_slogan3']) }} ¿Desea eliminar la im&aacute;gen anterior?
                        </label>
                        <small class="text-danger">Esto eliminará la imagen de forma permanente.</small>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="slogan4">
                    <div class="text-right">
                        <small class="badge badge-info">Slogan opcional</small>
                    </div>
                    <div class="form-group"><label for="tt_slogan_four" class="sr-only">Título slogan 4</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><div class="input-group-text">Título slogan 4</div></div>
                            {{ Form::text('tt_slogan_four', (isset($front->tt_slogan_four)) ? $front->tt_slogan_four : '', ['id' => 'tt_slogan_four', 'class' => 'form-control', 'placeholder' => 'Ingrese el titulo del slogan 4...']) }}
                        </div>
                    </div>
                    <div class="form-group"><label for="desc_slogan_four" class="sr-only">Descripción sologan 4</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><div class="input-group-text">Descripción sologan 4</div></div>
                            {{ Form::textarea('desc_slogan_four', (isset($front->desc_slogan_four)) ? $front->desc_slogan_four : '', ['id' => 'desc_slogan_four', 'class' => 'form-control', 'placeholder' => 'Ingrese la descripción del slogan 4...']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="img_slogan_four" class="sr-only">Imagen del slogan 4</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><div class="input-group-text">Imagen del slogan 4</div></div>
                            {{ Form::file('img_slogan_four', ['id' => 'img_slogan_four', 'class' => 'form-control', 'placeholder' => 'Ingrese la imágen del slogan 4...']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="remove_olds_slogan4" role="button">
                            {{ Form::checkbox('remove_olds_slogan4', true, false, ['id' => 'remove_olds_slogan4']) }} ¿Desea eliminar la im&aacute;gen anterior?
                        </label>
                        <small class="text-danger">Esto eliminará la imagen de forma permanente.</small>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="slogan5">
                    <div class="text-right">
                        <small class="badge badge-info">Slogan opcional</small>
                    </div>
                    <div class="form-group"><label for="tt_slogan_five" class="sr-only">Título slogan 5</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><div class="input-group-text">Título slogan 5</div></div>
                            {{ Form::text('tt_slogan_five', (isset($front->tt_slogan_five)) ? $front->tt_slogan_five : '', ['id' => 'tt_slogan_five', 'class' => 'form-control', 'placeholder' => 'Ingrese el titulo del slogan 5...']) }}
                        </div>
                    </div>
                    <div class="form-group"><label for="desc_slogan_five" class="sr-only">Descripción sologan 5</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><div class="input-group-text">Descripción sologan 5</div></div>
                            {{ Form::textarea('desc_slogan_five', (isset($front->desc_slogan_five)) ? $front->desc_slogan_five : '', ['id' => 'desc_slogan_five', 'class' => 'form-control', 'placeholder' => 'Ingrese la descripción del slogan 5...']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="img_slogan_five" class="sr-only">Imagen del slogan 5</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><div class="input-group-text">Imagen del slogan 5</div></div>
                            {{ Form::file('img_slogan_five', ['id' => 'img_slogan_five', 'class' => 'form-control', 'placeholder' => 'Ingrese la imágen del slogan 5...']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="remove_olds_slogan5" role="button">
                            {{ Form::checkbox('remove_olds_slogan5', true, false, ['id' => 'remove_olds_slogan5']) }} ¿Desea eliminar la im&aacute;gen anterior?
                        </label>
                        <small class="text-danger">Esto eliminará la imagen de forma permanente.</small>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="slogan6">
                    <div class="text-right">
                        <small class="badge badge-info">Slogan opcional</small>
                    </div>
                    <div class="form-group"><label for="tt_slogan_six" class="sr-only">Título slogan 6</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><div class="input-group-text">Título slogan 6</div></div>
                            {{ Form::text('tt_slogan_six', (isset($front->tt_slogan_six)) ? $front->tt_slogan_six : '', ['id' => 'tt_slogan_six', 'class' => 'form-control', 'placeholder' => 'Ingrese el titulo del slogan 6...']) }}
                        </div>
                    </div>
                    <div class="form-group"><label for="desc_slogan_six" class="sr-only">Descripción sologan 6</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><div class="input-group-text">Descripción sologan 6</div></div>
                            {{ Form::textarea('desc_slogan_six', (isset($front->desc_slogan_six)) ? $front->desc_slogan_six : '', ['id' => 'desc_slogan_six', 'class' => 'form-control', 'placeholder' => 'Ingrese la descripción del slogan 6...']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="img_slogan_six" class="sr-only">Imagen del slogan 6</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><div class="input-group-text">Imagen del slogan 6</div></div>
                            {{ Form::file('img_slogan_six', ['id' => 'img_slogan_six', 'class' => 'form-control', 'placeholder' => 'Ingrese la imágen del slogan 6...']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="remove_olds_slogan6" role="button">
                            {{ Form::checkbox('remove_olds_slogan6', true, false, ['id' => 'remove_olds_slogan6']) }} ¿Desea eliminar la im&aacute;gen anterior?
                        </label>
                        <small class="text-danger">Esto eliminará la imagen de forma permanente.</small>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="socialsnetworks">
                    <br>
                    <div class="form-group">
                        <label for="link_video" class="sr-only">Link v&iacute;deo pie de p&aacute;gina</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><div class="input-group-text">Link v&iacute;deo pie de p&aacute;gina</div></div>
                            {{ Form::text('link_video', (isset($front->link_video)) ? $front->link_video : null, ['class' => 'form-control', 'id' => 'link_video', 'placeholder' => 'Ingrese el link del v&iacute;deo en el pie de p&aacute;gina']) }}
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="show_facebook" role="button">
                            {{ Form::checkbox('show_facebook', true, (isset($front->show_facebook)) ? $front->show_facebook : false, ['id' => 'show_facebook']) }}
                            ¿Mostrar link a Facebook?
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="facebook" class="sr-only">Facebook</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><div class="input-group-text">Facebook</div></div>
                            {{ Form::text('facebook', (isset($front->facebook)) ? $front->facebook : null, ['class' => 'form-control', 'id' => 'facebook', 'placeholder' => 'Ingrese el link de la página de facebook']) }}
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="show_twitter" role="button">
                            {{ Form::checkbox('show_twitter', true, (isset($front->show_twitter)) ? $front->show_twitter : false, ['id' => 'show_twitter']) }}
                            ¿Mostrar link a Twitter?
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="twitter" class="sr-only">Twitter</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><div class="input-group-text">Twitter</div></div>
                            {{ Form::text('twitter', (isset($front->twitter)) ? : null, ['class' => 'form-control', 'id' => 'twitter', 'placeholder' => 'Ingrese el link de la página de twitter']) }}
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="show_instagram" role="button">
                            {{ Form::checkbox('show_instagram', true, (isset($front->show_instagram)) ? $front->show_instagram : false, ['id' => 'show_instagram']) }}
                            ¿Mostrar link a Instagram?
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="instagram" class="sr-only">Instagram</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><div class="input-group-text">Instagram</div></div>
                            {{ Form::text('instagram', (isset($front->instagram)) ? $front->instagram : null, ['class' => 'form-control', 'id' => 'instagram', 'placeholder' => 'Ingrese el link de la página de instagram']) }}
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="show_youtube" role="button">
                            {{ Form::checkbox('show_youtube', true, (isset($front->show_youtube)) ? $front->show_youtube : false, ['id' => 'show_youtube']) }}
                            ¿Mostrar link a YouTube?
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="youtube" class="sr-only">YouTube</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><div class="input-group-text">YouTube</div></div>
                            {{ Form::text('youtube', (isset($front->youtube)) ? $front->youtube : null, ['class' => 'form-control', 'id' => 'youtube', 'placeholder' => 'Ingrese el link de la página de youtube']) }}
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="show_googleplus" role="button">
                            {{ Form::checkbox('show_googleplus', true, (isset($front->show_googleplus)) ? $front->show_googleplus : false, ['id' => 'show_googleplus']) }}
                            ¿Mostrar link a Google Plus?
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="googleplus" class="sr-only">Google Plus</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><div class="input-group-text">Google Plus</div></div>
                            {{ Form::text('googleplus', (isset($front->googleplus)) ? $front->googleplus : null, ['class' => 'form-control', 'id' => 'googleplus', 'placeholder' => 'Ingrese el link de la página de googleplus']) }}
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-center">
                {{ Form::reset('Limpiar formulario', ['class' => 'btn btn-outline-warning btn-lg']) }}
                {{ Form::submit((isset($front)) ? 'Actualizar' : 'Guardar', ['class' => 'btn btn-outline-primary btn-lg']) }}
            </div>
        {{ Form::close() }}
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#lnk_btn_presentation').selectize({
                create: true,
                placeholder: 'Seleccióne el link del boton de la página principal, también puede escribirlo...',
                preload: true,
                inputClass: 'form-control selectize-input',
                dropdownParent: 'body'
            });
        });
    </script>
@endsection