<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <h2 class="text-center">Reserva</h2>
            <h3 id="details_reservation" class="text-center">
                Titular: <span class="label label-info">{{ `${rental.user.name}, ${rental.user.lastname}` }}</span> |
                Cabaña: <span class="label label-default">{{ `${rental.cottage.name}` }}</span> |
                <icon-app iconImage="hashtag"></icon-app> <span class="label label-default">{{ `${rental.cottage.number}` }}</span>
            </h3>
            <hr>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <form @submit.prevent="">

            </form>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex'
    import Icon from '../../vue-commons/components/Icon.vue'

    export default {
        components: {
            'icon-app': Icon
        },
        computed: {
            ...mapState('orders', {
                rental: state => state.data.rental
            })
        }
    }
</script>

<style>
    #details_reservation span {
        font-size: inherit;
    }
</style>