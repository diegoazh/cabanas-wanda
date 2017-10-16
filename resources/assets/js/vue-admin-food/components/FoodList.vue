<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Tipo</th>
                    <th>Precio</th>
                    <th class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <template v-for="comida in food">
                    <tr>
                        <td>
                            <b class="text-capitalize">{{ comida.name }}</b>
                        </td>
                        <td>
                            <a class="btn btn-link" role="button" @click="showDescription(comida)" data-toggle="modal" data-target="#ModalDescriptionFood">Descripción</a>
                        </td>
                        <td>
                            <span class="label label-primary"><b>{{ comida.type }}</b></span>
                        </td>
                        <td>
                            <b><icon-app iconImage="dollar"></icon-app> {{ comida.price }}</b>
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm"><icon-app iconImage="edit"></icon-app> Editar</button>
                            <button class="btn btn-danger btn-sm"><icon-app iconImage="trash"></icon-app> Eliminar</button>
                        </td>
                    </tr>
                </template>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5">
                        <p class="text-right">Lista de platos disponibles a la fecha</p>
                    </td>
                </tr>
                </tfoot>
            </table>
            <modal-app modalId="ModalDescriptionFood" :modalTitle="titleModal" txtBtnClose="Cerrar">
                <vue-markdown :source="textContentModal"></vue-markdown>
            </modal-app>
        </div>
    </div>
</template>

<script>
    import { createNamespacedHelpers } from 'vuex'
    import VueMarkdown from 'vue-markdown'
    import Icon from '../../vue-commons/components/Icon.vue'
    import Modal from '../../vue-commons/components/Modal.vue'

    const { mapState } = createNamespacedHelpers('food');

    export default {
        data() {
            return {
                titleModal: '',
                textContentModal: ''
            }
        },
        components: {
            VueMarkdown,
            'icon-app': Icon,
            'modal-app': Modal
        },
        computed: {
            ...mapState({
                food: state => state.data.food
            })
        },
        methods: {
            showDescription(comida) {
                console.log(comida.description);
                this.titleModal = 'Descripticón plato: ' + comida.name;
                this.textContentModal = comida.description;
            }
        }
    }
</script>

<style></style>