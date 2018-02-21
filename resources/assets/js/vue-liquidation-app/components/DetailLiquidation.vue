<template>
    <div class="row" v-if="!liquidationOk">
        <div class="col-12 col-md-12 mb-3">
            <button class="btn btn-outline-secondary btn-sm float-right" @click="changeReserva">
                <icon-app iconImage="refresh" :aditionalClasses="activeReload ? 'fa-spin fa-fw' : ''"></icon-app>
                Cambiar reserva
            </button>
        </div>
        <div class="col-12 col-md-12">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th colspan="6" class="text-center">Reserva</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Nombre y apellido</th>
                        <td><span class="badge badge-primary">{{ defineOwner }}</span></td>
                        <th scope="row">Estado</th>
                        <td><span class="badge badge-info text-capitalize">{{ rental.state }}</span></td>
                        <th scope="row">Fecha de realización</th>
                        <td><span class="badge badge-secondary">{{ rental.created_at | displayArgDate }}</span></td>
                    </tr>
                    <tr>
                        <th scope="row">Cabaña</th>
                        <td><span class="badge badge-warning">{{ rental.cottage.name }}</span></td>
                        <th scope="row">Número</th>
                        <td><span class="badge badge-secondary">{{ rental.cottage.number }}</span></td>
                        <th scope="row">Precio</th>
                        <td><span class="badge badge-warning"><icon-app iconImage="dollar-sign"></icon-app> {{ rental.cottage_price }}</span></td>
                    </tr>
                    <tr>
                        <th scope="row">Desde</th>
                        <td><span class="badge badge-info">{{ rental.dateFrom | displayArgDate }}</span></td>
                        <th scope="row">Hasta</th>
                        <td><span class="badge badge-info">{{ rental.dateTo | displayArgDate }}</span></td>
                        <th scope="row">Cantidad de dias</th>
                        <td><span class="badge badge-primary">{{ rental.total_days }}</span></td>
                    </tr>
                    <tr>
                        <th scope="row">Monto total</th>
                        <td><span class="badge badge-danger"><icon-app iconImage="dollar-sign"></icon-app> {{ rentalTotalAmount }}</span></td>
                        <th scope="row">Monto de reserva</th>
                        <td><span class="badge badge-success"><icon-app iconImage="dollar-sign"></icon-app> {{ reservaAmount }}</span></td>
                        <th scope="row">Vto. pago de reserva</th>
                        <td><span class="badge badge-secondary">{{ rental.dateReservationPayment | displayArgDate }}</span></td>
                    </tr>
                    <tr>
                        <th scope="row">Promocion</th>
                        <td><span class="badge badge-info">{{ rental.promotion ? rental.promotion.name : 'Sin promoción' }}</span></td>
                        <th scope="row">Descuento</th>
                        <td><span class="badge badge-success"><icon-app iconImage="dollar-sign"></icon-app> {{ (+rental.deductions || 0).toFixed(2) }}</span></td>
                        <th scope="row">Monto restante</th>
                        <td><span class="badge badge-danger"><icon-app iconImage="dollar-sign"></icon-app> {{ finalAmountWithDeductions }}</span></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="bg-warning text-dark">
                        <th scope="row" colspan="5">Seña</th>
                        <td><span class="badge badge-success"><icon-app iconImage="minus"></icon-app> <icon-app iconImage="dollar-sign"></icon-app> {{ reservaAmount }}</span></td>
                    </tr>
                    <tr :class="{'bg-danger text-white': !rental.dateFinalPayment, 'bg-success': rental.dateFinalPayment}">
                        <th scope="row" colspan="4">{{ rental.dateFinalPayment ? 'Pagado' : 'Saldo final'}}</th>
                        <td><span class="badge badge-secondary">{{ rental.dateFinalPayment | displayArgDate }}</span></td>
                        <td>
                            <span :class="['label', {'label-danger': !rental.dateFinalPayment, 'label-success': rental.dateFinalPayment}]">
                                <icon-app iconImage="dollar-sign"></icon-app> {{ (finalAmountWithDeductions - reservaAmount).toFixed(2) }}
                            </span>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <table class="table table-striped" v-for="(order, index) in rental.orders">
                <thead>
                    <tr class="bg-dark text-light">
                        <th colspan="6" class="text-center">
                            <button :class="['pull-right', 'btn', 'btn-sm', {'btn-info': !order.show, 'btn-warning': order.show}]" @click="order.show = !order.show">
                                <icon-app :iconImage="toggleCaret(order.show)"></icon-app> {{ order.show ? 'Ocultar detalle' : 'Mostrar detalle' }}
                            </button>
                            Pedido {{ index + 1 }}
                        </th>
                    </tr>
                    <tr>
                        <th scope="col" class="bg-secondary text-white">Fecha</th>
                        <td colspan="2" class="text-center"><span class="badge badge-secondary">{{ order.created_at | displayArgDate }}</span></td>
                        <th scope="col" class="bg-secondary text-white">Estado</th>
                        <td colspan="2" class="text-center"><span class="badge badge-warning text-capitalize">{{ order.state }}</span></td>
                    </tr>
                    <tr class="bg-secondary text-white">
                        <th>Fecha de entrega</th>
                        <th>Plato</th>
                        <th>Categoría</th>
                        <th>Cantidad</th>
                        <th><icon-app iconImage="dollar-sign"></icon-app>/unidad</th>
                        <th><icon-app iconImage="dollar-sign"></icon-app> total por plato</th>
                    </tr>
                </thead>
                <transition name="slide-fade"
                            enter-active-class="animated bounceIn"
                            leave-active-class="animated bounceOut">
                    <tbody v-if="order.show">
                        <tr v-for="item in order.orders_detail">
                            <td>{{ item.delivery | displayArgDate }}</td>
                            <td>{{ item.food.name }}</td>
                            <td><span class="badge badge-info text-capitalize">{{ item.food.type }}</span></td>
                            <td>{{ item.quantity }}</td>
                            <td><icon-app iconImage="dollar-sign"></icon-app> {{ item.food.price }}</td>
                            <td><icon-app iconImage="dollar-sign"></icon-app> {{ item.food.price * item.quantity }}</td>
                        </tr>
                    </tbody>
                </transition>
                <tfoot>
                    <tr class="bg-info">
                        <th>Monto parcial</th>
                        <td colspan="2"></td>
                        <td>{{ totalQuantity(order) }}</td>
                        <td></td>
                        <td><icon-app iconImage="dollar-sign"></icon-app> {{ totalAmount(order) }}</td>
                    </tr>
                    <tr class="bg-warning">
                        <th>Seña</th>
                        <td colspan="4"></td>
                        <td><icon-app iconImage="minus"></icon-app> <icon-app iconImage="dollar-sign"></icon-app> {{ (+order.senia || 0).toFixed(2) }}</td>
                    </tr>
                    <tr class="bg-danger text-white">
                        <th>Monto final</th>
                        <td colspan="4"></td>
                        <td><icon-app iconImage="dollar-sign"></icon-app> {{ (totalAmount(order) - (order.senia || 0)).toFixed(2) }}</td>
                    </tr>
                </tfoot>
            </table>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th colspan="6" class="text-center">Detalle final</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Reserva</th>
                        <td colspan="5" class="text-right"><icon-app iconImage="dollar-sign"></icon-app> {{ rental.dateFinalPayment ? 0 : (finalAmountWithDeductions - reservaAmount).toFixed(2) }}</td>
                    </tr>
                    <tr v-for="(order, index) in rental.orders">
                        <th scope="row">Pedido {{ index + 1 }}</th>
                        <td colspan="5" class="text-right"><icon-app iconImage="dollar-sign"></icon-app> {{ (totalAmount(order) - (order.senia || 0)).toFixed(2) }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="bg-danger text-white">
                        <th scope="row">Saldo</th>
                        <td colspan="5" class="text-right"><icon-app iconImage="dollar-sign"></icon-app> {{ finalAmountWhitDeductionsAndOrders }}</td>
                    </tr>
                </tfoot>
            </table>
            <div class="text-center btn-frm">
                <transition name="btnFrm-tran"
                            enter-active-class="animated fadeInUp"
                            leave-active-class="animated fadeOutUp">
                    <template v-if="!payLiquidation">
                        <button id="btn-liquidation" class="btn btn-lg btn-outline-success" @click="payLiquidation = !payLiquidation">
                            <b><icon-app :iconImage="toggleIcon" :aditionalClasses="addAditionalClasses"></icon-app> Liquidar saldo</b>
                        </button>
                    </template>
                    <template v-else>
                        <div class="row justify-content-center">
                            <div class="col-8">
                                <form @submit.prevent="sendLiquidation" class="form-inline">
                                    <fieldset>
                                        <legend>Ingrese sus credenciales de administrador</legend>
                                        <div class="form-group form-row">
                                            <label for="admin-email" class="col-form-label sr-only">Email</label>
                                            <div class="input-group mr-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                      <icon-app iconImage="at"></icon-app>
                                                    </div>
                                                </div>
                                                <input type="text" id="admin-email" name="admin-email" class="form-control" v-model="adminEmail">
                                            </div>
                                            <div class="input-group mr-2">
                                                <div class="input-group-prepend">
                                                      <div class="input-group-text">
                                                      <icon-app iconImage="asterisk"></icon-app>
                                                      <icon-app iconImage="asterisk"></icon-app>
                                                      <icon-app iconImage="asterisk"></icon-app>
                                                    </div>
                                                </div>
                                                <input type="password" id="admin-password" name="admin-password" class="form-control" v-model="adminPass">
                                            </div>
                                            <button class="btn btn-outline-primary" role="button" type="submit" :disabled="!adminEmail || !adminPass">
                                                <icon-app :iconImage="queryFinished ? 'credit-card' : 'spinner'" :aditionalClasses="!queryFinished ? 'fa-spin fa-fw' : ''"></icon-app> Liquidar!
                                            </button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </template>
                </transition>
            </div>
        </div>
    </div>
    <div class="row" v-else>
        <div class="col-12 col-md-12 mb-3">
            <button class="btn btn-secondary btn-sm float-right" @click="changeReserva">
                <icon-app iconImage="refresh" :aditionalClasses="activeReload ? 'fa-spin fa-fw' : ''"></icon-app>
                Volver a buscar reserva
            </button>
        </div>
        <div class="col-12 col-md-12">
            <div class="text-center">
                <span class="fa-stack fa-lg fa-5x text-success">
                  <i class="far fa-circle fa-stack-2x"></i>
                  <i class="fa fa-check fa-stack-1x"></i>
                </span>
                <h2 class="h2">La liquidación se realizó correctamente. <br> ¡Muchas gracias por elegirnos!</h2>
            </div>
        </div>
    </div>
</template>

<script>
    import VueNoti from 'vue-notifications'
    import moment from 'moment'
    import { mapState, mapActions } from 'vuex'
    import Icon from '../../vue-commons/components/Icon.vue'

    export default {
        components: {
            'icon-app': Icon,
        },
        data() {
            return {
                activeReload: false,
                payLiquidation: false,
                adminEmail: '',
                adminPass: '',
                liquidationOk: false
            }
        },
        computed: {
            rentalTotalAmount() {
                return (this.rental.cottage_price * this.rental.total_days).toFixed(2);
            },
            reservaAmount() {
                return (30 / 100 * this.rentalTotalAmount).toFixed(2);
            },
            finalAmountWithDeductions() {
                let total = this.rentalTotalAmount;
                let reserva = this.reservaAmount;
                let deductions = this.rental.deductions || 0;
                return (total - reserva - deductions).toFixed(2);
            },
            defineOwner() {
                return `${this.rental.user.lastname}, ${this.rental.user.name}`;
            },
            toggleIcon() {
                return this.queryFinished ? 'credit-card' : 'spinner';
            },
            addAditionalClasses() {
                return this.queryFinished ? '' : 'fa-spin fa-fw';
            },
            finalAmountWhitDeductionsAndOrders() {
                const rental = this.rental.dateFinalPayment ? 0 : +(this.finalAmountWithDeductions - this.reservaAmount).toFixed(2);
                let orders = 0;

                for (let order of this.rental.orders) {
                    orders += this.totalAmount(order) - (+order.senia || 0);
                }

                return rental + orders;
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
                    final += (+detail.quantity * +detail.food.price);
                }

                return final.toFixed(2);
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
                this.liquidationOk = false;
                this.activeReload = false;
            },
            toggleCaret(bool) {
                return bool ? 'caret-down' : 'caret-right';
            },
            sendLiquidation() {
                this.setQueryFinished(false);
                this.sendFinalLiquidation({
                    rental_id: this.rental.id,
                    email: this.adminEmail,
                    password: this.adminPass
                }).then(response => {
                    this.liquidationOk = true;
                    this.setQueryFinished(true);
                    VueNoti.success(response);
                }).catch(error => {
                    this.setQueryFinished(true);
                    VueNoti.error(error);
                });
            },
            ...mapActions('liquidation', ['sendFinalLiquidation']),
            ...mapActions('auth', ['setQueryFinished']),
        },
        filters: {
            displayArgDate(date) {

                if (!date) return

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
