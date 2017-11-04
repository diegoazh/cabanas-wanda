<template>
    <button type="button" class="list-group-item btn-item" @click="deleteItemToRentals(index)">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <img :src="cottage.images" alt="" class="img-responsive img-thumbnail img-circle img-btn-item">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <ul>
                    <li><b>Nombre: </b><h5 class="text-capitalize label label-info tt-btn-item">{{ cottage.name }}</h5></li>
                    <li><b class="capacity-btn-item">Capacidad: <b>{{ cottage.accommodation }}</b></b></li>
                    <li><b class="number-btn-item">Número: <b>{{ cottage.number }}</b></b></li>
                    <li><b>Entrega: <span class="label label-default">{{ deliveryDay }}</span></b></li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <ul>
                    <li><span :class="['label', {'label-primary': cottage.type === 'simple', 'label-success': cottage.type === 'matrimonial'}]"><b class="text-capitalize">{{ cottage.type }}</b></span></li>
                    <li><b>Días: {{ calcularDias }}</b></li>
                    <li><b>Precio: <span class="label label-primary"><icon-app iconImage="dollar"></icon-app>{{ cottage.price }}</span></b></li>
                    <li><b>Precio final: <span class="label label-danger"><icon-app iconImage="dollar"></icon-app>{{ calcularMonto(calcularDias, cottage.price) }}</span></b></li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1">
                <icon-app iconImage="check-square-o" aditionalClasses="pull-right icon-btn-item"></icon-app>
            </div>
        </div>        &nbsp;
    </button>
</template>

<script>
    import { createNamespacedHelpers } from 'vuex'
    import _ from 'lodash'
    import Icon from '../../vue-commons/components/Icon.vue'
    import moment from 'moment'

    const { mapActions, mapState } = createNamespacedHelpers('rentals');

    export default {
        components: {
            'icon-app': Icon
        },
        props: ['cottage', 'index'],
        computed: {
            calcularDias() {
                const dateFrom = moment(this.dateFrom + ' 10:00:00', 'DD/MM/YYYY HH:mm:ss');
                const dateTo = moment(this.dateTo + ' 10:00:00', 'DD/MM/YYYY HH:mm:ss').add(1, 'day');
                return dateTo.diff(dateFrom, 'days');
            },
            deliveryDay() {
                return moment(this.dateTo + ' 10:00:00', 'DD/MM/YYYY HH:mm:ss').add(1, 'day').format('DD/MM/YYYY HH:mm');
            },
            ...mapState({
                dateFrom: state => state.lastQueryData.dateFrom,
                dateTo: state => state.lastQueryData.dateTo,
            })
        },
        methods: {
            calcularMonto(dias, precio) {
                return _.round(dias * precio, 2); // tambien se puede usar .toFixed(2) es de JS puro
            },
            ...mapActions(['deleteItemToRentals'])
        }
    }
</script>

<style>
    .img-btn-item {
        max-width: 75%;
        display: inline-block;
        -webkit-box-shadow: inset 2px 3px 3px #333333;
        -moz-box-shadow: inset 2px 3px 3px #333333;
        box-shadow: inset 2px 3px 3px #333333;
        border-color: #333d53;
    }
    .tt-btn-item {
        display: inline-block;
        margin-left: 1.5%;
        font-size: 14px;
        font-weight: bolder;
        text-transform: uppercase;
    }
    .capacity-btn-item {
        display: inline-block;
        margin-left: 1.5%;
        font-size: 14px !important;
    }
    .number-btn-item {
        display: inline-block;
        margin-left: 1.5%;
        font-size: 14px !important;
    }
    .icon-btn-item:before {
        font-size: 220%;
        position: relative;
        top: 32px;
    }
    .btn-item {
        -webkit-box-shadow: 2px 2px 5px #333333;
        -moz-box-shadow: 2px 2px 5px #333333;
        box-shadow: 2px 2px 5px #333333;
    }
    .btn-item i.icon-btn-item:before {
        color: #5cb85c;
    }
    .btn-item:hover i.icon-btn-item:before {
        color: #d9534f;
        content: '\f057';
        font-family: FontAwesome;
    }
</style>