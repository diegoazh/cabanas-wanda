<template>
    <div class="row justify-content-center">
        <div class="col-12 col-md-12">
            <div class="row justify-content-center">
                <div class="col-12 col-md-12">
                    <btn-switch textLeft="Editar" textRight="Cancelar"></btn-switch>
                </div>
            </div>
            <div class="row justify-content-center" v-if="seeLeft">
                <div class="col-12 col-md-12">
                    <div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="nav-item">
                                <a class="nav-link active" href="#dates" aria-controls="dates" role="tab" data-toggle="tab" @click="clearTrash('date')">Cambiar fecha</a>
                            </li>
                            <li role="presentation" class="nav-item">
                                <a class="nav-link" href="#cancelar" aria-controls="cancelar" role="tab" data-toggle="tab" @click="clearTrash('state')">Cancelar</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active pt-3" id="dates">
                                <form class="form-inline justify-content-center">
                                    <div :class="['form-group', 'form-row', {'has-error': !trash.date_from}, 'mr-2']">
                                        <label for="dateFrom" class="col-form-label sr-only">Desde</label>
                                        <div class="input-group">
                                            <div class="input-group-addon date-piker">Desde <icon-app iconImage="calendar"></icon-app></div>
                                            <date-picker placeholder="Seleccione la fecha..." :config="dtpConfg" id="dateFrom" name="dateFrom" v-model="trash.date_from"></date-picker>
                                        </div>
                                    </div>
                                    <div :class="['form-group', 'form-row', {'has-error': !trash.date_to}, 'mr-2']">
                                        <label for="dateTo" class="col-form-label sr-only">Hasta</label>
                                        <div class="input-group">
                                            <div class="input-group-addon date-piker">Hasta <icon-app iconImage="calendar"></icon-app></div>
                                            <date-picker placeholder="Seleccione la fecha..." :config="dtpConfg" id="dateTo" name="dateTo" v-model="trash.date_to"></date-picker>
                                        </div>
                                    </div>
                                    <button class="btn btn-outline-primary" @click="isAvailable">Consultar fechas <icon-app iconImage="exchange"></icon-app></button>
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="cancelar">
                                <div class="text-center">
                                    <div class="alert alert-danger">
                                        <p>Tenga en cuenta que si cancela la reserva con <b>menos de 48 hs</b> perderá compeltamente la seña.</p>
                                    </div>
                                    <button class="btn btn-lg btn-danger" data-toggle="modal" data-target="#b3-modal-id">
                                        <icon-app iconImage="times-circle"></icon-app> Cancelar
                                    </button>
                                </div>
                                <modal-app modalTitle="Cancelar reserva" :actionBtnSave="sendChangesToServer">
                                    <div class="alert alert-danger text-center">
                                        <p>¿Esta seguro que desea cancelar?</p>
                                    </div>
                                </modal-app>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';
    import VueNoti from 'vue-notifications';
    import DatePicker from 'vue-bootstrap-datetimepicker';
    import { mapActions, mapState } from 'vuex';
    import BtnSwitch from '../../vue-commons/components/BtnSwitch.vue';
    import Icon from '../../vue-commons/components/Icon.vue';
    import Modal from '../../vue-commons/components/Modal.vue';

    export default {
        components: {
            DatePicker,
            'btn-switch': BtnSwitch,
            'icon-app': Icon,
            'modal-app': Modal
        },
        data() {
            return {
                seeLeft: true,
                trash: {
                    cottage: 0,
                    cottage_id: 0,
                    date_from: null,
                    date_to: null,
                    state: ''
                },
                dtpConfg: {
                    locale: 'es',
                    format: 'DD/MM/YYYY',
                    minDate: moment().add(2, 'd').toDate(),
                    maxDate: moment().add(2, 'Y').toDate()
                }
            }
        },
        computed: {
            ...mapState('rentals_edit', {
                rental: state => state.data.rental
            }),
            ...mapState('rentals', {
                cottages: state => state.data.cottages
            })
        },
        methods: {
            clearTrash(text) {
                switch(text) {
                    case 'id': {
                        this.trash.cottage_id = this.rental.cottage_id;
                        this.trash.date_from = '';
                        this.trash.date_to = '';
                        this.trash.state = '';
                    }
                        break;
                    case 'date': {
                        this.trash.cottage_id = this.rental.cottage_id;
                        this.trash.date_from = moment(this.rental.dateFrom, 'YYYY-MM-DD').toDate();
                        this.trash.date_to = moment(this.rental.dateTo, 'YYYY-MM-DD').toDate();
                        this.trash.state = '';
                    }
                        break;
                    case 'state': {
                        this.trash.cottage_id = 0;
                        this.trash.date_from = '';
                        this.trash.date_to = '';
                        this.trash.state = 'cancelada';
                    }
                        break;
                }
            },
            isAvailable() {
                this.queryCottagesAvailables({
                    isForCottage: true,
                    choice: +this.trash.cottage,
                    simple: false,
                    dateFrom: this.trash.date_from ? this.trash.date_from.format('DD/MM/YYYY') : moment(this.rental.dateFrom, 'YYYY-MM-DD').format('DD/MM/YYYY'),
                    dateTo: this.trash.date_to ? this.trash.date_to.format('DD/MM/YYYY') : moment(this.rental.dateTo, 'YYYY-MM-DD').format('DD/MM/YYYY'),
                    isRented: true,
                }).then(response => {
                    let index = this.cottages.findIndex(cottage => cottage.number === this.trash.cottage);
                    this.trash.cottage_id = this.cottages[index].id;
                    VueNoti.success({
                        title: 'Cabaña disponible',
                        message: 'Puede realizar el cambio de cabaña sin inconvenientes.',
                        useSwal: true
                    });
                }).catch(error => {
                    VueNoti.error({
                        title: error.title,
                        message: error.message,
                        useSwal: true
                    });
                });
            },
            sendChangesToServer() {
                this.updateRental({
                    id: this.rental.id,
                    cottage_id: this.trash.cottage_id,
                    date_from: this.trash.date_from,
                    date_to: this.trash.date_to,
                    state: this.trash.state,
                }).then(response => {
                    window.EventBus.$emit('rental-updated');
                    VueNoti.success(response);
                }).catch(error => {
                    VueNoti.error(error);
                });
                window.jQuery('#b3-modal-id').modal('hide');
            },
            ...mapActions('rentals', ['setCottages', 'queryCottagesAvailables']),
            ...mapActions('rentals_edit', ['updateRental']),
        },
        filters: {},
        created() {
            this.setCottages();
        },
        mounted() {
            window.EventBus.$on('change-side', (bool) => this.seeLeft = bool);
            this.trash.cottage = this.rental.cottage.number;
        }
    }
</script>

<style></style>