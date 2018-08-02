<template>
    <div class="card">
        <div class="card-header bg-dark text-light">
            <h1 class="text-center"><icon-app iconImage="tachometer-alt"></icon-app> Panel de administración</h1>
        </div>
        <div class="card-body">
            <btn-switch-app :initLeft="seeRentals" textLeft="Reservas" iconTextLeft="handshake" textRight="Pedidos" iconTextRight="utensils" classOnActive="text-primary" classOnInactive="text-muted" :textDeleted="true"></btn-switch-app>
            <div class="col-12 mb-3">
                <ul class="nav nav-pills">
                    <li class="nav-item m-1">
                        <b-form-group>
                            <h5><icon-app iconImage="filter"/> Ordenar por:</h5>
                            <b-form-radio-group id="radioOptions" v-model="order.for" name="radioOptions" buttons button-variant="outline-info">
                                <b-form-radio v-if="seeRentals" value="dateFrom" @change="fireQuery">Fecha desde</b-form-radio>
                                <b-form-radio v-if="seeRentals" value="dateTo" @change="fireQuery">Fecha hasta</b-form-radio>
                                <b-form-radio v-if="seeRentals" value="total_days" @change="fireQuery">Días</b-form-radio>
                                <b-form-radio v-if="seeRentals" value="dateReservationPayment" @change="fireQuery">Vencimiento</b-form-radio>
                                <b-form-radio v-if="!seeRentals" value="cottages.name" @change="fireQuery">Cabaña</b-form-radio>
                                <b-form-radio v-if="!seeRentals" value="orders.senia" @change="fireQuery">Seña</b-form-radio>
                                <b-form-radio v-if="!seeRentals" value="orders.senia_date" @change="fireQuery">Fecha de seña</b-form-radio>
                            </b-form-radio-group>
                        </b-form-group>
                    </li>
                    <li class="nav-item m-1">
                        <b-form-group>
                            <h5><icon-app :iconImage="order.sent === 'asc' ? 'sort-amount-up' : 'sort-amount-down'" /> Sentido:</h5>
                            <b-form-radio-group id="radioSent" v-model="order.sent" name="radioSent" buttons button-variant="outline-warning">
                                <b-form-radio value="asc" @change="fireQuery"><icon-app :iconImage="'sort-amount-up'"/></b-form-radio>
                                <b-form-radio value="desc" @change="fireQuery"><icon-app :iconImage="'sort-amount-down'"/></b-form-radio>
                            </b-form-radio-group>
                        </b-form-group>
                    </li>
                </ul>
            </div>
            <div>
                <template v-if="seeRentals">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a :class="['nav-link', {'active': this.type === 'pendiente'}]" href="#pendientes" aria-controls="pendientes" role="tab" data-toggle="tab" @click="setTypeofQuery('pendiente')">Pendientes</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a :class="['nav-link', {'active': this.type === 'confirmada'}]" href="#confirmadas" aria-controls="confirmadas" role="tab" data-toggle="tab" @click="setTypeofQuery('confirmada')">Confirmadas</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a :class="['nav-link', {'active': this.type === 'en_curso'}]" href="#en_curso" aria-controls="en_curso" role="tab" data-toggle="tab" @click="setTypeofQuery('en_curso')">En curso</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a :class="['nav-link', {'active': this.type === 'cancelada'}]" href="#canceladas" aria-controls="finalizadas_canceladas" role="tab" data-toggle="tab" @click="setTypeofQuery('cancelada')">Canceladas</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a :class="['nav-link', {'active': this.type === 'finalizada'}]" href="#finalizadas" aria-controls="finalizadas" role="tab" data-toggle="tab" @click="setTypeofQuery('finalizada')">Finalizadas</a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active">
                            <table-rentals-app v-if="pagination"></table-rentals-app>
                        </div>
                    </div>
                </template>
                <template v-else>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a :class="['nav-link', {'active': this.type === 'pendiente'}]" href="#pendientes2" aria-controls="pendientes2" role="tab" data-toggle="tab" @click="setTypeofQuery('pendiente')">Pendientes</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a :class="['nav-link', {'active': this.type === 'seniado'}]" href="#seniadas" aria-controls="seniadas" role="tab" data-toggle="tab" @click="setTypeofQuery('seniado')">Señadas</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a :class="['nav-link', {'active': this.type === 'pagado'}]" href="#pagadas" aria-controls="pagadas" role="tab" data-toggle="tab" @click="setTypeofQuery('pagado')">Pagadas</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a :class="['nav-link', {'active': this.type === 'cancelado'}]" href="#canceladas2" aria-controls="canceladas2" role="tab" data-toggle="tab" @click="setTypeofQuery('cancelado')">Canceladas</a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active">
                            <table-orders-app v-if="pagination"></table-orders-app>
                        </div>
                    </div>
                </template>
                <div class="row justify-content-center">
                    <div class="text-center pt-3" v-if="pagination">
                        <pagination for="dash" :records="total" :per-page="per_page" :chunk="pagChunk" :vuex="true"
                                    count-text="Listando {from} a {to} de {count} items|{count} items|Un item">
                        </pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import VueNoti from 'vue-notifications';
    import { mapActions, mapState, mapMutations } from 'vuex';
    import { Pagination } from 'vue-pagination-2';
    import Icon from '../../vue-commons/components/Icon.vue';
    import BtnSwitch from '../../vue-commons/components/BtnSwitch.vue';
    import TableRentals from './TableRentals.vue';
    import TableOrders from './TableOrders.vue';

    export default {
        components: {
            Pagination,
            'icon-app': Icon,
            'btn-switch-app': BtnSwitch,
            'table-rentals-app': TableRentals,
            'table-orders-app': TableOrders,
        },
        data() {
            return {
                pagChunk: 7,
                seeRentals: true,
                type: 'pendiente',
                order: {
                    for: 'dateFrom',
                    sent: 'asc'
                },
                trash: {
                    rentals: 'pendiente',
                    orders: 'pendiente',
                    pendiente: 1,
                    confirmada: 1,
                    en_curso: 1,
                    cancelada: 1,
                    finalizada: 1,
                    pendiente2: 1,
                    seniado: 1,
                    pagado: 1,
                    cancelado: 1,
                    order: {
                        rentals: {
                            for: 'dateFrom',
                            sent: 'asc'
                        },
                        orders: {
                            for: 'cottages.name',
                            sent: 'asc'
                        }
                    }
                }
            }
        },
        computed: {
            ...mapState('dash', {
                pagination: state => state.data.pagination,
                page: state => state.page,
                total: state => state.total,
                per_page: state => state.per_page,
            }),
            ...mapState('auth', {
                token: state => state.xhr.token,
            })
        },
        methods: {
            savePreviousPage() {
                if (this.type === 'pendiente' && this.seeRentals) {
                    this.trash.pendiente = this.page;
                } else if (this.type === 'pendiente' && !this.seeRentals) {
                    this.trash.pendiente2 = this.page;
                } else if (this.type === 'confirmada') {
                    this.trash.confirmada = this.page;
                } else if (this.type === 'en_curso') {
                    this.trash.en_curso = this.page;
                } else if (this.type === 'cancelada') {
                    this.trash.cancelada = this.page;
                } else if (this.type === 'finalizada') {
                    this.trash.finalizada = this.page;
                } else if (this.type === 'seniado') {
                    this.trash.seniado = this.page;
                } else if (this.type === 'pagado') {
                    this.trash.pagado = this.page;
                } else if (this.type === 'cancelado') {
                    this.trash.cancelado = this.page;
                }
            },
            setNewPage() {
                if (this.type === 'pendiente' && this.seeRentals && this.page !== this.trash.pendiente) {
                    this.PAGINATE(this.trash.pendiente);
                } else if (this.type === 'pendiente' && !this.seeRentals && this.page !== this.trash.pendiente2) {
                    this.PAGINATE(this.trash.pendiente2);
                } else if (this.type === 'confirmada' && this.page !== this.trash.confirmada) {
                    this.PAGINATE(this.trash.confirmada);
                } else if (this.type === 'en_curso' && this.page !== this.trash.en_curso) {
                    this.PAGINATE(this.trash.en_curso);
                } else if (this.type === 'cancelada' && this.page !== this.trash.cancelada) {
                    this.PAGINATE(this.trash.cancelada);
                } else if (this.type === 'finalizada' && this.page !== this.trash.finalizada) {
                    this.PAGINATE(this.trash.finalizada);
                } else if (this.type === 'seniado' && this.page !== this.trash.seniado) {
                    this.PAGINATE(this.trash.seniado);
                } else if (this.type === 'pagado' && this.page !== this.trash.pagado) {
                    this.PAGINATE(this.trash.pagado);
                } else if (this.type === 'cancelado' && this.page !== this.trash.cancelado) {
                    this.PAGINATE(this.trash.cancelado);
                } else {
                    window.EventBus.$emit('page-change', this.page);
                }
            },
            savePreviousType() {
                if (this.seeRentals) {
                    this.trash.rentals = this.type;
                    this.trash.order.rentals.for = this.order.for;
                    this.trash.order.rentals.sent = this.order.sent;
                } else {
                    this.trash.orders = this.type;
                    this.trash.order.orders.for = this.order.for;
                    this.trash.order.orders.sent = this.order.sent;
                }
            },
            setNewType(){
                if (this.seeRentals) {
                    this.type = this.trash.rentals;
                    this.order.for = this.trash.order.rentals.for;
                    this.order.sent = this.trash.order.rentals.sent;
                 } else {
                    this.type = this.trash.orders;
                    this.order.for = this.trash.order.orders.for;
                    this.order.sent = this.trash.order.orders.sent;                   
                 }
            },
            setTypeofQuery(newType) {
                this.setPagination(null);
                this.savePreviousPage();
                this.type = newType;
                this.setNewPage();
            },
            fireQuery(page = 1) {
                this.$nextTick(() => {
                    this.rentalsOrOrdersForState({
                        isRentals: this.seeRentals,
                        state: this.type,
                        token: this.token,
                        query: page,
                        order: this.order
                        }).then(() => {
                            VueNoti.success({
                                title: 'OK!',
                                message: 'Data loaded correctly.',
                                timeout: 3000
                            });
                        }).catch(error => {
                            VueNoti.error(error);
                        });
                })
            },
            difineOrderSent() {
                this.order.sent = this.order.sent === 'asc' ? 'desc' : 'asc';
            },
            ...mapMutations('auth', ['setToken']),
            ...mapMutations('dash', ['PAGINATE', 'setPagination']),
            ...mapActions('dash', ['rentalsOrOrdersForState']),
        },
        filters: {},
        created() {
            this.$cookies.isKey('info_one') ? this.setToken(this.$cookies.get('info_one')) : null;

            window.EventBus.$on('change-side', ($event)=> {
                this.setPagination(null);
                this.savePreviousPage();
                this.savePreviousType();
                if (this.seeRentals !== $event) {
                    this.seeRentals = $event;
                    this.setNewType();
                    this.setNewPage();
                }
            });

             this.fireQuery(this.page);
        },
        mounted() {
            window.EventBus.$on('page-change', (page) => {
                this.fireQuery(page);
            });
        }
    }
</script>

<style></style>