<template>
    <div id="orders-component" class="container jumbotron">
        <div class="row">
            <div class="col-12 col-md-12 page-header">
                <h1 class="text-center">Ordenes</h1>
                <p class="text-center">Puedes programar los pedidos que desee para cada día de tu estadía</p>
            </div>
        </div>
        <find-rental-app v-if="!rental"></find-rental-app>
        <add-orders-app v-else-if="rental && !closeOrder"></add-orders-app>
        <close-order-app v-else></close-order-app>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'
    import FindRental from './FindRental.vue'
    import AddOrders from './AddOrders.vue'
    import CloseOrder from './CloseOrder.vue'

    export default {
        data() {
            return {

            }
        },
        created() {
            this.checkItemInStorage();
        },
        mounted() {
            this.changeReserva();
            EventBus.$on('change-reserva', () => this.changeReserva());
        },
        beforeDestroy() {
            EventBus.$emit('change-reserva');
        },
        components: {
            'find-rental-app': FindRental,
            'add-orders-app': AddOrders,
            'close-order-app': CloseOrder,
        },
        computed: {
            ...mapState('orders', {
                rental: state => state.data.rental,
                closeOrder: state => state.data.closeOrder,
            })
        },
        methods: {
            checkItemInStorage() {
                let reserva = JSON.parse(sessionStorage.getItem('reserva'));

                if (reserva) {
                    this.setRental(reserva);
                }
            },
            changeReserva() {
                window.sessionStorage.removeItem('reserva');
                this.setOrders([]);
                this.setRental(null);
                this.setFood([]);
            },
            ...mapActions('orders', ['setRental', 'setOrders']),
            ...mapActions('food', ['setFood']),
        }
    }
</script>

<style>
    #orders-component {
        margin-top: 30px;
        background-color: rgba(238,238,238,0.4);
    }
</style>