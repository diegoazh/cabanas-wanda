<template>
    <div class="row">
        <div class="col-12 col-md-12">
            <h3 class="text-center mt-4 mb-3">Alta de platos</h3>
        </div>
        <div class="col-12 col-md-12">
            <form @submit.prevent="sendDatatoBackend">
                <div class="col-12 offset-md-2 col-md-8">
                    <div class="form-group">
                        <label for="name" class="col-form-label sr-only">Nombre:</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><div class="input-group-text">Nombre</div></div>
                            <input id="name" name="name" type="text" class="form-control" placeholder="Ej: Desayuno americano" v-model="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="type" class="sr-only">Tipo:</label>
                        <div class="input-group" style="height: 38px">
                            <div class="input-group-prepend"><div class="input-group-text">Tipo</div></div>
                            <input type="text" id="type" name="type" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="sr-only">Precio:</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><div class="input-group-text">Precio</div></div>
                            <input id="price" name="price" type="number" step="0.01" class="form-control" placeholder="Ej: 150" v-model="price">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="available" class="">
                            ¿Disponible?: <input id="available" name="available" type="checkbox" v-model="available">
                        </label>
                    </div>
                </div>
                <div class="w-100"></div>
                <div class="col-12 col-md-12">
                    <div class="form-group">
                        <label for="description" class="sr-only">Descripión:</label>
                        <div id="editormd">
                            <textarea id="description" name="description" class="form-control">{{ this.description }}</textarea>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-outline-success"><b>{{ !isUpdate ? 'Crear plato' : 'Actualizar plato' }} <icon-app :iconImage="toogleeIcon" :aditionalClasses="addAditionalClasses"></icon-app></b></button>
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
                available: false,
                description: '',
                isUpdate: false,
                idToUpdate: 0
            }
        },
        mounted() {
            const module = this;

            this.setInfoToUpdate();
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
                module.type ? window.appFood.type[0].selectize.setValue(module.type) : '';

                window.appFood.editor = editormd({
                    id      : 'editormd',
                    width   : '100%',
                    height  : '600px',
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
                return this.queryFinished ? (this.isUpdate ? 'refresh' : 'send') : 'spinner'
            },
            addAditionalClasses() {
                return this.queryFinished ? '' : 'fa-pulse fa-fw'
            },
            ...mapState('auth', {
                queryFinished: state => state.xhr.queryFinished
            }),
            ...mapState('food', {
                itemToUpdate: state => state.data.itemToUpdate
            })
        },
        methods: {
            sendDatatoBackend() {
                this.setQueryFinished(false);
                if (!this.isUpdate) {
                    this.storeFood({
                        name: this.name,
                        price: this.price,
                        type: this.type,
                        description: this.description,
                        available: this.available
                    }).then(data => {
                        this.name = '';
                        this.price = '';
                        this.description = '';
                        this.type = '';
                        this.available = false;
                        window.appFood.editor.clear();
                        window.appFood.type[0].selectize.clear();
                        this.setQueryFinished(true);
                        VueNoti.success(data);
                    }).catch(error => {
                        this.setQueryFinished(true);
                        VueNoti.error(error);
                    });
                } else {
                    this.updateFood({
                        id: this.idToUpdate,
                        name: this.name,
                        price: this.price,
                        type: this.type,
                        description: this.description,
                        available: this.available
                    }).then(data => {
                        this.setQueryFinished(true);
                        VueNoti.success(data);
                    }).catch(error => {
                        this.setQueryFinished(true);
                        VueNoti.error(error);
                    });
                }
            },
            setTypeFood() {
                this.type = window.appFood.type[0].selectize.getValue();
            },
            setTextMarkdown() {
                this.description = window.appFood.editor.getMarkdown();
            },
            setInfoToUpdate() {
                if(this.itemToUpdate) {
                    this.idToUpdate = this.itemToUpdate.id;
                    this.name = this.itemToUpdate.name;
                    this.price = this.itemToUpdate.price;
                    this.type = this.itemToUpdate.type;
                    this.available = this.itemToUpdate.available;
                    this.description = this.itemToUpdate.description;
                    this.setItemToUpdate(null);
                    this.isUpdate = true;
                }
            },
            ...mapActions('food', ['storeFood', 'updateFood', 'setItemToUpdate']),
            ...mapActions('auth', ['setQueryFinished'])
        }
    }
</script>

<style></style>
