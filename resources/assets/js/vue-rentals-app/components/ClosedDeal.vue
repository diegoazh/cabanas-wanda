<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-offset-3 col-md-6 col-lg-offset-3 col-lg-6">
            <h2 class="text-center">Se contretó con éxito la reserva!</h2>
            <div class="text-center">
                <icon-app iconImage="thumbs-o-up" aditionalClasses="text-success mano-grande"></icon-app>
            </div>
            <div class="text-center">
                <p>{{ responseMessage }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex'
    import Icon from './Icon.vue'

    export default {
        components: {
            'icon-app': Icon
        },
        computed: {
            ...mapState({
                responseMessage: state => state.xhr.responseMessage
            })
        }
    }
</script>

<style>
    .mano-grande {
        font-size: 25em;
    }
</style>