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
                    <td>{{ defineOwner }}</td>
                    <th scope="col">Estado</th>
                    <td>{{ rental.state }}</td>
                    <th scope="col">Fecha de realización</th>
                    <td>{{ rental.created_at | displayArgDate }}</td>
                </tr>
                <tr>
                    <th scope="col">Cabaña</th>
                    <td>{{ rental.cottage.name }}</td>
                    <th scope="col">Número</th>
                    <td>{{ rental.cottage.number }}</td>
                    <th scope="col">Precio</th>
                    <td><icon-app iconImage="dollar"></icon-app> {{ rental.cottage_price }}</td>
                </tr>
                <tr>
                    <th scope="col">Desde</th>
                    <td>{{ rental.dateFrom | displayArgDate }}</td>
                    <th scope="col">Hasta</th>
                    <td>{{ rental.dateTo | displayArgDate }}</td>
                    <th scope="col">Cantidad de dias</th>
                    <td>{{ rental.total_days }}</td>
                </tr>
                <tr>
                    <th scope="col">Monto total</th>
                    <td><icon-app iconImage="dollar"></icon-app> {{ rentalTotalAmount }}</td>
                    <th scope="col">Monto de reserva</th>
                    <td><icon-app iconImage="dollar"></icon-app> {{ reservaAmount }}</td>
                    <th scope="col">Vto. pago de reserva</th>
                    <td>{{ rental.dateReservationPayment | displayArgDate }}</td>
                </tr>
                <tr>
                    <th scope="col">Promocion</th>
                    <td>{{ rental.promotion ? rental.promotion.name : 'Sin promoción' }}</td>
                    <th scope="col">Descuento</th>
                    <td><icon-app iconImage="dollar"></icon-app> {{ rental.deductions || 0 }}</td>
                    <th scope="col">Monto restante</th>
                    <td><icon-app iconImage="dollar"></icon-app> {{ finalAmountWithDeductions }}</td>
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
                            {{ order.show ? 'Ocultar detalle' : 'Mostrar detalle' }} <icon-app :iconImage="toggleCaret(order.show)"></icon-app>
                        </button>
                        Pedido {{ index + 1 }}
                    </th>
                </tr>
                <tr>
                    <th scope="col">Fecha y Estado</th>
                    <td>{{ order.created_at | displayArgDate }}</td>
                    <td>{{ order.state }}</td>
                    <th scope="col">Seña</th>
                    <td><icon-app iconImage="dollar"></icon-app> {{ order.senia || 0 }}</td>
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
                <tr class="danger">
                    <td>Monto final</td>
                    <td></td>
                    <td>{{ totalQuantity }}</td>
                    <td></td>
                    <td><icon-app iconImage="dollar"></icon-app> {{ totalAmount }}</td>
                </tr>
                </tfoot>
            </table>
            <div class="text-center">
                <button id="btn-liquidation" class="btn btn-lg btn-success" @click="">
                    <b><icon-app :iconImage="toggleIcon" :aditionalClasses="addAditionalClasses"></icon-app> Liquidar saldo</b>
                </button>
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
            'icon-app': Icon
        },
        data() {
            return {
                activeReload: false,
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
            totalAmount() {
                let final = 0;

                for (let order of this.rental.orders) {
                    for (let detail of order.orders_detail) {
                        final += (+detail.quantity * detail.food.price);
                    }
                }

                return final;
            },
            totalQuantity() {
                let final = 0;

                for (let order of this.rental.orders) {
                    for (let detail of order.orders_detail) {
                        final += (+detail.quantity);
                    }
                }


                return final;
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
            changeReserva() {
                this.activeReload = true;
                EventBus.$emit('change-reserva');
                this.activeReload = false;
            },
            toggleCaret(bool) {
                return bool ? 'caret-down' : 'caret-right';
            },
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
    #btn-liquidation {
        margin-bottom: 20px;
    }
</style>