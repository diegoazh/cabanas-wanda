<template>
    <div class="row justify-content-center">
        <div class="col-12 py-3">
            <button class="btn btn-outline-secondary btn-sm pull-right" @click.prevent.stop="clearRental"><icon-app icon-image="exchange"></icon-app> Cambiar reserva</button>
        </div>
        <div class="col-12 col-md-8">
            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th>Caba&ntilde;a</th>
                    <th>Concepto</th>
                    <th>Detalle</th>
                </tr>
                </thead>
                <tbody>
                <template>
                    <tr>
                        <th rowspan="9"><icon-app iconImage="home"></icon-app> {{ updatedRental.cottage.name }}</th>
                        <th><icon-app iconImage="dollar"></icon-app> Precio</th>
                        <td><icon-app iconImage="dollar"></icon-app> {{ updatedRental.cottage_price}}</td>
                    </tr>
                    <tr>
                        <th><icon-app iconImage="calendar"></icon-app> Dias</th>
                        <td><span class="badge badge-success"><b>{{ updatedRental.total_days}}</b></span></td>
                    </tr>
                    <tr>
                        <th><icon-app iconImage="dollar"></icon-app> Descuentos</th>
                        <td><icon-app iconImage="dollar"></icon-app> {{ updatedRental.deductions }}</td>
                    </tr>
                    <tr>
                        <th><icon-app iconImage="dollar"></icon-app>Precio total</th>
                        <td><span class="badge badge-info"><icon-app iconImage="dollar"></icon-app> {{ updatedRental.finalPayment }}</span></td>
                    </tr>
                    <tr>
                        <th><icon-app iconImage="calendar"></icon-app> Desde</th>
                        <td><span class="badge badge-secondary">{{ updatedRental.dateFrom + ' 10:00:00' | DateArg }}</span></td>
                    </tr>
                    <tr>
                        <th><icon-app iconImage="calendar"></icon-app> Hasta</th>
                        <td><span class="badge badge-secondary">{{ updatedRental.dateTo + ' 10:00:00' | DateArg }}</span></td>
                    </tr>
                    <tr>
                        <th><icon-app iconImage="dollar"></icon-app>Monto de reserva</th>
                        <td><span class="badge badge-info"><icon-app iconImage="dollar"></icon-app> {{ (updatedRental.finalPayment * 30 / 100).toFixed(2) }}</span></td>
                    </tr>
                    <tr>
                        <th><icon-app iconImage="calendar"></icon-app> Vto. reserva</th>
                        <td><span class="badge badge-warning">{{ updatedRental.dateReservationPayment | DateArg }}</span></td>
                    </tr>
                    <tr>
                        <th><icon-app iconImage="barcode"></icon-app> Código de reserva</th>
                        <td><span class="badge badge-primary text-uppercase">{{ updatedRental.code }}</span></td>
                    </tr>
                </template>
                </tbody>
                <tfoot class="bg-secondary">
                    <tr>
                        <td colspan="3" class="text-right text-light">Enviamos los datos al e-mail asociado a la reserva.</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</template>

<script>
    import { mapState, mapMutations } from 'vuex';
    import Icon from '../../vue-commons/components/Icon.vue';

    export default {
        components: {
            'icon-app': Icon
        },
        data() {
            return {}
        },
        computed: {
            ...mapState('rentals_edit', {
                updatedRental: state => state.data.updatedRental
            })
        },
        methods: {
            clearRental() {
                this.setUpdatedRental(null);
            },
            ...mapMutations('rentals_edit', ['setUpdatedRental']),
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