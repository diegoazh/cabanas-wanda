<template>
    <div id="reservas-edit-component" class="container jumbotron">
        <h1 class="text-center">Edición y cancelación de reservas</h1>
        <div class="alert alert-danger" v-if="!rental">
            <p>Por su seguridad solo podrá realizar modificaciones si tiene el código de la reserva. De no ser así registrese como usuario del sitio y genere un nuevo código.</p>
        </div>
        <find-app v-if="!rental && !updatedRental"></find-app>
        <update-app v-else-if="rental && !updatedRental"></update-app>
        <updated-app v-else-if="!rental && updatedRental"></updated-app>
    </div>
</template>

<script>
    import { mapState, mapMutations } from 'vuex';
    import FindRental from './FindRental.vue';
    import UpdateRental from './UpdateRental.vue';
    import InfoRentalUpdated from './InfoRentalUpdated.vue';

    export default {
        components: {
            'find-app': FindRental,
            'update-app': UpdateRental,
            'updated-app': InfoRentalUpdated
        },
        data() {
            return {}
        },
        computed: {
            ...mapState('rentals_edit', {
                rental: state => state.data.rental,
                updatedRental: state => state.data.updatedRental
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