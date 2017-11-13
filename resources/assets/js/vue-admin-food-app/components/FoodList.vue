<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <table class="table table-striped table-hover table-responsive">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Tipo</th>
                    <th>Disponible</th>
                    <th>Precio</th>
                    <th class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <template v-for="comida in fiftheenElements">
                    <tr>
                        <td>
                            <b class="text-capitalize">{{ comida.name }}</b>
                        </td>
                        <td>
                            <a class="btn btn-link" role="button" @click="showDescription(comida)" data-toggle="modal" data-target="#ModalDescriptionFood">
                                <b><icon-app iconImage="eye"></icon-app> ver descripción</b>
                            </a>
                        </td>
                        <td>
                            <span class="label label-primary"><b>{{ comida.type }}</b></span>
                        </td>
                        <td>
                            <span class="label label-info"><b>{{ comida.available ? 'Si' : 'No' }}</b></span>
                        </td>
                        <td>
                            <b><icon-app iconImage="dollar"></icon-app> {{ comida.price }}</b>
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm" @click="setEditItem(comida)">
                                <icon-app iconImage="edit"></icon-app> Editar
                            </button>
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#ModalDeleteFood" @click="setIdToDelete(comida)">
                                <icon-app iconImage="trash"></icon-app> Eliminar
                            </button>
                        </td>
                    </tr>
                </template>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="6">
                        <p class="text-right">Lista de platos disponibles a la fecha</p>
                    </td>
                </tr>
                </tfoot>
            </table>
            <div class="text-center">
                <pagination for="food" :records="food.length" :per-page="itemsPerPage" :chunk="pagChunk" :vuex="true"
                            count-text="Listando {from} a {to} de {count} items|{count} items|Un item">
                </pagination>
            </div>
            <modal-app modalId="ModalDescriptionFood" :modalTitle="titleModal" :showBtnSave="false" txtBtnClose="Cerrar">
                <vue-markdown :source="textContentModal"></vue-markdown>
            </modal-app>
            <modal-app modalId="ModalDeleteFood" :modalTitle="titleModal">
                <div class="alert alert-warning">
                    <p>
                        <icon-app iconImage="exclamation-triangle"></icon-app> <icon-app iconImage="question" aditionalClasses="fa-rotate-180"></icon-app>Esta seguro que desea realizar esta operación<icon-app iconImage="question"></icon-app>
                    </p>
                </div>
                <p class="text-danger">Esto eliminará de manera permanente el plato.</p>
                <div slot="b3-modal-footer">
                    <button class="btn btn-danger" @click="deleteItem()">
                        <icon-app :iconImage="toogleIcon" :aditionalClasses="adiotionalClasses"></icon-app> Eliminar
                    </button>
                    <button class="btn btn-dfault" data-dismiss="modal">
                        <icon-app iconImage="close"></icon-app> Cerrar
                    </button>
                </div>
            </modal-app>
        </div>
    </div>
</template>

<script>
    import VueNoti from 'vue-notifications'
    import VueMarkdown from 'vue-markdown'
    import { mapState, mapActions } from 'vuex'
    import { Pagination, PaginationEvent } from 'vue-pagination-2';
    import Icon from '../../vue-commons/components/Icon.vue'
    import Modal from '../../vue-commons/components/Modal.vue'


    export default {
        data() {
            return {
                pagChunk: 7,
                titleModal: '',
                textContentModal: '',
                idToDelete: 0,
            }
        },
        components: {
            VueMarkdown,
            Pagination,
            PaginationEvent,
            'icon-app': Icon,
            'modal-app': Modal
        },
        mounted() {
            this.getFoodFromBackend();
        },
        computed: {
            fiftheenElements() {
                let pageTo = this.page * this.itemsPerPage; // quince debería ser una variable
                let pageFrom = (this.page === 1) ? 0 : (this.page - 1) * this.itemsPerPage;
                return this.food.filter(function (element, index, array) {
                    return index >= pageFrom && index < pageTo;
                });
            },
            toogleIcon() {
                return this.queryFinished ? 'trash' : 'spinner';
            },
            adiotionalClasses() {
                return this.queryFinished ? '' : 'fa-pulse fa-fw';
            },
            ...mapState('food', {
                food: state => state.data.food,
                page: state => state.page,
                itemsPerPage: state => state.itemsPerPage,
            }),
            ...mapState('auth', {
                queryFinished: state => state.xhr.queryFinished
            }),
        },
        methods: {
            getFoodFromBackend() {
                this.getAllFood()
                    .then(response => {})
                    .catch(error => {
                        VueNoti.error({
                            title: error.title,
                            message: error.message,
                            useSwal: false
                        });
                    });
            },
            showDescription(comida) {
                this.titleModal = 'Descripticón plato: ' + comida.name;
                this.textContentModal = comida.description;
            },
            setIdToDelete(comida) {
                this.idToDelete = comida.id;
                this.titleModal = 'Eliminar: ' + comida.name;
            },
            setEditItem(comida) {
                this.setItemToUpdate(comida);
                this.setCreate(true);
            },
            deleteItem() {
                this.setQueryFinished(false);
                this.deleteFood(this.idToDelete)
                    .then(response => {
                        this.food.map(function (element, index, array) {
                            if (index === this.idToDelete) {
                                array.splice(index, 1);
                            }
                        });
                        VueNoti.success(response);
                        this.setQueryFinished(true);
                    })
                    .catch(error => {
                        VueNoti.error(error);
                        this.setQueryFinished(true);
                    })
            },
            ...mapActions('food', ['getAllFood', 'deleteFood', 'setCreate', 'setItemToUpdate']),
            ...mapActions('auth', ['setQueryFinished']),
        }
    }
</script>

<style></style>