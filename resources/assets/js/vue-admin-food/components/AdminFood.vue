<template>
    <div class="container-fluid panel panel-body">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h1 class="text-center">Alta de platos</h1>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <form>
                    <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8">
                        <div class="form-group">
                            <label for="name" class="sr-only">Nombre:</label>
                            <div class="input-group">
                                <div class="input-group-addon">Nombre</div>
                                <input id="name" name="name" type="text" class="form-control" placeholder="Ej: Desayuno americano">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="type" class="sr-only">Tipo:</label>
                            <div class="input-group">
                                <div class="input-group-addon">Tipo</div>
                                <input type="text" id="type" name="type" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price" class="sr-only">Precio:</label>
                            <div class="input-group">
                                <div class="input-group-addon">Precio</div>
                                <input id="price" name="price" type="number" step="0.01" class="form-control" placeholder="Ej: 150">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="description" class="sr-only">Descripión:</label>
                            <div id="editormd">
                                <textarea id="description" name="description" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary"><b>Crear plato</b></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapActions } from 'vuex'

    export default {
        data() {
            return {
               myTypes: [
                   {id: 'desayuno', nombre: 'Desayuno'},
                   {id: 'almuerzo', nombre: 'Almuerzo'},
                   {id: 'merienda', nombre: 'Merienda'},
                   {id: 'cena', nombre: 'Cena'}
               ]
            }
        },
        mounted() {
            window.jQuery(window.document).ready(function () {
                window.appFood = {};
                window.appFood.type = window.jQuery('#type').selectize({
                    persist: false,
                    maxItems: 1,
                    valueField: 'id',
                    labelField: 'nombre',
                    searchField: ['id', 'nombre'],
                    options: [
                        {id: 1, nombre: 'Desayuno'},
                        {id: 2, nombre: 'Almuerzo'},
                        {id: 3, nombre: 'Merienda'},
                        {id: 4, nombre: 'Cena'}
                    ],
                    create: false,
                    preload: true,
                    placeholder: 'Seleccione la categoría del plato',
                    inputClass: 'form-control selectize-input',
                    dropdownParent: 'body'
                });

                window.appFood.editor = editormd({
                    id      : 'editormd',
                    width   : '100%',
                    height  : '400px',
                    path    : '/lib/editor.md/lib/',
                    theme: 'dark',
                    previweTheme: 'default',
                    editorTheme: 'pastel-on-dark',
                    syncScrolling : true,
                    saveHTMLToTextarea : true
                });
            });

            this.defineXhrToken();
        },
        methods: {
            defineXhrToken() {
                window.verifyToken = setTimeout(() => {
                    if (window.adminInfo) {
                        this.setXhrToken(window.adminInfo.token);
                        delete window.adminInfo;
                    }
                }, 1000);
            },
            ...mapActions(['setXhrToken'])
        }
    }
</script>

<style></style>