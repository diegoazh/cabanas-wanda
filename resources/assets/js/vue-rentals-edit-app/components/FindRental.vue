<template>
    <div class="row justify-content-around">
        <div class="col-12 col-md-12">
            <h2 class="text-center"><icon-app iconImage="search"></icon-app> Buscar reserva</h2>
            <form action="" class="form-inline justify-content-center mt-3">
                <div class="form-group form-row">
                    <label for="search_code" class="col-form-label sr-only">Código:</label>
                    <div class="input-group mr-2">
                        <div class="input-group-addon"><icon-app iconImage="barcode"></icon-app></div>
                        <input name="search_code" id="search_code" type="text" class="form-control" v-model="code">
                    </div>
                    <button class="btn btn-outline-primary" @click.prevent="findRentalForCode"><icon-app iconImage="search"></icon-app></button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import VueNoti from 'vue-notifications';
    import { mapActions } from 'vuex';
    import Icon from '../../vue-commons/components/Icon.vue';

    export default {
        components: {
            'icon-app': Icon
        },
        data() {
            return {
                code: '',
            }
        },
        computed: {},
        methods: {
            findRentalForCode() {
                this.findRental({
                    reserva: this.code,
                    fromNow: true
                }).then(response => {
                    VueNoti.success(response);
                }).catch(error => {
                    VueNoti.error(error);
                });

                this.code = '';
            },
            ...mapActions('rentals_edit', ['findRental'])
        },
        filters: {},
        created() {
        },
        mounted() {
        }
    }
</script>

<style></style>