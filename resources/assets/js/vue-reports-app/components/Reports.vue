<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h1 class="text-center">
                    REPORTES
                    <transition name="loader"
                                enter-active-class="animated fadeIn"
                                leave-active-class="animated fadeOut">
                        <icon-app v-if="!queryFinished" iconImage="spinner" aditionalClasses="fa-pulse fa-fw"></icon-app>
                        <icon-app v-if="queryFinished" iconImage="line-chart" aditionalClasses=""></icon-app>
                    </transition>
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#reservas" aria-controls="reservas" role="tab"
                                                              data-toggle="tab">Reservas</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a>
                    </li>
                    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a>
                    </li>
                    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="reservas">
                        <div class="padding-div-radios">
                            <ul class="list-inline">
                                <li>
                                    <label for="forYear" role="button">
                                        <input type="radio" name="forms" id="forYear" v-model="forms.rentalsRp"
                                               value="year"> Anual en meses
                                    </label>
                                </li>
                                <li>
                                    <label for="forMonth" role="button">
                                        <input type="radio" name="forms" id="forMonth" v-model="forms.rentalsRp"
                                               value="month"> Mensual por cabaña
                                    </label>
                                </li>
                                <li>
                                    <label for="forDecade" role="button">
                                        <input type="radio" name="forms" id="forDecade" v-model="forms.rentalsRp"
                                               value="decade"> Decenio por años
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <fieldset v-if="forms.rentalsRp === 'year' || forms.rentalsRp === 'decade'">
                                <legend>{{ forms.rentalsRp === 'year' ? 'Por año' : 'Por decada' }}</legend>
                                <div class="form-group">
                                    <label for="anio" class="sr-only">Año:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">Año</div>
                                        <date-picker placeholder="Seleccione el año..."
                                                     :config="cnfgYear"
                                                     id="anio"
                                                     name="anio" v-model="anio"></date-picker>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="estado" class="sr-only"></label>
                                    <div class="input-group">
                                        <div class="input-group-addon">Estado</div>
                                        <select name="estado" id="estado" class="form-control" v-model="estado">
                                            <option value="pendiente">Pendiente</option>
                                            <option value="confirmada">Confirmada</option>
                                            <option value="en curso">En curso</option>
                                            <option value="finalizada">Finalizada</option>
                                            <option value="cancelada">Cancelada</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset v-if="forms.rentalsRp === 'month'">
                                <legend>Por mes</legend>
                                <div class="form-group">
                                    <label for="mes" class="sr-only">Mes:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">Mes</div>
                                        <date-picker placeholder="Seleccione el mes..."
                                                     :config="cnfgMonth"
                                                     id="mes"
                                                     class="text-capitalize"
                                                     name="mes" v-model="mes"></date-picker>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="estado2" class="sr-only"></label>
                                    <div class="input-group">
                                        <div class="input-group-addon">Estado</div>
                                        <select name="estado2" id="estado2" class="form-control" v-model="estado">
                                            <option value="pendiente">Pendiente</option>
                                            <option value="confirmada">Confirmada</option>
                                            <option value="en curso">En curso</option>
                                            <option value="finalizada">Finalizada</option>
                                            <option value="cancelada">Cancelada</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="text-center">
                                <button class="btn btn-success" @click="btnUpateRp">
                                    <icon-app iconImage="refresh"
                                              :aditionalClasses="queryFinished ? '' : 'fa-spin fa-fw'"></icon-app>
                                    Actualizar
                                </button>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">...</div>
                    <div role="tabpanel" class="tab-pane" id="messages">...</div>
                    <div role="tabpanel" class="tab-pane" id="settings">...</div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                <div class="chart-container" style="position: relative;">
                    <canvas id="reports_container"></canvas>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Chart from 'chart.js'
    import moment from 'moment';
    import VueNoti from 'vue-notifications'
    import Icon from '../../vue-commons/components/Icon.vue'
    import datePicker from 'vue-bootstrap-datetimepicker'
    import {mapState, mapActions, mapMutations} from 'vuex'

    export default {
        components: {
            datePicker,
            'icon-app': Icon,
        },
        data() {
            return {
                myChart: null,
                ctx: null,
                anio: new Date(),
                mes: new Date(),
                estado: 'finalizada',
                forms: {
                    rentalsRp: 'year',
                },
                cnfgYear: {
                    locale: 'es',
                    format: 'YYYY',
                    viewMode: 'years'
                },
                cnfgMonth: {
                    locale: 'es',
                    format: 'MMMM',
                    viewMode: 'months'
                }
            }
        },
        computed: {
            ...mapState('reports', {
                rentals: state => state.data.rentals,
            }),
            ...mapState('auth', {
                queryFinished: state => state.xhr.queryFinished,
            }),
        },
        methods: {
            delaySeconds(seconds = 1) {
                return new Promise(resolve => {
                    this.setQueryFinished(false);
                    window.pausa = window.setTimeout(() => {
                        this.setQueryFinished(true);
                        delete window.pausa;
                        resolve();
                    }, seconds * 1000);
                });
            },
            updateChartNewInfo(chart, set) {
                set && set.labels ? chart.data.labels = set.labels : '';
                chart.data.datasets.forEach((dataset) => {
                    set.data ? dataset.data = set.data : '';
                    set.label && !dataset.label || set.label !== dataset.label ? dataset.label = set.label : '';
                });
                chart.update();
            },
            updateChartAddInfo(chart, set) {
                if (set.labels) { chart.data.labels.push(set.labels); }
                chart.data.datasets.forEach((dataset) => {
                    if (set.data) { dataset.data.push(set.data); }
                });
                chart.update();
            },
            rpYear() {
                let anio = moment.isMoment(this.anio) ? this.anio : moment(new Date());
                const yearData = {
                    label: 'Reservas por mes',
                    labels: new Array(12),
                    data: new Array(12)
                };

                this.rentals.forEach(elem => {
                    if (moment(elem.dateFrom, 'YYYY-MM-DD').get('year') === anio.get('year') && elem.state === this.estado) {
                        switch (moment(elem.dateFrom, 'YYYY-MM-DD').get('month')) {
                            case 0:
                                if (!yearData.labels[0]) yearData.labels[0] = 'Enero';
                                !yearData.data[0] ? (yearData.data[0] = 1) : yearData.data[0]++;
                                break;
                            case 1:
                                if (!yearData.labels[1]) yearData.labels[1] = 'Febrero';
                                !yearData.data[1] ? (yearData.data[1] = 1) : yearData.data[1]++;
                                break;
                            case 2:
                                if (!yearData.labels[2]) yearData.labels[2] = 'Marzo';
                                !yearData.data[2] ? (yearData.data[2] = 1) : yearData.data[2]++;
                                break;
                            case 3:
                                if (!yearData.labels[3]) yearData.labels[3] = 'Abril';
                                !yearData.data[3] ? (yearData.data[3] = 1) : yearData.data[3]++;
                                break;
                            case 4:
                                if (!yearData.labels[4]) yearData.labels[4] = 'Mayo';
                                !yearData.data[4] ? (yearData.data[4] = 1) : yearData.data[4]++;
                                break;
                            case 5:
                                if (!yearData.labels[5]) yearData.labels[5] = 'Junio';
                                !yearData.data[5] ? (yearData.data[5] = 1) : yearData.data[5]++;
                                break;
                            case 6:
                                if (!yearData.labels[6]) yearData.labels[6] = 'Julio';
                                !yearData.data[6] ? (yearData.data[6] = 1) : yearData.data[6]++;
                                break;
                            case 7:
                                if (!yearData.labels[7]) yearData.labels[7] = 'Agosto';
                                !yearData.data[7] ? (yearData.data[7] = 1) : yearData.data[7]++;
                                break;
                            case 8:
                                if (!yearData.labels[8]) yearData.labels[8] = 'Septiembre';
                                !yearData.data[8] ? (yearData.data[8] = 1) : yearData.data[8]++;
                                break;
                            case 9:
                                if (!yearData.labels[9]) yearData.labels[9] = 'Octubre';
                                !yearData.data[9] ? (yearData.data[9] = 1) : yearData.data[9]++;
                                break;
                            case 10:
                                if (!yearData.labels[10]) yearData.labels[10] = 'Noviembre';
                                !yearData.data[10] ? (yearData.data[10] = 1) : yearData.data[10]++;
                                break;
                            case 11:
                                if (!yearData.labels[11]) yearData.labels[11] = 'Diciembre';
                                !yearData.data[11] ? (yearData.data[11] = 1) : yearData.data[11]++;
                                break;
                        }
                    }
                });

                return yearData;
            },
            rpMonth() {
                let mes = moment.isMoment(this.mes) ? this.mes : moment(new Date());
                let monthsData = {
                    label: 'Dias por cabaña',
                    labels: new Array(10),
                    data: new Array(10)
                };

                this.rentals.forEach(elem => {
                    if (moment(elem.dateFrom, 'YYYY-MM-DD').get('year') === mes.get('year') && moment(elem.dateFrom, 'YYYY-MM-DD').get('month') === mes.get('month') && elem.state === this.estado) {
                    switch (elem.cottage.number) {
                        case 1:
                            !monthsData.labels[0] ? monthsData.labels[0] = elem.cottage.name + ' (' + elem.cottage.number + ')' : elem.cottage.number;
                            !monthsData.data[0] ? monthsData.data[0] = elem.total_days : monthsData.data[0] += elem.total_days;
                            break;
                        case 2:
                            !monthsData.labels[1] ? monthsData.labels[1] = elem.cottage.name + ' (' + elem.cottage.number + ')' : elem.cottage.number;
                            !monthsData.data[1] ? monthsData.data[1] = elem.total_days : monthsData.data[1] += elem.total_days;
                            break;
                        case 3:
                            !monthsData.labels[2] ? monthsData.labels[2] = elem.cottage.name + ' (' + elem.cottage.number + ')' : elem.cottage.number;
                            !monthsData.data[2] ? monthsData.data[2] = elem.total_days : monthsData.data[2] += elem.total_days;
                            break;
                        case 4:
                            !monthsData.labels[3] ? monthsData.labels[3] = elem.cottage.name + ' (' + elem.cottage.number + ')' : elem.cottage.number;
                            !monthsData.data[3] ? monthsData.data[3] = elem.total_days : monthsData.data[3] += elem.total_days;
                            break;
                        case 5:
                            !monthsData.labels[4] ? monthsData.labels[4] = elem.cottage.name + ' (' + elem.cottage.number + ')' : elem.cottage.number;
                            !monthsData.data[4] ? monthsData.data[4] = elem.total_days : monthsData.data[4] += elem.total_days;
                            break;
                        case 6:
                            !monthsData.labels[5] ? monthsData.labels[5] = elem.cottage.name + ' (' + elem.cottage.number + ')' : elem.cottage.number;
                            !monthsData.data[5] ? monthsData.data[5] = elem.total_days : monthsData.data[5] += elem.total_days;
                            break;
                        case 7:
                            !monthsData.labels[6] ? monthsData.labels[6] = elem.cottage.name + ' (' + elem.cottage.number + ')' : elem.cottage.number;
                            !monthsData.data[6] ? monthsData.data[6] = elem.total_days : monthsData.data[6] += elem.total_days;
                            break;
                        case 8:
                            !monthsData.labels[7] ? monthsData.labels[7] = elem.cottage.name + ' (' + elem.cottage.number + ')' : elem.cottage.number;
                            !monthsData.data[7] ? monthsData.data[7] = elem.total_days : monthsData.data[7] += elem.total_days;
                            break;
                        case 9:
                            !monthsData.labels[8] ? monthsData.labels[8] = elem.cottage.name + ' (' + elem.cottage.number + ')' : elem.cottage.number;
                            !monthsData.data[8] ? monthsData.data[8] = elem.total_days : monthsData.data[8] += elem.total_days;
                            break;
                        case 10:
                            !monthsData.labels[9] ? monthsData.labels[9] = elem.cottage.name + ' (' + elem.cottage.number + ')' : elem.cottage.number;
                            !monthsData.data[9] ? monthsData.data[9] = elem.total_days : monthsData.data[9] += elem.total_days;
                            break;
                    }
                }
                });

                return monthsData;
            },
            rpDecade() {
                let decade = moment.isMoment(this.anio) ? this.anio : moment(new Date());
                let yearFrom = decade.subtract(10, 'years').get('year');
                let yearTo = decade.add(10, 'years').get('year');
                let decadeData = {
                    label: 'Reservas totales por año',
                    labels: new Array(10),
                    data: new Array(10)
                };

                this.rentals.forEach(elem => {
                    let anioRental = moment(elem.dateFrom, 'YYYY-MM-DD').get('year');

                    for (let i = 0; i < 10; i++) {
                        !decadeData.labels[i] ? decadeData.labels[i] = (yearFrom + (i + 1)) : null;
                    }

                    if (anioRental > yearFrom && anioRental <= yearTo && elem.state === this.estado) {
                        switch (anioRental) {
                            case decadeData.labels[0]:
                                !decadeData.data[0] ? decadeData.data[0] = 1 : decadeData.data[0]++;
                                break;
                            case decadeData.labels[1]:
                                !decadeData.data[1] ? decadeData.data[1] = 1 : decadeData.data[1]++;
                                break;
                            case decadeData.labels[2]:
                                !decadeData.data[2] ? decadeData.data[2] = 1 : decadeData.data[2]++;
                                break;
                            case decadeData.labels[3]:
                                !decadeData.data[3] ? decadeData.data[3] = 1 : decadeData.data[3]++;
                                break;
                            case decadeData.labels[4]:
                                !decadeData.data[4] ? decadeData.data[4] = 1 : decadeData.data[4]++;
                                break;
                            case decadeData.labels[5]:
                                !decadeData.data[5] ? decadeData.data[5] = 1 : decadeData.data[5]++;
                                break;
                            case decadeData.labels[6]:
                                !decadeData.data[6] ? decadeData.data[6] = 1 : decadeData.data[6]++;
                                break;
                            case decadeData.labels[7]:
                                !decadeData.data[7] ? decadeData.data[7] = 1 : decadeData.data[7]++;
                                break;
                            case decadeData.labels[8]:
                                !decadeData.data[8] ? decadeData.data[8] = 1 : decadeData.data[8]++;
                                break;
                            case decadeData.labels[9]:
                                !decadeData.data[9] ? decadeData.data[9] = 1 : decadeData.data[9]++;
                                break;
                        }
                    }
                });

                return decadeData;
            },
            rentalsFilter() {
                if (this.forms.rentalsRp === 'year') {
                    return this.rpYear();
                } else if (this.forms.rentalsRp === 'month') {
                    return this.rpMonth();
                } else if (this.forms.rentalsRp === 'decade') {
                    return this.rpDecade();
                }
            },
            btnUpateRp() {
                this.delaySeconds();
                this.updateChartNewInfo(this.myChart, this.rentalsFilter());
            },
            ...mapMutations('auth', ['setToken', 'setQueryFinished']),
            ...mapActions('reports', ['getReportRentals']),
        },
        filters: {},
        created() {
            if (this.$cookies.isKey('info_one')) {
                this.setToken(this.$cookies.get('info_one'));
            }
        },
        mounted() {
            this.setQueryFinished(false);
            this.getReportRentals()
                .then(response => {
                    if (!this.myChart) {
                        this.ctx = window.document.getElementById('reports_container').getContext('2d');
                        this.myChart = new Chart(this.ctx, response);
                    }
                    this.updateChartNewInfo(this.myChart, this.rentalsFilter());
                    this.setQueryFinished(true);
                })
                .catch(error => {
                    if (error && error.title) {
                        VueNoti.error(error)
                    } else {
                        console.log(error);
                    }
                    this.setQueryFinished(true);
                });
        }
    }
</script>

<style>
    div.panel {
        margin-top: 2% !important;
        min-height: 85vh;
    }

    canvas {
        border: 1px dotted red;
    }

    .chart-container {
        position: relative;
        margin: auto;
        height: 55vh;
        width: 70vw;
    }

    .padding-div-radios {
        padding: 8px 8px;
    }
</style>