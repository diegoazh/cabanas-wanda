<template>
    <div id="orders-edit-component" class="container jumbotron">
        <h1 class="text-center">
            ¡Modificación de pedidos!
            <button class="btn btn-secondary btn-sm float-right" @click="changeRental" v-if="rental">
                <icon-app icon-image="sync"></icon-app> Cambiar reserva
            </button>
        </h1>
        <find-rental-app v-if="!rental"></find-rental-app>
        <card-list-app v-else-if="rental && !orderToEdit"></card-list-app>
        <add-orders-app v-else-if="orderToEdit && !closeOrder"></add-orders-app>
        <close-orders-app v-else></close-orders-app>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'
    import FindRental from '../../vue-orders-app/components/FindRental'
    import AddOrders from '../../vue-orders-app/components/AddOrders'
    import CloseOrder from '../../vue-orders-app/components/CloseOrder'
    import CardList from './CardList'
    import Icon from '../../vue-commons/components/Icon'

    export default {
        name: 'orders-edit',
        components: {
            'find-rental-app': FindRental,
            'add-orders-app': AddOrders,
            'close-orders-app': CloseOrder,
            'card-list-app': CardList,
            'icon-app': Icon
        },
        data() {
            return {}
        },
        computed: {
            ...mapState('orders', {
                rental: state => state.data.rental,
                orderToEdit: state => state.data.orderToEdit,
                closeOrder: state => state.data.closeOrder,
            })
        },
        methods: {
            changeRental() {
                this.setRental(null);
            },
            ...mapActions('orders', ['setRental'])
        },
        filters: {},
        created() {
        },
        mounted() {
        }
    }
</script>

<style scoped>
    #orders-edit-component {
        margin-top: 30px;
        background-color: rgba(238,238,238,0.4);
    }
</style>