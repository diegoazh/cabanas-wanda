<template>
    <div class="row">
        <div class="col-12 col-md-12">
            <button class="btn btn-info btn-sm float-right mt-1 mr-1" @click="changeReserva">
                <icon-app iconImage="sync" :aditionalClasses="activeReload ? 'fa-spin fa-fw' : ''"></icon-app>
                Cambiar reserva
            </button>
            <h2 class="text-center py-3 bg-dark text-light rounded">Reserva</h2>
            <h3 id="details_reservation" class="text-center">
                Titular: <span class="badge badge-info">{{ ownerNames }}</span> |
                Cabaña: <span class="badge badge-default">{{ `${rental.cottage.name}` }}</span> |
                <icon-app iconImage="hashtag"></icon-app>
                <span class="badge badge-default">{{ `${rental.cottage.number}` }}</span>
            </h3>
            <br>
            <h4 class="text-center">Desde: <span class="badge badge-success">{{ rental.dateFrom | argentineDate
                }} 10:00:00</span> | Hasta: <span class="badge badge-danger">{{ rental.dateTo | argentineDate }} 10:00:00</span></h4>
            <hr>
            <div class="row">
                <div class="col-12">
                    <caption class="text-right float-right">
                        <a href="#" class="btn btn-danger btn-sm text-light" role="button" data-toggle="modal"
                           data-target="#aclaraciones-pedidos">
                            <icon-app iconImage="exclamation-triangle"></icon-app>
                            Por favor tenga en cuenta lo siguiente...
                        </a>
                    </caption>
                </div>
            </div>
            <h3 class="text-right">
                <icon-app iconImage="shopping-basket"></icon-app>
                <span class="badge badge-info img-circle">{{ totalQuantity }}</span>
                <icon-app iconImage="money"></icon-app>
                <span class="badge badge-warning img-circle"><icon-app iconImage="dollar-sign"></icon-app> {{ totalAmount }}</span>
            </h3>
        </div>
        <div class="col-12 col-md-12">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="nav-item">
                    <a class="nav-link active" href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab" @click="savePreviousPage('desayuno')">Desayuno</a>
                </li>
                <li role="presentation" class="nav-item">
                    <a class="nav-link" href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab" @click="savePreviousPage('almuerzo')">Almuerzo</a>
                </li>
                <li role="presentation" class="nav-item">
                    <a class="nav-link" href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab" @click="savePreviousPage('merienda')">Merienda</a>
                </li>
                <li role="presentation" class="nav-item">
                    <a class="nav-link" href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab" @click="savePreviousPage('cena')">Cena</a>
                </li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" :class="['tab-pane', {'active': number === 1}]" :id="'tab'+number" v-for="number in 4">
                   <template v-if="notAvailableOrder(number)">
                     <div class="alert alert-info text-center">
                       <h3 class="text-center"><icon-app iconImage="info-circle"></icon-app> No es posible realizar este pedido.</h3>
                     </div>
                   </template>
                   <template v-else>
                     <table class="table table-striped">
                      <thead class="thead bg-dark text-light">
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
                                    <icon-app type-icon="r" :iconImage="food.checked ? 'check-square' : 'square'"
                                              :aditionalClasses="food.checked ? 'text-primary' : 'text-default'"></icon-app>
                                </p>
                            </td>
                            <td>{{ food.name }}</td>
                            <td>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend date-piker">
                                            <div class="input-group-text">
                                              <icon-app iconImage="calendar"></icon-app>
                                            </div>
                                        </div>
                                        <date-picker placeholder="Seleccione la fecha..."
                                                     :config="defConfDtp(rental, food)"
                                                     :id="'delivery' + index"
                                                     :name="'delivery' + index"
                                                     value=""
                                                     v-model="food.delivery"
                                                     @dp-show="fireReplacesInShowDp(`#delivery${index}`)"></date-picker>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <icon-app iconImage="dollar-sign"></icon-app>
                                {{ food.price }}
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend date-piker">
                                            <div class="input-group-text">
                                              <icon-app iconImage="hashtag"></icon-app>
                                            </div>
                                        </div>
                                        <input type="number" :id="'cantidad'+index" :name="'cantidad'+index"
                                               class="form-control" placeholder="Seleccione la cantidad..."
                                               v-model="food.quantity">
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
                                  <span class="badge badge-info img-circle">{{ totalQuantity }}</span>
                                  <icon-app iconImage="money"></icon-app>
                                  <span class="badge badge-warning img-circle"><icon-app
                                          iconImage="dollar-sign"></icon-app> {{ totalAmount }}</span>
                              </h3>
                              <div class="row justify-content-center">
                                  <pagination for="orders" :records="quantityForType(number)" :per-page="itemsPerPage"
                                              :chunk="7" :vuex="true"
                                              count-text="Mostrando {from} a {to} de {count} items|{count} items|Un item"></pagination>
                              </div>
                          </td>
                      </tr>
                      </tfoot>
                  </table>
                  </template>
                </div>
            </div>
            <div class="text-center padding-bottom-20">
                <button class="btn btn-outline-success btn-lg" @click="btnCloseOrder">
                    <icon-app iconImage="handshake"></icon-app>
                    Cerrar pedido
                </button>
            </div>
            <modal-app modalTitle="Aclaraciones de la cocina" modalId="aclaraciones-pedidos" :showBtnSave="false" modalHeaderClasses="bg-info text-light" modalFooterClasses="bg-light" iconBtnClose="times" typeBtnClose="btn-outline-secondary">
                <ul>
                    <li>El desayuno se sirve hasta las 10:00 hs</li>
                    <li>El almuerzo se sirve desde las 12:00 hs hasta las 15:00 hs</li>
                    <li>La merienda se sirve desde las 17:00 hs hasta las 19:00 hs</li>
                    <li>La cena se sirve desde las 21:00 hs hasta las 23:00 hs</li>
                    <li>Debe indicar la fecha en la que debe ser entregado el pedido</li>
                    <li>La cocina cierra a las 23:00 hs</li>
                    <li>
                        Los sábados solo se entregarán pedidos realizados previamente, ya que la cocina inicia a las 19:30 hs
                    </li>
                </ul>
            </modal-app>
        </div>
    </div>
</template>

<script>
    import VueNoti from 'vue-notifications'
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
            ownerNames() {
                return `${this.rental.user.name}, ${this.rental.user.lastname}`;
            },
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
                orderToEdit: state => state.data.orderToEdit
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
                            this.filterFoodType(this.foods)
                                .then(this.filterItemsToEdit());
                        })
                        .catch(error => {
                            // console.log(error);
                        });
                }

            },
            filterFoodType(foods) {
                return new Promise((resolve, reject) => {
                    let foodType = [];
                    let types = ['desayuno', 'almuerzo', 'merienda', 'cena'];

                    for (let food of foods) {
                        this.$set(food, 'checked', false);
                        this.$set(food, 'quantity', 1);
                        this.$set(food, 'delivery', null);
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
                    resolve();
                });
            },
            filterItemsToEdit() {
                return new Promise((resolve, reject) => {
                    if (this.orderToEdit && window.localStorage.getItem('orders_detail')) {
                        let comidas = [this.desayunos, this.almuerzos, this.meriendas, this.cenas];
                        let orders = JSON.parse(window.localStorage.getItem('orders_detail'));
                        comidas.forEach((comida, index, comidas) => {
                            orders.forEach((order, inde, orders) => {
                                comida.forEach((ele, ind, arr) => {
                                    if (order.food.id === ele.id) {
                                        ele.delivery = order.delivery;
                                        ele.quantity = order.quantity;
                                        this.toggelAddRemoveFood(ele);
                                    }
                                });
                            });
                        });

                        this.setDesayunos(comidas[0]);
                        this.setAlmuerzos(comidas[1]);
                        this.setMeriendas(comidas[2]);
                        this.setCenas(comidas[3]);
                    }
                    window.localStorage.removeItem('orders_detail');
                    resolve();
                });
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

                let pageTo = this.page * this.itemsPerPage; // TODO (Diego) quince, luego pasar a variable
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
            defConfDtp(rental, food) {
                /**
                 * TODO (Diego) Encontrar la manera de que el evento se dispare solo para ese picker no para todos.
                 * Eso es lo que demora el show del picker.
                 * */
                let min = moment(moment(rental.dateFrom + ' 10:00:00', 'YYYY-MM-DD HH:mm:ss').format('DD/MM/YYYY'), 'DD/MM/YYYY');
                return {
                    locale: 'es',
                    format: 'DD/MM/YYYY',
                    minDate: min.isBefore(moment.now()) ? moment(moment().add(3, 'h').format('DD/MM/YYYY'), 'DD/MM/YYYY') : min,
                    maxDate: food.type === 'desayuno' ? moment(moment(rental.dateTo + ' 23:00:00', 'YYYY-MM-DD HH:mm:ss').format('DD/MM/YYYY'), 'DD/MM/YYYY') : moment(moment(rental.dateTo + ' 23:00:00', 'YYYY-MM-DD HH:mm:ss').subtract(1, 'd').format('DD/MM/YYYY'), 'DD/MM/YYYY')
                }
            },
            notAvailableOrder(number) {
              let max = moment(this.rental.dateTo + ' 10:00:00', 'YYYY-MM-DD HH:mm:ss');
              return number === 1 ? moment().isAfter(max) : moment().isAfter(max.subtract(1, 'd'));
            },
            fireReplacesInShowDp(id) {
                window.jQuery('.table-condensed').removeClass('table-condensed').addClass('table-sm');
                //window.jQuery('.table-sm > thead').addClass('bg-dark text-light');
            },
            findInOrders(food) {
                this.orders.find((element) => {
                    return element.name === food.name;
                });
            },
            toggelAddRemoveFood(food) {
                if (!food.delivery) {
                    VueNoti.warn({
                        title: 'SIN FECHA',
                        message: 'Por favor seleccione la fecha en la que desea la entrega del plato. Muchas gracias.',
                        useSwal: true
                    });
                    return;
                }
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
