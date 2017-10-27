<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <button class="btn btn-primary btn-xs pull-right" @click="changeReserva">
                <icon-app iconImage="refresh" :aditionalClasses="activeReload ? 'fa-spin fa-fw' : ''"></icon-app>
                Cambiar reserva
            </button>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th colspan="6" class="text-center">Reserva</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="col">Nombre y apellido</th>
                    <td><span class="label label-primary">{{ defineOwner }}</span></td>
                    <th scope="col">Estado</th>
                    <td><span class="label label-info text-capitalize">{{ rental.state }}</span></td>
                    <th scope="col">Fecha de realización</th>
                    <td><span class="label label-default">{{ rental.created_at | displayArgDate }}</span></td>
                </tr>
                <tr>
                    <th scope="col">Cabaña</th>
                    <td><span class="label label-warning">{{ rental.cottage.name }}</span></td>
                    <th scope="col">Número</th>
                    <td><span class="label label-default">{{ rental.cottage.number }}</span></td>
                    <th scope="col">Precio</th>
                    <td><span class="label label-warning"><icon-app iconImage="dollar"></icon-app> {{ rental.cottage_price }}</span></td>
                </tr>
                <tr>
                    <th scope="col">Desde</th>
                    <td><span class="label label-info">{{ rental.dateFrom | displayArgDate }}</span></td>
                    <th scope="col">Hasta</th>
                    <td><span class="label label-info">{{ rental.dateTo | displayArgDate }}</span></td>
                    <th scope="col">Cantidad de dias</th>
                    <td><span class="label label-primary">{{ rental.total_days }}</span></td>
                </tr>
                <tr>
                    <th scope="col">Monto total</th>
                    <td><span class="label label-danger"><icon-app iconImage="dollar"></icon-app> {{ rentalTotalAmount }}</span></td>
                    <th scope="col">Monto de reserva</th>
                    <td><span class="label label-success"><icon-app iconImage="dollar"></icon-app> {{ reservaAmount }}</span></td>
                    <th scope="col">Vto. pago de reserva</th>
                    <td><span class="label label-default">{{ rental.dateReservationPayment | displayArgDate }}</span></td>
                </tr>
                <tr>
                    <th scope="col">Promocion</th>
                    <td><span class="label label-info">{{ rental.promotion ? rental.promotion.name : 'Sin promoción' }}</span></td>
                    <th scope="col">Descuento</th>
                    <td><span class="label label-success"><icon-app iconImage="dollar"></icon-app> {{ rental.deductions || 0 }}</span></td>
                    <th scope="col">Monto restante</th>
                    <td><span class="label label-danger"><icon-app iconImage="dollar"></icon-app> {{ finalAmountWithDeductions }}</span></td>
                </tr>
                </tbody>
                <tbody>
                <tr>

                </tr>
                </tbody>
            </table>
            <table class="table table-striped" v-for="(order, index) in rental.orders">
                <thead>
                    <tr>
                        <th colspan="5" class="text-center">
                            <button :class="['pull-right', 'btn', 'btn-xs', {'btn-info': !order.show, 'btn-warning': order.show}]" @click="order.show = !order.show">
                                <icon-app :iconImage="toggleCaret(order.show)"></icon-app> {{ order.show ? 'Ocultar detalle' : 'Mostrar detalle' }}
                            </button>
                            Pedido {{ index + 1 }}
                        </th>
                    </tr>
                    <tr>
                        <th scope="col">Fecha</th>
                        <td><span class="label label-default">{{ order.created_at | displayArgDate }}</span></td>
                        <th scope="col">Estado</th>
                        <td><span class="label label-warning text-capitalize">{{ order.state }}</span></td>
                    </tr>
                    <tr class="dafault">
                        <th>Fecha de entrega</th>
                        <th>Plato</th>
                        <th>Cantidad</th>
                        <th><icon-app iconImage="dollar"></icon-app>/unidad</th>
                        <th><icon-app iconImage="dollar"></icon-app> total por plato</th>
                    </tr>
                </thead>
                <transition name="slide-fade"
                            enter-active-class="animated bounceIn"
                            leave-active-class="animated bounceOut">
                    <tbody v-if="order.show">
                        <tr v-for="item in order.orders_detail">
                            <td>{{ item.delivery | displayArgDate }}</td>
                            <td>{{ item.food.name }}</td>
                            <td>{{ item.quantity }}</td>
                            <td><icon-app iconImage="dollar"></icon-app> {{ item.food.price }}</td>
                            <td><icon-app iconImage="dollar"></icon-app> {{ item.food.price * item.quantity }}</td>
                        </tr>
                    </tbody>
                </transition>
                <tfoot>
                    <tr class="info">
                        <th>Monto parcial</th>
                        <td></td>
                        <td>{{ totalQuantity(order) }}</td>
                        <td></td>
                        <td><icon-app iconImage="dollar"></icon-app> {{ totalAmount(order) }}</td>
                    </tr>
                    <tr class="warning">
                        <th>Seña</th>
                        <td colspan="3"></td>
                        <td><icon-app iconImage="dollar"></icon-app> {{ order.senia || 0 }}</td>
                    </tr>
                    <tr class="danger">
                        <th>Monto final</th>
                        <td colspan="3"></td>
                        <td><icon-app iconImage="dollar"></icon-app> {{ totalAmount(order) - (order.senia || 0) }}</td>
                    </tr>
                </tfoot>
            </table>
            <div class="text-center btn-frm">
                <transition name="btnFrm-tran"
                            enter-active-class="animated flip"
                            leave-active-class="animated fadeOutDownBig">
                    <template v-if="!payLiquidation">
                        <button id="btn-liquidation" class="btn btn-lg btn-success" @click="payLiquidation = !payLiquidation">
                            <b><icon-app :iconImage="toggleIcon" :aditionalClasses="addAditionalClasses"></icon-app> Liquidar saldo</b>
                        </button>
                    </template>
                    <template v-else>
                        <form @submit.prevent="sendLiquidation" class="form-inline">
                            <fieldset>
                                <legend>Ingrese su contraseña de administrador</legend>
                                <div class="form-group">
                                    <label for="admin-password" class="sr-only">Contraseña</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <icon-app iconImage="asterisk"></icon-app>
                                            <icon-app iconImage="asterisk"></icon-app>
                                            <icon-app iconImage="asterisk"></icon-app>
                                        </div>
                                        <input type="password" id="admin-password" name="admin-password" class="form-control">
                                    </div>
                                    <button class="btn btn-primary" role="button" type="submit">
                                        <icon-app iconImage="credit-card"></icon-app> Liquidar!
                                    </button>
                                </div>
                            </fieldset>
                        </form>
                    </template>
                </transition>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'
    import { mapState, mapActions } from 'vuex'
    import Icon from '../../vue-commons/components/Icon.vue'
    import 'animate.css/animate.css'

    export default {
        components: {
            'icon-app': Icon,
        },
        data() {
            return {
                activeReload: false,
                payLiquidation: false,
            }
        },
        computed: {
            rentalTotalAmount() {
                return this.rental.cottage_price * this.rental.total_days;
            },
            reservaAmount() {
                return 30 / 100 * this.rentalTotalAmount;
            },
            finalAmountWithDeductions() {
                let total = this.rentalTotalAmount;
                let reserva = this.reservaAmount;
                let deductions = this.rental.deductions || 0;
                return (total - reserva - deductions).toFixed(2);
            },
            defineOwner() {
                return this.rental.user ? this.rental.user.lastname + ', ' + this.rental.user.name : this.rental.passenger.lastname + ', ' + this.rental.passenger.name;
            },
            toggleIcon() {
                return this.queryFinished ? 'credit-card' : 'spinner';
            },
            addAditionalClasses() {
                return this.queryFinished ? '' : 'fa-spin fa-fw';
            },
            ...mapState('orders', {
                rental: state => state.data.rental
            }),
            ...mapState('auth', {
                queryFinished: state => state.xhr.queryFinished
            })
        },
        methods: {
            totalAmount(order) {
                let final = 0;

                for (let detail of order.orders_detail) {
                    final += (+detail.quantity * detail.food.price);
                }

                return final;
            },
            totalQuantity(order) {
                let final = 0;

                for (let detail of order.orders_detail) {
                    final += (+detail.quantity);
                }

                return final;
            },
            changeReserva() {
                this.activeReload = true;
                EventBus.$emit('change-reserva');
                this.activeReload = false;
            },
            toggleCaret(bool) {
                return bool ? 'caret-down' : 'caret-right';
            },
            sendLiquidation() {

            }
        },
        filters: {
            displayArgDate(date) {
                if (!moment.isMoment(date) && typeof date === 'string') {
                    if (date.indexOf('/') > 0) {
                        return moment(date, 'DD/MM/YYYY').format('DD/MM/YYYY');
                    } else if (date.indexOf('-') > 0) {
                        return moment(date, 'YYYY-MM-DD').format('DD/MM/YYYY');
                    }
                } else {
                    return date.format('DD/MM/YYYY');
                }
            }
        },
        created() {
            for (let order of this.rental.orders) {
                this.$set(order, 'show', false);
            }
        },
        mounted() {
        },
    }
</script>

<style>
    .btn-frm {
        padding-top: 15px;
        padding-bottom: 25px;
    }
</style>