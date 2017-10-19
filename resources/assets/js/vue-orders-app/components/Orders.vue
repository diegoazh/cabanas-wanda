<template>
    <div id="orders-component" class="container jumbotron">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <h1 class="text-center">Ordenes</h1>
                <p class="text-center">Puedes programar los pedidos que desee para cada día de tu estadía</p>
            </div>
        </div>
        <find-rental-app v-if="!rental"></find-rental-app>
        <add-orders-app v-else></add-orders-app>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'
    import FindRental from './FindRental.vue'
    import AddOrders from './AddOrders.vue'

    export default {
        data() {
            return {

            }
        },
        created() {
            this.checkItemInStorage();
        },
        components: {
            'find-rental-app': FindRental,
            'add-orders-app': AddOrders
        },
        computed: {
            ...mapState('orders', {
                rental: state => state.data.rental
            })
        },
        methods: {
            checkItemInStorage() {
                let reserva = JSON.parse(sessionStorage.getItem('reserva'));

                if (reserva) {
                    this.setRental(reserva);
                }
            },
            ...mapActions('orders', ['setRental'])
        }
    }
</script>

<style>
    #orders-component {
        margin-top: 30px;
        background-color: rgba(238,238,238,0.4);
    }
</style>