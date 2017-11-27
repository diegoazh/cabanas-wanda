<template>
    <div id="reservas-edit-component" class="container jumbotron">
        <div class="alert alert-danger">
            <p>Por su seguridad solo podrá realizar modificaciones si tiene el código de la reserva. De no ser así registrese como usuario del sitio y genere un nuevo código.</p>
        </div>
        <find-app v-if="!rental"></find-app>
        <update-app v-else></update-app>
    </div>
</template>

<script>
    import { mapState, mapMutations } from 'vuex';
    import FindRental from './FindRental.vue';
    import UpdateRental from './UpdateRental.vue';

    export default {
        components: {
            'find-app': FindRental,
            'update-app': UpdateRental
        },
        data() {
            return {}
        },
        computed: {
            ...mapState('rentals_edit', {
                rental: state => state.data.rental
            })
        },
        methods: {
            ...mapMutations('rentals_edit', ['setRental'])
        },
        filters: {},
        created() {
            window.EventBus.$on('rental-updated', () => this.setRental(null));
        },
        mounted() {
        }
    }
</script>

<style>
    #reservas-edit-component {
        margin-top: 30px;
        background-color: rgba(238,238,238,0.4);
    }
</style>