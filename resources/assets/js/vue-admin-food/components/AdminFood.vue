<template>
    <div class="container-fluid panel panel-body">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h1 class="text-center">Alta de platos</h1>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <form>
                    <div class="form-group">
                        <label for="name" class="sr-only">Nombre:</label>
                        <div class="input-group">
                            <div class="input-group-addon">Nombre</div>
                            <input id="name" name="name" type="text" class="form-control">
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
                            <input id="price" name="price" type="number" step="0.01" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="sr-only">Descripión:</label>
                        <textarea id="description" name="description" class="form-control"></textarea>
                    </div>
                    <div class="text-center">
                        <button class="btn btn success">Crear plato</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
               myTypes: [
                   {id: 1, nombre: 'Desayuno'},
                   {id: 2, nombre: 'Almuerzo'},
                   {id: 3, nombre: 'Merienda'},
                   {id: 4, nombre: 'Cena'}
               ]
            }
        },
        mounted() {
            window.jQuery(window.document).ready(function () {
                $('#type').selectize({
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
                    placeholder: 'Seleccione el tipo de cabaña',
                    inputClass: 'form-control selectize-input',
                    dropdownParent: 'body'
                });
            });
        }
    }
</script>

<style></style>