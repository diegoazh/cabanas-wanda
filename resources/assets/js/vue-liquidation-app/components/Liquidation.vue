<template>
    <div id="liquidation-component" class="container jumbotron">
        <div class="row">
            <div class="col-12 col-md-12 page-header">
                <h1 class="text-center">Liquidación final</h1>
                <p class="text-center">Puedes ver todos los consumos de tu estadía</p>
            </div>
        </div>
        <find-rental-app v-if="!rental"></find-rental-app>
        <detail-liquidation-app v-else></detail-liquidation-app>
    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex'
    import FindRental from '../../vue-orders-app/components/FindRental.vue'
    import DetailLiquidation from './DetailLiquidation.vue'

    export default {
        components: {
            'find-rental-app': FindRental,
            'detail-liquidation-app': DetailLiquidation,
        },
        data() {
            return {}
        },
        computed: {
            ...mapState('orders', {
                rental: state => state.data.rental
            })
        },
        methods: {
            checkTokenOnCookie() {
                if (this.$cookies.isKey('info_one')) {
                    this.fireSetTokenMutation(this.$cookies.get('info_one'));
                } else {
                    this.fireSetTokenMutation('');
                }
            },
            changeReserva() {
                window.sessionStorage.removeItem('reserva');
                this.setRental(null);
            },
            ...mapActions('auth', ['fireSetTokenMutation']),
            ...mapActions('orders', ['setRental']),
        },
        filters: {},
        created() {
        },
        mounted() {
            this.checkTokenOnCookie();
            EventBus.$on('change-reserva', () => this.changeReserva());
            EventBus.$on('pay-liquidation', () => this.payLiquidation = !this.payLiquidation);
        },
        beforeDestroy() {
            EventBus.$emit('change-reserva');
        },
    }
</script>

<style>
    #liquidation-component {
        margin-top: 30px;
        background-color: rgba(238,238,238,0.4);
    }
</style>
