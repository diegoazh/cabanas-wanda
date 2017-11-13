<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <button class="btn btn-info pull-right" @click="backToItems">
                <b><icon-app iconImage="shopping-basket"></icon-app> Editar pedido <icon-app iconImage="mail-reply"></icon-app></b>
            </button>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr class="dafault">
                        <th>Fecha de entrega</th>
                        <th>Plato</th>
                        <th>Cantidad</th>
                        <th><icon-app iconImage="dollar"></icon-app>/unidad</th>
                        <th><icon-app iconImage="dollar"></icon-app> total por plato</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="order in orders">
                        <td>{{order.delivery | displayArgDate}}</td>
                        <td>{{order.name}}</td>
                        <td>{{order.quantity}}</td>
                        <td><icon-app iconImage="dollar"></icon-app> {{order.price}}</td>
                        <td><icon-app iconImage="dollar"></icon-app> {{order.price * order.quantity}}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="danger">
                        <td>Monto final</td>
                        <td></td>
                        <td>{{totalQuantity}}</td>
                        <td></td>
                        <td><icon-app iconImage="dollar"></icon-app> {{totalAmount}}</td>
                    </tr>
                </tfoot>
            </table>
            <div class="text-center">
                <button class="btn btn-lg btn-success" @click="setOrderToSend">
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
                return this.queryFinished ? 'handshake-o' : 'spinner';
            },
            addAditionalClasses() {
                return this.queryFinished ? '' : 'fa-spin fa-fw';
            },
            ...mapState('orders', {
                orders: state => state.data.orders,
                rental: state => state.data.rental
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
                    orders: this.orders
                }).then(response => {
                    VueNoti.success(response);
                    this.setQueryFinished(true);
                    this.setOrders([]);
                    this.setCloseOrder(false);
                    EventBus.$emit('change-reserva');
                }).catch(error => {
                    error.useSwal = true;
                    VueNoti.error(error);
                    this.setQueryFinished(true);
                });
            },
            ...mapActions('orders', ['setCloseOrder', 'sendOrder', 'setOrders']),
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