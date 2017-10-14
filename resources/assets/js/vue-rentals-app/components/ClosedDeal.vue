<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <button @click="goBackToReservas" class="btn btn-link pull-right">
                <icon-app iconImage="arrow-left"></icon-app>
                Volver a reservas
                <icon-app iconImage="handshake-o"></icon-app>
            </button>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
            <h2 class="text-center">Se contretó con éxito la reserva!</h2>
            <div class="text-center">
                <icon-app iconImage="thumbs-o-up" aditionalClasses="text-success mano-grande"></icon-app>
            </div>
            <div class="">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Cabaña</th>
                            <th>Concepto</th>
                            <th>Detalle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="rental in infoDeal">
                            <tr>
                                <th rowspan="8"><icon-app iconImage="home"></icon-app> {{ rental.cottage.name }}</th>
                                <th><icon-app iconImage="dollar"></icon-app> Precio</th>
                                <td><icon-app iconImage="dollar"></icon-app> {{ rental.cottage_price}}</td>
                            </tr>
                            <tr>
                                <th><icon-app iconImage="calendar"></icon-app> Dias</th>
                                <td><p class="label label-success"><b>{{ rental.total_days}}</b></p></td>
                            </tr>
                            <tr>
                                <th><icon-app iconImage="dollar"></icon-app> Descuentos</th>
                                <td><icon-app iconImage="dollar"></icon-app> {{ rental.deductions }}</td>
                            </tr>
                            <tr>
                                <th><icon-app iconImage="dollar"></icon-app>Precio total</th>
                                <td><p class="label label-info"><icon-app iconImage="dollar"></icon-app> {{ rental.finalPayment }}</p></td>
                            </tr>
                            <tr>
                                <th><icon-app iconImage="calendar"></icon-app> Desde</th>
                                <td>{{ rental.dateFrom | argentineDate }}</td>
                            </tr>
                            <tr>
                                <th><icon-app iconImage="calendar"></icon-app> Hasta</th>
                                <td>{{ rental.dateTo | argentineDate }}</td>
                            </tr>
                            <tr>
                                <th><icon-app iconImage="calendar"></icon-app> Vto. reserva</th>
                                <td><p class="label label-warning">{{ rental.dateReservationPayment | argentineDateTime }}</p></td>
                            </tr>
                            <tr>
                                <th><icon-app iconImage="barcode"></icon-app> Código de reserva</th>
                                <td><p class="label label-primary">{{ rental.code_reservation }}</p></td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import { createNamespacedHelpers } from 'vuex'
    import moment from 'moment'
    import Icon from './Icon.vue'

    const { mapActions, mapState } = createNamespacedHelpers('rentals');

    export default {
        components: {
            'icon-app': Icon,
        },
        computed: {
            ...mapState({
                infoDeal: state => state.data.infoDeal
            })
        },
        methods: {
            goBackToReservas() {
                this.setToRentals(new Array());
                this.setClosedDeal(false);
                this.setDeal(false);
            },
            ...mapActions(['setDeal', 'setClosedDeal', 'setToRentals'])
        },
        filters: {
            argentineDateTime(value) {
                if (!value) return;
                return moment(value, 'YYYY-MM-DD HH:mm:ss').format('DD/MM/YYYY HH:mm:ss');
            },
            argentineDate(value) {
                if (!value) return;
                return moment(value, 'YYYY-MM-DD').format('DD/MM/YYYY');
            }
        }
    }
</script>

<style>
    .mano-grande {
        font-size: 25em;
    }
</style>