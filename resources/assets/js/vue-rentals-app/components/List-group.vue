<template>
    <div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 col-lg-10 col-lg-offset-1">
        <h3 v-if="toRentals.length" class="text-center">Cabañas disponibles</h3>
        <div v-if="toRentals.length" :class="['text-center', 'alert', {'alert-danger': toRentals.length, 'alert-info': toRentals.length}]">
            <icon-app iconImage="warning"></icon-app>
            {{ toRentals.length ? 'Cabañas disponibles según los parametros elegidos' : 'Lamentablemente no tenemos cabañas disponibles.'}}
            <br>
            <icon-app iconImage="trash"></icon-app> Si desea eliminar alguna de las opciones <b>haga clic en ella</b>
        </div>
        <div class="list-group">
            <button-item v-for="(rental, index) in toRentals" :key="rental.id" :cottage="rental" :index="index"></button-item>
        </div>
        <div class="text-center">
            <button @click="setDeal(true)" id="btn-reservas" v-if="toRentals.length" class="btn btn-success btn-lg">Reservar <icon-app iconImage="handshake-o"></icon-app></button>
        </div>
    </div>
</template>

<script>
    import { createNamespacedHelpers } from 'vuex'
    import Item from './Button-list-item.vue'
    import Icon from '../../vue-commons/components/Icon.vue'

    const { mapState, mapActions } = createNamespacedHelpers('rentals');

    export default {
        components: {
            'button-item': Item,
            'icon-app': Icon
        },
        computed: {
            ...mapState({
                toRentals: state => state.data.toRentals
            })
        },
        methods: {
            ...mapActions(['setDeal'])
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
    }
</style>