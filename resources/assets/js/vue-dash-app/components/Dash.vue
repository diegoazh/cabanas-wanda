<template>
    <div class="panel">
        <div class="panel-heading">
            <h1 class="text-center">Panel de asministración</h1>
        </div>
        <div class="panel-body">
            <btn-switch-app :initLeft="seeRentals" textLeft="Reservas" textRight="Pedidos" classOnActive="text-primary" classOnInactive="text-muted" :textDeleted="true"></btn-switch-app>
            <div>
                <template v-if="seeRentals">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" :class="{'active': this.type === 'pendiente'}">
                            <a href="#pendientes" aria-controls="pendientes" role="tab" data-toggle="tab" @click="setTypeofQuery('pendiente')">Pendientes</a>
                        </li>
                        <li role="presentation" :class="{'active': this.type === 'confirmada'}">
                            <a href="#confirmadas" aria-controls="confirmadas" role="tab" data-toggle="tab" @click="setTypeofQuery('confirmada')">Confirmadas</a>
                        </li>
                        <li role="presentation" :class="{'active': this.type === 'en curso'}">
                            <a href="#en_curso" aria-controls="en_curso" role="tab" data-toggle="tab" @click="setTypeofQuery('en curso')">En curso</a>
                        </li>
                        <li role="presentation" :class="{'active': this.type === 'cancelada'}">
                            <a href="#canceladas" aria-controls="finalizadas_canceladas" role="tab" data-toggle="tab" @click="setTypeofQuery('cancelada')">Canceladas</a>
                        </li>
                        <li role="presentation" :class="{'active': this.type === 'finalizada'}">
                            <a href="#finalizadas" aria-controls="finalizadas" role="tab" data-toggle="tab" @click="setTypeofQuery('finalizada')">Finalizadas</a>
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
                        <li role="presentation" :class="{'active': this.type === 'pendiente'}">
                            <a href="#pendientes2" aria-controls="pendientes2" role="tab" data-toggle="tab" @click="setTypeofQuery('pendiente')">Pendientes</a>
                        </li>
                        <li role="presentation" :class="{'active': this.type === 'seniado'}">
                            <a href="#seniadas" aria-controls="seniadas" role="tab" data-toggle="tab" @click="setTypeofQuery('seniado')">Señadas</a>
                        </li>
                        <li role="presentation" :class="{'active': this.type === 'pagado'}">
                            <a href="#pagadas" aria-controls="pagadas" role="tab" data-toggle="tab" @click="setTypeofQuery('pagado')">Pagadas</a>
                        </li>
                        <li role="presentation" :class="{'active': this.type === 'cancelado'}">
                            <a href="#canceladas2" aria-controls="canceladas2" role="tab" data-toggle="tab" @click="setTypeofQuery('cancelado')">Canceladas</a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active">
                            <table-orders-app v-if="pagination"></table-orders-app>
                        </div>
                    </div>
                </template>
                <div class="text-center" v-if="pagination">
                    <pagination for="dash" :records="total" :per-page="per_page" :chunk="pagChunk" :vuex="true"
                                count-text="Listando {from} a {to} de {count} items|{count} items|Un item">
                    </pagination>
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
                    cancelado: 1
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
            setTypeofQuery(newType) {
                if (this.type === 'pendiente') {
                    if (this.seeRentals) {
                        this.trash.pendiente = this.page;
                    } else {
                        this.trash.pendiente2 = this.page;
                    }
                } else if (this.type === 'confirmada') {
                    this.trash.confirmada = this.page;
                } else if (this.type === 'en curso') {
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

                this.type = newType;

                if (this.type === 'pendiente') {
                    if (this.seeRentals) {
                        this.page !== this.trash.pendiente ? this.PAGINATE(this.trash.pendiente) : window.EventBus.$emit('page-change', this.page);
                    } else {
                        this.page !== this.trash.pendiente2 ? this.PAGINATE(this.trash.pendiente2) : window.EventBus.$emit('page-change', this.page);
                    }
                } else if (this.type === 'confirmada') {
                    this.page !== this.trash.confirmada ? this.PAGINATE(this.trash.confirmada) : window.EventBus.$emit('page-change', this.page);
                } else if (this.type === 'en curso') {
                    this.page !== this.trash.en_curso ? this.PAGINATE(this.trash.en_curso) : window.EventBus.$emit('page-change', this.page);
                } else if (this.type === 'cancelada') {
                    this.page !== this.trash.cancelada ? this.PAGINATE(this.trash.cancelada) : window.EventBus.$emit('page-change', this.page);
                } else if (this.type === 'finalizada') {
                    this.page !== this.trash.finalizada ? this.PAGINATE(this.trash.finalizada) : window.EventBus.$emit('page-change', this.page);
                } else if (this.type === 'seniado') {
                    this.page !== this.trash.seniado ? this.PAGINATE(this.trash.seniado) : window.EventBus.$emit('page-change', this.page);
                } else if (this.type === 'pagado') {
                    this.page !== this.trash.pagado ? this.PAGINATE(this.trash.pagado) : window.EventBus.$emit('page-change', this.page);
                } else if (this.type === 'cancelado') {
                    this.page !== this.trash.cancelado ? this.PAGINATE(this.trash.cancelado) : window.EventBus.$emit('page-change', this.page);
                }
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
                this.seeRentals ? this.trash.rentals = this.type : this.trash.orders = this.type;
                this.seeRentals = $event;
                this.seeRentals ? this.type = this.trash.rentals : this.type = this.trash.orders;
                window.EventBus.$emit('page-change', this.page);
            });

            this.rentalsOrOrdersForState({
                isRentals: this.seeRentals,
                state: this.type,
                token: this.token,
                query: this.page
            }).then(() => {
                VueNoti.success({
                    title: 'OK!',
                    message: 'Data loaded correctly.',
                    timeout: 3000
                });
            }).catch(error => {
                VueNoti.error(error);
            });
        },
        mounted() {
            window.EventBus.$on('page-change', (page) => {
                this.rentalsOrOrdersForState({
                    isRentals: this.seeRentals,
                    state: this.type,
                    token: this.token,
                    query: page
                }).then(() => {
                    VueNoti.success({
                        title: 'OK!',
                        message: 'Data loaded correctly.',
                        timeout: 3000
                    });
                }).catch(error => {
                    VueNoti.error(error);
                });
            });
        }
    }
</script>

<style></style>