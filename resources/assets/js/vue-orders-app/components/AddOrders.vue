<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <button class="btn btn-primary btn-xs pull-right" @click="changeReserva"><icon-app iconImage="refresh" :aditionalClasses="activeReload ? 'fa-spin fa-fw' : ''"></icon-app> Cambiar reserva</button>
            <h2 class="text-center">Reserva</h2>
            <h3 id="details_reservation" class="text-center">
                Titular: <span class="label label-info">{{ `${rental.user.name}, ${rental.user.lastname}` }}</span> |
                Cabaña: <span class="label label-default">{{ `${rental.cottage.name}` }}</span> |
                <icon-app iconImage="hashtag"></icon-app>
                <span class="label label-default">{{ `${rental.cottage.number}` }}</span>
            </h3>
            <br>
            <h4 class="text-center">Desde: <span class="label label-success">{{ rental.dateFrom | argentineDate
                }}</span> | Hasta: <span class="label label-danger">{{ rental.dateTo | argentineDate }}</span></h4>
            <hr>
            <div class="row">
                <div class="col-md-3 pull-right">
                    <caption class="text-right">
                        <a class="btn btn-danger btn-xs" role="button" data-toggle="modal" data-target="#aclaraciones-pedidos">
                            <icon-app iconImage="exclamation-triangle"></icon-app> Por favor tenga en cuenta lo siguiente...
                        </a>
                    </caption>
                </div>
            </div>
            <h3 class="text-right">
                <icon-app iconImage="shopping-basket"></icon-app>
                <span class="label label-info img-circle">{{ totalQuantity }}</span>
                <icon-app iconImage="money"></icon-app>
                <span class="label label-warning img-circle"><icon-app iconImage="dollar"></icon-app> {{ totalAmount }}</span>
            </h3>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab"
                                                          @click="savePreviousPage('desayuno')">Desayuno</a></li>
                <li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab"
                                           @click="savePreviousPage('almuerzo')">Almuerzo</a></li>
                <li role="presentation"><a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab"
                                           @click="savePreviousPage('merienda')">Merienda</a></li>
                <li role="presentation"><a href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab"
                                           @click="savePreviousPage('cena')">Cena</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" :class="['tab-pane', {'active': number === 1}]" :id="'tab'+number"
                     v-for="number in 4">
                    <table class="table table-striped table-responsive">
                        <thead>
                        <tr>
                            <th>Estado</th>
                            <th>Plato</th>
                            <th>Fecha de entrega</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Agregar/Quitar</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(food, index) in elementsPerPage(number)">
                            <td>
                                <p>
                                    <icon-app :iconImage="food.checked ? 'check-square-o' : 'square-o'"
                                              :aditionalClasses="food.checked ? 'text-primary' : 'text-default'"></icon-app>
                                </p>
                            </td>
                            <td>{{ food.name }}</td>
                            <td>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon date-piker">
                                            <icon-app iconImage="calendar"></icon-app>
                                        </div>
                                        <date-picker placeholder="Seleccione la fecha..."
                                                     :config="defineConfDateTimePiker(rental)" :id="'delivery'+index"
                                                     :name="'delivery'+index" v-model="food.delivery"></date-picker>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <icon-app iconImage="dollar"></icon-app>
                                {{ food.price }}
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon date-piker">
                                            <icon-app iconImage="hashtag"></icon-app>
                                        </div>
                                        <input type="number" :id="'cantidad'+index" :name="'cantidad'+index"
                                               class="form-control" placeholder="Seleccione la cantidad..." v-model="food.quantity">
                                    </div>
                                </div>
                            </td>
                            <td class="text-right">
                                <button :class="['btn', {'btn-success': !food.checked, 'btn-danger': food.checked}]"
                                        @click="toggelAddRemoveFood(food)">
                                    <icon-app :iconImage="food.checked ? 'minus' : 'plus'"></icon-app>
                                </button>
                            </td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="6" class="text-center">
                                <h3 class="text-right">
                                    <icon-app iconImage="shopping-basket"></icon-app>
                                    <span class="label label-info img-circle">{{ totalQuantity }}</span>
                                    <icon-app iconImage="money"></icon-app>
                                    <span class="label label-warning img-circle"><icon-app
                                            iconImage="dollar"></icon-app> {{ totalAmount }}</span>
                                </h3>
                                <pagination for="orders" :records="quantityForType(number)" :per-page="itemsPerPage"
                                            :chunk="7" :vuex="true"
                                            count-text="Mostrando {from} a {to} de {count} items|{count} items|Un item"></pagination>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="text-center padding-bottom-20">
                <button class="btn btn-success btn-lg" @click="btnCloseOrder"><icon-app iconImage="handshake-o"></icon-app> Cerrar pedido</button>
            </div>
            <modal-app modalTitle="Aclaraciones de la cocina" modalId="aclaraciones-pedidos" :showBtnSave="false">
                <ul>
                    <li>El desayuno se sirve hasta </li>
                    <li>Debe indicar la hora en la que desea que el pedido se entregue</li>
                    <li>La hora mínima para realizar el pedido es con  3 hs de anticipación, otra forma debe hacerlo personalmente en el restaurante</li>
                    <li>El último pedido se entrega a las 23 hs por lo que pudiendo realizarlo hasta las 20 hs</li>
                    <li>Los sábados solo se entregarán pedidos realizados previamente, ya que la cocina inicia a las 19:30 hs</li>
                </ul>
            </modal-app>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'
    import datePicker from 'vue-bootstrap-datetimepicker'
    import {mapState, mapActions} from 'vuex'
    import {Pagination, PaginationEvent} from 'vue-pagination-2';
    import Icon from '../../vue-commons/components/Icon.vue'
    import Modal from '../../vue-commons/components/Modal.vue'

    export default {
        data() {
            return {
                trashPage: {
                    choice: 'desayuno',
                    desayuno: 1,
                    almuerzo: 1,
                    merienda: 1,
                    cena: 1
                },
                activeReload: false,
            }
        },
        mounted() {
            this.checkFoodsInStore();
        },
        components: {
            Pagination,
            PaginationEvent,
            datePicker,
            'icon-app': Icon,
            'modal-app': Modal
        },
        computed: {
            totalAmount() {
                let amount = 0;

                for (let order of this.orders) {
                    amount += (order.price * order.quantity);
                }

                return amount;
            },
            totalQuantity() {
                let quanty = 0;

                for (let order of this.orders) {
                    quanty += (+order.quantity);
                }

                return quanty;
            },
            ...mapState('orders', {
                page: state => state.page,
                rental: state => state.data.rental,
                orders: state => state.data.orders,
                desayunos: state => state.data.desayunos,
                almuerzos: state => state.data.almuerzos,
                meriendas: state => state.data.meriendas,
                cenas: state => state.data.cenas,
                itemsPerPage: state => state.itemsPerPage,
            }),
            ...mapState('food', {
                foods: state => state.data.food,
            })
        },
        methods: {
            checkFoodsInStore() {
                if (this.foods.length === 0) {
                    this.getAllFood()
                        .then(response => {
                            this.filterFoodType(this.foods, this.orders);
                        })
                        .catch(error => {
                            // console.log(error);
                        });
                }

            },
            filterFoodType(foods, orders) {
                let foodType = [];
                let types = ['desayuno', 'almuerzo', 'merienda', 'cena'];

                for (let food of foods) {
                    this.$set(food, 'checked', false);
                    this.$set(food, 'quantity', 1);
                    this.$set(food, 'delivery', moment().add(3, 'h').format('DD/MM/YYYY'));
                }

                for (let i = types.length - 1; i >= 0; i--) {
                    foodType = foods.filter((element, index, array) => {
                        return element.type === types[i];
                    });

                    switch (types[i]) {
                        case 'desayuno':
                            this.setDesayunos(foodType);
                            break;
                        case 'almuerzo':
                            this.setAlmuerzos(foodType);
                            break;
                        case 'merienda':
                            this.setMeriendas(foodType);
                            break;
                        case 'cena':
                            this.setCenas(foodType);
                            break;
                    }
                }
            },
            elementsPerPage(number) {
                let food = [];

                switch (number) {
                    case 1:
                        food = this.desayunos;
                        break;
                    case 2:
                        food = this.almuerzos;
                        break;
                    case 3:
                        food = this.meriendas;
                        break;
                    case 4:
                        food = this.cenas;
                        break;
                }

                let pageTo = this.page * this.itemsPerPage; // quince debería ser una variable
                let pageFrom = (this.page === 1) ? 0 : (this.page - 1) * this.itemsPerPage;

                return food.filter(function (element, index, array) {
                    return index >= pageFrom && index < pageTo;
                });
            },
            quantityForType(number) {
                let quantity = 0;

                switch (number) {
                    case 1:
                        quantity = this.desayunos.length;
                        break;
                    case 2:
                        quantity = this.almuerzos.length;
                        break;
                    case 3:
                        quantity = this.meriendas.length;
                        break;
                    case 4:
                        quantity = this.cenas.length;
                        break;
                }

                return quantity;
            },
            savePreviousPage(tabName) {
                this.trashPage[this.trashPage.choice] = this.page;
                this.pagination(this.trashPage[tabName]);
                this.trashPage.choice = tabName;
            },
            defineConfDateTimePiker(rental) {
                return {
                    locale: 'es',
                    format: 'DD/MM/YYYY',
                    minDate: moment(moment().format('DD/MM/YYYY') + ' 00:00 AM', 'DD/MM/YYYY hh:mm A'),
                    maxDate: moment(moment(rental.dateTo + ' 23:59:59', 'YYYY/MM/DD HH:mm:ss').format('DD/MM/YYYY HH:mm:ss'), 'DD/MM/YYYY HH:mm:ss')
                }
            },
            findInOrders(food) {
                this.orders.find((element) => {
                    return element.name === food.name;
                });
            },
            toggelAddRemoveFood(food) {
                food.checked = !food.checked;
                this.setOrders(food);
            },
            updateQuantity(food) {
                let i = this.orders.findIndex(element => element.name === food.name);
                if (i > 0) {
                    this.orders[i].quantity = +food.quantity;
                }
            },
            changeReserva() {
                this.activeReload = true;
                EventBus.$emit('change-reserva');
                this.activeReload = false;
            },
            btnCloseOrder() {
                this.setCloseOrder(true);
            },
            ...mapActions('orders', ['pagination', 'setOrders', 'setCloseOrder', 'setDesayunos', 'setAlmuerzos', 'setMeriendas', 'setCenas']),
            ...mapActions('food', ['getAllFood']),
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
    #details_reservation span {
        font-size: inherit;
    }
    .padding-bottom-20 {
        padding-bottom: 20px;
    }
</style>