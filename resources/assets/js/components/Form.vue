<template>
    <form action="">
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
                    <date-picker :config="config" id="dateFrom" name="dateFrom" v-model="dateFrom"></date-picker>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="form-group">
                <label for="dateTo"></label>
                <div class="input-group">
                    <div class="input-group-addon date-piker">Hasta <app-icon iconImage="calendar"></app-icon></div>
                    <date-picker :config="config" id="dateTo" name="dateTo" v-model="dateTo"></date-picker>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <br><br>
            <button class="btn btn-primary btn-lg">
                Consultar disponibilidad <app-icon iconImage="search"></app-icon>
            </button>
        </div>
    </form>
</template>

<script>
    import Icon from './Icon.vue'
    import DatePicker from 'vue-bootstrap-datetimepicker'
    import moment from 'moment'

    export default {
        components: {
            'app-icon': Icon,
            'date-picker': DatePicker
        },
        created() {
            EventBus.$on('choice-change', () => this.previousChoice());
        },
        mounted() {
            this.dateFrom = this.defineDate();
            this.dateTo = this.dateFrom;
        },
        data() {
            return {
                choice: 1,
                drafQuantity: 1,
                draftCottage: 1,
                dateFrom: moment().add(2, 'd').format('DD/MM/YYYY'),
                dateTo: moment().add(2, 'd').format('DD/MM/YYYY'),
                config: {
                    locale: 'es',
                    format: 'DD/MM/YYYY',
                    minDate: this.date,
                    maxDate: this.date
                }
            }
        },
        computed: {
            quantityOrCottages() {
                return this.$store.state.isForCottage ? this.$store.state.cottages : 50;
            }
        },
        methods: {
            previousChoice() {
                if (this.$store.state.isForCottage) {
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
                        return window.myInfo.basicOne ? moment().format('DD/MM/YYYY') : moment().add(2, 'd').format('DD/MM/YYYY');
                        clearTimeout(verify);
                    }
                }, 1000);
            }
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