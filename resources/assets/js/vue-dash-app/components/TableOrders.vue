<template>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Orden</th>
                <th>Cabaña</th>
                <th>Se&ntilde;a</th>
                <th>Fecha de se&ntilde;a</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(orders, index) in pagination.data">
                <td>{{ rowNumber(index) }}</td>
                <td>{{ orders.rental.cottage.name }}</td>
                <td>{{ orders.senia }}</td>
                <td>{{ orders.senia_date }}</td>
                <td>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <button class="btn btn-info" v-tooltip="'Ver pedido ' + rowNumber(index) + ' de la cabaña ' + orders.rental.cottage.name">
                                <icon-app iconImage="eye"></icon-app>
                            </button>
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="4"></td>
            </tr>
            </tfoot>
        </table>
    </div>
</template>

<script>
    import { mapState } from 'vuex';
    import Icon from '../../vue-commons/components/Icon.vue';

    export default {
        components: {
            'icon-app': Icon
        },
        data() {
            return {}
        },
        computed: {
            ...mapState('dash', {
                pagination: state => state.data.pagination,
                page: state => state.page,
            }),
        },
        methods: {
            rowNumber(index) {
                let adition = (this.page - 1) * 15;
                return index + 1 + adition;
            }
        },
        filters: {},
        created() {
        },
        mounted() {
        }
    }
</script>

<style></style>