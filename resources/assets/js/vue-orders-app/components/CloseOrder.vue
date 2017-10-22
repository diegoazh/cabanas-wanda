<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <button class="btn btn-info pull-right" @click="backToItems">
                <icon-app iconImage="cart-plus"></icon-app> <b>Añadir items</b> <icon-app iconImage="mail-reply"></icon-app>
            </button>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr class="dafault">
                        <th>Fecha de entrega</th>
                        <th>Plato</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="order in orders">
                        <td>{{order.delivery | displayArgDate}}</td>
                        <td>{{order.name}}</td>
                        <td>{{order.quantity}}</td>
                        <td><icon-app iconImage="dollar"></icon-app> {{order.price}}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="danger">
                        <td>Monto final</td>
                        <td></td>
                        <td>{{totalQuantity}}</td>
                        <td><icon-app iconImage="dollar"></icon-app> {{totalAmount}}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</template>

<script>
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
            ...mapState('orders', {
                orders: state => state.data.orders
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
            ...mapActions('orders', ['setCloseOrder'])
        },
        filters: {
            displayArgDate(date) {
                let d = null;

                if (date.indexOf('/') > 0) {
                    d = moment(date, 'DD/MM/YYYY');
                }

                return d.format('DD/MM/YYYY');
            }
        },
        created() {},
        mounted() {
            this.hasOrder();
        }
    }
</script>

<style></style>