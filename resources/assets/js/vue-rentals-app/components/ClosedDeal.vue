<template>
    <div class="row justify-content-around">
        <div class="col-12 col-md-12">
            <button @click="goBackToReservas" class="btn btn-outline-secondary btn-sm pull-right">
                <icon-app iconImage="arrow-left"></icon-app>
                Volver a reservas
                <icon-app iconImage="handshake-o"></icon-app>
            </button>
        </div>
        <div class="col-12 col-md-12">
            <h2 class="text-center">Se contretó con éxito la reserva!</h2>
            <div class="text-center">
                <icon-app iconImage="thumbs-o-up" aditionalClasses="text-success big-hand"></icon-app>
            </div>
            <div class="">
                <div class="alert alert-info">
                    <p class="text-justify">Enviamos un email al correo electronico ingresado en la reserva. Este contiene toda la información de la misma y el código de reserva que <span class="text-danger">es único y solo Ud. lo conoce</span>.<br>
                        Este código le permitirá operar en nuestro sitio web para modificar o cancelar la reserva, asi como también para poder realizar pedidos y otras operaciones desde nuestra web.<br>
                        Tenga en cuenta que la reserva aún no está confirmada, para ello debe hacer el deposito de la seña indicada más abajo. Los datos para realizarlo se encuentran en el mail que le enviamos. El vencimiendo de la reserva se indica más abajo, si para esa fecha y hora la reserva no se confirmó, automáticamente se cae y la cabaña vuelve a quedar disponible para esa fecha.
                        <br>
                        Por favor tenga en cuenta que <span class="text-danger">no podemos recuperar</span> el código y si lo pierde, deberá generar un nuevo código desde nuestra web, registrandose como usuario.</p>
                </div>
                <table class="table table-striped">
                    <thead class="thead bg-dark text-light">
                        <tr>
                            <th>Caba&ntilde;a</th>
                            <th>Concepto</th>
                            <th>Detalle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template>
                            <tr>
                                <th rowspan="9"><icon-app iconImage="home"></icon-app> {{ infoDeal.cottage.name }}</th>
                                <th><icon-app iconImage="dollar"></icon-app> Precio</th>
                                <td><span class="badge badge-danger"><icon-app iconImage="dollar"></icon-app> {{ infoDeal.cottage_price}}</span></td>
                            </tr>
                            <tr>
                                <th><icon-app iconImage="calendar"></icon-app> Dias</th>
                                <td><span class="badge badge-success"><b>{{ infoDeal.total_days}}</b></span></td>
                            </tr>
                            <tr>
                                <th><icon-app iconImage="dollar"></icon-app> Descuentos</th>
                                <td><span class="badge badge-success"><icon-app iconImage="dollar"></icon-app> {{ infoDeal.deductions }}</span></td>
                            </tr>
                            <tr>
                                <th><icon-app iconImage="dollar"></icon-app>Precio total</th>
                                <td><span class="badge badge-info"><icon-app iconImage="dollar"></icon-app> {{ infoDeal.finalPayment }}</span></td>
                            </tr>
                            <tr>
                                <th><icon-app iconImage="calendar"></icon-app> Desde</th>
                                <td><span class="badge badge-secondary">{{ infoDeal.dateFrom + ' 10:00:00' | argentineDateTime }}</span></td>
                            </tr>
                            <tr>
                                <th><icon-app iconImage="calendar"></icon-app> Hasta</th>
                                <td><span class="badge badge-secondary">{{ infoDeal.dateTo + ' 10:00:00' | argentineDateTime }}</span></td>
                            </tr>
                            <tr>
                                <th><icon-app iconImage="dollar"></icon-app>Monto de reserva</th>
                                <td><span class="badge badge-info"><icon-app iconImage="dollar"></icon-app> {{(infoDeal.finalPayment * 30 / 100).toFixed(2) }}</span></td>
                            </tr>
                            <tr>
                                <th><icon-app iconImage="calendar"></icon-app> Vto. reserva</th>
                                <td><span class="badge badge-warning">{{ infoDeal.dateReservationPayment | argentineDateTime }}</span></td>
                            </tr>
                            <tr>
                                <th><icon-app iconImage="barcode"></icon-app> Código de reserva</th>
                                <td><span class="badge badge-primary text-uppercase">{{ infoDeal.code }}</span></td>
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
    import Icon from '../../vue-commons/components/Icon.vue'

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
    .big-hand {
        font-size: 20rem;
    }
</style>