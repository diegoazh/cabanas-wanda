<template>
    <form @submit.prevent="selectQuery">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="form-group">
                <label for="capacidad"></label>
                <div class="input-group">
                    <div class="input-group-addon">¿Cuantas personas son?</div>
                    <select v-model="choice" name="capacidad" id="capacidad" class="form-control">
                        <option v-for="value in quantityOrCottages" :value="value.number ? value.number : value">{{ value.name ? value.name : value }}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="form-group">
                <label for="dateFrom"></label>
                <div class="input-group">
                    <div class="input-group-addon date-piker">Desde <app-icon iconImage="calendar"></app-icon></div>
                    <date-picker placeholder="Seleccione la fecha..." :config="dtpConfig" id="dateFrom" name="dateFrom" v-model="dateFrom"></date-picker>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="form-group">
                <label for="dateTo"></label>
                <div class="input-group">
                    <div class="input-group-addon date-piker">Hasta <app-icon iconImage="calendar"></app-icon></div>
                    <date-picker placeholder="Seleccione la fecha..." :config="dtpConfig" id="dateTo" name="dateTo" v-model="dateTo"></date-picker>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <br><br>
            <button class="btn btn-primary btn-lg">
                Consultar disponibilidad <app-icon :iconImage="btnIconImg" :aditionalClasses="btnClasses"></app-icon>
            </button>
        </div>
    </form>
</template>

<script>
    import Icon from './Icon.vue'
    import DatePicker from 'vue-bootstrap-datetimepicker'
    import moment from 'moment'
    import { mapActions, mapGetters } from 'vuex'

    export default {
        components: {
            'app-icon': Icon,
            'date-picker': DatePicker
        },
        created() {
            EventBus.$on('choice-change', () => this.previousChoice());
            this.defineDate();
        },
        data() {
            return {
                choice: 1,
                drafQuantity: 1,
                draftCottage: 1,
                dateFrom: null,
                dateTo: null,
                dtpConfig: {}
            }
        },
        computed: {
            loader() {
                return !this.$store.state.xhr.queryFinished;
            },
            quantityOrCottages() {
                return this.$store.state.frmCmp.isForCottage ? this.cottages : 50;
            },
            btnIconImg() {
                return this.loader ? 'spinner' : 'search';
            },
            btnClasses() {
                return this.loader ? 'fa-spin fa-fw' : '';
            },
            ...mapGetters(['isForCottages', 'cottages', 'toggleConfig', 'queryFinished'])
        },
        methods: {
            previousChoice() {
                if (this.$store.state.frmCmp.isForCottage) {
                    this.drafQuantity = this.choice;
                    this.choice = this.draftCottage;
                } else {
                    this.draftCottage = this.choice;
                    this.choice = this.drafQuantity;
                }
            },
            defineDate() {
                const verify = window.setTimeout(() => {
                    if (window.myInfo) {
                        this.setBasicInfo(window.myInfo);
                        delete window.myInfo;
                        this.dtpConfig = this.toggleConfig;
                    }
                }, 1000);
            },
            selectQuery() {
                if (!this.isForCottage) {
                    this.setQueryFinished(false);
                    this.queryForCapacity({
                        choice: this.choice,
                        dateFrom: moment(this.dateFrom).format('DD/MM/YYYY'),
                        dateTo: moment(this.dateTo).format('DD/MM/YYYY')
                    })
                }
            },
            ...mapActions(['setBasicInfo', 'queryForCapacity', 'setQueryFinished'])
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

<style></style>