<template>
    <form @submit.prevent="selectQuery">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="form-group">
                <label :for="isForCottage ? 'capacidad-select' : 'capacidad-number'"></label>
                <div class="input-group">
                    <div class="input-group-addon"><icon-app iconImage="users"></icon-app> ¿Cuantas personas son?</div>
                    <input v-if="!isForCottage" v-model="choice" type="number" name="capacidad" id="capacidad-number" class="form-control">
                    <select v-else v-model="choice" name="capacidad" id="capacidad-select" class="form-control">
                        <option v-for="value in cottages" :value="value.number">{{ value.name }}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div :class="['form-group', {'has-error': !dateFrom}]">
                <label for="dateFrom"></label>
                <div class="input-group">
                    <div class="input-group-addon date-piker">Desde <icon-app iconImage="calendar"></icon-app></div>
                    <date-picker placeholder="Seleccione la fecha..." :config="dtpConfig" id="dateFrom" name="dateFrom" v-model="dateFrom"></date-picker>
                </div>
            </div>
            <div class="form-group">
                <a id="link-simple" @click="toggleBedSimple" role="button">
                    <icon-app iconId="icon-check-simple" :iconImage="checkSimple"> </icon-app> <icon-app iconImage="bed"></icon-app> ¿Solo camas simples?
                </a>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div :class="['form-group', {'has-error': !dateTo}]">
                <label for="dateTo"></label>
                <div class="input-group">
                    <div class="input-group-addon date-piker">Hasta <icon-app iconImage="calendar"></icon-app></div>
                    <date-picker placeholder="Seleccione la fecha..." :config="dtpConfig" id="dateTo" name="dateTo" v-model="dateTo"></date-picker>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <br><br>
            <button class="btn btn-primary btn-lg" :disabled="hasErrors">
                Consultar disponibilidad <icon-app :iconImage="btnIconImg" :aditionalClasses="btnClasses"></icon-app>
            </button>
        </div>
    </form>
</template>

<script>
    import { createNamespacedHelpers } from 'vuex'
    import Icon from './Icon.vue'
    import DatePicker from 'vue-bootstrap-datetimepicker'
    import moment from 'moment'
    import VueNoti from 'vue-notifications'

    const { mapActions, mapGetters, mapState } = createNamespacedHelpers('rentals');

    export default {
        components: {
            'icon-app': Icon,
            'date-picker': DatePicker
        },
        created() {
            EventBus.$on('choice-change', () => this.previousChoice());
            this.defineDate();
        },
        updated() {
            this.hasErrorsInForm();
        },
        data() {
            return {
                choice: 1,
                bedSimple: false,
                drafQuantity: 0,
                draftCottage: 0,
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
            ...mapState({
                cottages: state => state.data.cottages,
                isForCottage: state => state.frmCmp.isForCottage,
                queryFinished: state => state.xhr.queryFinished,
            }),
            ...mapGetters(['toggleConfig'])
        },
        methods: {
            initChoice() {
                if (!this.draftCottage) {
                    this.draftCottage = this.cottages[0].number;
                }
            },
            previousChoice() {
                if (this.isForCottage) {
                    this.initChoice();
                    this.drafQuantity = this.choice;
                    this.choice = this.draftCottage;
                } else {
                    this.draftCottage = this.choice;
                    this.choice = this.drafQuantity;
                }
            },
            defineDate() {
                window.verify = window.setTimeout(() => {
                    if (window.myInfo) {
                        this.setBasicInfo(window.myInfo);
                        delete window.myInfo;
                        this.dtpConfig = this.toggleConfig;
                    }
                }, 1000);
            },
            hasErrorsInForm() {
                if (this.dateFrom && this.dateTo) {
                    this.hasErrors = false;
                }
            },
            selectQuery() {
                if (this.hasErrors) return;
                this.setQueryFinished(false);
                this.queryCottagesAvailables({
                    /* Evaluar que dateTo sea mayor a dateFrom */
                    isForCottage: this.isForCottage,
                    choice: this.choice,
                    simple: this.bedSimple,
                    dateFrom: moment(this.dateFrom).format('DD/MM/YYYY'),
                    dateTo: moment(this.dateTo).format('DD/MM/YYYY')
                }).then(response => {
                    VueNoti.success({
                        title: response.title,
                        message: response.message,
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
            toggleBedSimple() {
                this.bedSimple = !this.bedSimple;
            },
            ...mapActions(['setBasicInfo', 'queryCottagesAvailables', 'setQueryFinished'])
        }
    }

    $('#capacidad').selectize({
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