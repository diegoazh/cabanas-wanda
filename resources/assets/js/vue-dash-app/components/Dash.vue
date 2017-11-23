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
                        <li role="presentation" class="active"><a href="#pendientes" aria-controls="pendientes" role="tab" data-toggle="tab">Pendientes</a></li>
                        <li role="presentation"><a href="#confirmadas" aria-controls="confirmadas" role="tab" data-toggle="tab">Confirmadas</a></li>
                        <li role="presentation"><a href="#en_curso" aria-controls="en_curso" role="tab" data-toggle="tab">En curso</a></li>
                        <li role="presentation"><a href="#finalizadas_canceladas" aria-controls="finalizadas_canceladas" role="tab" data-toggle="tab">Finalizadas y canceladas</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="pendientes">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Número</th>
                                            <th>Desde</th>
                                            <th>Hasta</th>
                                            <th>Dias</th>
                                            <th>Se&ntilde;a</th>
                                            <th>Vto se&ntilde;a</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(rental, index) in fiftheenElements">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ rental.dateFrom }}</td>
                                            <td>{{ rental.dateTo }}</td>
                                            <td>{{ rental.total_days }}</td>
                                            <td>{{ (100 / 30 * rental.cottage_price).toFixed(2) }}</td>
                                            <td>{{ rental.dateReservationPayment }}</td>
                                            <td>{{ rental.state }}</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="7"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="text-center">
                                <pagination for="dash" :records="rentals.length" :per-page="itemsPerPage" :chunk="pagChunk" :vuex="true"
                                            count-text="Listando {from} a {to} de {count} items|{count} items|Un item">
                                </pagination>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="confirmadas">...</div>
                        <div role="tabpanel" class="tab-pane" id="en_curso">...</div>
                        <div role="tabpanel" class="tab-pane" id="finalizadas_canceladas">...</div>
                    </div>
                </template>
                <template v-else>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#pendientes2" aria-controls="pendientes2" role="tab" data-toggle="tab">Pendientes</a></li>
                        <li role="presentation"><a href="#seniadas" aria-controls="seniadas" role="tab" data-toggle="tab">Señadas</a></li>
                        <li role="presentation"><a href="#pagadas" aria-controls="pagadas" role="tab" data-toggle="tab">Pagadas</a></li>
                        <li role="presentation"><a href="#canceladas" aria-controls="canceladas" role="tab" data-toggle="tab">Canceladas</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="pendientes2">...</div>
                        <div role="tabpanel" class="tab-pane" id="seniadas">...</div>
                        <div role="tabpanel" class="tab-pane" id="pagadas">...</div>
                        <div role="tabpanel" class="tab-pane" id="canceladas">...</div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</template>

<script>
    import VueNoti from 'vue-notifications';
    import { mapActions, mapState, mapMutations } from 'vuex';
    import { Pagination, PaginationEvent } from 'vue-pagination-2';
    import Icon from '../../vue-commons/components/Icon.vue';
    import BtnSwitch from '../../vue-commons/components/BtnSwitch.vue';

    export default {
        components: {
            Pagination,
            'icon-app': Icon,
            'btn-switch-app': BtnSwitch,
        },
        data() {
            return {
                pagChunk: 7,
                seeRentals: true
            }
        },
        computed: {
            fiftheenElements() {
                let pageTo = this.page * this.itemsPerPage; // quince debería ser una variable
                let pageFrom = (this.page === 1) ? 0 : (this.page - 1) * this.itemsPerPage;
                return this.rentals.filter(function (element, index, array) {
                    return index >= pageFrom && index < pageTo;
                });
            },
            ...mapState('dash', {
                token: state => state.data.token,
                rentals: state => state.data.rentals,
                page: state => state.page,
                itemsPerPage: state => state.itemsPerPage,
            })
        },
        methods: {
            ...mapMutations('dash', ['setToken', 'setRentals']),
            ...mapActions('dash', ['rentalsForState'])
        },
        filters: {},
        created() {
            window.EventBus.$on('change-side', ($event)=> {
                this.seeRentals = $event;
            });
        },
        mounted() {
            this.$cookies.isKey('info_one') ? this.setToken(this.$cookies.get('info_one')) : null;

            this.rentalsForState({
                state: 'pendiente',
                token: this.token ? this.token : ''
            }).then(rentals => {
                this.setRentals(rentals);
                VueNoti.success({
                    title: 'OK!',
                    message: 'Data loaded correctly.',
                    timeout: 3000
                });
            }).catch(error => {
                VueNoti.error(error);
            });
        }
    }
</script>

<style></style>