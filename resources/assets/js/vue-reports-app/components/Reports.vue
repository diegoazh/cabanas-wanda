<template>
    <div>
        <div class="card-header bg-dark text-light">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <h1 class="text-center">
                            <a href="/admin" class="btn btn-outline-warning btn-sm pull-left"><icon-app type-icon="r" iconImage="hand-point-left"></icon-app> volver al panel</a>
                            REPORTES
                            <transition name="loader"
                                        enter-active-class="animated fadeIn"
                                        leave-active-class="animated fadeOut">
                                <icon-app :iconImage="!queryFinished || !queryEnd ? 'spinner' : 'chart-line'"
                                          :aditionalClasses="!queryFinished || !queryEnd ? 'fa-pulse fa-fw' : ''"></icon-app>
                            </transition>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="nav-item">
                                <a class="nav-link active" href="#reservas" aria-controls="reservas" role="tab" data-toggle="tab" @click="setPreviousTab">Reservas</a>
                            </li>
                            <li role="presentation" class="nav-item">
                                <a class="nav-link" href="#consumos" aria-controls="consumos" role="tab" data-toggle="tab" @click="setPreviousTab">Consumos</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="reservas">
                                <div class="padding-div-radios">
                                    <ul class="list-inline">
                                        <li>
                                            <label for="forYear" role="button" class="cursorPointer">
                                                <input type="radio" name="forms" id="forYear" v-model="forms"
                                                       value="year"> Anual en meses
                                            </label>
                                        </li>
                                        <li>
                                            <label for="forMonth" role="button" class="cursorPointer">
                                                <input type="radio" name="forms" id="forMonth" v-model="forms"
                                                       value="month"> Mensual por cabaña
                                            </label>
                                        </li>
                                        <li>
                                            <label for="forDecade" role="button" class="cursorPointer">
                                                <input type="radio" name="forms" id="forDecade" v-model="forms"
                                                       value="decade"> Decenio por años
                                            </label>
                                        </li>
                                        <li>
                                            <label for="forPeriod" role="button" class="cursorPointer">
                                                <input type="radio" name="forms" id="forPeriod" v-model="forms"
                                                       value="period"> Periodo seleccionado
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <fieldset v-if="forms === 'year' || forms === 'decade'">
                                        <legend>{{ forms === 'year' ? 'Por año' : 'Por decada' }}</legend>
                                        <div class="form-group">
                                            <label for="anio" class="sr-only">Año:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><div class="input-group-text">Año</div></div>
                                                <date-picker placeholder="Seleccione el año..."
                                                             :config="cnfgYear"
                                                             id="anio"
                                                             name="anio" v-model="anio"></date-picker>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="estado" class="sr-only"></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><div class="input-group-text">Estado</div></div>
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
                                    <fieldset v-if="forms === 'month'">
                                        <legend>Por mes</legend>
                                        <div class="form-group">
                                            <label for="mes" class="sr-only">Mes:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><div class="input-group-text">Mes</div></div>
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
                                                <div class="input-group-prepend"><div class="input-group-text">Estado</div></div>
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
                                    <fieldset v-if="forms === 'period'">
                                        <legend>Período</legend>
                                        <div class="form-group">
                                            <ul class="list-inline">
                                                <li>
                                                    <label for="periodYear" role="button" class="cursorPointer">
                                                        <input type="radio" name="periodTime" id="periodYear" v-model="periodTime"
                                                               value="year"> por año
                                                    </label>
                                                </li>
                                                <li>
                                                    <label for="periodMonth" role="button" class="cursorPointer">
                                                        <input type="radio" name="periodTime" id="periodMonth" v-model="periodTime"
                                                               value="month"> por meses
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="form-group">
                                            <label for="periodFrom" class="sr-only">Desde:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><div class="input-group-text">Desde</div></div>
                                                <date-picker placeholder="Seleccione la fecha..."
                                                             :config="cnfgPeriod"
                                                             id="periodFrom"
                                                             name="periodFrom" v-model="periodFrom"></date-picker>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="periodTo" class="sr-only">Hasta:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><div class="input-group-text">Hasta</div></div>
                                                <date-picker placeholder="Seleccione la fecha..."
                                                             :config="cnfgPeriod"
                                                             id="periodTo"
                                                             name="periodTo" v-model="periodTo"></date-picker>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="estado3" class="sr-only">Estado:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><div class="input-group-text">Estado</div></div>
                                                <select name="estado3" id="estado3" class="form-control" v-model="estado">
                                                    <option value="pendiente">Pendiente</option>
                                                    <option value="confirmada">Confirmada</option>
                                                    <option value="en curso">En curso</option>
                                                    <option value="finalizada">Finalizada</option>
                                                    <option value="cancelada">Cancelada</option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="consumos">
                                <div class="padding-div-radios">
                                    <ul class="list-inline">
                                        <li>
                                            <label for="forDate" role="button" class="cursorPointer">
                                                <input type="radio" name="forms2" id="forDate" v-model="forms"
                                                       value="date"> Por fecha
                                            </label>
                                        </li>
                                        <li>
                                            <label for="forCottage" role="button" class="cursorPointer">
                                                <input type="radio" name="forms2" id="forCottage" v-model="forms"
                                                       value="cottage"> Por cabaña
                                            </label>
                                        </li>
                                        <li>
                                            <label for="forUser" role="button" class="cursorPointer">
                                                <input type="radio" name="forms2" id="forUser" v-model="forms"
                                                       value="user"> Por usuario
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <fieldset>
                                        <legend>{{ forms === 'date' ? 'Por fecha' : forms === 'cottage' ? 'Por cabaña' : 'Por usuario' }}</legend>
                                        <div class="form-group">
                                            <ul class="list-inline">
                                                <li>
                                                    <label for="filterYear" role="button" class="cursorPointer">
                                                        <input type="radio" name="filterType" id="filterYear" v-model="filterFor"
                                                               value="year"> por año
                                                    </label>
                                                </li>
                                                <li>
                                                    <label for="filterMonth" role="button" class="cursorPointer">
                                                        <input type="radio" name="filterType" id="filterMonth" v-model="filterFor"
                                                               value="month"> por meses
                                                    </label>
                                                </li>
                                                <li>
                                                    <label for="filterDay" role="button" class="cursorPointer">
                                                        <input type="radio" name="filterType" id="filterDay" v-model="filterFor"
                                                               value="day"> por dias
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="form-group">
                                            <label for="filterFrom" class="sr-only">Desde:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><div class="input-group-text">Desde</div></div>
                                                <date-picker placeholder="Seleccione la fecha..."
                                                             :config="cnfgPeriod"
                                                             id="filterFrom"
                                                             name="filterFrom" v-model="filterFrom"></date-picker>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="filterTo" class="sr-only">Hasta:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><div class="input-group-text">Hasta</div></div>
                                                <date-picker placeholder="Seleccione la fecha..."
                                                             :config="cnfgPeriod"
                                                             id="filterTo"
                                                             name="filterTo" v-model="filterTo"></date-picker>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="estado4" class="sr-only">Estado:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><div class="input-group-text">Estado</div></div>
                                                <select name="estado4" id="estado4" class="form-control" v-model="estado">
                                                    <option value="pendiente">Pendiente</option>
                                                    <option value="confirmada">Confirmada</option>
                                                    <option value="en curso">En curso</option>
                                                    <option value="finalizada">Finalizada</option>
                                                    <option value="cancelada">Cancelada</option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-success" @click="btnUpateRp">
                                <icon-app icon-type="r" iconImage="sync-alt" :aditionalClasses="(!queryFinished || !queryEnd) ? 'fa-spin fa-fw': ''"></icon-app> Actualizar
                            </button>
                        </div>
                    </div>
                    <div class="col-12 col-md-9">
                        <div class="chart-container" style="position: relative;">
                            <canvas id="reports_container"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Chart from 'chart.js'
    import async from 'async';
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
                periodFrom: new Date(),
                periodTo: new Date(),
                periodTime: 'year',
                filterFrom: new Date(),
                filterTo: new Date(),
                filterFor: 'year',
                estado: 'finalizada',
                forms: 'year',
                previousTab: '',
                queryEnd: true,
                cnfgYear: {
                    locale: 'es',
                    format: 'YYYY',
                    viewMode: 'years'
                },
                cnfgMonth: {
                    locale: 'es',
                    format: 'MMMM',
                    viewMode: 'months'
                },
                cnfgPeriod: {
                    locale: 'es',
                    format: 'MMMM YYYY',
                }
            }
        },
        computed: {
            ...mapState('reports', {
                rentals: state => state.data.rentals,
                orders: state => state.data.orders,
                executingOrdersQuery: state => state.data.executingOrdersQuery,
                lastQueryOrders: state => state.data.lastQueryOrders,
            }),
            ...mapState('auth', {
                queryFinished: state => state.xhr.queryFinished,
            }),
        },
        methods: {
            setPreviousTab() {
                if (!this.previousTab) {
                    this.previousTab = this.forms;
                    this.forms = 'date';
                } else {
                    let prev = this.forms;
                    this.forms = this.previousTab;
                    this.previousTab = prev;
                }
            },
            getRandomInt(min, max) {
                return window.Math.floor(window.Math.random() * (max - min)) + min;
            },
            delaySeconds(seconds = 1) {
                return new Promise(resolve => {
                    this.queryEnd = false;
                    window.pausa = window.setTimeout(() => {
                        this.queryEnd = true;
                        delete window.pausa;
                        resolve();
                    }, seconds * 1000);
                });
            },
            updateChartNewInfo(chart, set) {
                set && set.labels ? chart.data.labels = set.labels : null;
                chart.data.datasets.forEach((dataset) => {
                    set.data ? dataset.data = set.data : null;
                    set.label && !dataset.label || set.label !== dataset.label ? dataset.label = set.label : null;
                    set.backgroundColor ? dataset.backgroundColor = set.backgroundColor : null;
                    set.borderColor ? dataset.borderColor = set.borderColor : null;
                });
                chart.update();
            },
            updateChartAddInfo(chart, set) {
                if (set.labels) { chart.data.labels.push(set.labels); }
                chart.data.datasets.forEach((dataset) => {
                    if (set.data) { dataset.data.push(set.data); }
                    if (set.backgroundColor) { dataset.backgroundColor.push(set.backgroundColor); }
                    if (set.borderColor) { dataset.borderColor.push(set.borderColor); }
                });
                chart.update();
            },
            addOrdersToRentals(minDate, maxDate, state, filterFor, boolQuery = true) {
                return new Promise((resolve, reject) => {
                    let min = 0;
                    const maxQuery = 200;
                    const totalRentals = this.rentals.length;
                    let originalRentals = this.rentals;
                    let tempRentals = [];

                    this.setExecutingOrdersQuery(true);
                    this.setLastQueryOrders(moment());
                    this.setQueryFinished(boolQuery);

                    this.getOrdersForRental({
                        minDate: minDate.format('YYYY-MM-DD'),
                        maxDate: maxDate.format('YYYY-MM-DD'),
                        state: state,
                        filterFor: filterFor
                    }).then(data => {
                            data.length ? tempRentals = tempRentals.concat(data) : null;

                            originalRentals.forEach((rental, index, array) => {
                                tempRentals.forEach((rent, ind, arr) => {
                                    if (rental.id === rent.id) {
                                        if(!rental.orders) rental.orders = [];
                                        rental.orders = rent.orders;
                                    }
                                });
                            });

                            this.setRentals(originalRentals);
                            this.setExecutingOrdersQuery(false);
                            this.setQueryFinished(true);
                            resolve(originalRentals);
                        })
                        .catch(error => {
                            console.log(error);
                            VueNoti.error({
                                title: 'ERROR',
                                message: 'Se ha producido un error inesperado. Verifiquelo y reintente: ' + error,
                                timeout: 5000,
                            });
                            this.setQueryFinished(true);
                            this.setExecutingOrdersQuery(false);
                            reject(error);
                        });
                });
            },
            rpYear() {
                let anio = moment.isMoment(this.anio) ? this.anio : moment(new Date());
                const yearData = {
                    label: 'Reservas por mes',
                    labels: new Array(12),
                    data: new Array(12),
                    backgroundColor: [],
                    borderColor: [],
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

                for (let i = yearData.labels.length - 1; i >= 0; i--) {
                    let textColor = `rgba(${this.getRandomInt(0, 256)}, ${this.getRandomInt(0, 256)}, ${this.getRandomInt(0, 256)}`;
                    yearData.backgroundColor[i] = textColor + ', 0.2)';
                    yearData.borderColor[i] = textColor + ', 1)';
                }

                return yearData;
            },
            rpMonth() {
                let mes = moment.isMoment(this.mes) ? this.mes : moment(new Date());
                let monthsData = {
                    label: 'Dias por cabaña',
                    labels: new Array(10),
                    data: new Array(10),
                    backgroundColor: [],
                    borderColor: [],
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

                for (let i = monthsData.labels.length - 1; i >= 0; i--) {
                    let textColor = `rgba(${this.getRandomInt(0, 256)}, ${this.getRandomInt(0, 256)}, ${this.getRandomInt(0, 256)}`;
                    monthsData.backgroundColor[i] = textColor + ', 0.2)';
                    monthsData.borderColor[i] = textColor + ', 1)';
                }

                return monthsData;
            },
            rpDecade() {
                let decade = moment.isMoment(this.anio) ? this.anio : moment(new Date());
                let yearFrom = decade.subtract(10, 'years').get('year');
                let yearTo = decade.add(10, 'years').get('year');
                let decadeData = {
                    label: 'Reservas totales por año',
                    labels: new Array(10),
                    data: new Array(10),
                    backgroundColor: [],
                    borderColor: [],
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

                for (let i = decadeData.labels.length - 1; i >= 0; i--) {
                    let textColor = `rgba(${this.getRandomInt(0, 256)}, ${this.getRandomInt(0, 256)}, ${this.getRandomInt(0, 256)}`;
                    decadeData.backgroundColor[i] = textColor + ', 0.2)';
                    decadeData.borderColor[i] = textColor + ', 1)';
                }

                return decadeData;
            },
            rpPeriod() {
                let periodFrom = moment.isMoment(this.periodFrom) ? this.periodFrom : moment(new Date());
                let periodTo = moment.isMoment(this.periodTo) ? this.periodTo : moment(new Date());
                let periodData = {
                    label: this.periodTime === 'year' ? 'Reservas del periodo por año' : 'Reservas del periodo por meses',
                    labels: [],
                    data: [],
                    backgroundColor: [],
                    borderColor: [],
                };

                this.rentals.forEach(elem => {
                    let anioRental = moment(elem.dateFrom, 'YYYY-MM-DD');

                    if (anioRental.isBetween(periodFrom, periodTo, this.periodTime, '[]') && elem.state === this.estado) {

                        let labelToPush = this.periodTime === 'year' ? anioRental.format('YYYY') : anioRental.format('MMMM YYYY');

                        if (!periodData.labels.length) {
                            periodData.labels.push(labelToPush);
                        } else if (!periodData.labels.find((elemento, index, array) => elemento === labelToPush)) {
                            periodData.labels.push(labelToPush);
                        }
                    }
                });

                periodData.labels.sort();

                this.rentals.forEach(elem => {
                    let anioRental = moment(elem.dateFrom, 'YYYY-MM-DD');

                    if (anioRental.isBetween(periodFrom, periodTo, this.periodTime, '[]') && elem.state === this.estado) {

                        let labelToPush = this.periodTime === 'year' ? anioRental.format('YYYY') : anioRental.format('MMMM YYYY');

                        !periodData.data[periodData.labels.findIndex((elemento, index, array) => elemento === labelToPush)] ? periodData.data[periodData.labels.findIndex((elemento, index, array) => elemento === labelToPush)] = 1 : periodData.data[periodData.labels.findIndex((elemento, index, array) => elemento === labelToPush)]++;
                    }
                });

                for (let i = periodData.labels.length - 1; i >= 0; i--) {
                    let textColor = `rgba(${this.getRandomInt(0, 256)}, ${this.getRandomInt(0, 256)}, ${this.getRandomInt(0, 256)}`;
                    periodData.backgroundColor[i] = textColor + ', 0.2)';
                    periodData.borderColor[i] = textColor + ', 1)';
                }

                return periodData;
            },
            rpFoodDate() {
                let filterFrom = moment.isMoment(this.filterFrom) ? this.filterFrom : moment(new Date());
                let filterTo = moment.isMoment(this.filterTo) ? this.filterTo : moment(new Date());
                let foodData = {
                    label: this.filterFor === 'year' ? 'Consumos del periodo por años en $' : this.filterFor === 'month' ? 'Consumos del periodo por meses en $' : 'Consumos del periodo por dias en $',
                    labels: [],
                    data: [],
                    backgroundColor: [],
                    borderColor: [],
                };

                this.queryEnd = false;

                this.rentals.forEach(elem => {
                    let anioRental = moment(elem.dateFrom, 'YYYY-MM-DD');
                    let labelToPush = '';

                    if (anioRental.isBetween(filterFrom, filterTo, this.filterFor, '[]') && elem.state === this.estado) {

                        if (this.forms === 'date') {
                            labelToPush = this.filterFor === 'year' ? anioRental.format('YYYY') : this.filterFor === 'month' ? anioRental.format('MMMM YYYY') : anioRental.format('DD/MM/YYYY');
                        } else if (this.forms === 'cottage') {
                            labelToPush = elem.cottage.name;
                        } else if (this.forms === 'user') {
                            labelToPush = elem.user.email;
                        }

                        if (!foodData.labels.length) {
                            foodData.labels.push(labelToPush);
                        } else if (!foodData.labels.find((elemento, index, array) => elemento === labelToPush)) {
                            foodData.labels.push(labelToPush);
                        }
                    }
                });

                foodData.labels.sort();

                /*if (!this.lastQueryOrders || moment().diff(this.lastQueryOrders, 'hours') > 5) {
                    this.addOrdersToRentals(filterFrom, filterTo, this.estado, false);
                }*/

                this.addOrdersToRentals(filterFrom, filterTo, this.estado, this.filterFor, false)
                    .then(data => {
                        this.rentals.forEach((elem, index, array) => {
                            let anioFrom = moment(elem.dateFrom, 'YYYY-MM-DD');
                            let anioTo = moment(elem.dateTo, 'YYYY-MM-DD');
                            let labelToPush = '';

                            if (anioFrom.isBetween(filterFrom, filterTo, this.filterFor, '[]') && anioTo.isBetween(filterFrom, filterTo, this.filterFor, '[]') && elem.state === this.estado) {

                                if (this.forms === 'date') {
                                    labelToPush = this.filterFor === 'year' ? anioFrom.format('YYYY') : this.filterFor === 'month' ? anioFrom.format('MMMM YYYY') : anioFrom.format('DD/MM/YYYY');
                                } else if (this.forms === 'cottage') {
                                    labelToPush = elem.cottage.name;
                                } else if (this.forms === 'user') {
                                    labelToPush = elem.user.email;
                                }

                                let consumo = (elem.cottage_price * elem.total_days) - elem.deductions;

                                elem.orders.forEach(order => {
                                    order.orders_detail.forEach(detail => {
                                        consumo += (detail.quantity * detail.food.price);
                                    })
                                });

                                !foodData.data[foodData.labels.findIndex(elemento => elemento === labelToPush)] ? foodData.data[foodData.labels.findIndex(elemento => elemento === labelToPush)] = consumo : foodData.data[foodData.labels.findIndex(elemento => elemento === labelToPush)] += consumo;
                            }
                        });

                        this.queryEnd = true;
                    })
                    .catch(error => {console.log(error)});

                for (let i = foodData.labels.length - 1; i >= 0; i--) {
                    let textColor = `rgba(${this.getRandomInt(0, 256)}, ${this.getRandomInt(0, 256)}, ${this.getRandomInt(0, 256)}`;
                    foodData.backgroundColor[i] = textColor + ', 0.2)';
                    foodData.borderColor[i] = textColor + ', 1)';
                }

                return foodData;
            },
            reportsFilter() {
                if (this.forms === 'year') {
                    return this.rpYear();
                } else if (this.forms === 'month') {
                    return this.rpMonth();
                } else if (this.forms === 'decade') {
                    return this.rpDecade();
                } else if (this.forms === 'period') {
                    return this.rpPeriod();
                } else if (this.forms === 'date' || this.forms === 'cottage' || this.forms === 'user') {
                    return this.rpFoodDate();
                }
            },
            btnUpateRp() {
                this.delaySeconds();
                this.updateChartNewInfo(this.myChart, this.reportsFilter());
            },
            ...mapMutations('auth', ['setToken', 'setQueryFinished']),
            ...mapMutations('reports', ['setRentals', 'setExecutingOrdersQuery', 'setLastQueryOrders']),
            ...mapActions('reports', ['getReportRentals', 'getOrdersForRental']),
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
                    this.updateChartNewInfo(this.myChart, this.reportsFilter());
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
    div.card {
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