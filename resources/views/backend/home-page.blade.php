@extends('templates.backend-layout')

@section('title', 'Configuraci&oacute;n p&aacute;gina principal')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/selectize.bootstrap3.css') }}">
@endsection

@section('content')
    <div class="panel-heading">
        <h2>P&aacute;gina principal</h2>
    </div>
    <div class="panel-body">
        {{ Form::open(['route' => 'frontend.store', 'files' => true, 'method' => 'POST']) }}
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#welcome" aria-controls="welcome" role="tab" data-toggle="tab">Presentación</a></li>
                <li role="presentation"><a href="#slogan1" aria-controls="slogan1" role="tab" data-toggle="tab">Slogan 1</a></li>
                <li role="presentation"><a href="#slogan2" aria-controls="slogan2" role="tab" data-toggle="tab">Slogan 2</a></li>
                <li role="presentation"><a href="#slogan3" aria-controls="slogan3" role="tab" data-toggle="tab">Slogan 3</a></li>
                <li role="presentation"><a href="#slogan4" aria-controls="slogan4" role="tab" data-toggle="tab">Slogan 4</a></li>
                <li role="presentation"><a href="#slogan5" aria-controls="slogan5" role="tab" data-toggle="tab">Slogan 5</a></li>
                <li role="presentation"><a href="#slogan6" aria-controls="slogan6" role="tab" data-toggle="tab">Slogan 6</a></li>
                <li role="presentation"><a href="#socialsnetworks" aria-controls="socialsnetworks" role="tab" data-toggle="tab">Redes sociales</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="welcome">
                    <br>
                    <div class="form-group">
                        <label for="imgs_header" class="sr-only">Imagenes de la cabecera</label>
                        <div class="input-group">
                            <div class="input-group-addon">Imagenes de la cabecera</div>
                            {{ Form::file('imgs_header', ['class' => 'form-control', 'id' => 'imgs_header', 'multiple' => true]) }}
                        </div>
                    </div>
                    <div class="form-group"><label for="tt_presentation" class="sr-only">Titulo presentación</label>
                        <div class="input-group">
                            <div class="input-group-addon">Título de presentación</div>
                            {{ Form::text('tt_presentation', '', ['id' => 'tt_presentation', 'class' => 'form-control', 'placeholder' => 'Ingrese el titulo de presentación de la página principal...']) }}
                        </div>
                    </div>
                    <div class="form-group"><label for="msg_presentation" class="sr-only">Mensaje de presentación</label>
                        <div class="input-group">
                            <div class="input-group-addon">Mensaje de presentación</div>
                            {{ Form::textarea('msg_presentation', '', ['id' => 'msg_presentation', 'class' => 'form-control', 'placeholder' => 'Ingrese la descripción de la presentación en la página principal...']) }}
                        </div>
                    </div>
                    <div class="form-group"><label for="txt_btn_presentation" class="sr-only">Texto botón presentación</label>
                        <div class="input-group">
                            <div class="input-group-addon">Texto botón presentación</div>
                            {{ Form::text('txt_btn_presentation', '', ['id' => 'txt_btn_presentation', 'class' => 'form-control', 'placeholder' => 'Ingrese el texto del botón de la página principal...']) }}
                        </div>
                    </div>
                    <div class="form-group"><label for="lnk_btn_presentation" class="sr-only">Link del botón de presentación</label>
                        <div class="input-group">
                            <div class="input-group-addon">Link del botón de presentación</div>
                            {{ Form::select('lnk_btn_presentation', [], null, ['id' => 'lnk_btn_presentation', 'class' => 'form-control', 'placeholder' => 'Seleccióne el link del boton de la página principal, también puede escribirlo...']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="show_testimonies" role="button">
                            {{ Form::checkbox('show_testimonies', true, false, ['id' => 'show_testimonies']) }} ¿Mostrar sección de testimonios?
                        </label>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="slogan1">
                    <div class="text-right">
                        <span class="label label-warning">Slogan requerido</span>
                    </div>
                    <br>
                    <div class="form-group"><label for="tt_slogan_one" class="sr-only">Título slogan 1</label>
                        <div class="input-group">
                            <div class="input-group-addon">Título slogan 1</div>
                            {{ Form::text('tt_slogan_one', '', ['id' => 'tt_slogan_one', 'class' => 'form-control', 'placeholder' => 'Ingrese el titulo del slogan 1...']) }}
                        </div>
                    </div>
                    <div class="form-group"><label for="desc_slogan_one" class="sr-only">Descripción sologan 1</label>
                        <div class="input-group">
                            <div class="input-group-addon">Descripción sologan 1</div>
                            {{ Form::textarea('desc_slogan_one', '', ['id' => 'desc_slogan_one', 'class' => 'form-control', 'placeholder' => 'Ingrese la descripción del slogan 1...']) }}
                        </div>
                    </div>
                    <div class="form-group"><label for="img_slogan_one" class="sr-only">Imagen del slogan 1</label>
                        <div class="input-group">
                            <div class="input-group-addon">Imagen del slogan 1</div>
                            {{ Form::file('img_slogan_one', ['id' => 'img_slogan_one', 'class' => 'form-control', 'placeholder' => 'Ingrese la imágen del slogan 1...']) }}
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="slogan2">
                    <div class="text-right">
                        <span class="label label-warning">Slogan requerido</span>
                    </div>
                    <br>
                    <div class="form-group"><label for="tt_slogan_two" class="sr-only">Título slogan 2</label>
                        <div class="input-group">
                            <div class="input-group-addon">Título slogan 2</div>
                            {{ Form::text('tt_slogan_two', '', ['id' => 'tt_slogan_two', 'class' => 'form-control', 'placeholder' => 'Ingrese el titulo del slogan 2...']) }}
                        </div>
                    </div>
                    <div class="form-group"><label for="desc_slogan_two" class="sr-only">Descripción sologan 2</label>
                        <div class="input-group">
                            <div class="input-group-addon">Descripción sologan 2</div>
                            {{ Form::textarea('desc_slogan_two', '', ['id' => 'desc_slogan_two', 'class' => 'form-control', 'placeholder' => 'Ingrese la descripción del slogan 2...']) }}
                        </div>
                    </div>
                    <div class="form-group"><label for="img_slogan_two" class="sr-only">Imagen del slogan 2</label>
                        <div class="input-group">
                            <div class="input-group-addon">Imagen del slogan 2</div>
                            {{ Form::file('img_slogan_two', ['id' => 'img_slogan_two', 'class' => 'form-control', 'placeholder' => 'Ingrese la imágen del slogan 2...']) }}
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="slogan3">
                    <div class="text-right">
                        <span class="label label-warning">Slogan requerido</span>
                    </div>
                    <br>
                    <div class="form-group"><label for="tt_slogan_three" class="sr-only">Título slogan 3</label>
                        <div class="input-group">
                            <div class="input-group-addon">Título slogan 3</div>
                            {{ Form::text('tt_slogan_three', '', ['id' => 'tt_slogan_three', 'class' => 'form-control', 'placeholder' => 'Ingrese el titulo del slogan 3...']) }}
                        </div>
                    </div>
                    <div class="form-group"><label for="desc_slogan_three" class="sr-only">Descripción sologan 3</label>
                        <div class="input-group">
                            <div class="input-group-addon">Descripción sologan 3</div>
                            {{ Form::textarea('desc_slogan_three', '', ['id' => 'desc_slogan_three', 'class' => 'form-control', 'placeholder' => 'Ingrese la descripción del slogan 3...']) }}
                        </div>
                    </div>
                    <div class="form-group"><label for="img_slogan_three" class="sr-only">Imagen del slogan 3</label>
                        <div class="input-group">
                            <div class="input-group-addon">Imagen del slogan 3</div>
                            {{ Form::file('img_slogan_three', ['id' => 'img_slogan_three', 'class' => 'form-control', 'placeholder' => 'Ingrese la imágen del slogan 3...']) }}
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="slogan4">
                    <div class="text-right">
                        <span class="label label-info">Slogan opcional</span>
                    </div>
                    <div class="form-group">
                        <label for="show_slogan_four" role="button">
                            {{ Form::checkbox('show_slogan_four', true, false, ['id' => 'show_slogan_four']) }} ¿Mostrar slogan 4?
                        </label>
                    </div>
                    <div class="form-group"><label for="tt_slogan_four" class="sr-only">Título slogan 4</label>
                        <div class="input-group">
                            <div class="input-group-addon">Título slogan 4</div>
                            {{ Form::text('tt_slogan_four', '', ['id' => 'tt_slogan_four', 'class' => 'form-control', 'placeholder' => 'Ingrese el titulo del slogan 4...']) }}
                        </div>
                    </div>
                    <div class="form-group"><label for="desc_slogan_four" class="sr-only">Descripción sologan 4</label>
                        <div class="input-group">
                            <div class="input-group-addon">Descripción sologan 4</div>
                            {{ Form::textarea('desc_slogan_four', '', ['id' => 'desc_slogan_four', 'class' => 'form-control', 'placeholder' => 'Ingrese la descripción del slogan 4...']) }}
                        </div>
                    </div>
                    <div class="form-group"><label for="img_slogan_four" class="sr-only">Imagen del slogan 4</label>
                        <div class="input-group">
                            <div class="input-group-addon">Imagen del slogan 4</div>
                            {{ Form::file('img_slogan_four', ['id' => 'img_slogan_four', 'class' => 'form-control', 'placeholder' => 'Ingrese la imágen del slogan 4...']) }}
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="slogan5">
                    <div class="text-right">
                        <span class="label label-info">Slogan opcional</span>
                    </div>
                    <div class="form-group">
                        <label for="show_slogan_five" role="button">
                            {{ Form::checkbox('show_slogan_five', true, false, ['id' => 'show_slogan_five']) }} ¿Mostrar slogan 5?
                        </label>
                    </div>
                    <div class="form-group"><label for="tt_slogan_five" class="sr-only">Título slogan 5</label>
                        <div class="input-group">
                            <div class="input-group-addon">Título slogan 5</div>
                            {{ Form::text('tt_slogan_five', '', ['id' => 'tt_slogan_five', 'class' => 'form-control', 'placeholder' => 'Ingrese el titulo del slogan 5...']) }}
                        </div>
                    </div>
                    <div class="form-group"><label for="desc_slogan_five" class="sr-only">Descripción sologan 5</label>
                        <div class="input-group">
                            <div class="input-group-addon">Descripción sologan 5</div>
                            {{ Form::textarea('desc_slogan_five', '', ['id' => 'desc_slogan_five', 'class' => 'form-control', 'placeholder' => 'Ingrese la descripción del slogan 5...']) }}
                        </div>
                    </div>
                    <div class="form-group"><label for="img_slogan_five" class="sr-only">Imagen del slogan 5</label>
                        <div class="input-group">
                            <div class="input-group-addon">Imagen del slogan 5</div>
                            {{ Form::file('img_slogan_five', ['id' => 'img_slogan_five', 'class' => 'form-control', 'placeholder' => 'Ingrese la imágen del slogan 5...']) }}
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="slogan6">
                    <div class="text-right">
                        <span class="label label-info">Slogan opcional</span>
                    </div>
                    <div class="form-group">
                        <label for="show_slogan_six" role="button">
                            {{ Form::checkbox('show_slogan_six', true, false, ['id' => 'show_slogan_six']) }} ¿Mostrar slogan 6?
                        </label>
                    </div>
                    <div class="form-group"><label for="tt_slogan_six" class="sr-only">Título slogan 6</label>
                        <div class="input-group">
                            <div class="input-group-addon">Título slogan 6</div>
                            {{ Form::text('tt_slogan_six', '', ['id' => 'tt_slogan_six', 'class' => 'form-control', 'placeholder' => 'Ingrese el titulo del slogan 6...']) }}
                        </div>
                    </div>
                    <div class="form-group"><label for="desc_slogan_six" class="sr-only">Descripción sologan 6</label>
                        <div class="input-group">
                            <div class="input-group-addon">Descripción sologan 6</div>
                            {{ Form::textarea('desc_slogan_six', '', ['id' => 'desc_slogan_six', 'class' => 'form-control', 'placeholder' => 'Ingrese la descripción del slogan 6...']) }}
                        </div>
                    </div>
                    <div class="form-group"><label for="img_slogan_six" class="sr-only">Imagen del slogan 6</label>
                        <div class="input-group">
                            <div class="input-group-addon">Imagen del slogan 6</div>
                            {{ Form::file('img_slogan_six', ['id' => 'img_slogan_six', 'class' => 'form-control', 'placeholder' => 'Ingrese la imágen del slogan 6...']) }}
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="socialsnetworks">
                    <br>
                    <div class="form-group">
                        <label for="show_facebook" role="button">
                            {{ Form::checkbox('show_facebook', true, false) }}
                            ¿Mostrar link a Facebook?
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="facebook" class="sr-only">Facebook</label>
                        <div class="input-group">
                            <div class="input-group-addon">Facebook</div>
                            {{ Form::text('facebook', null, ['class' => 'form-control', 'id' => 'facebook', 'placeholder' => 'Ingrese el link de la página de facebook']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="show_twitter" role="button">
                            {{ Form::checkbox('show_twitter', true, false) }}
                            ¿Mostrar link a Twitter?
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="twitter" class="sr-only">Twitter</label>
                        <div class="input-group">
                            <div class="input-group-addon">Twitter</div>
                            {{ Form::text('twitter', null, ['class' => 'form-control', 'id' => 'twitter', 'placeholder' => 'Ingrese el link de la página de twitter']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="show_instagram" role="button">
                            {{ Form::checkbox('show_instagram', true, false) }}
                            ¿Mostrar link a Instagram?
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="instagram" class="sr-only">Instagram</label>
                        <div class="input-group">
                            <div class="input-group-addon">Instagram</div>
                            {{ Form::text('instagram', null, ['class' => 'form-control', 'id' => 'instagram', 'placeholder' => 'Ingrese el link de la página de instagram']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="show_youtube" role="button">
                            {{ Form::checkbox('show_youtube', true, false) }}
                            ¿Mostrar link a YouTube?
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="youtube" class="sr-only">YouTube</label>
                        <div class="input-group">
                            <div class="input-group-addon">YouTube</div>
                            {{ Form::text('youtube', null, ['class' => 'form-control', 'id' => 'youtube', 'placeholder' => 'Ingrese el link de la página de youtube']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="show_googleplus" role="button">
                            {{ Form::checkbox('show_googleplus', true, false) }}
                            ¿Mostrar link a Google Plus?
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="googleplus" class="sr-only">Google Plus</label>
                        <div class="input-group">
                            <div class="input-group-addon">Google Plus</div>
                            {{ Form::text('googleplus', null, ['class' => 'form-control', 'id' => 'googleplus', 'placeholder' => 'Ingrese el link de la página de googleplus']) }}
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-center">
                {{ Form::reset('Limpiar formulario', ['class' => 'btn btn-warning btn-lg']) }}
                {{ Form::submit('Guardar', ['class' => 'btn btn-primary btn-lg']) }}
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