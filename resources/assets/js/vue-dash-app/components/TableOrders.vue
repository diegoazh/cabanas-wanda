<template>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Orden</th>
                <th>Cabaña</th>
                <th>Se&ntilde;a</th>
                <th>Fecha de se&ntilde;a</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(orders, index) in pagination.data">
                <td><icon-app iconImage="hashtag"></icon-app> {{ rowNumber(index) }}</td>
                <td><span class="text-to-14px label label-warning"><icon-app iconImage="home"></icon-app> {{ orders.rental.cottage.name }}</span></td>
                <td>
                    <span class="text-to-14px label label-primary" v-if="!orders.edit">
                        <icon-app iconImage="dollar"></icon-app> {{ orders.senia }}
                    </span>
                    <sup>
                        <a role="button" @click.prevent="orders.edit = true; trash.senia = orders.senia;" v-tooltip.right="'Editar seña'" v-if="!orders.edit" class="cursorPointer">
                            <icon-app iconImage="edit"></icon-app>
                        </a>
                    </sup>
                    <form @submit.prevent="" class="form-inline" v-if="orders.edit">
                        <div class="form-group">
                            <label for="seniaOrder" class="sr-only">Se&ntilde;a: </label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-addon"><icon-app iconImage="dollar"></icon-app></div>
                                <input type="number" name="seniaOrder" id="seniaOrder" class="form-control" v-model="trash.senia">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-default btn-sm" @click.prevent="orders.edit = false; trash.senia = '';">Cancelar</button>
                                <button class="btn btn-primary btn-sm" @click.prevent="saveNewSenia(orders)">Actualizar</button>
                            </div>
                        </div>
                    </form>
                </td>
                <td><span class="text-to-14px label label-default">{{ orders.senia_date | DateArg }}</span></td>
                <td>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <button class="btn btn-info" v-tooltip.left="'Ver pedido ' + rowNumber(index) + ' cabaña ' + orders.rental.cottage.name" data-toggle="modal" data-target="#b3-modal-id" @click.prevent="findOrder(orders.id)">
                                <icon-app iconImage="eye"></icon-app>
                            </button>
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="5"></td>
            </tr>
            </tfoot>
        </table>
        <modal-app modalSize="lg" :modalTitle="modalAppTitle" :onModalHidden="clearOrder" :actionBtnSave="saveNewInfo" iconBtnSave="save" iconBtnClose="times">
            <div class="container-fluid" v-if="order">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h2 class="text-center">
                            Pedido caba&ntilde;a <span class="label label-info">{{ order.rental.cottage.name }}</span>
                            <br>
                            <small>
                                <span :class="['text-uppercase', 'label', setClassState(order.state)]" v-if="!editState">{{ order.state | correctState }}</span>&nbsp;
                                <a role="button" @click.prevent="editState = true; trash.state = order.state;" v-tooltip.hover="'Editar estado'" v-if="!editState"><icon-app iconImage="edit"></icon-app></a>
                                <form @submit.prevent="" class="form-inline" v-if="editState">
                                    <div class="form-group">
                                        <label for="state" class="sr-only">Estado: </label>
                                        <div class="input-group">
                                            <div class="input-group-addon">Estado</div>
                                            <select name="state" id="state" class="form-control" v-model="trash.state">
                                                <option value="pendiente" :selected="order.state === 'pendiente'">Pendiente</option>
                                                <option value="seniado" :selected="order.state === 'seniado'">Señada</option>
                                                <option value="pagado" :selected="order.state === 'pagado'">Pagada</option>
                                                <option value="cancelado" :selected="order.state === 'cancelado'">Cancelada</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-default" @click.prevent="editState = false; trash.state = '';">Cancelar</button>
                                            <button class="btn btn-primary" @click.prevent="saveNewState">Actualizar</button>
                                        </div>
                                    </div>
                                </form>
                            </small>
                        </h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Orden</th>
                                    <th>Plato</th>
                                    <th>Tipo</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Total</th>
                                    <th>Fecha entrega</th>
                                    <th>Estado del plato</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(detail, index) in order.orders_detail">
                                    <td>
                                        <icon-app iconImage="hashtag"></icon-app> {{ index + 1 }}
                                    </td>
                                    <td>
                                        <span class="label label-primary"><icon-app iconImage="cutlery"></icon-app> {{ detail.food.name }}</span>
                                    </td>
                                    <td>
                                        <span :class="['label', setClassType(detail.food.type)]">{{ detail.food.type }}</span>
                                    </td>
                                    <td>
                                        <span class="label label-info">{{ detail.quantity }}</span>
                                    </td>
                                    <td>
                                        <span class="label label-warning"><icon-app iconImage="dollar"></icon-app> {{ detail.food.price }}</span>
                                    </td>
                                    <td>
                                        <span class="label label-danger">
                                            <icon-app iconImage="dollar"></icon-app> {{ (detail.quantity * detail.food.price).toFixed(2) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="label label-default">{{ detail.delivery | DateArg('YYYY-MM-DD', 'DD/MM/YYYY') }}</span>
                                    </td>
                                    <td>
                                        <span :class="['label', setClassState(detail.state)]" v-if="!detail.edit">{{ detail.state | correctState }}</span>
                                        <a role="button" @click.prevent="detail.edit = true; trash.stateFood = detail.state;" v-tooltip.hover="'Editar estado'" v-if="!detail.edit"><icon-app iconImage="edit"></icon-app></a>
                                        <form @submit.prevent="" class="form-inline" v-if="detail.edit">
                                            <div class="form-group">
                                                <label for="stateFood" class="sr-only">Estado: </label>
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-addon">Estado</div>
                                                    <select name="state" id="stateFood" class="form-control" v-model="trash.stateFood">
                                                        <option value="pendiente" :selected="detail.state === 'pendiente'">Pendiente</option>
                                                        <option value="preparandose" :selected="detail.state === 'preparandose'">Preparandose</option>
                                                        <option value="entregado" :selected="detail.state === 'entregado'">Entregado</option>
                                                        <option value="cancelado" :selected="detail.state === 'cancelado'">Cancelado</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-default btn-sm" @click.prevent="detail.edit = false; trash.stateFood = '';">Cancelar</button>
                                                    <button class="btn btn-primary btn-sm" @click.prevent="saveNewStateFood(detail)">Actualizar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="8"></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </modal-app>
    </div>
</template>

<script>
    import VueNoti from 'vue-notifications';
    import { mapState, mapActions } from 'vuex';
    import Icon from '../../vue-commons/components/Icon.vue';
    import Modal from '../../vue-commons/components/Modal.vue';

    export default {
        components: {
            'icon-app': Icon,
            'modal-app': Modal
        },
        data() {
            return {
                order: null,
                modalAppTitle: '',
                editState: false,
                trash: {
                    senia: 0,
                    state: '',
                    stateFood: ''
                }
            }
        },
        computed: {
            ...mapState('dash', {
                pagination: state => state.data.pagination,
                page: state => state.page,
            }),
        },
        methods: {
            rowNumber(index) {
                let adition = (this.page - 1) * 15;
                return index + 1 + adition;
            },
            setClassState(state) {
                let classString = '';

                switch (state) {
                    case 'pendiente': classString = 'label-warning';
                        break;
                    case 'seniado': classString = 'label-info';
                        break;
                    case 'pagado': classString = 'label-success';
                        break;
                    case 'preparandose': classString = 'label-info';
                        break;
                    case 'entregado': classString = 'label-success';
                        break;
                    case 'cancelado': classString = 'label-danger';
                        break;
                }

                return classString;
            },
            setClassType(type) {
                let classType = '';

                switch (type) {
                    case 'desayuno': classType = 'label-desayuno';
                        break;
                    case 'almuerzo': classType = 'label-almuerzo';
                        break;
                    case 'merienda': classType = 'label-merienda';
                        break;
                    case 'cena': classType = 'label-cena';
                        break;
                }

                return classType;
            },
            clearOrder() {
                this.order = null;
                this.editState = false;
                this.trash.state = '';
                this.trash.stateFood = '';
                this.modalAppTitle = '';
            },
            saveNewSenia(order) {
                this.order = order;
                this.order.senia = this.trash.senia;
                order.edit = false;
                this.trash.senia = 0;
                this.saveNewInfo();
                this.order = null;
            },
            saveNewState() {
                this.order.state = this.trash.state;
                this.editState = !this.editState;
                this.trash.state = '';
            },
            saveNewStateFood(detail) {
                let index = this.order.orders_detail.findIndex((element) => element.id === detail.id);
                this.order.orders_detail[index].state = this.trash.stateFood;
                detail.edit = !detail.edit;
                this.trash.stateFood = '';
            },
            findOrder(id) {
                this.rentalsOrOrdersForId({
                    isRentals: false,
                    id: id
                }).then(order => {
                    order.orders_detail.forEach(detail => this.$set(detail, 'edit', false));
                    this.order = order;
                    this.modalAppTitle = 'Detalle pedido, cabaña ' + this.order.rental.cottage.name;
                    VueNoti.success({
                        title: 'OK!',
                        message: 'Orden cargada con éxito',
                        timeout: 3000
                    });
                }).catch(error => {
                    VueNoti.error(error);
                });
            },
            saveNewInfo() {
                this.updateOrder({
                    id: this.order.id,
                    order_senia: +this.order.senia,
                    order_state: this.order.state,
                    orders_detail: this.order.orders_detail
                }).then(response => {
                    if (/sin cambios/.test(response.message.toLowerCase())) {
                        response.title = '¡Sin actualización!';
                        VueNoti.warn(response);
                    } else {
                        VueNoti.success(response);
                    }
                    window.EventBus.$emit('page-change', this.page);
                }).catch(error => {
                    VueNoti.error(error);
                });
                window.jQuery('#b3-modal-id').modal('hide');
            },
            ...mapActions('dash', ['rentalsOrOrdersForId', 'updateOrder'])
        },
        filters: {
            correctState(value) {
                if (!value || typeof value !== 'string') return;
                if (/seniado/.test(value.toLowerCase())) {
                    return 'señada';
                }
                return value;
            }
        },
        created() {
        },
        mounted() {
        }
    }
</script>

<style>
    .text-to-14px {
        font-size: 14px;
    }
    .label-desayuno{
        background-color: #DBF9F3;
        color: #333333;
        border: solid 1px #333333;
    }
    .label-almuerzo{
        background-color: #CBE9FC;
        color: #333333;
        border: solid 1px #333333;
    }
    .label-merienda{
        background-color: #CBD5FC;
        color: #333333;
        border: solid 1px #333333;
    }
    .label-cena{
        background-color: #DECBFC;
        color: #333333;
        border: solid 1px #333333;
    }
</style>