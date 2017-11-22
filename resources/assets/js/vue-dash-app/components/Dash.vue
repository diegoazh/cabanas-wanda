<template>
    <div class="panel">
        <div class="panel-heading">
            <h1 class="text-center">Panel de asministración</h1>
        </div>
        <div class="panel-body">
            <btn-switch-app :initLeft="seeRentals" textLeft="Reservas" textRight="Pedidos" classOnActive="text-primary" classOnInactive="text-muted" :textDeleted="true"></btn-switch-app>
            <div>
                <template v-if="seeRentals">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#pendientes" aria-controls="pendientes" role="tab" data-toggle="tab">Pendientes</a></li>
                        <li role="presentation"><a href="#confirmadas" aria-controls="confirmadas" role="tab" data-toggle="tab">Confirmadas</a></li>
                        <li role="presentation"><a href="#en_curso" aria-controls="en_curso" role="tab" data-toggle="tab">En curso</a></li>
                        <li role="presentation"><a href="#finalizadas_canceladas" aria-controls="finalizadas_canceladas" role="tab" data-toggle="tab">Finalizadas y canceladas</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="pendientes">...</div>
                        <div role="tabpanel" class="tab-pane" id="confirmadas">...</div>
                        <div role="tabpanel" class="tab-pane" id="en_curso">...</div>
                        <div role="tabpanel" class="tab-pane" id="finalizadas_canceladas">...</div>
                    </div>
                </template>
                <template v-else>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#pendientes2" aria-controls="pendientes2" role="tab" data-toggle="tab">Pendientes</a></li>
                        <li role="presentation"><a href="#seniadas" aria-controls="seniadas" role="tab" data-toggle="tab">Señadas</a></li>
                        <li role="presentation"><a href="#pagadas" aria-controls="pagadas" role="tab" data-toggle="tab">Pagadas</a></li>
                        <li role="presentation"><a href="#canceladas" aria-controls="canceladas" role="tab" data-toggle="tab">Canceladas</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="pendientes2">...</div>
                        <div role="tabpanel" class="tab-pane" id="seniadas">...</div>
                        <div role="tabpanel" class="tab-pane" id="pagadas">...</div>
                        <div role="tabpanel" class="tab-pane" id="canceladas">...</div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</template>

<script>
    import Icon from '../../vue-commons/components/Icon.vue';
    import BtnSwitch from '../../vue-commons/components/BtnSwitch.vue';

    export default {
        components: {
            'icon-app': Icon,
            'btn-switch-app': BtnSwitch,
        },
        data() {
            return {
                seeRentals: true
            }
        },
        computed: {},
        methods: {},
        filters: {},
        created() {
            window.EventBus.$on('change-side', ($event)=> {
                this.seeRentals = $event;
            })
        },
        mounted() {
        }
    }
</script>

<style></style>