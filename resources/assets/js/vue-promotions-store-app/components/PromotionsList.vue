<template>
    <div class="card">
        <div class="card-header bg-dark text-light">
            <h2 class="text-center">Lista de promociones</h2>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Orden</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Descuento</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody v-if="promotions.length > 0">
                <tr v-for="(promo, index) in promotions">
                    <td><icon-app icon-image="hashtag"></icon-app> {{ index + 1 }}</td>
                    <td>{{ promo.name }}</td>
                    <td>{{ promo.state }}</td>
                    <td>
                        <icon-app v-if="promo.amount" icon-image="dollar-sign"></icon-app>
                        {{ promo.amount ? promo.amount : promo.percentage }}
                        <icon-app v-if="!promo.amount" icon-image="percent"></icon-app>
                    </td>
                    <td><span class="badge badge-info">{{ promo.startDate | dateArg('YYYY-MM-DD', 'DD/MM/YYYY') }}</span></td>
                    <td><span class="badge badge-warning">{{ promo.endDate | dateArg('YYYY-MM-DD', 'DD/MM/YYYY')   }}</span></td>
                    <td><button class="btn btn-outline-warning">Editar <icon-app icon-image="edit"></icon-app></button></td>
                </tr>
                </tbody>
                <tfoot></tfoot>
            </table>
        </div>
    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex'
    import VueNoti from 'vue-notifications'
    import Icon from '../../vue-commons/components/Icon'

    export default {
        name: 'promotions-list',
        components: {
            'icon-app': Icon
        },
        data() {
            return {}
        },
        computed: {
            ...mapState('promotions', {
                promotions: state => state.data.promotions
            })
        },
        methods: {
            ...mapActions('promotions', ['promotionsList'])
        },
        filters: {},
        created() {
        },
        beforeMount() {
        },
        mounted() {
            this.promotionsList()
                .then(response => VueNoti.success(response))
                .catch(error => VueNoti.error(error));
        }
    }
</script>

<style scoped>

</style>