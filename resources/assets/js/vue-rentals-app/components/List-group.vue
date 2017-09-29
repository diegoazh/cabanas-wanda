<template>
    <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8 col-lg-8 col-lg-offset-2">
        <h3 v-if="toRentals.length" class="text-center">Cabañas disponibles</h3>
        <div v-if="toRentals.length" :class="['text-center', 'alert', {'alert-danger': toRentals.length, 'alert-info': toRentals.length}]">
            <icon-app iconImage="warning"></icon-app>
            {{ toRentals.length ? 'Tenga en cuenta que son las cabañas disponibles según las fechas ingresadas' : 'Lamentablemente no tenemos cabañas disponibles.'}}
        </div>
        <div class="list-group">
            <button-item v-for="rental in toRentals" :key="rental.id" :cottage="rental"></button-item>
        </div>
        <div class="text-center">
            <button id="btn-reservas" v-if="toRentals.length" class="btn btn-success btn-lg">Reservar <icon-app iconImage="handshake-o"></icon-app></button>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex'
    import Item from './Button-list-item.vue'
    import Icon from './Icon.vue'

    export default {
        components: {
            'button-item': Item,
            'icon-app': Icon
        },
        computed: {
            ...mapState({
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
    }
</style>