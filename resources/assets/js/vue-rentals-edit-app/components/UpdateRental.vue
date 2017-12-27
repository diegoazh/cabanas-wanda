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
                                <a class="nav-link active" href="#dates" aria-controls="dates" role="tab" data-toggle="tab" @click="clearTrash('date')"><icon-app icon-image="calendar"></icon-app> Cambiar fecha</a>
                            </li>
                            <li role="presentation" class="nav-item">
                                <a class="nav-link" href="#cancelar" aria-controls="cancelar" role="tab" data-toggle="tab" @click="clearTrash('state')"><icon-app icon-image="times-circle"></icon-app> Cancelar</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="col py-3">
                                <button class="btn btn-outline-secondary btn-sm pull-right" @click.prevent.stop="clearRental"><icon-app icon-image="exchange"></icon-app> Cambiar reserva</button>
                            </div>
                            <div role="tabpanel" class="tab-pane active pt-3" id="dates">
                                <div class="alert alert-warning text-justify">
                                    <h4 class="text-center"><icon-app icon-image="exclamation-circle"></icon-app> A tener en cuenta</h4>
                                    <ul>
                                        <li>La reserva se puede modificar en su totalidad hasta 48 hs antes; recuerde que el ingreso es a las 10 am por lo cual las 48 hs cuentan desde ese momento hacía atras.</li>
                                        <li>Con menos de 48 hs solo puede extenderla o reducirla pero no podrá cambiar la fecha de inicio de la misma.</li>
                                        <li>Si el problema fuera la fecha de inicio en ese caso solo podrá cancelar y generar una nueva reserva en las fechas disponibles al momento de su realización.</li>
                                        <li>Si la seña luego de la actualización de la reserva es mayor a la ya abonada deberá abonar la diferencia para confirmar la nueva reserva.</li>
                                        <li>Si la seña luego de la actualización es menor y ya fué abonada queda confirmada automáticamente y la diferencia aplica al saldo restante del total de la reserva.</li>
                                    </ul>
                                </div>
                                <form class="form-inline justify-content-center" @submit.prevent>
                                    <div :class="['form-group', 'form-row', {'has-error': !trash.date_from}, 'mr-2']">
                                        <label for="dateFrom" class="col-form-label sr-only">Desde</label>
                                        <div class="input-group">
                                            <div class="input-group-addon date-piker"><icon-app iconImage="calendar"></icon-app></div>
                                            <date-picker v-if="!disableDateFrom" placeholder="Seleccione la fecha desde..." :config="dtpConfg" id="dateFrom" name="dateFrom" v-model="trash.date_from"></date-picker>
                                            <input v-else type="text" :value="rental.dateFrom" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div :class="['form-group', 'form-row', {'has-error': !trash.date_to}, 'mr-2']">
                                        <label for="dateTo" class="col-form-label sr-only">Hasta</label>
                                        <div class="input-group">
                                            <div class="input-group-addon date-piker"><icon-app iconImage="calendar"></icon-app></div>
                                            <date-picker placeholder="Seleccione la fecha hasta..." :config="dtpConfg" id="dateTo" name="dateTo" v-model="trash.date_to"></date-picker>
                                        </div>
                                    </div>
                                    <button @click="isAvailable" class="btn btn-outline-primary">Consultar fechas <icon-app iconImage="exchange"></icon-app></button>
                                </form>
                                <div class="row" v-if="toRentals.length">
                                    <div class="col-12 col-md-6 py-5" v-for="cottage in toRentals">
                                        <div class="card box-shadow border-light">
                                            <img :src="/https?:\/\//.test(cottage.images) ? cottage.images : cottage.images[0]" alt="Imagen de la cabaña" class="card-img-top">
                                            <div class="card-body">
                                                <h4 class="card-title text-capitalize bg-dark text-light py-2 px-3 rounded">{{ cottage.name }}</h4>
                                                <ul class="card-text">
                                                    <li>Numero: <span class="badge badge-primary">{{ cottage.number }}</span></li>
                                                    <li class="text-capitalize">Capasidad: <span class="badge badge-info">{{ cottage.accommodation }}</span></li>
                                                    <li class="text-capitalize">Tipo: <span class="badge badge-warning">{{ cottage.type }}</span></li>
                                                    <li>Precio: <span class="badge badge-danger"><icon-app icon-image="dollar"></icon-app>{{ cottage.price }}</span></li>
                                                    <li>Descripción: {{ cottage.description || 'Sin descripción'}}</li>
                                                </ul>
                                                <div class="text-center">
                                                    <button class="btn btn-block btn-outline-success" data-toggle="modal" data-target="#rental-update" @click="trash.cottage_id = cottage.id">Actualizar reserva</button>
                                                </div>
                                                <modal-app modal-title="Actualización de reserva" :action-btn-save="sendRentalUpdate"
                                                           modal-id="rental-update" modal-header-classes="bg-warning text-dark"
                                                           modal-footer-classes="bg-light" type-btn-save="btn-outline-success"
                                                           type-btn-close="btn-outline-secondary" txt-btn-save="Actualizar"
                                                           txt-btn-close="Cerrar">
                                                    <div class="alert alert-warning text-center">
                                                        <p><icon-app icon-image="exclamation-triangle"></icon-app> ¿Esta seguro que desea actualizar la reserva?</p>
                                                    </div>
                                                </modal-app>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="loading" class="row justify-content-center" v-if="loading">
                                    <div class="col-6 align-content-center py-5">
                                        <icon-app icon-id="loader" icon-image="spinner" aditional-classes="fa-pulse fa-fw text-secondary"></icon-app>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane pt-3" id="cancelar">
                                <div class="text-center">
                                    <div class="alert alert-danger">
                                        <p>Tenga en cuenta que si cancela la reserva con <b>menos de 48 hs</b> perderá compeltamente la seña.</p>
                                    </div>
                                    <button class="btn btn-lg btn-danger" data-toggle="modal" data-target="#rental-cancel">
                                        <icon-app iconImage="times-circle"></icon-app> Cancelar
                                    </button>
                                </div>
                                <modal-app modal-title="Cancelación de reserva" :action-btn-save="sendRentalUpdate"
                                           modal-id="rental-cancel" modal-header-classes="bg-danger text-light"
                                           modal-footer-classes="bg-light" type-btn-save="btn-outline-danger"
                                           type-btn-close="btn-outline-secondary" txt-btn-save="Cancelar"
                                           txt-btn-close="Cerrar">
                                    <div class="alert alert-danger text-center">
                                        <p><icon-app icon-image="exclamation-triangle"></icon-app> ¿Esta seguro que desea cancelar?</p>
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
    import { mapActions, mapState, mapMutations } from 'vuex';
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
                loading: false,
                trash: {
                    cottage: 0,
                    cottage_id: 0,
                    date_from: '',
                    date_to: '',
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
            disableDateFrom() {
                return moment().add(2, 'd').isAfter(moment(this.rental.dateFrom, 'YYYY-MM-DD'));
            },
            ...mapState('rentals_edit', {
                rental: state => state.data.rental
            }),
            ...mapState('rentals', {
                toRentals: state => state.data.toRentals,
                cottages: state => state.data.cottages
            })
        },
        methods: {
            clearRental() {
                this.setRental(null);
            },
            validateTypeOfDate(date) {
                if (!date) return;
                if (moment.isDate(date)) return moment(date).format('DD/MM/YYYY');
                if (moment.isMoment(date)) return date.format('DD/MM/YYYY');
                if (typeof date === 'string') return date;
            },
            clearTrash(text) {
                switch(text) {
                    case 'date': {
                        this.trash.state = '';
                    }
                        break;
                    case 'state': {
                        this.trash.state = 'cancelada';
                    }
                        break;
                }
            },
            isAvailable() {
                this.queryCottagesAvailables({
                    dateFrom: this.trash.date_from ? this.validateTypeOfDate(this.trash.date_from) : moment(this.rental.dateFrom, 'YYYY-MM-DD').format('DD/MM/YYYY'),
                    dateTo: this.trash.date_to ? this.validateTypeOfDate(this.trash.date_to) : moment(this.rental.dateTo, 'YYYY-MM-DD').format('DD/MM/YYYY'),
                    update: true,
                    cottage_id: this.rental.cottage.id,
                    rental_id: this.rental.id
                }).then(response => {
                    VueNoti.success({
                        title: 'Cabañas disponibles',
                        message: 'Estas son las cabañas disponibles según las fechas seleccionadas.',
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
            sendRentalUpdate() {
                this.updateRental({
                    id: this.rental.id,
                    cottage_id: !this.trash.state ? this.trash.cottage_id : null,
                    dateFrom: !this.trash.state ? this.validateTypeOfDate(this.trash.date_from) : null,
                    dateTo: !this.trash.state ? this.validateTypeOfDate(this.trash.date_to) : null,
                    state: this.trash.state,
                }).then(response => {
                    window.EventBus.$emit('rental-updated');
                    VueNoti.success(response);
                }).catch(error => {
                    VueNoti.error(error);
                });
                this.loading = true;
                window.jQuery('#rental-update').modal('hide');
                window.jQuery('#rental-cancel').modal('hide');
                this.setToRentals([]);
            },
            ...mapActions('rentals', ['queryCottagesAvailables']),
            ...mapActions('rentals_edit', ['updateRental']),
            ...mapMutations('rentals_edit', ['setRental']),
            ...mapMutations('rentals', ['setToRentals']),
        },
        filters: { },
        created() { },
        beforeMount() {
            if (!this.trash.date_from) this.trash.date_from = moment(this.rental.dateFrom, 'YYYY-MM-DD').toDate();
            if (!this.trash.date_to) this.trash.date_to = moment(this.rental.dateTo, 'YYYY-MM-DD').subtract(1, 'd').toDate();
        },
        mounted() {
            window.EventBus.$on('change-side', (bool) => this.seeLeft = bool);
            this.trash.cottage = this.rental.cottage.number;
            this.trash.cottage_id = this.rental.cottage.id;
        }
    }
</script>

<style>
    .box-shadow {
        -webkit-box-shadow: 3px 3px 8px #333333;
        -moz-box-shadow: 3px 3px 8px #333333;
        box-shadow: 3px 3px 8px #333333;
    }
    #loading > div > #loader {
        font-size: 22rem;
    }
</style>