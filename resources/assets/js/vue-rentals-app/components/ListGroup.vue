<template>
    <div class="col-12 col-md-12">
        <h3 v-if="toRentals.length" class="text-center">Cabañas disponibles</h3>
        <div v-if="toRentals.length" :class="['text-center', 'alert', {'alert-info': toRentals.length > 0, 'alert-warning': toRentals.length === 0}]">
            <icon-app iconImage="exclamation-triangle"></icon-app>
            {{ toRentals.length ? 'Cabañas disponibles según el rango de fechas elegido' : 'Lamentablemente no tenemos cabañas disponibles.'}}
        </div>
        <div class="row">
            <card-item-app v-for="(rental, index) in toRentals" :key="rental.id" :cottage="rental" :index="index"></card-item-app>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex'
    import Card from './CardItem.vue'
    import Icon from '../../vue-commons/components/Icon.vue'

    export default {
        components: {
            'card-item-app': Card,
            'icon-app': Icon
        },
        computed: {
            ...mapState('rentals', {
                toRentals: state => state.data.toRentals
            })
        }
    }
</script>

<style>
    #btn-reservas {
        font-weight: bolder;
        font-size: 26px;
        -webkit-border-radius: 25px;
        -moz-border-radius: 25px;
        border-radius: 25px;
        -webkit-box-shadow: 2px 3px 7px #333333;
        -moz-box-shadow: 2px 3px 7px #333333;
        box-shadow: 2px 3px 7px #333333;
        text-shadow: 2px 3px 7px #333333;
        margin-bottom: 20px;
    }
</style>