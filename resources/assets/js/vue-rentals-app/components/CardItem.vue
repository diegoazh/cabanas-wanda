<template>
    <div class="col-12 col-md-6">
        <div class="card cottage-card">
            <img :src="seleccionarFoto(cottage.images)" alt="" class="card-img-top">
            <div class="card-body">
                <h4 class="card-title text-capitalize bg-info text-light px-3 py-2 rounded">{{ cottage.name }}</h4>
                <ul>
                    <li><b class="number-btn-item">Número: {{ cottage.number }}</b></li>
                    <li><b class="capacity-btn-item">Capacidad: {{ cottage.accommodation }}</b></li>
                    <li><b>Entrega: <span class="badge badge-secondary">{{ deliveryDay }}</span></b></li>
                    <li><span :class="['label', {'label-primary': cottage.type === 'simple', 'label-success': cottage.type === 'matrimonial'}]"><b class="text-capitalize">{{ cottage.type }}</b></span></li>
                    <li><b>Días: {{ calcularDias }}</b></li>
                    <li><b>Precio: <span class="badge badge-primary"><icon-app iconImage="dollar"></icon-app>{{ cottage.price }}</span></b></li>
                    <li><b>Precio final: <span class="badge badge-danger"><icon-app iconImage="dollar"></icon-app>{{ calcularMonto(calcularDias, cottage.price) }}</span></b></li>
                </ul>
                <button @click="prepareDeal(index)" class="btn btn-block btn-outline-success cursorPointer">RESERVAR</button>
            </div>
        </div>        &nbsp;
    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex'
    import _ from 'lodash'
    import Icon from '../../vue-commons/components/Icon.vue'
    import moment from 'moment'

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
            ...mapState('rentals', {
                dateFrom: state => state.lastQueryData.dateFrom,
                dateTo: state => state.lastQueryData.dateTo,
                toRentals: state => state.data.toRentals
            })
        },
        methods: {
            calcularMonto(dias, precio) {
                return _.round(dias * precio, 2); // tambien se puede usar .toFixed(2) es de JS puro
            },
            prepareDeal(index) {
                this.setToRentals(this.toRentals.splice(index, 1));
                this.setDeal(true);
            },
            seleccionarFoto(images) {
                if (!/lorempixel/.test(images)) {
                    return 'images/cabanias/' + images.split('|').shift();
                }
                return images;
            },
            ...mapActions('rentals', ['deleteItemToRentals', 'setToRentals', 'setDeal'])
        }
    }
</script>

<style>
    .cottage-card {
        -webkit-box-shadow: 3px 3px 8px #333333;
        -moz-box-shadow: 3px 3px 8px #333333;
        box-shadow: 3px 3px 8px #333333;
    }
</style>