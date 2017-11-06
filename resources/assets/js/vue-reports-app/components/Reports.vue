<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h1 class="text-center">REPORTES</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="text-center">
                    <form @submit.prevent="updateReportRentals(myChart, null, filterRentals())" class="form-inline">
                        <div class="form-group">
                            <label for="anio" class="sr-only"></label>
                            <div class="input-group">
                                <div class="input-group-addon"></div>
                                <input id="anio" name="anio" type="number" class="form-control" v-model="anio">
                            </div>
                        </div>
                        <button class="btn btn-success"><icon-app iconImage="refresh"></icon-app> actualizar</button>
                    </form>
                    <br>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="chart-container" style="position: relative; height:40vh; width:80vw">
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
    import { mapState, mapActions, mapMutations } from 'vuex'

    export default {
        components: {
            'icon-app': Icon
        },
        data() {
            return {
                myChart: null,
                ctx: null,
                anio: 2017
            }
        },
        computed: {
            ...mapState('reports', {
                rentals: state => state.data .rentals,
            })
        },
        methods: {
            filterRentals() {
                let ene = 0; let feb = 0; let mar = 0; let abr = 0; let may = 0; let jun = 0; let jul = 0; let ago = 0; let sep = 0; let oct = 0; let nov = 0; let dic = 0;
                this.rentals.forEach(elem => {
                    if (moment(elem.dateFrom, 'YYYY-MM-DD').get('year') === +this.anio) {
                        switch(moment(elem.dateFrom, 'YYYY-MM-DD').get('month')) {
                            case 0: ene++;
                                break;
                            case 1: feb++;
                                break;
                            case 2: mar++;
                                break;
                            case 3: abr++;
                                break;
                            case 4: may++;
                                break;
                            case 5: jun++;
                                break;
                            case 6: jul++;
                                break;
                            case 7: ago++;
                                break;
                            case 8: sep++;
                                break;
                            case 9: oct++;
                                break;
                            case 10: nov++;
                                break;
                            case 11: dic++;
                                break;

                        }
                    }
                });
                return [ene, feb, mar, abr, may, jun, jul, ago, sep, oct, nov, dic];
            },
            updateReportRentals(chart, label = null, data = null) {
                label ? chart.data.labels.push(label) : '';
                chart.data.datasets.forEach((dataset) => {
                    data ? dataset.data = data : '';
                });
                chart.update();
            },
            ...mapMutations('auth', ['setToken']),
            ...mapActions('reports', ['getReportRentals']),
        },
        filters: {},
        created() {
            if (this.$cookies.isKey('info_one')) {
                this.setToken(this.$cookies.get('info_one'));
            }
        },
        mounted() {
            this.getReportRentals({anio: +this.anio})
                .then(response => {
                    if (this.myChart) {
                        this.myChart = null;
                    }
                    this.ctx = window.document.getElementById('reports_container').getContext('2d');
                    this.myChart = new Chart(this.ctx, response);
                    this.updateReportRentals(this.myChart, null, this.filterRentals());
                })
                .catch(error => {
                    if (error && error.title) {
                        VueNoti.error(error)
                    } else {
                        console.log(error);
                    }
                });
        }
    }
</script>

<style>
    div.panel {
        height: 900px;
        margin-top: 2% !important;
    }
    canvas {
        border: 1px dotted red;
    }

    .chart-container {
        position: relative;
        margin: auto;
        height: 10vh;
        width: 40vw;
    }
</style>