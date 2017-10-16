<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h3 class="text-center">Alta de platos</h3>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <form @submit.prevent="sendDatatoBackend">
                <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8">
                    <div class="form-group">
                        <label for="name" class="sr-only">Nombre:</label>
                        <div class="input-group">
                            <div class="input-group-addon">Nombre</div>
                            <input id="name" name="name" type="text" class="form-control" placeholder="Ej: Desayuno americano" v-model="name">
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
                            <input id="price" name="price" type="number" step="0.01" class="form-control" placeholder="Ej: 150" v-model="price">
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
                        <button class="btn btn-primary"><b>Crear plato <icon-app :iconImage="toogleeIcon" :aditionalClasses="addAditionalClasses"></icon-app></b></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import VueNoti from 'vue-notifications'
    import Icon from '../../vue-commons/components/Icon.vue'
    import { mapState, mapActions } from 'vuex'

    export default {
        components: {
            'icon-app': Icon
        },
        data() {
            return {
                name: '',
                type: '',
                price: '',
                description: ''
            }
        },
        mounted() {
            const module = this;
            window.jQuery(window.document).ready(function () {
                window.appFood = {};
                window.appFood.type = window.jQuery('#type').selectize({
                    persist: false,
                    maxItems: 1,
                    valueField: 'id',
                    labelField: 'nombre',
                    searchField: ['id', 'nombre'],
                    options: [
                        {id: 'desayuno', nombre: 'Desayuno'},
                        {id: 'almuerzo', nombre: 'Almuerzo'},
                        {id: 'merienda', nombre: 'Merienda'},
                        {id: 'cena', nombre: 'Cena'}
                    ],
                    create: false,
                    preload: true,
                    placeholder: 'Seleccione la categoría del plato',
                    inputClass: 'form-control selectize-input',
                    dropdownParent: 'body'
                });

                window.appFood.type[0].selectize.on('change', module.setTypeFood);

                window.appFood.editor = editormd({
                    id      : 'editormd',
                    width   : '100%',
                    height  : '400px',
                    path    : '/lib/editor.md/lib/',
                    theme: 'dark',
                    previweTheme: 'default',
                    editorTheme: 'pastel-on-dark',
                    syncScrolling : true,
                    saveHTMLToTextarea : true,
                    onchange: function() {
                        module.setTextMarkdown();
                    }
                });
            });
        },
        computed: {
            toogleeIcon() {
                return this.queryFinished ? 'send' : 'spinner'
            },
            addAditionalClasses() {
                return this.queryFinished ? '' : 'fa-pulse fa-fw'
            },
            ...mapState('auth', {
                queryFinished: state => state.xhr.queryFinished
            })
        },
        methods: {
            sendDatatoBackend() {
                this.setQueryFinished(false);
                this.sendNewFood({
                    name: this.name,
                    price: this.price,
                    type: this.type,
                    description: this.description
                }).then(data => {
                    this.name = '';
                    this.price = '';
                    this.description = '';
                    this.type = '';
                    window.appFood.editor.clear();
                    window.appFood.type[0].selectize.clear();
                    this.setQueryFinished(true);
                    VueNoti.success(data);
                }).catch(error => {
                    this.setQueryFinished(true);
                    VueNoti.error(error);
                });
            },
            setTypeFood() {
                this.type = window.appFood.type[0].selectize.getValue();
            },
            setTextMarkdown() {
                this.description = window.appFood.editor.getMarkdown();
            },
            ...mapActions('food', ['sendNewFood']),
            ...mapActions('auth', ['setQueryFinished'])
        }
    }
</script>

<style></style>