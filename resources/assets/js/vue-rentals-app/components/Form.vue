<template>
    <div class="col-12 col-md-7">
        <h4 class="mt-3">Ingrese las fechas para la reserva</h4>
        <form @submit.prevent="selectQuery" class="form-inline">
            <div class="form-group">
                <label for="dateFrom" class="col-form-label sr-only">Desde</label>
                <div class="input-group mr-3">
                    <div class="input-group-prepend date-piker"><div class="input-group-text"><icon-app iconImage="calendar"></icon-app></div></div>
                    <date-picker placeholder="Seleccione la fecha desde..." :config="dtpConfig" id="dateFrom" name="dateFrom" v-model="dateFrom"></date-picker>
                </div>
                <label for="dateTo" class="col-form-label sr-only">Hasta</label>
                <div class="input-group mr-3">
                    <div class="input-group-prepend date-piker"><div class="input-group-text"><icon-app iconImage="calendar"></icon-app></div></div>
                    <date-picker placeholder="Seleccione la fecha hasta..." :config="dtpConfig" id="dateTo" name="dateTo" v-model="dateTo"></date-picker>
                </div>
                <button :class="['btn', {'btn-outline-primary': !hasErrors, 'btn-outline-secondary': hasErrors}]" :disabled="hasErrors" role="button">
                    Consultar <icon-app :iconImage="btnIconImg" :aditionalClasses="btnClasses"></icon-app>
                </button>
            </div>
            <transition name="invalid-date"
                enter-active-class="animated rubberBand"
                leave-active-class="animated bounceOutRight">
                <div class="alert alert-warning" v-if="invalidDate">
                    <small> <icon-app icon-image="exclamation-triangle"></icon-app> La fecha <i>"desde"</i> o de inicio no puede ser menor a la fecha <i>"hasta"</i> o de finalización.</small>
                </div>
            </transition>
        </form>
    </div>
</template>

<script>
    import { mapActions, mapGetters, mapState } from 'vuex'
    import Icon from '../../vue-commons/components/Icon.vue'
    import DatePicker from 'vue-bootstrap-datetimepicker'
    import moment from 'moment'
    import VueNoti from 'vue-notifications'

    export default {
        components: {
            'icon-app': Icon,
            'date-picker': DatePicker
        },
        mounted() {
            EventBus.$on('choice-change', () => this.previousChoice());
            this.defineDate();
        },
        updated() {
            this.hasErrorsInForm();
        },
        data() {
            return {
                dateFrom: null,
                dateTo: null,
                dtpConfig: {},
                hasErrors: true
            }
        },
        computed: {
            quantityOrCottages() {
                return this.isForCottage ? this.cottages : 50;
            },
            btnIconImg() {
                return !this.queryFinished ? 'spinner' : 'search';
            },
            btnClasses() {
                return !this.queryFinished ? 'fa-spin fa-fw' : '';
            },
            checkSimple() {
                return this.bedSimple ? 'check-square-o' : 'square-o';
            },
            invalidDate() {
                let dateFrom = this.dateFrom ? moment(this.dateFrom, 'DD/MM/YYYY') : null;
                let dateTo = this.dateTo ? moment(this.dateTo, 'DD/MM/YYYY') : null;

                if (dateFrom && dateTo) {
                    return dateFrom.isAfter(dateTo);
                }
            },
            ...mapState('rentals', {
                cottages: state => state.data.cottages,
            }),
            ...mapState('auth', {
                queryFinished: state => state.xhr.queryFinished
            }),
            ...mapGetters('rentals', ['toggleConfig'])
        },
        methods: {
            defineDate() {
                if (this.$cookies.isKey('info_one')) {
                    this.setBasicInfo({
                        infoOne: +this.$cookies.get('info_one'),
                        infoTwo: +this.$cookies.get('info_two') ? this.$cookies.get('info_two') :  ''
                    });
                    this.dtpConfig = this.toggleConfig;
                }
            },
            hasErrorsInForm() { // TODO(Diego) Eliminar en la proximas correcciones esta función. Se puede simplificar utilizando simplemente invalidDate()
                let dateFrom = this.dateFrom ? moment(this.dateFrom, 'DD/MM/YYYY') : null;
                let dateTo = this.dateTo ? moment(this.dateTo, 'DD/MM/YYYY') : null;

                if (dateFrom && dateTo)
                    this.hasErrors = dateFrom.isAfter(dateTo);
                else
                    this.hasErrors = true;
            },
            selectQuery() {
                if (this.hasErrors) return;
                this.setQueryFinished(false);
                this.queryCottagesAvailables({
                    dateFrom: this.dateFrom,
                    dateTo: this.dateTo
                }).then(response => {})
                    .catch(error => {
                        VueNoti.error({
                            title: error.title,
                            message: error.message,
                            useSwal: true
                        });
                    });
            },
            toggleBedSimple() {
                this.bedSimple = !this.bedSimple;
            },
            ...mapActions('rentals', ['setBasicInfo', 'queryCottagesAvailables', 'setQueryFinished']),
            ...mapActions('auth', ['setQueryFinished'])
        }
    }

    window.jQuery('#capacidad').selectize({
        create: false,
        placeholder: '¿Cuantas personas son?',
        preload: true,
        inputClass: 'form-control selectize-input',
        dropdownParent: 'body'
    });
</script>

<style>
    #link-simple {
        text-decoration: none;
        color: #333333;
        font-size: 20px;
        font-weight: bold;
    }
    #link-simple:hover {
        color: #428bca;
    }
    #icon-check-simple {
        font-size: 24px;
        font-weight: bolder;
        margin-right: 5px;
    }
</style>
