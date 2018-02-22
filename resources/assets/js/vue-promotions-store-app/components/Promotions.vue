<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-pills nav-fill mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-list-tab" data-toggle="pill" href="#pills-list" role="tab" aria-controls="pills-list" aria-selected="true">Lista de promociones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-store-tab" data-toggle="pill" href="#pills-store" role="tab" aria-controls="pills-store" aria-selected="false">Crear promoción</a>
                    </li>
                </ul>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-list" role="tabpanel" aria-labelledby="pills-list-tab">
                        <promotions-list></promotions-list>
                    </div>
                    <div class="tab-pane fade" id="pills-store" role="tabpanel" aria-labelledby="pills-store-tab">
                        <promotions-store></promotions-store>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapActions } from 'vuex'
    import PromotionsList from './PromotionsList'
    import PromotionsSotre from './PromotionsStore'

    export default {
        name: 'promotions',
        components: {
            'promotions-list': PromotionsList,
            'promotions-store': PromotionsSotre
        },
        data() {
            return {}
        },
        computed: {},
        methods: {
            ...mapActions('auth', ['fireSetTokenMutation']),
        },
        filters: {},
        created() {
        },
        mounted() {
            if (this.$cookies.isKey('info_one')) {
                this.fireSetTokenMutation(this.$cookies.get('info_one'));
            }
        }
    }
</script>

<style scoped>

</style>