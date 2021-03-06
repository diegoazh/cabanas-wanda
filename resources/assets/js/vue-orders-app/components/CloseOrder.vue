<template>
    <div class="row">
        <div class="col-12 col-md-12">
            <button class="btn btn-outline-info btn-sm float-right my-3" @click="backToItems">
                <b><icon-app iconImage="shopping-basket"></icon-app> Editar pedido <icon-app iconImage="mail-reply"></icon-app></b>
            </button>
        </div>
        <div class="col-12 col-md-12">
            <table class="table table-striped">
                <thead class="thead bg-dark text-light">
                    <tr>
                        <th>Fecha de entrega</th>
                        <th>Plato</th>
                        <th>Cantidad</th>
                        <th><icon-app iconImage="dollar-sign"></icon-app>/unidad</th>
                        <th><icon-app iconImage="dollar-sign"></icon-app> total por plato</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="order in orders">
                        <td>{{order.delivery | displayArgDate}}</td>
                        <td>{{order.name}}</td>
                        <td>{{order.quantity}}</td>
                        <td><icon-app iconImage="dollar-sign"></icon-app> {{order.price}}</td>
                        <td><icon-app iconImage="dollar-sign"></icon-app> {{order.price * order.quantity}}</td>
                    </tr>
                </tbody>
                <tfoot class="bg-danger text-light">
                    <tr>
                        <td>Monto final</td>
                        <td></td>
                        <td>{{totalQuantity}}</td>
                        <td></td>
                        <td><icon-app iconImage="dollar-sign"></icon-app> {{totalAmount}}</td>
                    </tr>
                </tfoot>
            </table>
            <div class="text-center">
                <button class="btn btn-lg btn-outline-success" @click="setOrderToSend">
                    <b><icon-app :iconImage="toggleIcon" :aditionalClasses="addAditionalClasses"></icon-app> Confirmar pedido</b>
                </button>
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
        data() { return {}},
        computed: {
            totalAmount() {
                let final = 0;

                for (let order of this.orders) {
                    final += (order.quantity * order.price);
                }

                return final;
            },
            totalQuantity() {
                let final = 0;

                for (let order of this.orders) {
                    final += (+order.quantity);
                }

                return final;
            },
            toggleIcon() {
                return this.queryFinished ? 'handshake' : 'spinner';
            },
            addAditionalClasses() {
                return this.queryFinished ? '' : 'fa-spin fa-fw';
            },
            ...mapState('orders', {
                orders: state => state.data.orders,
                rental: state => state.data.rental,
                orderToEdit: state => state.data.orderToEdit,
                orderId: state => state.data.orderId,
            }),
            ...mapState('auth', {
                queryFinished: state => state.xhr.queryFinished
            })
        },
        methods: {
            hasOrder() {
                if (this.orders.length === 0 ) {
                    this.setCloseOrder(false);
                }
            },
            backToItems() {
                this.setCloseOrder(false);
            },
            setOrderToSend() {
                this.setQueryFinished(false);
                this.sendOrder({
                    rental_id: this.rental.id,
                    orders: this.orders,
                    orderToEdit: this.orderToEdit,
                    order_id: this.orderId
                }).then(response => {
                    VueNoti.success(response);
                    this.setQueryFinished(true);
                    this.setOrders([]);
                    this.setCloseOrder(false);
                    this.setOrderToEdit(false);
                    this.setOrderId(null);
                    EventBus.$emit('change-reserva');
                }).catch(error => {
                    error.useSwal = true;
                    VueNoti.error(error);
                    this.setQueryFinished(true);
                });
            },
            ...mapActions('orders', ['setCloseOrder', 'sendOrder', 'setOrders', 'setOrderToEdit', 'setOrderId']),
            ...mapActions('auth', ['setQueryFinished'])
        },
        filters: {
            displayArgDate(date) {
                if (!moment.isMoment(date) && typeof date === 'string') {
                    if (date.indexOf('/') > 0) {
                        return moment(date, 'DD/MM/YYYY').format('DD/MM/YYYY');
                    }
                } else {
                    return date.format('DD/MM/YYYY');
                }
            }
        },
        created() {},
        mounted() {
            this.hasOrder();
        }
    }
</script>

<style></style>
