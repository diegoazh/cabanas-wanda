<template>
    <div v-if="rental">
        <div class="row" v-for="row in defineRows">
            <div class="col-4" v-for="col in 3">
                <div class="card my-2" v-if="defineIndex(row, col) < rental.orders.length">
                    <div class="card-header bg-dark text-light text-center">
                        <icon-app icon-image="utensils" aditional-classes="float-left"></icon-app> {{ (defineIndex(row, col) + 1) + 'º Pedido' }}
                    </div>
                    <div class="card-body">
                        <ul>
                            <li><b>Estado:</b> <span class="badge badge-info">{{ rental.orders[defineIndex(row, col)].state.toUpperCase() }}</span></li>
                            <li><b>Seña:</b> <icon-app icon-image="dollar-sign"></icon-app> {{ rental.orders[defineIndex(row, col)].senia }}</li>
                            <li><b>Señado el:</b> <span class="badge badge-secondary">{{ rental.orders[defineIndex(row, col)].senia_date | dateArg }}</span></li>
                            <li><b>Creado:</b> <span class="badge badge-secondary">{{ rental.orders[defineIndex(row, col)].created_at | dateArg }}</span></li>
                        </ul>
                        <div class="text-center">
                            <button class="btn btn-outline-warning" @click.stop="prepareOrder(rental.orders[defineIndex(row, col)])">
                                Editar <icon-app icon-image="edit"></icon-app>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'
    import { mapState, mapMutations } from 'vuex'
    import Icon from '../../vue-commons/components/Icon'

    export default {
        name: 'card-list',
        components: {
            'icon-app': Icon
        },
        data() {
            return {}
        },
        computed: {
            defineRows() {
                return Math.ceil(this.rental.orders.length / 3);
            },
            ...mapState('orders', {
                rental: state => state.data.rental
            })
        },
        methods: {
            defineIndex(row, col) {
                return (row - 1) * 3 + (col - 1);
            },
            prepareOrder(order) {
                for (let detail of order.orders_detail) {
                    this.$set(detail, 'checked', true);
                    detail.delivery = moment(detail.delivery, 'YYYY-MM-DD').format('DD/MM/YYYY');
                }
                window.localStorage.removeItem('orders_detail');
                window.localStorage.setItem('orders_detail', JSON.stringify(order.orders_detail));
                this.setOrderId(order.id);
                this.setOrderToEdit(true);
            },
            ...mapMutations('orders', ['setOrders', 'setOrderToEdit', 'setOrderId'])
        },
        filters: {},
        created() {
        },
        mounted() {
        }
    }
</script>

<style scoped>

</style>